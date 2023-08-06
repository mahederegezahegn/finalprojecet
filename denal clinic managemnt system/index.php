<?php 
// require_once "db.php";
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentalClinic</title>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-qI6+6tV2qJW6vz6SW+L9tQw0J3fXzvz9j8Zg6gA5sQ4W9FZuKJm7YK7Bfj2Cs1tvE9NfJzJS7l+XN+uS3f+L9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
<body>
<!-- header start here -->
<header class="header fixed-top">
  <div class="container">
    <div class="row">
      <a href="#home" class="logo">Dental<span>care.</span></a>

      <nav class="nav">
        <a href="index.php">Home</a>
        <a href="#about">About</a>
        <a href="#services">Services</a>
        <a href="#reviews">Reviews</a>
        <a href="#advice">Advice</a>
        <a href="contact.php">Contact</a>
        <!-- <a href="profile.php" class="link">Profile</a> -->
      </nav>

      <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
</header>

<!-- header end here -->

<!--home section starts here-->
<section class="home" id="home">
  <div class="row contin">
    <div class="containt">
      <h3>let us brightn your smile</h3>
      <p>Welcome to our dental clinic website! We are dedicated to providing 
        high-quality dental care to our patients.  Please feel free to contact us if you have
          any questions or would like to schedule an appointment.</p>    <a href="appoint.php" class="link-btn">Make appointment</a>
    </div>
  </div>
</section>
<!--home section ends here-->

<!-- about section start  -->

<section class="about" id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-6 image">
        <img src="images/Nurse.png" class="w-100 mb-4 mb-md-0">
      </div>
      <div class="col-md-6 content">
        <span>About Us</span>
        <p>We are a dental clinic committed to providing high-quality dental care to our patients. Our mission is to help you achieve a healthy and beautiful smile that you can be proud of.</p> <br>
        <p>We offer a full range of dental services, including general dentistry, cosmetic dentistry, orthodontics, and more. Our team of experienced dentists and staff use the latest technology and techniques to ensure that you receive the best possible care.</p>
        
        <a href="appoint.php" class="link-btn">Make appointment</a>
      </div>
    </div>
  </div>
</section>
<!-- discount promotion -->
<section class="discount">
  <div class="container">
    <h2>Book Your Appointment Online and Get 10% Off!</h2>
    <p>Get a 10% discount on your appointment when you book through our website. Simply select your preferred date and time, and enter the promo code ONLINE10 at checkout to redeem your discount.</p>
    <a href="appoint.php" class="btn btn-book">Book Now</a>
  </div>
</section>

<!-- about section end  -->
<!--servixes section start -->
<section class="services" id="services">
  <h1 class="heading">our services</h1>
  <div class="box-container container">
  <?php
  include 'db.php';
  $sql = "SELECT * FROM service";
  $result = mysqli_query($conn, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='box'>";
      echo "<img src='admin/".$row['image']."' alt='".$row['name']."'>";
      echo "<div class='content'>";
      echo "<h3>".$row['name']."</h3>";
      echo "<p>".$row['description']."</p>";
      echo "<span class='price'>".$row['price']."Birr</span>";
      echo "</div>";
      echo "</div>";
    }
  } else {
    echo "No service found.";
  }
  mysqli_close($conn);
  ?>
</div>
  </div>
</section>

<!-- Services section end -->


<!--doctor section start-->
<section class="doctors" id="doctors">
<h1 class="heading">Ours Doctors </h1>

<div class="doctors-section">


<?php 
      include 'db.php';
      $sql = "SELECT * FROM employee";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            if ($row['job_title'] == 'Doctor' || $row['job_title'] == 'Nurse') {
              $name = $row['first_name'];
              $speciality = $row['speciality'];
              $image = $row['image'];
              echo "<div class='doctor-card'>";
              echo "<img src='admin/$image' alt='$name'>";
              echo "<h3>Dental Specialist</h3>";
              echo "<h2>$name $row[last_name]</h2>";
              echo "<p>$row[email]</p><br>";
              echo "<p>Speciality: $speciality</p>";
              echo "</div>"; 
          
            }
          }
          mysqli_free_result($result);
        } else{
          echo "No records matching your query were found.";
        }
      } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }
    ?>


