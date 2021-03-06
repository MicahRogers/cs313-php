<?php
  session_start();

  $dbUrl = getenv('DATABASE_URL');

  if (empty($dbUrl)) {
   // example localhost configuration URL with postgres username and a database called cs313db
   $dbUrl = "postgres://postgres:password@localhost:5432/cs313db";
  }
  
  $dbopts = parse_url($dbUrl);
  
  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');
  
  //print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";
  
  try {
   $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
  }
  catch (PDOException $ex) {
   print "<p>error: $ex->getMessage() </p>\n\n";
   die();
  }
?>

 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="homepage.css">
<title>Boardgames</title>
</head>
<header>
<a href="favorite_boardgame_search.php">Search</a><br>
  <h1>Add Boardgames</h1>
</header>
<body>
<form action="favorite_boardgame_adding.php" method="POST">
Name
<input type="text" name="name" required><br>
Publisher
<select name="publisher" required>
  <option value=1>Z-Man Games</option>
  <option value=2>Hasbro</option>
  <option value=3>Test Publisher</option>
  <option value=4>Other</option>
</select>
<br>
Minimum Players
<select name="min_players" required>
  <option value=1>1</option>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>  
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>
  <option value=8>8</option>
</select>
<br>
Maximum Players
<select name="max_players" required>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>  
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>
  <option value=8>8</option>
  <option value=9>9</option>
  <option value=10>10</option>
  <option value=11>11</option>
  <option value=12>12</option>
  <option value=13>13</option>
  <option value=14>14</option>
  <option value=15>15</option>
  <option value=16>16</option>
</select>
<br>
Cooperative or Competitive
<select name="coop_or_comp" required>
  <option value=Cooperative>Cooperative</option>
  <option value=Competitive>Competitive</option>
</select>
<br>
<input type="submit" name= "Add" value="Submit">
</form>
</body>

</html>
