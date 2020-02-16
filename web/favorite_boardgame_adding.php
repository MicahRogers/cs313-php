

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

  $name;
  $name = $_POST["name"];

  $publisher;
  $publisher = $_POST["publisher"];

  $min_players;
  $min_players = $_POST["min_players"];

  $max_players;
  $max_players = $_POST["max_players"];
 
  $coop_or_comp;
  $coop_or_comp = $_POST["coop_or_comp"];

// For debugging purposes, you might include some echo statements like this
// and then not automatically redirect until you have everything working.

//require("dbConnect.php");


	$query = 'INSERT INTO boardgames(boardgame_name, boardgame_min_players, boardgame_max_players,
		  boardgame_coop_or_comp, publisher_id) VALUES(:name, :min, :max, :coop_or_comp, :publisher)';
	$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
	$statement->bindValue(':name', strtolower($name) );
	$statement->bindValue(':min', $min_players );
	$statement->bindValue(':max', $max_players );
	$statement->bindValue(':coop_or_comp', $coop_or_comp );
        $statement->bindValue(':publisher', $publisher );

	$statement->execute();



  $query = "SELECT * FROM boardgames";

 ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="homepage.css">
<title>adding</title>
</head>
<body>
  <a href="favorite_boardgame_add.php">Add</a> | <a href="favorite_boardgame_search.php">Search</a>
  <?php
    foreach ($db->query($query) as $row)
    {
      print "<p>Name: $row[1] | " . "Min Players: $row[2] | " . "Max Players $row[3] | " . "$row[4]</p>\n\n";
    }
?>