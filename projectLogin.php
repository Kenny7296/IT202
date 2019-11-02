<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try
{
	if((isset($_POST['username'])) && isset($_POST['password']))
	{		
		require('config.php');

		$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
		$db = new PDO($conn_string, $username, $password);		

		$username = $_POST['username'];
		$password = $_POST['password'];	

		$select_query = "SELECT * FROM `TestUsers` WHERE username = :username AND pin = :pin";
		$stmt = $db->prepare($select_query);
	
		$stmt->execute(array(":username"=>$username, ":pin"=>$password));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		if($stmt->errorInfo())
		{
			print_r($stmt->errorInfo());
		}
		
		else
		{
			if($results["password"] == $_POST['password'])
			{
				echo $results["id"];
			}
			
			else
			{
				echo "Something is incorrect";
			}
		}
	}
}

catch(Exception $e)
{
	echo $e->getMessage();
	exit("\nIt didn't work");
}	
?>

<html>
<head>
</head>
<body>
      	<form method="POST" action="#">
                <input type="text" name="username" placeholder="Enter username"/>
                <input type="password" name="password" placeholder="Enter a password"/>
                <input type="submit" value="Login"/>
        </form>
</body>
</html>

<?php
if(isset($_POST))
        {
                echo "<br><pre>" . var_export($_POST, true) . "</pre><br>";
        }
?>
