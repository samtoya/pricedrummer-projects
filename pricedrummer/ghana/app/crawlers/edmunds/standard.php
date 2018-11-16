<?php
error_reporting(E_ALL);
ini_set("display_errors", 1); 

include('../connections/db_connect.php');//connect to the database

include('../include/useragents.php');
include('../include/referers.php');
header('Access-Control-Allow-Origin: *');

$Proxy = "212.91.189.166:8000";
// Choose a random user agent
if (isset($user_agent_choices)) {  // If the $user_agent_choices array contains items, then
	// Select a random user agent from the array and assign to $agent variable
	$agent = $user_agent_choices[array_rand($user_agent_choices)];
}

// Choose a random user agent
if (isset($referer_choices)) {  // If the $referer_choices array contains items, then
	// Select a random referer from the array and assign to $referer variable
	$referer = $referer_choices[array_rand($referer_choices)];
}


$API_KEY = "6p7qdbxwvtsvjjusf97hx7yf";
$API_KEY_IMAGE = "ssaruqbt7qm86ehnfn6str2d";
$Make_url = "https://api.edmunds.com/api/vehicle/v2/makes?state=new&fmt=json&api_key=".$API_KEY;
$curl_channel = curl_init();
curl_setopt($curl_channel, CURLOPT_URL, $Make_url);
//curl_setopt($curl_channel, CURLOPT_PROXY, $Proxy);
curl_setopt($curl_channel, CURLOPT_HEADER, FALSE);
curl_setopt($curl_channel, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl_channel, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($curl_channel, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_channel, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($curl_channel, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($curl_channel, CURLOPT_REFERER, $referer);
curl_setopt($curl_channel, CURLOPT_USERAGENT, $agent);

$result['EXE'] = curl_exec($curl_channel);
$result['INF'] = curl_getinfo($curl_channel);
$result['ERR'] = curl_error($curl_channel);

curl_close($curl_channel);
$Make_Details = $result['EXE'];

echo 'ERROR IN CONNECTION'.$result['ERR'];


$CarMakes = json_decode($Make_Details);
echo"<pre>";
print_r($Make_Details);
echo"</pre>";

$CarMakes = $CarMakes->makes;

//Collect the Make and Models
foreach ($CarMakes as $Make_key => $CarMake) {

	$Make_Name = $conn->real_escape_string($CarMake->name);
	$CarModels = $CarMake->models;

	//collect the Models for each Make
	foreach ($CarModels as $Model_key => $CarModel) {
		$Model_Name = $conn->real_escape_string($CarModel->name);
		$CarYears = $CarModel->years;

		//Collect the differnt Years For each model 
		foreach ($CarYears as $Year_key => $CarYear) {
			$Year = $conn->real_escape_string($CarYear->year);
			$CarYearID = $CarYear->id;

			echo "<h1>".$Make_Name ." ". $Model_Name ." ". $Year ."</h1>";
			$Car_Name = $Make_Name ." ". $Model_Name ." ". $Year;
			$Category =1059;
			$user_id = 0;

			$ProductInfo_sql = "INSERT INTO `sc` (`modal_number`, `product_name`, `category_ID`, `reviewed_by`) VALUES
			('". $conn->real_escape_string($Model_Name)."', '". $conn->real_escape_string($Car_Name)."', ".$Category.", ".$user_id.");";

			
			$ProductInfo_result = $conn->query($ProductInfo_sql);
			if ($ProductInfo_result === TRUE) {
				echo "Added";
			} else {
				echo "Error: <br>" . $conn->error;
			}

			$Product_ID = $conn->insert_id;
			$Product_ID = $conn->real_escape_string($Product_ID);

			
			$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
			('MAKE', '".$Make_Name."', 'Make', 'Standard', ".$Product_ID.", 'Fixed', 'COMPULSORY')";
			$ItemSpecs_result = $conn->query($ItemSpecs_sql);

			$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
			('MODEL', '".$Model_Name."', 'Model', 'Standard', ".$Product_ID.", 'Fixed', 'COMPULSORY')";
			$ItemSpecs_result = $conn->query($ItemSpecs_sql);

			$ItemSpecs_sql = "INSERT INTO `sc_details` (`details_code`, `details_value`, `detail_name`, `category_section`, `product_ID`, `type`,`info_type`) VALUES
			('YEAR', '".$Year."', 'Year', 'Standard', ".$Product_ID.", 'Fixed', 'COMPULSORY')";
			$ItemSpecs_result = $conn->query($ItemSpecs_sql);

			
/*
			//INSERT INTO THE DB
			$sql = sprintf("INSERT INTO products (product_name, url, price, merchant_ID, category, status, sc_status, model_number, Image_url, 	Description) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
				mysqli_real_escape_string($conn,$Car_Name),
				mysqli_real_escape_string($conn,"none"),
				mysqli_real_escape_string($conn,"none"),
				mysqli_real_escape_string($conn,"82"),
				mysqli_real_escape_string($conn,"1056"),
				mysqli_real_escape_string($conn,'ACTIVE'),
				mysqli_real_escape_string($conn,"ACCEPTED"), 
				mysqli_real_escape_string($conn,$StyleID),
				mysqli_real_escape_string($conn,"none"),
				mysqli_real_escape_string($conn,$CarSpecs));

			if ($conn->query($sql) === TRUE) {
							//IF PRODUCT IS INSERTED AND CRAW IMAGE IS SET TO YES FOR THE CATEGORY, THEN DOWNLOAD IMAGES TO THE DB
				$Product_ID = mysqli_real_escape_string($conn,$conn->insert_id);

				echo"<h1>ADDED</h1>";
							//CHECK IF CRAWL IMAGE WAS SET ON
					/*
					if(strtolower(trim($crawl_image)) == strtolower(trim("YES"))){
						$Image_sql = "INSERT INTO `crawled_images` (`image`, `product_ID`) VALUES ('".$imageData."', '".$Product_ID."');";
						if ($conn->query($Image_sql) === TRUE) {
							echo "image Added";
						} else {
							echo "Error: " . $Image_sql . "<br>" . $conn->error;
						}
					}
					
				} else {

					echo"<h1>NOT ADDED</h1>";
							//DISPLAY ERROR MESSAGE IF PROCESS FAILS
					echo "Error: " .  "<br>" . $conn->error;
				}
*/
				echo"</pre><hr/>";
			}
			
		}
		
	}



include('../connections/db_close_connect.php');//close the connection to the database

?>
