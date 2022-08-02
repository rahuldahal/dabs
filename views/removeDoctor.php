<?php
include(dirname(__DIR__).'/includes/connection.php');
?>

<html>
    <table border="1px solid black">
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialization</th>
        <th>Degree</th>
        <th>Available Time</th>
        <th>Status</th>
        </tr>

<?php
$sql = "SELECT * FROM (user INNER JOIN doctor ON user.userId = doctor.userId);";
$resultSet = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($resultSet);
if($numRows > 0){
    $data= array();
    while($row = mysqli_fetch_assoc($resultSet)){
        // array_push($data, $row);
        echo "<tr>";
			// echo "<td>".$row['doctor_id']."</td>";
			echo "<td>".$row['firstName']."</td>";								
			echo "<td>".$row['lastName']."</td>";
			echo "<td>".$row['specialization']."</td>";
			echo "<td>".$row['degree']."</td>";
			echo "<td>".$row['availabilityTime']."</td>";
            echo "<td>".$row['status']."</td>";
								
			// echo "<td>".$row['fee']."</td>";
            echo "<td><button type='submit' name='submit' style='color:#000;'>Change Status</button></td>";		
		echo "</tr>";
    }
}
?>

</table>