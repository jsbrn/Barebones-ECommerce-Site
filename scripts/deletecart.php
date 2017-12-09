<?php
	session_start();
	
	$_SESSION["cartsize"] = 0;

	//redirect to shop
	echo "<html><script>window.location = '../cart.php';</script></html>";
?>

