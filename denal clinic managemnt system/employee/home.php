<!DOCTYPE html>
<html>
  <head>
    <body>
    <?php include('docpheader.php')?>
    <main>
      <div class="card-container">
  <?php
  include_once 'db.php';
  $date = date('Y-m-d');
  $email = $_SESSION['user_name']; // Replace with your actual session variable name

  // Get the doctor's name from the employee table using their email
  $sql = "SELECT employee_id FROM employee WHERE email = '$email' AND job_title = 'Doctor'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $doctor_id = $row["employee_id"];
      }
  } else {
      echo" dont get the doctor".mysqli_error($conn);
  }
// Update the SQL query to include the doctor_name condition
  $sql = "SELECT COUNT(*) as count FROM appointment WHERE preferred_date = '$date' AND doctor_id= '$doctor_id'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $count = $row["count"];
      }
  } else {
      $count = 0;
  }
  
  $conn->close();
  ?>
  
  <div class="card">
    <img src="images/woman-suffering-from-hard-diseas.png" width="90px">
    <div class="num">
      <h2>appointment</h2>
      <p><?php echo $count; ?></p>
    </div>
  </div>
    <?php
  include('db.php');
$doctor_name = $_SESSION['user_name'];
$sql = "SELECT employee_id FROM employee WHERE email = '$doctor_name' AND job_title = 'Doctor'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctor_id = $row["employee_id"];
    }
} else {
    echo" dont get the doctor".mysqli_error($conn);
}
// Replace with your actual session variable name

// Count the number of advice rows for the doctor with the specified name
$sql = "SELECT COUNT(*) as count FROM doctor_advice WHERE doctor_id = '$doctor_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $count = $row["count"];
    }
} else {
    $count = 0;
}

$conn->close();
?>

<div class="card">
  <img src="images/flat-nurse-logo-collection_23-21.png" width="80px">
  <div class="num">
    <h2>advice</h2>
    <p><?php echo $count; ?></p>
  </div>
</div>
<?php
  include('db.php');
$doctor_name = $_SESSION['user_name'];
$sql = "SELECT first_name FROM employee WHERE email = '$doctor_name' AND job_title = 'Doctor'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctor_id = $row["first_name"];
    }
} else {
    echo" dont get the doctor".mysqli_error($conn);
}
// Replace with your actual session variable name

// Count the number of advice rows for the doctor with the specified name
$sql = "SELECT COUNT(*) as count FROM approve_patient WHERE doctor_name = '$doctor_id' and see=0 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $count = $row["count"];
    }
} else {
    $count = 0;
}

$conn->close();
?>

<div class="card">
  <img src="images/flat-nurse-logo-collection_23-21.png" width="80px">
  <div class="num">
    <h2>advice</h2>
    <p><?php echo $count; ?></p>
  </div>
</div>
</div>
</div>
    </main>
  </body>
 
</html>