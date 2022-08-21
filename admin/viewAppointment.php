<?php
include(dirname(__DIR__).'/includes/connection.php');
include(dirname(__DIR__)."/includes/header.php");
include(dirname(__DIR__)."/includes/adminHeader.php");
include (dirname(__DIR__).'/includes/adminAuthentication');

?>

<html>
    <table>
        <tr>
            <th>UserId</th>
            <th>DoctorId</th>
            <th>AppointmentId</th>
            <th>Reason</th>
            <th>Date</th>
            <th>Time</th>
            <th>Token</th>
            <th>Status</th> 
            <th>Action</th>
        </tr>

<?php
$sql = "SELECT * FROM appointment ORDER BY date DESC;";
// $sql = "SELECT * FROM appointment;";
$resultSet = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($resultSet);
$appointmentId;
$appointmentStatus;
if($numRows > 0){
    $data= array();
    while($row = mysqli_fetch_assoc($resultSet)){
        // array_push($data, $row);
        $appointmentId = $row['appointmentId'];
        $appointmentStatus = $row['status'];
        echo "<tr>";
        // echo "<td>".$row['doctor_id']."</td>";
        echo "<td>".$row['userId']."</td>";
        echo "<td>".$row['doctorId']."</td>";
        echo "<td>".$row['appointmentId']."<td/>";
        echo "<td>".$row['reason']."</td>";
        echo "<td>".$row['date']."</td>";
        echo "<td>".$row['timeSlot']."</td>";
        echo "<td>".$row['token']."</td>";
        echo "<td>".$row['status']."</td>"; 
        
        // echo "<td>".$row['fee']."</td>";
        echo "<td> 
            <form action=\"updateAppointmentStatus.php\">
                <input type='hidden' name='appointmentId' value='$appointmentId' >
                <input type='hidden' id='appointmentStatus' name='appointmentStatus' value='$appointmentStatus' >
                <button type='submit' id='updateToApproved' name='submit' value='approve' style='color:#000;'>Approve</button>
                <button type='submit' id='updateToDeclined' name='submit' value='decline' style='color:#000;'>Decline</button>
            </form>
            </td>";	
        // <input type=\"submit\" name=\"doctorUpdateDetails\" value=\"Update\" />	
		echo "</tr>";
    }
}
?>

</table>

<script src="/dabs/js/appointmentStatus.js"></script>