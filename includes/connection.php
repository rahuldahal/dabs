<?php
$conn = mysqli_connect("localhost", "root", "", "summerproject");

if (!$conn) {
    die("cannot connect to db 'summerproject' \n" . mysqli_connect_error($conn));
}

echo ("Successfully connected to 'summerproject'");
?>