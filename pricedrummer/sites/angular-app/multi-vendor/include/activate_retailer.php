<?php
	include('../connections/db_connect.php');//connect to the database
	
	$code = $conn->real_escape_string($_POST['code']);

	$Update_Retailer_sql = 'UPDATE `users` SET `status` = "A" WHERE `users`.`activation_code` = "'.$code.'"';
	$Update_Retailer_result = $conn->query($Update_Retailer_sql);

	if($Update_Retailer_result){
		header('Location: ../public/index.php?a_success=1');
	}else{
		echo "Error: " . $Update_Retailer_sql . "<br>" . $conn->error;
		die();
		header('Location: ../public/retailer_account_activation.php?a_success=0');
	}

	include('../connections/db_close_connect.php');//close the connection to the database
?>