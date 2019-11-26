<?php
require ("config.php");
$question = '';
$answerA = '';
$answerB = '';
$answerC = '';

$imgTagA = '';
$imgWidthA = '0';

$imgTagB = '';
$imgWidthB = '0';

$imgTagC = '';
$imgWidthC = '0';

$imgHeight = '10';
$totalP = '';
$percentA = '0';
$percentB = '0';
$percentC = '0';

$qA = '';
$qB = '';
$qC = '';

	if (isset($_GET['Submit2']) && isset($_GET['h1']))
	{
		$qNum = $_GET['h1'];

		$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
		$db = new PDO($conn_string, $username, $password);

		$stmt = $db->prepare("SELECT * FROM `Questions` WHERE ID = ?");
		$stmt->execute(array("i"=>$qNum));

		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($result->num_rows > 0)
		{
			$db_field = $results;

			$question = $db_field['Question'];
			$answerA = $db_field['OptionA'];
			$answerB = $db_field['OptionB'];
		
			$qA = $db_field['VotedA'];
			$qB = $db_field['VotedB'];

			$totalP = $qA + $qB;

			$percentA = (($qA * 100) / $totalP);
			$percentA = floor($percentA);

			$percentB = (($qB * 100) / $totalP);
			$percentB = floor($percentB);

			$imgWidthA = $percentA * 2;
			$imgWidthB = $percentB * 2;

			//$imgTagA = "<IMG SRC = 'red.jpg' Height = " . $imgHeight . " WIDTH = " . $imgWidthA. ">";
			//$imgTagB = "<IMG SRC = 'red.jpg' Height = " . $imgHeight . " WIDTH = " . $imgWidthB . ">";
		}

		else
		{
			echo "ROW ERROR";
		}
	}

	else
	{
		echo "no results to display";
	}
?>

<html>
<head></head>
<body>
<?php
print $question . "<BR>";
print $answerA . " " . $imgTagA . " " . $percentA . "% " . $qA . "<BR>";
print $answerB . " " .$imgTagB . " " . $percentB . "% " . $qB . "<BR>";
print $answerC . " " .$imgTagC . " " . $percentC . "% " . $qC . "<BR>";
?>
</body>
</html>
