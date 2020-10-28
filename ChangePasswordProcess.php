<?php
require_once("connecting.php");
session_start();

if(isset($_POST['PasswordChange']))
{
	if (isset($_SESSION['Email'])) 
	{
		$Pass1 = $_POST['passwordnew'];
		$Pass2 = $_POST['passwordnewC'];

		$mymail = $_SESSION['Email'];

		if($Pass1 == $Pass2)
		{
			$sql = "UPDATE usertable SET Password='$Pass2' WHERE Email='$mymail'";
			mysqli_query($link, $sql);
			header("Location:LandingPage.php?Change=success");
		}
		else
		{
			echo "Passwords do not match";
		}
	}
	else
	{
		header("Location:LandingPage.php");
	}
}
