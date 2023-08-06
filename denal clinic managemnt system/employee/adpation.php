<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Employee Page</title>
    <!-- <link rel="stylesheet" href="css/edit.css"> -->
    <link rel="stylesheet" href="css/appoint.css">
  </head>
  <body>
  <?php include('repheader.php');?>
    <main>
    <h1 style="text-align:center">REGISTOR PATIENT</h1>
    <?php
// to the database
include_once 'db.php';

// Define variables and initialize with empty values
$first_name = $last_name = $email = $phone = $gender = $date_of_birth = $city = "";
$first_name_err = $last_name_err = $email_err = $phone_err = $gender_err = $date_of_birth_err = $city_err = "";

// Processing form data when form is submitted
if (isset($_POST["registor"])) {
  // Validate first name
  if (empty(trim($_POST["first_name"]))) {
    $first_name_err = " enter your first name.";
  } else {
    $first_name = trim($_POST["first_name"]);
  }

  // Validate last name
  if (empty(trim($_POST["last_name"]))) {
    $last_name_err = "Please enter your last name.";
  } else {
    $last_name = trim($_POST["last_name"]);
  }

  // Validate email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter your email address.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM approve_patient WHERE email = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      // Set parameters
      $param_email = trim($_POST["email"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $email_err = "This email address is already in use.";
        } else {
          $email = trim($_POST["email"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate phone
  if (empty(trim($_POST["phone"]))) {
    $phone_err = "Please enter your phone number.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM approve_patient WHERE phone = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_phone);

      // Set parameters
      $param_phone = trim($_POST["phone"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $phone_err = "This phone number is already in use.";
        } else {
          $phone = trim($_POST["phone"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate gender
  if (empty(trim($_POST["gender"]))) {
    $gender_err = "Please select your gender.";
  } else {
    $gender = trim($_POST["gender"]);
  }

  // Validate date of birth
  if (empty(trim($_POST["date_of_birth"]))) {
    $date_of_birth_err = "Please enter your date of birth.";
  } else {
    $date_of_birth = trim($_POST["date_of_birth"]);
  }

  // Validate city
  if (empty(trim($_POST["city"]))) {
    $city_err = "Please enter your city.";
  } else {
    $city = trim($_POST["city"]);
  }

  // Check input errors before inserting into database
  if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($phone_err) && empty($gender_err) && empty($date_of_birth_err) && empty($city_err)) {
    // Prepare an insert statement
    $sql = "INSERT INTO approve_patient (first_name, last_name, email, phone, gender, city) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ssssss", $param_first_name, $param_last_name, $param_email, $param_phone, $param_gender, $param_city);

      // Set parameters
      $param_first_name = $first_name;
      $param_last_name = $last_name;
      $param_email = $email;
      $param_phone = $phone;
      $param_gender = $gender;
      $param_date_of_birth = $date_of_birth;
      $param_city = $city;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Redirect to login page
        header("location: board.php");
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($conn);
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <label for="first_name">First Name:</label>
  <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
  <span class="error"><?php echo $first_name_err; ?></span><br><br>

  <label for="last_name">Last Name:</label>
  <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
  <span class="error"><?php echo $last_name_err; ?></span><br><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
  <span class="error"><?php echo $email_err; ?></span><br><br>

  <label for="phone">Phone:</label>
  <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required>
  <span class="error"><?php echo $phone_err; ?></span><br><br>

  <label for="gender">Gender:</label>
  <select id="gender" name="gender" required>
    <option value="">Select gender</option>
    <option value="male" <?php if ($gender == "male") echo "selected"; ?>>Male</option>
    <option value="female" <?php if ($gender == "female") echo "selected"; ?>>Female</option>
    <option value="other" <?php if ($gender == "other") echo "selected"; ?>>Other</option>
  </select>
  <span class="error"><?php echo $gender_err; ?></span><br><br>
  <label for="city">City:</label>
  <input type="text" id="city" name="city" value="<?php echo $city; ?>" required>
  <span class="error"><?php echo $city_err; ?></span><br><br>

  <input type="submit" name="registor" value="Register">
</form>

    </main>
  </body>
</html>