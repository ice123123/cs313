<?php
	session_start();
	
	class Professor {
		private $numVotes;
		private $average;
		private $name;
	
		function __construct($name, $average, $numVotes) {
			$this->average = $average;
			$this->numVotes = $numVotes;
			$this->name = $name;
		}
		
		public function add($rating) {
			$this->average = (($this->numVotes * $this->average) + $rating)/($this->numVotes + 1);
			$this->numVotes += 1;
		}
			
		public function getName() {
			return $this->name;
		}
			
		public function getAverage() {
			return $this->average;
		}
			
		public function getNumVotes() {
			return $this->numVotes;
		}		
		
		public function getData() {
			return $this->average . " " . $this->numVotes;
		}
	}
	$fileName = "survey_data.txt";
		
	if(file_exists($fileName)) {
		$newfile = fopen($fileName, "r") or die("Unable to open file");
		$data = explode(" ", fread($newfile, filesize($fileName)));
		fclose($newfile);
		
		$professors = array(new Professor("Burton", $data[0], $data[1]), new Professor("Neff", $data[2], $data[3]), new Professor("Twitchell", $data[4], $data[5]), new Professor("Helfrich", $data[6], $data[7]), new Professor("Ercanbrack", $data[8], $data[9]));
	}
	else {
		$professors = array(new Professor("Burton", 0, 0), new Professor("Neff", 0, 0), new Professor("Twitchell", 0, 0), new Professor("Helfrich", 0, 0), new Professor("Ercanbrack", 0, 0));
	}
		
	$file = fopen($fileName, 'w');
		
	if(!isset($_SESSION["hasVoted"]))
		foreach($professors as $professor) {
			if(isset($_POST[($professor->getName())]))
			{
				$professor->add($_POST[($professor->getName())]);	
				$_SESSION["hasVoted"] = "voted";
			}
		}	

	foreach($professors as $professor)
		fwrite($file, $professor->getData() . " ");
?>
<!DOCTYPE HTML>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="survey.css">
		
		<title>results</title>
	</head>

	<body>
		<h1><p>Results</p></h1>
		<table class="center">
			<tr>
				<td>Professor</td>
				<td>Average</td>
				<td>Number of votes</td>
			</tr>
			<?php
				foreach($professors as $professor)
				{
					echo "<tr>\n";
					echo "<td>" . $professor->getName() . "</td>\n";
					echo "<td>" . $professor->getAverage() . "</td>\n";
					echo "<td>" . $professor->getNumVotes() . "</td>\n";
					echo "</tr>\n";
				} 
			?>
		</table>
	<br />
		
	</body>
</html>