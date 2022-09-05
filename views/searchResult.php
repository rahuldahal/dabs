<?php
include(dirname(__DIR__).'/includes/connection.php');

    $value = $_GET['search'];
    // echo $value;

    $sql = "SELECT * FROM user WHERE firstName, middleName, lastName LIKE '%a%';";
    $resultSet1 = mysqli_query($conn, $sql);
          $numRows1 = mysqli_num_rows($resultSet1);
          if($numRows1 > 0){
            $name = mysqli_fetch_assoc($resultSet1);
                echo $name['firstName']." ".$name['middleName']." ".$name['lastName'];
          }  