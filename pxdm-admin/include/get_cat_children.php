<?php
	include('../connections/db_connect-pdo.php');//connect to the database
	
	$parentID= $_POST['CAT'];
	
	$pdo = connect_pdo();
	$sql = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT_Name"  
	FROM category a, category b  
	WHERE a.parent_id = b.category_ID and b.category_ID=:parent;';
	$query = $pdo->prepare($sql);
	$query->bindParam(':parent', $parentID);
	$query->execute();
	$list = $query->fetchAll();
	
	echo json_encode($list);
	
	
	
	include('../connections/db_connect.php');//close the connection to the database
?>