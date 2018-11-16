<?php
	include('../connections/db_connect.php');//connect to the database

	$product_id = $conn->real_escape_string($_POST['product_id']);
	$availability = $conn->real_escape_string($_POST['availability']);

	$update_product_acailability_sql = "UPDATE `retailer_products` SET `availability` = ".$availability." WHERE `retailer_products`.`id` = ".$product_id;

	$update_product_acailability_result = $conn->query($update_product_acailability_sql);


	if ($update_product_acailability_result === TRUE) {
		echo "1";
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

include('../connections/db_close_connect.php');//Close connection to the database
?>