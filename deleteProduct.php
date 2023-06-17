

<html>


<?php $page_title = "Delete Product"; ?>

<?php include('includes/header.php');




if(!isset($_SESSION["AdminUsername"]))
{
  die("<p> Please log in to view this page </p>
  <br>
  <button><a href='adminLogin.php' style='color:white' class='btn'> Admin Log in </a></button>
");
}?>

<?php include('includes/database.php');?>
<?php

//Get the product ID
 $pid = $_GET['id'];

// sql to delete a record
$sqlDelete = "DELETE FROM Products_ WHERE Pid=$pid";

// Run the query   
   if (!mysqli_query($database, $sqlDelete)) {
	   die( "<p>Could not delete the product from the database</p>
   </body></html>" );
    } else {
        
	   //DeleteOrUpdateJeweleryProduct.php page to be reloaded after the product has been successfully deleted from the database.
		// alert("Successfully Deleted");
		header("Location: viewProducts.php?msg=delete&id=".$pid);
    exit();
    }

?>
