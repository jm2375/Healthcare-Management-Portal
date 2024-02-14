<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    include 'MySQL.php';

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $password = $_POST["password"];
    $id = $_POST["id"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $emailConfirmation = $_POST["emailConfirmation"];
    $transactionType = $_POST["transactionType"];

    $firstName = ucfirst($firstName);
    $lastName = ucfirst($lastName);

    $phoneNumber = preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $phoneNumber);

    $checkSQL = "SELECT * FROM Receptionists WHERE FirstName = '$firstName' AND LastName = '$lastName' AND Password = '$password' AND ReceptionistID = '$id' AND Phone = '$phoneNumber'";

    if($emailConfirmation == "on"){
        $checkSQL .= " AND Email = '$email'";
    }

    $checkResult = mysqli_query($con, $checkSQL);

    if($checkResult){
        if(mysqli_num_rows($checkResult) > 0){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    else{
        echo "false";
    }

    mysqli_close($con);
}
?>