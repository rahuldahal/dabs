<?php 
include(dirname(__DIR__) . "/includes/connection.php");


    $specialization = $_GET['specialization'];

    $sql = "SELECT doctor.doctorId, user.firstName, user.middleName, user.lastName FROM doctor INNER JOIN user ON doctor.userId = user.userId WHERE specialization='$specialization'";

    $resultSet = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($resultSet);

    $doctors = array();

    if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($resultSet)) {
        array_push($doctors, $row);
    }
    }

    $json = json_encode($doctors);

    header('Content-Type: application/json; charset=utf-8');
    echo $json;
