<?php
	include('../connections/db_connect.php');//connect to the database
	include('../connections/db_connect_sc.php');//connect to the database

	//$pdo = connect_pdo();
	if(isset($_POST['model'])){
		$model_number_or_product_name = $_POST['model'];
		if(!empty($model_number_or_product_name)){
			//Perform the search if only the search parameter is not empty
			$sql = "SELECT * FROM sc WHERE ((modal_number <>'' and modal_number = '".trim($model_number_or_product_name)."') OR (product_name<>'' and product_name like '".trim($model_number_or_product_name)."%')) and `sc`.`status` <>'DELETED'";
			$result = $conn_sc->query($sql);
		}

		if($result->num_rows>0){
			echo 1;
			}else{
			echo 0;
		}

		
	}
	
	include('../connections/db_connect.php');//close the connection to the database
	include('../connections/db_connect_sc.php');//close the connection to the database
?>