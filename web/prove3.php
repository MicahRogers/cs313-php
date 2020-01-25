<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="prove3.css">

<script>
function myFunction() {
  alert("Hello! I am an alert box!");
}
  function addToCart(var newItem)
  {  
    alert("Hello! I am an alert box!!");
    var found = false;
    foreach (<?php $_SESSION["cart"]?> as cartItem)
    {
      if (newItem.name == cartItem.name)
      {
        found = true;
        cartItem.quantity++;
      }
    }   
    if (!found)
    {
      <<?php $_SESSION["cart"]?>.push(newItem);
    }
    <?php echo $_SESSION["cart"];?>
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
    <button type="button" onclick="addToCart(<script>var item = { name: "The Way of Kings", price : 9.99, quantity : 1};)</script>Add to Cart</button>
  </div>
  <div class="col-4 col-s-6"><img class="pingpong" src="pingpong.png" alt="Ping Pong">
    <p>Ping Pong Table: Two paddles and one ball included</p>
    <button type="button" onclick="addToCart(<script>var item = { name: "Ping Pong Table", price : 99.99, quantity : 1};)</script>Add to Cart</button>
  </div>
  <div class="col-4 col-s-6"><img class="candyland" src="boardgame.png" alt="Board Games">
    <p>Candy Land</p>
    <button type="button" onclick="addToCart(<script>var item = { name: "Candy Land", price : 14.99, quantity : 1};)</script>Add to Cart</button>
  </div>  
</div>
</body>
</html>
