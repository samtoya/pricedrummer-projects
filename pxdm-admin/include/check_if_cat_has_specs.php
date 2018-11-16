<?php
	
	require_once('../connections/db_connect.php');//connect to the database
	require_once('../connections/db_connect_sc.php');//connect to the database

	//COLLECT THE CATEGORY DETAILS/SPCS
	$Cat_Specs_sql = 'SELECT * FROM category_details WHERE category_ID ='.$_POST['cat_id'];
	$Cat_Specs_result = $conn_sc->query($Cat_Specs_sql);
	
	if ($Cat_Specs_result->num_rows > 0) {
		echo 1;
	}else{
		echo 0;
	}

?>