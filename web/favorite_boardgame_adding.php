

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



?>