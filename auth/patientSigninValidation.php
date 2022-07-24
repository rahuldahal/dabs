<?php
include('../constants/regex.php');
include('../constants/validation.php');

if (!isset($_POST["patientSigninDetails"])) {
    die($errorMessages["emptyData"]);
}

$email = $_POST['email'];
$password = $_POST['password'];

function isEmailValid($value)
{
    global $regex;
    return (preg_match($regex["email"], $value));
}

$isEmailValid = isEmailValid($email);

if (!$isEmailValid) {
    die($errorMessages['notEmail']);
}
