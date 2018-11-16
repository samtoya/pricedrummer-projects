<?php
    include( '../connections/db_connect.php' );//connect to the database

    echo "<pre>";
//    print_r( $_POST );
//    print_r( $_FILES );
//	die();
    $defaultIgnore  = "***";
    $retailer_Id    = $conn->real_escape_string( $_POST[ 'retailer_id' ] );
    $product_name   = $conn->real_escape_string( $_POST[ 'product_name' ] );
    $category_id    = $conn->real_escape_string( $_POST[ 'Current_category_id' ] );
    $category_drill = urlencode( $conn->real_escape_string( $_POST[ 'category_drill' ] ) );
    //$sku = $conn->real_escape_string($_POST['sku']);
    $sku           = "***";
    $manufacturer  = $conn->real_escape_string( $_POST[ 'manufacturer' ] );
    $model_name    = $conn->real_escape_string( $_POST[ 'model_name' ] );
    $description   = $conn->real_escape_string( $_POST[ 'description' ] );
    $image_url     = $conn->real_escape_string( $_POST[ 'image_url' ] );
    $price         = $conn->real_escape_string( round( $_POST[ 'price' ], 2 ) );
    $availability  = $conn->real_escape_string( $_POST[ 'availability' ] );
    $delivery_time = $conn->real_escape_string( $_POST[ 'delivery_time' ] );
    $delivery_cost = $conn->real_escape_string( round( $_POST[ 'delivery_cost' ], 2 ) );

    if(empty($availability)){
        $availability = 1;
    }
    //ignore *** value
    //if(trim($sku) == $defaultIgnore){$sku ="";}
    if ( trim( $manufacturer ) == $defaultIgnore ) {
        $manufacturer = "";
    }
    if ( trim( $model_name ) == $defaultIgnore ) {
        $model_name = "";
    }
    if ( trim( $delivery_cost ) == $defaultIgnore || trim( $delivery_cost ) == "" ) {
        $delivery_cost = "0";
    }
    if ( trim( $price ) == $defaultIgnore || trim( $price ) == "" ) {
        $price = "0";
    }
    if ( trim( $delivery_time ) !== "" ) {
        $has_delivery = 1;
    } else {
        $has_delivery = 0;
    }
    $location_success = "../list_product.php?cid=" . $category_id . "&msg=good&cdrill=" . $category_drill;

    $sc_ID = 'NULL';
    $retailer_product_name = $product_name. ' ' . $model_name;



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
    global $category_id;

    //Try to find a match from the sc products
    $sc_products_sql = 'SELECT * FROM `sc` where `category_ID`='.$category_id;
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

if(!empty($model_name)){  // if there is a model number provided, then check if there is a model number like that in the sc
    //Try to find a match from the sc products
    $sc_products_sql = 'SELECT * FROM `sc` where `category_ID`='.$category_id . ' and `modal_number` LIKE "'.$model_name.'" limit 1';
    $sc_products_result = $conn->query($sc_products_sql);

    $sc_product_array = [];
    if ($sc_products_result->num_rows > 0) {        //found a product in the sc with the specified model number
        while($row = $sc_products_result->fetch_assoc()) {
            $sc_ID = $row['sc_ID'];
        }

    }else{     //did not find a product in the sc with the specified model number

        //call the match function on the product name
        $sc_match =  find_match($retailer_product_name);
        if(!empty($sc_match)){
            //set the sc_id if there was a match found
            $sc_ID =  $sc_match['sc_id'];
        }
    }


}else{ //there was no model number like that in our sc. check for matches on the product name + model number

    $sc_match =  find_match($retailer_product_name);
    if(!empty($sc_match)){
        //set the sc_id if there was a match found
        $sc_ID =  $sc_match['sc_id'];
    }
}

