<?php
	$errorFlag = false;
	
	try
	{
		$user = "queryInsertOnly";
		$password = "insert"; 
		$db = new PDO("mysql:host=localhost;dbname=game_store", $user, $password);
	}
	catch (PDOException $ex) 
	{
		echo "Error!: " . $ex->getMessage();
		die(); 
	}
	
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