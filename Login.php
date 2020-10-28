<!DOCTYPE html>
<html>
	<head>

		<title>LOGIN</title>

		<style>
			body{
				background-image: url(../Images/background image.jpg);
				background-size: auto;
}
		</style>

	</head>

	<body>
		<form action="index.php" method="POST">
			<h3 id="FieldTitle"> Login </h3>
			<input type="email" name="Mail" id="Mail" placeholder="Enter Email Address">
			<br><br>

			<input type="password" name="password" id="password" placeholder="Enter Password">
			<br><br>

			<input type="submit" name="Loginbtn" id="Login" value="Login">
			<br><br>

			<a href="UserReg.php"> Create an account? </a>
		</form>

	</body>
</html>