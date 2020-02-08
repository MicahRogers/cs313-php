<?php
  session_start();
  
  $publishers;
if(isset($_POST["publishers"])){
    $publishers = $_POST["publishers"];
}
$min_players;
if(isset($_POST["min_players"])){
    $min_players = $_POST["min_players"];
} 
$min_players;
if(isset($_POST["min_players"])){
    $min_players = $_POST["min_players"];
}  
$coop_or_comp;
if(isset($_POST["coop_or_comp"])){
    $coop_or_comp = $_POST["coop_or_comp"];
}  

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

$query = "SELECT * FROM boardgames";
  foreach ($db->query($query) as $row)
  {
   print "<p><b>$row[1] " . "$row[2]:" . "$row[3]</b> - " . "\"$row[4]\"</p>\n\n";
  }

  if ($publisher != NULL)
{
  $query = "SELECT * FROM boardgames WHERE publisher_id = '$publisher'";
}

  if ($min_players != NULL)
{
  $query = "SELECT * FROM boardgames WHERE boardgame_min_players >= '$min_players'";
}

  if ($max_players != NULL)
{
  $query = "SELECT * FROM boardgames WHERE boardgame_max_players = '$boardgame_max_players'";
}

  if ($coop_or_comp != NULL)
{
  $query = "SELECT * FROM boardgames WHERE boardgame_coop_or_comp = '$coop_or_comp'";
}


  foreach ($db->query($query) as $row)
  {
   print "<p><b>$row[1] " . "$row[2]:" . "$row[3]</b> - " . "\"$row[4]\"</p>\n\n";
  }
?>
 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="homepage.css">
<title>Boardgames</title>
</head>
<body>

</body>

</html>
