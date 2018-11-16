<?php
	
	require_once('../connections/db_connect.php');//connect to the database
	require_once('../connections/db_connect_sc.php');//connect to the database

	//COLLECT THE CURRENT CATEGORY 
	$Cat_sql = 'SELECT * FROM category WHERE category_ID ='.$_POST['cat'];
	$Cat_result = $conn_sc->query($Cat_sql);
	$row_Cat = $Cat_result->fetch_assoc();
	//prepare standard name(replace names containing spaces with an underscore"_")
	$Standard_Naming_String = '';
	if(preg_match('/\s/',$row_Cat['standard_naming']) > 0){
		echo $Standard_Naming_String = trim(preg_replace('/\s+/', '_', $row_Cat['standard_naming']));
	}else{
		echo $Standard_Naming_String = trim($row_Cat['standard_naming']);
	} 
	
?>