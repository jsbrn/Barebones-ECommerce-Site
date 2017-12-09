<?php
	session_start();
	$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");
	
	$id = rand(0, 10000000);
	$cmd = "INSERT INTO `customers` (`id`, `email`, `password`) VALUES ('".$id."', '".$_GET["email"]."', '".$_GET["password"]."')";
	$stmt = $dbconn->prepare($cmd);
	$stmt->execute();
	
	$_SESSION["useranon"] = false;
	$_SESSION["userid"] = $id;
	
	echo "<html><script>window.location = '../shop.php';</script></html>";

?>

