<?php
include('./includes/connection.php');
include('./includes/header.php');
?>

</head>
<body>
<main class="wrapper">
  <section class="cover">
    <div class="cover-left">
      <h1 class="tagline"><span class="opacity-8">Koshi Zonal Hospital's</span> Doctor Appointment Booking Management System</h1>
      <p class="subtitle">Making the appointment booking process quick, efficient and hassle free.</p>
      <a href="views/patientSignup.php" class="CTA">Sign up</a>
    </div>
    <div class="cover-img-container"><img class="cover-img" src="http://koshihospital.gov.np/wp-content/uploads/2020/04/koshi-hospital-covid-19-special-hospital.jpg" alt="Koshi Zonal Hospital - New Department"></div>
  </section>
  
</main>
<footer>
  <p class="copyright">Copyright @ Koshi Zonal Hospital <span id="year"></span> </p>
</footer>

<script>
    document.querySelector("#year").textContent = new Date().getFullYear();
</script>
</body>
</html>