<?php

interface Account 
{
	public function register($pdo);
	public function login($pdo);
	public function logout($pdo);
	public function changePassword($pdo);
}

	class User implements Account{

	//properties
	protected $name;
    protected $email;
    protected $password;
    protected $address;
    protected $profilephoto;
    protected $newPass;
    protected $confirmedPass;

    //class constructor
    function __construct()
    {
    	// $this->name = "Unknown";
    	// $this->email = $uemail;
    	// $this->address = "Unknown";
    	// $this->password = $pass;
    	// $this->profilephoto = "None";
    }

    //New Password setter
    public function setNewPass ($new)
    {
    	$this->newPass = $new;
    }

    //New Password getter
    public function getNewPass ()
    {
    	return $this->newPass;
    }

    //Confirmed Password setter
    public function setConfirmedPass ($confirmed)
    {
    	$this->confirmedPass = $confirmed;
    }

    //Confirmed Password getter
    public function getConfirmedPass ()
    {
    	return $this->confirmedPass;
    } 

    //Address setter
    public function setAddress ($add)
    {
    	$this->address = $add;
    }

    //Address getter
    public function getAddress ()
    {
    	return $this->address;
    }

    //full name setter
    public function setFullName ($name)
    {
    	$this->name = $name;
    }

    //full name getter
    public function getFullName ()
    {
    	return $this->name;
    }

    // Email setter
    public function setEmail ($mail)
    {
    	$this->email = $mail;
    }

    //Email getter
    public function getEmail ()
    {
    	return $this->email;
    }

    //Password setter
    public function setPassword ($password)
    {
    	$this->password = $password;
    }

    //Password getter
    public function getPassword ()
    {
    	return $this->password;
    }

    //Profile setter
    public function setProfile ($photo, $pdo)
    {
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
				$fileNewName = 'profile'.$this->getEmail().'.'.$fileActualExtention;
				$this->fileDestination = 'Images/'. $fileNewName;
				move_uploaded_file($fileTmpName, $this->fileDestination);
				try 
				{
					$stmt = $pdo->prepare('INSERT INTO ProfPhoto VALUES (?)');
					$stmt->execute($this->fileDestination);
				} catch (PDOException $e) {
					return $e->getMessage();
				}
			}
			else
			{
				return 'Your file is too big';
			}
		}
		else
		{
			return 'There was an error uploading your image';
		}
	}

	//Profile getter
	public function getProfile ()
    {
    	return $this->fileDestination;
    }

    public function register ($pdo)
    {
    	$passwordHash = password_hash($this->getPassword(), PASSWORD_DEFAULT);
    	try {
    		$stmt = $pdo->prepare ('INSERT INTO usertable(Name, Email, UserPass, City,ProfPhoto) VALUES (?, ?, ?, ?, ?)');
    		$stmt->execute([$this->getFullName(), $this->getEmail(), $passwordHash, $this->getAddress(),$this->getProfile()]);
    		//echo $this->getEmail();
    		header("Location: Login.php");
    		return "Registration was successful.";
    	} catch (PDOException $e) {
    		return $e->getMessage();
    	}
    }

    public function login ($pdo)
    {
    	try 
    	{
    		$stmt = $pdo->prepare('SELECT Email, UserPass FROM usertable WHERE Email = ?');
    		$stmt->execute([$this->getEmail()]);
    		//var_dump($this->getEmail()); 

    		$row = $stmt->fetch();
    		   	
    		if ($row == null)
    		{
    			//echo $this->getEmail();
    			return "Account absent";
    		}
    		else
    		{
    			if(password_verify($this->getPassword(),$row['UserPass']))
	    		{
	    			//echo 'Small brain Ass';
	    			session_start();
					$_SESSION['Email'] = $row['Email'];
	    			
	    			echo 'Welcome '.$_SESSION['Email'];
	    			echo '<br><br>';

	    			//eader("Location: index.php");
	    			echo 'Correct. Welcome to the tower...';
	    			header("Location: Land.php");
	    		}
	    		else
	    		{
	    			return "Your username or password is incorrect";
	    		}
	    	}  		
    	} catch (PDOException $e) {
    		return $e->getMessage();
    	}
    }
    public function logout($pdo)
    {
    	//require_once 'index.php';
    	session_start();
    	session_unset();
    	session_destroy();

    	header("Location:Land.php");

    	//echo 'See you soon';
    }

    public function changePassword ($pdo)
    {
    session_start();
            
                if($this->getNewPass() == $this->getConfirmedPass())
                {
                    $hashed = password_hash($this->getConfirmedPass(), PASSWORD_DEFAULT);
                    $data = [ 
                                'hashed' => $hashed, 
                                'mailed' => $_SESSION['Email']
                            ];
                    $stmt = $pdo->prepare("UPDATE usertable SET UserPass=:hashed WHERE Email=:mailed");
                    $stmt->execute($data);
                    
                    header("Location:Land.php?Change=success");
                }
                else
                {
                    echo "Passwords do not match";
                }
    }
}

?>