<?php
	try
	{
		$user = "queryOnly";
		$password = "query"; 
		$db = new PDO("mysql:host=localhost;dbname=game_store", $user, $password);
	}
	catch (PDOException $ex) 
	{
		echo "Error!: " . $ex->getMessage();
		die(); 
	}
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