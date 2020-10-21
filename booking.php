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

//echo date("Y-m-d h:i:sa");

if (isset($_POST['booking_confirm'])){
	$email = $_SESSION['email'];
	$type = mysqli_real_escape_string($db, $_POST['type']);
	$date = mysqli_real_escape_string($db, $_POST['date']);
	$time = mysqli_real_escape_string($db, $_POST['time']);
	$message = mysqli_real_escape_string($db, $_POST['message']);
	
	$query = "SELECT * FROM booking WHERE time='$date $time'";
	$results = mysqli_query($db, $query);
	if (mysqli_num_rows($results) == 1) {
		array_push($errors, "this time is unavaliable");
		echo "this time is unavaliable";
	}else{
	
	$query = "SELECT * FROM users WHERE email='$email'";
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($results);
	$address = $row["address"];
	$mobilenumber = $row["mobilenumber"];
	$username = $row["username"];
	$bookingdate = date("Y-m-d h:i:sa");
	
	//$query = "INSERT INTO booking(type, time, username, mobilenumber, bookingtime, email) VALUES ('$type', '$date $time', '$username', '$mobilenumber','$bookingdate', '$email')";
	$query = "INSERT INTO booking (type, time, address, message, email) VALUES ('$type','$date $time', '$address','$message','$email')";
	mysqli_query($db, $query);
	//echo "'$date $time'";
	$msg = "Beautift care service is $type, order period is $date $time, his/her name is $username, his/her mobile number is $mobilenumber, the date he/she book: $bookingdate,his/her $email, his/her address is $address, additional information is $message";
	$msg = wordwrap($msg,70);
	//mail("juxia@student.unimelb.edu.au","booking",$msg);
	mail("example@example.com","booking",$msg);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Booking</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
<div>
<label>Beauty Care Services Type:</label>
  <select name="type">
    <option value="haircut">haircut</option>
    <option value="hair wash & dry"> hair wash & dry</option>
    <option value="hair colour">hair colour</option>
  </select>
  <br>
<label>Choose a date:</label>
<input type="date" name="date"><br>
<label for="">Choose a time:</label>
  <select name="time" id="time">
    <option value="9:00-10:00">9:00-10:00</option>
    <option value="10:00-11:00">10:00-11:00</option>
    <option value="11:00-12:00">11:00-12:00</option>
    <option value="12:00-13:00">12:00-13:00</option>
    <option value="13:00-14:00">13:00-14:00</option>
    <option value="14:00-15:00">14:00-15:00</option>
    <option value="15:00-16:00">15:00-16:00</option>
    <option value="16:00-17:00">16:00-17:00</option>
  </select>
  <br>
  <label>Optional Message:</label>
  <input type="text" name="message">
  <br>
  <button type="submit" name="booking_confirm">confrim</button>
  <div><a href="index.php">Back to index</a></div>
</div>
</form>

</body>
</html>
