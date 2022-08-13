<?php 
    include(dirname(__DIR__) . "/includes/connection.php");

    // if doctor ko field enabled cha bhane malai choose gareko doctor ko id chaiyo
    $doctorId = $_GET['doctorId'];

    $sql = "SELECT date FROM doctorSchedule WHERE doctorId='$doctorId';";

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
