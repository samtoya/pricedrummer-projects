<?php
	include('../connections/db_connect.php');//connect to the database

	$Image_Id = $conn->real_escape_string($_POST['Image_Id']);

	$delete_product_Image_sql = "DELETE FROM `retailer_product_images` WHERE `retailer_product_images`.`id` =".$Image_Id;

	$delete_product_Image_result = $conn->query($delete_product_Image_sql);


	if ($delete_product_Image_result === TRUE) {
		echo "1";
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

include('../connections/db_close_connect.php');//Close connection to the database
?>