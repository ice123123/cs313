<?php
	$errorFlag = false;

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
	//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
	
	$results = $db->query("SELECT username FROM user WHERE username='" . $_POST["username"] . "';");
	
	//if($numRows = $results->rowCount() > 0)
	//	$errorFlag = true;
	//else
	//{
		$statement = $db->prepare("INSERT INTO user (username, password, first_name, last_name, age) VALUES (:username, :password, :first_name, :last_name, :age");
		$statement->bindParam(':username', $_POST["username"]);
		$statement->bindParam(':password', $_POST["password"]);
		$statement->bindParam(':first_name', $_POST["firstName"]);
		$statement->bindParam(':last_name', $_POST["lastName"]);
		$statement->bindParam(':age', $_POST["age"]);
		$statement->execute();
	//}
	
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