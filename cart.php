<?php
	session_start();
	$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");
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
				echo "<a href = 'shop.php' class = 'button button-primary'>Back</a>";
				if ($_SESSION["useranon"] == true) { 
					echo "<a href = 'login.html' class = 'u-pull-right button button-primary'>Sign in</a>"; 
				} else {
					echo "<a href = 'scripts/logout.php' class = 'u-pull-right button'>Sign out</a>\n"; 
				}
			?>
		</div>
		
		<div class = "container" style = "margin-top: 40px;">
			<h4>Your Shopping Cart</h4>
			<table class = "u-full-width"><tr><td><b>Item</b></td><td><b>Price</b></td><td><b>Store ID</b></td><td></td></tr>
			<?php
				//info to get: filters
				$size = $_SESSION["cartsize"];
				if ($size == 0) { echo "<tr><td>You have no items in your cart!</td></tr>"; } else {
					for ($i = 0; $i < $size; $i++) {
						echo "<tr><td>".($_SESSION['cartitemname'.$i])."</td><td>"
						.($_SESSION['cartitemprice'.$i])."</td><td>"
						.($_SESSION['cartitemstore'.$i])."</td></tr>";
					}
					echo "</table><a class = 'button button-primary' href = 'scripts/checkout.php'>Checkout</a>";
					echo "</table><a class = 'button' href = 'scripts/deletecart.php'>Clear order</a>";
				}
			?>
			
		</div>
		
		
	</body>
</html>