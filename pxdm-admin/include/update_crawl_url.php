<?php
	include('../connections/db_connect.php');//connect to the database
	
	
	$Update_sql = sprintf("Update crawl_url set url_status = 'ACTIVE', merchant_url = '%s' where crawl_url_ID='%s'",
	mysqli_real_escape_string($conn,$_POST['Url']),
	mysqli_real_escape_string($conn,$_POST['crawl_url_ID']));
	$result = $conn->query($Update_sql);

	
	include('../connections/db_close_connect.php');//close the connection to the database
?>