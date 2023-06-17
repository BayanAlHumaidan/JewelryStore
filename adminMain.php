

<?php $page_title = "Admin Main page";
include('includes/header.php');

if(!isset($_SESSION["AdminUsername"]))
{
  die("<p> Please log in to view this page </p>
  <br>
  <button><a href='adminLogin.php' style='color:white' class='btn'> Admin Log in </a></button>
");
}
?>

<header>

<div class="header">
  <h2>Welcome   <?php
  echo $_SESSION['AdminFName']; ?>!</h2>
</div>
</header>

<br><br>
 <fieldset>

  <legend>Please choose:</legend>
  <p><a style="color:black" href="addProduct.php" class="adminMenu">Add new product</a></p>
  <p><a style="color:black" href="viewProducts.php" class="adminMenu">View products</a></p>

  
</fieldset>
 <br>
 <?php include('includes/footer.html');?>

</body>

</html>
