<?php include'server.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
	.center{
		margin: auto;
		width:80%;
		text-align:center;
	}
</style>
</head>
<body>

	<div style="text-align:center">
		<h2>Register</h2>
	</div>
	<div class="center">
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<?php include('errors.php'); ?>
		<label for="">Name:</label>
		<input type="text" name="username" value="<?php echo $username; ?>" required><br>
		<label for="">Home Address:</label>
		<input type="text" name="address" required><br>
		<label for="">Contact phone number:</label>
		<input type="text" name="mobilenumber" required><br>
		<label for="">Email address:</label>
		<input type="email" name="email" value="<?php echo $email; ?>" required><br>
		<label for="">Password:</label>
		<input type="password" name="password_1" required><br>
		<label for="">Confirm Password</label>
		<input type="password" name="password_2" required><br>
		<label for="">Extra information:(e.g. broken leg, fragile)</label>
		<input type="text" name="information" required><br>
		<button type="submit" name="register_user">register</button>
		<p>
  		Already a member? <a href="login.php">Sign in</a>
  		</p>
	</form>
	</div>

</body>
</html>
