<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="prove3.css">

<script>
<?php $_SESSION["cart"] = array();?>
var book = { name: "The Way of Kings", price : 9.99, quantity : 1};
var pingpong = { name: "Ping Pong Table", price : 99.99, quantity : 1};
var candyland = { name: "Candy Land", price : 14.99, quantity : 1};

function myFunction() {
  alert("Hello! I am an alert box!");
}

function addToCart(newItem)
{  

  array_push(_SESSION["cart"], $newItem);
    <?php
    foreach ($_SESSION["cart"] as $cartItem)
    {
      alert("addding " + $cartItem.$name);
    }?>
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

<div class="row">
  <div class="col-4 col-s-6"><img class="wayofkings" src="wayofkings.png" alt="The Way of Kings">
    <p>The Way of Kings</p>
    <button onclick="addToCart(book)">Add to Cart</button>
  </div>
  <div class="col-4 col-s-6"><img class="pingpong" src="pingpong.png" alt="Ping Pong">
    <p>Ping Pong Table: Two paddles and one ball included</p>
    <button onclick="addToCart(pingpong)">Add to Cart</button>
  </div>
  <div class="col-4 col-s-6"><img class="candyland" src="boardgame.png" alt="Board Games">
    <p>Candy Land</p>
    <button onclick="addToCart(candyland)">Add to Cart</button>
  </div>  
</div>
</body>
</html>
