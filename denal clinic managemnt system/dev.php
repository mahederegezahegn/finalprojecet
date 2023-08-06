<!DOCTYPE html>
<html>
  <head>
    <title>Developer Team Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/style.css">
    
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-qI6+6tV2qJW6vz6SW+L9tQw0J3fXzvz9j8Zg6gA5sQ4W9FZuKJm7YK7Bfj2Cs1tvE9NfJzJS7l+XN+uS3f+L9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>

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
<main>
  <section id="about-us">
    <h2>About Us</h2>
    <div class="team">
      <div class="member">
        <img src="images/photo_3_2023-06-11_22-43-06.jpg" alt="Team Member 1">
        <h3>Nebiyu liul</h3>
        <p>Front-end Developer</p>
        <button class="contact-info" data-id="1001" data-phone="555-555-1234">View Contact Info</button>
        <div class="slide-down">
          <p>ID: 1203666</p>
          <p>Email:Nebiyuliul@gmail.com</p>
          <p>Phone: +251908190961</p>
        </div>
      </div>
      <div class="member">
        <img src="images/photo_2_2023-06-11_22-43-06.jpg" alt="Team Member 2">
        <h3>Semir Ibrahim</h3>
        <p>Back-end Developer</p>
        <button class="contact-info" data-id="1002" data-phone="555-555-5678">View Contact Info</button>
        <div class="slide-down">
          <p>ID: 1203684</p>
          <p>Email:semiribrahim@gmail.com</p>
          <p>Phone: +251970582776</p>
        </div>
      </div>
      <div class="member">
        <img src="images/photo_1_2023-06-11_22-43-05.jpg" alt="Team Member 3">
        <h3>Mahedere Gezahegn</h3>
        <p>Full-stack Developer</p>
        <button class="contact-info" data-id="1003" data-phone="555-555-9012">View Contact Info</button>
        <div class="slide-down">
          <p>ID: 1203619</p>
          <p>Email:MahedereGezaheng@gmail.com</p>
          <p>Phone: +251944394433</p>
        </div>
      </div>
    </div>
  </section>
</main>
 
<?php include('footer.php')?>
  </body>
  <script>
const contactInfoButtons = document.querySelectorAll('.contact-info');

contactInfoButtons.forEach(button => {
  button.addEventListener('click', () => {
    const slideDown = button.nextElementSibling;
    slideDown.classList.toggle('active');
  });
});
  </script>
</html>
