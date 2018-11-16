<?php
include('../connections/db_connect.php');//connect to the database

include('../include/useragents.php');
include('../include/referers.php');
header('Access-Control-Allow-Origin: *');

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
$Make_Details = file_get_contents($Make_url);

$CarMakes = json_decode($Make_Details);
echo"<pre>";
//print_r($CarMakes->makes);
echo"</pre>";

$CarMakes = $CarMakes->makes;

//Collect the Make and Models
foreach ($CarMakes as $Make_key => $CarMake) {

	$Make_Name = $CarMake->name;
	$CarModels = $CarMake->models;

	//collect the Models for each Make
	foreach ($CarModels as $Model_key => $CarModel) {
		$Model_Name = $CarModel->name;
		$CarYears = $CarModel->years;

		//Collect the differnt Years For each model 
		foreach ($CarYears as $Year_key => $CarYear) {
			$Year = $CarYear->year;
			$CarYearID = $CarYear->id;

			

			//Get  Detais for each car MAKE-MODEL-YEAR
			$Transmission_url= "https://api.edmunds.com/api/vehicle/v2/".$Make_Name."/".$Model_Name."/".$Year."/styles?fmt=json&api_key=".$API_KEY."&view=full";
			
			
			$curl_channel = curl_init();
			curl_setopt($curl_channel, CURLOPT_URL, $Transmission_url);
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

			$Transmissions_Details = $result['EXE'];
			$CarTransmissions = json_decode($Transmissions_Details);
			//echo"<hr/><pre>";
			//print_r($CarTransmissions->styles);
			//echo"</pre><hr/>";

			$CarTransmissionsStyles = $CarTransmissions->styles;

			foreach ($CarTransmissionsStyles as $Transmissions_key => $CarTransmissionsStyle) {
				$Engine_Specs = $CarTransmissionsStyle->engine;
				echo $StyleID = $CarTransmissionsStyle->id;
				
				
				echo "<h1>".$Make_Name ." ". $Model_Name ." ". $Year ."</h1>";
				$Car_Name = $Make_Name ." ". $Model_Name ." ". $Year;

				$CarSpecs = "";
				echo"<hr/><pre>";
				echo "<b>Engine===</b><br/>"; //======================================Engin Specs======================
				$CarSpecs = $CarSpecs . "<b>Engine===</b><br/>"; 
				foreach ($Engine_Specs as $Engine_Spec_key => $Engine_Spec) {

					if (!is_object($Engine_Spec)) { //if the value is not an object
						echo $Engine_Spec_key ." : " .$Engine_Spec . "<br/>";
						$CarSpecs = $CarSpecs . $Engine_Spec_key ." : " .$Engine_Spec . "<br/>";
					}else{

						foreach ($Engine_Spec as $Engine_Sub_Spec_key => $Engine_Sub_Spec) {
							echo $Engine_Spec_key."-".$Engine_Sub_Spec_key  ." : " .$Engine_Sub_Spec . "<br/>";
							$CarSpecs = $CarSpecs . $Engine_Spec_key."-".$Engine_Sub_Spec_key  ." : " .$Engine_Sub_Spec . "<br/>";
						}
					}
					

				}


				echo "<br/><br/>";
				$CarSpecs = $CarSpecs . "<br/><br/>";

				//======================================Transmission Specs======================
				$Transmission_Specs = $CarTransmissionsStyle->transmission;

				echo "<b>Transmission===</b><br/>"; 
				$CarSpecs = $CarSpecs . "<b>Transmission===</b><br/>"; 
				foreach ($Transmission_Specs as $Transmission_Spec_key => $Transmission_Spec) {

					if (!is_object($Transmission_Spec)) { //if the value is not an object
						echo $Transmission_Spec_key ." : " .$Transmission_Spec . "<br/>";
						$CarSpecs = $CarSpecs . $Transmission_Spec_key ." : " .$Transmission_Spec . "<br/>";
					}else{

						foreach ($Transmission_Spec as $Transmission_Sub_Spec_key => $Transmission_Sub_Spec) {
							echo $Transmission_Spec_key."-".$Transmission_Sub_Spec_key  ." : " .$Transmission_Sub_Spec . "<br/>";
							$CarSpecs = $CarSpecs . $Transmission_Spec_key."-".$Transmission_Sub_Spec_key  ." : " .$Transmission_Sub_Spec . "<br/>";
						}
					}
					

				}


				echo "<br/><br/>";
				$CarSpecs = $CarSpecs . "<br/><br/>";


				//======================================MPG Specs======================
				$MPG_Specs = $CarTransmissionsStyle->MPG;

				echo "<b>MPG===</b><br/>"; 
				$CarSpecs = $CarSpecs . "<b>MPG===</b><br/>"; 
				foreach ($MPG_Specs as $MPG_Spec_key => $MPG_Spec) {

					if (!is_object($MPG_Spec)) { //if the value is not an object
						echo $MPG_Spec_key ." : " .$MPG_Spec . "<br/>";
						$CarSpecs = $CarSpecs . $MPG_Spec_key ." : " .$MPG_Spec . "<br/>";
					}
					

				}


				echo "<br/><br/>";
				$CarSpecs = $CarSpecs . "<br/><br/>";

				echo "<b>DrivenWheels===</b><br/>";
				$CarSpecs = $CarSpecs . "<b>DrivenWheels===</b><br/>";
				echo "drivenWheels" ." : " .$CarTransmissionsStyle->drivenWheels . "<br/>";
				$CarSpecs = $CarSpecs . "drivenWheels" ." : " .$CarTransmissionsStyle->drivenWheels . "<br/>";

				echo "<br/><br/>";
				$CarSpecs = $CarSpecs . "<br/><br/>";

				echo "<b>Doors===</b><br/>";
				$CarSpecs = $CarSpecs . "<b>Doors===</b><br/>";
				echo "numOfDoors" ." : " .$CarTransmissionsStyle->numOfDoors . "<br/>";
				$CarSpecs = $CarSpecs . "numOfDoors" ." : " .$CarTransmissionsStyle->numOfDoors . "<br/>";

				echo "<br/><br/>";
				$CarSpecs = $CarSpecs . "<br/><br/>";

				echo "<b>SquishVins===</b><br/>";
				$CarSpecs = $CarSpecs . "<b>SquishVins===</b><br/>";
				echo "squishVins" ." : " .$CarTransmissionsStyle->squishVins[0] . "<br/>";
				$CarSpecs = $CarSpecs . "squishVins" ." : " .$CarTransmissionsStyle->squishVins[0] . "<br/>";

				echo "<br/><br/>";
				$CarSpecs = $CarSpecs . "<br/><br/>";



				//======================================Colors Specs======================

				$Color_Specs = $CarTransmissionsStyle->colors[1]->options;
				$Colors = "";
				echo "<b>Colors===</b><br/>";
				$CarSpecs = $CarSpecs . "<b>Colors===</b><br/>";
				foreach ($Color_Specs as $Color_Specs_key => $Color_Spec) {
					$Colors = $Colors.$Color_Spec->name.",";
				}
				echo "Colors"." : ". $Colors;
				$CarSpecs = $CarSpecs . "Colors"." : ". $Colors;

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
					*/
				} else {

					echo"<h1>NOT ADDED</h1>";
							//DISPLAY ERROR MESSAGE IF PROCESS FAILS
					echo "Error: " .  "<br>" . $conn->error;
				}



				/*

				//Get  IMAGES for each car MAKE-MODEL-YEAR
				$Images_url= "https://api.edmunds.com/api/media/v2/styles/".$StyleID."/photos?fmt=json&api_key=".$API_KEY_IMAGE."&category=exterior&view=full";


				$curl_channel = curl_init();
				curl_setopt($curl_channel, CURLOPT_URL, $Images_url);
				curl_setopt($curl_channel, CURLOPT_HEADER, FALSE);
				curl_setopt($curl_channel, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($curl_channel, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($curl_channel, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl_channel, CURLOPT_HTTPPROXYTUNNEL, 1);
				curl_setopt($curl_channel, CURLOPT_CONNECTTIMEOUT, 0);
				curl_setopt($curl_channel, CURLOPT_REFERER, $referer);
				curl_setopt($curl_channel, CURLOPT_USERAGENT, $agent);

				$Images_result['EXE'] = curl_exec($curl_channel);
				$Images_result['INF'] = curl_getinfo($curl_channel);
				$Images_result['ERR'] = curl_error($curl_channel);

				$Images_Details = $Images_result['EXE'];
				$CarImages = json_decode($Images_Details);

				echo"<hr/><pre>";
				print_r($CarImages);
				echo"</pre><hr/>";

				*/
				echo"</pre><hr/>";
			}
			
		}
		
	}

}


	include('../connections/db_close_connect.php');//close the connection to the database
	?>
