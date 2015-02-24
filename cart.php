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
	
	if(!isset($_SESSION['cart']))
	{
		$insert = $db->prepare('INSERT INTO cart VALUES ()');
		$insert->execute();
		$_SESSION['cart'] = $db->lastInsertId();
	}
	
	if(isset($_POST['delete']))
	{
		$query = $db->prepare('SELECT gcl.id FROM game_cart_lookup AS gcl
		                       JOIN cart as c ON c.id = gcl.cart_id
							   WHERE gcl.game_id = :id AND c.id = :cart');
							   
		$query->bindValue(':id', $_POST['delete'], PDO::PARAM_INT);	
		$query->bindValue(':cart', $_SESSION['cart'], PDO::PARAM_INT);	
		$query->execute();
		$id = $query->fetch(PDO::FETCH_ASSOC);
		
		$delete = $db->prepare('delete FROM game_cart_lookup WHERE id = :id');
		$delete->bindValue(':id', $id['id'], PDO::PARAM_INT);	
		$delete->execute();
		
		
	}
	
	if(isset($_POST['item']))
	{
		$insert = $db->prepare('INSERT INTO game_cart_lookup (game_id, cart_id) VALUES (:game, :cart);');
		$insert->bindValue(':game', $_POST['item'], PDO::PARAM_INT);	
		$insert->bindValue(':cart', $_SESSION["cart"], PDO::PARAM_INT);	
		$insert->execute();
	}
	
	$query = $db->prepare('SELECT c.id, g.id, g.name, g.picture, g.price, COUNT(g.id) AS quantity FROM cart AS c
						JOIN game_cart_lookup AS gcl ON gcl.cart_id = c.id
						JOIN game AS g ON g.id = gcl.game_id
						WHERE c.id = :cart
						group by g.id');
	$query->bindValue(':cart', $_SESSION['cart'], PDO::PARAM_INT);	
	$query->execute();
	
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
		
		<br />
		<br />
		<br />
		<?php
			if($query->rowCount() == 0)
			{
				echo "<p class='center'>No items in your cart.</p>";
			}
			else
			{
				$totalCost = 0;
				echo "<form method='post' action='cart.php'>";
				echo "<table class='cart' BORDER=1 CELLPADDING=3 CELLSPACING=1 RULES=COLS FRAME=VSIDES>";
				echo "<tr><td><b>QTY</b></td><td><b>Price</b></td> <td><b>Title</b></td><td></td></tr>";
				
				
				foreach($query as $row)
				{
					echo "<tr>";
					echo "<td class='qty'>" . $row['quantity'] . "</td>";
					echo "<td class='price'>$" . $row['price'] . "</td>";
				    echo "<td class='name'>" . $row['name'] . "</td>";
					echo "<td class='remove'><button type='submit' name='delete' value='" . $row['id'] . "'>remove</button></td>";
					echo "</tr>";
					$totalCost += ($row['price'] * $row['quantity']);
				}
				echo "</table>";
				echo "<br />";
				echo "<br />";
				echo "<p class='purchase'><b>Total :$" . $totalCost . "</b></p>";
				echo "<div class='center'><button class='purchase' type=\"button\" onclick=\"location.href='purchseSuccess.php'\">Purchase</button></div>";
				
				echo "</form>";
			}
		?>
		
	<br />
	</body>
<html>