<?php
  include('db.php');
  $contactid = $_GET['id'];
  $result = mysqli_query($conn, "UPDATE contactus SET approve = 'true' WHERE contactid = '$contactid'");
  if ($result) {
    echo "Advice approved successfully.";
  } else {
    echo "Error approving advice.";
  }
?>