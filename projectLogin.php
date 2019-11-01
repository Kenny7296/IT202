<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try
{
	if((isset($_POST['username'])) && isset($_POST['pin']))
	{		
		require('config.php');

		$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
		$db = new PDO($conn_string, $username, $password);		
		//$db->setAttribute(PDO::ATTR_ERRMODE);		

		$select_query = "SELECT * FROM `TestUsers` WHERE username = :username AND pin = :pin";
		$stmt = $db->prepare($select_query);
	
		//$stmt->bindValue(":username", $username, PDO::PARAM_STR);	
		//$stmt->bindValue(":pin", $pin, PDO::PARAM_INT);

		$stmt->execute(array(":username"=>"$username", ":pin"=>"$pin"));
		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		if($stmt->errorInfo())
		{
			print_r($stmt->errorInfo());
		}
		
		else
		{
			if($results["pin"] == $_POST['pin'])
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
                <input type="password" name="pin" placeholder="Enter a pin number"/>
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
