<?php
include('../connections/db_connect.php');//connect to the database


if (!isset($_SESSION)) {
    session_start();

}
$User_Id = 0;
if(isset($_SESSION['user_id'])){
    $User_Id = $_SESSION['user_id'];
}

$Category = '';
$productID = $_POST['pID'];

if(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 1){
    $Category = $_POST['Level1'];
}elseif(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 2){
    $Category = $_POST['Level2'];
}elseif(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 3){
    $Category = $_POST['Level3'];
}elseif(isset($_POST['Cat_level']) && $_POST['Cat_level'] == 4){
    $Category = $_POST['Level4'];
}

//prepare the values for sql
$Category = $conn->real_escape_string($Category);
$User_Id = $conn->real_escape_string($User_Id);
$productID = $conn->real_escape_string($productID);


$sql = 'UPDATE retailer_products SET category = '.$Category.' WHERE id ="'.$productID.'";';
$result = $conn->query($sql);

echo $productID;
include('../connections/db_close_connect.php');//close the connection to the database
?>