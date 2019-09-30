<?php
	echo "<pre>" . var_dump($_GET, true) . "</pre>";

	if(isset($_GET['name']))
	{
		$name = $_GET['name'];
		echo "<br>Hello, " . $name . "!<br>";
	}

	if(isset($_GET['number1']))
	{
		$number1 = $_GET['number1'];
		echo "<br>" . $number1 . " should be a number, but it might not be... let me check.";
		echo "<br>Calculating...";
		echo "<br>Calculating...";
		echo "<br>Calculating...<br>";

		if (is_numeric($number1))
		{
			echo "<br>$number1 is a number!<br>", PHP_EOL;
		}

		else
		{
			echo "<br>$number1 is not a number. Try a different value.<br>", PHP_EOL;
		}
	}
	
	if(isset($_GET['number2']))
        {
                $number2 = $_GET['number2'];
                echo "<br>" . $number2 . " should also be a number, but it might not be... one moment.";
                echo "<br>Calculating...";
                echo "<br>Calculating...";
                echo "<br>Calculating...<br>";

                if (is_numeric($number2))
                {
                        echo "<br>$number2 is a number!<br>", PHP_EOL;
                }

                else
                {
                        echo "<br>$number2 is not a number. Try a different value.<br>", PHP_EOL;
                }
        }

	echo "<br>1. Adding the numbers together yields: " . ($number1 + $number2) . "<br>";

	echo "<br>2. This is a concatenation of values from different parameters: " . $name . $number1 . "<br>";

	echo "<br>3. The GET function only allows the last value to take form, leaving the first value to be overwritten. Therefore, passing two parameters of the same name but different values must be done differently. I even attempt to remedy this directly from the address bar (https://web.njit.edu/~kc458/IT202/handleRequestData.php?name=Kenny&name=Kenny,Br^@n!&number1=2&number2=7) but it could not be done.<br>";

	echo "<br>4. Only specific special characters may be passed, such as these: !@^, but others cannot, such as these: #%.";

	//web.njit.edu/~kc458/IT202/handleRequestData.php?parameter1=a&p2=b
?>
