<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'MySQL.php';

    $procedureID = $_POST['procedureID'];

    $checkSQL = "SELECT * FROM AppointmentsProcedures WHERE ProcedureID = '$procedureID'";
    $checkResult = mysqli_query($con, $checkSQL);

    if(mysqli_num_rows($checkResult) > 0){
        $updateSQL = "UPDATE AppointmentsProcedures SET ProcedureType = NULL, ProcedureDate = NULL, ProcedureID = NULL WHERE ProcedureID = '$procedureID'";
        
        if(mysqli_query($con, $updateSQL)){
            echo "Procedure cancelled successfully.";
        }
        else{
            echo "Error occurred.";
        }
    }
    else{
        echo "Procedure with ID $procedureID does not exist.";
    }

    mysqli_close($con);
}
?>