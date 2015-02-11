<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="game.css">
		
		<title>login</title>
	</head>

	<body>
	<form method="POST" action="loginConfirm.php">
		<p>User name:<input type="text" name="username" /> </p>
		<p>Password: <input type="password" name="password" /></p>
		<button type="submit" name="login">Login </button><button type="button" onclick="location.href='newUser.php'">Create Account</button>
	</form>
	
	<br />
	</body>
</html>
