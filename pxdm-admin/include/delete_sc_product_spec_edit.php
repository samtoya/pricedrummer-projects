<?php
	require_once('../connections/db_connect_sc.php');//connect to the database
	
	$Delete_Spec_sql = "Delete from sc_details WHERE sc_ID =".$_POST['spec_id'].";";
	$Delete_Spec_result = $conn_sc->query($Delete_Spec_sql);
?>