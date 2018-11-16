<?php
// include('connections/db_connect.php');//connect to the database
include_once(base_path().'/connections/db_connect.php');

$parentID=$_GET['p'];
$Categories = array();
$level2=array();
$level3=array();
$level4=array();
//$Categories[] = $_GET['p'];
$sql = 'SELECT a.category_ID AS "category_id",a.name,a.level,a.parent_id,a.rank,a.category_image,a.order_index,a.has_product 
	FROM category a, category b  
	WHERE a.parent_id = b.category_ID and b.category_ID='.$parentID;
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

        //$Categories[] = $level2;
    }
    $Categories[] = $level2;
    $level2=array();

} else {
    echo "0 list to crawl";
}


//header('Content-Type: application/json');
echo json_encode($Categories, JSON_NUMERIC_CHECK );


// include('connections/db_close_connect.php');//close the connection to the database
include_once(base_path().'/connections/db_close_connect.php');
?>