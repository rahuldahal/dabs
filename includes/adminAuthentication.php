<?php

session_start();
if(count($_SESSION)==0 || $_SESSION['role']!= "admin"){
    header('Location: /dabs/admin.php');
    exit();
}