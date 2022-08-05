<?php
       function getTime($availabilityTime){
        $startingAndEndingTime = explode("-", $availabilityTime);
        $availabilityTime = array();
        foreach($startingAndEndingTime as $time){
        $hourAndMinute = explode(":", $time);
        // print_r($hourAndMinute);
        $hour = $hourAndMinute[0];
        $minute = $hourAndMinute[1];

        if($minute == 30){
            $time = $hour+0.5;
            array_push($availabilityTime, $time);
        }
        else{
            $time = $hour;
            array_push($availabilityTime, $time);
        }
            }
    $availabilityTime = implode(" ", $availabilityTime);
    // echo $availabilityTime;
    return($availabilityTime);
    }


    function getSlots($availabilityTime){
        $forSlots = explode(" ", $availabilityTime);

    // print_r($forSlots);
    $timeSlots= array();
    array_push($timeSlots, $forSlots[0]);
        while($forSlots[0] < $forSlots[1]-.5){
            $forSlots[0] = $forSlots[0]+.5;
            array_push($timeSlots, $forSlots[0]);
        }
    // print_r($timeSlots);
    // echo gettype($forSlots[0]);
    $slots = array();
   foreach($timeSlots as $interval){    
        $whole = intval($interval);
        $numberAfterDecimal = $interval-$whole;
        $endOfInterval = $whole+1;
        // echo $interval;
        // echo " ";
        // echo $endOfInterval = $interval+1;
        if($numberAfterDecimal == 0){
            $timeSlot=$interval.":00-".$interval.":30";
            // echo $timeSlot." ";
            array_push($slots, $timeSlot);
        }else{
            $timeSlot=$whole.":30-".$endOfInterval.":00";
            // echo $timeSlot." ";
            array_push($slots, $timeSlot);
        }
    }
        return($slots); //returns array of slots
    }
?>

<!--  $time = getTime("07:30-13:30");
echo $time;
$slots = getSlots($time); // array of slots
// print_r($slots);
    




echo "<label for=\"slot\">Available Time Slot</label>
                <select name=\"slotId\" id=\"slot\">
                  <option value=\"\">Select The Slot</option>";

                            for($i = 0 ; $i < count($slots) ; $i++){
                                $slot =  $slots[$i];
                                echo "<option value=\"$slot\">".$slot."</option>";
                                echo " ";
                            }

echo "</select>"; -->