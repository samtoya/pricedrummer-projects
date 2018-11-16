<?php
	include('../connections/db_connect.php');//connect to the database

	echo"<pre>";
	print_r($_POST);
	print_r($_FILES);
	//die();
	$defaultIgnore = $conn->real_escape_string("***");
	$retailer_Id = $conn->real_escape_string($_POST['retailer_id']);
	$category_id = $conn->real_escape_string($_POST['Current_category_id']);
	$category_drill = urlencode($conn->real_escape_string($_POST['category_drill']));
	$sku = $conn->real_escape_string($_POST['sku']);
	$manufacturer = $conn->real_escape_string($_POST['manufacturer']);
	$model_name = $conn->real_escape_string($_POST['model_name']);
	$description = $conn->real_escape_string($_POST['description']);
	$image_url = $conn->real_escape_string($_POST['image_url']);
	$price = $conn->real_escape_string(round($_POST['price'], 2));
	$availability = $conn->real_escape_string($_POST['availability']);
	$delivery_time = $conn->real_escape_string($_POST['delivery_time']);
	$delivery_cost = $conn->real_escape_string(round($_POST['delivery_cost'], 2));
	//ignore *** value
	if(trim($sku) == $defaultIgnore){$sku ="";}
	if(trim($manufacturer) == $defaultIgnore){$manufacturer ="";}
	if(trim($model_name) == $defaultIgnore){$model_name ="";}
	if(trim($delivery_cost) == $defaultIgnore || trim($delivery_cost) == ""){$delivery_cost ="0";}
	if(trim($price) == $defaultIgnore || trim($price) == ""){$price ="0";}
	if(trim($delivery_time)!==""){
		$has_delivery = 1;
	}else{
		$has_delivery = 0;
	}
	$location_success = "../public/list_product.php?cid=".$category_id."&msg=good&cdrill=".$category_drill;

	$add_product_sql = "INSERT INTO `retailer_products` (`retailer_id`, `price`, `manufacturer`, `model_nuber`, `category`, `graphical_url`, `manufacturer_sku`, `has_delevery`, `availability`, `delevery_details`, `delivery_cost`, `description`)VALUES 
	(".$retailer_Id.", '".$price."', '".$manufacturer."', '".$model_name."', '".$category_id."', '".$image_url."', '".$sku."', '".$has_delivery."', '".$availability."', '".$delivery_time."', '".$delivery_cost."', '".$description."')";

	$add_product_result = $conn->query($add_product_sql);


	if ($add_product_result === TRUE) {
		$Retailer_product_id = $conn->insert_id;


//=============IMAGES=========================
	//First Image
	$Image_1_name = $_FILES['main_image']['name'];
	$Image_1_type = $_FILES['main_image']['type'];
	$Image_1_extension = strtolower(substr($Image_1_name, strpos($Image_1_name, '.') + 1));
	$Image_1_size = $_FILES['main_image']['size'];

	if((!empty($Image_1_name) && empty($image_url)) || (!empty($Image_1_name) && !empty($image_url))){
		//die('Img Upl');
		if(($Image_1_extension == 'jpg' || $Image_1_extension == 'jpeg' || $Image_1_extension == 'png') && ($Image_1_type == 'image/jpeg' || $Image_1_type == 'image/png')){
			
		// Image submitted by form. Open it
			$image= addslashes($_FILES['main_image']['tmp_name']);
			$content = file_get_contents($image);
			$content = base64_encode($content);
			$name= $conn->real_escape_string($Image_1_name);
			$product_image_sql = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (".$Retailer_product_id.", '".$content."')";
			$product_image_result = $conn->query($product_image_sql);
			
		}else{
			die('File must be jpg/jpeg/png and must be 1mb or less! ');
		}
	}elseif (!empty($image_url)) {
		$data = file_get_contents($image_url);
		$content = base64_encode($data);
		$product_image_sql = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (".$Retailer_product_id.", '".$content."')";
		$product_image_result = $conn->query($product_image_sql);
		
	}

	//Other Images
	$other_image1_name = $_FILES['other_image1']['name'];
	$other_image1_type = $_FILES['other_image1']['type'];
	$other_image1_extension = strtolower(substr($other_image1_name, strpos($other_image1_name, '.') + 1));
	$other_image1_size = $_FILES['other_image1']['size'];

	if(!empty($other_image1_name)){
		if(($other_image1_extension == 'jpg' || $other_image1_extension == 'jpeg' || $other_image1_extension == 'png') && ($other_image1_type == 'image/jpeg' || $other_image1_type == 'image/png')){
			$other_image1_image= addslashes($_FILES['other_image1']['tmp_name']);
			$other_image1_content = file_get_contents($other_image1_image);
			$other_image1_content = base64_encode($other_image1_content);
			$other_image1_name= $conn->real_escape_string($other_image1_name);

			$other_image1_sql = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (".$Retailer_product_id.", '".$other_image1_content."')";
			$other_image1_result = $conn->query($other_image1_sql);
			
		}else{
			die('File must be jpg/jpeg/png and must be 1mb or less! ');
		}
	}

	$other_image2_name = $_FILES['other_image2']['name'];
	$other_image2_type = $_FILES['other_image2']['type'];
	$other_image2_extension = strtolower(substr($other_image2_name, strpos($other_image2_name, '.') + 1));
	$other_image2_size = $_FILES['other_image2']['size'];

	if(!empty($other_image2_name)){
		if(($other_image2_extension == 'jpg' || $other_image2_extension == 'jpeg' || $other_image2_extension == 'png') && ($other_image2_type == 'image/jpeg' || $other_image2_type == 'image/png')){
			$other_image2_image= addslashes($_FILES['other_image2']['tmp_name']);
			$other_image2_content = file_get_contents($other_image2_image);
			$other_image2_content = base64_encode($other_image2_content);
			$other_image2_name= $conn->real_escape_string($other_image2_name);

			$other_image2_sql = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (".$Retailer_product_id.", '".$other_image2_content."')";
			$other_image2_result = $conn->query($other_image2_sql);
			
		}else{
			die('File must be jpg/jpeg/png and must be 1mb or less! ');
		}
	}

	$other_image3_name = $_FILES['other_image3']['name'];
	$other_image3_type = $_FILES['other_image3']['type'];
	$other_image3_extension = strtolower(substr($other_image3_name, strpos($other_image3_name, '.') + 1));
	$other_image3_size = $_FILES['other_image3']['size'];

	if(!empty($other_image3_name)){
		if(($other_image3_extension == 'jpg' || $other_image3_extension == 'jpeg' || $other_image3_extension == 'png') && ($other_image3_type == 'image/jpeg' || $other_image3_type == 'image/png')){
			$other_image3_image= addslashes($_FILES['other_image3']['tmp_name']);
			$other_image3_content = file_get_contents($other_image3_image);
			$other_image3_content = base64_encode($other_image3_content);
			$other_image3_name= $conn->real_escape_string($other_image3_name);

			$other_image3_sql = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (".$Retailer_product_id.", '".$other_image3_content."')";
			$other_image3_result = $conn->query($other_image3_sql);
			
		}else{
			die('File must be jpg/jpeg/png and must be 1mb or less! ');
		}
	}
		//=============END OF IMAGES==================


	header("Location: ".$location_success);

	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}




?>