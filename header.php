<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width" />
  <script src="https://kit.fontawesome.com/ade0e1feb7.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/styles.css" />
  <!-- <link rel="stylesheet" href="path/to/bootstrap.min.css"> -->
  <title><?php echo $page_title ?></title>
  <meta name="description" content="Best Jewelry shop that sells different types of jewelry with best prices">
<meta name="keywords" content="Jewelry, shop, necklace, ring, braclet"> 
</head>
<header>
    <div class="navbar">
      <img src="images/logo-light.png" alt="Jewelry store logo" class="logo">
      <a href="main.php" class="navBtn">Products</a>

      <?php session_start();
       if (!isset($_SESSION['AdminUsername'])){
        echo '<a class="navBtn" href="Cart.php">Cart</a>'; 
        echo '<a class="navBtn" href="adminLogIn.php">Admin Log in</a>'; 
       }
        ?>
      
      <a href="contactUs.php" class="navBtn">Contact Us</a>

   
    <?php
    
			if ( isset( $_SESSION['AdminUsername']))
			{
        echo '<a href="adminMain.php" class="navBtn">  Admin main </a>';
        echo '<a href="logout.php" class="navBtn">  Log out </a>';
			}

			?>
 </div>
  </header>