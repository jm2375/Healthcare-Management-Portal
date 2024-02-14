<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    include 'MySQL.php';

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $patientID = $_POST["patientID"];

    $checkSQL = "SELECT * FROM Patients WHERE FirstName = '$firstName' AND LastName = '$lastName' AND PatientID = '$patientID'";
    $checkResult = mysqli_query($con, $checkSQL);

    if(mysqli_num_rows($checkResult) > 0){
        echo "true";
    }
    else{
        echo "false";
    }

    mysqli_close($con);
}
?>