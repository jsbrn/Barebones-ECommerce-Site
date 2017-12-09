<?php
	session_start();
	$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");
	for ($i = 0; $i < $_SESSION["cartsize"]; $i++) {
		$product_id = $_SESSION["cartitemid".$i];
		
		$cmd = "DELETE FROM stock WHERE store_id = ".$_SESSION["cartitemstore".$i]." AND product_id = ".$product_id." LIMIT 1";
		$stmt = $dbconn->prepare($cmd);
		$stmt->execute();
		
		echo $cmd."<br>";
		
	}
	
	$_SESSION["cartsize"] = 0; //clear cart
	
	echo "<html><script>window.location = '../error/checkout_successful.php';</script></html>";

?>

