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

// REGISTER USER
if (isset($_POST['update_personal_information'])) {
  // receive all input values from the form
  //$username = mysqli_real_escape_string($db, $_POST['username']);
  //$email = mysqli_real_escape_string($db, $_POST['email']);
  //$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  //$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  //$address = mysqli_real_escape_string($db, $_POST['address']);
  //$mobilenumber = mysqli_real_escape_string($db, $_POST['mobilenumber']);
  //$information = mysqli_real_escape_string($db, $_POST['information']);
  
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];
  $address = $_POST['address'];
  $mobilenumber = $_POST['mobilenumber'];
  $information = $_POST['information'];
  $oldemail = $_SESSION['email'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  //if (empty($username)) { array_push($errors, "Username is required"); }
  //if (empty($email)) { array_push($errors, "Email is required"); }
  //if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  //$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  //$result = mysqli_query($db, $user_check_query);
  //$user = mysqli_fetch_assoc($result);
  
  //if ($user) { // if user exists
    //if ($user['username'] === $username) {
      //array_push($errors, "Username already exists");
    //}

    //if ($user['email'] === $email) {
      //array_push($errors, "email already exists");
    //}
  //}

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	//$query = "INSERT INTO users (username, email, password, address, mobilenumber, information) 
  	//		  VALUES('$username', '$email', '$password', '$address','$mobilenumber','$information')";
  	$query = "UPDATE users
  		SET username='$username', email='$email', password='$password', address='$address', mobilenumber='$mobilenumber', information='$information'
  		WHERE email = '$oldemail'";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>update_personal_information</title>
<style>


a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

a:active {
  text-decoration: underline;
}

input[type=text],input[type=password],input[type=email],input[type=date], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  text-align:center;
}

</style>
</head>
<body>

<div>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<label for="">Name:</label>
		<input type="text" name="username" value="<?php //echo $username; ?>" required><br>
		<label for="">Home Address:</label>
		<input type="text" name="address" required><br>
		<label for="">Contact phone number:</label>
		<input type="text" name="mobilenumber" required><br>
		<label for="">Email address:</label>
		<input type="email" name="email" value="<?php //echo $email; ?>" required><br>
		<label for="">Password:</label>
		<input type="password" name="password_1" required><br>
		<label for="">Confirm Password:</label>
		<input type="password" name="password_2" required><br>
		<label for="">Extra information:(e.g. broken leg, fragile)</label>
		<input type="text" name="information" required><br>
		<button type="submit" name="update_personal_information">update</button>
		<p>
  		Back to index page? <a href="index.php">Back</a>
  		</p>
	</form>
</div>

</body>
</html>
