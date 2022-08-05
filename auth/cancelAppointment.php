<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__).'/constants/db.php');
session_start();

if (!isset($_GET["cancelRequest"])) {
    die($errorMessages["emptyData"]);
}    

$appointmentId = $_GET["appointmentId"];
$status = "Cancelled";

$sql = "UPDATE appointment SET status = '$status' WHERE appointmentId= '$appointmentId';";
  $resultSet= mysqli_query($conn, $sql);
          $affectedRows= mysqli_affected_rows($conn);
          if($affectedRows > 0){
              echo " Successfully Updated appointment";
          }