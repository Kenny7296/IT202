<?php
session_start();
require 'config.php';
$voteMessage = "";

if((isset($_SESSION['Voted'])))
{
	if ($_SESSION['Voted'] = '1')
	{
		$voteMessage = "You've already voted...";
	}
}

else
{
	if(isset($_GET['Submit1']) && isset($_GET['q']))
	{
		$selected_radio = $_GET['q'];
		$IDnumber = $_GET['h1'];

		$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";

		$db = new PDO($conn_string, $username, $password);

		if($db)
		{
			if($selected_radio == "A")
			{
				$vote = "UPDATE Questions SET VotedA = VotedA + 1 WHERE ID = ?";
				$voteMessage = insert_vote($db, $vote, $IDnumber);
			}

			else if($selected_radio == "B")
			{
				$vote = "UPDATE Questions SET VotedB = VotedB + 1 WHERE ID = ?";
				$voteMessage = insert_vote($db, $vote, $IDnumber);
			}
			
			else
			{
				print "Error - could not record vote";
			}	
		}
	}
	
	else
	{
		print "Please vote!";
	}
}

function insert_vote($db, $sql, $id)
{
	$stmt = $db->prepare($sql);
	$stmt->bind_param('i', $id);
	$stmt->execute();

	return "Thanks for voting!";
}

?>

<html>
<head>
</head>
<body>
<?PHP print $voteMessage . "<BR>"; ?>
</body>
</html>
