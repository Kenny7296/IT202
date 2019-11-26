<?php
session_start();
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
		<?php print $question; ?>
		<input type="radio" name="q" value="A"/>
		<input type="radio" name="q" value="B"/>

		<input type="Submit" name="Submit1" value="Click here to vote"/>
		<input type="Hidden" name="h1" value=<?php print $qID; ?>/>
	</form>


	<form name="form2" method="GET" action="results.php">
		<input type="Submit" name="Submit2" value="View results"/>
		<input type="Hidden" name="h1" value=<?php print $qID; ?>/>
	</form>
</body>
</html>

<?php
	require ("config.php");

	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);

	$stmt = $db->prepare("SELECT ID, Question, OptionA, OptionB FROM `Questions` WHERE ID = 1");
	$stmt->execute(array("ID"=>$qID));

	$results = $stmt->fetch(PDO::FETCH_ASSOC);

	if($results && count($results) > 0)
	{
		$qID = array("ID"=> $results['ID'], "question"=> $results['Question'], "A"=> $results['OptionA'], "B"=> $results['OptionB']);
	}

	else
	{
		echo "Error getting survey";
	}
?>
