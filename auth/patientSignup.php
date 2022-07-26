<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__).'/constants/db.php');
include(dirname(__DIR__).'/constants/enums.php');
include(dirname(__DIR__).'/constants/regex.php');
include(dirname(__DIR__).'/constants/validation.php');
session_start();

$errors = array();

if (!isset($_POST["patientSignupDetails"])) {
    die($errorMessages["emptyData"]);
}

function trimData($values)
{
    $trimmedData = array();
    foreach ($values as $key => $value) {
        if ($key == "password") {
            $trimmedData[$key] = $value;
        } else {
            $trimmedData[$key] = trim($value);
        }
    }
    return $trimmedData;
}

function toLowerCase($values)
{
    $lowerCasedData = array();
    foreach ($values as $key => $value) {
        if ($key == "password" || $key == "bloodGroup") {
            $lowerCasedData[$key] = $value;
        } else {
            $lowerCasedData[$key] = strtolower($value);
        }
    }
    return $lowerCasedData;
}

$patientsDetails = toLowerCase(trimData($_POST));


function isAlpha($value)
{
    return ctype_alpha($value);
}

function isEmailValid($value)
{
    global $regex;
    return (preg_match($regex["email"], $value));
}

function isDOBValid($value)
{
    global $regex;
    return (preg_match($regex["yyyy-mm-dd"], $value));
}

function isFullNameValid($firstName, $middleName, $lastName)
{
    if (isAlpha($firstName) && isAlpha($middleName) && isAlpha($lastName)) {
        return true;
    }

    return false;
}

function isPasswordValid($value)
{
    global $regex;
    return (preg_match($regex["password"], $value));
}

// validations

$isFullNameValid = isFullNameValid($patientsDetails['firstName'], $patientsDetails['middleName'], $patientsDetails['lastName']);
$isEmailValid = isEmailValid($patientsDetails['email']);
$isDOBValid = isDOBValid($patientsDetails['dob']);
$isGenderValid = in_array($patientsDetails['gender'], $gender);
$isBloodGroupValid = in_array($patientsDetails['bloodGroup'], $bloodGroup);
$isMaritalStatusValid = in_array($patientsDetails['maritalStatus'], $maritalStatus);
$isPasswordValid = isPasswordValid($patientsDetails['password']);

if (!$isFullNameValid) {
    array_push($errors, "Name " . $errorMessages['notAlpha']);
}

if (!$isEmailValid) {
    array_push($errors, $errorMessages['notEmail']);
}

if (!$isDOBValid) {
    array_push($errors, "DOB " . $errorMessages['invalidDate'] . " yyyy-mm-dd!");
}

if (!$isGenderValid) {
    array_push($errors, "Gender " . $errorMessages['notInEnum']);
}

if (!$isMaritalStatusValid) {
    array_push($errors, "Marital Status " . $errorMessages['notInEnum']);
}

if (!$isBloodGroupValid) {
    array_push($errors, "Blood Group " . $errorMessages['notInEnum']);
}

if (!$isPasswordValid) {
    array_push($errors, $errorMessages['weakPassword']);
}

if (count($errors) > 0) {
    print_r($errors);
    exit();
}
else{
    print_r($patientsDetails);
}
// Run using insert queries 

$firstName= $patientsDetails['firstName'];
$middleName= $patientsDetails['middleName'];
$lastName= $patientsDetails['lastName'];
$email= $patientsDetails['email'];
$dob= $patientsDetails['dob'];
$gender= $patientsDetails['gender'];
$maritalStatus = $patientsDetails['maritalStatus'];
$bloodGroup= $patientsDetails['bloodGroup'];
$password= $patientsDetails['password'];
$hashedPassword = md5($password);
$role= "patient";
$photo= $defaultValues['photo'].$firstName."+".$lastName;

$sql= "INSERT INTO user (firstName, middleName, lastName, email, password, bloodGroup, gender, maritalStatus, role, photo) VALUES ('$firstName',
'$middleName', '$lastName', '$email', '$hashedPassword', '$bloodGroup', '$gender', '$maritalStatus', '$role', '$photo')";
$resultSet= mysqli_query($conn, $sql);
$affectedRows= mysqli_affected_rows($conn);
if($affectedRows>0){
    echo "Successfully Inserted";
    $userDetails = ["firstName" => $firstName, "email" => $email];
    $_SESSION['userDetails']= $userDetails;
    header('Location: /dabs/views/dashboard.php');
    exit();
}

mysqli_close($conn);
