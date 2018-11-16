<?php
	include('../connections/db_connect.php');//connect to the database
	
	
	if (!isset($_SESSION)) {
		session_start();
		
	}
	$User_Id = 0;
	if(isset($_SESSION['user_id'])){
		$User_Id = $_SESSION['user_id'];
	}
	
	//prepare the values for sql
	$Reason = $conn->real_escape_string($_POST['reason']);
	$User_Id = $conn->real_escape_string($User_Id);
	$productID = $conn->real_escape_string($_POST['pID']);
	
	
	$sql = 'UPDATE products SET  sc_status = "'.$Reason.'", reviewed_by = '.$User_Id.' WHERE product_ID ="'.$productID.'";';
	$result = $conn->query($sql);
	
	echo $productID;
	include('../connections/db_close_connect.php');//close the connection to the database
?>