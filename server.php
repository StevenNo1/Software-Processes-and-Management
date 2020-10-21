<?php

ini_set("display_errors","On");
error_reporting(E_ALL);

ob_start();
session_start();

// initializing variables
$username = $email = $password_1 = $password_2 = $password = $address = $mobilenumber = $information = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'password', 'test');

// REGISTER USER
if (isset($_POST['register_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $mobilenumber = mysqli_real_escape_string($db, $_POST['mobilenumber']);
  $information = mysqli_real_escape_string($db, $_POST['information']);


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
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password, address, mobilenumber, information) 
  			  VALUES('$username', '$email', '$password', '$address','$mobilenumber','$information')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  //$username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  /*if (empty($email)) {
  	array_push($errors, "email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }*/

  if (count($errors) == 0) {
  	$password = md5($password);
  	//$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	//username
  	$row = mysqli_fetch_assoc($results);
  	//$query = "SELECT username FROM users WHERE email='$email' AND password='$password'";
  	$username = $row["username"];
  	//echo "$username";
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['email'] = $email;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  		//array_push($errors, "Wrong email/password combination");
  		//echo "Wrong username/password combination";
  	}
  }
}

?>
