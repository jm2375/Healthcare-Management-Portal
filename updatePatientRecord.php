<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    include 'MySQL.php';

    $shots = $_POST["shots"];
    $illnesses = $_POST["illnesses"];
    $patientID = $_POST["patientID"];

    $checkSQL = "SELECT * FROM MedicalRecords WHERE PatientID = '$patientID'";
    $checkResult = mysqli_query($con, $checkSQL);

    if(mysqli_num_rows($checkResult) === 0){
        echo "Patient ID not found in the database.";
        mysqli_close($con);
        exit;
    }

    if(empty($shots) && empty($illnesses)){
        echo "No valid data entered.";
        mysqli_close($con);
        exit;
    }

    $updateSQL = "";
    $checkSQL = "UPDATE MedicalRecords SET ";
    
    if(!empty($shots)){
        $updateSQL .= "Shots updated";
        $checkSQL .= "Shots = '$shots'";
    }
    
    if(!empty($illnesses)){
        if(!empty($updateSQL)){
            $checkSQL .= ", ";
            $updateSQL .= " and ";
        }
        $updateSQL .= "Illnesses updated";
        $checkSQL .= "Illnesses = '$illnesses'";
    }
    
    $checkSQL .= " WHERE PatientID = '$patientID'";

    if(!empty($updateSQL)){
        if(mysqli_query($con, $checkSQL)){
            echo $updateSQL . ".";
        }
        else{
            echo "Error occurred.";
        }
    }

    mysqli_close($con);
}
?>
