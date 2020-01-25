<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="prove3.css">

<script>

var book = { name: "The Way of Kings", price : 9.99, quantity : 1};
var pingpong = { name: "Ping Pong Table", price : 99.99, quantity : 1};
var candyland = { name: "Candy Land", price : 14.99, quantity : 1};

function myFunction() {
  alert("Hello! I am an alert box!");
}
  function addToCart(var newItem)
  {  
    alert("Hello! I am an alert box!!");

  }


</script>
<title>Shopping</title>
</head>
<header>
  <a href="prove3_cart.php">
  <p>|Cart|</p>
  </a>

  <h1>Products</h1>
</header>
<body>
<button onclick="myFunction()">Try it</button>


</body>
</html>
