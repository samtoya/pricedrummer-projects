<?php
	require_once('../connections/db_connect.php');//connect to the database
	
	$Product_ID = $_POST['P_ID'];
	
	//====================================PREPARE ITEM SPECKS=========================//

	$ITEM_SPECKS = $_POST['ItemSpecs'];
	foreach ($ITEM_SPECKS as $key=>$value) {
		$Prep_Value = '';
		if(is_array($value)){
			$JointSelections = implode("|",$value);
			$Prep_Value = $JointSelections;
			$ItemSpecs_sql = "UPDATE `sc_details` SET `details_value`='".$Prep_Value."' WHERE details_code ='".$key."' and product_ID =".$Product_ID.";";
			$ItemSpecs_result = $conn->query($ItemSpecs_sql);
			}else{
			$Prep_Value = $value;
			$ItemSpecs_sql = "UPDATE `sc_details` SET `details_value`='".$Prep_Value."' WHERE details_code ='".$key."' and product_ID =".$Product_ID.";";
			$ItemSpecs_result = $conn->query($ItemSpecs_sql);
		}
		
	}
	
?>