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

	<form name="form1" method="POST">
		<input type="hidden" name="ID" value="<?php echo $row['ID'];?>"/>
		<input type="radio" name="A" value="<?php echo $row['OptionA'];?>"/>
		<input type="radio" name="B" value="<?php echo $row['OptionB'];?>"/> 

		<input type="Submit" value="Click here to vote"/>
	</form>


	<form name="form2" method="POST" action="results.php">
		<input type="Submit" name="Submit2" value="View results"/>
	</form>
</body>
0</html>

<?php
	if(isset($_POST['Question']))
	{
		$Question = $_POST['Question'];

		try
		{
			require ("config.php");

			$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
			$db = new PDO($conn_string, $username, $password);

			$stmt = $db->prepare("SELECT ID, Question, OptionA, OptionB FROM `Questions` WHERE Question = :Question");
			$stmt->execute(array(":Question"=>$Question));

			$results = $stmt->fetch(PDO::FETCH_ASSOC);

			if($results && count($results) > 0)
			{
				$Question = array("ID"=> $results['ID'], "question"=> $results['Question'], "A"=> $results['OptionA'], "B"=> $results['OptionB']);
				$_SESSION['Question'] = $Question;
				echo var_export($Question, true);
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
