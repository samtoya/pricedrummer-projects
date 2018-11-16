<?php
// include('connections/db_connect.php');//connect to the database
include_once(base_path().'/connections/db_connect.php');
$SpecValues = array();
$Details_Code=$_GET['code'];
$Category_Id=$_GET['cat_id'];

$sql = 'SELECT DISTINCT(details_value) FROM `sc_details` WHERE details_code="'.$Details_Code.'" and product_ID IN(SELECT sc_ID FROM `sc` WHERE `category_ID` = '.$Category_Id.' and status ="ACTIVE") and `info_type` = "COMPULSORY" and TRIM(details_value)<>"" and details_value<>"N/A"';

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $SpecValues[]=$row['details_value'];
    }

} else {
    //echo "0 list to crawl";
}


//header('Content-Type: application/json');
echo json_encode($SpecValues);


// include('connections/db_close_connect.php');//close the connection to the database
include_once(base_path().'/connections/db_close_connect.php');
?>