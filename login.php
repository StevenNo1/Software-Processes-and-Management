<?php include 'server.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
	<div style="text-align:center">
		<h2>Login</h2>
	</div>
	<div>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<?php include('errors.php'); ?>
		<label for="">Email:</label>
		<input type="email" name="email" required><br>
		<label for="">Password:</label>
		<input type="text" name="password" required><br>
		<button type="submit" name="login_user">Login</button>
		<p>
  		Not yet a member? <a href="regist.php">Sign up</a>
  		</p>
	</form>
	</div>

</body>
</html>
