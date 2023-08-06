<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/edit.css">
  </head>
  <body>
    <?php include('docpheader.php');?>
    <main>
   <div id="employee" style="text-align:center; padding:1rem; margin:1rem;"> 
    <h1>Appointment of a day</h1>
    <?php
// Connect to the database
include 'db.php';
$email = $_SESSION['user_name'];

$usname=$_SESSION['user_name'];
$sqli = "SELECT employee_id FROM employee WHERE email = '$usname' AND job_title = 'Doctor'";
$result = $conn->query($sqli);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctor_id = $row["employee_id"];


$date = date('Y-m-d');
// Fetch all advice data from the database

$sql = "SELECT * FROM appointment where doctor_id='$doctor_id' and preferred_date='$date'";
$result = mysqli_query($conn, $sql);

// Check if there are any advice records
if (mysqli_num_rows($result) > 0) {
  // Output the table header
  echo '<table style="scale:1.4" >';
  echo '<thead>';
  echo '<tr>';
  echo '<th>ID</th>';
  echo '<th>Client Name</th>';
  echo '<th>Time</th>';
  echo '<th>Resone</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  // Loop through each advice record and output a table row
  while ($row = mysqli_fetch_assoc($result)) {
    $id=$row['appointment_id'];
    if($row['approve']==1){
    echo '<tr>';
    echo '<td>' . $row['appointment_id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['preferred_time'] . '</td>';
    echo '<td>' . $row['reason'] . '</td>';
    echo '</tr>';
  }
  }
  // Output the table footer
  echo '</tbody>';
  echo '</table>';
} else {
  // Output a message if there are no advice records
  echo 'No appointemnt today found.';
}
    }
  }
// Close the database connection
?>
    </div>

    <div id="employee" style="text-align:center"> 
    <h1>Advice</h1>
    <?php
// Connect to the database
include_once 'db.php';
$usname=$_SESSION['user_name'];
$sqli = "SELECT employee_id FROM employee WHERE email = '$usname' AND job_title = 'Doctor'";
$result = $conn->query($sqli);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctor_id = $row["employee_id"];
$sql = "SELECT * FROM doctor_advice where doctor_id='$doctor_id'";
$result = mysqli_query($conn, $sql);

// Check if there are any advice records
if (mysqli_num_rows($result) > 0) {
  // Output the table header
  echo '<table >';
  echo '<thead>';
  echo '<tr>';
  echo '<th>ID</th>';
  echo '<th>Comments</th>';
  echo '<th>Delete</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  // Loop through each advice record and output a table row
  while ($row = mysqli_fetch_assoc($result)) {
    $id=$row['advice_id'];
    echo '<tr>';
    echo '<td>' . $row['advice_id'] . '</td>';
    echo '<td>' . $row['advice'] . '</td>';
    echo "<th><button class='red'><a href='delad.php?id=$id'>delete</a></button></th>";
                
    echo '</tr>';
  }

  // Output the table footer
  echo '</tbody>';
  echo '</table>';
} else {
  // Output a message if there are no advice records
  echo 'No advicerecords found.';
}
    }
  }
// Close the database connection
mysqli_close($conn);
?>
    </div>
  
 
    
</div>
    </main>
  </body>
</html>