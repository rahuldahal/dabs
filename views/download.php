<?php
include('../includes/connection.php');
    
if (!isset($_GET["download"])) {
    die($errorMessages["emptyData"]);
}   

$appointmentId= $_GET["appointmentId"];
$userId = $_GET["userId"];
$doctorId;

$getDoctorId = "SELECT doctorId FROM appointment WHERE appointmentId=$appointmentId AND userId=$userId;";
$resultSet = mysqli_query($conn, $getDoctorId);
          $numRows = mysqli_num_rows($resultSet);
          if($numRows > 0){
            $name = mysqli_fetch_assoc($resultSet);
            $doctorId= $name['doctorId'];
}

// echo $appointmentId." ".$userId." ".$doctorId;
// exit();


$getUser = "SELECT firstName, middleName, lastName, dob, gender FROM user WHERE userId=$userId";
$resultSet = mysqli_query($conn, $getUser);
          $numRows = mysqli_num_rows($resultSet);
          if($numRows > 0){
            $name = mysqli_fetch_assoc($resultSet);
            echo "<h2>Patient</h2>";
            echo "<p style=\"text-transform:capitalize;\">".$name['firstName']." ".$name['middleName']." ".$name['lastName']."</p>";

            //calculating age
            $dateOfBirth = $name['dob'];
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            echo "<p> Age: ". $diff->format('%y')."</p>";

            echo "<p style=\"text-transform:capitalize;\"> Gender: ".$name['gender']."</p>";
          }

$getDoctor = "SELECT firstName, middleName, lastName, specialization FROM (user INNER JOIN doctor ON user.userId = doctor.userId) WHERE doctorId=$doctorId;";
        $resultSet1 = mysqli_query($conn, $getDoctor);
          $numRows1 = mysqli_num_rows($resultSet1);
          if($numRows1 > 0){
            $name = mysqli_fetch_assoc($resultSet1);
            echo "<h2>Doctor</h2>";
            echo "<p style=\"text-transform:capitalize;\">".$name['firstName']." ".$name['middleName']." ".$name['lastName']."</p>";
            echo "<p style=\"text-transform:capitalize;\">".$name['specialization']."</p>";
          }  

$appointmentInfo = "SELECT * FROM appointment WHERE appointmentId=$appointmentId;";
$resultSet1 = mysqli_query($conn, $appointmentInfo);
          $numRows1 = mysqli_num_rows($resultSet1);
          if($numRows1 > 0){
            $name = mysqli_fetch_assoc($resultSet1);
            echo "<h2>Appointment Details</h2>";
            echo "<p style=\"text-transform:capitalize;\"> Appointment Id: ".$name['appointmentId']."</p>";
            echo "<p style=\"text-transform:capitalize;\"> Reason: ".$name['reason']."</p>";
            echo "<p style=\"text-transform:capitalize;\"> Date: ".$name['date']."</p>";
            echo "<p style=\"text-transform:capitalize;\"> TimeSlot: ".$name['timeSlot']."</p>";
            echo "<p style=\"text-transform:capitalize;\"> Token: ".$name['token']."</p>";
          }  
          echo "<button onclick= \"window.print();\"> Print </button>";
?>

