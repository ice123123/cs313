<?php
	require 'password.php';

	session_start();

	$loginSuccess = false;
	
	$dbHost = "";
	$dbPort = "";
	$dbUser = "deleteAccount";
	$dbPassword = "delete";
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
	
	$results = $db->prepare("SELECT id, password FROM user WHERE username=:username");
	$results->bindParam(':username', $_POST["username"]);
	$results->execute();
	
	$databaseResults = $results->fetch(PDO::FETCH_ASSOC);
	
	//checks for valid login info
	if(password_verify($_POST["password"], $databaseResults['password']))
	{
		$loginSuccess = true;
		$_SESSION['username'] = $_POST['username'];
		
		$query = $db->prepare('SELECT c.id FROM cart AS c
			                       JOIN user AS u ON u.id = c.user_id
								   WHERE u.username=:username');
		$query->bindValue(':username', $_POST["username"], PDO::PARAM_STR);								   
								   
		$query->execute();

		//check size of current cart
		if(isset($_SESSION['cart']))
		{
			$cartSize = $db->prepare('SELECT c.id FROM cart AS c
								   JOIN game_cart_lookup AS gcl ON gcl.cart_id = c.id
								   WHERE c.id=:cart');
			$cartSize->bindValue(':cart', $_SESSION['cart'], PDO::PARAM_INT);
			$cartSize->execute();
		}
		
		//check if a prev cart exist and a current cart is either non existent or no items in it
		if($query->rowCount() > 0 && (!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && $cartSize->rowCount() == 0)))
		{
			//delete current cart
			if(isset($_SESSION['cart']))
			{
				$delete = $db->prepare('DELETE FROM cart where id = :cart');
				$delete->bindValue(':cart', $_SESSION['cart'], PDO::PARAM_INT);	
				$delete->execute();
			}
			
			//set cart with previous cart
			$row = $query->fetch(PDO::FETCH_ASSOC);
			$_SESSION['cart'] = $row['id'];	
		}
		else
		{	//check previous cart and delete it (to be replaced by current cart)
			if($query->rowCount() > 0)
			{
				//echo "in the delete area";
				$delete = $db->prepare('Delete gcl.* FROM game_cart_lookup AS gcl 
				                        JOIN cart AS c ON c.id = gcl.cart_id
										JOIN user AS u ON u.id = c.user_id
										WHERE u.username=:username');
				$delete->bindValue(':username', $_POST["username"], PDO::PARAM_STR);	
				$delete->execute();
				
				$delete = $db->prepare('DELETE c.* FROM cart AS c
									   JOIN user AS u ON u.id = c.user_id
									   WHERE u.username=:username');
				$delete->bindValue(':username', $_POST["username"], PDO::PARAM_STR);	
				$delete->execute();
			}
			
			//there is no previous cart or current cart, create new cart
			if(!isset($_SESSION['cart']))
			{
				$insert = $db->prepare('INSERT INTO cart VALUES ()');
				$insert->execute();
				$_SESSION['cart'] = $db->lastInsertId();			
			}
			
			//bind the current cart to the user
			$update = $db->prepare('UPDATE cart SET user_id = :user_id WHERE id = :cart');
			$update->bindValue(':user_id', $databaseResults['id'] , PDO::PARAM_INT);	
			$update->bindValue(':cart', $_SESSION['cart'], PDO::PARAM_INT);	
			$update->execute();
		} 
	}
	else
		$loginSuccess = false;
?>


<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" type="text/css" href="index.css"> -->
		<?php 
			if($loginSuccess == false) 
				echo '<meta http-equiv="refresh" content="2;url=login.php" />'; 
			else 
				echo '<meta http-equiv="refresh" content="0;url=homepage.php" />'; 
		?>
		<title>login</title>
	</head>

	<body>
		<?php 
			if($loginSuccess == false) 
				echo '<p> Login failed. Redirecting to login page</p>'; 
			else 
			{
				echo '<p> Login Successful </p>'; 
			}
		?>
	</body>
</html>