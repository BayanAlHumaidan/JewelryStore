<?php $page_title = "Cart"; ?>
<?php include('includes/header.php');
include("includes/database.php");
include("includes/checkQuantity.php"); ?>

<?php

if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = array();
}

if (isset($_GET['clear'])) {
	$_SESSION["cart"] = array();
}

//update quantity
if (isset($_GET["action"])) {
	$pid = $_GET["pID"];
	$quan = $_GET["quan"];
	$message = "";
	if ($_GET["action"] == "update") {


		if ($quan == 0) {
			unset($_SESSION["cart"][$pid]);
			$message = "Product deleted successfully.";
		} else {
			if (checkQuantity($database,$pid,$quan)) {
				$_SESSION["cart"][$pid] = $quan;
				$message = "Quantity updated successfully";
			} else
				$message = "Sorry, choosed quantity isn't available.";
		}
	
	} elseif ($_GET["action"] == "remove") {
		unset($_SESSION["cart"][$pid]);
		$message = "Product deleted successfully.";
	} elseif ($_GET["action"] == "Checkout") {
		//checkout
		$val = true;
		foreach ($_SESSION["cart"] as $key => $val) {

			echo "$key >> $val";

			if (checkQuantity($database, $key, $val)) {
				checkOutProduct($database, $key, $val);
				// setcookie(name, value, expire);
				setcookie("purchased[$key]", $val, time() + (24 * 60 * 60)); //1 day
			}else{
				$message = "Sorry, choosed quantity isn't available.";
			}
		}
		header("Location: checkout.php");
	}
}



function checkOutProduct($db, $pid, $quan)
{
	$query = "UPDATE  PRODUCTS_ SET Stock = Stock-$quan WHERE PID=$pid AND Stock>0";
	if (($result = mysqli_query($db, $query))) {

		echo "product $pid successfully ";
		return true;
	} else
		return false;
}


?>

<body>
	<h1>Shopping Cart</h1>
	<div style="text-align:left;   text-indent: 100px;">
	</div>


	<?php $totalPrice = 0; ?>
	<div class="wrapper">
		<div class="project">
			<div class="shop">
				<?php
				//messages
				if (!empty($message))
					echo "<div class='box'><p> $message </p></div>";
				?>
				<!-- empty cart -->
				<?php if (empty($_SESSION["cart"]))
					exit('<div class="box">Cart is empty </div>');
				?>
				<!-- clear cart -->
				<div class="box"> <a href='<?php echo $_SERVER['PHP_SELF']; ?>?clear=1'>Clear cart</a></div>

				<!-- display cart content -->
				<?php
				foreach ($_SESSION['cart'] as $key => $val) {
					// get item details
					$query = "SELECT * FROM Products_ where pid=" . $key;
					if (!($result = mysqli_query($database, $query))) {
						print("<p>Could not execute query!</p>");
						die(mysqli_error($database) . "</body></html>");
					} // end if
					$product = mysqli_fetch_row($result);
					$sub = $val * $product[2];
					$totalPrice += $sub;
					echo "
					<div class='box'>
					<img src='images/$product[5]'>
					<div class='content'>
					<h3>$product[1]</h3>
					<h4>Price: $product[2] SR </h4>
					
					<form action='' method='GET'>
					<input type='hidden' value=$product[0] name='pID'>
					<p class='unit'>Quantity:<input value=$val name='quan' type='number' size='20' maxlength='30' min='0' required />					
					<button class='btn2'  type='submit' name='action' value='update'>Update </button>
					<p class='unit'>Subtotal: $sub </p>
					
					 <button class='btn2'  type='submit' name='action' value='remove'>
					 <i aria-hidden='true' class='fa fa-trash'></i> Remove
					</button> 
					</form>

					</div>
					</div>
					";
				}
				?>
			</div>

			<div class="right-bar">
				<p><span>Subtotal</span> <span><?php echo $totalPrice; ?> SR</span></p>
				<hr>
				<?php $tax = $totalPrice * 0.15; ?>
				<p><span>Tax (15%)</span> <span><?php echo $tax; ?> SR</span></p>
				<hr>
				<p><span>Shipping</span> <span>Free</span></p>
				<hr>
				<?php $total = $totalPrice + $tax; ?>
				<form method="get" action="">
					<p><span>Total</span> <span><?php echo $total; ?> SR</span></p>
					<button type='submit' name='action' value='Checkout'>
						<i class="fa fa-shopping-cart"></i> Checkout
					</button>

				</form>
			</div>
		</div>
	</div>

	<?php include('includes/footer.html'); ?>

</body>

</html>