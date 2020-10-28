<?php
	include_once 'Regiser.php';
	include_once 'db.php';
	//include_once 'LandingPage.php';
	//include_once 'ChangePassword.php';

	$con = new DBConnector();
	$pdo = $con->connectToDB();

	//$event = $_POST['event'];
	//Read the body of your request and store it in $jsondata variable.
    // $jsondata = file_get_contents('php://input');
    //Call the saveManyCompany() but you have to use json_decode() to convert your raw body data into a JSON data variable. 
    //echo $operations->saveManyCompany($pdo, json_decode($jsondata));


	if(isset($_POST['RegBtn']))
	{
		// register
		$Name = $_POST['Fname'];
		$email = $_POST['Email'];
		$Password = $_POST['Pass'];
		$City = $_POST['Address'];
		$Profile = $_FILES['Profilee'];

		$user = new User();
		$user->setFullName($Name);
		$user->setEmail($email);
		$user->setPassword($Password);
		$user->setAddress($City);
		$user->setProfile($Profile, $pdo);
		

		echo $user->register($pdo);
	}
	elseif (isset($_POST['Loginbtn']))
	{
		//login
		//$Name = $_POST['Name'];
		$Email = $_POST['Mail'];
		$Password = $_POST['password'];
		$user = new User();

		echo $user->setEmail($Email);
		echo $user->setPassword($Password);

		echo $user->login($pdo);
	}
	 elseif (isset($_POST['Logoutbtn']))
	 {
		$user = new User();

		echo $user->logout($pdo);
	}
	
	elseif (isset($_POST['PasswordChange']))
	{
  $Pass1 = $_POST['passwordnew'];
		$Pass2 = $_POST['passwordnewC'];

		$user = new User();  //Object

		echo $user->setNewPass($Pass1);
		echo $user->setConfirmedPass($Pass2);

		echo $user->changePassword($pdo);
	}
?>
