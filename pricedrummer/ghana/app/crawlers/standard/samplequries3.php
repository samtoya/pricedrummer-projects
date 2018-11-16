<?php
	include('../connections/db_connect.php');//connect to the database
	
	$parentID=$_GET['p'];
	$sql = 'SELECT *  
	FROM category
	WHERE level = 1';
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo $result->num_rows; 
		echo"<br/><pre>";
		print_r($result);
		echo"</pre><br/>";
		
			while($row = $result->fetch_assoc()) {
			
			echo $row["name"];
			echo"<br/>";
			}
		
		} else {
		echo "0 list to crawl";
	}
	
	
	include('../connections/db_close_connect.php');//close the connection to the database
?>