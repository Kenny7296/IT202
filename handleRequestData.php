<?php
	echo "<pre>" . var_dump($_GET, true) . "</pre>";

	if(isset($_GET['name']))
	{
		echo "<br>Hello, " . $_GET['name'] . "!<br>";
	}
	//TODO
	//handle addition of 2 or more parameters with proper number parsing
	//concatenate 2 or more parameter values and echo them
	//try passing multiple same-named parameters with different values
	//try passing a parameter value with special characters

	if(isset($_GET['number']))
	{
		$number = $_GET['number'];
		echo "<br>" . $number . " should be a number, but it might not be... let me check.<br>";
		echo "<br>Calculating...<br>";
		echo "<br>Calculating...<br>";
		echo "<br>Calculating...<br>";

		if (is_numeric($number))
		{
			echo "<br>$number is a number!<br>", PHP_EOL;
		}

		else
		{
			echo "<br>$number is not a number. Try a different value.<br>", PHP_EOL;
		}
	}

	//web.njit.edu/~kc458/IT202/handleRequestData.php?parameter1=a&p2=b
?>
