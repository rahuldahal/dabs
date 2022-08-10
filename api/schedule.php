<?php 
include(dirname(__DIR__) . "/includes/connection.php");


    $doctorId = $_GET['doctorId'];

    $sql = "SELECT timeSlot FROM appointment date='$date';";

    $resultSet = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($resultSet);

    $timeSlot = array();

    if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($resultSet)) {
        array_push($timeSlot, $row);
    }
    }

    $json = json_encode($timeSlot);

    header('Content-Type: application/json; charset=utf-8');
    echo $json;
