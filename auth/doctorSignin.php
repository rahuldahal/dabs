<?php
session_start();
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__).'/constants/regex.php');
include(dirname(__DIR__).'/constants/validation.php');

if (!isset($_POST["doctorSigninDetails"])) {
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

echo $email;
echo $hashedPassword;
