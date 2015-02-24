<?php
	session_start();

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
	
	if(isset($_SESSION['cart']))
	{	
		$delete = $db->prepare('Delete gcl.* FROM game_cart_lookup AS gcl 
								JOIN cart AS c ON c.id = gcl.cart_id
								WHERE c.id=:cart');
		$delete->bindValue(':cart', $_SESSION['cart'], PDO::PARAM_INT);	
		$delete->execute();
					
		$delete = $db->prepare('DELETE c.* FROM cart AS c
							   JOIN user AS u ON u.id = c.user_id
							   WHERE c.id=:cart');
		$delete->bindValue(':cart', $_SESSION['cart'], PDO::PARAM_INT);	
		$delete->execute();
	}
?>	
	


<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="game.css">
		
		<title>Games</title>
	</head>

	<body>
		<br />
		<form method="GET" action="searchResults.php">
			<input class="shift" type="text" name="search"><button type="submit">Search</button>
			<button type="button" onclick="location.href='advancedSearch.php'">Advanced Search</button>
			<span class="alignright">
			
				<?php
					if(isset($_SESSION['username']) && $_SESSION['username'] != "")
					{
						echo "User: " . $_SESSION['username'];
						echo "<button class=\"shift\" type=\"button\" onclick=\"location.href='logout.php'\">logout</button>";
					}
					else
						echo "<button class=\"shift\" type=\"button\" onclick=\"location.href='login.php'\">Login</button>";
				?>
				<button class="shift" type="button" onclick="location.href='cart.php'">Cart</button>
				</span>		
		</form>
			
		<p class='center'>Your purchase was successful!</p>
					
	</body>
</html>