<?php
	session_start();
	
	$_SESSION["cartitemid" . ($_SESSION["cartsize"])] = $_GET["product_id"];
	$_SESSION["cartitemstore" . ($_SESSION["cartsize"])] = $_GET["store"];
	$_SESSION["cartitemname" . ($_SESSION["cartsize"])] = $_GET["name"];
	$_SESSION["cartitemprice" . ($_SESSION["cartsize"])] = $_GET["price"];
	$_SESSION["cartsize"]++;

	//redirect to shop
	echo "<html><script>window.location = '../shop.php';</script></html>";
?>

