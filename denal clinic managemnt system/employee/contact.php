<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Contact Section</title>
    <link rel="stylesheet" href="css/contact.css">
  </head>
  <body>
    <?php include_once('docpheader.php');?> 
 
    <div class="container">
    <div class="content">
      <div class="right-side">
        <div class="topic-text">Send Advice </div>
        <!-- <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p> -->
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        
        <?php        
include_once 'db.php';

$usname = $_SESSION['user_name'];
if(isset($_POST['send'])) {
    $sqli = "SELECT employee_id FROM employee WHERE email = '$usname' AND job_title = 'Doctor'";
    $result = $conn->query($sqli);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $doctor_id = $row["employee_id"];
            $advice = $_POST['advice'];
            $sql = "INSERT INTO doctor_advice (doctor_id, advice, date) 
                    VALUES ('$doctor_id', '$advice', NOW())";
            $result = mysqli_query($conn, $sql);
            if($result) {
                header('location:home.php');
                exit;
            } else {
                $msg = "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Couldn't find the doctor";
    }
    mysqli_close($conn);
}
  ?>
      <?php if(isset($msg)){
        echo"<p>".$msg."</p>";
      }
      ?>
        <div class="input-box message-box">
          <input type="text" name="advice" placeholder="Enter your Advice">
        </div>
        <div class=" button" >
          <input type="submit" name="send" value="submit">
        </div>
      </form>
    </div>
    </div>
  </div>
  </body>
</html>