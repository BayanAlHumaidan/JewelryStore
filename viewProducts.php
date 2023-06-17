<?php $page_title = "View Products"; ?>


<style>


h2{ 
    font-size: 1.5em;
    font-family:  cursive;
}
.navbar1 {
    padding: 5px 20px 5px 20px;
    overflow: hidden;
    font-family: Arial;
  }
  
body{ 
	margin: auto;	
	}
.center {	
	background: #DFD3C3; 
  overflow: hidden;
  border-radius: 10px;
  width: 300px;
	padding: 50px;
  margin-top: 50px;
  }
 

table {
    width: 80%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

</style>


<?php include('includes/header.php');
if(!isset($_SESSION["AdminUsername"]))
{
  die("<p> Please log in to view this page </p>
  <br>
  <button><a href='adminLogin.php' style='color:white' class='btn'> Admin Log in </a></button>");
}?>
<?php include('includes/database.php');?>


<body>

<?php //SQL connection include & connect to database 

 if(isset($_GET["msg"])){
  if ($_GET["msg"] == "delete")
    $message = "Product #".$_GET["id"]." deleted successfully";
 }elseif($_GET["msg"] == "update"){
  $message = "Product updated successfully";

 }

$dropDownMenu = "SELECT * FROM Products_";

 ?>

  <div class="header">
  <h2>Here You Can View Products!</h2>
  </div>	
  
	<?php
				//messages
				if (!empty($message))
					echo "<div class='box'><p> $message </p></div>";
				?>

  </div>
	<input type="text" id="productSearch" onkeyup="searchFunction()" placeholder="Search for product.." title="Type in a name">

	<?php 
	
	//Execute the Query
	$result = mysqli_query( $database,$dropDownMenu );
	
	echo "<table border='1' id='productTable'>";
	echo "<tr>";
	echo "<th>"; echo "Pid"; echo "</th>";
	echo "<th>"; echo "Products Name"; echo "</th>";
	echo "<th>"; echo "Product Price"; echo "</th>";
	echo "<th>"; echo "Product Description"; echo "</th>";
	echo "<th>"; echo "Products Category"; echo "</th>";
	echo "<th>"; echo "Stock"; echo "</th>";
  echo "<th>"; echo "Product Image"; echo "</th>";
	echo "<th>"; echo "Delete"; echo "</th>";
	echo "<th>"; echo "Update"; echo "</th>";
	echo "</tr>";

  while ($row = mysqli_fetch_assoc($result)) {
	
    echo '<tr><td>'.$row['Pid'].'</td><td>'. $row['ProductsName'] . '</td><td>'. $row['ProductPrice'] . '</td><td>'. $row['ProductDescription'] . '</td><td>'. $row['ProductCategory'] . '</td><td>'. $row['Stock'] . '</td><td><img src="./images/'.$row['ProductsImage'].'"width="50px" height="50px"/></td><td> <a href="javascript:openDeleteProducts('. $row['Pid']. ')"> Delete</a> </td><td><a href="updateProduct.php?id='. $row['Pid']. '"> Edit </a> </td></tr>';
  }
  

    echo "</table>";
    echo "<summary> In table above, you can display the current products in the database, modify or delete </summary>";

  ?>
  
</div>
<br> <br> <br>


	<?php
  echo '<script type="text/javascript"> ';
  echo ' function openDeleteProducts(ID) {';
  echo '  if (confirm("Are you sure you want to delete this product?")) {';
  echo '    document.location = "deleteProduct.php?id=" + ID';
  echo '  }';
  echo '}';
  echo '</script>';
  
?>
<?php
?>



<script>
function searchFunction() {
  var input, filter, table, tr, td, i, txtValue;
  
  input = document.getElementById("productSearch");
  filter = input.value.toUpperCase();
  table = document.getElementById("productTable");
  tr = table.getElementsByTagName("tr");
  
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];

    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

</body>
<?php include('includes/footer.html');?>

</html>