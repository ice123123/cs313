<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="index.css">
		
		<title>results</title>
	</head>

	<body>
	<?php echo "test"; ?>
	<?php
		class Professor {
			private $num_votes;
			private $average;
	
			function __construct($raw_data)
			{
				if (strlen($raw_data) > 0)
				{
					$data = explode($raw_data, " ");
					$this->average = $data[0];
					$this->num_votes = $data[1];
				}
				else
				{
					$this->average = 0;
					$this->num_votes = 0;
				}
			}
			
		
		}
	
		$myfile = fopen($_ENV["OPENSHIFT_DATA_DIR"] . "survey_data.txt", "w")
		$lines = file($_ENV["OPENSHIFT_DATA_DIR"] . "survey_data.txt");
		
		/*if(count($lines) >= 5)
		{
			$burton = new Professor($lines[0]);
			$neff = new Professor($lines[0]);
			$twitchell = new Professor($lines[0]);
			$helfrich = new Professor($lines[0]);
			$ercanbrack = new Professor($lines[0]);
		}
		else
		{
			$burton = new Professor();
			$neff = new Professor();
			$twitchell = new Professor();
			$helfrich = new Professor();
			$ercanbrack = new Professor();
		}*/
		

			/*$user_burton = $_POST["Burton"];
			$user_neff = $_POST["Neff"];
			$user_twitchell = $_POST["Twitchell"];
			$user_helfrich = $_POST["Helfrich"];
			$user_ercanbrack = $_POST["Ercanbrack"];
			
			echo $Helfrich['0'];

			$myfile = fopen($_ENV["OPENSHIFT_DATA_DIR"] . "survey_data.txt", "w");
			echo fread($myfile, filesize($_ENV["OPENSHIFT_DATA_DIR"] . "survey_data.txt"));
			fclose($myfile);*/
		
	?>
	</body>
</html>