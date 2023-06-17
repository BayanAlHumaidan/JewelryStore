<?php $page_title = "Product details"; ?>
<?php include('includes/header.php');
include("includes/database.php");
include("includes/checkQuantity.php");

?>

<body>

  <?php


  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
  }

  // ADD to cart
  if (isset($_POST["buy"])) {
    $pid = $_POST["ProductID"];
    $quan = $_POST["Quantity"];

    
    if (checkQuantity($database, $pid, $quan)) {

      if (isset($_SESSION["cart"][$pid])) {
        $quan2 = $_SESSION["cart"][$pid] + $quan;
        $feedback = "Added to cart successfully";
        if (checkQuantity($database, $pid, $quan2))
          $_SESSION["cart"][$pid] += $quan;
        else
          $feedback = "Sorry, quantity isn't available.";
      } else {
        $_SESSION["cart"][$pid] = $quan;
        $feedback = "Added to cart successfully";
      }
      if ($_POST["buy"] == "Check out") {
        header("Location: cart.php");
      }
    } else {
      $feedback = "Sorry, choosed quantity isn't available.";
      //quantity greater than stock
    }
  }

  // Get product details from database
  $query = "SELECT * FROM Products_ where pid=" . $_GET["PID"];
  if (!($result = mysqli_query($database, $query))) {
    print("<p>Could not execute query!</p>");
    die(mysqli_error($database) . "</body></html>");
  } // end if
  $product = mysqli_fetch_row($result);
  ?>



  <div class="container">
    <div class="product-box">

      <div class="images">
        <div class="img-holder active">
          <?php echo "<img src='images/" . $product[5] . "' alt='" . $product[5] . " picture'" ?>/>
        </div>

      </div>


      <div class="basic-info">
        <h1 class="product-title"><?php echo $product[1]; ?></h1>

        <span> <strong> <?php echo $product[2]; ?> SR</strong></span>
        <div class="options">
          <?php if (!empty($feedback)) {
            echo "<p style=;color: red;> $feedback </p>";
          } ?>
          <form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET); ?>">
            <p> Quantity:
              <input name="Quantity" type="number" id="qty" size="20" maxlength="30" min="1" />
            </p>
            <input type="hidden" name="ProductID" value=<?php echo $product[0]; ?>>
            <input type="submit" name="buy" value="Add to cart">
            <input type="submit" value="Check out" name="buy">

            <div class="tooltip">
              <span class="tooltiptext">How to care about jewelry</span>
              <button onclick="window.open('helpingWindow.php','popUpWindow','height=500,width=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">

                <i class='fa-sharp fa-solid fa-circle-info'></i>
            </div>
            </button>
          </form>

        </div>

        <article>
          <details>
            <summary> Description</summary>
            <p>
              <?php echo $product[3]; ?>
            </p>
          </details>
        </article>
      </div>
    </div>
  </div>
  <div class="cart-link">
    <a href="cart.php" class="tooltip">
      <span class="tooltiptext">Show Cart</span>
      <i class="fa-solid fa-cart-shopping fa-lg cart-icon" style="vertical-align: middle;"></i>
    </a>
  </div>

  <?php include('includes/footer.html'); ?>


  <script>
    var myQuantity;

    function start1() {
      var myForm = document.getElementById("myForm");
      myQuantity = document.getElementById("qty");
      myForm.onsubmit = checknumone;
    }

    function checknumone() {
      var mssg1 = "";
      console.log("Check function")
      //Check qty
      if (myQuantity.value == 0) {
        mssg1 = "Please enter the quantity";

      } else if (myQuantity.value < 0) {
        mssg1 = mssg1 + "quantity should be a number greater than zaro";

      }
      if (mssg1 != "") {
        alert(mssg1);
        return false
      }
    }

    window.addEventListener("load", start1, false);
  </script>

</body>

</html>