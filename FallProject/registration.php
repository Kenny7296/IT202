<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script>
$(document).ready(function()
{
	$('#register_form').submit(function(event)
	{
		if(this.password.value.length == 0 || this.confirm.value.length == 0)
		{
			alert("Please enter a password and confirm it");
			return false;
		}
		
		let isOk = this.password.value == this.confirm.value;
		
		if(!isOk)
		{
			alert("Password and Confirm password don't match");
		}

		return isOk;
	});
});
</script>
</head>
<body>
	<form id="register_form" method="POST"/>
		<input type="text" name="username" placeholder="Enter username"/>
		<input type="password" name="password" placeholder="Enter password"/>
		<input type="password" name="confirm" placeholder="Confirm password"/>
		<input type="submit" value="Register"/>
	</form>
</body>
</html>

<?php
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm']))
	{		
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$confirm = $_POST['confirm'];
		
		if($pass != $confirm)
		{
			echo "Passwords don't match";
			exit();
		}

		try
		{
			$hash = password_hash($pass, PASSWORD_BCRYPT);

			require("config.php");

			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);
			
			$stmt = $db->prepare("INSERT INTO `Users` (`username`, `password`) VALUES(:username, :password)");
			$result = $stmt->execute(array(":username"=>$user, ":password"=>$hash));

			print_r($stmt->errorInfo());
			
			echo var_export($result, true);
			header("Location: login.php");
		}

		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
?>
