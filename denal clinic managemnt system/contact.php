<?php
include_once('db.php');

include('conthead.php');
$useremail = $_SESSION['user_name'];

$name = '';
$comment = '';
$errors = array();

// Fetch name from database
$sql = "SELECT id, first_name FROM patients WHERE email='$useremail'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $patient_id = $row['id'];
  $name = $row['first_name'];
}
if(isset($_POST['submit'])) {
  $comment = $_POST['comment'];

  // Validate input fields
  if(empty($comment)) {
    $errors[] = "Comment is required";
  }

  // Insert data into database if there are no errors
  if(empty($errors)) {
    $sql = "INSERT INTO comments (id,patient_id,text,date,approved) VALUES ('','$patient_id','$comment',NOW(),'false')";
    $result = mysqli_query($conn, $sql);
    if($result) {
      $msg = "Commented successfully";
    } else {
      $msg = "Error occurs: " . mysqli_error($conn);
    }
    header('location: contact.php');
    $conn->close();
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Contact Section</title>
    
    <link rel="stylesheet" href="css/contact.css">
  </head>
  <body>
    <div class="containers">
      <div class="content">
        <div class="left-side">
          <div class="address details">
            <i class="fas fa-map-marker-alt"></i>
            <div class="topic">Address</div>
            <div class="text-one">Bahirdar</div>
            <div class="text-two">Giorgis church</div>
          </div>
          <div class="phone details">
            <i class="fas fa-phone-alt"></i>
            <div class="topic">Phone</div>
            <div class="text-one">0979089495</div>
            <div class="text-two">0944394433</div>
          </div>
          <div class="email details">
            <i class="fas fa-envelope"></i>
            <div class="topic">Email</div>
            <div class="text-one">mahederegezahegn@gmail.com</div>
            <div class="text-two">moneymaker@gmail.com</div>
          </div>
        </div>
        <div class="right-side">
          <div class="topic-text">Send us a message</div>
          <p>If you have any work for me or any types of queries related to my tutorial, you can send me a message from here. It's my pleasure to help you.</p>
          <?php if(!empty($errors)): ?>
            <div class="error">
              <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if(isset($msg)): ?>
            <div class="success"><?php echo $msg; ?></div>
          <?php endif; ?>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-box">
              <input type="text" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>" disabled>
            </div>
            <div class="input-box message-box">
              <input type="text" name="comment" placeholder="Enter your comment" value="<?php echo htmlspecialchars($comment); ?>">
            </div>
            <div class="btn">
              <input style="background:transparent;color:white; border: none;" type="submit" name="submit" value="Send Now" >
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
