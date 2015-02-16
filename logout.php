<?php
	session_start();

	if(isset($_SESSION['username']) && $_SESSION['username'] != "")
	{
		session_unset();
		header("Location: homepage.php");
		die();
	}

?>

<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="game.css">
		
		<title>Logout</title>
	</head>

	<body>
		<h1>Error: no one was logged in </h1>
	</body>
	
</html>
