<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Doctor Page</title> -->
    <link rel="stylesheet" href="css/edit.css">

  </head>
  <body>
    <?php 
    include('adheader.php');
    ?>
    <main>
      <div class="tbl" id="comment">

<?php
include_once('db.php');
$sql = "SELECT comments.*, patients.first_name AS patient_name, patients.email AS patient_email
        FROM comments 
        INNER JOIN patients ON comments.patient_id = patients.id
        WHERE comments.approved = '0'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
  echo "<h1 class='heading'>Comments</h1>";
  echo "<table>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>id</th>";
  echo "<th>Client Name</th>";
  echo "<th>Email</th>";
  echo "<th>Comment</th>";
  echo "<th>Approve</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  while($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $client_name = $row['patient_name'];
    $client_email = $row['patient_email'];
    $comment = $row['text'];
    echo "<tr>";
    echo "<td>" . $id . "</td>";
    echo "<td>" . $client_name . "</td>";
    echo "<td>" . $client_email . "</td>";
    echo "<td>" . $comment . "</td>";
    echo "<td><button><a href='change.php?id=$id'>Approve</a></button></td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  mysqli_free_result($result);
} else {
  echo "No records found.";
} 
?>
</div>
<div class="tbl" id="comment">

<?php
include_once('db.php');
$sql = "SELECT * FROM doctor_advice";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo"<h1 class='heading'>Advice</h1>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>doctor_name</th>";
        echo "<th>Advice</th>";
        echo "<th>Date</th>";
        echo "<th>Approve</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = mysqli_fetch_array($result)){
            if($row['approved']==0){
                $id=$row['advice_id'];
                // Fetch the doctor name from the employee table
                $doctor_id = $row['doctor_id'];
                $sql_doctor = "SELECT first_name, last_name FROM employee WHERE employee_id=$doctor_id";
                $result_doctor = mysqli_query($conn, $sql_doctor);
                $row_doctor = mysqli_fetch_assoc($result_doctor);
                $doctor_name = $row_doctor['first_name'] . " " . $row_doctor['last_name'];
                // Display the data in the table
                echo "<tr>";
                echo "<td>" . $row['advice_id'] . "</td>";
                echo "<td>" . $doctor_name . "</td>";
                echo "<td>" . $row['advice'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<th><button><a href='aa.php?id=$id'>approve</a></button></th>";
                echo "</tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

?>
</div>

    </main>
  </body>
  <script src="js/show.js"></script>
</html>
