<?php

  session_start();

  $badLogin = false;

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
// get the data from the POST
$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($username) || $username == ""
	|| !isset($password) || $password == "")
{
	header("Location: signup.php");
	die(); // we always include a die after redirects.
}

// Let's not allow HTML in our usernames. It would be best to also detect this before
// submitting the form and preven the submission.
$username = htmlspecialchars($username);

// Get the hashed password.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = 'INSERT INTO users(user_name, user_password) VALUES(:username, :password)';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->bindValue(':password', $hashedPassword);

$statement->execute();


// finally, redirect them to the sign in page
header("Location: signin.php");
die(); // we always include a die after redirects. In this case, there would be no
       // harm if the user got the rest of the page, because there is nothing else
       // but in general, there could be things after here that we don't want them
       // to see.
?>