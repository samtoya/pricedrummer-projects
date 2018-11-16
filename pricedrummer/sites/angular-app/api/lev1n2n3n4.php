<?php
include('connections/db_connect.php');//connect to the database


//$parentID=$_GET['p'];
$Categories = array();
$CategoriesL1 = array();
$level2=array();
$level3=array();
$level4=array();
//$Categories[] = $_GET['p'];

$sql_lev1 = 'SELECT * FROM `category` WHERE `level` = 1 ORDER BY `category`.`order_index` ASC ';
$result_lev1 = $conn->query($sql_lev1);
if($result_lev1){
    if ($result_lev1->num_rows > 0) {
        while($row_lev1 = $result_lev1->fetch_assoc()) {


            $sql = 'SELECT a.category_ID AS "category_id",a.name,a.level,a.parent_id,a.rank,a.category_image,a.order_index,a.has_product 
	FROM category a, category b  
	WHERE a.parent_id = b.category_ID and b.category_ID='.$row_lev1['category_ID'];
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {



                    $sql1 = 'SELECT a.category_ID AS "category_id",a.name,a.level,a.parent_id,a.rank,a.category_image,a.order_index,a.has_product
			FROM category a, category b  
			WHERE a.parent_id = b.category_ID and a.has_product=1 and b.category_ID='.$row["category_id"];
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {

                        while($row1 = $result1->fetch_assoc()) {

                            $sql2 = 'SELECT a.category_ID AS "category_id",a.name,a.level,a.parent_id,a.rank,a.category_image,a.order_index,a.has_product
					FROM category a, category b  
					WHERE a.parent_id = b.category_ID and a.has_product=1 and b.category_ID='.$row1["category_id"];
                            $result2 = $conn->query($sql2);
                            if($result2){
                                if ($result2->num_rows > 0) {
                                    while($row2 = $result2->fetch_assoc()) {

                                        $level4[] = $row2;
                                    }

                                }
                            }
                            $row1['lev4s']=$level4;
                            $level3[]=$row1;
                            $level4=array();


                        }

                        $row['lev3s'] = $level3;
                        $level2[] = $row;
                        $level3=array();
                    }

                }


            }

            $row_lev1['lev2s'] =  $level2;
            $level2=array();
            $CategoriesL1[] = $row_lev1;

        }
    }
}else{
    die($conn->error);
}






header('Content-Type: application/json');
echo json_encode($CategoriesL1, JSON_NUMERIC_CHECK );


include('connections/db_close_connect.php');//close the connection to the database
?>