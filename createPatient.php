<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'MySQL.php';

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $patientID = $_POST['patientID'];

    $patientSQL = "SELECT * FROM Patients WHERE PatientID = '$patientID'";
    $patientResult = mysqli_query($con, $patientSQL);

    if(mysqli_num_rows($patientResult) > 0){
        echo "Patient already exists in the system.";
    }
    else{
        $insertPatientSQL = "INSERT INTO Patients (PatientID, FirstName, LastName) VALUES ('$patientID', '$firstName', '$lastName')";
        $insertPatientResult = mysqli_query($con, $insertPatientSQL);

        if($insertPatientResult){
            echo "Patient account created successfully.";
        }
        else{
            echo "Error occurred.";
        }
    }

    mysqli_close($con);
}
?>