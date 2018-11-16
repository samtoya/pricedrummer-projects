<?php
	 require_once('connections/db_connect.php');//connect to the database

	//$Delete_Spec_sql = "Delete from sc_details WHERE sc_ID =".$_POST['spec_id'].";";
	//$Delete_Spec_result = $conn->query($Delete_Spec_sql);

	// *** Validate request to login to this site.
	if (!isset($_SESSION)) {
		session_start();
		// Logout the crrent user if the login screen is loaded
		if(isset($_SESSION['user_id'])){
			$_SESSION['user_id'] = NULL;
			unset($_SESSION['user_id']);
		}
		if(isset($_SESSION['username'])){
			$_SESSION['username'] = NULL;
			unset($_SESSION['username']);
		}

	}

	if(isset($_POST['username']) && isset($_POST['password']) ){

		$username = $_POST['username'];
		$password = $_POST['password'];
		$location = "home.php";
		$location2 = "index.php?login=1";

		//echo $username ."| | " .$password;


		$sql = "SELECT * FROM users where username ='".$username."' and password='".hash('sha512', $password)."' and status='A' Limit 1";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($User_row = $result->fetch_assoc()) {

				if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}

				//declare session varriables and set them to the returned user
				$_SESSION['user_id'] = $User_row['id'];
				$_SESSION['username'] = $User_row['username'];

				header("Location: ".$location);
				exit();
			}
			} else {
			//echo "0 results";
			header("Location: ".$location2);
			exit();
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
		<title>PXDM - LOGIN</title>
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
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/plugins/animate.css/animate.min.css">
		<link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/styles-responsive.css">
		<link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
		<!--[if IE 7]>
			<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
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
				<!--div class="logo">
					<img src="assets/images/logo.png" class="img-circle">
					</div>
				<!-- start: LOGIN BOX -->
				<div class="box-login">
					<div class="logo">
						<img src="assets/images/anonymous.jpg" class="img-circle">
					</div>
					<!--h3>Sign in to your account</h3>
						<p>
						Please enter your name and password to log in.
					</p-->
					<form class="form-login" action="" method="POST">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
						</div>
						<?php
							if(isset($_GET['login'])){

								echo "<p style='text-align:center; color:red'><b>USER NOT FOUND</b></p>";
							}

						?>
						<fieldset>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="Username">
								<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i>
									<!--a class="forgot" href="#">
										I forgot my password
									</a> </span-->
								</div>
								<div class="form-actions">
									<!--label for="remember" class="checkbox-inline">
										<input type="checkbox" class="grey remember" id="remember" name="remember">
										Keep me signed in
									</label-->
									<button type="submit" class="btn btn-green pull-right">
										Login <i class="fa fa-arrow-circle-right"></i>
									</button>
								</div>
							<!--	<div class="new-account">
									Don't have an account yet?
									<a href="#" class="register">
										Create an account
									</a>
								</div>
							-->
							</fieldset>
						</form>
						<!-- start: COPYRIGHT -->
						<div class="copyright">
							2016 &copy; Pricedrummer.
						</div>
						<!-- end: COPYRIGHT -->
					</div>
					<!-- end: LOGIN BOX -->
					<!-- start: FORGOT BOX -->
					<div class="box-forgot">
						<h3>Forget Password?</h3>
						<p>
							Enter your e-mail address below to reset your password.
						</p>
						<form class="form-forgot">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
							</div>
							<fieldset>
								<div class="form-group">
									<span class="input-icon">
										<input type="email" class="form-control" name="email" placeholder="Email">
									<i class="fa fa-envelope"></i> </span>
								</div>
								<div class="form-actions">
									<a class="btn btn-light-grey go-back">
										<i class="fa fa-chevron-circle-left"></i> Log-In
									</a>
									<button type="submit" class="btn btn-green pull-right">
										Submit <i class="fa fa-arrow-circle-right"></i>
									</button>
								</div>
							</fieldset>
						</form>
						<!-- start: COPYRIGHT -->
						<div class="copyright">
							2014 &copy; Rapido by cliptheme.
						</div>
						<!-- end: COPYRIGHT -->
					</div>
					<!-- end: FORGOT BOX -->
					<!-- start: REGISTER BOX -->
					<div class="box-register">
						<h3>Hey! If you can read this then, you got it right</h3>
						<p>
							Confirm your personal awesomeness below:
						</p>
						<form class="form-register">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
							</div>
							<fieldset>
								<div class="form-group">
									<input type="text" class="form-control" name="full_name" placeholder="Full Name">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="address" placeholder="Address">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="city" placeholder="City">
								</div>
								<div class="form-group">
									<div>
										<label class="radio-inline">
											<input type="radio" class="grey" value="F" name="gender">
											Female
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey" value="M" name="gender">
											Male
										</label>
									</div>
								</div>
								<p>
									Enter your account details below:
								</p>
								<div class="form-group">
									<span class="input-icon">
										<input type="email" class="form-control" name="email" placeholder="Email">
									<i class="fa fa-envelope"></i> </span>
								</div>
								<div class="form-group">
									<span class="input-icon">
										<input type="password" class="form-control" id="password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i> </span>
								</div>
								<div class="form-group">
									<span class="input-icon">
										<input type="password" class="form-control" name="password_again" placeholder="Password Again">
									<i class="fa fa-lock"></i> </span>
								</div>
								<div class="form-group">
									<div>
										<label for="agree" class="checkbox-inline">
											<input type="checkbox" class="grey agree" id="agree" name="agree">
											I agree to the Terms of Service and Privacy Policy
										</label>
									</div>
								</div>
								<div class="form-actions">
									Already have an account?
									<a href="#" class="go-back">
										Log-in
									</a>
									<button type="submit" class="btn btn-green pull-right">
										Submit <i class="fa fa-arrow-circle-right"></i>
									</button>
								</div>
							</fieldset>
						</form>
						<!-- start: COPYRIGHT -->
						<div class="copyright">
							2014 &copy; Rapido by cliptheme.
						</div>
						<!-- end: COPYRIGHT -->
					</div>
					<!-- end: REGISTER BOX -->
				</div>
			</div>
			<!-- start: MAIN JAVASCRIPTS -->
			<!--[if lt IE 9]>
				<script src="assets/plugins/respond.min.js"></script>
				<script src="assets/plugins/excanvas.min.js"></script>
				<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
			<![endif]-->
			<!--[if gte IE 9]><!-->
			<script src="assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
			<!--<![endif]-->
			<script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
			<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
			<script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
			<script src="assets/plugins/jquery.transit/jquery.transit.js"></script>
			<script src="assets/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
			<script src="assets/js/main.js"></script>
			<!-- end: MAIN JAVASCRIPTS -->
			<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
			<script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
			<script src="assets/js/login.js"></script>
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