<?php
//	ini_set( 'display_errors', 1 );
	
	include( 'connections/db_connect.php' );//connect to the database
	$Categories = [];
	$parentID = $_GET[ 'p' ];
//$Categories[] = $_GET['p'];
	$sql = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
	b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
	FROM category a, category b  
	WHERE a.parent_id = b.category_ID AND b.category_ID=' . $parentID;
	$result = $conn->query( $sql );
	
	if ( $result->num_rows > 0 ) {
		
		while ( $row = $result->fetch_assoc() ) {
			
			$sql1 = 'SELECT a.category_ID AS "category_id",a.name,a.level,a.parent_id,a.rank,a.category_image,a.order_index,a.has_product
			FROM category a, category b  
			WHERE a.parent_id = b.category_ID AND a.has_product=1 AND a.has_level_4=0 AND b.category_ID=' . $row[ "CAT_ID" ];
			$result1 = $conn->query( $sql1 );
			if ( $result1->num_rows > 0 ) {
				
				while ( $row1 = $result1->fetch_assoc() ) {
					
					$Categories[] = $row1;
					
				}
			}
		}
		
	} else {
		//echo "0 list to crawl";
	}


//header('Content-Type: application/json');
	echo json_encode( $Categories, JSON_NUMERIC_CHECK );
	
	
	include( 'connections/db_close_connect.php' );//close the connection to the database
?>