<?php session_start()?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Employee Table</title>
    <link rel="stylesheet" href="css/edit.css">
    <!-- <link rel="stylesheet" href="css/addd.css"> -->
    
  </head>
  <body>
  <?php include('adheader.php')?>
    <main>
    

<?php
include_once('db.php');
$sql = "SELECT * FROM admin";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>first_name</th>";
          echo "<th>email</th>";
          echo "<th>password</th>";
          echo "<th>phone</th>";
          echo "<th>address</th>";
          echo "<th>delete</th>";
      echo "</tr>";
      echo "</thead>";
          echo"<tbody>";
        while($row = mysqli_fetch_array($result)){
          $id=$row['admin_id'];
            echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                // echo "<td>" . $row['password'] . "</td>";
          // echo "<th><a herf='#'>edit</a></th>";
         
          echo "<th><button class='red'><a href='deladmin.php?id=$id'>FIRE</a></button></th>";
                
            echo "</tr>";
        }
        echo"     </tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


?>
      
    </main>
  </body>
</html>