<?php
	session_start();
	//$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");
	//if (array_key_exists("store", $_GET)) $_SESSION["storeid"] = $_GET["store"];
	//if (!array_key_exists("cartsize", $_SESSION)) $_SESSION["cartsize"] = 0;
?>

<html>
	<head>
		<title>Order Received</title>
		<link rel="stylesheet" type="text/css" media="screen" href="../css/stylesheet.css">
	</head>

	<body>
		<div class = 'container nobg'>
			<div class = "row"><img width = "50%" style = "max-width: 500px"
				src = "../css/logo.png"></img></div>
		</div>
		
		<div class = 'container' style = 'margin-top: 40px;'>
			<h2>Your order has been received!</h2>
			<?php
				if (!$_SESSION["useranon"]) {
					echo "<h6>We will ship it to the address on file shortly.</h6>";
				} else {
					echo "<h6>Please enter your address so we can ship it to you.</h6><input class = 'u-full-width' type = 'text'></input>";
				}
			?>
			<a class = "button u-pull-right" href = '../shop.php'>Continue shopping</a>
		</div>
	</body>
</html>