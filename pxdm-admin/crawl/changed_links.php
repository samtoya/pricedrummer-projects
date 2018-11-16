<?php
	//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
	include('../include/check_user_login.php');//check if user is logged in
	
	require_once('../connections/db_connect.php');//connect to the database
	
	
	
	$Links_sql = "SELECT `crawl_url`.*,`merchant`.`name` as 'merchant_name',`category`.`name` as 'category_name' FROM `crawl_url` left join `category` on `category`.`category_ID` = `crawl_url`.`category_ID` left join `merchant` on `merchant`.`merchant_ID` = `crawl_url`.`merchant_ID` ORDER BY `crawl_url`.`url_status` DESC ";
	$Links_result = $conn->query($Links_sql);
	
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
						<!-- start: PAGE HEADER -->
						<!-- start: TOOLBAR -->
						
						<!--start modal -->
						<div class="modal fade bs-example-modal-md" id="url_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header"style="background-color:#428BCA; color: #FFF; text-align: center;">
										<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><br/>
										
									</div>
									
									<div class="modal-body">
										<div class="row">
											<div class="form-group">
												<div class="col-md-12">
													<input type="hidden" value="" id="crawl_url_ID">
													<label for="merchant_url">
														Merchant Url
													</label>
													<input class="form-control" type="text" value="" id="merchant_url"><br/>
													<center><button class="btn btn-info" onclick="process_update(''+$('#crawl_url_ID').val()+'',''+$('#merchant_url').val()+'')" type="button">Update Url</button></center>
												</div>
											</div>
										</div>
										
									</div>
									
									<div class="modal-footer">
										<div class="row">
											<div class="col-md-6">
											</div>
											<div class="col-md-6">
												<button data-dismiss="modal" id="closeLevModal" class="btn btn-primary" style="width: 123px;" type="button">Close</button>
											</div>
											
										</div>
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
						</div>
						<!--end start modal -->
						
						
						<!-- end: BREADCRUMB -->
						<!-- start: PAGE CONTENT -->
						<div class="row">
							<div class="col-md-12">
								<!-- start: DYNAMIC TABLE PANEL -->
								<div class="panel panel-danger">
									<div class="panel-heading">
										<h1 class="panel-title"style = "font-size: 20px;">Admin > Merchant Url List</h1>
										<div class="panel-tools">
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
													<!--li>
														<a class="panel-config" href="#panel-config" data-toggle="modal">
														<i class="fa fa-wrench"></i> <span>Configurations</span>
														</a>
													</li-->
													<li>
														<a class="panel-expand" href="#">
															<i class="fa fa-expand"></i> <span>Fullscreen</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="panel-body">
										
										<div id="Upload_div" align="center" style="display:none"><font color="green"><strong> Product Prcessed Successfully </strong></font></div>
										<?php // echo $result->num_rows; echo'<br/>';?>
										<?php //echo $child_categories_ids ;?>
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
											<thead>
												<tr>
													<th width="25%">Merchant Name</th>
													<th>Merchant Url</th>
													<th>Category</th>
													<th>Url Status</th>
													<th>Edit</th>
													
												</tr>
											</thead>
											<tbody>
												<?php
													if ($Links_result->num_rows > 0) {
														while($row = $Links_result->fetch_assoc()) {
															
														?>
														<tr class="active">
															
															<td><?php echo $row["merchant_name"];?></td>
															<td><p class="M_Url"><?php echo $row["merchant_url"];?></p></td>
															<td><?php echo $row["category_name"];?></td>
															<td><b><p class="Status"><?php echo $row["url_status"];?></p></b></td>
															<td>
																<div class="visible-md visible-lg hidden-sm hidden-xs">
																	<a href="#" class="btn btn-xs btn-<?php if($row['url_status'] == 'ACTIVE'){echo'green';}else{echo'red';}?> tooltips" style="width:40px; height: 25px;"data-placement="top" data-original-title="Edit" data-target=".bs-example-modal-md" data-toggle="modal" onclick="$('#merchant_url').val('<?php echo $row["merchant_url"];?>'); $('#crawl_url_ID').val('<?php echo $row["crawl_url_ID"];?>'); ele=$(this);" ><i class="fa fa-edit"></i></a>
																</div>	
															</td>
															
														</tr>
														
														<?php
															
														}
														
														} else {
														//do nothing
													}
												?>
												
											</div>
										</tbody>
									</table>
								</table>
							</div>
						</div>
						<!-- end: DYNAMIC TABLE PANEL -->
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
	
	var ele = null;
	
	function process_update(id,new_url){
	var row = $(ele).closest('tr');
	$.ajax('../include/update_crawl_url.php', {
			type: 'POST',
			data: {Url:new_url,crawl_url_ID:id},
			success:function(data1){
				row.find('.Status').text('ACTIVE');
				row.find('.M_Url').text(new_url);
				row.find('.btn').removeClass('btn-red');
				row.find('.btn').addClass('btn-green');
				$('#url_modal').modal('hide');
			},
			error:function(jqXHR, textStatus, errorThrown) {
				alert(errorThrown+'   '+textStatus);
			}
		});
	
	}
	
</script>
</body>
<!-- end: BODY -->
</html>					

<?php
	include('../connections/db_close_connect.php');//close the connection to the database	
	?>																													