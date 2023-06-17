<?php $page_title = "Update Product";

session_start();
if (!isset($_SESSION["AdminUsername"])) {
  die("<p> Please log in to view this page </p>
  <br>
  <button><a href='adminLogin.php' style='color:white' class='btn'> Admin Log in </a></button>
");
} ?>

<script src="validation.js"></script>
</head>

<body>
  <?php include('includes/header.php'); ?>
  <?php include('includes/database.php'); ?>

  <header>
    <div class="header">
      <h2>Here You Can Update The Items!</h2>
    </div>
  </header>



  <?php

  //Get the product ID
  $pid = $_GET['id'];

  //Update product price and stock variables
  $product_price = "";
  $stock = "";
  $productName = "";
  $pDescription = "";
  $category = "";

  //Select product details: price and stock 
  $selectQuery = "SELECT * FROM Products_ WHERE Pid = '$pid'";

  //Execute Select Query 
  if (!($result = mysqli_query($database, $selectQuery))) {
    die("<p>Could not select the product details from the database</p></body></html>");
  } else {
    $rowSelectQuery = mysqli_fetch_array($result);
    $product_price = $rowSelectQuery['ProductPrice'];
    $stock = $rowSelectQuery['Stock'];
    $productName = $rowSelectQuery['ProductsName'];
    $pDescription = $rowSelectQuery['ProductDescription'];
    $category = $rowSelectQuery['ProductCategory'];
  }



  //If the form has been submitted 
  if (isset($_POST['submit'])) {

    if (!empty($_POST['price'])  || !empty($_POST['stock']) || !empty($_POST['name']) || !empty($_POST['pDescription'])) {

      $product_price = $_POST['price'];
      $stock = $_POST['stock'];
      $pDescription = $_POST['pDescription'];
      $productName = $_POST['name'];
      $category = $_POST['category'];

      echo $product_price . "  " . $stock . " " . $pDescription;
    }

    // Update the product details in the database
    $sqlUpdate = "UPDATE Products_ SET ProductsName= '$productName', ProductDescription='$pDescription',ProductCategory='$category',ProductPrice='$product_price', Stock='$stock' WHERE Pid='$pid'";

    // Run the query


    if (!mysqli_query($database, $sqlUpdate)) {
      die("<p>Could not delete the product from the database</p>
   </body></html>");
    } else {

      header("Location: viewProducts.php?msg=update");
      exit();
    }
  }

  ?>


  <br><br>
  <form action="<?php echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET); ?>" method="post" id="myForm">
    <fieldset>
      <legend>Please fill this form to update Product Details:</legend>
      <label for="pid">Product ID:</label>
      <input type="text" id="pid" name="pid" <?php if (isset($_GET['id'])) echo "value='" . $_GET['id'] . "'"; ?> disabled> <br>
      <input name="pid" type="hidden" value="<?php echo $_GET['id'] ?>">

      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter product name here" required="" <?php echo "value='" . $productName . "'"; ?>><br><br>

      <label for="price">Price:</label>
      <input type="text" id="price" name="price" placeholder="Enter product price here" required <?php echo "value='" . $product_price . "'"; ?>><label> SAR </label><br><br>

      <label for="stock">Stock:</label>
      <input type="number" id="stock" name="stock" max="500" min="0" step="1" required="" <?php echo "value='" . $stock . "'"; ?>><br><br>

      <label for="pDescription">Description:</label>
      <textarea name="pDescription" style="overflow:scroll;"><?php echo $pDescription ?></textarea>
      <br>



      <label for="category">Category:</label>
      <select name="category">
        <option value="Necklace" <?php if ($category == "Necklace") echo 'selected="selected"'; ?>>Necklace</option>
        <option value="Bracelet" <?php if ($category == "Bracelet") echo 'selected="selected"'; ?>>Bracelet</option>
        <option value="Earring" <?php if ($category == "Earring") echo 'selected="selected"'; ?>>Earring</option>
        <option value="Ring" <?php if ($category == "Ring") echo 'selected="selected"'; ?>>Ring</option>
      </select><br><br>


      <button type="submit" name="submit" id="update_button">Update Product</button>
      </p>

    </fieldset>
  </form>
  <script>
    var myProductNameUpd;
    var myPriceUpd;
    var myStockUpd;
    function start2() {
      var myForm = document.getElementById("myForm");
      myProductNameUpd= document.getElementById("name");
      myPriceUpd= document.getElementById("price");
      myStockUpd= document.getElementById("stock");
      myForm.onsubmit = checknumtwo;
    }

    function checknumtwo()
    {
        var mssg2 = "";
        console.log("Check function")

        //Check price
        if (myPriceUpd.value == ""){
            mssg2 = "Please enter the price";
        }
        else if (isNaN(myPriceUpd.value)){
            mssg2 = mssg2 + " Price should be numbers only\n";
        }
        //Check name
        if (myProductNameUpd.value == ""){
        mssg2 = mssg2+  "Please enter the product Name";
        }
        //Check stock
        if (myStockUpd.value == ""){
        mssg2 = mssg2 +  "Please enter the stock";
        }
        else if (isNaN(myStockUpd.value)){
        mssg2 = mssg2 + "Stock should be numbers only";
        }
        if(mssg2 != ""){
          alert(mssg2);
          return false;
        }
        
      }

    window.addEventListener("load", start2, false);
  </script>
  <br>

  <?php include("includes/footer.html"); ?>