<?php
  include('db.php');
  $adviceid = $_GET['id'];
  $result = mysqli_query($conn, "DELETE FROM admin WHERE admin_id = '$adviceid'");
  if ($result) {
    echo "Advice deleted successfully.";
    header('location:edit.php');
  } else {
    echo "Error deleting advice.".mysqli_error($conn);
  }
?>



