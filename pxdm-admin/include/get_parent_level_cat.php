<?php
	include('../connections/db_connect-pdo.php');//connect to the database
	
	$CategoryID=$_POST['CAT'];
	
	$pdo = connect_pdo();
	$sql = 'select case when level=2 then
						(select parent_id from category where category_ID=cat.category_ID)
						when level=3 then
						(select parent_id from category where category_ID in
						(select parent_id from category where category_ID=cat.category_ID))
						when level=4 then
							(select parent_id from category where category_ID in
								(select parent_id from category where category_ID in
								(select parent_id from category where category_ID =cat.category_ID)))
								ELSE "-1" 
						end as level1_id,
						case when level=2 then
							(select category_ID from category where category_ID=cat.category_ID)
							when level=3 then
							(select parent_id from category where category_ID=cat.category_ID)
							when level=4 then
								(select parent_id from category where category_ID in
								(select parent_id from category where category_ID=cat.category_ID))
								ELSE "-1" 
							end as level2_id,
							case when level=2 then
								"-1"
							when level=3 then
							(select category_ID from category where category_ID=cat.category_ID)
								when level=4 then
								(select parent_id from category where category_ID=cat.category_ID)
								ELSE "-1" 
							end as level3_id,
							case when level=2 then
								"-1"
							when level=3 then
							"-1"
								when level=4 then
								(select category_ID from category where category_ID=cat.category_ID)
								ELSE "-1" 
							end as level4_id
							from category cat
							where category_ID=:cat_id';
	$query = $pdo->prepare($sql);
	$query->bindParam(':cat_id', $CategoryID);
	$query->execute();
	$list = $query->fetchAll();
	
	echo json_encode($list);
	
	
	
	
?>