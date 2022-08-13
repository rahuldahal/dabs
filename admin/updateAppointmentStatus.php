<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__)."/includes/header.php");
session_start();
if(count($_SESSION)==0){
    header('Location: /dabs/admin.php');
    exit();
  }else if($_SESSION['email']!= "admin123@gmail.com"){
    header('Location: /dabs/admin.php');
    exit();
  }

  if(!isset($_GET['submit'])){
    die("Empty Data");
  }

  $appointmentId= $_GET['appointmentId'];
  $appointmentStatus= $_GET['appointmentStatus'];
  echo $appointmentId;
  echo $appointmentStatus;
  exit();
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
              echo " Successfully Updated appointment";
          }