<?php
	//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
	include('../include/check_user_login.php');//check if user is logged in
	
	require_once('../connections/db_connect.php');//connect to the sc database
	require_once('../connections/db_connect.php');//connect to the database
	
	$sql = 'SELECT * FROM category WHERE level = 1';
	$result = $conn->query($sql);
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
						<form enctype="multipart/form-data" id="BuyingGuideForm" action="../include/process_buying_guide.php" method="post">
							<div class="row">
								
								<input type="hidden" name="Cat_level" id="Drill_Level" value="0" />
								<div class="col-md-3">
									<label for="lev1">
										Category Level 1
									</label>
									<select id="lev1" name="Level1" class="form-control"  onchange="get_cat_lev_2(this); $('#Drill_Level').val(1); $('#Category_hidden_input').val($(this).val());">
										<option value="" disabled selected>&nbsp;</option>
										<?php
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
												?>
												<option value="<?php echo $row['category_ID'];?>"><?php echo $row["name"];?></option>
												<?php	
												}
												} else {
												//do nothing
											}
										?>
									</select>
									<label for="lev2">
										Category Level 2
									</label>
									<select id="lev2" name="Level2" class="form-control"  onchange="get_cat_lev_3(this); $('#Drill_Level').val(2); $('#Category_hidden_input').val($(this).val());">
										<option value="">&nbsp;</option>
									</select>
									
									<label for="lev3">
										Category Level 3
									</label>
									<select id="lev3" name="Level3" class="form-control"  onchange="get_cat_lev_4(this); $('#Drill_Level').val(3); $('#Category_hidden_input').val($(this).val());">
										<option value="">&nbsp;</option>
									</select>
									<label for="lev4">
										Category Level 4
									</label>
									<select id="lev4" name="Level4" class="form-control" onchange="$('#Drill_Level').val(4); $('#Category_hidden_input').val($(this).val()); ">
										<option value="">&nbsp;</option>
									</select>
									
									<input type="hidden" id="Category_hidden_input" name="Category" value=""/>
									
								</div>
								
								<div class="col-md-8">
									
									<div id="Buying_guide_details">
										<div class="row guide" >
											<div class="col-md-5 no-padding no-margin">
												<div class="form-group">
													<label>Heading:</label>  
													<input placeholder="Enter Guide Heading Here" class="form-control Heading" name="BuyingGuide[Heading][]" value=""  data-toggle="tooltip" type="text">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group" id="OtherSpecsContainer">
													<label>Content:</label>
													<textarea class="form-control fomstyl Content" name="BuyingGuide[Content][]"  rows="10" id="guide_content" ></textarea>
													<br/>
												</div>
											</div>
											<div class="col-md-2 no-padding no-margin">
												<label>
													Guide Image 4:
												</label>
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt=""/>
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail"></div>
													<div>
														<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
															<input type="file" name="BuyingGuideImage[]">
														</span>
														<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
															<i class="fa fa-times"></i> Remove
														</a>
													</div>
												</div>
											</div>
										</div>
										
									</div>
									<a id="Add_Guide" class="btn btn-sm btn-success">Add Guide Section</a>
									<br/>
									<br/>
									<button type="submit" onclick="savecheck" id="SubmitGuide" class="btn btn-lg btn-primary pull-right">Save</button>
									<br/>
									<br/>
									<br/>
									
								</div>
								
							</div>
						</form>
					</div>
					
					
					
					
					<!-- end: MAIN CONTAINER -->
					<!-- start: FOOTER -->
					<!--start include footer-->
					<?php include("../include/footer.php"); ?>
					<!--end include footer-->
					<!-- end: FOOTER -->
					<!-- start: SUBVIEW SAMPLE CONTENTS -->
					<!-- *** NEW NOTE *** -->
					
					
					
					<div id="New_Row_Template" style="display:none;">
						<div class="row guide" >
							<div class="col-md-5 no-padding no-margin">
								<div class="form-group">
									<label>Heading:</label>  
									<input placeholder="Enter Guide Heading Here" class="form-control Heading" name="BuyingGuide[Heading][]" value=""  data-toggle="tooltip" type="text">
								</div>
								<a onclick="delete_row(this)" class="btn btn-sm btn-danger">Remove Guide Section</a>
							</div>
							<div class="col-md-5">
								<div class="form-group" id="OtherSpecsContainer">
									<label>Content:</label>
									<textarea class="form-control fomstyl Content" name="BuyingGuide[Content][]"  rows="10" id="guide_content" ></textarea>
									<br/>
								</div>
							</div>
							<div class="col-md-2 no-padding no-margin">
								<label>
									Guide Image 4:
								</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt=""/>
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail"></div>
									<div>
										<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
											<input type="file" name="BuyingGuideImage[]">
										</span>
										<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
											<i class="fa fa-times"></i> Remove
										</a>
									</div>
								</div>
							</div>
							
							<br/>
							<br/>
						</div>
						
					</div>
					
					
					
					
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
						
						
						function get_cat_lev_2(ele){
							var Cat_Lev_1 = $(ele).val();
							console.log(Cat_Lev_1);
							$.ajax({
								url: '../include/get_cat_children.php',
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
								url: '../include/get_cat_children.php',
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
								url: '../include/get_cat_children.php',
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
						
						
						
						$('#Add_Guide').click(function() {
							$("#Buying_guide_details").append($('#New_Row_Template').html());
						});
						
						function delete_row($this) {
							$this.closest('div.guide').remove();
						}
						
						
						
						
						
						
						
						
						$('#BuyingGuideForm').submit(function (e) {
							//check values
							var No_Heading = 0;
							var No_Content = 0;
							var guides = $('#Buying_guide_details').find('.guide');
							
							$.each(guides, function (i, item) {
								if(!$(item).find('.Heading').val() || $(item).find('.Heading').val() ==""){
									No_Heading++;
								}
								if(!$(item).find('.Content').val() || $(item).find('.Content').val() ==""){
									No_Content++;
								}
							});
							
							if ($('#Category_hidden_input').val() =="" || $('#Category_hidden_input').val() ==0) {
								//prevent the default form submit
								e.preventDefault();
								alert('Please Select The Category For This Buying Guide');
								}else if(No_Heading !=0) {
								//prevent the default form submit
								e.preventDefault();
								alert('Please A Guide Is Missing A Heading');
								No_Heading = 0;
								}else if (No_Content !=0) {
								//prevent the default form submit
								e.preventDefault();
								alert('Please A Guide Is Missing Content');
								No_Content = 0;
							}
							
						});
						
						
						
						
						
					</script>
					
					<script></script>
					
				</body>
				<!-- end: BODY -->
			</html>																																																									