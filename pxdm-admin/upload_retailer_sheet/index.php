<?php
//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
include('../include/check_user_login.php');//check if user is logged in

require_once('../connections/db_connect.php');//connect to the database
require_once('../connections/db_connect_sc.php');//connect to the database

$sql = 'SELECT id,company_name FROM retailers';
$retailer_result = $conn->query($sql);

?>
<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.0 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
    <title>SC Product List</title>
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
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/iCheck/skins/all.css">
    <link rel="stylesheet" href="../assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/plugins/animate.css/animate.min.css">
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR SUBVIEW CONTENTS -->
    <link rel="stylesheet" href="../assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="../assets/plugins/owl-carousel/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="../assets/plugins/owl-carousel/owl-carousel/owl.transitions.css">
    <link rel="stylesheet" href="../assets/plugins/summernote/dist/summernote.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="../assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../assets/plugins/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="../assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="../assets/plugins/DataTables/media/css/DT_bootstrap.css">
    <link rel="stylesheet" href="../assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="../assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
    <!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="stylesheet" type="text/css" href="../assets/plugins/select2/select2.css" />
    <link rel="stylesheet" href="../assets/plugins/lightbox2/css/lightbox.css">
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CORE CSS -->
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/styles-responsive.css">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/themes/theme-default.css" type="text/css" id="skin_color">
    <link rel="stylesheet" href="../assets/css/print.css" type="text/css" media="print"/>
    <!-- end: CORE CSS -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body class="sidebar-close horizontal-menu-fixed">

<div class="main-wrapper">
    <!-- start: TOPBAR -->

    <!--start header-->
    <?php include("../include/header.php"); ?>
    <!--end header-->

    <!-- end: TOPBAR -->

    <!-- start: HORIZONTAL MENU -->
    <!--start include horizontal_menu-->
    <?php include("../include/horizontal_menu.php"); ?>
    <!--end include horizontal_menu-->

    <!-- end: HORIZONTAL MENU -->

    <!-- start: PAGESLIDE LEFT -->


    <!-- end: PAGESLIDE LEFT -->
    <!-- start: PAGESLIDE RIGHT -->

    <!-- end: PAGESLIDE RIGHT -->
    <!-- start: MAIN CONTAINER -->
    <div class="main-container inner">
        <!-- start: PAGE -->
        <div class="main-content">

            <div class="container">
            <div class="row">
    <br>
                <div class="col-md-3 hidden-phone"></div>
                <div class="col-md-6" id="form-login">
                    <form class="well" action="upload.php" method="post" name="upload_excel" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Upload Retailer CSV/Excel file 
                            <?php if(isset($_GET['u']) && $_GET['u'] =='s'){
                                ?>
                                <small id="sucMsg" class="pull-right text-success">Uploaded Successfully</small>
                                <?php
                                }else if(isset($_GET['u']) && $_GET['u'] =='f'){
                                ?>
                                <small class="pull-right text-danger">Upload Failed</small>
                                <?php
                                }
                                ?>
                            
                            </legend>
                            <div class="control-group">
                                <div class="control-label">
                                    <label>CSV/Excel File:</label>
                                </div>
                                <div class="controls form-group">
                                    <input type="file" name="file" id="file" class="input-large form-control" required="">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <div class="controls">
                                    <select id="retailer_Id" class="form-control" name="retailer_Id" required="">
                                        <option value="" disabled="" selected="">Select Retailer</option>
                                        <?php
                                        if ($retailer_result->num_rows > 0) {
                                            while($row = $retailer_result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['company_name']; ?></option>
                                                <?php
                                            }}
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                <br/>
                                <button type="submit" id="submit" name="Import" class="btn btn-success btn-flat btn-lg pull-right button-loading" data-loading-text="Loading...">Upload</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div class="col-md-3 hidden-phone"></div>
            </div>
            
        </div>
        </div>
        <div class="subviews">
            <div class="subviews-container"></div>
        </div>
    </div>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<!-- start: FOOTER -->


<!--start footer include-->
<?php include("../include/footer.php"); ?>
<!--end footer include-->

<!-- end: FOOTER -->
<!-- start: SUBVIEW SAMPLE CONTENTS -->
<!-- *** NEW NOTE *** -->

<!-- *** READ NOTE *** -->
<div id="readNote">
    <div class="barTopSubview">
        <a href="#newNote" class="new-note button-sv"><i class="fa fa-plus"></i> Add new note</a>
    </div>
    <div class="noteWrap col-md-8 col-md-offset-2">
        <div class="panel panel-note">
            <div class="e-slider owl-carousel owl-theme">


                <div class="item">
                    <div class="panel-heading">

                    </div>

                    <div class="panel-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<input type="hidden" value="<?php if(isset($_GET['ups'])){echo urldecode($_GET['ups']);}?>" id="processed"/>


<!-- *** SHOW CALENDAR *** -->

<!-- *** READ EVENT *** -->

<!-- *** NEW CONTRIBUTOR *** -->

<!-- *** SHOW CONTRIBUTORS *** -->

<!-- end: SUBVIEW SAMPLE CONTENTS -->
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
<script src="../assets/plugins/blockUI/jquery.blockUI.js"></script>
<script src="../assets/plugins/iCheck/jquery.icheck.min.js"></script>
<script src="../assets/plugins/moment/min/moment.min.js"></script>
<script src="../assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
<script src="../assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
<script src="../assets/plugins/bootbox/bootbox.min.js"></script>
<script src="../assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js"></script>
<script src="../assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js"></script>
<script src="../assets/plugins/jquery.appear/jquery.appear.js"></script>
<script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<script src="../assets/plugins/velocity/jquery.velocity.min.js"></script>
<script src="../assets/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
<!-- end: MAIN JAVASCRIPTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
<script src="../assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<script src="../assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
<script src="../assets/plugins/toastr/toastr.js"></script>
<script src="../assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script src="../assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<script src="../assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
<script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="../assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
<script src="../assets/plugins/truncate/jquery.truncate.js"></script>
<script src="../assets/plugins/summernote/dist/summernote.min.js"></script>
<script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../assets/js/subview.js"></script>
<script src="../assets/js/subview-examples.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../assets/js/table-data.js"></script>
<script src="../assets/plugins/mixitup/src/jquery.mixitup.js"></script>
<script src="../assets/plugins/lightbox2/js/lightbox.min.js"></script>
<script src="../assets/js/pages-gallery.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: CORE JAVASCRIPTS  -->
<script src="../assets/js/main.js"></script>
<!-- end: CORE JAVASCRIPTS  -->
<script>
    jQuery(document).ready(function() {
        Main.init();
        SVExamples.init();
        TableData.init();
    });
</script>
</body>
<!-- end: BODY -->
</html>

<?php
include('../connections/db_close_connect.php');//close the connection to the database
include('../connections/db_close_connect_sc.php');//close the connection to the database
?>