<?php
	include('../connections/db_connect.php');//connect to the database

	// *** Validate request to login to this site.
	if (!isset($_SESSION)) {
		session_start();

		// Logout the current user if the login screen is loaded
		if(isset($_SESSION['retailer_user_id'])){
			$_SESSION['retailer_user_id'] = NULL;
			unset($_SESSION['retailer_user_id']);
		}
		if(isset($_SESSION['retailer_email'])){
			$_SESSION['retailer_email'] = NULL;
			unset($_SESSION['retailer_email']);
		}
		
		if(isset($_SESSION['retailer_status'])){
			$_SESSION['retailer_status'] = NULL;
			unset($_SESSION['retailer_status']);
		}
		
	}
	
	//print_r($_POST);

	if(isset($_POST['email']) && isset($_POST['password']) ){
		
		$email 			= $conn->real_escape_string($_POST['email']);
		$password		= $conn->real_escape_string(hash('sha512',$_POST['password']));
		$location_success = "../public/dashboard.php";
		$location_success_first_time = "../public/budget.php";
		$location_failed = "../public/index.php?login=1";
		
		//echo $username ."| | " .$password;
		
		
		$Retailer_User_sql = "SELECT * FROM `users` WHERE `username` = '".$email."' AND `password` = '".$password."' AND user_type='RETAILER' AND status ='A' limit 1";
		$Retailer_User_result = $conn->query($Retailer_User_sql);

		if($Retailer_User_result){
			if ($Retailer_User_result->num_rows > 0) {
				while($Retailer_row = $Retailer_User_result->fetch_assoc()) {
					

					//Check if the current Retailer has any budget info => this will tell if its a new user. that way we can display the set new budget view
					$Retailer_sql = 'SELECT * FROM `retailers` WHERE email = "'.$Retailer_row['username'].'"';
					$Retailer_result = $conn->query($Retailer_sql);
					if($Retailer_result){
						if ($Retailer_result->num_rows > 0) {
							while($Retailer_details_row = $Retailer_result->fetch_assoc()) {
								
								if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
								//declare session varriables and set them to the returned user
								$_SESSION['retailer_user_id'] = $Retailer_details_row['id'];
								$_SESSION['retailer_email'] = $Retailer_details_row['email'];

								//Check if the current Retailer has any budget info => this will tell if its a new user. that way we can display the set new budget view
								$Retailer_budget_check_sql = 'SELECT * FROM `retailer_budget` WHERE retailer_id = '.$Retailer_details_row['id'];
								$Retailer_budget_check_result = $conn->query($Retailer_budget_check_sql);
								
								if ($Retailer_budget_check_result->num_rows > 0){
									//Set the retailer user status to old user if there is a record in the retailer budget for the current retailer
									$_SESSION['retailer_status'] = "Old_User";
									header("Location: ".$location_success);
								}else{
									//Set the retailer user status to first time if there is no record in the retailer budget for the current retailer
									$_SESSION['retailer_status'] = "First_Time";
									header("Location: ".$location_success_first_time);
								}
								
							}

						}

					}

				}
			}else {
			//echo "0 results";
				header("Location: ".$location_failed);
			}
		}
	}

	
	
	
	
	?>