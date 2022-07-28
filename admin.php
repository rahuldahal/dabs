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
				<form action="auth/adminSignin.php" method="POST">
					<label class="signinTitle" for="chk" aria-hidden="true">Sign In</label>
					<div class="fields">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="name@domain.com" required>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="password" required>
                        <input type="submit" name="adminSigninDetails" value="Sign In" />
                    </div>
				</form>
			</div>
	</div>
</body>
</html>