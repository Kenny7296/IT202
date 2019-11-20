<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head></head>
<body>
	<form method="POST" onsubmit="return checkPasswords(this);"/>
		<input type="text" name="username" placeholder="Enter username"/>
		<input type="password" name="password" placeholder="Enter password"/>
		<input type="submit" value="Login"/>
	</form>
</body>
</html>

<?php

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm']))
{	
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$confirm = $_POST['confirm'];
		
	try
	{
		require('config.php');
		
		$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
		$db = new PDO($conn_string, $username, $password);

		$stmt = $db->prepare("SELECT id, username, password FROM `Project` WHERE username = :username LIMIT 1";
		$stmt->execute(array(":username"=>$user));

		$results = $stmt->fetch(PDO::FETCH_ASSOC);
	
		if($results && count($results) > 0)
		{
			//$hash = password_hash($pass, PASSWORD_BCRYPT);
			if(password_verify($pass, $results['password']))
			{
				echo "Welcome, " . $results["username"];
				echo "[" . $results["id"] . "]";
				$user = array("id"=> $results['id'],
							"name"=> $results['username']
								);
					$_SESSION['user'] = $user;
					echo var_export($user, true);
					echo var_export($_SESSION, true);
					header("Location: samplelandingpage.php");		
			}

			else
			{
				echo "Invalid password";
			}
		}
		
		else
		{
			echo "Invalid username";
		}	

	}

	catch(Exception $e)
	{
		echo $e->getMessage();
		exit("\nIt didn't work");
	}
}	
?>