if(empty($sc_ID)){
    $sc_ID = 'NULL';
}



    $add_product_sql = "INSERT INTO `retailer_products` (`retailer_id`, `name`, `price`, `manufacturer`, `model_nuber`, `category`, `graphical_url`, `manufacturer_sku`, `has_delevery`, `availability`, `delevery_details`, `sc_ID`, `delivery_cost`, `description`)VALUES 
	(" . $retailer_Id . ", '" . $product_name . "', '" . $price . "', '" . $manufacturer . "', '" . $model_name . "', '" . $category_id . "', '" . $image_url . "', '" . $sku . "', '" . $has_delivery . "', '" . $availability . "', '" . $delivery_time . "', " .  $sc_ID . ", '" . $delivery_cost . "', '" . $description . "')";

    $add_product_result = $conn->query( $add_product_sql );


    if ( $add_product_result === true ) {
        $Retailer_product_id = $conn->insert_id;


//=============IMAGES=========================
        //First Image
        $Image_1_name      = $_FILES[ 'main_image' ][ 'name' ];
        $Image_1_type      = $_FILES[ 'main_image' ][ 'type' ];
        $Image_1_extension = strtolower( substr( $Image_1_name, strpos( $Image_1_name, '.' ) + 1 ) );
        $Image_1_size      = $_FILES[ 'main_image' ][ 'size' ];

        if ( ( ! empty( $Image_1_name ) && empty( $image_url ) ) || ( ! empty( $Image_1_name ) && ! empty( $image_url ) ) ) {
            //die('Img Upl');
            if ( ( $Image_1_extension == 'jpg' || $Image_1_extension == 'jpeg' || $Image_1_extension == 'png' ) && ( $Image_1_type == 'image/jpeg' || $Image_1_type == 'image/png' ) ) {

                // Image submitted by form. Open it
                $image                = addslashes( $_FILES[ 'main_image' ][ 'tmp_name' ] );
                $content              = file_get_contents( $image );
                $content              = base64_encode( $content );
                $name                 = $conn->real_escape_string( $Image_1_name );
                $product_image_sql    = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (" . $Retailer_product_id . ", '" . $content . "')";
                $product_image_result = $conn->query( $product_image_sql );

            } else {
                die( 'File must be jpg/jpeg/png and must be 1mb or less! ' );
            }
        }
        if ( ! empty( $image_url ) ) {

            echo "<h1>here</h1>";

            try {
                $data = file_get_contents( $image_url );

                $content              = base64_encode( $data );
                $product_image_sql    = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (" . $Retailer_product_id . ", '" . $content . "')";
                $product_image_result = $conn->query( $product_image_sql );

                echo $content;
            }//catch exception
            catch ( Exception $e ) {
                echo 'Unable to download image Message: ' . $e->getMessage();
            }


        }

        //Other Images
        $other_image1_name      = $_FILES[ 'other_image1' ][ 'name' ];
        $other_image1_type      = $_FILES[ 'other_image1' ][ 'type' ];
        $other_image1_extension = strtolower( substr( $other_image1_name, strpos( $other_image1_name, '.' ) + 1 ) );
        $other_image1_size      = $_FILES[ 'other_image1' ][ 'size' ];

        if ( ! empty( $other_image1_name ) ) {
            if ( ( $other_image1_extension == 'jpg' || $other_image1_extension == 'jpeg' || $other_image1_extension == 'png' ) && ( $other_image1_type == 'image/jpeg' || $other_image1_type == 'image/png' ) ) {
                $other_image1_image   = addslashes( $_FILES[ 'other_image1' ][ 'tmp_name' ] );
                $other_image1_content = file_get_contents( $other_image1_image );
                $other_image1_content = base64_encode( $other_image1_content );
                $other_image1_name    = $conn->real_escape_string( $other_image1_name );

                $other_image1_sql    = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (" . $Retailer_product_id . ", '" . $other_image1_content . "')";
                $other_image1_result = $conn->query( $other_image1_sql );

            } else {
                die( 'File must be jpg/jpeg/png and must be 1mb or less! ' );
            }
        }

        $other_image2_name      = $_FILES[ 'other_image2' ][ 'name' ];
        $other_image2_type      = $_FILES[ 'other_image2' ][ 'type' ];
        $other_image2_extension = strtolower( substr( $other_image2_name, strpos( $other_image2_name, '.' ) + 1 ) );
        $other_image2_size      = $_FILES[ 'other_image2' ][ 'size' ];

        if ( ! empty( $other_image2_name ) ) {
            if ( ( $other_image2_extension == 'jpg' || $other_image2_extension == 'jpeg' || $other_image2_extension == 'png' ) && ( $other_image2_type == 'image/jpeg' || $other_image2_type == 'image/png' ) ) {
                $other_image2_image   = addslashes( $_FILES[ 'other_image2' ][ 'tmp_name' ] );
                $other_image2_content = file_get_contents( $other_image2_image );
                $other_image2_content = base64_encode( $other_image2_content );
                $other_image2_name    = $conn->real_escape_string( $other_image2_name );

                $other_image2_sql    = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (" . $Retailer_product_id . ", '" . $other_image2_content . "')";
                $other_image2_result = $conn->query( $other_image2_sql );

            } else {
                die( 'File must be jpg/jpeg/png and must be 1mb or less! ' );
            }
        }

        $other_image3_name      = $_FILES[ 'other_image3' ][ 'name' ];
        $other_image3_type      = $_FILES[ 'other_image3' ][ 'type' ];
        $other_image3_extension = strtolower( substr( $other_image3_name, strpos( $other_image3_name, '.' ) + 1 ) );
        $other_image3_size      = $_FILES[ 'other_image3' ][ 'size' ];

        if ( ! empty( $other_image3_name ) ) {
            if ( ( $other_image3_extension == 'jpg' || $other_image3_extension == 'jpeg' || $other_image3_extension == 'png' ) && ( $other_image3_type == 'image/jpeg' || $other_image3_type == 'image/png' ) ) {
                $other_image3_image   = addslashes( $_FILES[ 'other_image3' ][ 'tmp_name' ] );
                $other_image3_content = file_get_contents( $other_image3_image );
                $other_image3_content = base64_encode( $other_image3_content );
                $other_image3_name    = $conn->real_escape_string( $other_image3_name );

                $other_image3_sql    = "INSERT INTO `retailer_product_images` (`retailer_product_id`, `image`) VALUES (" . $Retailer_product_id . ", '" . $other_image3_content . "')";
                $other_image3_result = $conn->query( $other_image3_sql );

            } else {
                die( 'File must be jpg/jpeg/png and must be 1mb or less! ' );
            }
        }
        //=============END OF IMAGES==================

//        die();
        header( "Location: " . $location_success );

    } else {
        echo "Error: " . $add_product_sql . "<br>" . $conn->error;
    }


?>