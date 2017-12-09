<?php
	session_start();
	if (array_key_exists("store", $_GET)) $_SESSION["storeid"] = $_GET["store"];
	if (!array_key_exists("cartsize", $_SESSION)) $_SESSION["cartsize"] = 0;
	
	function query($cmd) {
		$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");
		$stmt = $dbconn->prepare($cmd);
		$stmt->execute();
		$rows = $stmt->fetchAll();
		return $rows;
	}
	
?>

<html>

	<head>
		<meta charset = "utf-8">
		<title>Walmart</title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/stylesheet.css">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
	</head>
	<body>
		
		<div class = 'container nobg'>
			<div class = "row"><img width = "50%" style = "max-width: 500px"
				src = "css/logo.png"></img></div>
		</div>
		
		<div class = "container nobg nopa" style = "margin-top: 40px;">
			<?php
				if ($_SESSION["useranon"] == true) { 
					echo "<a href = 'login.html' class = 'u-pull-right button button-primary'>Sign in</a>"; 
				} else {
					echo "<a href = 'scripts/logout.php' class = 'u-pull-right button'>Sign out</a>\n"; 
				}
			?>
		</div>
		
		<div class = "container" style = "margin-top: 40px;">
			<h3>Manager Options</h3>
			<hr>
			<h5>Statistics</h5>
			<?php
				
				$stock = query("SELECT * FROM stock");
				$stores = query("SELECT * FROM stores");
				$customers = query("SELECT * FROM customers");
				$vendors = query("SELECT * FROM vendors");
				echo "<b>Total inventory quantity: </b>" . count($stock) . " items across ". count($stores) ." stores<br>";
				echo "<b>Registered customers: </b>" . count($customers) . " customer(s) currently registered<br>";
				echo "<b>Available vendors: </b>" . count($vendors) . " supplying our products<br><hr>";
				
			?>
			<h5>Restocking</h5>
			<?php
			
				$rows = query("SELECT COUNT(*) as 'count', product_id, store_id FROM stock WHERE 1 = 1 GROUP BY product_id");
				echo "<table class = 'u-full-width'><tr><td><b>Count</b></td><td><b>Product ID</b></td><td><b>Store ID</b></td><td></td></tr>";
				foreach ($rows as $row) {
					echo "<tr><td>".$row["count"]."</td><td>".$row["product_id"]."</td><td>".$row["store_id"]."</td><td>
						<a href = 'error/vendor_confirmation.html' class = 'button u-pull-right'>Order Shipment</a>
						</td></tr>";
				}
				echo "</table>";
			?>
			<br><hr>
			<h5>System Administration</h5>
			<a class = "button" href = "./adminer/adminer-4.3.1.php">Database Management</a>
		</div>
		
		
	</body>
</html>