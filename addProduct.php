<?php $page_title = "Add new product";
include("includes/database.php");
include('includes/header.php');
if (!isset($_SESSION["AdminUsername"])) {
  die("
  <p> Please log in to view this page </p>
  <br>
  <button><a href='adminLogin.php' style='color:white' class='btn'> Admin Log in </a></button>
  ");
}
?>

<body>

  <?php


  // variables used in script
  $pid = isset($_POST["pid"]) ? $_POST["pid"] : "";
  $pname = isset($_POST["pname"]) ? $_POST["pname"] : "";
  $price = isset($_POST["price"]) ? $_POST["price"] : "";
  $stock = isset($_POST["stock"]) ? $_POST["stock"] : "";
  $description = isset($_POST["description"]) ? $_POST["description"] : "";
  $category = isset($_POST["category"]) ? $_POST["category"] : "";
  $picture = isset($_FILES["myfile"]) ? ($_FILES["myfile"]["name"]) : "";
  $os = isset($_POST["os"]) ? $_POST["os"] : "";

  $iserror = false;

  $picturemessage = "";
  $success = true;
  $message = "";


  $formerrors =
    array(
      "piderror" => false, "pnameerror" => false,
      "priceerror" => false, "stockerror" => false, "picerror" => false,
      "descriptionerror" => false
    );



  //To get the last Pid value
  $idQuery = "SELECT Pid from Products_ order by Pid desc limit 1";
  // $result = mysqli_query($database, $idQuery);
  if (!($result = mysqli_query($database, $idQuery))) {
    print("<p>Could not execute query!</p>");
  } else {
    $ids = mysqli_fetch_row($result);
  }
  //$num_rows = mysqli_num_rows($result);

  //The Pid of the new product that will be uploaded
  $newPID = ($ids[0] + 1);



  if (isset($_POST['pname'])) {
    // Get the form data
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $picture = $_FILES['myfile']['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];



    // ensure that all fields have been filled in correctly
    if (isset($_POST["pid"])) {
      if ($pid == "") {
        $formerrors["piderror"] = true;
        $iserror = true;
      } // end if

      if (empty($pname)) {
        $formerrors["pnameerror"] = true;
        $iserror = true;
      } // end if

      if (empty($description)) {
        $formerrors["descriptionerror"] = true;
        $iserror = true;
      } // end if

      if ($price == "" || $price <= 0) {
        $formerrors["priceerror"] = true;
        $iserror = true;
      } // end if       

      if ($stock == "" || $stock <= 0 ||  !preg_match("/^[1-9][0-9]?/", $stock)) {
        $formerrors["stockerror"] = true;
        $iserror = true;
      } // end if       


      if (!$_FILES['myfile']['size'] > 0) {
        $formerrors["picerror"] = true;
        $iserror = true;
      } //end if


      if (!$iserror) {

        if (!empty($picture)) {
          if (!move_uploaded_file($_FILES['myfile']['tmp_name'], "images/" . $picture))
            echo 'Uploaded';
          else
            echo "Not Uploaded";
        }

        $query = "INSERT INTO Products_ (Pid, ProductsName, ProductPrice ,ProductDescription, ProductCategory, ProductsImage ,Stock)VALUES ( $pid, '$pname', $price, '$description' ,'$category' ,'$picture' , $stock)";
        if (!($result = mysqli_query($database, $query))) {
          $isSuccess = false;
          print("<p>Could not execute query!</p>");
          die(mysqli_error($database));
        } // end if

        mysqli_close($database);

        if ($success) {
          // Set the success message
          $message = "Product has been successfully added";
        }
      } // end if 
    } // end if 

  }


  ?>


  <br><br>
  <form method="post" action="" enctype="multipart/form-data" id="myForm">

    <fieldset>

      <legend>Please fill this form:</legend><br>

      <label for="pid">Product ID:</label>
      <input type="text" id="pid" <?php echo "value='" . $newPID  . "'"; ?> disabled> <br>
      <input type="hidden" value="<?php echo $newPID ?>" name="pid">
      <label for="pname">Product Name:</label>
      <?php if ($formerrors["pnameerror"]) echo "<span style='color:red'>* </span>" ?>
      <input type="text" id="pname" name="pname" placeholder="Enter product name here" <?php if (isset($_POST['pname'])) echo "value='" . $pname . "'"; ?>><br>


      <label for="price">Price:</label>
      <?php if ($formerrors["priceerror"]) echo "<span style='color:red'>* </span>" ?>

      <input type="text" id="prnum" name="price" placeholder="Enter product price here" <?php if (isset($_POST['price'])) echo "value='" . $price . "'"; ?>><label> SAR </label><br>

      <label for="stock">Stock:</label>
      <?php if ($formerrors["stockerror"]) echo "<span style='color:red'>* </span>" ?>
      <input type="number" id="stock" name="stock" max="500" min="1" step="1" <?php if (isset($_POST['stock'])) echo "value='" . $stock . "'"; ?>><br><br>

      <label for="Description">Description:</label>
      <?php if ($formerrors["descriptionerror"]) echo "<span style='color:red'>* </span>" ?>
      <textarea id="description" name="description"><?php echo "$description" ?> </textarea><br><br>


      <label for="category">Category:</label>
      <select name="category">
        <option value="Necklace">Necklace</option>
        <option value="Bracelet">Bracelet</option>
        <option value="Earring" selected>Earring</option>
        <option value="Ring">Ring</option>
      </select><br><br>

      <label for="myfile">Picture:</label>
      <?php if ($formerrors["picerror"]) echo "<span style='color:red'>* </span>" ?>
      <input type="file" id="myfile" name="myfile"><br><br>

      <input type="submit" name="submit" id="submit" class="button" value="Add">

  </form>
  </fieldset>
  <script>
    var myPrice;
    var myProductId;
    var myProductName;
    var myStock;
    var imgFile;

    function start() {
      var myForm = document.getElementById("myForm");
      imgFile =  document.getElementById("myfile")
      myPrice = document.getElementById("prnum");
      myProductId = document.getElementById("pid");
      myProductName = document.getElementById("pname");
      myStock = document.getElementById("stock");
      myForm.onsubmit = check;
    }

    function check() {
      var mssg = "";
      console.log("Check function")
      //Check prnum
      if (myPrice.value == "") {
        mssg = "Please enter the price";
        console.log("enter the price")
      } else if (isNaN(myPrice.value)) {
        mssg = mssg + " Price should be numbers only\n";
        console.log("must be number")

      }

      //check pid
      if (isNaN(myProductId.value)) {
        mssg = mssg + "ID should be numbers only"
        console.log("ID numbers only")
      }

      //Check pname
      if (myProductName.value == "") {
        mssg = mssg + "\nPlease enter the product Name";
        console.log("enter product name")
      }

      //Check stock
      if (myStock.value == "") {
        mssg = mssg + "\nPlease enter the stock";
        console.log("enter stock")
      } else if (isNaN(myStock.value)) {
        mssg = mssg + "\nStock should be numbers only";
        console.log("stock number only")
      }
      if(imgFile.files.length == 0 ){
        mssg = mssg + "\nPlease choose a product image ";
      }

      if (mssg != "") {
        alert(mssg);
        return false;
      }
    }

    window.addEventListener("load", start, false);
  </script>



  <!-- Display the success message -->
  <?php if (!empty($message)) {
    header("Location: adminMain.php");
  }; ?>


  <br>




  <?php include('includes/footer.html'); ?>