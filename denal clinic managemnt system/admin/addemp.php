<?php
session_start();
?>

<!DOCTYPE<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/addemp.css">
    <link rel="stylesheet" href="css/addd.css">
  </head>
  <body>
    <?php include('adheader.php'); ?>
    <main class="main">
      <div class="img"></div> 
      
      <form method="post" action="<?php echo htmlspecialchars($_SERVER ['PHP_SELF']); ?>"enctype="multipart/form-data">
   
      <div id="sussess"> 
        <?php
        // Check if there are any errors to display
        if(isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo '
                <p>' . $error . '</p>';
            }
            // Clear the error session variable
            unset($_SESSION['errors']);
        }
        ?>
      </div>
      <?php // Connect to the database
include_once 'db.php';

// Check if the form has been submitted
if (isset($_POST['submitted'])) {
    // Get the form data
    $firstName = mysqli_real_escape_string($conn, $_POST['first-name']);
    $lastName = mysqli_real_escape_string($conn, $_POST['last-name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $jobTitle = mysqli_real_escape_string($conn, $_POST['job-title']);
    $speciality = mysqli_real_escape_string($conn, $_POST['special']);

    // Get the file information
    if (isset($_FILES['path']) && $_FILES['path']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES['path']['name'];
        $fileTmpName = $_FILES['path']['tmp_name'];
        $fileSize = $_FILES['path']['size'];
        $fileType = $_FILES['path']['type'];

        // Check if the file is a valid image
        $imageSize = getimagesize($fileTmpName);
        if ($imageSize === false) {
            $_SESSION['errors'][] = 'Error: File is not an image.';
        } else {
            $imageType = $imageSize[2];
            if ($imageType != IMAGETYPE_JPEG && $imageType != IMAGETYPE_PNG) {
                $_SESSION['errors'][] = 'Error: Only JPEG and PNG images are allowed.';
            }
        }
    } else {
        $_SESSION['errors'][] = 'Error uploading file.';
    }

    // Check if there are any errors before proceeding
    if (!isset($_SESSION['errors'])) {
        // Move the file to the uploads directory
        $fileNewName = uniqid('', true) . '.' . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileDestination = '' . $fileNewName;
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
            // Insert the form data into the database
            $sql = "INSERT INTO employee (first_name, last_name, email, phone, password, address, job_title, speciality, image) 
            VALUES ('$firstName', '$lastName', '$email', '$phone', '$password', '$address', '$jobTitle', '$speciality', '$fileDestination')";
            if (mysqli_query($conn, $sql)) {
                echo "Employee registered successfully.";
                header('location:dashboard.php');
            } else {
                die('Error: ' . mysqli_error($conn));
            }
        } else {
            $_SESSION['errors'][] = 'Error uploading file.';
        }
    }
  }
// Close the database connection
mysqli_close($conn);
?>  
      <h1>Employee Registration Form</h1>
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first-name" required>
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last-name" required>
        <labelfor="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required> 
        <label for="path">Image:</label>
        <input type="file" id="path" name="path" accept="image/*" required>
        <label for="job-title">Job Title:</label>
        <select id="job-title" name="job-title" required>
          <option value="">Select Job Title</option>
          <option value="Doctor">Doctor</option>
          <option value="Nurse">Nurse</option>
          <option value="Receptionist">Receptionist</option>
        </select>
        <label for="speciality">Speciality:</label>
        <select id="speciality" name="special" required>
          <option value="">Select speciality</option>
          <option value="Cleaning">Teeth Cleaning</option>
          <option value="Whitening">Teeth Whitening</option>
          <option value="Filling">Filling or Crown</option>
          <option value="Extraction">Tooth Extraction</option>
          <option value="Reception">Receptionist</option>
          <option value="Nursing">Nursing</option>
        </select>
        <button type="submit" name="submitted" value="1">Register Employee</button>
      </form>
    </main>
  </body>
</html>