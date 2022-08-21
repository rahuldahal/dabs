<?php
    include('../includes/connection.php');
    $doctorId = $_GET['doctorId'];
    $date = $_GET['date'];
    
    $sql= "SELECT * FROM appointment WHERE date ='$date' AND doctorId = '$doctorId' AND (status = 'Pending' OR status = 'Approved');";
    $resultSet = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($resultSet);
    $slotsBooked = array();
    if($numRows > 0){
        while($rows = mysqli_fetch_assoc($resultSet)){
            array_push($slotsBooked, $rows['timeSlot']); 
        }
        // print_r($slotsBooked);
        // exit();
    }

    $sql1 = "SELECT slots FROM doctorschedule WHERE doctorId='$doctorId';";
    $resultSet1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
    $numRows1 = mysqli_num_rows($resultSet1);

    $doctorSlots= json_decode(mysqli_fetch_assoc($resultSet1)['slots']);

    $availableSlots = array();
    foreach($doctorSlots as $time){
        // $time appointment ko timeSlot sanga compare garnu paryo
        $isSlotBooked = in_array($time, $slotsBooked);
        if(!$isSlotBooked){
            array_push($availableSlots, $time);
        }
    }

    $data = json_encode(["availableSlots"=>$availableSlots]);
    
    header('Content-Type: application/json; charset=utf-8');
    echo $data;
    
    // $slot;
    // foreach($doctorSlots as $doctorSlot){
    //     foreach($doctorSlot as $slots){
    //         $slot = json_decode($slots, false);
    //     }
    //     // echo "<br/>";
    // }
    
    // $free_slots = array();
    // foreach($slot as $time){
    //     // $time appointment ko timeSlot sanga compare garnu paryo
    //     $timeSlotExits= in_array($time, $slotsBooked);
    //     if(!$timeSlotExits){
    //         array_push($time, $free_slots);
    //     }
    // }

    

exit();
