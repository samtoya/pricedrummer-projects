<?php
	require_once('../connections/db_connect.php');//connect to the sc database
	require_once('../connections/db_connect.php');//connect to the database
	
	//COLLECT THE CATEGORY DETAILS/SPCS
	$Cat_Specs_sql = 'SELECT * FROM category_details WHERE category_ID ='.$_GET['cat_id'];
	$Cat_Specs_result = $conn->query($Cat_Specs_sql);
	
	
	$SC_Specs_sql = 'SELECT * FROM sc_details WHERE info_type="COMPULSORY" and product_ID ='.$_GET['prod_id'];
	$SC_Specs_result = $conn->query($SC_Specs_sql);
	
	$SC_Specs_sql_optional = 'SELECT * FROM sc_details WHERE info_type="OPTIONAL" and product_ID ='.$_GET['prod_id'];
	$SC_Specs_result_optional = $conn->query($SC_Specs_sql_optional);
	
	//create an assoc array with the prod specs
	$SC_Specs_rows = array();
	if ($SC_Specs_result->num_rows > 0) {
		while($SC_Specs_row = $SC_Specs_result->fetch_assoc()) {
			$SC_Specs_rows[$SC_Specs_row['detail_name']] = $SC_Specs_row['details_value'];
		}
	}
	
	$Specs = '';
	
	$Section = '';
	if ($SC_Specs_result_optional->num_rows > 0) {
		while($SC_Specs_optional_row = $SC_Specs_result_optional->fetch_assoc()) {
			if($Section == $SC_Specs_optional_row['category_section']){
				
			$Specs = $Specs . $SC_Specs_optional_row['detail_name']."<br/>".$SC_Specs_optional_row['detail_name']."<br/>";
			}else{
			$Section = $SC_Specs_optional_row['category_section'];
			$Specs = $Specs ."<br/>".$SC_Specs_optional_row['category_section']." ===<br/><br/>".$SC_Specs_optional_row['detail_name']."<br/>".$SC_Specs_optional_row['detail_name']."<br/>";
			}
	
		}
	}
	echo $Specs 
?>