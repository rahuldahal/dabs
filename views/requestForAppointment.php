<?php
include(dirname(__DIR__)."/includes/connection.php");
include(dirname(__DIR__)."/includes/header.php");
session_start();
if(count($_SESSION)==0){
  header('Location: /dabs/index.php');
  exit();
}
?>



<?php
$sql = "SELECT * FROM (user INNER JOIN doctor ON user.userId = doctor.userId);";
$resultSet = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($resultSet);
if($numRows > 0){
    $data= array();
    while($row = mysqli_fetch_assoc($resultSet)){
    //     // array_push($data, $row);
    //     echo "<tr>";
	// 		// echo "<td>".$row['doctor_id']."</td>";
	// 		echo "<td>".$row['firstName']."</td>";
								
	// 		echo "<td>".$row['lastName']."</td>";
	// 		echo "<td>".$row['specialization']."</td>";
	// 		echo "<td>".$row['degree']."</td>";
	// 		echo "<td>".$row['availabilityTime']."</td>";
								
	// 		// echo "<td>".$row['fee']."</td>";
    //         // echo "<td><button type='submit' name='submit' style='color:#000;' onclick='getAppointment()'>Get Appointment</button></td>";		
    //   echo "<td><button type='submit' name='submit' style='color:#000;'>Get Appointment</button></td>";
    //   echo "</tr>";
    $userId = $row['userId'];
    echo '<html>
    <body>
        <form action="../auth/createAppointment.php">
            <input type="number" name="userId" value="<?php echo $userId; ?>">
            <input type="submit" value="Get Appointment" name="appointmentDetails">
        </form>
    </body>
</html>';

    }
}
?>

<!-- // $userId= $appointmentDetails['userId'];
// $doctorId= $appointmentDetails['doctorId'];
// $reason= $appointmentDetails['reason'];
// $dateAndTime= $appointmentDetails['DateAndTime'];

// <html>
//     <body>
//         <form action="../auth/createAppointment.php">
//             <input type="number" name="userId" value="<? echo $userId ?>">
//             <input type="submit" value="Get Appointment" name="appointmentDetails">
//         </form>
//     </body>
// </html> -->