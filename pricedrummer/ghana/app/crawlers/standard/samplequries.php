<?php
	include('../connections/db_connect.php');//connect to the database
	
	$sql = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
	b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
	FROM category a, category b  
	WHERE a.parent_id = b.category_ID ORDER BY `PARENT CAT Name` ASC; ';
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo $result->num_rows; 
		echo"<br/><pre>";
		print_r($result);
		echo"</pre><br/>";
		
			while($row = $result->fetch_assoc()) {
			echo $row["CAT Name"] ." || ".$row["PARENT CAT Name"] ;
			echo"<br/>";
			}
		
		} else {
		echo "0 list to crawl";
	}
	
	
	include('../connections/db_close_connect.php');//close the connection to the database
?>