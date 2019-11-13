<?php
#turn error reporting on
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('config.php');

$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
try
{
	foreach(glob("sql/*.sql") as $filename)
	{
		//echo $filename;
		$sql[$filename] = file_get_contents($filename);
		//echo $sql[$filename];
	}

	ksort($sql);
	
	$db = new PDO($conn_string, $username, $password);
	
	foreach($sql as $key => $value)
	{
		echo "<br>Running: " . $key;
		$stmt = $db->prepare($value);
		$result = $stmt->execute();
		$error = $stmt->errorInfo();
		
		if($error && $error[0] !== '00000')
		{
			echo "<br>Error:<pre>" . var_export($error,true) . "</pre><br>";
		}

		echo "<br>$key result: " . ($result>0?"Success":"Fail") . "<br>";$db = new PDO($conn_string, $username, $password);
	}
}

catch(Exception $e)
{
	echo $e->getMessage();
	exit("\nIt didn't work");
}

?>
