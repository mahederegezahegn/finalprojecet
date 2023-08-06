
<?php 
session_start();
require_once "db.php";

if (isset($_SESSION['user_name'])) {
  header("Location: admin.php");
  exit;
}

if(isset($_POST['commit']))
{
  $uname = $_POST['name'];
  $password = $_POST['password'];

  $stmt = "SELECT * FROM admin WHERE username = '$uname' AND password = '$password'";
  
  $result=mysqli_query($conn,$stmt);
  if($result) {
    $_SESSION['user_name'] = $uname;
    $_SESSION['user_pass']=$password;
    // $SESSION['user_email']=$email;
    header('Location: index.php');
    exit;
  }
  else {
    // $error_msg = "Invalid login credentials.";
    echo "<p>Invalid login credentials.: " . mysqli_error($conn) . "</p>";

  }

  mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
 <link rel="stylesheet" href="css/adlog.css"> 
  </head>
  <body>
<div class="login">
<?php if(isset($error_msg)) { ?>
        <div class="error"><?php echo $error_msg; ?></div>
      <?php } ?>
  <h1>Login to Admin Page</h1>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
  
    <p><input type="text" name="name" value="" placeholder="Username"></p>
    <p><input type="password" name="password" value="" placeholder="Password"></p>
    <p class="submit"><input type="submit" name="commit" value="Login"></p>
  </form>
</div>

  </body>
</html>  