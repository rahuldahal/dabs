<?php
include(dirname(__DIR__)."/includes/header.php");
session_start();
if(count($_SESSION)==0){
  header('Location: /dabs/index.php');
  exit();
}
?>

<title>Admin Dashboard</title>
</head>
<body>
<h1><?php echo $_SESSION['firstName']."'s"; ?> Dashboard</h1>

<nav>
    <li>
        <a href="addDoctor.php">Add Doctor</a>
    </li>
    <li>
        <a href="editDoctor.php">Update Doctor</a>
    </li>
    <li>
        <a href="../admin/viewAppointment.php">Appointment Details</a>
    </li>

</nav>