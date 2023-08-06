<?php 
session_start();
require_once "db.php";

if (isset($_SESSION['user_name'])) {
  header("Location: index.php");
  exit;
}
if (isset($_POST['login'])) {
  $uname = $_POST['email'];
  $password = $_POST['password'];

  // Validate the email input
  if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
      $error_msg = "Invalid email format.";
  } else {
      // Use prepared statements to prevent SQL injection
      $stmt = $conn->prepare("SELECT * FROM patients WHERE email = ? AND Password = ?");
      $stmt->bind_param("ss", $uname, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      // Check if the user exists in the database
      if ($result->num_rows > 0) {
          $row=$result->fetch_assoc();
          
          $_SESSION['user_name'] = $row['email'];
          $_SESSION['user_pass'] = $row['Password'];
          // $SESSION['user_email'] = $row['email'];
          header('Location: index.php');
          exit;
      } else {
          $error_msg = "Invalid email or password.";
      }

      $stmt->close();
  }
}
?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/login.css">
<head>
  <meta charset="UTF-8">
  <title>Patient Login/Signup</title>
</head>
<style></style>
<body>
  <div class="main">
    <div class="img">   
    </div>
    
  <div class="container">
    <div class="tabs">
      <div class="tab active" data-form="login-form">Login</div>
      <div class="tab" data-form="signup-form">Signup</div>
    </div>

    <form id="login-form" class="form active" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="showProgressBar('login-progress-bar-inner')">

  <div class="progress-bar" id="login-progress-bar">
    <div class="progress-bar-inner" id="login-progress-bar-inner"></div>
  </div>
      <h2>Login</h2>
      <?php if(isset($error_msg)) { ?>
        <div class="error"><?php echo $error_msg; ?></div>
      <?php } ?>
      <input type="text" name="email" placeholder="User email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" name="login" value="Login">
    </form>

    <form id="signup-form" class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="showProgressBar('signup-progress-bar-inner')">
  <div class="progress-bar" id="signup-progress-bar">
    <div class="progress-bar-inner" id="signup-progress-bar-inner"></div>
  </div>
      <h2>Signup</h2>
     <?php
     if(isset($_POST['signup'])) {
      $name = $_POST['name'];
      $last_name = $_POST['last_name']; // Get the last name value
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $pwd = $_POST['password'];
      $gender = $_POST['gender'];
      
      // Check if user already exists
      $sql = "SELECT id FROM patients WHERE email = '$email' OR phone = '$phone'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {
        $msg = "This email or phone number is already registered";
      } else {
        // Validate input fields
        $errors = array();
        if(empty($name)) {
          $errors[] = "Name is required";
        }
        if(empty($last_name)) {
          $errors[] = "Last name is required";
        }
        if(empty($email)) {
          $errors[] = "Email is required";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors[] = "Invalid email format";
        }
        if(empty($phone)) {
          $errors[] = "Phone number is required";
        } elseif(!preg_match('/^[0-9]+$/', $phone)) {
          $errors[] = "Invalid phone number format";
        }
        if(empty($address)) {
          $errors[] = "Address is required";
        }
        if(empty($pwd)) {
          $errors[] = "Password is required";
        }
    
        // If there are errors, display them
        if(!empty($errors)) {
          $msg = implode("<br>", $errors);
        } else {
          // Insert data into database
          $sql = "INSERT INTO patients(id,first_name,last_name,email,phone,city,password,gender) 
          values('','$name','$last_name','$email','$phone','$address','$pwd','$gender')";
          
          $result = mysqli_query($conn, $sql);
          if($result) {
            $msg = "Account created successfully";
            header("location: index.php");
            $conn->close();
            exit;
          } else {
            $msg = "Error occurs: " . mysqli_error($conn);
          }
        }
      }
    }
?>
  <?php if(isset($msg)) { ?>
        <div class="error"><?php echo $msg; ?></div>
      <?php } ?>
      <div>
        <label for="name">First Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
      </div>
      <div>
  <label for="last_name">Last Name:</label>
  <input type="text" id="last_name" name="last_name">
</div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
      </div>
      <div>
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
      </div>
      <div>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
      </div>
      <div>
  <label for="gender">Gender:</label>
  <select id="gender" name="gender">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    <option value="Other">Other</option>
  </select>
</div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
      </div>
      <div>
      <input type="submit" name="signup" value="Signup">
      </div>
  
    </form>
    
  </div>

  </div>

  <script>
    const tabs = document.querySelectorAll('.tab');
    const forms = document.querySelectorAll('.form');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const formToActivate = document.getElementById(tab.dataset.form);
        forms.forEach(form => form.classList.remove('active'));
        formToActivate.classList.add('active');
        tabs.forEach(tab => tab.classList.remove('active'));
        tab.classList.add('active');
      });
    });


    function showProgressBar(progressBarId) {
  const progressBar = document.getElementById(progressBarId);
  progressBar.style.width = '0%';

  setTimeout(() => {
    progressBar.style.width = '50%';
  }, 500);

  setTimeout(() => {
    progressBar.style.width = '100%';
  }, 1000);
}

  </script>
</body>
</html>