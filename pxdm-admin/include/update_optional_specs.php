<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	require_once('../connections/db_connect.php');//connect to the database
	require_once('../connections/db_connect.php');//connect to the database
	
	
	//Prepare The Values for sql
	$Product_ID = $conn->real_escape_string($_POST['Prod_ID']);
	
	$DeleteItemSpecs_sql = "DELETE FROM `sc_details` WHERE `category_section`<> ='Standard' and `sc_details`.`product_ID`".$Product_ID;
	$DeleteItemSpecs_result = $conn->query($DeleteItemSpecs_sql);
	
	if(isset($_POST['Product_Information_hidden']) && $_POST['Product_Information_hidden'] != ''){
		$Optional_Specs = explode("\n", $_POST['Product_Information_hidden']);
		foreach ($Optional_Specs as $Spec) {
			if(!empty($Spec)){
				$spec_details =	explode("|", $Spec);
				
				//Prepare the values for mysql
				$details_code = $conn->real_escape_string($spec_details[1]);
				$details_value = $conn->real_escape_string($spec_details[2]);
				$detail_name = $conn->real_escape_string($spec_details[1]);
				$category_section = $conn->real_escape_string($spec_details[0]);
				
				$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
				('".trim($details_code)."', '".trim($details_value)."', '".trim($detail_name)."', '".trim($category_section)."', ".$Product_ID.", 'Fixed', 'OPTIONAL')";
				$ItemSpecs_result = $conn->query($ItemSpecs_sql);
			}
		}
	}
	
	
	//get the current user from the session variable set at login
	$user_id = 0;
	if(isset($_SESSION['user_id'])){
		$user_id = $conn->real_escape_string($_SESSION['user_id']);
	}
	$Item_review_status_sql = "UPDATE `sc` SET reviewed_by = '".$user_id."',`status`='ACTIVE' WHERE sc_ID ='".$Product_ID."';";
	$Item_review_status_result = $conn->query($Item_review_status_sql);
	
	
	header('Location: ../standard/review_product_list.php?'.$_SESSION["Category_Status"].'=&Category='.$_SESSION["Category"].'&Cat_level='.$_SESSION["Cat_level"]);
	
	
	include('../connections/db_close_connect.php');//close the connection to the database
	include('../connections/db_close_connect.php');//close the connection to the database
?>