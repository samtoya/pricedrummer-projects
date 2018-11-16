<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html> <!--<![endif]-->
<head>
	<!-- Page Title -->
	<title>Cheap flights - search and compare flights with PriceDrummer</title>
	
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="keywords" content="HTML5 Template"/>
	<meta name="description" content="Travelo - Travel, Tour Booking HTML5 Template">
	<meta name="author" content="SoapTheme">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Theme Styles -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href='//fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/animate.min.css">
	
	<!-- Current Page Styles -->
	<link rel="stylesheet" type="text/css" href="components/revolution_slider/css/settings.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="components/revolution_slider/css/style.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="components/jquery.bxslider/jquery.bxslider.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="components/flexslider/flexslider.css" media="screen"/>
	
	<!-- Main Style -->
	<link id="main-style" rel="stylesheet" href="css/style.css">
	
	<!-- Updated Styles -->
	<link rel="stylesheet" href="css/updates.css">
	
	<!-- Custom Styles -->
	<link rel="stylesheet" href="css/custom.css">
	
	<!-- Responsive Styles -->
	<link rel="stylesheet" href="css/responsive.css">
	
	<!-- CSS for IE -->
	<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie.css"/>
	<![endif]-->
	
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script type='text/javascript' src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
	<![endif]-->
	<style>
		section#content { min-height: 400px; padding: 0; position: relative; overflow: hidden; }
		
		#main { padding-top: 50px; }
		
		.page-title, .page-description { color: #fff; }
		
		.page-title { font-size: 4.1667em; font-weight: bold; }
		
		.page-description { font-size: 2.5em; margin-bottom: 50px; }
		
		.featured { position: absolute; right: 50px; bottom: 50px; z-index: 9; margin-bottom: 0; text-align: right; }
		
		.featured figure a { border: 2px solid #fff; }
		
		.featured .details { margin-right: 10px; }
		
		.featured .details > * { color: #fff; line-height: 1.25em; margin: 0; font-weight: bold; text-shadow: 2px -2px rgba(0, 0, 0, 0.2); }
	</style>
</head>
<body>
<div id="page-wrapper">
	<header id="header" class="navbar-static-top">
		<div class="main-header">
			<a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
				Mobile Menu Toggle
			</a>
			
			<div class="container">
				<h1 class="logo navbar-brand">
					<a href="index.php" title="PriceDrummer Travel">
						<img src="images/logo/pxdm_travel_logo.png" alt="PriceDrummer Travel Logo"/>
					</a>
				</h1>
				
				<?php require 'navigation.php'; ?>
			</div>
			
			<?php require 'mobile_navigation.php'; ?>
		</div>
		<div id="travelo-signup" class="travelo-signup-box travelo-box">
			<div class="login-social">
				<a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
				<a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
			</div>
			<div class="seperator"><label>OR</label></div>
			<div class="simple-signup">
				<div class="text-center signup-email-section">
					<a href="#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
				</div>
				<p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest
					Refund olicy, and Host Guarantee Terms.</p>
			</div>
			<div class="email-signup">
				<form>
					<div class="form-group">
						<input type="text" class="input-text full-width" placeholder="first name">
					</div>
					<div class="form-group">
						<input type="text" class="input-text full-width" placeholder="last name">
					</div>
					<div class="form-group">
						<input type="text" class="input-text full-width" placeholder="email address">
					</div>
					<div class="form-group">
						<input type="password" class="input-text full-width" placeholder="password">
					</div>
					<div class="form-group">
						<input type="password" class="input-text full-width" placeholder="confirm password">
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox"> Tell me about Travelo news
							</label>
						</div>
					</div>
					<div class="form-group">
						<p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy,
							Guest Refund Policy, and Host Guarantee Terms.</p>
					</div>
					<button type="submit" class="full-width btn-medium">SIGNUP</button>
				</form>
			</div>
			<div class="seperator"></div>
			<p>Already a Travelo member? <a href="#travelo-login" class="goto-login soap-popupbox">Login</a></p>
		</div>
		<div id="travelo-login" class="travelo-login-box travelo-box">
			<div class="login-social">
				<a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
				<a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
			</div>
			<div class="seperator"><label>OR</label></div>
			<form>
				<div class="form-group">
					<input type="text" class="input-text full-width" placeholder="email address">
				</div>
				<div class="form-group">
					<input type="password" class="input-text full-width" placeholder="password">
				</div>
				<div class="form-group">
					<a href="#" class="forgot-password pull-right">Forgot password?</a>
					<div class="checkbox checkbox-inline">
						<label>
							<input type="checkbox"> Remember me
						</label>
					</div>
				</div>
			</form>
			<div class="seperator"></div>
			<p>Don't have an account? <a href="#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
		</div>
	</header>
