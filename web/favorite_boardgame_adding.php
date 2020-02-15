

<?php
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

 echo "name=$name\n";
 echo "publisher=$publisher\n";
 echo "min=$min_players\n";
 echo "max=$max_players\n";
 echo "coop or comp=$coop_or_comp\n";

//require("dbConnect.php");
	$db = NULL;

	try {
		// default Heroku Postgres configuration URL
		$dbUrl = getenv('DATABASE_URL');

		if (!isset($dbUrl) || empty($dbUrl)) {
			// example localhost configuration URL with user: "ta_user", password: "ta_pass"
			// and a database called "scripture_ta"
			$dbUrl = "postgres://ta_user:ta_pass@localhost:5432/scripture_ta";

			// NOTE: It is not great to put this sensitive information right
			// here in a file that gets committed to version control. It's not
			// as bad as putting your Heroku user and password here, but still
			// not ideal.
			
			// It would be better to put your local connection information
			// into an environment variable on your local computer. That way
			// it would work consistently regardless of whether the application
			// were running locally or at heroku.
		}

		// Get the various parts of the DB Connection from the URL
		$dbopts = parse_url($dbUrl);

		$dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
		$dbPassword = $dbopts["pass"];
		$dbName = ltrim($dbopts["path"],'/');

		// Create the PDO connection
		$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

		// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $ex) {
		// If this were in production, you would not want to echo
		// the details of the exception.
		echo "Error connecting to DB. Details: $ex";
		die();
	}

	$query = 'INSERT INTO boardgames(boardgame_name, boardgame_min_players, boardgame_max_players,
		  boardgame_coop_or_comp, publisher_id) VALUES(:name, :min, :max, :coop_or_comp, :publisher_id)';
	$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
//	$statement->bindValue(':book', $name);
//	$statement->bindValue(':chapter', $min_players );
//	$statement->bindValue(':verse', $max_players );
//	$statement->bindValue(':content', $coop_or_comp );
  //      $statement->bindValue(':content', $publisher_id );

	$statement->execute();


?>