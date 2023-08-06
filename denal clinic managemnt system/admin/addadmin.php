<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/ad.css">
    <link rel="stylesheet" href="css/addd.css">
  </head>
  <body>
    <?php include('adheader.php');?>
    <main>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <?php
      include_once('db.php');
// Check if the form has been submitted
if (isset($_POST['signup'])) {
  // Get the form data
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $useremail = mysqli_real_escape_string($conn, $_POST['useremail']);
  $useraddress = mysqli_real_escape_string($conn, $_POST['useraddress']);
  $userphone = mysqli_real_escape_string($conn, $_POST['userphone']);


 // Insert the new admin into the database
 $sql = "INSERT INTO admin (admin_id,username,email,phone,address,password) 
  VALUES ('','$username','$useremail','$userphone','$useraddress','$password')";
 $result = mysqli_query($conn, $sql);
 if ($result) {
   echo "<p>New admin added successfully.</p>";
 } else {
   echo "<p>Error adding new admin: " . mysqli_error($conn) . "</p>";
 }


  // Close the database connection
  mysqli_close($conn);
}
?>
  <h1>Add Admin</h1>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" required>

  <label for="username">email:</label>
  <input type="text" id="username" name="useremail" required>
  <label for="te">address:</label>
  <input type="text" id="password" name="useraddress" required>
  <label for="username">userphone:</label>
  <input type="text" id="username" name="userphone" required>
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>
  <button type="submit" name="signup">Add Admin</button>
</form>
    </main>
  </body>
</html>