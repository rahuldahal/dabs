<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__).'/constants/db.php');
include(dirname(__DIR__).'/constants/enums.php');
include(dirname(__DIR__).'/constants/regex.php');
include(dirname(__DIR__).'/constants/validation.php');
session_start();

$errors = array();
    
if (!isset($_POST["appointmentDetails"])) {
    die($errorMessages["emptyData"]);
}    

function trimData($values){
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

$appointmentDetails = trimData($_POST);

function isAlpha($value)
{
    return ctype_alpha($value);
}

function isReasonValid($reason){
    if (isAlpha($reason)) {
        return true;
    }
    return false;
}

function isDateTimeValid($value)
{
    global $regex;
    return (preg_match($regex["yyyy-mm-dd hh:mm:ss"], $value));
}

$isReasonValid= isReasonValid($appointmentDetails['reason']);
if(!$isReasonValid){
    array_push($errors, "Reason " . $errorMessages['notAlpha']);
}

$isDateTimeValid= isDateTimeValid($appointmentDetails['appointmentDateAndTime']);
if(!$isDateTimeValid){
    array_push($errors, "Date and time " . $errorMessages['invalidDate'] . " yyyy-mm-dd hh:mm:ss!");
}

$userId= $appointmentDetails['userId'];
$query = "SELECT userId FROM user WHERE userId= '$userId';";
$resultSet = mysqli_query($conn, $query);
$numRows = mysqli_num_rows($resultSet);
if($numRows == 0){
    array_push($errors, "user ".$errorMessages['notInTable']);
}

$doctorId= $appointmentDetails['doctorId'];
$query1 = "SELECT doctorId FROM doctor WHERE doctorId= '$doctorId';";
$resultSet1 = mysqli_query($conn, $query1);
$numRows1 = mysqli_num_rows($resultSet1);
if($numRows1 == 0){
    array_push($errors, "doctor ".$errorMessages['notInTable']);
}

if (count($errors) > 0) {
    print_r($errors);
    exit();
}
else{
    print_r($appointmentDetails);
}

$userId= $appointmentDetails['userId'];
$doctorId= $appointmentDetails['doctorId'];
$reason= $appointmentDetails['reason'];
$dateAndTime= $appointmentDetails['appointmentDateAndTime'];

$query="SELECT token FROM appointment ORDER BY userId DESC LIMIT 1;";
$resultSet = mysqli_query($conn, $query);
$numRows = mysqli_num_rows($resultSet);
if($numRows > 0){
    $rows = mysqli_fetch_assoc($resultSet);
    $token = $rows['token'];
}

++$token;
$sql = "INSERT INTO appointment (userId, doctorId, reason, DateAndTime, token) VALUES ('$userId', '$doctorId', '$reason', '$dateAndTime', '$token');";
$resultSet= mysqli_query($conn, $sql) or die(mysqli_error($conn));
$affectedRows= mysqli_affected_rows($conn);
if($affectedRows > 0){
    echo " Successfully Inserted Into appointment";
        }
?>