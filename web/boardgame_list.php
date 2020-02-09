<?php
  session_start();
  
  $publisher;
  $publisher = $_POST["publisher"];

  $min_players;
  $min_players = $_POST["min_players"];

  $max_players;
  $max_players = $_POST["max_players"];
 
  $coop_or_comp;
  $coop_or_comp = $_POST["coop_or_comp"];


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
print "$publisher";
print "$min_players";
print "$max_players";
print "$coop_or_comp";

else
{
print "not null";
}
if ( $min_players == NULL)
{print "null";
}
else
{
print "not null";
}
if ( $max_players == NULL)
{print "null";
}
else
{
print "not null";
}
if ( $coop_or_comp == NULL)
{print "null";
}
else
{
print "not null";
}

  $query = "SELECT * FROM boardgames WHERE  publisher_id = '$publisher'";

foreach ($db->query($query) as $row)
  {
   print "<p><b>$row[1] " . "$row[2]:" . "$row[3]</b> - " . "\"$row[4]\"</p>\n\n";
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
