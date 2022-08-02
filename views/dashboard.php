<?php
include(dirname(__DIR__) . "/includes/connection.php");
include(dirname(__DIR__) . "/includes/header.php");
session_start();
if (count($_SESSION) == 0) {
  header('Location: /dabs/index.php');
  exit();
}
?>

<?php
$specialityQuery = "SELECT DISTINCT specialization FROM doctor";
$resultSet = mysqli_query($conn, $specialityQuery);
$numRows = mysqli_num_rows($resultSet);
$specializations = array();

if ($numRows > 0) {
  while ($row = mysqli_fetch_assoc($resultSet)) {
    array_push($specializations, $row["specialization"]);
  }
}
?>

<title>Dashboard</title>

</head>

<body>
  <h1><?php echo $_SESSION['firstName'] . "'s"; ?> Dashboard</h1>
  <div class="tabs">
    <div class="tab-2">
      <label for="tab2-1" class="tabLabel">Appointments</label>
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
      <label for="tab2-2" class="tabLabel">New</label>
      <input id="tab2-2" name="tabs-two" type="radio">
      <div>
        <h4>Book a new appointment</h4>
        <form action="../auth/requestForAppointment.php" method="POST">
          <div class="appointmentFormFields">
            <div class="doctorDetails">
              <div class="formField">
                <label for="specialization">Doctor's Specialization</label>
                <select name="specialization" id="specialization">
                  <option value="">Select from dropdown</option>
                  <?php
                  foreach ($specializations as $specialization) {
                    echo "<option value=\"$specialization\">$specialization</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="formField">
                <label for="doctor">Doctor</label>
                <select disabled name="doctorId" id="doctor">
                  <option value="">Select The Specialization</option>
                </select>
              </div>

              <div class="formField">
                <label for="slot">Available Time Slot</label>
                <select disabled name="slotId" id="slot">
                  <option value="">Select The Doctor</option>
                </select>
              </div>
            </div>


            <div class="formField">
              <label for="reason">Reason</label>
              <textarea disabled name="reason" id="reason" cols="30" rows="10"></textarea>
            </div>
          </div>

          <input type="submit" name="appointmentDetails" value="Get Appointment">
        </form>
        <!-- <table>
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Specialization</th>
        <th>Degree</th>
        <th>Available Time</th>
        </tr>


// $sql = "SELECT * FROM (user INNER JOIN doctor ON user.userId = doctor.userId);";
// $resultSet = mysqli_query($conn, $sql);
// $numRows = mysqli_num_rows($resultSet);
// if($numRows > 0){
//     $data= array();
//     while($row = mysqli_fetch_assoc($resultSet)){
//         // array_push($data, $row);
//         echo "<tr>";
// 			// echo "<td>".$row['doctor_id']."</td>";
// 			echo "<td>".$row['firstName']."</td>";								
// 			echo "<td>".$row['lastName']."</td>";
// 			echo "<td>".$row['specialization']."</td>";
// 			echo "<td>".$row['degree']."</td>";
// 			echo "<td>".$row['availabilityTime']."</td>";
//       $doctorId = $row['doctorId'];
								
// 			// echo "<td>".$row['fee']."</td>";
//             // echo "<td><button type='submit' name='submit' style='color:#000;' onclick='getAppointment()'>Get Appointment</button></td>";		
//       echo "<td>
//           <form action=\"../auth/createAppointment.php\" method=\"POST\">
//           <input type=\"number\" hidden value=\"<?php $doctorId; ?>\">
//           <button type=\"submit\" name=\"submit\" style=\"color:#000;\">Get Appointment</button>
//           </form>
//           </td>";
//       echo "</tr>";
//     }
// }
?>

</table> -->
      </div>
    </div>
  </div>
  </form>

  <script src="/dabs/js/doctorInfo.js"></script>