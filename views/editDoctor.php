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
    while($row = mysqli_fetch_assoc($resultSet)){
        array_push($doctorDetails, $row);
    }
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
                            <input type="text" id="firstName" name="firstName" placeholder="Hari" value="<?php echo $doctorDetails[0]['firstName']; ?>" required />
                            
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="middleName" placeholder="Prasad" value="<?php echo $doctorDetails[0]['middleName']; ?>" required />

                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" placeholder="Bastola" value="<?php echo $doctorDetails[0]['lastName']; ?>" required />
                        </div>

                        <div data-step="two">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" value="<?php echo $doctorDetails[0]['gender']; ?>">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="<?php echo $doctorDetails[0]['dob']; ?>" />
                            <br/>

                            <label for="bloodGroup">Blood Group</label>
                            <select name="bloodGroup" id="bloodGroup" value="<?php echo $doctorDetails[0]['bloodGroup']; ?>">
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="maritalStatus">Marital Status</label>
                            <select name="maritalStatus" id="maritalStatus" value="<?php echo $doctorDetails[0]['maritalStatus']; ?>">
                                <option value="single">single</option>
                                <option value="married">married</option>
                                <option value="divorced">divorced</option>
                            </select>    
                            <br/>
                            <br/>                        
                        </div>
                        
                        <div data-step="three">
                        <label for="specialization">Specialization</label>
                            <select name="specialization" id="specialization" value="<?php echo $doctorDetails[0]['specialization']; ?>">
                                //Pediatrician', 'Neurologist', 'Dermatologist', 'Anesthesiologist', 'Psychiatrist
                                <option value="Pediatrician">Pediatrician</option>
                                <option value="Neurologist">Neurologist</option>
                                <option value="Dermatologist">Dermatologist</option>
                                <option value="Anesthesiologist">Anesthesiologist</option>
                                <option value="Psychiatrist">Psychiatrist</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="degree">Degree</label>
                            <select name="degree" id="degree" value="<?php echo $doctorDetails[0]['degree']; ?>">
                                <option value="MBBS">MBBS</option>
                                <option value="MD">MD</option>
                                <option value="DM">DM</option>
                                <option value="DNB">DNB</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="availabilityTime">Available Time</label>
                            <input type="text" id="availabilityTime" name="availabilityTime" placeholder="" value="<?php echo $doctorDetails[0]['availabilityTime']; ?>" required>
                        </div>

                        <div data-step="four">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="name@domain.com" value="<?php echo $doctorDetails[0]['email']; ?>" required>
                        </div>

                        <div data-step="five">

                            <label for="status">Status</label>
                            <input type="status" id="status" name="status" placeholder="status" value="<?php echo $doctorDetails[0]['status']; ?>" required />
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