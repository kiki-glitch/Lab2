<?php 
require_once("connecting.php");

if(isset($_POST['RegBtn']))
{
	$fname = $_POST['Fname'];
	$Mail = $_POST['Email'];
	$Address = $_POST['Address'];
	$Pass = $_POST['Pass'];
	$Prof = $_FILES['Profilee'];

	$fileName = $_FILES['Profilee']['name'];
	$fileTmpName = $_FILES['Profilee']['tmp_name'];
	$fileSize = $_FILES['Profilee']['size'];
	$fileError = $_FILES['Profilee']['error'];
	$fileType = $_FILES['Profilee']['type'];

	$fileExtension = explode('.', $fileName); //Separates at '.'
	$fileActualExtention = strtolower(end($fileExtension)); //makes sure extension is in small letters
		if($fileError === 0)
		{
			if($fileSize < 1000000000)
			{
				$fileNewName = "profile"."$fname.".$fileActualExtention;
				$fileDestination = 'Images/'. $fileNewName;
				move_uploaded_file($fileTmpName, $fileDestination);
				$sql = "INSERT INTO usertable(Name,Email,UserPass,City,ProfPhoto) VALUES ('$fname', '$Mail', '$Pass', '$Address', '$fileDestination');";
				mysqli_query($link, $sql);
			}
			else
			{
				echo "Your file was too big.";
			}
		}
		else
		{
			echo "There was an error uploading your file";
		}
}
else
{
	echo "Wrong";
}

?>