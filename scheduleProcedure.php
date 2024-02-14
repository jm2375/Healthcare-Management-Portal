<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'MySQL.php';

    $appointmentID = $_POST['appointmentID'];
    $procedureDate = $_POST['procedureDate'];
    $procedureType = $_POST['procedureType'];

    $foundUnique = false;
    $procedureID = 0;

    while(!$foundUnique){
        $procedureID = rand(1000, 9999);
        $checkUniqueSQL = "SELECT * FROM AppointmentsProcedures WHERE ProcedureID = '$procedureID'";
        $checkUniqueResult = mysqli_query($con, $checkUniqueSQL);

        if(mysqli_num_rows($checkUniqueResult) == 0){
            $foundUnique = true;
        }
    }

    $checkAppointmentSQL = "SELECT * FROM AppointmentsProcedures WHERE AppointmentID = '$appointmentID'";
    $checkResult = mysqli_query($con, $checkAppointmentSQL);

    if(mysqli_num_rows($checkResult) > 0){
        $updateSQL = "UPDATE AppointmentsProcedures SET ProcedureID = '$procedureID', ProcedureDate = '$procedureDate', ProcedureType = '$procedureType' WHERE AppointmentID = '$appointmentID'";

        if(mysqli_query($con, $updateSQL)){
            echo "Procedure scheduled successfully. Your procedure ID is $procedureID.";
        }
        else{
            echo "Error occurred.";
        }
    }
    else{
        echo "Please verify a pre-procedure appointment was made before booking a procedure.";
    }

    mysqli_close($con);
}
?>
