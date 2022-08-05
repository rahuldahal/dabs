<?php 
include(dirname(__DIR__) . "/includes/connection.php");


    $doctorId = $_GET['doctorId'];

    $sql = "SELECT date FROM appointment doctorId='$doctorId'";

    $resultSet = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($resultSet);

    $date = array();

    if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($resultSet)) {
        array_push($date, $row);
    }
    }

    $json = json_encode($date);

    header('Content-Type: application/json; charset=utf-8');
    echo $json;
