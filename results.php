<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="index.css">
		
		<title>Justin Hurley's home page</title>
	</head>

	<body> 
<?php
	$lines = file('data.txt');
	
	foreach($lines as $line_num => $line)
	{
		echo "$line\n";
	}
?>
	</body>
</html>