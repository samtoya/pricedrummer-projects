	<?php
include('../connections/db_connect.php');//connect to the database

    //Function to get the max value of an assoc array by providing the array and the key for which it should find the max
    function maxValueInArray($array, $keyToSearch){
        $currentMax = NULL;
        $currentMaxArray = NULL;
        foreach($array as $arr)
        {
            foreach($arr as $key => $value)
            {
                if ($key == $keyToSearch && ($value >= $currentMax))
                {
                    $currentMax = $value;
                    $currentMaxArray = $arr;
                }
            }
        }

//    return $currentMax;
        return $currentMaxArray;
    }
    function find_match($product_name){
        global $conn;

        //Try to find a match from the sc products
        $sc_products_sql = 'SELECT * FROM `sc` ';
        $sc_products_result = $conn->query($sc_products_sql);

        $sc_product_array = [];
        if ($sc_products_result->num_rows > 0) {
            while($row = $sc_products_result->fetch_assoc()) {
                $sc_product_array[$row['sc_ID']] = $row['product_name'];
            }
        }

        //product name string from the retailer
        $retailer_product_name = trim(strtolower($product_name));

        $similar_list=[];

        foreach ($sc_product_array as $id => $pname){
            $sc_str = trim(strtolower($pname));
            $sc_str_list = explode(" ",$sc_str);
            $ret_str_list = [];
            $ret_str_list_raw = explode(" ",$retailer_product_name);
            foreach ($ret_str_list_raw as $ret_pword){
                $clean_ret_pword = str_replace( "[","",
                    str_replace( "]","",
                        str_replace( ".","",
                            str_replace( ",","", $ret_pword))));
                $ret_str_list[] = $clean_ret_pword;
            }

            $common_elements = array_intersect( $sc_str_list , $ret_str_list );

            if(count($common_elements) > 1){
                $similar_count = count($common_elements) ;
                $similar_list[] = array('count' => $similar_count, 'name' => $pname, 'sc_id' => $id);
            }

        }

        if(count($similar_list) >0){
            //matched found
            $value = maxValueInArray($similar_list, "count");  //   array       key
            return $value;
        }else{
            //No Match found
            return null;
        }

    }

if(isset($_POST["Import"])){
	$header = 0;
	$retailer_Id = trim($conn->real_escape_string($_POST["retailer_Id"]));
	$filename=$_FILES["file"]["tmp_name"];

	if($_FILES["file"]["size"] > 0)
	{
	
		$file = fopen($filename, "r");
		while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
			$name 			= trim($conn->real_escape_string($emapData[0]));
			$model_nuber	= trim($conn->real_escape_string($emapData[1]));
			$manufacturer	= trim($conn->real_escape_string($emapData[2]));
			$price			= trim($conn->real_escape_string($emapData[3]));
			$description	= trim($conn->real_escape_string($emapData[4]));
			$sc_status		= "NEW";
			$availability	= "1";
            $sc_ID = 'NULL';
            $category = '-1';

			//Skip the first header row
			if($header==0){ 	$header++; continue;	}

			//Check if row is empty then skip the particular row
			if($name=="" and $model_nuber=="" and $manufacturer=="" and $price==""){
				continue;
			}
            $retailer_product_name = $name . " " . $model_nuber;
            //call the match function on the product name
            $sc_match =  find_match($retailer_product_name);
            if(!empty($sc_match)){
                //set the sc_id if there was a match found
                $sc_ID =  $sc_match['sc_id'];
                $sc_status		= "IN_SC";

                $sc_products_sql_1 = 'SELECT * FROM `sc` where sc_ID = '.$sc_ID;
                $sc_products_result_1 = $conn->query($sc_products_sql_1);

                if ($sc_products_result_1->num_rows > 0) {
                    while($row = $sc_products_result_1->fetch_assoc()) {
                        $category  = $row['category_ID'];
                    }
                }else{
                    $category = '-1';
                }
            }
            if(empty($sc_ID)){
                $sc_ID = 'NULL';
            }

			$add_product_sql = "INSERT INTO `retailer_products` (`retailer_id`, `name`, `model_nuber`, `manufacturer`, `price`, `category`, `availability`, `description`, `sc_ID`, `sc_status`)VALUES 
			(".$retailer_Id.", '".$name."', '".$model_nuber."', '".$manufacturer."', '".$price."', '".$category."',  '".$availability."',  '".$description."',  ".$sc_ID.", '".$sc_status."')";

			$add_product_result = $conn->query($add_product_sql);

			if ($add_product_result === TRUE) {
				header("location: index.php?u=s");
			}else{
				echo "Error: " . $conn->error;
				header("location: index.php?u=f");
			}
			
		}
		fclose($file);

	}
}
?>