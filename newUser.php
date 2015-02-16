<?php
	session_start();
	
	$errorFlag = false;
	$insertSuccess = false;
	
	if(isset($_POST["username"]))
	{
		$errorFlag = false;
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		$first_name = $_POST["firstName"];
		$last_name = $_POST["lastName"];
		$age = $_POST["age"];
		
		$dbHost = "";
		$dbPort = "";
		$dbUser = "queryInsertOnly";
		$dbPassword = "insert";
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
		
		$results = $db->prepare("SELECT username FROM user WHERE username=:username;");
		$results->bindParam(':username', $_POST["username"]);
		$results->execute();
		
		if($numRows = $results->rowCount() > 0)
			$errorFlag = true;
		else
		{
			$statement = $db->prepare("INSERT INTO user (username, password, first_name, last_name, age) VALUES (:username, :password, :first_name, :last_name, :age)");
			$statement->bindParam(':username', $username);
			$statement->bindParam(':password', $password);
			$statement->bindParam(':first_name', $first_name);
			$statement->bindParam(':last_name', $last_name);
			$statement->bindParam(':age', $age);
			$statement->execute();
			$insertSuccess = true;
		}
	}
?>

<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="game.css">
		<?php 
			if($insertSuccess) 
				echo '<meta http-equiv="refresh" content="0;url=login.php" />'; 
		?>
		
		<title>New User</title>
		<script>
			function valid()
			{
				if(document.getElementById("username").value == "")
				{
					window.alert("Please enter a Username");
					return false;
				}
		
				if(document.getElementById("password").value == "")
				{
					window.alert("Please enter a Password");
					return false;
				}
				
				if(document.getElementById("firstName").value == "")
				{
					window.alert("Please enter a First Name");
					return false;
				}
				
				if(document.getElementById("lastName").value == "")
				{
					window.alert("Please enter a Last Name");
					return false;
				}
				
				if(document.getElementById("age").value == "" && isInt(document.getElementById("age").value) )
				{
					window.alert("Please enter a Age");
					return false;
				}
		
				return true;
			}
			
			function isInt(n)
			{
				return Number(n) === n && n % 1 === 0;
			}
		</script>
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
		<h1>Account Creation</h1>
		<form method="POST" action="newUser.php" onsubmit="return valid();">
			<table class="login" >
				<tr>
					<td class="right">User Name: </td>
					<td><input type="text" name="username" id="username" <?php if($errorFlag == true) echo "value='" . $_POST["username"]. "'"; ?>/></td>
				</tr>
				<tr>
					<td class="right">Password: </td>
					<td><input type="password" name="password" id="password"<?php if($errorFlag == true) echo "value='" . $_POST["password"]. "'"; ?>/></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="firstName" id="firstName" <?php if($errorFlag == true) echo "value='" . $_POST["firstName"]. "'"; ?>/></td>
				</tr>
				<tr>
					<td class="right">Last Name:</td>
					<td><input type="text" name="lastName" id="lastName"<?php if($errorFlag == true) echo "value='" . $_POST["lastName"]. "'"; ?> /></td>
				</tr>
				<tr>
					<td class="right">Age:</td>
					<td><input type="text" name="age" id="age"<?php if($errorFlag == true) echo "value='" . $_POST["age"]. "'"; ?> /></td>
				</tr>
				<tr>
					<td></td>
					<td class="left"><button class="shift" type="submit" name="create">Create </button>&nbsp;<button type="reset">Clear</button></td>
				</tr>
			</table>
		</form>
		<p style="clear: both"></p>
		<?php
			if($errorFlag == true)
				echo "<p class='perror'>That user already exists, please select a different username </p>";
		?>
	</body>
</html>