<?php
if (isset($_POST['admin_login'])) {
	$admin_email = $_POST['admin_email'];
	if ($admin_email=="beth@gmail.com"){
		header('location: admin_index.php');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Admin_login</title>
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
<div>
   <h2>Admin Login</h2>
</div>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div style="text-align:right"><a href="login.php">user login<a/></div>
        <label>admin email address:</label>
	<input type="email" name="admin_email" required><br>
	<button type="submit" name="admin_login">confirm</button>
</form>
</div>

</body>
</html>
