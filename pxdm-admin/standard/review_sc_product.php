<?php
	//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
	include('../include/check_user_login.php');//check if user is logged in
	
	require_once('../connections/db_connect.php');//connect to the sc database
	require_once('../connections/db_connect.php');//connect to the database
	
	//--new
	$PROD = urldecode($_GET['prod']);
	
	$sql = 'SELECT * FROM sc WHERE sc_ID ='.$PROD;
	$result = $conn->query($sql);
	$row_product = $result->fetch_assoc();
	
	$SC_Specs_sql_optional = 'SELECT * FROM sc_details WHERE info_type="OPTIONAL" and product_ID ='.$PROD;
	$SC_Specs_result_optional = $conn->query($SC_Specs_sql_optional);
	
	//create an assoc array with the prod specs
	$SC_Specs_rows = array();
	if ($SC_Specs_result->num_rows > 0) {
		while($SC_Specs_row = $SC_Specs_result->fetch_assoc()) {
			$SC_Specs_rows[$SC_Specs_row['detail_name']] = $SC_Specs_row['details_value'];
		}
	}
	
	$Specs = '';
	
	$Section = '';
	if ($SC_Specs_result_optional->num_rows > 0) {
		while($SC_Specs_optional_row = $SC_Specs_result_optional->fetch_assoc()) {
			if($Section == $SC_Specs_optional_row['category_section']){
				
			$Specs = $Specs . $SC_Specs_optional_row['detail_name']."\n".$SC_Specs_optional_row['details_value']."\n";
			}else{
			$Section = $SC_Specs_optional_row['category_section'];
			$Specs = $Specs ."\n".$SC_Specs_optional_row['category_section']." ===\n".$SC_Specs_optional_row['detail_name']."\n".$SC_Specs_optional_row['details_value']."\n";
			}
	
		}
	}
	
	
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
		<title>Price Drummer</title>
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
        <link rel="stylesheet" href="../assets/plugins/lightbox2/css/lightbox.css">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="../assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="../assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		<link rel="stylesheet" href="../assets/plugins/jquery-highlighttextarea/jquery.highlighttextarea.min.css">
		
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
			<div class="main-container inner">
				<!-- start: PAGE -->
				<div class="main-content">
					<!-- start: PANEL CONFIGURATION MODAL FORM -->
					
					<!-- end: SPANEL CONFIGURATION MODAL FORM -->
					<div class="container">
						<!-- start: PAGE HEADER -->
						<!-- start: TOOLBAR -->
						<!--start search_bar-->
						
						<!--end search_bar-->
						<!-- end: TOOLBAR -->
						<!-- end: PAGE HEADER -->
						<!-- start: BREADCRUMB -->
						
						<div class="row">
							<div class="col-md-12">
								<ol class="breadcrumb">
									<li>
										<a href="#">
											Dashboard
										</a>
									</li>
									<!--li class="active">
										Horizontal Menu Fixed
									</li-->
								</ol>
							</div>
						</div>
						<!-- end: BREADCRUMB -->
						
						<!-- start: PAGE CONTENT -->
						<div class="row">
							
							<!-- START MODAL-->
							<div class="modal fade copy-past-m " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" style="width: 90%; height:90%;">
									<div class="modal-content">
										<div class="modal-header" style="background-color: rgb(66, 139, 202); border-radius: 5px 5px 0px 0px;">
											<!--button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button-->
											<h3 id="myLargeModalLabel" class="modal-title" style="background-color:#428BCA; color: #FFF; height: 33px; text-align: center; padding: 0px;">Other Product Information</h3>
										</div>
										<div class="modal-body" id="OtherSpecsContainerLarge">
											
										</div>
										<div class="modal-footer">
											<button onclick="raw_Oter_Specs = $('#item_info').val(); $('#OtherSpecsContainer').html($('#OtherSpecsContainerLarge').html()); $('#OtherSpecsContainerLarge').empty(); $('#item_info').text(raw_Oter_Specs);" data-dismiss="modal" class="btn btn-default" type="button">Done</button>
										</div>
									</div>
								</div>
							</div>
							
							
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="../include/update_optional_specs.php" id="Product_Check_Form"> 
								
								
								<!--first row-->
								<div class = "col-md-12">
									<div class="panel panel-success panel-hidden-controls">
										<div class="panel-body">
											<div class="col-md-12">
												<div class="row">
												</div>
												<div class="form-group"  id="OtherSpecsContainer">
													<label>Other Product Information for : <?php echo $row_product['product_name']; ?></label>  
													<textarea name="Product_Information" id="item_info" class="form-control fomstyl" rows="10" placeholder="item informations" data-placement="right" data-toggle="tooltip" data-original-title="item_info" style="_height: 64px;"><?php echo $Specs; ?></textarea>
													
													<textarea class="form-control fomstyl" name="Product_Information_hidden" readonly rows="10" id="item_info_hidden" style="display: none;"></textarea><br/>
													<input type="text" value="" id="specs_tokenizer" style="width:90px;"/>
													<a class="btn btn-danger" id="item_info_check_btn" style="width:100px;" onclick="Check_Product_Other_info(); $('#UpdateSpecs').prop('disabled',false);">Check Format</a>
													
													<br/>
													<br/>
													<div class="">
														<table class = "table table-bordered">
															<th bgcolor="#FCF8E3" style="width:15%;">Spec Section</th>
															<th bgcolor="#FCF8E3" style="width:20%;">Spec Key</th>
															<th bgcolor="#FCF8E3" style="width:65%;">Spec Value</th>
															<tbody id="ST">
															</tbody>
														</table>
													</div>
													
												</div>
											</div>
											
										</div>
										
										
										
										<div class="panel-footer">
											<button disabled class="btn btn-info btn-lg"  onclick="Check_Categories();" id="UpdateSpecs" style="width: 123px;" type="submit">Update Specs</button>
										</div>
									</div>
									<!--end first row-->
									
									<!--start second row-->
									<input type="hidden" value="<?php echo $PROD; ?>" name="Prod_ID">
									
								</div>
							</form>
							
							
						</div>
					</div>
					<!-- end: MAIN CONTAINER -->
					<!-- start: FOOTER -->
					<!--start include footer-->
					<?php include("../include/footer.php"); ?>
					<!--end include footer-->
					<!-- end: FOOTER -->
					<!-- start: SUBVIEW SAMPLE CONTENTS -->
					<!-- *** NEW NOTE *** -->
					<!-- *** READ NOTE *** -->
					
					<!-- *** SHOW CALENDAR *** -->
					
					<!--start modal-->
					
					<!--end start modal -->
					
					<!-- start: MAIN JAVASCRIPTS -->
					<!--[if lt IE 9]>
						<script src="../assets/plugins/respond.min.js"></script>
						<script src="../assets/plugins/excanvas.min.js"></script>
						<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
					<![endif]-->
					<!--[if gte IE 9]><!-->
					<script src="../assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
					<!--<![endif]-->
					<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
					
					<script src="../assets/plugins/jquery-highlighttextarea/jquery.highlighttextarea.js"></script>
					
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
					<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS ->
						
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
					<script src="../assets/plugins/holder/holder.js"></script>
					<script src="../assets/plugins/mixitup/src/jquery.mixitup.js"></script>
					<script src="../assets/plugins/lightbox2/js/lightbox.min.js"></script>
					<script src="../assets/js/pages-gallery.js"></script>
					
					<!--<script src="../assets/plugins/ckeditor/ckeditor.js"></script>
						<script src="../assets/plugins/ckeditor/adapters/jquery.js"></script>
						<script src="../assets/js/form-elements.js"></script>
					end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
					
					<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
					<!--<script src="../assets/js/ui-modals.js"></script>-->
					<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
					
					<!-- start: CORE JAVASCRIPTS  -->
					<script src="../assets/js/main.js"></script>
					
					
					
					
					<!-- start: MY FUNCTIONS  -->
					<script src="../js/copy_past_func.js"></script>
					<script src="../js/check_category_onsubmit.js"></script>
					<!-- end: CORE JAVASCRIPTS  -->
					<script>
						jQuery(document).ready(function() {
							Main.init();
							SVExamples.init();
							PagesGallery.init();
						});
						
						jQuery(document).ready(function() {
							Main.init();
							SVExamples.init();
							//	UIModals.init();
						});
					</script>
					
					<script>
						jQuery(document).ready(function() {
							Main.init();
							SVExamples.init();
						});
						
						
						//prevent inputs from submiting the form when the user press enter
						$(document).on("keypress", ":input:not(textarea)", function(event) {
							if (event.keyCode == 13) {
								event.preventDefault();
							}
						});
						
						
						
					</script>
					
				</body>
				<!-- end: BODY -->
			</html>																																																																																																																																																																																																																																