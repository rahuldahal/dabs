<?php
include(dirname(__DIR__).'/includes/connection.php');
?>

<html>
    <table>
        <tr>
            <th>UserId</th>
            <th>DoctorId</th>
            <th>Reason</th>
            <th>Date</th>
            <th>Time</th>
            <th>Token</th>
            <th>Action</th>
        </tr>

<?php
$sql = "SELECT * FROM appointment;";
$resultSet = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($resultSet);
if($numRows > 0){
    $data= array();
    while($row = mysqli_fetch_assoc($resultSet)){
        // array_push($data, $row);
        echo "<tr>";
			// echo "<td>".$row['doctor_id']."</td>";
			echo "<td>".$row['userId']."</td>";
								
			echo "<td>".$row['doctorId']."</td>";
			echo "<td>".$row['reason']."</td>";
			echo "<td>".$row['date']."</td>";
			echo "<td>".$row['time']."</td>";
            echo "<td>".$row['token']."</td>";
								
			// echo "<td>".$row['fee']."</td>";
            echo "<td><button type='submit' name='submit' style='color:#000;'>Approve</button>
            <button type='submit' name='submit' style='color:#000;'>Decline</button></td>";		
		echo "</tr>";
    }
}
?>

</table>
