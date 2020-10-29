<?php

ini_set("display_errors","On");
error_reporting(E_ALL);

ob_start();
session_start();

// initializing variables
$username = $email = $password_1 = $password_2 = $password = $address = $mobilenumber = $information = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '961011Bmw-', 'test');

$email = $_SESSION['email'];

$query = "SELECT * FROM booking where email='$email'";
$results = mysqli_query($db, $query);

/*if (mysqli_num_rows($results) > 0) {
  // output data of each row
		
  while($row = mysqli_fetch_assoc($results)) {
	//foreach($db -> query($sql) as $row){
		echo"<table>";
		echo"<tr>";
		echo "<td>{$row['type']}</td>";
		echo "<td>{$row['time']}</td>";
		echo "<td>{$row['address']}</td>";
		echo "<td>{$row['message']}</td>";
		echo "<td>{$row['email']}</td>";
		//echo "<td><a href='edit_student.php?id=({$row['student_id']})'>更改</a></td>";
		//echo "<td><a href='delete_student.php?id=({$row['student_id']})'>删除</a></td>";
		echo"<tr>";
		echo"<table>";
	//}
	//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}*/

?>
<html>
<head>
<title>All The booking</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
		<table>
		<tr>
			<th>Type of beauty service</th>
			<th>appointment time</th>
			<th>address</th>
			<th>Additional Message</th>
			<th>Email Address</th>
		</tr>
<?php
if (mysqli_num_rows($results) > 0) {
  // output data of each row
		
  while($row = mysqli_fetch_assoc($results)) {
	//foreach($db -> query($sql) as $row){
		//echo"<table>";
		echo"<tr>";
		echo "<td>{$row['type']}</td>";
		echo "<td>{$row['time']}</td>";
		echo "<td>{$row['address']}</td>";
		echo "<td>{$row['message']}</td>";
		echo "<td>{$row['email']}</td>";
		//echo "<td><a href='edit_student.php?id=({$row['student_id']})'>更改</a></td>";
		//echo "<td><a href='delete_student.php?id=({$row['student_id']})'>删除</a></td>";
		echo"</tr>";
		//echo"</table>";
	//}
	//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
?>
		</table>
		<a href="index.php">go back to index</a>
</body>
</html>

