<?php
include('includes/connection.php');
?>

<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/s1.css">
</head>

<body>
    <div id="full">
        <div id="inner_full">

            <div id="header">
                <h2 align="center">Doctor's Appointment Booking System</h2>
            </div>

            <div id="body">
                <form action="" method="POST">
                    <table align="center">
                        <tr>
                            <td class="label"><label for="userName"> Username</label></td>
                            <td class="label"><input type="text" name="userName" id="userName" placeholder="Enter Username" class="formInput"></td>
                        </tr>

                        <tr>
                            <td class="label"><label for="password"></label>Password</td>
                            <td class="label"><input type="password" name="password" id="password" placeholder="Enter Password" class="formInput"></td>
                        </tr>

                        <tr>
                            <td><input type="submit" name="submit" value="Login" style="width:80px, height:120px;"></td>
                        </tr>
                    </table>
                </form>

            </div>

            <div id="footer">
                <h4 align="center">Copyright@myproject2022</h4>
            </div>
        </div>
    </div>

</body>

</html>