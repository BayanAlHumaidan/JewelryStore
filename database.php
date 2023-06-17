<?php
// Connect to MySQL
if ( !( $database = mysqli_connect( "localhost",  
"root", "" ) ) )
die( "<p>Could not connect to database</p></body></html>" );

// open JewelryShop
if ( !mysqli_select_db(  $database,"JewelryShop" ) )
die( "<p>Could not open JewelryStore database</p>
   </body></html>" );
?> 