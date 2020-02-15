

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

// echo "name=$name\n";
// echo "publisher=$publisher\n";
// echo "min=$min_players\n";
// echo "max=$max_players\n";
// echo "coop or comp=$coop_or_comp\n";

require("dbConnect.php");
$db = get_db();

try
{
	$query = 'INSERT INTO boardgames(boardgame_name, boardgame_min_players, boardgame_max_players
		, boardgame_coop_or_comp, publisher_id) VALUES(:name, :min, :max, :coop_or_comp, :publisher_id)';
	$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
	$statement->bindValue(':book', $name);
	$statement->bindValue(':chapter', $min_players);
	$statement->bindValue(':verse', max=$max_players);
	$statement->bindValue(':content', $coop_or_comp);
        $statement->bindValue(':content', $publisher_id);

	$statement->execute();

	// get the new id
	//$scriptureId = $db->lastInsertId("scripture_id_seq");

	// Now go through each topic id in the list from the user's checkboxes
	//foreach ($topicIds as $topicId)
//	{
//		echo "ScriptureId: $scriptureId, topicId: $topicId";
//
//		// Again, first prepare the statement
//		$statement = $db->prepare('INSERT INTO scripture_topic(scriptureId, topicId) VALUES(:scriptureId, :topicId)');
//
//		// Then, bind the values
//		$statement->bindValue(':scriptureId', $scriptureId);
//		$statement->bindValue(':topicId', $topicId);
//
//		$statement->execute();
//	}
}
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}

// finally, redirect them to a new page to actually show the topics
//header("Location: showTopics.php");

//die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.

?>