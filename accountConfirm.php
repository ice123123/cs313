<?php
	$errorFlag = false;
	$username = $_POST["username"];
	$password = $_POST["password"];
	$first_name = $_POST["firstName"];
	$last_name = $_POST["lastName"];
	$age = $_POST["age"];
	
	$dbHost = "";
	$dbPort = "";
	$dbUser = "queryInsertOnly";
	$dbPassword = "insert";
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
?>
<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
		<?php
			if($errorFlag == true)
			{
				
			
			}
			else
			{
			
			
			
			}
		?>
		<title>Games</title>
	</head>
	<body>
		<?php
			if($errorFlag == true)
			{
			
			
			
			}
			else
			{
			
			
			
			}
		?>
	</body>
</html>