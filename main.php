<?php $page_title = "Main page"; ?>
<?php include('includes/header.php');

include('includes/database.php'); 
include('includes/checkQuantity.php');?>

<?php
error_reporting(E_ALL ^ E_WARNING);

if (!isset($_SESSION["cart"])) {
  $_SESSION["cart"] = array();
}

//add to cart
if (isset($_POST['ProductID']) && isset($_POST['ProductName'])) {
  $pid = $_POST["ProductID"];

  //check stock

  if (isset($_SESSION["cart"][$pid]))
    $currentQuan = $_SESSION["cart"][$pid] ;
  else
    $currentQuan = 0;

  if (checkQuantity($database, $pid, $currentQuan)) {
    if(!isset($_SESSION["cart"][$pid])) 
    $_SESSION["cart"][$pid] = 1;
    else $_SESSION["cart"][$pid]++;
    $feedback = $_POST["ProductName"]. " added to cart successfully";
  } else {
    $feedback = "Sorry, ". $_POST["ProductName"]. "choosed quantity isn't available.";
  }
}
?>
<?php
if (!empty($feedback)) echo "<div class='box'><p> $feedback </p></div>";
?>


<body>

  <?php
  $query = "SELECT * FROM products_ ";

  if (!($result = mysqli_query($database, $query))) {
    print("<span>Could not execute query!</span>");
    die(mysqli_error($database) . "</body></html>");
  } // end if

  ?>


  <div class="product-div" style="display: flex; flex-wrap: wrap;">

    <?php
    while ($product = mysqli_fetch_row($result)) {

      print("<div class='product-card'>");

      print('<a href="product.php?PID=' . $product[0] . '"><img src="images/' . $product[5] . '" alt="' . $product[1] . ' pic" class="product-img" /></a>');
      print('<form method="post" action="">');

      print('<h3 class="product-label" name="ProductName">' . $product[1] . '</h3>');
      print(' <p class="price" name="Product_price">' . $product[2] . "SR</p>");
      print('<input name="ProductName" value="' . $product[1] . '" type="hidden">');
      print('<input name="ProductID" value="' . $product[0] . '" type="hidden">');
      print('<p><input type="submit" value="Add to cart"></p>  ');
      print("</form>");
      print("</div>");
    }

    ?>

  </div>

  <h3>Previous Purchased</h3>
  <div class="product-div" style="display: flex; flex-wrap: wrap;">


    <?php
    // Check if cookies exist 
    if (isset($_COOKIE["purchased"])) {
      foreach ($_COOKIE["purchased"] as $key => $val) {

        $query = "SELECT * FROM Products_ where Pid=" . $key;

        if (!($result = mysqli_query($database, $query))) {
          print("<p>Could not execute query!</p>");
          die(mysqli_error($database) . "</body></html>");
        } // end if

        // Cookies printing
        if (mysqli_num_rows($result) > 0) {
          $product = mysqli_fetch_row($result);
          echo '<div  class="product-card">';
          echo '<a href="product.php?PID=' . $product[0] . '"><img style="width:100px" src=images/' . $product[5] . '></a>';
          echo '<h3>' . $product[1] . '</h3>';
          echo '</div>';
        }
      }
    }
    ?>



  </div>

  <!-- cart link -->
  <div class="cart-link">
    <a href="cart.php" class="tooltip">
      <span class="tooltiptext">Show Cart</span>
      <i class="fa-solid fa-cart-shopping fa-lg cart-icon" style="vertical-align: middle;"></i>
    </a>
  </div>

  <?php include('includes/footer.html'); ?>