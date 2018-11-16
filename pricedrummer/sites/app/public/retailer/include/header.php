<?php
    // *** Start the session for a user/retailer if is has not started
    if ( ! isset( $_SESSION ) ) {
        session_start();
    }
    if ( isset( $page ) && ( $page == "Activation_page" || $page == "Register_Results_page" ) ) {
//dont check for user authentication if its the activation page
    } else {

        //Redirect the user back to the login page if the user is not logged in and tries to access any of the protected pages
        if ( ! isset( $_SESSION[ 'retailer_user_id' ] ) && ! isset( $LOGIN_PAGE ) && ! isset( $REGISTER ) && ! isset( $RESET ) ) {
            header( "Location: index.php" );
        }


        //LOGOUT the user if the logout url parameter is set
        if ( isset( $_GET[ 'logout' ] ) ) {
            // Logout the current user if the login screen is loaded
            if ( isset( $_SESSION[ 'retailer_user_id' ] ) ) {
                $_SESSION[ 'retailer_user_id' ] = null;
                unset( $_SESSION[ 'retailer_user_id' ] );
            }
            if ( isset( $_SESSION[ 'retailer_email' ] ) ) {
                $_SESSION[ 'retailer_email' ] = null;
                unset( $_SESSION[ 'retailer_email' ] );
            }

            if ( isset( $_SESSION[ 'retailer_status' ] ) ) {
                $_SESSION[ 'retailer_status' ] = null;
                unset( $_SESSION[ 'retailer_status' ] );
            }

        }
    }
?>
<!doctype html>
<!--[if IE 8]>
<html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <title>Retailer | PriceDrummer.com</title>
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- start: META -->
    <meta charset="utf-8"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description">
    <meta content="" name="author">
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <!-- end: CORE CSS -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- start: CSS REQUIRED FOR SUBVIEW CONTENTS -->
    <link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.transitions.css">
    <link rel="stylesheet" href="assets/plugins/summernote/dist/summernote.css">
    <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="assets/plugins/DataTables/media/css/DT_bootstrap.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="../bower_components/ammap/dist/ammap/ammap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
    <!-- Google ReCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css">

    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css">
    <link rel="stylesheet" href="assets/css/fileinput.min.css">
    <link rel="stylesheet" href="assets/css/hamburger.min.css">
</head>
<body>
<?php # ini_set('short_open_tag', 0); ?>
<?php require 'include/navigation.php'; ?>
<!-- Autoload PHP Classes -->
<?php //require 'vendor/fzaninotto/faker/src/autoload.php'; ?>
<!--<div class="offcanvas-wrapper">-->
<!--    <div class="offcanvas-content visible-xs">-->
<!--        --><?php //include 'dashboard_navigation.php'; ?>
<!--    </div>-->
<!--</div>-->