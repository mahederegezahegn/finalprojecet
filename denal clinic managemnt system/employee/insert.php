<?php
// Connect to the database
include 'db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $id = $_POST["id"];
    $insert_value = $_POST["insert"];
    
    // Validate and sanitize the input
    $insert_value = trim($insert_value);
    $insert_value = mysqli_real_escape_string($conn, $insert_value);
    
    // Prepare and execute the SQL update statement
    $stmt = mysqli_prepare($conn, "UPDATE approve_patient SET doctor_name = ?, see = 0 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $insert_value, $id);
    mysqli_stmt_execute($stmt);
    

    // Redirect back to the page with the updated data
    header("Location: reception.php");
    exit();
}
?>