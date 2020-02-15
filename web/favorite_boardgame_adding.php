

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

require("dbConnect.php");
$db = get_db();

	$query = 'INSERT INTO boardgames(boardgame_name, boardgame_min_players, boardgame_max_players,
		  boardgame_coop_or_comp, publisher_id) VALUES(:name, :min, :max, :coop_or_comp, :publisher_id)';
	$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
	$statement->bindValue(':book', $name);
	$statement->bindValue(':chapter', $min_players);
	$statement->bindValue(':verse', max=$max_players);
	$statement->bindValue(':content', $coop_or_comp);
        $statement->bindValue(':content', $publisher_id);

	$statement->execute();




?>