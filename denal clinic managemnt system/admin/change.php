<?php
  include('db.php');
  $adviceid = $_GET['id'];
  $result = mysqli_query($conn, "UPDATE comments SET approved = '1' WHERE id = '$adviceid'");
  if ($result) {
    echo "Advice approved successfully.";
    header('location:dashboard.php');
  } else {
    echo "Error approving advice.";
  }
?>