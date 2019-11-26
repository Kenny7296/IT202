<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<html>
<head>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
</script>

<script>
	$(document).ready(function()
	{
		var nav = ["It works?", "I think so!", "Logout"];
		let ul = $("<ul>");
		$("body").append(ul);

		nav.forEach(function(item, index)
		{
			let ele = $("<a>");
			ele.attr("href", "?page="+item);
			ele.text(item);
			ul.append($("<li>").append(ele[0]));
		});	
	});
</script>
</head>
<body>
	Hello there, <?php echo $_SESSION['user']['name'];?>

	<form name="form1" method="GET" action="process.php">
		<input type="radio" name="q" value="A"/>
		<input type="radio" name="q" value="B"/>

		<input type="Submit" name="Submit1" value="Click here to vote"/>
		<!-- <input type="Hidden" name="h1" value=<?php print $ID; ?>/> -->
	</form>


	<form name="form2" method="GET" action="results.php">
		<input type="Submit" name="Submit2" value="View results"/>
		<!-- <input type="Hidden" name="h1" value=<?php print $ID; ?>/> -->
	</form>
</body>
</html>

<?php
	if(isset($_GET['Question']))
	{
		$ID = $_GET['ID'];

		try
		{
			require ("config.php");

			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);

			$stmt = $db->prepare("SELECT ID, Question, OptionA, OptionB FROM `Questions` WHERE ID = 1");
			$stmt->execute(array(":ID"=>$ID));

			$results = $stmt->fetch(PDO::FETCH_ASSOC);

			if($results && count($results) > 0)
			{
				$ID = array("ID"=> $results['ID'], "question"=> $results['Question'], "A"=> $results['OptionA'], "B"=> $results['OptionB']);
				$_SESSION['ID'] = $ID;
				echo var_export($ID, true);
				//echo var_export($_SESSION, true);
			}

			else
			{
				echo "Error getting survey";
			}
		}

		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
?>
