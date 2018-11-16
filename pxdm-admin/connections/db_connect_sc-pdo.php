<?php
require_once('db_config_sc.php');
// Create connection
	function connect_pdo_sc() {
        global $servername_sc,$dbname_sc,$username_sc,$password_sc;
    return new PDO('mysql:host='.$servername_sc.';dbname='.$dbname_sc.'', ''.$username_sc.'', ''.$password_sc.'', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
?> 