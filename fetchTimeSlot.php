<?php
    include(dirname(__DIR__).'/dabs/includes/connection.php');

    $sql = "SELECT slots FROM doctorschedule;";
    $resultSet = mysqli_query($conn, $sql);
    $doctorSlots= array();
    $numRows = mysqli_num_rows($resultSet);
        if($numRows > 0){
            while($row = mysqli_fetch_assoc($resultSet)){
                array_push($doctorSlots, $row);
            }
        }
    
    foreach($doctorSlots as $doctorSlot){
        foreach($doctorSlot as $slots){
            // echo $slots;
            // echo gettype($slots);
            $slot = json_decode($slots, false);
            print_r($slot);
            echo "<br/>";
        }
        echo "<br/>";
    }

    

    // echo gettype($doctorSlots[0]['slots']);
    // exit();
    //     print_r($doctorSlots);
    //     // exit();
    // // $slot = json_decode($doctorSlots[0]['slots'], false);
    // echo gettype($slot);
    // print_r($slot);
?>