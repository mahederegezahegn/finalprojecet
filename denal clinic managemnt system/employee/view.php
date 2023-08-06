<!DOCTYPE html>
<html>
<head>
	<title>Patient Information</title>
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			font-size: 16px;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
		}
		form {
			margin: 50px auto;
			width: 500px;
			padding: 20px;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		}
		form label {
			display: block;
			margin-bottom: 10px;
		}
		form input[type="text"] {
			padding: 10px;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid #ccc;
			width: 100%;
			box-sizing: border-box;
			margin-bottom: 20px;
		}
		form input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
		}
		table {
			margin: 50px auto;
			width: 500px;
			border-collapse: collapse;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			border-radius: 10px;
		}
		th, td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
			text-align: left;
		}
		th {
			background-color: #4CAF50;
			color: #fff;
		}
	</style>
</head>
<body>
    <?php include 'docpheader.php';?>
	<h1>Patient Information</h1>

	<?php
	if (isset($_GET['id'])) {
        $id = $_GET['id'];
        include 'db.php';
        $sql="SELECT *from approve_patient where appointment_id='$id'";
        $result=mysqli_query($conn,$sql);
        $patient=mysqli_fetch_array($result); 
	?>
		<table>
			<tr>
				<th>Attribute</th>
				<th>Value</th>
			</tr>
			<tr>
				<td>ID</td>
				<td><?php echo $patient['id']; ?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><?php echo $patient['first_name']; ?></td>
			</tr>
			<tr>
				<td>Last_Name</td>
				<td><?php echo $patient['last_name']; ?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td><?php echo $patient['gender']; ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?php echo $patient['city']; ?></td>
			</tr>
            <tr>
				<td>Reasone</td>
				<td><?php echo $patient['reasone']; ?></td>
			</tr>
		</table>
		
		<form method="post" action="insert.php">
			<label for="insert-data">Insert Data:</label>
			<input type="text" id="insert-data" name="insert">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="submit" value="Submit">
		</form>
		
	<?php
		}

	?>

</body>
</html>