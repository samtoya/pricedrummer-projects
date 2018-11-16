<?php
	$host = 'localhost';
	$username = 'root';
	$password = '7936_Pxd$*M';
	$database = 'pxdm_cr';
	
	$link = mysqli_connect( $host, $username, $password );
	if ($link) mysqli_select_db( $link, $database);