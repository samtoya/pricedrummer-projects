<?php
	
	if (!isset($_SESSION)) {
		session_start();
	}
	if(isset($_SESSION['user_id']) && isset($_SESSION['username'])){
	//Do Nothing
	}else{
	header("Location: ../../../../../../pxdm-admin/index.php");
}
?>	