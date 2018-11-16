<?php
	require_once('../connections/db_connect.php');//connect to the database
	
	
	if(isset($_POST['username']) && isset($_POST['password']) ){
		$UserName = $_POST['username'];
		$UserPass = hash('sha512', $_POST['password']);
		$UserStatus = 'A';
		$Redirect_goto = '../home.php';
		
		$sql = "INSERT INTO `users` (`username`, `password`, `status`) VALUES
		('".$UserName."', '".$UserPass."', '".$UserStatus."');";
		$result = $conn->query($sql);
		$ID = $conn->insert_id;
		if($ID){
			header("Location: ".$Redirect_goto);
		}
	}
	
	
?>


<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.0 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>Rapido - Responsive Admin Template</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../assets/plugins/animate.css/animate.min.css">
		<link rel="stylesheet" href="../assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="../assets/css/styles.css">
		<link rel="stylesheet" href="../assets/css/styles-responsive.css">
		<link rel="stylesheet" href="../assets/plugins/iCheck/skins/all.css">
		<!--[if IE 7]>
			<link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				
				<div class="box-login">
					
					<form class="form-login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
						
						<fieldset>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Username">
								<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
								<i class="fa fa-lock"></i></span>
								
							</div>
							<div class="form-actions">
								
								<button type="submit" class="btn btn-green pull-right">Add User</button>
							</div>
						</fieldset>
					</form>
				</div>
				<!-- end: LOGIN BOX -->
				
				
			</div>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
			<script src="../assets/plugins/respond.min.js"></script>
			<script src="../assets/plugins/excanvas.min.js"></script>
			<script type="text/javascript" src="../assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="../assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
		<!--<![endif]-->
		<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="../assets/plugins/jquery.transit/jquery.transit.js"></script>
		<script src="../assets/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
		<script src="../assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../assets/js/login.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>	
<?php //$conn->close(); ?>