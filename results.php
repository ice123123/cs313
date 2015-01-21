<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="index.css">
		
		<title>Justin Hurley's home page</title>
	</head>

	<body> 
<?php

	//$lines = file('data.txt');
	
	//foreach($lines as $line_num => $line)
	//{
		$text = "read test";
		$myfile = fopen("/OPENSHIFT_DATA_DIR/survey_data.txt", "w");
		fwrite($myfile, $text);
		fclose($myfile);
		$myfile = fopen("/OPENSHIFT_DATA_DIR/survey_data.txt", "w");
		echo fread($myfile, filesize("/OPENSHIFT_DATA_DIR/survey_data.txt"));
		fclose($myfile);
	//}
?>
	</body>
</html>