<?php
	session_start();

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
		
		
		
		<h1> Hurley's Game Shop</h1>
		<p class="featured">Featured Items: </p>
		<form method="POST" action="cart.php">
			<?php
				foreach ($db->query("SELECT name, id, picture, price FROM game WHERE featured='1';") as $row)
				{
				  echo "<table class='home'> <tr><td>" . substr($row['name'], 0, 21) . "</td></tr>";
				  echo "<tr><td class='center'><img src='" . $row['picture'] . "'> </td></tr>";
				  echo "<tr><td>Price: $" . $row['price'] . "<button class='shift' type='submit' name='item' value='" . $row['id'] . "'>Add</button></td></tr></table>";
				}

				echo "<br />";
			?>
		</form>

	 <p style="clear: both"></p>
	</body>
</html>