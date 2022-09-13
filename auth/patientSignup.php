<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__).'/constants/db.php');
include(dirname(__DIR__).'/constants/enums.php');
include(dirname(__DIR__).'/constants/regex.php');
include(dirname(__DIR__).'/constants/validation.php');
session_start();



// Run using insert queries 

$firstName= $patientsDetails['firstName'];
$middleName= $patientsDetails['middleName'];
$lastName= $patientsDetails['lastName'];
$dob= $patientsDetails['dob'];
$gender= $patientsDetails['gender'];
$maritalStatus = $patientsDetails['maritalStatus'];
$bloodGroup= $patientsDetails['bloodGroup'];
$password= $patientsDetails['password'];
$hashedPassword = md5($password);
$address = $patientsDetails['address'];
$contact = $patientsDetails['telephone'];
$role= "patient";
$photo= $defaultValues['photo'].$firstName."+".$lastName;



$sql= "INSERT INTO user (firstName, middleName, lastName, email, password, bloodGroup, dob, gender, maritalStatus, role, address, telephone, photo) VALUES ('$firstName',
'$middleName', '$lastName', '$email', '$hashedPassword', '$bloodGroup', '$dob', '$gender', '$maritalStatus', '$role', '$address', '$phone', '$photo')";
$resultSet= mysqli_query($conn, $sql);
$affectedRows= mysqli_affected_rows($conn);
if($affectedRows>0){
    // echo "Successfully Inserted";
    $userDetails = ["firstName" => $firstName, "email" => $email, "role" => $role];
    $_SESSION['userDetails']= $userDetails;
    $data = json_encode(["errors"=>$errors]);
    
    header('Content-Type: application/json; charset=utf-8');
    echo $data;
}

mysqli_close($conn);
