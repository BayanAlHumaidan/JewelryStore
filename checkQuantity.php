<?php
function checkQuantity($db, $pid, $quan)
{
	$query = "SELECT stock FROM Products_ where pid=" . $pid;
	if (!($result = mysqli_query($db, $query))) {
		print("<p>Could not execute query!</p>");
		die(mysqli_error($db) . "</body></html>");
	} // end if
	$Queryresult = mysqli_fetch_row($result);

	$stock = $Queryresult[0];

		if ($stock > $quan) {
		return true;
		} else
		return false;
	}

?>