<?php
	session_start();
	$dbconn = new PDO("mysql:host=localhost;dbname=enterprise", "root", "");
?>

<html>
	<head>
		<title>Store Selection</title>
		<link rel="stylesheet" type="text/css" media="screen" href="../css/stylesheet.css">
	</head>

	<body>
		<div class = 'container nobg'>
			<div class = "row"><img width = "50%" style = "max-width: 500px"
				src = "../css/logo.png"></img></div>
		</div>
		
		<div class = 'container' style = 'margin-top: 40px;'>
			<h2>Where are you shopping from today?</h2>
			<h6>Please choose a store from the list.</h6>
			<?php
				$cmd = "SELECT * FROM stores";
				$stmt = $dbconn->prepare($cmd);
				$stmt->execute();
				$rows = $stmt->fetchAll();
				foreach ($rows as $row) {
					echo "<a href = '../shop.php?store=".$row['id']."' class = 'button'>".$row['name']."</a><br>";
				}
				
				$_SESSION["cartsize"] = 0;
				
			?>
	</div>
	</body>
</html>