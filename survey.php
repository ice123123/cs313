<?php
	session_start();

	if(isset($_SESSION["hasVoted"]))
	{
		header("Location: https://php-jhurley3.rhcloud.com/results.php");
		die();
	}

?>


<html lang="en-us">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="survey.css">      
   
      <title>Survey</title>
   </head>

   <body>
		<h1><p>Rate Your Professors</p></h1>
		
		<form method="POST" action="results.php">
			<img class="center" src = "burtons.jpg" height = "75" width = "80">
			<p class="center"><b>Brother Burton:</b></p>	
			<table class="center">
				<tr>
					<td>Low</td>	
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>High</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="radio" name="Burton" value="1" onclick=""></td>
					<td><input type="radio" name="Burton" value="2" onclick=""></td>
					<td><input type="radio" name="Burton" value="3" onclick=""></td>
					<td><input type="radio" name="Burton" value="4" onclick=""></td>
					<td><input type="radio" name="Burton" value="5" onclick=""></td>
					<td><input type="radio" name="Burton" value="6" onclick=""></td>
					<td><input type="radio" name="Burton" value="7" onclick=""></td>
					<td><input type="radio" name="Burton" value="8" onclick=""></td>
					<td><input type="radio" name="Burton" value="9" onclick=""></td>
					<td><input type="radio" name="Burton" value="10" onclick=""></td>
					<td></td>
				</tr>
			</table>

			<br />
			<br />
			<img class="center" src = "neffr.jpg" height = "75" width = "80">
			<p class="center"><b>Brother Neff:</b></p>
			<table class="center">
				<tr>
					<td>Low</td>	
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>High</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="radio" name="Neff" value="1" onclick=""></td>
					<td><input type="radio" name="Neff" value="2" onclick=""></td>
					<td><input type="radio" name="Neff" value="3" onclick=""></td>
					<td><input type="radio" name="Neff" value="4" onclick=""></td>
					<td><input type="radio" name="Neff" value="5" onclick=""></td>
					<td><input type="radio" name="Neff" value="6" onclick=""></td>
					<td><input type="radio" name="Neff" value="7" onclick=""></td>
					<td><input type="radio" name="Neff" value="8" onclick=""></td>
					<td><input type="radio" name="Neff" value="9" onclick=""></td>
					<td><input type="radio" name="Neff" value="10" onclick=""></td>
					<td></td>
				</tr>
			</table>
			
			<br />
			<br />
			<img class="center" src = "twitchellk.jpg" height = "75" width = "80">
			<p class="center"><b>Brother Twitchell:</b></p>
			<table  class="center">
				<tr>
					<td>Low</td>	
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>High</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="radio" name="Twitchell" value="1" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="2" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="3" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="4" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="5" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="6" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="7" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="8" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="9" onclick=""></td>
					<td><input type="radio" name="Twitchell" value="10" onclick=""></td>
					<td></td>
				</tr>
			</table>
			
			<br />
			<br />
			<img class="center" src = "helfrichj.jpg" height = "75" width = "80">
			<p class="center"><b>Brother Helfrich:</b></p>
			<table  class="center">
				<tr>
					<td>Low</td>	
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>High</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="radio" name="Helfrich" value="1" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="2" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="3" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="4" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="5" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="6" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="7" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="8" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="9" onclick=""></td>
					<td><input type="radio" name="Helfrich" value="10" onclick=""></td>
					<td></td>
				</tr>
			</table>
			
			<br />
			<br />
			<img class="center" src = "ercanbracks.jpg" height = "75" width = "80">
			<p class="center"><b>Brother Ercanbrack:</b></p>
			<table  class="center">
				<tr>
					<td>Low</td>	
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>High</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="radio" name="Ercanbrack" value="1" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="2" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="3" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="4" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="5" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="6" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="7" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="8" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="9" onclick=""></td>
					<td><input type="radio" name="Ercanbrack" value="10" onclick=""></td>
					<td></td>
				</tr>
			</table>
			
			<br />
			
			<button class="center" type="submit" value="Submit">Submit</button>
			<p class="center"><a href="results.php">Results</a></p>
		</form>
	</body>
</html>