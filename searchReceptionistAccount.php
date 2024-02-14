<?php
    include('MySQL.php');
    include 'navbar.html';

    $receptionistID = isset($_POST['receptionistID']) ? intval($_POST['receptionistID']) : (isset($_GET['receptionistID']) ? intval($_GET['receptionistID']) : 0);

    echo '<head>';
    echo '<title>Receptionist Details</title>';
    echo '<link rel="stylesheet" type="text/css" href="databasetables.css">';
    echo '</head>';

    if($receptionistID > 0){
        receptionistsTable($con, $receptionistID);
    }
    else{
        echo "No valid Receptionist ID provided.";
    }

    function receptionistsTable($con, $receptionistID){
        $query = "SELECT
            r.FirstName AS ReceptionistFirstName,
            r.LastName AS ReceptionistLastName,
            r.ReceptionistID AS ReceptionistID,
            r.Phone AS ReceptionistPhone,
            r.Email AS ReceptionistEmail,
            
            p.FirstName AS PatientFirstName,
            p.LastName AS PatientLastName,
            p.PatientID AS PatientID,
            
            m.DateOfBirth AS PatientDateOfBirth,
            m.Age AS PatientAge,
            m.Address AS PatientAddress,
            m.Phone AS PatientPhone,
            m.ShotsGiven AS PatientImmunizationRecord,
            m.Illnesses AS PatientIllnessRecord,
            
            ap.AppointmentID AS AppointmentID,
            ap.AppointmentDate AS AppointmentDate,
            ap.AppointmentType AS AppointmentType,
            ap.ProcedureDate AS ProcedureDate,
            ap.ProcedureType AS ProcedureType,
            
            d.DoctorName AS DoctorName,
            d.DoctorID AS DoctorID
            
            FROM Receptionists AS r
            
            JOIN AppointmentsProcedures AS ap ON r.ReceptionistID = ap.ReceptionistID
            JOIN Patients AS p ON ap.PatientID = p.PatientID
            LEFT JOIN MedicalRecords AS m ON p.PatientID = m.PatientID
            LEFT JOIN Doctors AS d ON d.DoctorID = ap.DoctorID
            
            WHERE r.ReceptionistID = '$receptionistID'";

        $result = mysqli_query($con, $query);
        
        echo '<body style="margin: 0; padding: 0;">';
        echo '<div style="width: 100%; overflow-x: auto;">';
        echo '<table style="width: auto; min-width: 100%; margin-left: 0; border-collapse: collapse; border: 1px solid black;">';
        echo "<tr><th>Receptionist First Name</th><th>Receptionist Last Name</th><th>Receptionist ID</th><th>Receptionist Phone</th><th>Receptionist Email</th><th>Patient First Name</th><th>Patient Last Name</th><th>Patient ID</th><th>Patient Date of Birth</th><th>Patient Age</th><th>Patient Address</th><th>Patient Phone</th><th>Patient Immunization Record</th><th>Patient Illness Record</th><th>Appointment ID</th><th>Appointment Date</th><th>Appointment Type</th><th>Procedure Date</th><th>Procedure Type</th><th>Doctor Name</th><th>Doctor ID</th></tr>";
        
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row["ReceptionistFirstName"] . "</td>";
            echo "<td>" . $row["ReceptionistLastName"] . "</td>";
            echo "<td>" . $row["ReceptionistID"] . "</td>";
            echo "<td>" . $row["ReceptionistPhone"] . "</td>";
            echo "<td>" . $row["ReceptionistEmail"] . "</td>";
            echo "<td>" . $row["PatientFirstName"] . "</td>";
            echo "<td>" . $row["PatientLastName"] . "</td>";
            echo "<td>" . $row["PatientID"] . "</td>";
            echo "<td>" . $row["PatientDateOfBirth"] . "</td>";
            echo "<td>" . $row["PatientAge"] . "</td>";
            echo "<td>" . $row["PatientAddress"] . "</td>";
            echo "<td>" . $row["PatientPhone"] . "</td>";
            echo "<td>" . $row["PatientImmunizationRecord"] . "</td>";
            echo "<td>" . $row["PatientIllnessRecord"] . "</td>";
            echo "<td>" . $row["AppointmentID"] . "</td>";
            echo "<td>" . $row["AppointmentDate"] . "</td>";
            echo "<td>" . $row["AppointmentType"] . "</td>";
            echo "<td>" . $row["ProcedureDate"] . "</td>";
            echo "<td>" . $row["ProcedureType"] . "</td>";
            echo "<td>" . $row["DoctorName"] . "</td>"; 
            echo "<td>" . $row["DoctorID"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</body>";
    }
?>