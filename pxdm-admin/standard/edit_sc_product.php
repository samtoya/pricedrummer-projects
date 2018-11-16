<?php
	//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
	include('../include/check_user_login.php');//check if user is logged in
	
	require_once('../connections/db_connect.php');//connect to the sc database
	require_once('../connections/db_connect_sc.php');//connect to the database
	
	//--new
	$CAT = urldecode($_GET['Cat']);
	$PROD = urldecode($_GET['Prod']);
	
	$sql = 'SELECT * FROM sc WHERE sc_ID ='.$PROD;
	$result = $conn_sc->query($sql);
	$row_product = $result->fetch_assoc();
	
	//for the level 1 dropdown
	$Cat_lev1_sql = 'SELECT * FROM category WHERE level = 1';
	$Cat_lev1_result = $conn_sc->query($Cat_lev1_sql);
	
	//COLLECT THE CURRENT CATEGORY 
	$Cat_sql = 'SELECT * FROM category WHERE category_ID ='.$CAT;
	$Cat_result = $conn_sc->query($Cat_sql);
	$row_Cat = $Cat_result->fetch_assoc();
	//prepare standard name(replace names containing spaces with an underscore"_")
	$Standard_Naming_String = '';
	if(preg_match('/\s/',$row_Cat['standard_naming']) > 0){
		$Standard_Naming_String = preg_replace('/\s+/', '_', $row_Cat['standard_naming']);
		}else{
		$Standard_Naming_String = $row_Cat['standard_naming'];
	} 
	
	
	//COLLECT THE CATEGORY DETAILS/SPCS
	$Cat_Specs_sql = 'SELECT * FROM category_details WHERE category_ID ='.$CAT;
	$Cat_Specs_result = $conn_sc->query($Cat_Specs_sql);
	
	
	$SC_IMG_sql = 'SELECT * FROM sc_images WHERE product_ID ='.$PROD;
	$SC_IMG_result = $conn_sc->query($SC_IMG_sql);
	
	
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
							
							
							<form enctype="multipart/form-data" class="form-horizontal" method="post" action="../include/process_edit_sc_item.php" id="Product_Check_Form"> 
								<!-- START MODAL-->
								<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-sm" style="width: 335px;">
										<div class="modal-content">
											<div class="modal-header">
												<!--button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button-->
												<h3 id="myLargeModalLabel" class="modal-title" style="background-color:#428BCA; color: #FFF; height: 33px; text-align: center; padding: 0px;">Electronics and Computers</h3>
											</div>
											<div class="modal-body">
												<p>
													<div class="form-group">
														<label for="lev1">
															Level 1
														</label>
														<select id="lev1" name="Level1" class="form-control" onchange="get_cat_lev_2(this); change_specs($(this).val(),$('#SCProductID').val()); $('#L1display').html($(this).find('option:selected').text()); $('#Drill_Level').val(1); " style="height: 33px;">
															<option value="">&nbsp;</option>
															<?php
																if ($Cat_lev1_result->num_rows > 0) {
																	while($row = $Cat_lev1_result->fetch_assoc()) {
																	?>
																	<option value="<?php echo $row['category_ID']; ?>"><?php echo $row['name']; ?></option>
																	<?php	
																	}}
															?>
														</select>
													</div>
												</p>
											</div>
											<div class="modal-footer">
												<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
											</div>
										</div>
									</div>
								</div>
								
								<!--modal for level 2-->
								<div class="modal fade level-2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-sm" style="width: 335px;">
										<div class="modal-content">
											<div class="modal-header">
												<!--button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button-->
												
												<h3 id="myLargeModalLabel" class="modal-title" style="background-color:#428BCA; color: #FFF; height: 33px; text-align: center; padding: 0px;">Electronics and Computers</h3>
											</div>
											<div class="modal-body">
												<p>
													<div class="form-group">
														<label for="lev2">
															Level 2
														</label>
														<select id="lev2" name="Level2" class="form-control" onchange="get_cat_lev_3(this); change_specs($(this).val(),$('#SCProductID').val()); $('#L2display').html($(this).find('option:selected').text());  $('#Drill_Level').val(2);" style="height: 33px;">
															<option value="">&nbsp;</option>
														</select>
													</div>
												</p>
											</div>
											<div class="modal-footer">
												<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
											</div>
										</div>
									</div>
								</div>
								
								<!--modal for level 3-->
								<div class="modal fade level-3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-sm" style="width: 335px;">
										<div class="modal-content">
											<div class="modal-header">
												<!--button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button-->
												<h3 id="myLargeModalLabel" class="modal-title" style="background-color:#428BCA; color: #FFF; height: 33px; text-align: center; padding: 0px;">Electronics and Computers</h3>
											</div>
											<div class="modal-body">
												<p>
													<div class="form-group">
														<label for="lev3">
															Level 3
														</label>
														<select id="lev3" name="Level3" class="form-control" onchange="get_cat_lev_4(this); change_specs($(this).val(),$('#SCProductID').val()); $('#L3display').html($(this).find('option:selected').text()); $('#Drill_Level').val(3);" style="height: 33px;">
															<option value="">&nbsp;</option>
														</select>
													</div>
												</p>
											</div>
											<div class="modal-footer">
												<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
											</div>
										</div>
									</div>
								</div>
								<!--modal for level 4-->
								<div class="modal fade level-4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-sm" style="width: 335px;">
										<div class="modal-content">
											<div class="modal-header">
												<!--button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button-->
												
												<h3 id="myLargeModalLabel" class="modal-title" style="background-color:#428BCA; color: #FFF; height: 33px; text-align: center; padding: 0px;">Electronics and Computers</h3>
											</div>
											<div class="modal-body">
												<p>
													<div class="form-group">
														<label for="lev4">
															Level 4
														</label>
														<select id="lev4" name="Level4" class="form-control" onchange="change_specs($(this).val(),$('#SCProductID').val());$('#L4display').html($(this).find('option:selected').text()); $('#Drill_Level').val(4);" style="height: 33px;">
															<option value="">&nbsp;</option>
														</select>
													</div>
												</p>
											</div>
											<div class="modal-footer">
												<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
											</div>
										</div>
									</div>
								</div>
								
								
								
								
								
								
								
								
								
								<!--first row-->
								<div class = "col-md-7">
									<div class="panel panel-danger">
										<div class="panel-heading">
											<h3 class="panel-title">Edit Standard Catalogue Product</h3>
										</div>
										
										<input type="hidden" id="Drill_Level" name="Cat_level" value="0"/>
										<input type="hidden" id="SCProductID" name="SCProductID" value="<?php echo $PROD; ?>"/>
										
										<table class = "table table-bordered">
											<thead>
												<tr>
													<th width="35%" style="color:black;"><b>Item Levels</b></th>
													<th width="55%"style="color: black;"><b>Item Name</b></th>
													<th style="color: black;">Edit</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Level 1</td>
													<td id="L1display" >Electronics and Computers</td>
													<td class="center">
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="#" class="btn btn-xs btn-blue tooltips" style="width:40px; height: 25px;"data-placement="top" data-original-title="Edit" data-target=".bs-example-modal-sm" data-toggle="modal"><i class="fa fa-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<td>Level 2</td>
													<td id="L2display" >Mobile Phones & Accessories</td>
													<td class="center">
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="#" class="btn btn-xs btn-blue tooltips" style="width:40px; height: 25px;"data-placement="top" data-original-title="Edit" data-target=".level-2" data-toggle="modal"><i class="fa fa-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr>
													<td>Level 3</td>
													<td id="L3display" >Mobile Phones</td>
													<td class="center">
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="#" class="btn btn-xs btn-blue tooltips" style="width:40px; height: 25px;"data-placement="top" data-original-title="Edit" data-target=".level-3" data-toggle="modal"><i class="fa fa-edit"></i></a>
														</div>
													</td>
												</tr>
												<tr style="border-bottom:1pt solid gray;">
													<td>Level 4</td>
													<td id="L4display" ></td>
													<td class="center">
														<div class="visible-md visible-lg hidden-sm hidden-xs">
															<a href="#" class="btn btn-xs btn-blue tooltips" style="width:40px; height: 25px;"data-placement="top" data-original-title="Edit" data-target=".level-4" data-toggle="modal"><i class="fa fa-edit"></i></a>
														</div>
													</td>
												</tr>
											</tbody>
										</table >
										<table class = "table table-bordered" >
											<br>
											<thead>
												<tr>
													<th width="30%" bgcolor="#F2DEDE" style="color:black;">Specs Section.</th>
													<th width="30%" bgcolor="#F2DEDE" style="color:black;">Item Specs.</th>
													<th width="55%" bgcolor="#F2DEDE" style="color:black;">Details</th>
													<th width="55%" bgcolor="#F2DEDE" style="color:black;">Info Type</th>
													<th width="55%" bgcolor="#F2DEDE" style="color:black;"></th>
												</tr>
											</thead>
											<tbody id="Specs_Table">	
												<tr>
													<td>Standard</td>
													<td>Model No.</td>
													<td>
														<input type="text" alt="" value="<?php echo $row_product['modal_number']; ?>" name="MODEL_NUMBER" id="product_model_Number" onkeyup="$('#check_model').show();">
													</td>
													<td>COMPULSORY</td>
													<td></td>
													
												</tr>
												<tr style="background-color: #E0DBDB;">
													<td></td>
													<td></td>	
													<td></td>	
													<td></td>	
												</tr>
												<tr>
													<td>Standard</td>
													<td>Standard Name</td>
													<td><input style="width: 100%; color: black;" type="text" name="STANDARD_NAME" value="<?php echo $row_product['product_name']; ?>" id="product_standard_name"></td>
													<td>COMPULSORY</td>
													<td></td>
												</tr>
												<tr>
													<td>Standard</td>
													<td>Alternative Name 1</td>
													<td><input style="width: 100%; color: black;" type="text" name="ALT_NAME1" value="<?php echo $row_product['alt_name1']; ?>" id="product_alt_name1"></td>
													<td>OPTIONAL</td>
													<td></td>
												</tr>
												<tr>
													<td>Standard</td>
													<td>Alternative Name 2</td>
													<td><input style="width: 100%; color: black;" type="text" name="ALT_NAME2" value="<?php echo $row_product['alt_name2']; ?>" id="product_alt_name2"></td>
													<td>OPTIONAL</td>
													<td></td>
												</tr>
												
												
												
											</tbody>
										</table>
										<div class="panel-footer">	
											
										</div>
									</div>
									<button class="btn btn-info btn-lg" onclick="Check_Categories();" style="width: 123px;" type="submit">Update Specs</button>
									<br/>
									<br/>
								</div>
								<!--end first row-->
								
								<!--start second row-->
								
								<div class="col-md-5" id="SC_Col">
									<!-- START PANEL WITH COLLAPSE CALLBACKS -->
									<div class="panel panel-success panel-hidden-controls">
										<div class="panel-body">
											
											<div class="row">
												<div class="col-md-12">
													
													<?php
														if ($SC_IMG_result->num_rows > 0) {
															while($SC_IMG_row = $SC_IMG_result->fetch_assoc()) {
																
															?>
															<div class="col-sm-6">
																<div class="form-group">
																	<?php
																		echo '<a class="thumb-info" href="data:image;base64,'.$SC_IMG_row['image'].' " data-lightbox="gallery" data-title="Product Image">
																		<img height="150" align="center" width="200" src="data:image;base64,'.$SC_IMG_row['image'].' " class="img-responsive" alt="">
																		<span class="thumb-info-title"> </span>
																		</a> ';
																	?>
																	<a class="btn btn-danger" style="width:200px;" onclick="Delete_Image('<?php echo $SC_IMG_row['image_ID'];?>')">Delete</a>
																</div>	                                           
															</div>
															<?php
															}
															$Total_Img_Count = 4-($SC_IMG_result->num_rows);
															
															for($i = 1; $i <= $Total_Img_Count; $i++){
															?>
															<div class="col-sm-6">
																<div class="form-group">
																	
																	<label>
																		Add Product Image:
																	</label>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt=""/>
																		</div>
																		<div class="fileupload-preview fileupload-exists thumbnail"></div>
																		<div>
																			<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
																				<input type="file" name="Product_Image[]">
																			</span>
																			<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
																				<i class="fa fa-times"></i> Remove
																			</a>
																		</div>
																	</div>
																</div>	                                           
															</div>
															<?php
															}
															}else{
															$Total_Img_Count = 4-($SC_IMG_result->num_rows);
															
															for($i = 1; $i <= $Total_Img_Count; $i++){
															?>
															<div class="col-sm-6">
																<div class="form-group">
																	
																	<label>
																		Add Product Image:
																	</label>
																	<div class="fileupload fileupload-new" data-provides="fileupload">
																		<div class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt=""/>
																		</div>
																		<div class="fileupload-preview fileupload-exists thumbnail"></div>
																		<div>
																			<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
																				<input type="file" name="Product_Image[]">
																			</span>
																			<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
																				<i class="fa fa-times"></i> Remove
																			</a>
																		</div>
																	</div>
																</div>	                                           
															</div>
															<?php
															}
														}
													?>
													
												</div>	
											</div>
											<div class="col-md-12">
												<div class="row">
													<a href="#" class="btn btn-xs btn-green tooltips pull-right" style="width: 42px; height: 27px; margin-bottom: 5px;"data-placement="top" data-original-title="Wide View" data-target=".copy-past-m" onclick="raw_Oter_Specs = $('#item_info').val(); $('#OtherSpecsContainerLarge').html($('#OtherSpecsContainer').html()); $('#OtherSpecsContainer').empty(); $('#item_info').text(raw_Oter_Specs); " data-toggle="modal"><i class="fa fa-desktop fa-2x"></i></a>
												</div>
												<div class="form-group"  id="OtherSpecsContainer">
													<label>Other Product Information:</label>  
													<textarea name="Product_Information" id="item_info" class="form-control fomstyl" rows="10" placeholder="item informations" data-placement="right" data-toggle="tooltip" data-original-title="item_info" style="_height: 64px;"></textarea>
													
													<textarea class="form-control fomstyl" name="Product_Information_hidden" readonly rows="10" id="item_info_hidden" style="display: none;"></textarea><br/>
													<input type="text" value="" id="specs_tokenizer" style="width:90px;"/>
													<a class="btn btn-danger" id="item_info_check_btn" style="width:100px;" onclick="Check_Product_Other_info();">Check Format</a>
													
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
											<button class="btn btn-info btn-lg"  onclick="Check_Categories();" style="width: 123px;" type="submit">Update Specs</button>
										</div>  
									</div>
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
					
					<!--start modal-->
					<div class="modal fade" id="basicmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-md" style="top: 188px;">
							<div class="modal-content">
								<div class="modal-header">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button">
										×
									</button>
									<h4 id="myLargeModalLabel" class="modal-title">Catalogue Directory</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											<button style="width: 260px;" class="btn btn-info" type="button">
												Uncategorised
											</button>
										</div>
										<div class="col-md-6">
											<button class="btn btn-info" style="width: 260px;" type="button">
												Categorised
											</button>
										</div>
									</div>
								</div>
							</div>
							<!--modal-content -->
						</div>
					</div>
					<!--start modal-->
					<!--start modal -->
					<div class="modal fade bs-example-modal-md" id="Review_Specs" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-md">
							<div class="modal-content">
								<div class="modal-header"style="background-color:#428BCA; color: #FFF; text-align: center;">
									<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
									
								</div>
								<div class="modal-body">
									<div id="Prod_specs">
										
									</div>
									
									
								</div>
								<div class="modal-footer">
									<div class="row">
										<div class="col-md-6">
											<button type="submit" id="Process_Product" class="btn btn-success btn-block">Process Product</button>
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
					<input type="hidden" value="<?php echo $Standard_Naming_String;?>" id="Standard_Naming_String_input" />
					
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
							$.ajax({
								url: '../include/get_cat_children.php',
								type: 'POST',
								data: {CAT:Cat_Lev_1},
								success:function(data){
									item_data = JSON.parse(data);
									//alert(item_data);
									$("#lev2").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 2</option>').val('');
									$("#lev3").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 3</option>').val('');
									$("#lev4").find('option').remove().end().append('<option value="" selected disabled>Select Category Level 4</option>').val('');
									
									$('#L2display').html('Select Category Level 2');
									$('#L3display').html('Select Category Level 3');
									$('#L4display').html('Select Category Level 4');
									
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
									
									$('#L3display').html('Select Category Level 3');
									$('#L4display').html('Select Category Level 4');
									
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
									
									$('#L4display').html('Select Category Level 4');
									
									$.each(item_data, function (i, item) {
										$("#lev4").append('<option value="'+item.CAT_ID+'">'+item.CAT_Name+'</option>');
									});
								},
								error:function() {
									alert('no');
								}
							});
						}
						
						var Fill_lev3_timer;
						var Fill_lev4_timer;
						var Set_lev4_timer;
						function set_levels(cat){
							$.ajax({
								url: '../include/get_parent_level_cat.php',
								type: 'POST',
								data: {CAT:cat},
								success:function(data){
									//alert(data);
									item_data = JSON.parse(data);
									var lev1 = item_data[0].level1_id;
									var lev2 = item_data[0].level2_id;
									var lev3 = item_data[0].level3_id;
									var lev4 = item_data[0].level4_id;
									
									
									function Fill_lev3(categoryID){
										console.log('1');
										clearInterval(Fill_lev3_timer);
										Fill_lev3_timer = setInterval(function() { 
											if ($("#lev2 option[value="+categoryID+"]").length > 0){
												clearInterval(Fill_lev3_timer);
												$("#lev2").val(categoryID).change();
												}else{
												//do nothing
											}
										}   , 100);
									}
									
									
									function Fill_lev4(categoryID){
										console.log(categoryID)
										clearInterval(Fill_lev4_timer);
										Fill_lev4_timer = setInterval(function() { 
											if ($("#lev3 option[value="+categoryID+"]").length > 0){
												clearInterval(Fill_lev4_timer);
												$("#lev3").val(categoryID).change();
												}else{
												//do nothing
												console.log("3 not here");
											}
										}   , 100);
									}
									
									
									function Set_lev4(categoryID){
										console.log(categoryID)
										clearInterval(Set_lev4_timer);
										Set_lev4_timer = setInterval(function() { 
											if ($("#lev4 option[value="+categoryID+"]").length > 0){
												clearInterval(Set_lev4_timer);
												$("#lev4").val(categoryID).change();
												}else{
												//do nothing
											}
										}   , 100);
									}
									
									if(lev3 == '-1' && lev4 == '-1' && lev2 != '-1' && lev1 != '-1'){
										//THE PRODUCT WAS CRAWLED AT LEVEL 2
										$("#lev1").val(item_data[0].level1_id).change();
										Fill_lev3(lev2);
										
										}else if (lev4 == '-1' && lev3 != '-1' && lev2 != '-1' && lev1 != '-1'){
										//THE PRODUCT WAS CRAWLED AT LEVEL 3
										$("#lev1").val(item_data[0].level1_id).change();
										Fill_lev3(lev2);
										Fill_lev4(lev3);
										}else if (lev4 != '-1' && lev3 != '-1' && lev2 != '-1' && lev1 != '-1'){
										//THE PRODUCT WAS CRAWLED AT LEVEL 4
										$("#lev1").val(item_data[0].level1_id).change();
										Fill_lev3(lev2);
										Fill_lev4(lev3);
										Set_lev4(lev4);
									}
									
								},
								error:function() {
									alert('no');
								}
							});
						}
						set_levels(<?php echo $CAT; ?>);
						
						function clear_all_Intervals(){
							clearInterval(Fill_lev3_timer);
							clearInterval(Fill_lev4_timer);
							clearInterval(Set_lev4_timer);
						}
						
						
						$(document).ready(function(){
							$('#check_model').click(function(){
								var exist_modID = $('#product_model_Number').val();
								
								$.ajax({
									url: '../include/check_model.php',
									type: 'POST',
									data: {model:exist_modID},
									success:function(data){
										var exist = parseInt(data);
										if(exist == 1){
											console.log("exist");
											//$("#SC_Col").load("include/in_sc.php");
											$("#check_model").hide();
											
											$("#Product_Check_Form").attr("action", "include/addtosc_copy.php");
											
											//perform another call to collect the existing product(s) specs
											$.ajax({
												url: '../include/collect_sc_product_specs.php',
												type: 'POST',
												data: {model_number:exist_modID},
												success:function(data){
													//alert(data);
													$("#SC_Col").html(data);
													$("html, body").animate({scrollTop: 0}, "slow");
												},
												error:function() {
													alert('no')
												}
											});
											
											}else{
											console.log("Not exist");
											$("#SC_Col").load("include/not_in_sc.php");
											$("#check_model").hide();
											$("html, body").animate({scrollTop: 0}, "slow");
											$("#Product_Check_Form").attr("action", "include/addtosc.php");
											
										}
										//console.log(data)
									},
									error:function() {
										
									}
								});
							})
						});
						
						
						
						//=========================== STANDARD NAME ========================//
						function Standard_Naming(){
							//STANDARD NAME STRING GOES HERE.
							var S_N_String = $('#Standard_Naming_String_input').val()+'+product_model_Number';
							//alert(S_N_String);
							var S_N_Array = S_N_String.split('+');
							
							//ARRAYS TO HOLD SPLITED OJECTS AND STRINGS
							var S_N_elements = [];
							var S_N_elements_for_Onkeyup = [];
							
							//LOOP TO ADD OBJECTS AND STRINGS TO RESPECTIVE ARRAY
							$.each(S_N_Array, function(index, value) { 
								S_N_elements.push($("#"+ value+""));
							});
							
							$.each(S_N_Array, function(index, value) { 
								S_N_elements_for_Onkeyup.push("#"+value);
							});
							
							//JOIN THE STRINGS ARRAY TO BUILD THE JQUERY SELECTER FOR THE NEEDED ELEMENT FOR STANDARD NAMING
							var S_N_string_for_Onkeyup = S_N_elements_for_Onkeyup.join(', ');
							//alert(S_N_string_for_Onkeyup);
							
							//BUILD THE STANDARD NAMING FUNCTION THAT SETS THE NAME.
							function build_standard_name(array){
								var S_N = '';
								$.each(array, function(index, value) { 
									S_N = S_N + value.val().trim() + value.attr( 'alt' ) + ' ';
								});
								$('#product_standard_name').val(S_N);
							}
							
							//USE THE JOINT STRING ABOVE TO TARGET THE REQUIRED ELEMENTS AND APPLY AN ONKEYUP FUNCTION TO SET THE STANDARD NAME
							$(''+S_N_string_for_Onkeyup+'').on('keyup', function( e ){
								build_standard_name(S_N_elements);
							});
							$(''+S_N_string_for_Onkeyup+'').on('change', function( e ){
								build_standard_name(S_N_elements);
							});
						}
						Standard_Naming();
						//=========================== END OF STANDARD NAME ========================//
						
						
						
						
						//prevent inputs from submiting the form when the user press enter
						$(document).on("keypress", ":input:not(textarea)", function(event) {
							if (event.keyCode == 13) {
								event.preventDefault();
							}
						});
						
						
						//function to build preview of the copied data before saving
						function Recheck_Product_Copy(){
							$.ajax('check_get_sc_prod_details.php', {
								type: 'POST',
								data: $( "#Product_Check_Form" ).serialize(),
								success:function(data1){
									//alert(data1);
									$('#Prod_specs').html(data1);
									$('#Review_Specs').modal().show();
								},
								error:function(jqXHR, textStatus, errorThrown) {
									alert(errorThrown+'   '+textStatus);
								}
							});
							
						};
						
						
						function change_specs(cat_id,product_id){
							$.ajax({
								url: '../include/check_if_cat_has_specs.php',
								type: 'POST',
								data: {cat_id:cat_id},
								success:function(data){
									var success_msg = parseInt(data);
									if(success_msg == 1){
										//selected categoy has specs assiged to it. collect the specs details
										
										//collect the standard name
										$.ajax({
											url: '../include/collect_standard_name.php',
											type: 'POST',
											data: {cat:cat_id},
											success:function(data2){
												str = data2.replace(/\s+/g, '');
												$("#Standard_Naming_String_input").val(str);
											},
											error:function() {
												alert('Error collecting standard name');
											}
										});
										
										//collect the specs details
										$.ajax({
											url: '../include/collect_specs_for_change_sc_edit.php',
											type: 'GET',
											data: {cat_id:cat_id,prod_id:product_id},
											success:function(data){
												$(".Specs_tr").remove();
												$("#Specs_Table").append(data);
												//rebuild standard name
												Standard_Naming();
											},
											error:function() {
												alert('Error setting specs');
											}
										});
										}else{
										//selected category has no direct specs assiged to it. mainly for level 1 and 2
									}
								},
								error:function() {
									alert('Error checking category specs');
								}
							});
						}
						
						
						
						
						function numberOnly(ele){
							$(ele).keydown(function (event) {
								/*
									//if the letter is not digit then don't type anything
									if (e.which != 8 && e.which != 0 && e.which != 13 && (e.which < 48 || e.which > 57)) {
									//display error message
									//$("#errmsg").html("Digits Only").show().fadeOut("slow");
									return false;
									}
								*/	
								if ((event.keyCode >= 48 && event.keyCode <= 57) || 
								(event.keyCode >= 96 && event.keyCode <= 105) || 
								event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
								event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190|| event.keyCode == 110) {
									
									} else {
									event.preventDefault();
								}
								
								if(($(ele).val().indexOf('.') !== -1 && event.keyCode == 190) || ($(ele).val().indexOf('.') !== -1 && event.keyCode == 110) )
								event.preventDefault(); 
								//if a decimal has been added, disable the "."-button
								
							});
						}
						
						
						function Delete_Image(image_id){
							var ask_to_delete = confirm('Are you sure you want to delete this Image?');
							if(ask_to_delete==true){
								$.ajax({
									url: '../include/delete_sc_product_image.php',
									type: 'POST',
									data: {image_id:image_id},
									success:function(data){
										$.ajax({
											url: '../include/load_sc_product_image_edit.php',
											type: 'POST',
											data: {product_id:product_id},
											success:function(data){
												$('#SC_Col').html(data);
											},
											error:function() {
												alert('Error Collecting Product image');
											}
										});
									},
									error:function() {
										alert('Error Deleting Imge');
									}
								});
								
								}else{
								//do nothing
							}
							var product_id = $('#SCProductID').val();
							
						}
						
						function delete_prod_specs(spec_id,ele){
							var row = $(ele).closest('tr');
							var ask_to_delete = confirm('Are you sure you want to delete this Product Spec?');
							if(ask_to_delete==true){
								$.ajax({
									url: '../include/delete_sc_product_spec_edit.php',
									type: 'POST',
									data: {spec_id:spec_id},
									success:function(data){
										row.remove();
									},
									error:function() {
										alert('Error Deleting Product Specs');
									}
								});
								
								}else{
								//do nothing
							}
							var product_id = $('#SCProductID').val();
							
						}
						
						
					</script>
					
				</body>
				<!-- end: BODY -->
			</html>
<?php
include('../connections/db_connect.php');//close the connection to the database
include('../connections/db_connect_sc.php');//close the connection to the database
?>