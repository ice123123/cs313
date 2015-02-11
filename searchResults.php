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
?>	
	


<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="game.css">
		
		<title>Results</title>
	</head>

	<body>
		<form method="POST" action="searchResults.php">
			<input type="text" name="search"><button type="search" name="login">Search</button>
			<span class="alignright"><a href="login.php">login</a> cart</span></form>
		
		<p>Results: </p>
		
		
		<?php
		$query =  "SELECT name, picture, price FROM game WHERE name LIKE '%" . $_POST["search"] . "%';";
		foreach ($db->query($query) as $row)
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