</div>
</section>
<!--doctor section end-->


<!--kid section start-->
<section class="kids-dental" id="kids-dental">


  <div class="container">
    <h1 class="heading">Kids Dental Care</h1>
    <div class="box-container">
      <div class="box">
        <img src="images/dentist.png" alt="Illustration of a kid-friendly dental chair">
        <h2 class="box-heading">Child-Friendly Environment</h2>
        <p>Our clinic is designed to be a child-friendly environment, with colorful decorations, toys, and games to help kids feel comfortable and relaxed during their visit.</p>
      </div>
      <div class="box">
        <img src="images/doctor.png" alt="Illustration of a kid-friendly tooth">
        <h2 class="box-heading">Preventive Dental Care</h2>
        <p>We believe that prevention is the key to good dental health. That's why we offer a range of preventive dental services, including check-ups, cleanings, and fluoride treatments.</p>
      </div>
      <div class="box">
        <img src="images/medical.png" alt="Illustration of a kid-friendly dental x-ray">
        <h2 class="box-heading">Advanced Dental Care</h2>
        <p>In addition to preventive care, we also offer advanced dental services such as orthodontics and pediatric dentistry to help children maintain healthy and beautiful smiles.</p>
      </div>
    </div>
  </div>

</section>

<!--kid section end-->

<!--review section start-->

<section class="review" id="reviews">
  <h1 class="heading">satisfied clients</h1>
  <div class="box-container">
    <?php 
      include 'db.php';
      $sql = "SELECT comments.*, patients.first_name AS patient_name 
      FROM comments 
      INNER JOIN patients ON comments.patient_id = patients.id
      WHERE comments.approved = '1'
      ORDER BY comments.date DESC";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<div class='boxs'>";
    echo "<div class='top-row'>";
    echo "<div class='photo'>";
    echo "<img src='images/health-care-professional-vector.png' alt='Client Image'>";
    echo "</div>";
    echo "<div class='doctor-info'>";
    echo "<h3>" . $row['patient_name'] . "</h3>";
    echo "</div>";
    echo "</div>";
    echo "<div class='message'>";
    echo "<p>" . $row['text'] . "</p>";
    echo "<p>" . $row['date'] . "</p>";
    echo "</div>";
    echo "</div>";
  }
  mysqli_free_result($result);
} else {
  echo "No records matching your query were found.";
}
    ?>
  </div>
</section>
<!--review section end-->




<!--advice section start-->

<section class="doctors" id="advice">
  <div class="container">
  <h1 class="heading">Doctors Advice</h1>
  <div class="card-container">
    <?php 
        include 'db.php';
        $sql = "SELECT doctor_advice.*, employee.first_name AS doctor_name, employee.image
                FROM doctor_advice 
                INNER JOIN employee ON doctor_advice.doctor_id = employee.employee_id
                WHERE doctor_advice.approved != '0'
                ORDER BY doctor_advice.date DESC";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  $image=$row['image'];
                    echo "<div class='card'>";
                    echo "<div class='card-content'>";
                    echo "<div class='doctor-info'>";
                    echo "<img src='admin/$image' width='100px'><br>";
                    echo "<div class='doctor-details'>";
                    echo "<h3 class='doctor-name'>".$row['doctor_name']."</h3>";
                    echo "<p class='date'>".$row['date']."</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<p class='advice'>".$row['advice']."</p>";
                    echo "</div>";
                    echo "</div>";
                }
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    ?>
</div>
  </div>
</section>



<!--advice section end-->


<!--footer section start-->
<?php include('footer.php')?>
</body>
<script>
  // Select elements
const menuToggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('.nav');

// Add event listener to menu toggle button
menuToggle.addEventListener('click', function() {
  // Toggle active class on menu toggle button
  this.classList.toggle('active');
  // Toggle active class on navigation menu
  nav.classList.toggle('active');
});
</script>
</html>