<?php
	include('../connections/db_connect.php');//connect to the database

	$product_id = $conn->real_escape_string($_POST['product_id']);

	$delete_product_sql = "UPDATE `retailer_products` SET `status` = 'DELETED' WHERE `retailer_products`.`id` = ".$product_id;

	$delete_product_result = $conn->query($delete_product_sql);


	if ($delete_product_result === TRUE) {
		echo "1";
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

include('../connections/db_close_connect.php');//Close connection to the database
?>