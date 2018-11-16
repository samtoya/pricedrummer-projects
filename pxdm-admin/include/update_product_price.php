<?php
	include('../connections/db_connect.php');//connect to the database
	
	
	if (!isset($_SESSION)) {
		session_start();
		
	}
	$User_Id = 0;
	if(isset($_SESSION['user_id'])){
		$User_Id = $_SESSION['user_id'];
	}
	
	$productID = $_POST['Product_ID'];
	$price = $_POST['Price'];

	
	//prepare the values for sql
	$User_Id = $conn->real_escape_string($User_Id);
	$productID = $conn->real_escape_string($productID);
	$price = $conn->real_escape_string(preg_replace("/[^0-9.]/", "",$price));
	
	
	$sql = 'UPDATE products SET price = "'.$price.'", reviewed_by = '.$User_Id.' WHERE product_ID ="'.$productID.'";';
	$result = $conn->query($sql);
	
	if($result){
		echo $productID;
	}else{
		die(mysqli_error($conn));
	}
	
	include('../connections/db_close_connect.php');//close the connection to the database
?>