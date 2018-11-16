<?php
include_once('db_config.php');
	// Create connection
	function connect_pdo() {
        global $servername,$dbname,$username,$password;
    return new PDO('mysql:host='.$servername.';dbname='.$dbname.'', ''.$username.'', ''.$password.'', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
/*include('db_config.php');
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully to $dbname";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}*/
?> 