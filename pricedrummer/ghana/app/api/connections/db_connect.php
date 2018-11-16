<?php
	include('db_config.php');
	// shell_exec('ssh -f -L 12.0.0.1:3306:pricedrummer.com.gh:3306 root@pricedrummer.com.gh sleep 60 >> logfile');

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo'connected to db1'. $dbname .$servername;
?> 