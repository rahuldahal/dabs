<?php
include(dirname(__DIR__)."/includes/header.php");
session_start();
if(count($_SESSION)==0){
  header('Location: /dabs/index.php');
  exit();
}
?>

<title>Dashboard</title>
</head>
<body>
<h1><?php echo $_SESSION['firstName']."'s"; ?> Dashboard</h1>

<div class="tabs">
  <div class="tab-2">
    <label for="tab2-1">Appointments</label>
    <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
    <div>
      <h4>Appointments you've booked</h4>
        <ul>
            <li>Appointment One</li>
            <li>Appontment Two</li>
            <li>Appointment Three</li>
        </ul>
    </div>
  </div>
  <div class="tab-2">
    <label for="tab2-2">New</label>
    <input id="tab2-2" name="tabs-two" type="radio">
    <div>
      <h4>Book a new appointment</h4>
      <form action="">
          <label for="reason">Reason</label>
          <textarea name="reason" id="reason" cols="30" rows="10"></textarea>
          
          <label for="doctor">Doctor</label>
          <select name="doctor" id="doctor">
              <option value="DoctorOne">Doctor One</option>
              <option value="DoctorTwo">Doctor Two</option>
              <option value="DoctorThree">Doctor Three</option>
          </select>
      </form>
    </div>
  </div>
</div>