<?php
	include('db_config_sc.php');

	// Create connection
	$conn_sc = new mysqli($servername_sc, $username_sc, $password_sc, $dbname_sc);
	// Check connection
	if ($conn_sc->connect_error) {
		die("Connection failed: " . $conn_sc->connect_error);
	}
	//echo'connected to db';
?> 