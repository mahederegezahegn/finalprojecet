<?php
  include('db.php');
  $adviceid = $_GET['id'];
  $result = mysqli_query($conn, "DELETE FROM advice WHERE id = '$adviceid'");
  if ($result) {
    echo "Advice deleted successfully.";
    header('location:dashboard.php');
  } else {
    echo "Error deleting advice.";
  }
?>



