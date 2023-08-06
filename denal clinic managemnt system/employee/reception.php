<!DOCTYPE html>
<html>
  <head>
    <body>
    <?php include('repheader.php')?>
    <main>
      <div class="card-container">
  <div class="card">
  <?php
// Connect to the database
include_once 'db.php';

// Build the SQL query to count the number of patients
$sql = "SELECT COUNT(*) as count FROM approve_patient";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
  // Get the number of patients
  $row = mysqli_fetch_assoc($result);
  $count = $row['count'];

  // Output the number of patients
  echo '<img src="images/woman-suffering-from-hard-diseas.png" width="90px">';
  echo '<div class="num">';
  echo '<h2>Patients</h2>';
  echo '<p>' . $count . '</p>';
  echo '</div>';
}
?>

</div>
  <div class="card">  
  <?php
include_once('db.php');

// Get the current date
$date = date('Y-m-d');

// Prepare a SQL statement to count the number of appointments for the current date
$stmt = $conn->prepare('SELECT COUNT(*) FROM appointment WHERE preferred_date = ?');
$stmt->bind_param('s', $date);
$stmt->execute();
$stmt->bind_result($num_appointments);
$stmt->fetch();

// Close the database connection
$stmt->close();
$conn->close();

// Display the number of appointments for the current date
echo '<div class="row">';
echo '<img src="images/health-care-professional-vector.png" width="90px">';
echo '<div class="num">';
echo '<h2>Appointments</h2>';
echo '<p>' . $num_appointments . '</p>';
echo '</div>';
echo '</div>';
?> 
    </main>
  </body>
</html>