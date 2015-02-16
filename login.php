<!DOCTYPE HTML>
<?php
	session_start();
?>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="game.css">
		
		<title>login</title>
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
		
		<h1>Login</h1>
		<form method="POST" action="loginConfirm.php">
			<table class="login">
				<tr>
					<td  class="right">User Name:</td>
					<td><input type="text" name="username" /></td>
				</tr>
				<tr>
					<td  class="right">Password:</td>
					<td><input type="password" name="password" /></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit" name="login">Login </button>
						<button type="button" onclick="location.href='newUser.php'">Create Account</button>
					</td>
			</table>
		</form>
	
	<br />
	</body>
</html>
