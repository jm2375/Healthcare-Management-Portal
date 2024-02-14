<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include 'MySQL.php';

    $appointmentID = $_POST['appointmentID'];

    mysqli_begin_transaction($con);

    $checkSQL = "SELECT * FROM AppointmentsProcedures WHERE AppointmentID = '$appointmentID'";
    $checkResult = mysqli_query($con, $checkSQL);

    if($checkResult === false){
        echo "Error occurred.";
        mysqli_rollback($con);
        mysqli_close($con);
        exit();
    }

    if(mysqli_num_rows($checkResult) > 0){
        $deleteSQL = "DELETE FROM AppointmentsProcedures WHERE AppointmentID = '$appointmentID'";

        if(mysqli_query($con, $deleteSQL)){
            mysqli_commit($con);
            echo "Appointment and any associated procedure cancelled successfully.";
        }
        else{
            echo "Error occurred.";
            mysqli_rollback($con);
        }
    }
    else{
        echo "Appointment with ID $appointmentID does not exist.";
        mysqli_rollback($con);
    }

    mysqli_close($con);
}
?>
