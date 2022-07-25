<?php
include('../includes/connection.php');
include('../constants/regex.php');
include('../constants/validation.php');

if (!isset($_POST["patientSigninDetails"])) {
    die($errorMessages["emptyData"]);
}

$email = $_POST['email'];
$password = $_POST['password'];
$hashedPassword = md5($password);

function isEmailValid($value)
{
    global $regex;
    return (preg_match($regex["email"], $value));
}

$isEmailValid = isEmailValid($email);

if (!$isEmailValid) {
    die($errorMessages['notEmail']);
}

$sql= "SELECT * FROM user WHERE email='$email' AND password='$hashedPassword'";
$resultSet= mysqli_query($conn, $sql);
$numRows= mysqli_num_rows($resultSet);
if($numRows>0){
    echo "authenticated"; // dashboard maa redirect garne ani dashboard maa cokkie session use garne
}

mysqli_close($conn);
