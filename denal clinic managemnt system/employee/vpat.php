<?php
// Get the ID and doctor name from the form data
$id = $_POST['id'];
$doctor = $_POST['doctor'];

include 'db.php';

// Update the doctor name in the approve_patient table
$sql = "UPDATE approve_patient SET doctor_name='$doctor' WHERE id=$id";

if (mysqli_query($conn,$sql)) {
  echo "Doctor updated successfully";
  header("location:search.php");
} else {
  echo "Error updating doctor: " .mysqli_error($conn);
}

$conn->close();
?>