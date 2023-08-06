<style>
  /* Patient box styles */
  .patient-box {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    max-width: 400px;
    background-color: #fff;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    transition: all 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
    position: relative;
  }
  .patient-box:hover {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transform: translateY(-4px);
  }
  .patient-box .patient-name {
    font-weight: bold;
    font-size: 24px;
    margin-bottom: 10px;
    color: #333;
    text-align: center;
    text-transform: uppercase;
  }
  .patient-box .patient-info {
    margin-bottom: 5px;
    color: #666;
  
    display: flex; font-size: 1.6rem;
    align-items: center;
  }
  .patient-box .patient-info-label {
    font-weight: bold;
    margin-right: 10px;
    font-size: 1.2rem;
    color: #333;
  }
  .patient-box .patient-info-label::before {
    content: "";
    display: inline-block;
    width: 10px;
    height: 10px;
    margin-right: 5px;
    border-radius: 50%;
  }
  .patient-box .patient-info-label.gender::before {
    background-color: #007bff;
   
  }
  .patient-box .patient-info-label.reason::before {
    background-color: #28a745;
   
  }
  .patient-box .view-button {
    
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    font-size: 16px;
    font-weight: bold;
  }
  .patient-box .view-button:hover {
    background-color: #0062cc;
  }
  .patient-box {
  margin: 1rem auto;
  width: 90%;
}
  /* No records message styles */
  .no-records {
    font-style: italic;
    color: #999;
    font-size: 20px;
    margin-top: 50px;
    text-align: center;
  }
</style>

<?php
// Start session
// session_start();
include "docpheader.php";
// Include database connection
include "db.php";

// Get current doctor email from session and sanitize it
$doctor_email = mysqli_real_escape_string($conn, $_SESSION["user_name"]);

// Prepare and execute SQL query to fetch first name of doctor with given email
$stmt = mysqli_prepare($conn, "SELECT first_name FROM employee WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $doctor_email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch first name from result
if ($row = mysqli_fetch_assoc($result)) {
    $doctor_first_name = $row["first_name"];
} else {
    // Handle error if no doctor is found with given email
    $doctor_first_name = "Unknown";
}

// Prepare and execute SQL query to fetch approve_patient records for doctor with given email
$stmt = mysqli_prepare($conn, "SELECT * FROM approve_patient WHERE doctor_name = ? and see=0");
mysqli_stmt_bind_param($stmt, "s", $doctor_first_name);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if any records were found
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        echo '<div class="patient-box">';
        echo '<div class="patient-name">' . $row['first_name'] . '</div>';
        echo '<div class="patient-info"><span class="patient-info-label gender"></span>' . $row['gender'] . '</div>';
        echo '<div class="patient-info"><span class="patient-info-label reason"></span>' . $row['reasone'] . '</div>';
        echo "<a href='viewp.php?id={$id}' class='view-button'>view</a>";
        echo '</div>';
    }
} else {
    // Display message if no records were found
    echo '<p class="no-records">No records found for Dr. ' . $doctor_first_name . '.</p>';
}

// Close statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
