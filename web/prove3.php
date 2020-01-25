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


</body>
</html>
