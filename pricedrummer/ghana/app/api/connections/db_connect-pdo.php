<?php
	// Create connection
	function connect_pdo() {
	include('db_config.php');
    return new PDO('mysql:host='.$servername.';dbname='.$dbname.'', ''.$username.'', ''.$password.'', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
?> 