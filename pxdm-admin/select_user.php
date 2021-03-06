<?php
	//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
	include('include/check_user_login.php');//check if user is logged in
	
	//require_once('connections/db_connect.php');//connect to the database
	require_once('connections/db_connect.php');//connect to the database
	
	$users_sql = 'SELECT * FROM `users`';
	$users_result = $conn->query($users_sql);
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
		<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="assets/plugins/animate.css/animate.min.css">
		<!-- end: MAIN CSS -->
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
		<!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="stylesheet" href="assets/plugins/lightbox2/css/lightbox.css">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css">
		
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link href="assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
		<link rel="stylesheet" href="assets/plugins/select2/select2.css">
		<link rel="stylesheet" href="assets/plugins/datepicker/css/datepicker.css">
		<link rel="stylesheet" href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
		<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css">
		<link rel="stylesheet" href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		
		
		<!-- start: CORE CSS -->
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/styles-responsive.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-default.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="assets/css/print.css" type="text/css" media="print"/>
		<!-- end: CORE CSS -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="sidebar-close horizontal-menu-fixed">
		
		<div class="main-wrapper">
			<!-- start: TOPBAR -->
			
			<!--start header-->
			<?php include("include/header.php"); ?>
			<!--end header-->
			
			<!-- end: TOPBAR -->
			
			<!-- start: HORIZONTAL MENU -->
			
			<!--start include horizontal_menu-->
			<?php include("include/horizontal_menu.php"); ?>
			<!--end include horizontal_menu-->
			
			<!-- end: HORIZONTAL MENU -->
			
			
			
			<div class="main-container inner">
				<!-- start: PAGE -->
				<div class="main-content">
					<!-- start: PANEL CONFIGURATION MODAL FORM -->
					<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title">Panel Configuration</h4>
								</div>
								<div class="modal-body">
									Here will be a configuration form
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
										Close
									</button>
									<button type="button" class="btn btn-primary">
										Save changes
									</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					<!-- end: SPANEL CONFIGURATION MODAL FORM -->
					<div class="container">
						<!-- start: PAGE HEADER -->
						<!-- start: TOOLBAR -->
						<!--start search_bar-->
						<?php include("include/search_bar.php"); ?>
						<!--end search_bar-->
						<!-- end: TOOLBAR -->
						<!-- end: PAGE HEADER -->
						<!-- start: BREADCRUMB -->
						<div class="row">
							<div class="col-md-12">
								<ol class="breadcrumb">
									<li>
										
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
							<div class="col-md-12">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h4 class="panel-title" style="text-align: center;">Admins Only - User Product List</h4>
										<!--<div class="panel-tools">
											<div class="dropdown">
											<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
											<i class="fa fa-cog"></i>
											</a>
											<ul class="dropdown-menu dropdown-light pull-right" role="menu">
											<li>
											<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
											</li>
											<li>
											<a class="panel-refresh" href="#">
											<i class="fa fa-refresh"></i> <span>Refresh</span>
											</a>
											</li>
											<li>
											<a class="panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i> <span>Configurations</span>
											</a>
											</li>
											<li>
											<a class="panel-expand" href="#">
											<i class="fa fa-expand"></i> <span>Fullscreen</span>
											</a>
											</li>
											</ul>
											</div>
										</div>-->
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-4">
											</div>
											<div class="col-md-4">
											<form action="standard/user_product_list.php" method="POST">
												<label for="User">
													Username
												</label>
												<select id="User" class="form-control" name="User" required  onchange="">
													<option value="">&nbsp;</option>
													<option value="View_All">View All</option>
													<?php
														if ($users_result->num_rows > 0) {
															while($row = $users_result->fetch_assoc()) {
															?>
															<option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
															<?php	
															}}
													?>
												</select>
												<br/>
												<div class="input-group">
													<input type="text" data-date-format="yyyy-mm-dd" data-date-viewmode="years" class="form-control date-picker" value="<?php echo date("Y-m-d");?>" name="Date">
													<span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
												</div>
												<br/>
												<input type="submit" value="View Products" class="btn btn-success pull-right" />
												</form>
											</div>
											<div class="col-md-4">
											</div>
											
										</div>
										<!-- GRID -->
										
									</div>
								</div>
							</div>
						</div>
						<!-- end: PAGE CONTENT-->
						
						
					</div>
					<div class="subviews">
						<div class="subviews-container"></div>
					</div>
				</div>
				<!-- end: PAGE -->
			</div>
			<!-- end: MAIN CONTAINER -->
			<!-- start: FOOTER -->
			
			<!--start include footer-->
			<?php include("include/footer.php"); ?>
			<!--end include footer-->
			
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
			<!-- *** SHOW CALENDAR *** -->
			
		</div>
		
		
		
		<!--start modal-->
		<div class="modal fade" id="basicmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-md" style="top: 100px;">
				<div class="modal-content">
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
							×
						</button>
						<h4 id="myLargeModalLabel" class="modal-title">Catalogue Directory</h4>
					</div>
					<div class="modal-body">
						<form action="" method="get" id="select_state">
							<div class="row">
								<input type="hidden" name="Cat_level" id="Drill_Level" value="0" />
								<div class="col-md-12">
									<label for="lev2">
										Level 2
									</label>
									<select id="lev2" class="form-control"  onchange="get_cat_lev_3(this); $('#Drill_Level').val(2); $('#Category_hidden_input').val($(this).val());">
										<option value="">&nbsp;</option>
									</select>
									<label for="lev3">
										Level 3
									</label>
									<select id="lev3" class="form-control"  onchange="get_cat_lev_4(this); $('#Drill_Level').val(3); $('#Category_hidden_input').val($(this).val());">
										<option value="">&nbsp;</option>
									</select>
									<label for="lev4">
										Level 4
									</label>
									<select id="lev4" class="form-control" onchange="$('#Drill_Level').val(4); $('#Category_hidden_input').val($(this).val()); ">
										<option value="">&nbsp;</option>
									</select>
								</div>
							</div>
							<br/>
							<div class="row">
								
								<div class="col-md-6">
									<button style="width: 260px;" type="submit" id="Uncategorised" name="Uncategorised" class="btn btn-danger" type="button"onclick=" $('#select_state').attr('action', 'crawled_list.php');">
										Uncategorised
									</button>
								</div>
								<div class="col-md-6">
									<button class="btn btn-success" type="submit" id="Categorised" name="Categorised" style="width: 260px;" type="button" onclick="$('#select_state').attr('action', 'crawled_list.php');">
										Categorised
									</button>
								</div>
								
							</div>
							<input type="hidden" id="Category_hidden_input" name="Category" value=""/>
						</form>
					</div>
					
				</div>
				<!--modal-content -->
			</div>
		</div>
		<!--start modal-->
		
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
			<script src="assets/plugins/respond.min.js"></script>
			<script src="assets/plugins/excanvas.min.js"></script>
			<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
			<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<!--<![endif]-->
		<script src="assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="assets/plugins/moment/min/moment.min.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="assets/plugins/bootbox/bootbox.min.js"></script>
		<script src="assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js"></script>
		<script src="assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js"></script>
		<script src="assets/plugins/jquery.appear/jquery.appear.js"></script>
		<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="assets/plugins/velocity/jquery.velocity.min.js"></script>
		<script src="assets/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS ->
			
		<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
		<script src="assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script src="assets/plugins/toastr/toastr.js"></script>
		<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
		<script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
		<script src="assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
		<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
		<script src="assets/plugins/truncate/jquery.truncate.js"></script>
		<script src="assets/plugins/summernote/dist/summernote.min.js"></script>
		<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="assets/js/subview.js"></script>
		<script src="assets/js/subview-examples.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="assets/plugins/holder/holder.js"></script>
		<script src="assets/plugins/mixitup/src/jquery.mixitup.js"></script>
		<script src="assets/plugins/lightbox2/js/lightbox.min.js"></script>
		<script src="assets/js/pages-gallery.js"></script>
		
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="assets/plugins/autosize/jquery.autosize.min.js"></script>
		<script src="assets/plugins/select2/select2.min.js"></script>
		<script src="assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
		<script src="assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="assets/plugins/jquery-maskmoney/jquery.maskMoney.js"></script>
		<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/plugins/bootstrap-colorpicker/js/commits.js"></script>
		<script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
		<script src="assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js"></script>
		<script src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="assets/plugins/ckeditor/ckeditor.js"></script>
		<script src="assets/plugins/ckeditor/adapters/jquery.js"></script>
		<script src="assets/js/form-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!--<script src="assets/js/ui-modals.js"></script>-->
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="assets/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				SVExamples.init();
				PagesGallery.init();
				FormElements.init();
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
			
			
			function get_cat_lev_2(ele){
				var Cat_Lev_1 = ele;
				$.ajax({
					url: 'include/get_cat_children.php',
					type: 'POST',
					data: {CAT:Cat_Lev_1},
					success:function(data){
						item_data = JSON.parse(data);
						//alert(item_data[0].CAT_Name);
						$("#lev2").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 2</option>').val('');
						$("#lev3").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 3</option>').val('');
						$("#lev4").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 4</option>').val('');
						
						$.each(item_data, function (i, item) {
							$("#lev2").append('<option value="'+item.CAT_ID+'">'+item.CAT_Name+'</option>');
						});
					},
					error:function() {
						alert('no');
					}
				});
			}
			
			function get_cat_lev_3(ele){
				var Cat_Lev_2 = $(ele).val();
				$.ajax({
					url: 'include/get_cat_children.php',
					type: 'POST',
					data: {CAT:Cat_Lev_2},
					success:function(data){
						item_data = JSON.parse(data);
						$("#lev3").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 3</option>').val('');
						$("#lev4").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 4</option>').val('');
						
						$.each(item_data, function (i, item) {
							$("#lev3").append('<option value="'+item.CAT_ID+'">'+item.CAT_Name+'</option>');
						});
					},
					error:function() {
						alert('no');
					}
				});
			}
			
			function get_cat_lev_4(ele){
				var Cat_Lev_3 = $(ele).val();
				$.ajax({
					url: 'include/get_cat_children.php',
					type: 'POST',
					data: {CAT:Cat_Lev_3},
					success:function(data){
						item_data = JSON.parse(data);
						$("#lev4").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 4</option>').val('');
						
						$.each(item_data, function (i, item) {
							$("#lev4").append('<option value="'+item.CAT_ID+'">'+item.CAT_Name+'</option>');
						});
					},
					error:function() {
						alert('no');
					}
				});
			}
			
		</script>
		
	</body>
	<!-- end: BODY -->
</html>		
<?php
	include('connections/db_close_connect.php');//close the connection to the database	
?>		