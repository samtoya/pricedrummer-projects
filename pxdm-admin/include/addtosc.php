<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	require_once('../connections/db_connect.php');//connect to the database
	require_once('../connections/db_connect_sc.php');//connect to the database

	//==================PREPARE CATEGORY=======================================//
	$Category = '';
	
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
	$MODEL_NUMBER = trim($conn->real_escape_string($_POST['MODEL_NUMBER']));
	//remove multiple space and trim all spaces before and after the standard name
	$STANDARD_NAME = preg_replace('/\s+/', ' ',trim($conn->real_escape_string($_POST['STANDARD_NAME'])));
	
	//collect the alternative names
	if(isset($_POST['ALT_NAME1'])){
		$ALT_NAME1 = preg_replace('/\s+/', ' ',trim($conn->real_escape_string($_POST['ALT_NAME1'])));
	}else{
		$ALT_NAME1 = "";
	}
	if(isset($_POST['ALT_NAME2'])){
		$ALT_NAME2 = preg_replace('/\s+/', ' ',trim($conn->real_escape_string($_POST['ALT_NAME2'])));
	}else{
		$ALT_NAME2 = "";
	}

	
	if(isset($_POST['Process_Status']) && $_POST['Process_Status'] == 'Change_Status_Only'){////====NEW UPDATE(THIS CANT BE DONE HERE ANYMORE)
		//only update the product status in the merchant list to "IN_SC"
		if(isset($_POST['MerchantProductID'])){
			if(empty($MODEL_NUMBER)){
			$productID = $conn->real_escape_string($_POST['MerchantProductID']);
			$Update_Merchant_sql = 'UPDATE `products` SET category = '.$Category.', reviewed_by = '.$user_id.', sc_status = "IN_SC" WHERE product_ID ="'.$productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}else{
			$productID = $conn->real_escape_string($_POST['MerchantProductID']);
			$Update_Merchant_sql = 'UPDATE `products` SET category = '.$Category.', model_number = "'.$MODEL_NUMBER.'", reviewed_by = '.$user_id.', sc_status = "IN_SC" WHERE product_ID ="'.$productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}
		}
		if(isset($_POST['RetailerProductID'])){
			if(empty($MODEL_NUMBER)){
			$Merchant_productID = $conn->real_escape_string($_POST['RetailerProductID']);
			$Update_Merchant_sql = 'UPDATE retailer_products SET  reviewed_by = '.$user_id.', sc_status = "IN_SC", sc_ID = "'.$Product_ID.'" WHERE id ="'.$Merchant_productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}else{
			$Merchant_productID = $conn->real_escape_string($_POST['RetailerProductID']);
			$Update_Merchant_sql = 'UPDATE retailer_products SET  model_nuber = "'.$MODEL_NUMBER.'", reviewed_by = '.$user_id.', sc_status = "IN_SC", sc_ID = "'.$Product_ID.'" WHERE id ="'.$Merchant_productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}
		}

		
		
		
		if(isset($_POST['MerchantProductID'])){
			header('Location: ../crawled_list.php?'.$_SESSION["Category_Status"].'=&ups=1&Category='.$_SESSION["Category"].'&Cat_level='.$_SESSION["Cat_level"]);
		}
		if(isset($_POST['RetailerProductID'])){
			header('Location: ../retailer_product_list.php?Off_Re=&ups=1&Category='.$_SESSION["Category"].'&Cat_level='.$_SESSION["Cat_level"]);
		}



		}else{


		$ProductInfo_sql = "INSERT INTO `sc` (`modal_number`, `product_name`, `alt_name1`, `alt_name2`, `category_ID`, `reviewed_by`) VALUES
		('".$MODEL_NUMBER."', '".$STANDARD_NAME."', '".$ALT_NAME1."', '".$ALT_NAME2."', ".$Category.", ".$user_id.");";
		//$ProductInfo_result = $conn->query($ProductInfo_sql);
		
		if ($conn_sc->query($ProductInfo_sql) === TRUE) {
    //echo "New record created successfully";

    $Product_ID = $conn_sc->insert_id;
		$Product_ID = $conn_sc->real_escape_string($Product_ID);

} else {
    echo "Error: " . $ProductInfo_sql . "<br>" . $conn_sc->error;


}
		
		
		//====================================PREPARE ITEM SPECKS=========================//
		if(isset($_POST['ItemSpecs'])){
			$ITEM_SPECKS = $_POST['ItemSpecs'];
			foreach ($ITEM_SPECKS as $key=>$value) {
				$Prep_Value = '';
				if(is_array($value)){
					//value is an array so split the value and insert as a multiple type	
					$JointSelections = implode("|",$value);

					//Split the name(key) to get the details code and the details value
					$DetailsCodeAndValue = explode("|",$key);

					//Prepare the values for mysql
					$Prep_Value = $conn_sc->real_escape_string($JointSelections);
					$key = $conn_sc->real_escape_string($DetailsCodeAndValue[0]);
					$code = $conn_sc->real_escape_string($DetailsCodeAndValue[1]);
					
					$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
					('".$code."', '".$Prep_Value."', '".$key."', 'Standard', ".$Product_ID.", 'Multiple', 'COMPULSORY')";
					//$ItemSpecs_result = $conn->query($ItemSpecs_sql);
					if ($conn_sc->query($ItemSpecs_sql) === TRUE) {
	    				//echo "New record created successfully";
					} else {
	   					 echo "Error: " . $ItemSpecs_sql . "<br>" . $conn_sc->error;
					}
					
					}else{
					//Split the name(key) to get the details code and the details value
					$DetailsCodeAndValue = explode("|",$key);

					//value is not an array so do direct insert
					$Prep_Value = $conn_sc->real_escape_string($value);
					$key = $conn_sc->real_escape_string($DetailsCodeAndValue[0]);
					$code = $conn_sc->real_escape_string($DetailsCodeAndValue[1]);

					$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
					('".$code."', '".$Prep_Value."', '".$key."', 'Standard', ".$Product_ID.", 'Fixed', 'COMPULSORY')";
					//$ItemSpecs_result = $conn->query($ItemSpecs_sql);
					if ($conn_sc->query($ItemSpecs_sql) === TRUE) {
	    				//echo "New record created successfully";
					} else {
	   					 echo "Error: " . $ItemSpecs_sql . "<br>" . $conn_sc->error;
					}
				}
			}
		}
		
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
		if(isset($_POST['Add_Crawed_Image'])){
			$Merchant_productID = $conn->real_escape_string($_POST['MerchantProductID']);
			$MImage_sql = "SELECT * from crawled_images where product_ID=".$Merchant_productID." Limit 1";
			$MImage_result = $conn->query($MImage_sql);
			if ($MImage_result->num_rows > 0) {
				while($MImage_row = $MImage_result->fetch_assoc()) {
					
					$ItemImage_sql1 = "INSERT INTO `sc_images` (`image`, `imageType`, `product_ID`) VALUES
					('".$MImage_row['image']."', 'None', '".$Product_ID."')";
					$ItemImage_result1 = $conn_sc->query($ItemImage_sql1);
					
				}
			}	
			
		}

		if(isset($_POST['Add_Retailer_Image'])){
			$Merchant_productID = $conn->real_escape_string($_POST['RetailerProductID']);
			$MImage_sql = "SELECT * from retailer_product_images where retailer_product_id=".$Merchant_productID." Limit 1";
			$MImage_result = $conn->query($MImage_sql);
			if ($MImage_result->num_rows > 0) {
				while($MImage_row = $MImage_result->fetch_assoc()) {
					
					$ItemImage_sql1 = "INSERT INTO `sc_images` (`image`, `imageType`, `product_ID`) VALUES
					('".$MImage_row['image']."', 'None', '".$Product_ID."')";
					$ItemImage_result1 = $conn_sc->query($ItemImage_sql1);
					
				}
			}	
			
		}


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
					if( isset($file['tmp_name']) && !empty($file['tmp_name']) ){
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
		}
		
		//get the current user from the session variable set at login
		$user_id = 0;
		if(isset($_SESSION['user_id'])){$user_id = $conn_sc->real_escape_string($_SESSION['user_id']);}
		
		//only update the product status in the merchant list to "IN_SC"
		//find the product in the sc and copy its posted timestamp
		$reselected_product_sql = "SELECT * FROM sc WHERE sc_ID = '".$Product_ID."'";
		$reselected_product_result = $conn_sc->query($reselected_product_sql);
		
		$reselected_product_PostedTimestamp = '';
		if ($reselected_product_result->num_rows > 0) {
			while($reselected_product_row = $reselected_product_result->fetch_assoc()) {
				$reselected_product_PostedTimestamp = $reselected_product_row['posted_timestamp'];
                $reselected_product_Name = $reselected_product_row['product_name'];
                $reselected_product_Category = $reselected_product_row['category_ID'];
                $reselected_product_Model_Number = $reselected_product_row['modal_number'];
				
			}
		}
		
		if(isset($_POST['MerchantProductID'])){
			if(empty($MODEL_NUMBER)){
			$Merchant_productID = $conn->real_escape_string($_POST['MerchantProductID']);
			$Update_Merchant_sql = 'UPDATE products SET category = '.$Category.', reviewed_by = '.$user_id.', sc_status = "IN_SC", sc_ID = "'.$Product_ID.'", review_timestamp = "'.$reselected_product_PostedTimestamp.'" WHERE product_ID ="'.$Merchant_productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}else{
			$Merchant_productID = $conn->real_escape_string($_POST['MerchantProductID']);
			$Update_Merchant_sql = 'UPDATE products SET category = '.$Category.', model_number = "'.$MODEL_NUMBER.'", reviewed_by = '.$user_id.', sc_status = "IN_SC", sc_ID = "'.$Product_ID.'", review_timestamp = "'.$reselected_product_PostedTimestamp.'" WHERE product_ID ="'.$Merchant_productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}
		}
		if(isset($_POST['RetailerProductID'])){
			if(empty($MODEL_NUMBER)){
			$Merchant_productID = $conn->real_escape_string($_POST['RetailerProductID']);
			$Update_Merchant_sql = 'UPDATE retailer_products SET  reviewed_by = '.$user_id.', sc_status = "IN_SC", sc_ID = "'.$Product_ID.'", review_timestamp = "'.$reselected_product_PostedTimestamp.'" WHERE id ="'.$Merchant_productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}else{
			$Merchant_productID = $conn->real_escape_string($_POST['RetailerProductID']);
			$Update_Merchant_sql = 'UPDATE retailer_products SET  model_nuber = "'.$MODEL_NUMBER.'", reviewed_by = '.$user_id.', sc_status = "IN_SC", sc_ID = "'.$Product_ID.'", review_timestamp = "'.$reselected_product_PostedTimestamp.'" WHERE id ="'.$Merchant_productID.'";';
			$Update_Merchant_result = $conn->query($Update_Merchant_sql);
			}
		}

        $compare_product_check_sql = "SELECT * FROM compare_products WHERE name like '".$reselected_product_Name."' and model_number = '".$reselected_product_Model_Number."' and category='".$reselected_product_Category."' limit 1";
        $compare_product_check_result = $conn->query($compare_product_check_sql);
        if ($compare_product_check_result->num_rows > 0) {
            $compare_product_check_row = $compare_product_check_result->fetch_assoc();

            $compare_product_id = $compare_product_check_row['id'];

            $aggregate_product_sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')); SET group_concat_max_len=40000;
		REPLACE INTO `compare_products`( `id`,`name`, `model_number`, `category`, `price`, `min_price`, `max_price`, `rating`, `retailers`, `image`, `posted_timestamp`, sc_id,merchant_id,product_id,retailer_product_id) 
		select '".$compare_product_id."' as id, sc.product_name as name, modal_number as model_number,
		sc.category_ID as category_id, avg(p.price) as price,min(p.price) min_price, max(p.price) as max_price,0 rating, count(DISTINCT p.merchant_ID)+count(DISTINCT r.id) retailers,
		(select image_id from sc_images i where i.product_ID=sc.sc_ID limit 1 ) as image,max(sc.posted_timestamp) as posted_timestamp, GROUP_CONCAT(DISTINCT sc.sc_ID) as sc_id, GROUP_CONCAT(DISTINCT p.merchant_ID) as merchant_id, GROUP_CONCAT(DISTINCT p.product_ID) as product_id, GROUP_CONCAT(DISTINCT r.id) as retailer_product_id
		FROM sc 
		JOIN (SELECT `product_ID`,`price`,`merchant_ID`,`sc_ID`,`sc_status`,`status` FROM `products` UNION all SELECT null,`price`, null,`sc_ID`,'IN_SC','ACTIVE' FROM `retailer_products` ) p on p.sc_ID= sc.sc_ID and sc.sc_ID is not null
		LEFT JOIN retailer_products r on r.sc_ID= sc.sc_ID and sc.sc_ID is not null
		WHERE p.sc_status = 'IN_SC' and p.status='ACTIVE' and TRIM(sc.product_name)<>''
		and p.price not LIKE '%GHS%' and IsNumeric(p.price)=1 and sc.product_name like '".$reselected_product_Name."' and sc.category_ID='".$reselected_product_Category."' and  TRIM(sc.modal_number)='".$reselected_product_Model_Number."'
		GROUP BY sc.product_name, sc.modal_number, sc.category_ID;";
            $aggregate_product_result = $conn->multi_query($aggregate_product_sql);
            //if($aggregate_product_result){}else{die($conn->error);}
        }else{

            $aggregate_product_sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')); SET group_concat_max_len=40000;
		INSERT INTO `compare_products`(`name`, `model_number`, `category`, `price`, `min_price`, `max_price`, `rating`, `retailers`, `image`, `posted_timestamp`, sc_id,merchant_id,product_id,retailer_product_id) 
		select sc.product_name as name, modal_number as model_number,
		sc.category_ID as category_id, avg(p.price) as price,min(p.price) min_price, max(p.price) as max_price,0 rating, count(DISTINCT p.merchant_ID)+count(DISTINCT r.id) retailers,
		(select image_id from sc_images i where i.product_ID=sc.sc_ID limit 1 ) as image,max(sc.posted_timestamp) as posted_timestamp, GROUP_CONCAT(DISTINCT sc.sc_ID) as sc_id, GROUP_CONCAT(DISTINCT p.merchant_ID) as merchant_id, GROUP_CONCAT(DISTINCT p.product_ID) as product_id, GROUP_CONCAT(DISTINCT r.id) as retailer_product_id
		FROM sc 
		JOIN (SELECT `product_ID`,`price`,`merchant_ID`,`sc_ID`,`sc_status`,`status` FROM `products` UNION all SELECT null,`price`, null,`sc_ID`,'IN_SC','ACTIVE' FROM `retailer_products` ) p on p.sc_ID= sc.sc_ID and sc.sc_ID is not null
		LEFT JOIN retailer_products r on r.sc_ID= sc.sc_ID and sc.sc_ID is not null
		WHERE p.sc_status = 'IN_SC' and p.status='ACTIVE' and TRIM(sc.product_name)<>''
		and p.price not LIKE '%GHS%' and IsNumeric(p.price)=1 and sc.product_name like '".$reselected_product_Name."' and sc.category_ID='".$reselected_product_Category."' and  TRIM(sc.modal_number)='".$reselected_product_Model_Number."'
		GROUP BY sc.product_name, sc.modal_number, sc.category_ID;";
            $aggregate_product_result = $conn->multi_query($aggregate_product_sql);
            //if($aggregate_product_result){}else{die($conn->error);}
        }

		
		
		if(isset($_POST['MerchantProductID'])){
			header('Location: ../crawled_list.php?'.$_SESSION["Category_Status"].'=&Category='.$_SESSION["Category"].'&Cat_level='.$_SESSION["Cat_level"]);
		}
		if(isset($_POST['RetailerProductID'])){
			header('Location: ../retailer_product_list.php?Off_Re=&Category='.$_SESSION["Category"].'&Cat_level='.$_SESSION["Cat_level"]);
		}

	}
	
	include('../connections/db_close_connect.php');//close the connection to the database
	include('../connections/db_close_connect_sc.php');//close the connection to the database
?>