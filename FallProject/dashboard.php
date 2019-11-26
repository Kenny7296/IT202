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
</body>
</html>

<?php
	require ("configure.php");
	
	if (isset($_GET['h1']))
	{
		$qID = $_GET['h1'];
	}
	
	else
	{
		$qID = 1;
	}

	$question = 'Question not set';
	$answerA = 'unchecked';
	$answerB = 'unchecked';
	$answerC = 'unchecked';

	$A = "";
	$B = "";
	$C = "";

	$conn_string = "survey";

	$db = new PDO($conn_string, $username, $password);

	if ($db)
	{
		$stmt = $db->prepare("SELECT ID, Question, OptionA, OptionB, OptionC FROM Questions WHERE ID = ?");

		if ($stmt)
		{
			$stmt->bind_param('i', $qID);
			$stmt->execute();
			$res = $stmt->get_result();

			if ($res->num_rows > 0)
			{
				$row = $res->fetch_assoc();

				$qID = $row['ID'];
				$question = $row['Question'];
				$A = $row['OptionA'];
				$B = $row['OptionB'];
				$C = $row['OptionC'];

			}

			else
			{
				print "Error - No rows";
			}
		}

		else
		{
			print "Error - DB ERROR";
		}

	}
	else {
		print "Error getting Survey";
	}


?>
