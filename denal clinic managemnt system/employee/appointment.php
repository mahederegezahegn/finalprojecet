<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Employee Page</title>
    <!-- <link rel="stylesheet" href="css/edit.css"> -->
    <link rel="stylesheet" href="css/appoint.css">
  </head>
  <body>
    <?php 
    // session_start();
    include('repheader.php');?>
    <main>
    <section class="appont">
    <?php 
if(isset($_GET['msg'])){ ?>
  <h1 style="background-color: red; color: white; padding: 10px;">
    <?php echo $_GET['msg']; ?>
  </h1>
<?php }
else{
  include_once('db.php');

  if (isset($_POST['appoint'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reason = $_POST['reason'];
    $doctor = $_POST['doctor'];

    // Validate input fields
    $errors = array();
    if(empty($name)) {
      $errors[] = "Name is required";
    }
    if(empty($email)) {
      $errors[] = "Email is required";
    }
    if(empty($date)) {
      $errors[] = "Date is required";
    }
    if(empty($time)) {
      $errors[] = "Time is required";
    }
    if(empty($reason)) {
      $errors[] = "Reason is required";
    }
    if(empty($doctor)) {
      $errors[] = "Doctor is required";
    }

    // Check if the same date is already in the database and count the number of rows
    $sql = "SELECT COUNT(*) as count FROM appointment WHERE preferred_date = '$date'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
    
    if($count >= 20) {
      $errors[] = "The selected date already has 20 appointments";
    }

    // Check if the same input is already in the database
    $sql = "SELECT * FROM appointment WHERE email = '$email' AND preferred_date = '$date' AND preferred_time = '$time'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      $errors[] = "The appointment is already scheduled";
    }

    // Check if the selected date is at least a month after the user's latest appointment date
    $sql = "SELECT preferred_date FROM appointment WHERE email = '$email' ORDER BY preferred_date DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $latest_date = $row['preferred_date'];
    if(strtotime($date) < strtotime('+1 month', strtotime($latest_date))) {
      $errors[] = "Appointment date must be at least a month from your latest appointment";
    }

    // Insert data into database if there are no errors
    if(empty($errors)) {
      $sql = "INSERT INTO appointment (name, email, preferred_date, preferred_time, reason, doctor_id)
       VALUES ('$name', '$email', '$date', '$time', '$reason', '$doctor')";
      if(mysqli_query($conn, $sql)) {
        $msg="Appointment created successfully";
        header('location: appointment.php?msg=' . urlencode($msg));
      } else {
        $msg="Error creating appointment: " . mysqli_error($conn);
        header('location: appointment.php?msg=' . urlencode($msg));
      }
      mysqli_close($conn);
      exit;
    } else {
      // If there are errors, display them
      $msg = implode("<br>", $errors);
      header('location: appointment.php?msg=' . urlencode($msg));
      mysqli_close($conn);
      exit;
    }
  }

?>
     <h1>Make an Appointment</h1>
    <?php
  }
  ?> 
  <div id="progress-bar">
    <div id="progress-bar-inner"></div>
  </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit=" validateAndSubmit()">
     
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required><br><br>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br><br>
      <label for="date">Preferred Date:</label>
      <input type="date" id="date" name="date" min="<?= date('Y-m-d') ?>" required><br><br>

      <label for="time">Preferred Time:</label>
      <input type="time" id="time" name="time" min="02:00" max="17:00" required><br><br>

      <label for="doctor">Doctor:</label>
      <select id="doctor" name="doctor" required>
  <option value="">Select a doctor</option>
  <?php
   include_once 'db.php';
   $sql = "SELECT employee_id, first_name FROM employee WHERE job_title='Doctor'";
   $result = mysqli_query($conn, $sql);
   if (!$result) {
      echo "Error: " . mysqli_error($conn);
   } else {
      while($row = mysqli_fetch_assoc($result)):
?>
      <option value="<?php echo $row['employee_id']; ?>"><?php echo $row['first_name']; ?></option>
<?php 
      endwhile;
   }
?>
</select><br><br>

      <label for="reason">Reason for Visit:</label>
      <select id="reason" name="reason">
          <option value="checkup">Routine Checkup</option>
          <option value="cleaning">Teeth Cleaning</option>
          <option value="whitening">Teeth Whitening</option>
          <option value="filling">Filling or Crown</option>
          <option value="extraction">Tooth Extraction</option>
          <option value="other">Other</option>
      </select><br><br>
      <input type="submit" name="appoint" value="Submit">
    </form>
  </section>
<script>
  function validateForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let date = document.getElementById ("date").value;
    let time = document.getElementById("time").value;
    let errors = [];

    if(name == "") {
      errors.push("Name is required");
    }

    if (email == "") {
      errors.push("Email is required");
    } else if (!isValidEmail(email)) {
      errors.push("Invalid email format");
    }

    if (phone == "") {
      errors.push("Phone number is required");
    } else if (!isValidPhone(phone)) {
      errors.push("Invalid phone number format");
    }

    if (date == "") {
      errors.push("Date is required");
    }

    if (time == "") {
      errors.push("Time is required");
    }

    if (errors.length > 0) {
      alert(errors.join("\n"));
      return false;
    }

    return true;
  }

  function validateAndSubmit(event) {
    if (validateForm()) {
      showProgressBar('progress-bar-inner');
      return true;
    } else {
      event.preventDefault();
      return false;
    }
  }

  function isValidEmail(email) {
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
  }


  function validateAndSubmit(event) {
    if (validateForm()) {
      showProgressBar('progress-bar-inner');
      return true;
    } else {
      event.preventDefault();
      return false;
    }
  }


  function showProgressBar(progressBarId) {
      const progressBar = document.getElementById(progressBarId);
      progressBar.style.width = '0%';

      setTimeout(() => {
        progressBar.style.width = '50%';
      }, 500);

      setTimeout(() => {
        progressBar.style.width = '100%';
      }, 1000);
    }

    // showProgressBar('progress-bar-inner');
</script>
    </main>
  </body>
</html>