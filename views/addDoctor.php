<?php
include(dirname(__DIR__).'/includes/connection.php');
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
				<form action="../auth/doctorSignup.php" method="POST">
					<label class="signupTitle" for="chk" aria-hidden="true">Sign Up</label>

					<div class="fields multiStepForm">
                        <div class="steps">
                        <div data-step="one">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" placeholder="Hari" required />
                            
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="middleName" placeholder="Prasad" required />

                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" placeholder="Bastola" required />
                        </div>

                        <div data-step="two">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" />
                            <br/>

                            <label for="bloodGroup">Blood Group</label>
                            <select name="bloodGroup" id="bloodGroup">
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
                            <select name="maritalStatus" id="maritalStatus">
                                <option value="single">single</option>
                                <option value="married">married</option>
                                <option value="divorced">divorced</option>
                            </select>   
                            <br/>   
                            <br/>                      
                        </div>
                        
                        <div data-step="three">
                        <label for="specialization">Specialization</label>
                            <select name="specialization" id="specialization">
                                //Pediatrician', 'Neurologist', 'Dermatologist', 'Anesthesiologist', 'Psychiatrist
                                <option value="Pediatrician">Pediatrician</option>
                                <option value="Neurologist">Neurologist</option>
                                <option value="Dermatologist">Dermatologist</option>
                                <option value="Gynecologist">Gynecologist</option>
                                <option value="Anesthesiologist">Anesthesiologist</option>
                                <option value="Psychiatrist">Psychiatrist</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="degree">Degree</label>
                            <select name="degree" id="degree">
                                <option value="MBBS">MBBS</option>
                                <option value="MD">MD</option>
                                <option value="DM">DM</option>
                                <option value="DNB">DNB</option>
                            </select>
                            <br/>
                            <br/>

                            <label for="availabilityTime">Available Time</label>
                            <input type="datetime-local" id="availabilityTime" name="availabilityTime" placeholder="name@domain.com" required>
                        </div>

                        <div data-step="four">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="name@domain.com" required>

                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="password" required />
                        </div>
                        </div>

                        <button data-button-action="previous">Previous</button>
                        <button data-button-action="next">Next</button>

                        <input hidden type="submit" name="doctorSignupDetails" value="Add" />
                    </div>
				</form>
			</div>
</body>
</html>