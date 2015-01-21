<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="index.css">
		
		<title>Justin Hurley's home page</title>
	</head>

	<body>
	<?php echo "test"; ?>
<?php

	//$lines = file('data.txt');
	
	//foreach($lines as $line_num => $line)
	//{
		/*$text = "read test";
		$myfile = fopen($_ENV["OPENSHIFT_DATA_DIR"] . "survey_data.txt", "w");
		fwrite($myfile, $text);
		fclose($myfile);*/
		$Helfrich = $_POST["Helfrich"];
			
		echo "$Helfrich\n";
		
		
		
		
		$myfile = fopen($_ENV["OPENSHIFT_DATA_DIR"] . "survey_data.txt", "w");
		echo fread($myfile, filesize($_ENV["OPENSHIFT_DATA_DIR"] . "survey_data.txt"));
		fclose($myfile);
	//}
?>
	</body>
</html>