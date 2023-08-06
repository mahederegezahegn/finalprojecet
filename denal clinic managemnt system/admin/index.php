<?php 
// require_once "db.php";
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: adlogin.php");
exit;
}

// session
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="/css/ad.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">  </head>
  <body>
  <?php include_once 'adheader.php';?>
    <main>
 <div class="card-container">
  <div class="card">
  <?php
include('db.php');
$sql1 = "SELECT COUNT(*) AS num_patients FROM patients";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$num_patients1 = $row1['num_patients'];

$sql2 = "SELECT COUNT(*) AS num_patients_approved FROM approve_patient";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$num_patients2 = $row2['num_patients_approved'];

$num_patients = $num_patients1 + $num_patients2;
?>

<img src="images/woman-suffering-from-hard-diseas.png" width="90px">
<div class="num">
    <h2>Patients</h2>
    <p><?php echo $num_patients; ?></p>
</div>
  </div>
  <div class="card">
  <?php
include('db.php');
$sql = "SELECT COUNT(*) AS num_doctors FROM employee WHERE job_title = 'Doctor'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$num_doctors = $row['num_doctors'];
?>

<img src="images/health-care-professional-vector.png" width="90px">
<div class="num">
    <h2>doctor</h2>
    <p><?php echo $num_doctors; ?></p>
</div>
</div>
<div class="card">
  <?php
  include('db.php');
  
  // SQL query to count the number of doctors with job title 'Receptionist'
  $sql = "SELECT COUNT(*) AS num_doctors FROM employee WHERE job_title = 'Receptionist'";
  
  // Execute the SQL query and get the result set
  $result = mysqli_query($conn, $sql);
  
  // Fetch the row from the result set as an associative array
  $row = mysqli_fetch_assoc($result);
  
  // Get the value of the 'num_doctors' column from the row and store it in a variable
  $num_doctors = $row['num_doctors'];
  ?>

  <!-- Display the image, job title, and number of doctors -->
  <img src="images/health-care-professional-vector.png" width="90px">
  <div class="num">
    <h2>Receptionist</h2>
    <p><?php echo $num_doctors; ?></p>
  </div>
</div>
  <div class="card">
  <?php
include('db.php');
$sql = "SELECT COUNT(*) AS num_doctors FROM employee WHERE job_title = 'Nurse'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$num_doctors = $row['num_doctors'];
?>

<img src="images/health-care-professional-vector.png" width="90px">
<div class="num">
    <h2>Nurse</h2>
    <p><?php echo $num_doctors; ?></p>
</div>
</div>
</div>
    </main>
  </body>
</html>