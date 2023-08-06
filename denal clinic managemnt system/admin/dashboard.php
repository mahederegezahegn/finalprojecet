<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/edit.css">
    <!-- <link rel="stylesheet" href="css/addd.css"> -->
    
  </head>
  <body>
  <?php include_once'adheader.php';?>
    <main>
        <div class="section">
            
    <div class="tbl">
      
<?php
include_once('db.php');
$sql = "SELECT * FROM service";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table style='margin-left:300px'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>id</th>";
          echo "<th>servicename</th>";
          echo "<th>price</th>";
          echo "<th>description</th>";
          echo "<th>delete</th>";
      echo "</tr>";
      echo "</thead>";
          echo"<tbody>";
        while($row = mysqli_fetch_array($result)){
          $id=$row['service_id'];
            echo "<tr>";
                echo "<td>" . $row['service_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                // echo "<td>" . $row['address'] . "</td>";
                // echo "<td>" . $row['password'] . "</td>";
          // echo "<th><a herf='#'>edit</a></th>";
         
          echo "<th><button class='red'><a href='delserv.php?id=$id'>delete</a></button></th>";
                
            echo "</tr>";
        }
        echo"     </tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} 

$sql = "SELECT * FROM employee";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    
        echo"<h1 class='heading'>employee</h1>";
        echo "<table class='emp' style='margin-left:100px;margin-right:100px'>";
          echo "<thead>";
          echo "<tr>";
        echo "<th>id</th>";
         echo"<th>First Name</th>";
         echo"<th>Last Name</th>";
         echo"<th>Email</th>";
         echo"<th>phone</th>";
         echo"<th>Password</th>";
         echo"<th>Address</th>";
         echo"<th>Job Title</th>";
         echo"<th>Speciality</th>";
         echo"<th>Delete</th>";

      echo "</tr>";
      echo "</thead>";
          echo"<tbody>";
        while($row = mysqli_fetch_array($result)){
            $id=$row['employee_id'];
            echo "<tr>";
                echo "<td>" . $row['employee_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td> password </td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['job_title'] . "</td>";
                // echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['speciality'] . "</td>";
                echo "<th><button class='red'><a href='delete.php?id=$id'>FIRE</a></button></th>";
          // echo "<th><a herf='#'>approve</a></th>";
                
            echo "</tr>";
        }
        echo"     </tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} 


else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}


?>
</div>


      </div>
    </main>
  </body>
</html>