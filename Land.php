<?php
	session_start();
	include_once 'Regiser.php';
	include_once 'db.php';
	include_once 'index.php';

	$con = new DBConnector();
	$pdo = $con->connectToDB();
?>

<!DOCTYPE html>
<html>
	<head>

		<title> LandingPage </title>
		<link rel="stylesheet" type="text/css" href="Style.css">

	</head>

	<body>
		<div class="Box1">
			<h1 id="Title"> Welcome to this Page </h1>
			<?php
			if(!isset($_SESSION['Email']))
			{?>
				<a href="Login.php" id="LoginUrl"> Click to Login </a>
				<?php
			} 
			else
			{
				//$mymail = $_SESSION['Email'];

				$stmt = $pdo->prepare("SELECT Name FROM usertable WHERE Email = ?"); 
				$stmt->execute([$_SESSION['Email']]);
				$row1 = $stmt->fetch();

				$sql4 = $pdo->prepare("SELECT UserPass FROM usertable WHERE Email = ?");
				$sql4->execute([$_SESSION['Email']]);
				$row4 = $sql4->fetch();

				$sql5 = $pdo->prepare("SELECT City FROM usertable WHERE Email = ?");
				$sql5->execute([$_SESSION['Email']]);
				$row5 = $sql5->fetch();

				$sql6 = $pdo->prepare("SELECT ProfPhoto FROM usertable WHERE Email = ?");
				$sql6->execute([$_SESSION['Email']]);
				$row6 = $sql6->fetch();

				echo "<p id='Welcome'> Welcome user ". $_SESSION['Email']."</p>";
				echo "<br>";
				echo "<p id='Details'> Your details are as below: </p>";
				

				echo "<p id='Mail'> Email: ".$_SESSION['Email']."</p>";
				

				if($row1 !== null)
				{
					echo "<p id='Name'>Name: ".$row1['Name']."</p>";
					echo "<img id='profile' src='Images/profile".$_SESSION['Email'].".jpg'>";
					
				}
				if($row4 !== null)
				{
					echo "<p id='Pass'>Password: ".$row4['UserPass']."</p>";
					
				}
				if($row5 !== null)
				{
					echo "<p id='Address'>Address: ".$row5['City']."</p>";
				}

				//echo "<p id = 'Pchange'> Click <a href='ChangePassword.php'> here </a> to change your password </p>";
				echo "<br><br>";
				echo "<form action = 'index.php' method='POST'>";
				echo "<p id = 'Pchange'><a href='ChangePassword.php' name='Change'>Change Password </a> to change your password </p>";
				echo "<button name='Logoutbtn'> Logout </button> ";
				echo "</form>";
			}

			?>
		</div>

	</body>
</html>