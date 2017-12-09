<?php
	session_start();
	$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");

	$_SESSION["useranon"] = false;
	
	$register = array_key_exists("s_register", $_GET);
	if (!$register) {
		$admin = array_key_exists("m_login", $_GET);
		if (!$admin) {
			$cmd = "SELECT id FROM customers WHERE email = '" . $_GET["email"] . "' AND password = '" . $_GET["password"] . "'";
			$stmt = $dbconn->prepare($cmd);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			if (count($rows) > 0) {
				$_SESSION["userid"] = $rows;
				echo "<html><script>window.location = '../shop.php';</script></html>";
			} else {
				echo "<html><script>window.location = '../error/incorrect_login.html';</script></html>";
			}
		} else {
			if ($_GET["email"] === "admin@walmart.com" && $_GET["password"] === "admin")
				echo "<html><script>window.location = '../admin.php';</script></html>";
			else
				echo "<html><script>window.location = '../error/incorrect_login.html';</script></html>";
		}
	} else {
		//redirect to register instead
		echo "<html><script>window.location = 'register.php?email=".$_GET["email"]."&password=".$_GET["password"]."';</script></html>";
	}
	
?>

