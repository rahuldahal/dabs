<?php
include('../includes/connection.php');
include('../constants/db.php');
include('../constants/enums.php');
include('../constants/regex.php');
include('../constants/validation.php');
// include('../fetchTimeSlot.php');

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

// function isAlpha($value)
// {
//     return ctype_alpha($value);
// }

// function isReasonValid($reason){
//     if (isAlpha($reason)) {
//         return true;
//     }
//     return false;
// }

// function isDateTimeValid($value)
// {
//     global $regex;
//     return (preg_match($regex["yyyy-mm-dd hh:mm:ss"], $value));
// }

// $isReasonValid= isReasonValid($appointmentDetails['reason']);
// if(!$isReasonValid){
//     array_push($errors, "Reason " . $errorMessages['notAlpha']);
// }

// $isDateTimeValid= isDateTimeValid($appointmentDetails['DateAndTime']);
// if(!$isDateTimeValid){
//     array_push($errors, "Date and time " . $errorMessages['invalidDate'] . " yyyy-mm-dd hh:mm:ss!");
// }

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
// $userId= $_SESSION['userId'];
$doctorId= $appointmentDetails['doctorId'];
$reason= $appointmentDetails['reason'];
$date= $appointmentDetails['date'];
$timeSlot= $appointmentDetails['timeSlot'];
$status= "Pending";
$fee= 200;

//to generate token...
$sql= "SELECT * FROM appointment WHERE date ='$date' AND doctorId = '$doctorId';";
$resultSet = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($resultSet);
if($numRows > 0){
    $token = array();
    while($rows = mysqli_fetch_assoc($resultSet)){
        array_push($token, $rows);
        // array_push($slotsBooked, $rows['timeSlot']); // yesko laagi status <> Cancelled pani garnu parne cha
    }
    $count = count($token); // kati ota token cha, 0?, 1?, ...
    // print_r($token);
}

// 

// if($count > 0){
    ++$count; //++count garera insert garnu paryo, 0 ota raicha bhane token 1 huncha, 1ta cha bhane arko ko 2
    $sql = "INSERT INTO appointment (userId, doctorId, reason, date, timeSlot, token, fee, status) VALUES ('$userId', '$doctorId', '$reason', '$date', '$timeSlot', '$count', '$fee', '$status');";
// }
// else {
//     $sql = "INSERT INTO appointment (userId, doctorId, reason, DateAndTime, fee) VALUES ('$userId', '$doctorId', '$reason', '$dateAndTime', '$fee');";
// }

// $query="SELECT token FROM appointment ORDER BY userId DESC LIMIT 1;";
// $resultSet = mysqli_query($conn, $query);
// $numRows = mysqli_num_rows($resultSet);
// if($numRows > 0){
//     $rows = mysqli_fetch_assoc($resultSet);
//     $token = $rows['token'];
// }


$resultSet= mysqli_query($conn, $sql) or die(mysqli_error($conn));
$affectedRows= mysqli_affected_rows($conn);
if($affectedRows > 0){
    echo " Successfully Inserted Into appointment";
}
?>