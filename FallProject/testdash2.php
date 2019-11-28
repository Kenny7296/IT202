<?php
function view_item($ID)
{
	require("config.php");
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);
	
	$stmt = $db->prepare("SELECT * FROM `Questions` WHERE ID = :ID");
	$stmt->execute(array(":ID"=>$ID));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	return $results;
}

function update_item($ID, $A, $B)
{
	require("config.php");
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);

	$stmt = $db->prepare("UPDATE `Questions` SET VotedA = VotedA + 1, VotedB = VotedB + 2, WHERE ID = :ID");
	$r = $stmt->execute(array(":ID"=>$ID, "VotedA + 1"=>$A, "VotedB + 1"=>$B));
	return $r > 0;
}
?>

<?php
	$ID = 1;
	if(isset($_POST['ID']))
	{
		update_item($_POST['ID'], $_POST['VotedA'], $_POST['VotedB']);
	}
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
<?php $row = view_item($ID);?>
<?php if($row): ?>
	<article>
		<p><?php echo $row['Question']; ?></p>
		<form method="POST">
			<label for="yes">Yes</label>
			<input type="radio" name="VotedA" id="yes" value="<?php echo $row['OptionA'];?>"/>
			<label for="no">No</label>
			<input type="radio" name="VotedB" id="no" value="<?php echo $row['OptionB'];?>"/>
			<input type="Submit" value="Pick"/>
		</form>
	</article>
<?php endif; ?>
</body>
</html>