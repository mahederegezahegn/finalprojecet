<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Doctor Page</title>
    <link rel="stylesheet" href="css/ad.css">
  </head>
  <body>
  <header>
    <nav>
      <div class="logo">
            <a href="#"><span>Doctor</span>.Page</a>
          </div>
       <div>
       <ul>
        <?php
        session_start();
  $username=$_SESSION['user_name'];
    // session_abort();
    ?>
          <li><a href="home.php">Home</a></li>
          <!-- <li><a href="#">About</a></li> -->
          <li class="dropdown">
            <a href="#">Profile</a>
            <ul class="dropdown-menu">
            <li><a href="#"><?php echo"$username"?></a></li>
              <li><a href="edit.php">Edit</a></li>
            <!-- <li><a href="addadmin.php">Add</a></li> -->
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
       </div>
  </nav>
  <div class="nav">
    <ul>
      <li><a href="contact.php">Advice</a></li>
      <li><a href="dashboard.php">Board</a></li>
      <li><a href="viewpat.php">view</a></li>
    </ul>
  </div>
   </header>