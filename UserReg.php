<!-- <?php
// require_once "trial1.php";
// require_once "connecting.php";

//Database handle $pdo
// $pdo = new DBConnector();
// $con = $pdo->connectToDB();

?>
 -->
<!DOCTYPE html>
<html>
	<head>

		<title> REGISTER </title>

	</head>

	<body>
		<form method="Post" action="index.php" class="Form" enctype="multipart/form-data">
			<h3 id="FieldTitle"> Register </h3>
			<input type="text" name="Fname" id="Fname" placeholder="Enter First Name">
			<br><br>

			<input type="email" name="Email" id="Email" placeholder="Enter Email Address">
			<br><br>

			<input type="password" name="Pass" id="Pass" placeholder="Enter Password">
			<br><br>

			<input type="text" name="Address" id="Address" placeholder="Enter City of Residence">
			<br><br>

			<input type="file" name="Profilee" id="Profile" required="true">
			<br><br>

			<input type="submit" name="RegBtn" value="Register">

			<!-- <?php
				//$reg = new Accounts();
				//echo $reg->register($con);	
			?> -->

		</form>
	</body>
</html>