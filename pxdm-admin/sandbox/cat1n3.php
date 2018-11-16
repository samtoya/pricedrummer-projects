<?php

require_once('../connections/db_connect.php');//connect to the database

$Categories = array();
$parentID=$_GET['p'];
//$Categories[] = $_GET['p'];
$sql = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
	b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
	FROM category a, category b  
	WHERE a.parent_id = b.category_ID and b.category_ID='.$parentID;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // echo $result->num_rows;
    // echo"<br/><pre>";
    // print_r($result);
    // echo"</pre><br/>";
    $i=0;
    while($row = $result->fetch_assoc()) {

        if($i<1){
            echo '<h3>'.$row["PARENT CAT Name"].'</h3><hr/>';
            $i++;
        }
        //$Categories[] = $row["CAT_ID"];
        //echo $row["CAT_ID"];
        //echo"<br/>";

        $sql1 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
			b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
			FROM category a, category b  
			WHERE a.parent_id = b.category_ID and a.has_product=1 and a.has_level_4=0 and b.category_ID='.$row["CAT_ID"];
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while($row1 = $result1->fetch_assoc()) {

                $Categories[] = $row1["CAT_ID"];

                $sql2 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
					b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
					FROM category a, category b  
					WHERE a.parent_id = b.category_ID and b.category_ID='.$row1["CAT_ID"];
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {

                        $Categories[] = $row2["CAT_ID"];
                    }
                }
            }
        }
    }

} else {
    echo "0 list to crawl";
}

echo $JointSelections = implode(",",$Categories);
echo"<br/><pre>";
print_r($Categories);
echo"</pre><br/>";



/*
    $sql = 'SELECT * FROM products left join category on products.category = category.category_ID ';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

    echo $row["name"];
    echo"<br/>";
    }

    } else {
    echo "0 list to crawl";
    }
*/

include('../connections/db_connect.php');//close the connection to the database
?>