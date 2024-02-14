<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'MySQL.php';

    $appointmentDate = $_POST['appointmentDate'];
    $appointmentType = $_POST['appointmentType'];
    $doctorID = $_POST['doctorID'];
    $patientID = $_POST['patientID'];
    $receptionistID = $_POST['receptionistID'];

    $foundUnique = false;
    $appointmentID = 0;

    while(!$foundUnique){
        $appointmentID = rand(1000, 9999);
        $checkUniqueSQL = "SELECT * FROM AppointmentsProcedures WHERE AppointmentID = '$appointmentID'";
        $checkUniqueResult = mysqli_query($con, $checkUniqueSQL);

        if(mysqli_num_rows($checkUniqueResult) == 0){
            $foundUnique = true;
        }
    }

    $doctorNameSQL = "SELECT DoctorName FROM Doctors WHERE DoctorID = '$doctorID'";
    $doctorResult = mysqli_query($con, $doctorNameSQL);
    $doctorName = "";

    if($row = mysqli_fetch_assoc($doctorResult)){
        $doctorName = $row['DoctorName'];
    }
    else{
        echo "No doctor found with the given Doctor ID.";
        mysqli_close($con);
        exit;
    }

    $checkSQL = "INSERT INTO AppointmentsProcedures (AppointmentID, AppointmentDate, AppointmentType, DoctorID, DoctorName, PatientID, ReceptionistID) VALUES ('$appointmentID', '$appointmentDate', '$appointmentType', '$doctorID', '$doctorName', '$patientID', '$receptionistID')";

    if(mysqli_query($con, $checkSQL)){
        echo "Appointment confirmed. Your Appointment ID: $appointmentID";
    }
    else{
        echo "Error occurred";
    }

    mysqli_close($con);
}
?>
