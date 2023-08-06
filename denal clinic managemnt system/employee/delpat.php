<?php
  include('db.php');
  $adviceid = $_GET['id'];
  $result = mysqli_query($conn, "DELETE FROM registor_patient WHERE id = '$adviceid'");
  if ($result) {
    echo "Advice deleted successfully.";
    header('location:board.php');
  } else {
    echo "Error deleting advice.";
  }
?>



