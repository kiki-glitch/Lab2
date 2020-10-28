<?php
	session_start();

	include_once 'db.php';

	$con = new DBConnector();
	$pdo = $con->connectToDB();

	if(isset($_SESSION['Email']))
	{
		try
		{
			$stmt = $pdo->prepare('SELECT UserPass FROM usertable WHERE Email = ?');
			$stmt->execute([$_SESSION['Email']]);

			$row = $stmt->fetch();
		} catch (PDOException $e) {
			return $e->getMessage();
		}
		if($row !== null)
		{
			echo "<p id='Current'> Your current password is: <br><br>".$row['UserPass']."</p>";
			echo '<br><br>';
		}
		else
		{
			echo "Unable to get Email";
		}
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<title> CHANGE PASSWORD </title>
				<link rel="stylesheet" type="text/css" href="ChangePassword.css">
			</head>

			<body>
				<form method="Post" action="index.php" class="ChangePassForm">
					<h3 id="FieldTitle"> Change Password </h3>
					<input type="password" name="passwordnew" id='passwordnew' placeholder="Enter New Password">
					<br><br><br>

					<input type="password" name="passwordnewC" id='passwordnewC' placeholder="Confirm New Password">
					<br><br>

					<input type="Submit" name="PasswordChange" value="Change" id="Change"> 
				</form>
			</body>
		</html>
	<?php
	}
	?>