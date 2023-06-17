<?php
include("includes/header.php");


session_destroy();
echo "<script>alert('Logged out successfully');</script>";
header("Location: main.php");
include("includes/footer.html");

?>