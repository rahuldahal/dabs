<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__)."/includes/header.php");
include(dirname(__DIR__)."/includes/adminHeader.php");
include (dirname(__DIR__).'/includes/adminAuthentication');
?>

<html>
<h2 class= "tableTitle">Doctor Details</h2>
    <table>
        <tr>
        <th>First Name</th>
        <th>Middle Name </th>
        <th>Last Name</th>
        <th>Specialization</th>
        <th>Degree</th>
        <th>Available Time</th>
        <th>Status</th>
        <th>Action</th>
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
			echo "<td>".$row['middleName']."</td>";							
			echo "<td>".$row['lastName']."</td>";
			echo "<td>".$row['specialization']."</td>";
			echo "<td>".$row['degree']."</td>";
			echo "<td>".$row['availabilityTime']."</td>";
            echo "<td>".$row['status']."</td>";								
			// echo "<td>".$row['fee']."</td>";3
            $doctorId = $row['doctorId'];
            echo "<td> 
            <form action=\"../views/editDoctor.php\">
                <input type=\"hidden\" name=\"doctorId\" value=\"$doctorId\" /> 
                <input type=\"submit\" name=\"doctorUpdateDetails\" value=\"Update\" />
            </form>
            </td>";		
            echo "</tr>";
        }
    }
    ?>
    <!-- echo "<td><input hidden type='number' name='doctorId' " -->
    
</table>
