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
		
		<title>Advance Search</title>
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
		<h1>Advance Search</h1>
		<br />
		<form method="POST" action="searchResults.php">
			<table class='login'>
				<tr>
					<td class="right">Key Word:</td>
					<td class="left"><input type="text" name="keyWord" id="keyWord" /></td>
				</tr>
				<tr>
					<td class="right">Rating:</td>
					<td class="left"> 
						<select name='rating'>
							<option  value=''></option>
						<?php
							$query = $db->prepare("SELECT rating from game group by rating;");
							$query->execute();
							
							while ($row = $query->fetch(PDO::FETCH_ASSOC))
							{
								echo "<option value='" . $row['rating'] . "'>" . $row['rating'] . "</option>";	
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="right">Console:</td>
					<td class="left">
						<select name='console'>
							<option value=''></option>
							<?php
								$query = $db->prepare("SELECT name from console;");
								$query->execute();
								
								while ($row = $query->fetch(PDO::FETCH_ASSOC))
								{
									echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";	
								}
							?>
						</select>
					<td>
				</tr>
				<tr>
					<td>
					<td class="left"><button type="submit"> Search </button>
				</tr>
			</table>
		</form>
			
	</body>
	
</html>