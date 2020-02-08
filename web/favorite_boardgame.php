<?php
  session_start();

  $dbUrl = getenv('DATABASE_URL');

  if (empty($dbUrl)) {
   $dbUrl = postgrespostgrespassword@localhost5432cs313db;
  }
  
  $dbopts = parse_url($dbUrl);
  
  $dbHost = $dbopts[host];
  $dbPort = $dbopts[port];
  $dbUser = $dbopts[user];
  $dbPassword = $dbopts[pass];
  $dbName = ltrim($dbopts[path],'');
  
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
  <h1>Search for Boardgames</h1>
</header>
<body>
<form action="boardgame_list.php" method="POST">
<input name="boardgame" type="text">
Publisher
<select name="publishers">
  <option value=1>Z-Man Games</option>
  <option value=2>Hasbro</option>
  <option value=3>Test Publisher</option>
</select>
Minimum Players
<select name="min_players">
  <option value=1>1</option>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>  
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>
  <option value=8>8</option>
</select>
Maximum Players
<select name="min_players">
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
Cooperative or Competitive
<select name="min_players">
  <option value=0>cooperative</option>
  <option value=1>competitive</option>
</select>
<input type="submit" name= "submit" value="Submit">
</form>
</body>

</html>
