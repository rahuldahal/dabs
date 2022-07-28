<?php
    session_start();
    include(dirname(__DIR__).'/includes/connection.php');
    include(dirname(__DIR__).'/constants/regex.php');
    include(dirname(__DIR__).'/constants/validation.php');

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
    array_push($errors, $userId." ".$errorMessages['notInTable']);
}

$doctorId= $appointmentDetails['doctorId'];
$query1 = "SELECT doctorId FROM doctor WHERE doctorId= '$doctorId';";
$resultSet1 = mysqli_query($conn, $query1);
$numRows1 = mysqli_num_rows($resultSet1);
if($numRows1 == 0){
    array_push($errors, $userId." ".$errorMessages['notInTable']);
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

$sql = "INSERT INTO appointment (userId, doctorId, reason, appointmentDateAndTime) VALUES ('$userId', '$doctorId', '$reason', '$dateAndTime');";
        $resultSet= mysqli_query($conn, $sql);
        $affectedRows= mysqli_affected_rows($conn);
        if($affectedRows > 0){
            echo " Successfully Inserted Into appointment";
        }
?>