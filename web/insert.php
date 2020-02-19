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

 if(isset($_POST['username']))
{
  $username = $_POST['username'];
}

 if(isset($_POST['password']))
{
  $password = $_POST['password'];
}

$password = password_hash($password, PASSWORD_DEFAULT);

	$query = 'INSERT INTO users() VALUES(user_name, user_password) VALUES (:username, :password)';
	$statement = $db->prepare($query);

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
	$statement->bindValue(':username', $username );
	$statement->bindValue(':password', $password );

	$statement->execute();


$newURL = 'login.php';
header('Location: ' . $newURL);
die();


?>

 