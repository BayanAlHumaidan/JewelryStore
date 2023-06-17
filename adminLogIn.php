<?php $page_title = "Admin log in"; 


include("includes/database.php");

// if (isset($_POST['Logout'])) {
// 	session_start();
// 	session_destroy(); // 
// }
if (isset($_POST['Username']) && isset($_POST['Password'])) {
	$Query = "Select *  from Admin where AdminUsername='" . $_POST['Username'] . "' and AdminPassword='" . $_POST['Password'] . "'";
	if (!($result = mysqli_query($database, $Query))) {
		exit(mysqli_error($database));
	}
	mysqli_close($database);


	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_row($result);
		session_start();
		$_SESSION['AdminUsername'] = $row[2];
		$_SESSION['AdminFName'] = $row[0];

		header('location: AdminMain.php');
		exit;
	} else {
		header('location: adminLogin.php?problem=ErrorLogin');
		exit;
	}
}

?>


<body>



	<?php include('includes/header.php'); ?>

	<br> <br> <br>
	<h2  style="color:#593447">Welcome to our store</h2><br>

	<div class="container">

		<div class="login">
			<h1>Log in</h1>
			<form method="post" action="adminLogIn.php">
				<?php if (isset($_GET['problem']) and ($_GET['problem'] == 'ErrorLogin'))
					echo "<p style='color:red;'> Login ERROR: Please check username and/or password </p>" ?>
				<label><b>Admin ID: </b> </label>

				<input type="text" name="Username" id="Uname" placeholder="ID">
				<br><br>
				<label><b>Password:
					</b>
				</label>
				<input type="Password" name="Password" id="Pass" placeholder="Password">
				<br><br>
				<input type="submit" value="Login">

			</form>
		</div>
	</div>
	<script>
		var managerID;
		var password;

		function start4() {
			var myForm = document.getElementById("myForm");
			managerID = document.getElementById("Uname");
			password = document.getElementById("Pass");
			myForm.onsubmit = checknumfour;
		}

		function checknumfour() {
			var mssg4;
			console.log("Check function")
			//Check Uname
			if (managerID.value == "") {
				mssg4 = "Please enter the manager ID \n";
			}
			if (password.value == "") {
				mssg4 = "Please enter the password \n";
			}


			if (mssg4 != "") {
				alert(mssg4);
				return false;
			}
		}

		window.addEventListener("load", start4, false);
	</script>
	<br> <br> <br>

	<?php include('includes/footer.html'); ?>