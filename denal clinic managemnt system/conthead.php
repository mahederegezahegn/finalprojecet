<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DentalClinic</title>
    <link rel="stylesheet" href="css/ad.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style>
    /* Header */
.header {
  background-color: #fff;
  padding: 20px 0;
  z-index: 100;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
}
.row{display: flex;
justify-content: space-around;}
/* Logo */
.logo {
  font-size: 30px;
  font-weight: bold;
  color: #333;
  text-decoration: none;
}

.logo span {
  color: #f5475a;
}

/* Navigation */
.nav {
  margin-top: 10px;
}

.nav a {
  display: inline-block;
  margin-right: 20px;
  color: #333;
  text-decoration: none;
  transition: all 0.3s ease;
}

.nav a:hover {
  color: #f5475a;
}

/* Dropdown */
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-menu {
  display: none;
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 0;
  min-width: 120px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0,0,0,.2);
  padding: 10px 0;
}

.dropdown:hover .dropdown-menu {
  display: block;
}

.dropdown-menu a {
  color: #333;
  text-decoration: none;
  display: block;
  padding: 10px;
}

.dropdown-menu a:hover {
  background-color: #f5475a;
  color: #fff;
}

/* Menu toggle */
#menu {
  display: none;
}

/* Media queries */
@media screen and (max-width: 768px) {
  .nav {
    display: none;
  }

  #menu {
    display: block;
    cursor: pointer;
    font-size: 30px;
    color: #333;
  }

  .header.fixed-top {
    position: fixed;
  }

  .header .container {
    padding: 0 15px;
  }

  .header .row {
    align-items: center;
    justify-content: space-between;
  }

  .nav.active {
    display: block;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: #fff;
    padding: 20px 0;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    z-index: 99;
  }

  .nav.active a {
    display: block;
    margin: 10px 0;
  }
}
    </style>
<body>
<!-- header start here -->


<header class="header fixed-top">
<?php
session_start();

$username=$_SESSION['user_name'];
  
  ?>
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <a href="#home" class="logo">dental<span>care.</span></a>

            <nav class="nav">
                <a href="index.php">Home</a>
                <a href="appoint.php">Appointment</a>
                <a href="contact.php">Contact</a>
                <ul>
                <li class="dropdown">
          <a href="#">Profile</a>
          <ul class="dropdown-menu">
            <li><a href="#"><?php echo"$username"?></a></li>
            <li><a href="edit.php">Edit</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
                </ul>
            </nav>
            
                <div class="fa fa-bars" id="menu"></div>
        </div>
    </div>
</header>
<script>
  // Select elements
const menuToggle = document.querySelector('#menu');
const nav = document.querySelector('.nav');

// Add event listener to menu toggle button
menuToggle.addEventListener('click', function() {
  // Toggle active class on menu toggle button
  this.classList.toggle('fa-bars');
  this.classList.toggle('fa-times');
  // Toggle active class on navigation menu
  nav.classList.toggle('active');
});
</script>