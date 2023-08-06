<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/addemp.css">
    <link rel="stylesheet" href="css/addd.css">
    
  </head>
  <body>
    <?php include('adheader.php');?>
    <main>
      <!-- <section> -->
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"enctype="multipart/form-data" >
 <?php
// session_start();
include_once('db.php');
if(isset($_POST['register'])){
  $sername = $_POST['sername'];
  $price = $_POST['price'];
  $description = $_POST['des'];

  // Upload image to directory
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $newFileName = uniqid() . '.' . $imageFileType;
  $target_path = $target_dir . $newFileName;
  $uploadOk = 1;
  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path)) {
      $image_path = $target_path;
      $sql = "INSERT INTO service (name, price, description, image) VALUES (?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "siss", $sername, $price, $description, $image_path);
      $result = mysqli_stmt_execute($stmt);
      if($result){
        echo "Inserted successfully";
        header('Location: dashboard.php');
        exit();
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
?>
    <h1>Service Form</h1>
<!-- <form method="post" action="register.php"> -->
  <label for="first-name">Service Name:</label>
  <input type="text" id="service-name" name="sername" required>
  <label for="last-name">price:</label>
  <input type="number" id="price" name="price" required>
  <label for="email">description:</label>
  <input type="text" id="text" name="des" required>
  <label for="phone">Image:</label>
  <input type="file" id="image" name="image" required>
  <button type="submit" name="register">Register Services</button>
</form>
      <!-- </section> -->
    </main>
  </body>
</html>