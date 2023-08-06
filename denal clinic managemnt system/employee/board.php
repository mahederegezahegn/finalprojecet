<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/edit.css">
  </head>
  <body>


    <?php include('repheader.php');?>
    <main style="text-align:center">
    <?php
include_once('db.php');
$date = date('Y-m-d');
$sql = "SELECT * FROM appointment WHERE preferred_date = '$date' ORDER BY preferred_time ASC";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<h1>appointment of the day</h1>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>id</th>";
        echo "<th>name</th>";
        echo "<th>email</th>";
        echo "<th>date</th>";
        echo "<th>time</th>";
        echo "<th>reasone</th>";
        echo "<th>Method</th>";
        echo "<th>approve</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
          if ($row['approve'] == 0) { 
                $id = $row['appointment_id'];
                echo "<tr>";
                echo "<td>" . $row['appointment_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['preferred_date'] . "</td>";
                echo "<td>" . $row['preferred_time'] . "</td>";
                echo "<td>" . $row['online'] . "</td>";
                echo "<td>" . $row['reason'] . "</td>";
                
                echo "<th><button ><a href='apprv.php?id=$id'>approve</a></button></th>";
                echo "</tr>";
            
        }}
        echo "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No records matching your query were found.";
    }
}
?>
</div>
    </main>
  </body>
</html>