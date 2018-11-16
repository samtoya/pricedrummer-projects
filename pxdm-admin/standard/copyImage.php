<?php
	//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
	include('../include/check_user_login.php');//check if user is logged in
	
	require_once('../connections/db_connect.php');//connect to the database
	
	//Collect the unprocessed images from the db
	$Product_Images_sql = 'SELECT * FROM `sc_images` where InFileSystem = 0';
	$Product_Images_result = $conn->query($Product_Images_sql);
	
	
	if ($Product_Images_result->num_rows > 0) {
		while($Product_Images_row = $Product_Images_result->fetch_assoc()) {
		
			//Prepare Image and path details
			$image = $Product_Images_row['image'];
			$name = $Product_Images_row['image_ID'].'.png';
			// $path = "img";
			$path = "../../pricedrummer-api/static/product_images";
			
			//Process The Image to the File System
			$file = fopen($path."/".$name,"w");
			echo "File name: ".$path."$name\n";
			fwrite($file, base64_decode($image));
			fclose($file);
			
			echo"<br/>";
			
			//Update Image status in the db
			$Product_Images_Update_sql = ' UPDATE `sc_images` SET InFileSystem = 1 where image_ID ='.$Product_Images_row['image_ID'];
			$Product_Images_Update_result = $conn->query($Product_Images_Update_sql);
		}
		
		} else {
		//No Image Found
		echo "No Image Found.";
	}
	
	//close the connection
	include('../connections/db_close_connect.php');//close the connection to the database	
?>																																
