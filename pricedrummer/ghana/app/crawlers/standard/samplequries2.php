<?php
	include('../connections/db_connect.php');//connect to the database
	
	$parentID=$_GET['p'];
	$sql = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
	b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
	FROM category a, category b  
	WHERE a.parent_id = b.category_ID and b.category_ID='.$parentID.';';
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo $result->num_rows; 
		echo"<br/><pre>";
		print_r($result);
		echo"</pre><br/>";
		$i=0;
			while($row = $result->fetch_assoc()) {
			
			if($i<1){
				echo '<h3>'.$row["PARENT CAT Name"].'</h3><hr/>';
				$i++;
			}
			
			echo $row["CAT Name"];
			echo"<br/>";
			}echo"<hr/>";
		
		} else {
		echo "0 list to crawl";
	}
	
	
	include('../connections/db_close_connect.php');//close the connection to the database
?>