<?php
	if (!isset($_SESSION)) {
		session_start();
	} 
	
	require_once('../connections/db_connect.php');//connect to the database
	require_once('../connections/db_connect_sc.php');//connect to the database
	
	
	//==================PREPARE CATEGORY=======================================//
	$Category = '';
	$Product_ID = $conn->real_escape_string($_POST['SCProductID']);
	
	if(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 1){
		$Category = $_POST['Level1'];
		}elseif(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 2){
		$Category = $_POST['Level2'];
		}elseif(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 3){
		$Category = $_POST['Level3'];
		}elseif(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 4){
		$Category = $_POST['Level4'];
	}
	
	//get the current user from the session variable set at login
	$user_id = 0;
	if(isset($_SESSION['user_id'])){
		$user_id = $conn->real_escape_string($_SESSION['user_id']);
	}
	
	//Prepare The Values for sql
	$Category = $conn->real_escape_string($Category);
	$MODEL_NUMBER = $conn->real_escape_string($_POST['MODEL_NUMBER']);
	$STANDARD_NAME = $conn->real_escape_string($_POST['STANDARD_NAME']);
	$TimeStamp =  $conn->real_escape_string(date('Y-m-d H:i:s'));

	//collect the alternative names IF ANY
	if(isset($_POST['ALT_NAME1'])){
		$ALT_NAME1 = $conn_sc->real_escape_string($_POST['ALT_NAME1']);
	}else{
		$ALT_NAME1 = "";
	}
	if(isset($_POST['ALT_NAME2'])){
		$ALT_NAME2 = $conn_sc->real_escape_string($_POST['ALT_NAME2']);
	}else{
		$ALT_NAME2 = "";
	}
	
	//==UPDATE THE STANDARD NAME AND CATEGORY AND ANY ALTERNATIVE NAME PROVIDED
	if(isset($_POST['STANDARD_NAME']) && $_POST['STANDARD_NAME'] != ''){
		//update the standard name 
		$ItemName_sql = "UPDATE `sc` SET `product_name`='".$STANDARD_NAME."' , `alt_name1`='".$ALT_NAME1."', `alt_name2`='".$ALT_NAME2."', `modal_number` = '".$MODEL_NUMBER."' , `category_ID`='".$Category."' , reviewed_by = '".$user_id."' WHERE sc_ID ='".$Product_ID."';";
		$ItemName_result = $conn_sc->query($ItemName_sql);
		
		//UPDATE PRODUCTS AND RESET THE MODEL NUMBER -- To ensure that is the moden number is corrected, it will reflect on its merchant poducts
		$Update_Merchant_sql = 'UPDATE `products` SET model_number = "'.$MODEL_NUMBER.'", reviewed_by = '.$user_id.', review_timestamp = "'.$TimeStamp.'" WHERE sc_ID ="'.$Product_ID.'";'; //the sc_ID is in the products table. its the field that checks the trail for the sc product
		$Update_Merchant_result = $conn->query($Update_Merchant_sql);
		
		
	}
	
	//================================UPDATE SPECS=======================================//
	$ITEM_SPECKS = $_POST['ItemSpecs'];
	foreach ($ITEM_SPECKS as $key=>$value) {
		if(empty($value)){
			//do nothing
			
			}else{
			//Split the name(key) to get the details code and the details value
			$DetailsCodeAndValue = explode("|",$key);
			$key_and_type_string = $DetailsCodeAndValue[1];
			$code = $conn_sc->real_escape_string($DetailsCodeAndValue[0]);
			$key_and_type =	explode("_", $key_and_type_string);
			$key = $conn_sc->real_escape_string($key_and_type[0]);
			$type = $conn_sc->real_escape_string($key_and_type[1]);
			$cat_section = $conn_sc->real_escape_string($key_and_type[2]);
			
			$Prep_Value = '';
			//CHECK IF THE PRODUCT SPEC EXIST IN THE DATABASE
			$Check_Specs_sql = 'SELECT * FROM sc_details WHERE details_code like "'.trim($code).'" and info_type like "'.$type.'" and product_ID ='.$Product_ID.';';
			$Check_Specs__result = $conn_sc->query($Check_Specs_sql);
			if($Check_Specs__result->num_rows > 0){
				//product spec was found
				//update the newly inserted specs above
				if(is_array($value)){
					$JointSelections = implode("|",$value);
					$Prep_Value = $JointSelections;
					$ItemSpecs_sql = "UPDATE `sc_details` SET `details_value`='".$Prep_Value."' WHERE details_code ='".$code."' and category_section ='".$cat_section."' and info_type ='".$type."' and product_ID =".$Product_ID.";";
					$ItemSpecs_result = $conn_sc->query($ItemSpecs_sql);
					
					}else{
					
					$Prep_Value = $value;
					$ItemSpecs_sql = "UPDATE `sc_details` SET `details_value`='".$Prep_Value."' WHERE details_code ='".$code."' and category_section ='".$cat_section."' and info_type ='".$type."' and product_ID =".$Product_ID.";";
					$ItemSpecs_result = $conn_sc->query($ItemSpecs_sql);
				}
				
				}else{
				if(is_array($value)){
					//value is an array so split the value and insert as a multiple type	
					$JointSelections = implode("|",$value);
					$Prep_Value = $conn_sc->real_escape_string($JointSelections);
					$key = $conn_sc->real_escape_string($key);
					
					$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
					('".$code."', '".$Prep_Value."', '".$key."', 'Standard', ".$Product_ID.", 'Multiple', 'COMPULSORY')";
					$ItemSpecs_result = $conn_sc->query($ItemSpecs_sql);
					
					}else{
					//value is not an array so do direct insert
					$Prep_Value = $conn_sc->real_escape_string($value);
					$key = $conn_sc->real_escape_string($key);
					$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
					('".$code."', '".$Prep_Value."', '".$key."', 'Standard', ".$Product_ID.", 'Fixed', 'COMPULSORY')";
					$ItemSpecs_result = $conn_sc->query($ItemSpecs_sql);
				}
			}
			
		}
		
		}
		
		/*THIS CODE IS NO MORE IN USE
			if(isset($_POST['Product_Information_hidden']) && $_POST['Product_Information_hidden'] != ''){
			$Optional_Specs = explode("\n", $_POST['Product_Information_hidden']);
			foreach ($Optional_Specs as $Spec) {
			
			if(!empty($Spec)){
			$spec_details =	explode("|", $Spec);
			//==CHECK IF THE CURRENT SPECS IS ALREADY IN THE DB. IF YES, THEN UPDATE IT ELSE INSERT NEW
			//Prepare the values for mysql
			$details_code = $conn->real_escape_string($spec_details[1]);
			$category_section = $conn->real_escape_string($spec_details[0]);
			$details_value = $conn->real_escape_string($spec_details[2]);
			$detail_name = $conn->real_escape_string($spec_details[1]);
			
			$SC_Specs_Optional_sql = 'SELECT * FROM sc_details WHERE info_type = "OPTIONAL" and details_code = "'.trim($details_code).'" and product_ID ='.$Product_ID;
			$SC_Specs_Optional_result = $conn->query($SC_Specs_Optional_sql);
			
			if ($SC_Specs_Optional_result) {
			$ItemSpecs_sql = "UPDATE `sc_details` SET `details_value`='".trim($details_value)."' WHERE info_type = 'OPTIONAL' and details_code ='".trim($details_code)."' and product_ID =".$Product_ID.";";
			$ItemSpecs_result = $conn->query($ItemSpecs_sql);
			}else{
			$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
			('".trim($details_code)."', '".trim($details_value)."', '".trim($detail_name)."', '".trim($category_section)."', ".$Product_ID.", 'Fixed', 'OPTIONAL')";
			$ItemSpecs_result = $conn->query($ItemSpecs_sql);
			}
			
			}
			}
			
			}
		*/
		if(isset($_POST['Product_Information_hidden']) && $_POST['Product_Information_hidden'] != ''){
			$Optional_Specs = explode("\n", $_POST['Product_Information_hidden']);
			foreach ($Optional_Specs as $Spec) {
				if(!empty($Spec)){
					$spec_details =	explode("|", $Spec);
					
					//Prepare the values for mysql
					$details_code = $conn_sc->real_escape_string(strtoupper(str_replace(' ', '_',$spec_details[1])));
					$details_value = $conn_sc->real_escape_string($spec_details[2]);
					$detail_name = $conn_sc->real_escape_string($spec_details[1]);
					$category_section = $conn_sc->real_escape_string($spec_details[0]);
					
					$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
					('".trim($details_code)."', '".trim($details_value)."', '".trim($detail_name)."', '".trim($category_section)."', ".$Product_ID.", 'Fixed', 'OPTIONAL')";
					$ItemSpecs_result = $conn_sc->query($ItemSpecs_sql);
				}
			}
		}
		
		
		//================================PREPARE IMAGE=======================================//
		
		function reArrayFiles(&$file_post) {
			
			$file_ary = array();
			$file_count = count($file_post['name']);
			$file_keys = array_keys($file_post);
			
			for ($i=0; $i<$file_count; $i++) {
				foreach ($file_keys as $key) {
					$file_ary[$i][$key] = $file_post[$key][$i];
				}
			}
			
			return $file_ary;
		}
		
		function any_uploaded($name) {
			foreach ($_FILES[$name]['error'] as $ferror) {
				if ($ferror != UPLOAD_ERR_NO_FILE) {
					return true;
				}
			}
			return false;
		}
		
		if (any_uploaded('Product_Image')) {
			$file_ary = reArrayFiles($_FILES['Product_Image']);
			if(!empty($file_ary)){
				foreach ($file_ary as $file) {
					
					if(getimagesize($file['tmp_name']) == FALSE){
						//no image selected
						}else{
						print 'File Name: ' . $file['name'];
						echo "<br/>";
						print 'File Type: ' . $file['type'];
						echo "<br/>";
						print 'File Size: ' . $file['size'];
						echo "<br/>";
						echo "<br/>";
						
						//process selected image
						$image= addslashes($file['tmp_name']);
						$name= addslashes($file['name']);
						$image_type= addslashes($file['type']);
						$image= file_get_contents($image);
						$image= base64_encode($image);
						
						$ItemImage_sql = "INSERT INTO `sc_images` (`image`, `imageType`, `product_ID`) VALUES
						('".$image."', '".$image_type."', '".$Product_ID."')";
						$ItemImage_result = $conn_sc->query($ItemImage_sql);
					}
				}
			}
		}
		
		//get the current user from the session variable set at login
		$user_id = 0;
		if(isset($_SESSION['user_id'])){
			$user_id = $conn_sc->real_escape_string($_SESSION['user_id']);
		}
		$Item_review_status_sql = "UPDATE `sc` SET reviewed_by = '".$user_id."',`status`='ACTIVE' WHERE sc_ID ='".$Product_ID."';";
		$Item_review_status_result = $conn_sc->query($Item_review_status_sql);
		
		
		header('Location: ../standard/review_product_list.php?Category='.$_SESSION["Category"].'&Cat_level='.$_SESSION["Cat_level"]);
		
		
		include('../connections/db_close_connect.php');//close the connection to the database
		include('../connections/db_close_connect_sc.php');//close the connection to the database
	?>										