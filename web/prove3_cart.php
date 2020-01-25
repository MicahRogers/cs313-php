<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script>


</script>
<title>Cart</title>
</head>
  <a href="prove3.php">
  <p>|Browse|</p>
  </a>  
  <a href="prove3_checkout.php">
  <p>|Checkout|</p>
  </a>

  <h1>Products in Cart</h1>
</header>
<body>
  <?php 
    for ($i = 0; $i < count($_SESSION["cart"]); $i++)
{
      echo count($_SESSION["cart"]);
}
  ?>
</body>
</html>
