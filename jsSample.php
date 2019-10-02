<html>
<head>
	<script>
	function mySamples()
	{
//		var myVar = 10;
//		alert("My var is " + myVar);
		console.log("Hello, World!");

//		var name = prompt("What's your name?");
//		alert("Hello, " + name);

		var number = 0;
		for(var i = 0; i < 10; i++)
		{
			number += 0.1;
		}

		console.log("Added float is " + number);

		var myParagraph = document.getElementById("myPara");
		myParagraph.innerText = "Changed it";

		let number1 = parseInt(prompt("Pick a number"));
		let number2 = parseInt(prompt("Pick another number"));
		myParagraph.innerText = number1 + " + " + number2 + " = ";
		myParagraph.innerText += (number1+number2);
		console.log(myParagraph);

		//TODO
		//Google how to create an element and add it to the DOM
		//create a div tag, add "added new element" as the text
		//add it to the DOM body

		let myDiv = document.createElement("DIV");
		myDiv.innerText = "Added new element.";
		document.body.appendChild(myDiv);
/*
		//using text node, this is uncommon
		let text = document.createTextNode("Added new element.");
		myDiv.appendChild(text);
		document.body.appendChild(myDiv);
*/
	}
	</script>
</head>
	<body onload="mySamples();">
		<p id="myPara">Just showing that we loaded something!</p>
		<br><a href="https://github.com/Kenny7296/IT202/blob/master/jsSample.php">Github Repo</a><br>
	</body>
</html>
<?php
if(isset($_GET['name']))
	{
		$name = $_GET['name'];
		echo "<br>Your GET name is " . $name . "!<br>";
	}
?>
