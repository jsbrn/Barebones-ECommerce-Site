<?php
	session_start();
	$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");
	if (array_key_exists("store", $_GET)) $_SESSION["storeid"] = $_GET["store"];
	if (!array_key_exists("cartsize", $_SESSION)) $_SESSION["cartsize"] = 0;
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
				echo "<a href = 'cart.php' class = 'button button-primary'>Your Cart (" . $_SESSION["cartsize"] . ")</a>"; 
				if ($_SESSION["useranon"] == true) { 
					echo "<a href = 'login.html' class = 'u-pull-right button button-primary'>Sign in</a>"; 
				} else {
					echo "<a href = 'scripts/logout.php' class = 'u-pull-right button'>Sign out</a>\n"; 
				}
			?>
		</div>
		
		<div class = "container" style = "margin-top: 40px;">
			<h4>Browse Items</h4>
			<a href = "error/choose_store.php" class = "button">Change store</a>
			<?php
				$store = 0; if (array_key_exists("storeid", $_SESSION)) $store = $_SESSION["storeid"]; 
						else echo "<html><script>window.location = '../error/choose_store.php';</script></html>"; //redirect to choose store page
				$cmd = "SELECT * FROM products WHERE products.id = ANY(SELECT product_id FROM stock" . ($store != NULL ? " WHERE store_id = " . $store : "") .")";
				$stmt = $dbconn->prepare($cmd);
				$stmt->execute();
				$rows = $stmt->fetchAll();
				echo "<table class = 'u-full-width'>";
				echo "<tr><td><b>Product Name</b></td><td><b>Price</b></td><td></td></tr>";
				if (count($rows) == 0) { echo "<tr><td>Looks like we're out of stock! Whoops!</td></tr>"; } else {
					foreach ($rows as $row) {
						echo "<tr><td>".$row['name']."</td><td>".$row['price']
					."</td><td><a href = 'scripts/addtocart.php?product_id=".$row['id']."&store=".$store."&name=".$row['name']."&price=".$row['price']
					."' class = 'button u-pull-right'>Add to cart</button></tr>";
					}
				}
				echo "</table>";
			?>
		</div>
		
		
	</body>
</html>