<?php
include(dirname(__DIR__).'/dabs/includes/connection.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Doctor's Appoint Booking Management System</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300,500,700&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signin">
				<form>
					<label class="signinTitle" for="chk" aria-hidden="true">Sign In</label>
					<div class="fields">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="name@domain.com" required>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="password" required>
                        <input type="submit" name="patientSigninDetails" value="Sign In" />
                    </div>
				</form>
			</div>
    
    <div class="signup">
				<form>
					<label class="signupTitle" for="chk" aria-hidden="true">Sign Up</label>

					<div class="fields multiStepForm">
                        <div class="steps">
                        <div data-step="one">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" placeholder="Saloni" required />
                            
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="middleName" placeholder="Saloni" required />

                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" placeholder="Saloni" required />
                        </div>

                        <div data-step="two">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>

                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob" />

                            <label for="bloodGroup">Blood Group</label>
                            <select name="bloodGroup" id="bloodGroup">
                                <!-- TODO: add blood group options -->
                                <option value="A+">Male</option>
                                <option value="A-">Female</option>
                                <option value="B+">Others</option>
                            </select>

                            <label for="maritalStatus">Marital Status</label>
                            <select name="maritalStatus" id="maritalStatus">
                                <!-- TODO: add marital status options -->
                                <option value="A+">Male</option>
                                <option value="A-">Female</option>
                                <option value="B+">Others</option>
                            </select>
                        </div>

                        <div data-step="three">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="name@domain.com" required>

                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="password" required />
                        </div>
                        </div>

                        <button data-button-action="previous">Previous</button>
                        <button data-button-action="next">Next</button>

                        <input hidden type="submit" name="patientSignupDetails" value="Sign Up" />
                    </div>
				</form>
			</div>
	</div>
</body>
</html>