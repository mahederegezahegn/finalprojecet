<?php 
include 'db.php';
// Check for connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE Approve_patient(
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  gender ENUM('male', 'female', 'other') NOT NULL,
  date_of_birth DATE NOT NULL,
  city VARCHAR(50) NOT NULL
);";

// Execute the SQL statement
if (mysqli_query($conn, $sql)) {
  echo "Table patient created successfully<br>";
} else {
  echo "Error creating table: " . mysqli_error($conn) . "<br>";
}
// Close the database connection
mysqli_close($conn);
?>