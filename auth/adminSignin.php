<?php

session_start();
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__).'/constants/regex.php');
include(dirname(__DIR__).'/constants/validation.php');

if (!isset($_POST["adminSigninDetails"])) {
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


$sql= "SELECT * FROM admin WHERE email='$email' AND password='$hashedPassword'";
$resultSet= mysqli_query($conn, $sql);
$numRows= mysqli_num_rows($resultSet);
if($numRows>0){
    $row = mysqli_fetch_assoc($resultSet);
    print_r($row);
    $_SESSION['firstName']= $row['firstName'];
    $_SESSION['email']= $email;
    echo $_SESSION['firstName'];
    header('Location: /dabs/views/adminDashboard.php');
    exit();
}

mysqli_close($conn);

?>