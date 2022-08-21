<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__)."/includes/header.php");
include(dirname(__DIR__)."/includes/adminHeader.php");
include (dirname(__DIR__).'/includes/adminAuthentication');

  if(!isset($_GET['submit'])){
    die("Empty Data");
  }

  $appointmentId= $_GET['appointmentId'];
  $appointmentStatus= $_GET['appointmentStatus'];
  $status;

  if($_GET['submit'] == "approve" ){
    $status = "Approved";
  }else if($_GET['submit'] == "decline" ){
    $status = "Declined";
  }

  $sql = "UPDATE appointment SET status = '$status' WHERE appointmentId= '$appointmentId';";
  $resultSet= mysqli_query($conn, $sql);
          $affectedRows= mysqli_affected_rows($conn);
          if($affectedRows > 0){
              header('Location: ../views/adminDashboard.php');
          }