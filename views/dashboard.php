<?php
include(dirname(__DIR__)."/includes/connection.php");
include(dirname(__DIR__)."/includes/header.php");
session_start();
if(count($_SESSION)==0){
  header('Location: /dabs/index.php');
  exit();
}
?>

<title>Dashboard</title>

</head>
<body>
<h1><?php echo $_SESSION['firstName']."'s";?> Dashboard</h1>
<div class="tabs">
  <div class="tab-2">
    <label for="tab2-1">Appointments</label>
    <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
    <div>
      <h4>Appointments you've booked</h4>
        <ul>
            <li>Appointment One</li>
            <li>Appontment Two</li>
            <li>Appointment Three</li>
        </ul>
    </div>
  </div>
  <div class="tab-2">
    <label for="tab2-2">New</label>
    <input id="tab2-2" name="tabs-two" type="radio">
    <div>
      <h4>Book a new appointment</h4>
      <form action="../auth/createAppointment.php" method="POST">
      <!-- <form action="../auth/createAppointment.php" method="POST">
          <label for="reason">Reason</label>
          <textarea name="reason" id="reason" cols="30" rows="10"></textarea>
          
          <label for="doctor">Doctor</label>
          <select name="doctor" id="doctor">
              <option value="DoctorOne">Doctor One</option>
              <option value="DoctorTwo">Doctor Two</option>
              <option value="DoctorThree">Doctor Three</option>
          </select>

          <input type="submit" name="appointmentDetails" value="Get Appointment">
      </form> -->
    <table>
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialization</th>
        <th>Degree</th>
        <th>Available Time</th>
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
      $doctorId = $row['doctorId'];
								
			// echo "<td>".$row['fee']."</td>";
            // echo "<td><button type='submit' name='submit' style='color:#000;' onclick='getAppointment()'>Get Appointment</button></td>";		
      echo "<td>
              <form action=\"../auth/createAppointment.php\" method=\"POST\">
                <input type=\"number\" hidden value='".$doctorId."'>
                <textarea name=\"reason\" id=\"\" cols=\"30\" rows=\"10\"></textarea>
                <button type=\"submit\" name=\"submit\" style=\"color:#000;\">Get Appointment</button>
              </form>
          </td>";
      echo "</tr>";
    }
}
?>

</table>
    </div>
  </div>
</div>
</form>
<!-- <script>
  function getAppointment(){
    document.location.href="../auth/createAppointment.php";
  }
</script> -->