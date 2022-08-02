<?php
    include(dirname(__DIR__).'/includes/connection.php');

if (!isset($_POST["doctorRemoveDetails"])) {
        die($errorMessages["emptyData"]);
}

$doctorDetails = $_POST;

$userId = $doctorDetails['userId'];
$query = "SELECT userId FROM user WHERE userId= '$userId';";
$resultSet = mysqli_query($conn, $query);
$emailExists = mysqli_num_rows($resultSet);
if($emailExists == 0){
    array_push($errors, "user ".$errorMessages['notInTable']);
}

$doctorId = $doctorDetails['doctorId'];
$query = "SELECT doctorId FROM doctor WHERE doctorId= '$doctorId';";
$resultSet = mysqli_query($conn, $query);
$emailExists = mysqli_num_rows($resultSet);
if($emailExists == 0){
    array_push($errors, "doctor ".$errorMessages['notInTable']);
}

// $sql = "DELETE FROM doctor WHERE doctorId='$doctorId';";
// $resultSet= mysqli_query($conn, $sql);
//         $affectedRows= mysqli_affected_rows($conn);
//         if($affectedRows > 0){
//             echo " Successfully removed doctor";

//             $sql1 = "DELETE FROM user WHERE userId='$userId';";
//             $resultSet2= mysqli_query($conn, $sql1);
//             $affectedRows2= mysqli_affected_rows($conn);
//             if($affectedRows2 > 0){
//                 echo " Successfully removed user";
//             }
//         }

$sql = "UPDATE doctor SET status='N/A' WHERE doctorId='$doctorId';";
$resultSet= mysqli_query($conn, $sql);
        $affectedRows= mysqli_affected_rows($conn);
        if($affectedRows > 0){
            echo " Successfully updated doctor";

            $sql1 = "DELETE FROM user WHERE userId='$userId';";
            $resultSet2= mysqli_query($conn, $sql1);
            $affectedRows2= mysqli_affected_rows($conn);
            if($affectedRows2 > 0){
                echo " Successfully removed user";
            }
        }
mysqli_close($conn);

?>