<?php
include(dirname(__DIR__).'/includes/connection.php');
session_start();
if(count($_SESSION)==0){
    header('Location: /dabs/admin.php');
    exit();
}

if (!isset($_GET["doctorUpdateDetails"])) {
    die("Empty Data");
}

$doctorId = $_GET['doctorId'];
$sql = "SELECT * FROM (user INNER JOIN doctor ON user.userId = doctor.userId) WHERE doctorId = '$doctorId'; ";
$resultSet = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($resultSet);
$doctorDetails = array();

if($numRows > 0){
    $doctorDetails = mysqli_fetch_assoc($resultSet);
    // while($row = mysqli_fetch_assoc($resultSet)){
    //     array_push($doctorDetails, $row);
    // }
    // print_r($doctorDetails);
    // exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Doctor's Appoint Booking Management System</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300,500,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="signup">
				<form action="../admin/updateDoctor.php" method="POST">
					<label class="signupTitle" for="chk" aria-hidden="true">Update</label>

					<div class="fields multiStepForm">
                        <div class="steps">
                        <div data-step="one">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" placeholder="Hari" value="<?php echo $doctorDetails['firstName']; ?>" required />
                            
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="middleName" placeholder="Prasad" value="<?php echo $doctorDetails['middleName']; ?>" required />

                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" placeholder="Bastola" value="<?php echo $doctorDetails['lastName']; ?>" required />
                        </div>

                        <div data-step="two">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" >
                                <option value="male" <?php if($doctorDetails['gender'] == "male") echo "selected"?>>Male</option>
                                <option value="female" <?php if($doctorDetails['gender'] == "female") echo "selected"?>>Female</option>
                                <option value="others" <?php if($doctorDetails['gender'] == "others") echo "selected"?>>Others</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="<?php echo $doctorDetails['dob']; ?>" />
                            <br/>

                            <label for="bloodGroup">Blood Group</label>
                            <select name="bloodGroup" id="bloodGroup">
                                <option value="A+" <?php if($doctorDetails['bloodGroup'] == "A+") echo "selected"?>>A+</option>
                                <option value="A-" <?php if($doctorDetails['bloodGroup'] == "A-") echo "selected"?>>A-</option>
                                <option value="B+" <?php if($doctorDetails['bloodGroup'] == "B+") echo "selected"?>>B+</option>
                                <option value="B-" <?php if($doctorDetails['bloodGroup'] == "B-") echo "selected"?>>B-</option>
                                <option value="O+" <?php if($doctorDetails['bloodGroup'] == "O+") echo "selected"?>>O+</option>
                                <option value="O-" <?php if($doctorDetails['bloodGroup'] == "O-") echo "selected"?>>O-</option>
                                <option value="AB+" <?php if($doctorDetails['bloodGroup'] == "AB+") echo "selected"?>>AB+</option>
                                <option value="AB-" <?php if($doctorDetails['bloodGroup'] == "AB-") echo "selected"?>>AB-</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="maritalStatus">Marital Status</label>
                            <select name="maritalStatus" id="maritalStatus" value="<?php echo $doctorDetails['maritalStatus']; ?>">
                                <option value="single" <?php if($doctorDetails['maritalStatus'] == "single") echo "selected"?>>single</option>
                                <option value="married" <?php if($doctorDetails['maritalStatus'] == "married") echo "selected"?>>married</option>
                                <option value="divorced" <?php if($doctorDetails['maritalStatus'] == "divorced") echo "selected"?>>divorced</option>
                            </select>    
                            <br/>
                            <br/>                        
                        </div>
                        
                        <div data-step="three">
                        <label for="specialization">Specialization</label>
                            <select name="specialization" id="specialization" value="<?php echo $doctorDetails['specialization']; ?>">
                                //Pediatrician', 'Neurologist', 'Dermatologist', 'Anesthesiologist', 'Psychiatrist
                                <option value="Pediatrician" <?php if($doctorDetails['specialization'] == "Pediatrician") echo "selected"?>>Pediatrician</option>
                                <option value="Neurologist" <?php if($doctorDetails['specialization'] == "Neurologist") echo "selected"?>>Neurologist</option>
                                <option value="Dermatologist" <?php if($doctorDetails['specialization'] == "Dermatologist") echo "selected"?>>Dermatologist</option>
                                <option value="Anesthesiologist" <?php if($doctorDetails['specialization'] == "Anesthesiologist") echo "selected"?>>Anesthesiologist</option>
                                <option value="Psychiatrist" <?php if($doctorDetails['specialization'] == "Psychiatrist") echo "selected"?>>Psychiatrist</option>
                                <option value="Gynecologist" <?php if($doctorDetails['specialization'] == "Gynecologist") echo "selected"?>>Gynecologist</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="degree">Degree</label>
                            <select name="degree" id="degree" value="<?php echo $doctorDetails['degree']; ?>">
                                <option value="MBBS" <?php if($doctorDetails['degree'] == "MMBS") echo "selected"?>>MBBS</option>
                                <option value="MD" <?php if($doctorDetails['degree'] == "MD") echo "selected"?>>MD</option>
                                <option value="DM" <?php if($doctorDetails['degree'] == "DM") echo "selected"?>>DM</option>
                                <option value="DNB" <?php if($doctorDetails['degree'] == "DNB") echo "selected"?>>DNB</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="availabilityTime">Available Time</label>
                            <input type="text" id="availabilityTime" name="availabilityTime" placeholder="" value="<?php echo $doctorDetails['availabilityTime']; ?>" required>
                        </div>

                        <div data-step="four">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="name@domain.com" value="<?php echo $doctorDetails['email']; ?>" required>
                        </div>

                        <div data-step="five">

                            <label for="status">Status</label>
                            <input type="status" id="status" name="status" placeholder="status" value="<?php echo $doctorDetails['status']; ?>" required />
                        </div>
                        </div>

                        <input type="number" hidden name="doctorId" value="<?php echo $doctorId; ?>">

                        <!-- <button data-button-action="previous">Previous</button>
                        <button data-button-action="next">Next</button> -->

                        <input type="submit" name="doctorUpdateDetails" value="Update" />
                    </div>
				</form>
			</div>
</body>
</html>

<!-- <select name="gender" id="gender" value=" -->
<?php 
// echo $doctorDetails['gender']; 
?>
<!-- "> -->
