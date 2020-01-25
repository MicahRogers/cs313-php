<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="prove3.css">

<script>

$_SESSION[cart] = array();
  class Item
  {
  constructor($newName, $newPrice)
  { 
    this.$name = $newName;
    this.$price; = $newPrice;
    this.$quantity = 1;
  }
  public $name;
  public $price;
  public $quantity;
  }

function test()
{
alert("alert");
}
function test2()
{
alert("alert2");
}
  function addToCart(Item $newItem)
  {  
alert("Hello! I am an alert box!!");
    var found = false;
    foreach ($_SESSION[cart] as $cartItem)
    {
      if ($newItem.$name == $cartItem.$name)
      {
        found = true;
        $cartItem.$quantity++;
      }
    }   
    if (!found)
    {
      $_SESSION[cart].push($newItem);
    }
   echo $_SESSION[cart];
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
<button onclick="test()">Try it</button><button onclick="test2()">Try it2</button>

<div class="row">
  <div class="col-4 col-s-6"><img class="wayofkings" src="wayofkings.png" alt="The Way of Kings">
    <p>The Way of Kings</p>
    <button type="button" onclick="addToCart(new Item ("The Way of Kings", 9.99))">Add to Cart</button>
  </div>
  <div class="col-4 col-s-6"><img class="pingpong" src="pingpong.png" alt="Ping Pong">
    <p>Ping Pong Table: Two paddles and one ball included</p>
    <button type="button" onclick="addToCart(new Item ("Ping Ping Table", 99.99))">Add to Cart</button>
  </div>
  <div class="col-4 col-s-6"><img class="candyland" src="boardgame.png" alt="Board Games">
    <p>Candy Land</p>
    <button type="button" onclick="addToCart(new Item ("Candyland", 14.99))">Add to Cart</button>
  </div>  
</div>
</body>
</html>
