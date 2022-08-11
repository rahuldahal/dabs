<?php 
include(dirname(__DIR__) . "/includes/connection.php");


    $specialization = $_GET['specialization'];
    $date = $_GET['date'];

    $sql = "SELECT doctor.doctorId, user.firstName, user.middleName, user.lastName FROM doctor INNER JOIN user ON doctor.userId = user.userId WHERE specialization='$specialization'";

    $resultSet = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($resultSet);

    $doctors = array();

    if ($numRows > 0) {
    while ($row = mysqli_fetch_assoc($resultSet)) {
        $doctorId= $row['doctorId'];
        $daysOff = "SELECT daysOff FROM doctorschedule WHERE doctorId='$doctorId'";
        
        $resultSet1 = mysqli_query($conn, $daysOff);
        $numRows1 = mysqli_num_rows($resultSet1);

        $onLeave = false;

        if($numRows1 > 0){
            $leaves =json_decode(mysqli_fetch_assoc($resultSet1)['daysOff']);

            $today = date('Y-m-d');                                                                     

            $onLeave = in_array($today, $leaves);
        }
        
        if(!$onLeave){
            array_push($doctors, $row);
        }
    }
    }

    $json = json_encode($doctors);

    header('Content-Type: application/json; charset=utf-8');
    echo $json;