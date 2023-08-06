<?php
include 'db.php';
include 'conthead.php';
session_start();

$username = $_SESSION['user_name'];

// retrieve user data from database
$stmt = mysqli_prepare($conn, 'SELECT * FROM Patients WHERE email = ?');
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// check if user exists
if (mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);
} else {
  // handle error or redirect to error page
}

// check if form was submitted
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // get form data
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password =$_POST['password'];

  // update user data in database
  $stmt = mysqli_prepare($conn, 'UPDATE Patients SET first_name = ?, email = ?, password = ? WHERE email = ?');
  mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $password, $username);
  $query_success = mysqli_stmt_execute($stmt);

  // refresh user data
  if ($query_success && isset($user)) {
    $user['first_name'] = $name;
    $user['email'] = $email;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
</head>
<body>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }
    .containers {
      max-width: 600px;
      margin: 2rem auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label {
      margin-bottom: 5px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: none;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    input[type="submit"] {
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .profile {
      background:#007bff;
      margin-top: 40px;height: 10rem;
      /* padding: 5rem 0; */
      display: flex;
      flex-direction: column;
      margin: 1em;
      /* box-shadow: 1px 12px 3px 2px #f5f5f5; */
      align-items: center;
    }
    .profile img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
    }
    .profile h2 {
      margin-bottom: 10px;
    }
    .profile p {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <div class="containers">
    <h1>Edit Profile</h1>
     <div class="profile">
      <?php if (isset($user)): ?>
        <h2><?php echo$user['first_name']; ?></h2>
        <p><?php echo $user['email']; ?></p>
      <?php else: ?>
        <p>Error: User not found.</p>
      <?php endif; ?>
    </div>
    <form method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo isset($user) ? $user['first_name'] : ''; ?>">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo isset($user) ? $user['email'] : ''; ?>">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" value="">
      <input type="submit" value="Save">
    </form>
   
  </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popper.js%404.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 