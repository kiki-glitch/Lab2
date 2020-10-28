<?php
require_once("db.php");

if(isset($_POST['Loginbtn']))
{
	$Mail = $_POST['Mail'];
	$Pass = $_POST['password'];

	$sql = "SELECT Email, UserPass FROM usertable WHERE UserPass = '$Pass'";
	$result = mysqli_query($link, $sql);

	if($row = mysqli_fetch_assoc($result))
	{
		$PasswordCheck = $row['UserPass'];
		if($PasswordCheck == $row['UserPass'])
		{
			session_start();
			$_SESSION['Email'] = $row['Email'];

			header("Location: Land.php?loginsuccess");
			exit();
		}
		else
		{
			header("Location: Login.php?error=wrongEmail");
		}
	}
}
else
{
	echo "wrong";
}