<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getName()
{
	if(isset($_POST['name']))
	{
		$name = $_POST['name'];
		echo "<p>Hello, " . $name . "</p>";
	}
}
?>

<html>
<head>
	<script>
		function checkPassword(form)
		{ 
                	password = form.password.value; 
                	confirm_password = form.confirm_password.value; 
                	
			if (password != confirm_password)
			{ 
                    		alert ("\nPassword did not match: Please try again...") 
                    		return false;
			} 
  
                	// If same return True. 
                	else
			{ 
                    		return true; 
                	}
		}
	</script>
</head>
<body>
	<?php getName();?>
	<form method="POST" action="#" onSubmit="return checkPassword(this)">
		<input name="name" type="text" placeholder="Enter your name"/>
		<input name="password" type="password" id="password" placeholder="Enter a password"/>
		<input name="confirm_password" type="password" id="confirm_password" placeholder="Confirm password"/>

		<input type="submit" value="Try it"/>
	</form>
</body>
</html>

<?php
if(isset($_POST))
{
	echo "<br><pre>" . var_export($_POST, true) . "</pre><br>";
}
?>
