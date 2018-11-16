<?php
	require_once('../connections/db_connect.php');//connect to the database
	require_once('../connections/db_connect_sc.php');//connect to the database

	$spec_id = $conn->real_escape_string($_POST['spec_id']);
	
	$Delete_product_sql = "UPDATE `sc` SET `status` = 'DELETED' WHERE `sc`.`sc_ID` =".$spec_id.";";
	$Delete_product_result = $conn_sc->query($Delete_product_sql);
	
	//Revert the merchant product to the state of accepted and unset the sc product id linked to it so it shows up in the categorized queue
	$Unset_merchant_product_sql = "UPDATE `products` SET `sc_ID` = '',`sc_status` = 'ACCEPTED' WHERE `products`.`sc_ID` =".$spec_id.";";
	$Unset_merchant_product_result = $conn->query($Unset_merchant_product_sql);
	
?>
