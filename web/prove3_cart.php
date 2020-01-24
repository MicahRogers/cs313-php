<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="prove3.css">

<script>


</script>
<title>Cart</title>
</head>
<header>
  <a href="prove3.php">
  <p>|Browse|</p>
  </a>  
  <a href="prove3_checkout.php">
  <p>|Checkout|</p>
  </a>

  <h1>Products in Cart</h1>
</header>
<body>
  <?php> 
    foreach ($_SESSION[cart] as $cartItem)
    {
      echo $cartItem.$name + "<br>";
      echo $cartItem.$price + "<br>";
      echo $cartItem.$quantity + "<br><br>";
    }
</body>
</html>
