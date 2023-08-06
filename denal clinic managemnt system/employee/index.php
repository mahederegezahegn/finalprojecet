<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Page</title>
	<style>
		body {
			background-color: #1c1c1c;
			color: #fff;
			font-family: Arial, sans-serif;
			font-size: 16px;
		}
		.progress-bar {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: #f3f3f3;
  }

  .progress-bar-inner {
    height: 100%;
    width: 0;
    background-color: #4caf50;
    transition: width 0.5s;
  }
		h1 {
			font-size: 32px;
			text-align: center;
			margin-top: 50px;
		}

		form {
			max-width: 400px;
			margin: 0 auto;
			padding: 20px;
			border: 1px solid #fff;
			border-radius: 5px;
			background-color: #333;
		}

		label {
			display: block;
			margin-bottom: 10px;
		}

		input[type="email"],
		input[type="password"],
		select {
			display: block;
			width: 90%;
			padding: 10px;
			margin-bottom: 20px;
      /* margin-right: 10px; */
			border: none;
			border-radius: 5px;
			background-color: #fff;
			color: #333;
			font-size: 16px;
		}

		input[type="submit"] {
			display: block;
			width: 100%;
			padding: 10px;
			border: none;
			border-radius: 5px;
			background-color: #ff9900;
			color: #fff;
			font-size: 16px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #ff6600;
		}

		.error-message {
			color: #ff0000;
			margin-top: 10px;
		}

		@media only screen and (max-width: 480px) {
			form {
				padding: 10px;
			}
		}
	</style>
</head>
<body>
<?php 
session_start();
include_once('db.php');

if(isset($_POST['login'])){
	// $D=2S;
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a SQL statement to select the user's title based on their email and password
    $stmt = $conn->prepare ('SELECT job_title FROM employee WHERE email = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->store_result();

    // If the user's credentials are valid, redirect them to the appropriate page based on their title
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($title);
        $stmt->fetch();
        if ($title == 'Doctor') {
            $_SESSION['user_name'] = $username;
            header('Location: home.php');
            exit();
        } elseif ($title == 'Receptionist') {
            $_SESSION['user_name'] = $username;
            header('Location: reception.php');
            exit();
        }
    }
}
	?>
	<h1>Login to your account</h1>
	<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="showProgressBar('login-progress-bar-inner')">
	<div class="progress-bar" id="login-progress-bar">
    <div class="progress-bar-inner" id="login-progress-bar-inner"></div>
  </div>
	<label for="username">Username:</label>
		<input type="email" id="username" placeholder="Email" name="email" required>

		<label for="password">Password:</label>
		<input type="password" id="password" placeholder="Password" name="password" required>

		<label for="usertype">Type of User:</label>
		<select id="usertype" name="usertype" required>
			<option value="">Select Type of User</option>
			<option value="Doctor">Doctor</option>
			<option value="Reception">Receptionist</option>
		</select>

		<input type="submit" name="login" value="Login">
		<?php if(isset($error_msg)) { ?>
			<div class="error-message"><?php echo $error_msg; ?></div>
		<?php } ?>
	</form>
</body>
<script>
	
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
</html>