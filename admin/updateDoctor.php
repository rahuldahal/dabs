<?php
    include(dirname(__DIR__).'/includes/connection.php');
    include(dirname(__DIR__).'/constants/db.php');
    include(dirname(__DIR__).'/constants/enums.php');
    include(dirname(__DIR__).'/constants/regex.php');
    include(dirname(__DIR__).'/constants/validation.php');

    session_start();
    if(count($_SESSION)==0){
        header('Location: /dabs/admin.php');
        exit();
      }else if($_SESSION['email']!= "admin123@gmail.com"){
        header('Location: /dabs/admin.php');
        exit();
      }

$errors = array();

if (!isset($_POST["doctorUpdateDetails"])) {
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


// validations
$doctorId = $doctorDetails['doctorId'];
$isFullNameValid = isFullNameValid($doctorDetails['firstName'], $doctorDetails['middleName'], $doctorDetails['lastName']);
$isEmailValid = isEmailValid($doctorDetails['email']);
// $isDOBValid = isDOBValid($doctorDetails['dob']);
$isGenderValid = in_array($doctorDetails['gender'], $gender);
$isBloodGroupValid = in_array($doctorDetails['bloodGroup'], $bloodGroup);
$isMaritalStatusValid = in_array($doctorDetails['maritalStatus'], $maritalStatus);
$isSpecializationValid = in_array($doctorDetails['specialization'], $specialization);
$isDegreeValid = in_array($doctorDetails['degree'], $degree);

// $doctorId = $doctorDetails['doctorId'];
// $query = "SELECT doctorId FROM doctor WHERE doctorId= '$doctorId';";
// $resultSet = mysqli_query($conn, $query);
// $emailExists = mysqli_num_rows($resultSet);
// if($emailExists == 0){
//     array_push($errors, "doctor ".$errorMessages['notInTable']);
// }

if (!$isFullNameValid) {
    array_push($errors, "Name " . $errorMessages['notAlpha']);
}

if (!$isEmailValid) {
    array_push($errors, $errorMessages['notEmail']);
}

// if (!$isDOBValid) {
//     array_push($errors, "DOB " . $errorMessages['invalidDate'] . " yyyy-mm-dd!");
// }

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

if (count($errors) > 0) {
    print_r($errors);
    exit();
}
else{
    print_r($doctorDetails);
}


// query to update
try{
    $userIdQuery = "SELECT userId FROM doctor WHERE doctorId= '$doctorId';";
$resultSet= mysqli_query($conn, $userIdQuery);
$numRows = mysqli_num_rows($resultSet);
$userId;
if($numRows > 0){
    while($row = mysqli_fetch_assoc($resultSet)){
        $userId = $row['userId'];
    }
}

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
$role= "doctor";
$status= $doctorDetails['status'];

$sql = "UPDATE user SET firstName='$firstName', middleName='$middleName', lastName='$lastName', email='$email', gender='$gender', maritalStatus='$maritalStatus', bloodGroup='$bloodGroup' WHERE userId='$userId';";
$resultSet= mysqli_query($conn, $sql);
        $affectedRows= mysqli_affected_rows($conn);
        if($affectedRows > 0){
            echo " Successfully Updated user";

            $sql1 = "UPDATE doctor SET specialization='$specialization', degree='$degree', availabilityTime='$availabilityTime', status='$status'  WHERE doctorId='$doctorId';";
            $resultSet2= mysqli_query($conn, $sql1);
            $affectedRows2= mysqli_affected_rows($conn);
            if($affectedRows2 > 0){
                echo " Successfully Updated doctor";
            }
        }
mysqli_close($conn);
}catch(Exception $e){
    echo $e;
}

?>