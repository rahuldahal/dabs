<?php
    include(dirname(__DIR__).'/dabs/includes/connection.php');

    $doctorId = $_GET['doctorId'];

    $sql = "SELECT slots FROM doctorschedule WHERE doctorId='$doctorId';";
    $resultSet = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $doctorSlots= array();
    $numRows = mysqli_num_rows($resultSet);
        if($numRows > 0){
            while($row = mysqli_fetch_assoc($resultSet)){
                array_push($doctorSlots, $row);
            }
        }

    $slot;
    foreach($doctorSlots as $doctorSlot){
        foreach($doctorSlot as $slots){
            $slot = json_decode($slots, false);
        }
        // echo "<br/>";
    }

    $free_slots = array();

    foreach($slot as $time){
        // $time appointment ko timeSlot sanga compare garnu paryo
        $timeSlotExits= in_array($time, $slotsBooked);
        if(!$timeSlotExits){
            array_push($time, $free_slots);
        }
    }

    $data = json_encode(["free_time_slots"=>$free_slots]);
    
    header('Content-Type: application/json; charset=utf-8');
    echo $data;
?>