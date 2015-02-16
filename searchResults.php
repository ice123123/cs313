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
		
		<title>Results</title>
	</head>

	<body>
		<br />
		<form method="POST" action="searchResults.php">
			<input class="shift" type="text" name="search"><button type="search" name="login">Search</button>
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
				<button class="shift" type="button" onclick="location.href='homepage.php'">Cart</button>
				</span>		
		</form>
		
		<h1>Results: </h1>
		
		
		<?php
			if(isset($_POST["search"]))
			{
				$query = $db->prepare("SELECT name, id, picture, price FROM game WHERE name LIKE :search;");
				$search = "%" . $_POST["search"] . "%";
				$query->bindParam(':search', $search);
				$query->execute();
				
				while ($row = $query->fetch(PDO::FETCH_ASSOC))
				{
				  echo "<table class='home'> <tr><td>" . substr($row['name'], 0, 21) . "</td></tr>";
				  echo "<tr><td class='center'><img src='" . $row['picture'] . "'> </td></tr>";
				  echo "<tr><td>Price: $" . $row['price'] . "<button class='shift' type='button' value='" . $row['id'] . "'>Add</button></td></tr></table>";
				}

				echo "<br />";
			}
			else if(isset($_POST["keyWord"]))
			{
				$queryString = "SELECT g.name, g.id, g.picture, g.price FROM game as g
										JOIN game_console_lookup AS gcl ON g.id = gcl.game_id
										JOIN console AS c ON c.id = gcl.console_id
										WHERE g.name LIKE :keyWord";
				
				
				$keyWord = "%" . $_POST["keyWord"] . "%";
				$console = "";
				$rating = "";
				
				if($_POST["console"] != "")
					$queryString .= " AND c.name= :console";
				
				if($_POST["rating"] != "")
					$queryString .= " AND rating= :rating";
				
				$query = $db->prepare($queryString);
				
				$query->bindValue(':keyWord', $keyWord,  PDO::PARAM_STR);
				
				if($_POST["console"] != "")
					$query->bindValue(':console', $_POST["console"], PDO::PARAM_STR);
				
				if($_POST["rating"] != "")
					$query->bindValue(':rating', $_POST["rating"], PDO::PARAM_STR);

				$query->execute();
				
				while ($row = $query->fetch(PDO::FETCH_ASSOC))
				{
				  echo "<table class='home'> <tr><td>" . substr($row['name'], 0, 21) . "</td></tr>";
				  echo "<tr><td class='center'><img src='" . $row['picture'] . "'> </td></tr>";
				  echo "<tr><td>Price: $" . $row['price'] . "<button class='shift' type='button' value='" . $row['id'] . "'>Add</button></td></tr></table>";
				}				
			}
		?>
		
	 <p style="clear: both"></p>
	</body>
</html>