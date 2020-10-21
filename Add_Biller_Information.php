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

if (isset($_POST['add_biller'])){
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$billeremail = mysqli_real_escape_string($db, $_POST['billeremail']);
	$email = $_SESSION['email'];
	$query = "SELECT * FROM biller_information WHERE email='$email'";
	$results = mysqli_query($db, $query);
	if (mysqli_num_rows($results) == 1) {
		$query = "UPDATE biller_information SET name = '$name', billeremail='$billeremail' WHERE email = '$email'";
		mysqli_query($db, $query);
	}else{
		$query = "INSERT INTO biller_information (name, billeremail, email) VALUES ('$name','$billeremail','$email')";
		mysqli_query($db, $query);
	}
	//echo "<script>alert("success!")</script>";
	echo "successful!";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Add_Biller_Information</title>
</head>
<body>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<label for="">Name on invoice:</label>
		<input type="text" id="" name="name" required><br>
		<label for="">Biller email address</label>
		<input type="email" id="" name="billeremail" required><br>
		<button type="submit" name="add_biller">confirm</button>
		<p><a href="index.php">back to index</a></p>
	</form>

</body>
</html>
