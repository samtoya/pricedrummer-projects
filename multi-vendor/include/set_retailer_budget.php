<?php
require_once('../connections/db_connect.php');//connect to the database

// *** Validate request to login to this site.
	if (!isset($_SESSION)) {
		session_start();
	}

function random20() {
	$number = "";
	for($i=0; $i<20; $i++) {
		$min = ($i == 0) ? 1:0;
		$number .= mt_rand($min,9);
	}
	return $number;
}


//Prepare Values
$retailer_id 					= $conn->real_escape_string($_POST['rerailer_id']);
$budget_amount 					= $conn->real_escape_string($_POST['budget_amount']);
$budget_type 					= $conn->real_escape_string($_POST['budget_type']);
$budget_status 					= $_POST['retailer_status'];
$user_ip 						= $conn->real_escape_string($_POST['retailer_ip']);
$user_country 					= $conn->real_escape_string($_POST['retailer_country']);
$Last_update_timestamp 			=date('Y-m-d H:i:s');
$doc_number 					= "BP";
$doc_number 					.=  random20();
$location_success 				= "SET_SUCCESS";
$location_success_update 		= "UPDATE_SUCCESS";
$location_failed_set			= "SET_FAILED";
$location_failed_update			= "UPDATE_FAILED";



if(isset($budget_status) && $budget_status =="First_Time"){//======================FIRST TIME RETAILER BUDGET========================//
	//PROCESS FIRST TIME BUDGET SET.
	$add_budget_sql = "INSERT INTO `retailer_budget` (`retailer_id`, `budget_type`, `amount`, `current_balance`, `status`, `Last_update_timestamp`) VALUES 
	(".$retailer_id.", '".$budget_type."', ".$budget_amount.", '".$budget_amount."', '1', '".$Last_update_timestamp."')";

	$add_budget_result = $conn->query($add_budget_sql);

	if ($add_budget_result === TRUE) {
		//echo "1";		//All is well

		//Add the trail if the budget was set successfully
		$add_budget_trail_sql = "INSERT INTO `retailer_invoice_trail` (`retailer_id`, `user_ip`, `country`, `doc_number`, `amount`, `invoice_type`) VALUES ( '".$retailer_id."', '".$user_ip."', '".$user_country."', '".$doc_number."', '".$budget_amount."', 'BUDGET_SET')";
		$add_budget_trail_result = $conn->query($add_budget_trail_sql);

		if ($add_budget_trail_result === TRUE) {
		//echo "1";		//All is well
			$_SESSION['retailer_status'] = "Old_User";
			//header("Location: ".$location_success);
			die($location_success);
		} else {

		//header("Location: ".$location_failed);
		echo "Error: " . $sql . "<br>" . $conn->error;
		die($location_failed); //An Error Occured 
		}


	}else {
		//header("Location: ".$location_failed);

		echo "Error: " . $sql . "<br>" . $conn->error;
		//die("0"); //An Error Occured
        // die($location_failed);
	}

	





}elseif(isset($budget_status) && $budget_status =="Old_User"){//======================EXISTING RETAILER BUDGET========================//
	//PROCESS UPDATE BUDGET .
	$add_budget_sql = "UPDATE `retailer_budget` SET `amount` = '".$budget_amount."', `budget_type` = '".$budget_type."', `current_balance` = `current_balance` + '".$budget_amount."' WHERE `retailer_budget`.`retailer_id` = ".$retailer_id.";";
	$add_budget_result = $conn->query($add_budget_sql);

	if ($add_budget_result === TRUE) {
		//echo "1";		//All is well

		//Add the trail if the budget was updated successfully
		$add_budget_trail_sql = "INSERT INTO `retailer_invoice_trail` (`retailer_id`, `user_ip`, `country`, `doc_number`, `amount`, `invoice_type`) VALUES ( '".$retailer_id."', '".$user_ip."', '".$user_country."', '".$doc_number."', '".$budget_amount."', 'BUDGET_SET')";
		$add_budget_trail_result = $conn->query($add_budget_trail_sql);

		if ($add_budget_trail_result === TRUE) {
			//echo "1";		//All is well
			//header("Location: ".$location_success_update);
			die($location_success_update);

		} else {
			//header("Location: ".$location_failed_update);
			//echo "Error: " . $sql . "<br>" . $conn->error;
			die($location_failed_update); //An Error Occured 
		}

	} else {
		//header("Location: ".$location_failed_update);
		//echo "Error: " . $sql . "<br>" . $conn->error;
		//die("0"); //An Error Occured 
		die($location_failed_update);

	}

	
}

?>