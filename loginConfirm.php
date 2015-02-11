<?php
	$dbHost = "";
	$dbPort = "";
	$dbUser = "queryOnly";
	$dbPassword = "query";
	$dbName = "game_store";
	
	$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
	
	if ($openShiftVar === null || $openShiftVar == "")
	{
		require("setLocalDatabaseCrentials.php");
	}
	else
	{
		$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
		//$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		//$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	}
	
	try
	{
		$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	}
	catch (PDOException $ex) 
	{
		echo "Error!: " . $ex->getMessage();
		die(); 
	}
	//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
	
	$results = $db->query("SELECT username FROM user WHERE username='" . $_POST["username"] . "' AND password='" .  $_POST["password"] . "';");
	
	$numRows = $results->rowCount();	
?>


<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
		<?php 
			if($numRows == 0) 
				echo '<meta http-equiv="refresh" content="2;url=login.php" />'; 
			else 
				echo '<meta http-equiv="refresh" content="0;url=homepage.php" />'; 
		?>
		<title>login</title>
	</head>

	<body>
		<?php 
			if($numRows == 0) 
				echo '<p> Login failed. Redirecting to login page</p>'; 
			else 
				echo '<p> Login Successful </p>'; 
		?>
	</body>
</html>