<?php
	session_start();
	session_destroy();
	
	echo "<html><script>window.location = '../login.html';</script></html>";
	
?>

