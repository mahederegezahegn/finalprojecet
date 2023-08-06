<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- Your code will go here -->
  <?php include 'docpheader.php';
  include 'db.php';
  
if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];
    $sql = "SELECT * FROM appointment WHERE id = $patient_id";

    // Execute the query and store the result in a variable
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if there is at least one row returned
    if ($result && $result->num_rows > 0) {
        // Fetch the data from the result set and display it on the page
        if ($row = mysqli_fetch_assoc($result)) {
        
            echo "Add more fields as needed";
        }
    } else {
        echo "No results found.";
    }
} else {
    echo "No patient ID provided.";
}

// Close the database connection
mysqli_close($conn);
?>

<div class="container mt-5">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title" id="patientName"><?php echo $row["name"];?></h5>
      <p class="card-text">
        <!-- <strong>Gender:</strong> <span id="patientGender"> -->
            
        <strong>Resone:</strong> <span id="patientDOB"><?php echo$row['reason'] ?></span>
      </p>
      <form id="updatePatientForm">
        <div class="mb-3">
          <label for="updateTextArea" class="form-label">Update Patient:</label>
          <textarea class="form-control" id="updateTextArea" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
