<?php
if (!isset($_SESSION)) {
	session_start();
}

require_once('../connections/db_connect.php');//connect to the database


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

if(isset($_POST['BuyingGuide'])){

	//Collect the Number og guide rows. -1 is because the loop will start from index 0
	$Guide_Rows = count($_POST['BuyingGuide']['Heading'])-1;

	for ($x = 0; $x <= $Guide_Rows; $x++) {
		//================================PREPARE DB VALUES=======================================//
		$HeadingTag = $_POST['BuyingGuide']['HeadingTag'][$x];
		switch ($HeadingTag) {
			case '1':
				$Heading = "<h1>".$_POST['BuyingGuide']['Heading'][$x]."</h1>";
				break;
			case '2':
				$Heading = "<h2>".$_POST['BuyingGuide']['Heading'][$x]."</h2>";
				break;
			case '3':
				$Heading = "<h3>".$_POST['BuyingGuide']['Heading'][$x]."</h3>";
				break;
			case '4':
				$Heading = "<h4>".$_POST['BuyingGuide']['Heading'][$x]."</h4>";
				break;
			default:
				$Heading = "<h3>".$_POST['BuyingGuide']['Heading'][$x]."</h3>";
		}
		$Heading = $conn->real_escape_string($Heading);
		$Content = $conn->real_escape_string($_POST['BuyingGuide']['Content'][$x]);
		$image_alt_text = $conn->real_escape_string($_POST['BuyingGuide']['image_alt_text'][$x]);
		//process selected image
		if(!empty($_FILES['BuyingGuideImage']['tmp_name'][$x])){
			$image= addslashes($_FILES['BuyingGuideImage']['tmp_name'][$x]);
			$image= file_get_contents($image);
			$image= base64_encode($image);

			$has_image =1;
		}else{
			//We can set a default Image
			$image= "";
			$has_image =0;
		}

		//Insert The Buying Guide
		$BuyingGuide_sql = "INSERT INTO `buying_guide` (`heading`, `content`, `image`, `image_alt_text`, `has_image`, `category_ID`) VALUES
			('".trim($Heading)."', '".trim($Content)."', '".$image."', '".$image_alt_text."', '".$has_image."', '".trim($Category)."')";
		$BuyingGuide_result = $conn->query($BuyingGuide_sql);

		if ($BuyingGuide_result === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			die();
		}

	}

}

/*
    echo"<pre>";
    print_r($_FILES);
    echo"</pre>";

    echo"<pre>";
    print_r($_POST);
    echo"</pre>";
*/

include('../connections/db_close_connect.php');//close the connection to the database
include('../connections/db_close_connect.php');//close the connection to the database

header('Location: ../standard/add_buying_guide.php?msg=1');
?>