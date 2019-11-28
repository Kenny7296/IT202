<?php
function get_text_with_choices($post_ID)
{
	require("config.php");
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);
	
	//Lookup post by id
	$stmt = $db->prepare("SELECT ID, Question, OptionA, OptionB FROM `Questions` WHERE ID = :post_ID");
	$stmt->execute(array(":post_ID"=>$post_ID));
	$results = $stmt->fetch(PDO::FETCH_ASSOC);
	return $results;
}
?>

<?php
$post_id = 1;
if(isset($_POST['choice']))
{
	$post_ID = $_POST['choice'];
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
<?php $row = get_text_with_choices($post_id);?>
<?php if($row): ?>
		<article>
                	<p><?php echo $row['Question']; ?></p>
                	<form method="POST">
				<label for="yes">Yes</label>
				<input type="radio" name="choice" id="yes" value="<?php echo $row['OptionA'];?>"/>
				<label for="no">No</label>
				<input type="radio" name="choice" id="no" value="<?php echo $row['OptionB'];?>"/>
				<input type="Submit" value="Pick"/>
			</form>
		</article>
<?php endif; ?> 
</body>
</html>
