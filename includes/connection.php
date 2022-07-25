<?php
include('../constants/db.php');

$conn = mysqli_connect("localhost", "root", "", $db['name']);

if (!$conn) {
    die("cannot connect to db ".$db['name']."\n" . mysqli_connect_error($conn));
}
?>