<?php
	/*try
	{
		$user = "queryOnly";
		$password = "query"; 
		$db = new PDO("mysql:host=localhost;dbname=game_store", $user, $password);
	}
	catch (PDOException $ex) 
	{
		echo "Error!: " . $ex->getMessage();
		die(); 
	}*/
	
	$dbHost = "";
	$dbPort = "";
	$dbUser = "";
	$dbPassword = "";
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
		$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	}
	
	try
	{
		$db = new PDO("mysql:host=$dbHost;$dbPort;$dbname=$dbName", $dbUser, $dbPassword);
	}
	catch (PDOException $ex) 
	{
		echo "Error!: " . $ex->getMessage();
		die(); 
	}
	//echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";
?>	
<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="game.css">
		
		<title>Games</title>
	</head>

	<body>
			<form method="POST" action="searchResults.php">
			<input type="text" name="search"><button type="search" name="login">Search</button>
			<span class="alignright"><a href="login.php">login</a> cart</span></form>
		
		<h1> Hurley's Game Shop</h1>
		<p>Featured Items: </p>
		<?php
			foreach ($db->query("SELECT name, picture, price FROM game WHERE featured='1';") as $row)
			{
			  echo "<table style='float:left'> <tr><td>" . substr($row['name'], 0, 26) . "</td></tr>";
			  echo "<tr><td class='center'><img src='" . $row['picture'] . "'> </td></tr>";
			  echo "<tr><td>Price: $" . $row['price'] . "</td></tr></table>";
			}

			echo "<br />";
		?>
		
	 <p style="clear: both"></p>
	</body>
</html>