<?php 
  include('db.php');
  $adviceid = $_GET['id'];
  $result = mysqli_query($conn, "UPDATE doctor_advice SET approved = '1' WHERE advice_id = '$adviceid'");
  if ($result) {
    echo "Advice approved successfully.";
    header('location:dashboard.php');
  } else {
    echo "Error approving advice.";
  }
?>