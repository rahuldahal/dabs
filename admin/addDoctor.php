<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__).'/constants/db.php');
include(dirname(__DIR__).'/constants/enums.php');
include(dirname(__DIR__).'/constants/regex.php');
include(dirname(__DIR__).'/constants/validation.php');
include(dirname(__DIR__)."/includes/header.php");
include(dirname(__DIR__)."/timeSlot.php");
include (dirname(__DIR__).'/includes/adminAuthentication');

$errors = array();

if (!isset($_POST["doctorSignupDetails"])) {
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
        if ($key == "password" || $key == "bloodGroup" || $key == "specialization" || $key == "degree") {
            $lowerCasedData[$key] = $value;
        } else {
            $lowerCasedData[$key] = strtolower($value);
        }
    }
    return $lowerCasedData;
}

$doctorDetails = toLowerCase(trimData($_POST));


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

// function isDateTimeValid($value)
// {
//     global $regex;
//     return (preg_match($regex["yyyy-mm-dd hh:mm:ss"], $value));
// }

function isPasswordValid($value)
{
    global $regex;
    return (preg_match($regex["password"], $value));
}

// validations

$isFullNameValid = isFullNameValid($doctorDetails['firstName'], $doctorDetails['middleName'], $doctorDetails['lastName']);
$isEmailValid = isEmailValid($doctorDetails['email']);
$isDOBValid = isDOBValid($doctorDetails['dob']);
$isGenderValid = in_array($doctorDetails['gender'], $gender);
$isBloodGroupValid = in_array($doctorDetails['bloodGroup'], $bloodGroup);
$isMaritalStatusValid = in_array($doctorDetails['maritalStatus'], $maritalStatus);
$isSpecializationValid = in_array($doctorDetails['specialization'], $specialization);
$isDegreeValid = in_array($doctorDetails['degree'], $degree);
// $isStatusValid = in_array($doctorDetails['status'], $status);
$isPasswordValid = isPasswordValid($doctorDetails['password']);
// $isDateTimeValid= isDateTimeValid($doctorDetails['availabilityTime']);

// if(!$isDateTimeValid){
//     array_push($errors, "Date and time " . $errorMessages['invalidDate'] . " yyyy-mm-dd hh:mm:ss!");
// }

if (!$isFullNameValid) {
    array_push($errors, "Name " . $errorMessages['notAlpha']);
}

if (!$isEmailValid) {
    array_push($errors, $errorMessages['notEmail']);
}

$email = $doctorDetails['email'];
$query = "SELECT email FROM user WHERE email= '$email';";
$resultSet = mysqli_query($conn, $query);
$emailExists = mysqli_num_rows($resultSet);
if($emailExists > 0){
    array_push($errors, $errorMessages['repeatedEmail']);
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

if (!$isSpecializationValid) {
    array_push($errors, "Specialization " . $errorMessages['notInEnum']);
}

if (!$isDegreeValid) {
    array_push($errors, "Degree " . $errorMessages['notInEnum']);
}

// if (!$isStatusValid) {
//     array_push($errors, "Status " . $errorMessages['notInEnum']);
// }

if (!$isPasswordValid) {
    array_push($errors, $errorMessages['weakPassword']);
}



if (count($errors) > 0) {
    print_r($errors);
    exit();
}
else{
    print_r($doctorDetails);
}

//RUN using insert queries

$firstName= $doctorDetails['firstName'];
$middleName= $doctorDetails['middleName'];
$lastName= $doctorDetails['lastName'];
$email= $doctorDetails['email'];
$dob= $doctorDetails['dob'];
$gender= $doctorDetails['gender'];
$maritalStatus = $doctorDetails['maritalStatus'];
$bloodGroup= $doctorDetails['bloodGroup'];
$specialization= $doctorDetails['specialization'];
$degree= $doctorDetails['degree'];
$availabilityTime= $doctorDetails['availabilityTime'];
$password= $doctorDetails['password'];
$hashedPassword = md5($password);
$status= "active";
$role= "doctor";
$photo= $defaultValues['photo'].$firstName."+".$lastName;

$sql1 = "INSERT INTO user (firstName, middleName, lastName, email, password, bloodGroup, dob, gender, maritalStatus, role, photo) VALUES ('$firstName',
'$middleName', '$lastName', '$email', '$hashedPassword', '$bloodGroup', '$dob', '$gender', '$maritalStatus', '$role', '$photo');";
$resultSet1= mysqli_query($conn, $sql1);
$affectedRows1= mysqli_affected_rows($conn);
if($affectedRows1>0){
    echo "Successfully Inserted Into user ";

    $sql2= "SELECT userId FROM user WHERE email='$email'";
    $resultSet2= mysqli_query($conn, $sql2);
    $numRows2= mysqli_num_rows($resultSet2);
    if($numRows2>0){
        $row=mysqli_fetch_assoc($resultSet2);
        $userId= $row['userId'];

        $sql3 = "INSERT INTO doctor (userId, specialization, degree, availabilityTime, status) VALUES ('$userId',
        '$specialization', '$degree', '$availabilityTime', '$status');";
        $resultSet3= mysqli_query($conn, $sql3);
        $affectedRows3= mysqli_affected_rows($conn);
        if($affectedRows3 > 0){
            echo " Successfully Inserted Into doctor";
            // exit();
            //to select availability time of currently inserted doctor
            // $sql4 = "SELECT doctorId FROM (user INNER JOIN doctor ON user.userId = doctor.userId) WHERE userId = $userId;";
            $sql4 = "SELECT doctorId FROM doctor WHERE userId= '$userId';";
            $resultSet4 = mysqli_query($conn, $sql4);
            $numRows4= mysqli_num_rows($resultSet4);
                if($numRows4>0){
                    $row=mysqli_fetch_assoc($resultSet4);
                    $doctorId= $row['doctorId'];

                    
                    $timeTable = "SELECT availabilityTime FROM doctor WHERE doctorId = '$doctorId';";
                    $resultSet = mysqli_query($conn, $timeTable);
                    $numRows = mysqli_num_rows($resultSet);
                    if($numRows > 0){
                      while($row = mysqli_fetch_assoc($resultSet)){
                        $availabilityTime = $row['availabilityTime'];
                        }
                      }
                    // echo $availabilityTime;
                    // exit();
                    
                    $time = getTime($availabilityTime);
                    $slots = getSlots($time); // array of slots
                    
                    $slots=  json_encode($slots);
                    $insertTimeSlot = "INSERT INTO doctorschedule (doctorId, slots) VALUES ('$doctorId', '$slots');";
                    $resultSet= mysqli_query($conn, $insertTimeSlot);
                    $affectedRows= mysqli_affected_rows($conn);
                    if($affectedRows > 0){
                       echo " Successfully Inserted Into doctorschedule";                      
                    }

            
                }
        }
    }
}
mysqli_close($conn);