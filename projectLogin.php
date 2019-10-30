<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//echo "Loaded Host: " . $host;
if((isset($_POST['name'])) && isset($_POST['password']))
{		
	require('config.php');
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";

	$db = new PDO($conn_string, $username, $password);
	echo "Connected";

	$select_query = "select * from `TestUsers` where username = :username and pin = :pin";
	$stmt = $db->prepare($select_query);
	$stmt->bindParam(":username", $_POST['username']);
	$r = $stmt->execute(array(":username"=> "Billy", ":pin"=> "1234"));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);

	if($stmt->errorInfo())
	{
		print_r($stmt->errorInfo());
	}
		
	else
	{
		if($results["pin"] == $_POST['password'] && $results["username"] == $_POST['username'])
		{
			echo $results;
		}
			
		else
		{
			echo "Something is incorrect";
		}
	}
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
