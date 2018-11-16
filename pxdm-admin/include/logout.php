
<?php
	//initialize the session
	if (!isset($_SESSION)) {
		session_start();
	}
	
	// ** Logout the current user. **
	if ((isset($_GET['Logout'])) &&($_GET['Logout']=="true")){
		//to fully log out a visitor we need to clear the session varialbles
		$_SESSION['user_id'] = NULL;
		$_SESSION['username'] = NULL;
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		
		
		$logoutGoTo = "../index.php";
		if ($logoutGoTo) {
			header("Location: $logoutGoTo");
			exit;
		}
	}
?>