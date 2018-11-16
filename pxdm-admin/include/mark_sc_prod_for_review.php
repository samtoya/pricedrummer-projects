<?php
	require_once('../connections/db_connect_sc.php');//connect to the database
	
	//get the current user from the session variable set at login
	$user_id = 0;
	if(isset($_SESSION['user_id'])){
		$user_id = $conn_sc->real_escape_string($_SESSION['user_id']);
	}
	
	$Item_review_status_sql = "UPDATE `sc` SET reviewed_by = '".$user_id."',`status`='RECHECK' WHERE sc_ID ='".$_POST['spec_id']."';";
	$Item_review_status_result = $conn_sc->query($Item_review_status_sql);


include('../connections/db_close_connect_sc.php');//close the connection to the database
?>