<?php
//helper
function getName()
{
	if(isset($_GET['name']))	
	{
		$name = $_GET['name'];
		echo "<p>Hello, " . $name . "</p>";
	}
}
?>
<html>
<head></head>
<body>
	<?php getName();?>
		<form mode="GET" action="#">
			<input name="name" type="text" placeholder="Enter your name"/>
			<input name="number" type="number" placeholder="Enter a number"/>
			<input name="password" type="password" placeholder="Enter a FAKE password"/>
			
			<label for="Yes">Yes</label> <!-- for="id of element""-->
			<input type="radio" name="radio" id="Yes" value="Yes"/>

			<label for="No">No</label>
			<input type="radio" name="radio" id="No" value="No"/>

			<select name="dropdown">
				<option value="1">One</option>
				<option value="2">Two</option>	
				<option value="3">Three</option>

			<input type="checkbox" name="check"/>
			<textarea name="text"></textarea>
			<input type="date" name="date"/>
			<input type="submit" value="Try it"/>
		</form>
</body>
</html>

<?php
if(isset($_GET))
{
	echo "<br><pre>" . var_export($_GET, true) . "</pre><br>";
}
