<?php
	require_once('../connections/db_connect_sc.php');//connect to the database
	
	$Delete_Imge_sql = "Delete from sc_images WHERE image_ID =".$_POST['image_id'].";";
	$Delete_Imge_result = $conn_sc->query($Delete_Imge_sql);
?>