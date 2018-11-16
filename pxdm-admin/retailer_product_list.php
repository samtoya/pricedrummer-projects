<?php
//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
include('include/check_user_login.php');//check if user is logged in

require_once('connections/db_connect.php');//connect to the database

$view_name = 'off_re_products_view';

if(isset($_GET['linked'])){
	$view_name = 'off_re_products_linked_view';
}
if(isset($_GET['unlinked'])){
	$view_name = 'off_re_products_unlinked_view';
}
if(isset($_GET['all'])){
	$view_name = 'off_re_products_all_view';
}

if(isset($_GET['ups'])){
	// $Upload_Message = urldecode($_GET['ups']);
}

if(isset($_GET['rid'])){
		$retailer_id = $conn->real_escape_string(urldecode($_GET['rid']));

		$Category_Status = "";
		$Category = "";
		$Cat_level = "";

		// find out how many rows are in the table
		$sql_count = 'SELECT count(*) as numrows FROM `'.$view_name.'` WHERE  retailer_id = '.$retailer_id;
		$result9 = $conn->query($sql_count);
		if($result9){
            $data = $result9->fetch_assoc();
            $numrows = $data['numrows'];
        }
		// $numrows = $result9->num_rows;


		// number of rows to show per page
		$rowsperpage = 10;

		// find out total pages
		$totalpages = ceil($numrows / $rowsperpage);


		// get the current page or set a default
		if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
			// cast var as int
			$currentpage = (int) $_GET['currentpage'];
		} else {
			// default page num
			$currentpage = 1;
		} // end if


		// if current page is greater than total pages...
		if ($currentpage > $totalpages) {
			// set current page to last page
			$currentpage = $totalpages;
		} // end if
		// if current page is less than first page...
		if ($currentpage < 1) {
			// set current page to first page
			$currentpage = 1;
		} // end if


		// the offset of the list, based on current page
		$offset = ($currentpage - 1) * $rowsperpage;


		// get the info from the db
		$sql = 'SELECT * FROM `'.$view_name.'` WHERE  retailer_id = '.$retailer_id;

		$result = $conn->query($sql);



}else{ //==If its NOT a SEARCH

	$_SESSION["Category"] = $_GET['Category'];
	$_SESSION["Cat_level"] = $_GET['Cat_level'];

	$Category = $_GET['Category'];
	$Cat_level = $_GET['Cat_level'];


	//GET ALL CHILD CATEGORIES BELONGING TO THE SELECTED LEVEL ONE CATEGORY (TO THE LAST LEVEL ie-level4)
	//An array to hold all child and sub children of the selected level 1 category
	$Categories = array();
	if(isset($_GET['Cat_level']) && $_GET['Cat_level'] == 1){
		//get the level 1 id selected.
		$parentID=$_GET['Category'];
		$sql = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
			b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
			FROM category a, category b  
			WHERE a.parent_id = b.category_ID and b.category_ID='.$parentID;
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i=0;
			while($row = $result->fetch_assoc()) {
				$Categories[] = $row["CAT_ID"];

				$sql1 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
					b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
					FROM category a, category b  
					WHERE a.parent_id = b.category_ID and b.category_ID='.$row["CAT_ID"];
				$result1 = $conn->query($sql1);
				if ($result1->num_rows > 0) {
					while($row1 = $result1->fetch_assoc()) {

						$Categories[] = $row1["CAT_ID"];

						$sql2 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
							b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
							FROM category a, category b  
							WHERE a.parent_id = b.category_ID and b.category_ID='.$row1["CAT_ID"];
						$result2 = $conn->query($sql2);
						if ($result2->num_rows > 0) {
							while($row2 = $result2->fetch_assoc()) {

								$Categories[] = $row2["CAT_ID"];
							}
						}
					}
				}
			}

		} else {
			//do nothing
		}

	}else{

		$Categories[] = $_GET['Category'];

		$sql1 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
			b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
			FROM category a, category b  
			WHERE a.parent_id = b.category_ID and b.category_ID='.$_GET['Category'];
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {

				$Categories[] = $row1["CAT_ID"];

				$sql2 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
					b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
					FROM category a, category b  
					WHERE a.parent_id = b.category_ID and b.category_ID='.$row1["CAT_ID"];
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0) {
					while($row2 = $result2->fetch_assoc()) {

						$Categories[] = $row2["CAT_ID"];
					}
				}
			}
		}

	}
	$child_categories_ids = "'".join("','",$Categories)."'";



	if(isset($_GET['Off_Re'])){

		// Set session variables
		$_SESSION["Category_Status"] = "Categorised";
		$Category_Status = $_SESSION["Category_Status"];

		// find out how many rows are in the table
		$sql_count = 'SELECT count(*) as numrows FROM `'.$view_name.'` WHERE  and  category IN('.$child_categories_ids.')';
		$result9 = $conn->query($sql_count);
		if($result9){
            $data = $result9->fetch_assoc();
            $numrows = $data['numrows'];
        }
		// $numrows = $result9->num_rows;


		// number of rows to show per page
		$rowsperpage = 10;

		// find out total pages
		$totalpages = ceil($numrows / $rowsperpage);


		// get the current page or set a default
		if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
			// cast var as int
			$currentpage = (int) $_GET['currentpage'];
		} else {
			// default page num
			$currentpage = 1;
		} // end if


		// if current page is greater than total pages...
		if ($currentpage > $totalpages) {
			// set current page to last page
			$currentpage = $totalpages;
		} // end if
		// if current page is less than first page...
		if ($currentpage < 1) {
			// set current page to first page
			$currentpage = 1;
		} // end if


		// the offset of the list, based on current page
		$offset = ($currentpage - 1) * $rowsperpage;


		// get the info from the db
		$sql = 'SELECT * FROM `'.$view_name.'` WHERE  category IN('.$child_categories_ids.') ';

		$result = $conn->query($sql);



	}


}


$Cat_lev1_sql = 'SELECT * FROM category WHERE level = 1';
$Cat_lev1_result = $conn->query($Cat_lev1_sql);

//Collect the reason codes from the database to make available for tagging products
$Reason_Code_sql = 'SELECT * FROM `reason_codes`';
$Reason_Code_result = $conn->query($Reason_Code_sql);

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
	<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2.css" />
	<link rel="stylesheet" href="assets/plugins/lightbox2/css/lightbox.css">
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
				<div class="modal fade bs-example-modal-sm" id="Levels_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm" style="width: 335px;">
						<div class="modal-content">
							<div class="modal-header"style="background-color:#428BCA; color: #FFF; text-align: center;">
								<!--button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button-->

								<p id="Cat_change_modal_lable" class="modal-title" ></p>
							</div>
							<div class="modal-body">
								<center><font color="red"><span>Set Product to a level </span><span id="Drill_Level">0</span><span> Category</span></font></center>
								<input type="hidden" value="" id="p_ID"/>
								<p>
								<div class="form-group">
									<label for="lev1">
										Level 1
									</label>
									<select id="lev1" class="form-control" onchange="get_cat_lev_2(this); $('#Drill_Level').html(1); ">
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
									<label for="lev2">
										Level 2
									</label>
									<select id="lev2" class="form-control"  onchange="get_cat_lev_3(this); $('#Drill_Level').html(2); ">
										<option value="">&nbsp;</option>
									</select>
									<label for="lev3">
										Level 3
									</label>
									<select id="lev3" class="form-control"  onchange="get_cat_lev_4(this); $('#Drill_Level').html(3); ">
										<option value="">&nbsp;</option>
									</select>
									<label for="lev4">
										Level 4
									</label>
									<select id="lev4" class="form-control" onchange="$('#Drill_Level').html(4); ">
										<option value="">&nbsp;</option>
									</select>

								</div>
								</p>
							</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-md-6">
										<button data-dismiss="modal" id="closeLevModal" class="btn btn-default" style="width: 123px;" type="button">Close</button>
									</div>
									<div class="col-md-6">
										<button class="btn btn-primary"  id="UpdateLev" style="width: 123px;" type="button">Update</button>
									</div>

								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
				</div>
				<!--end start modal -->

				<!--start modal -->
				<div class="modal fade ReasonCode-modal-sm" id="ReasonCode_modal" tabindex="-1" role="dialog" aria-labelledby="ReasonCodeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-sm" style="width: 335px;">
						<div class="modal-content">
							<div class="modal-header"style="background-color:#428BCA; color: #FFF; text-align: center;">
								<!--button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button-->

								<p id="Cat_change_modal_lable" class="modal-title" ></p>
							</div>
							<div class="modal-body">
								<center><font color="red">Tag Product With Reason Code</font></center>
								<input type="hidden" value="" id="P_to_tag_ID"/>
								<p>
								<div class="form-group">
									<label for="ReasonCode">
										Select Reason Code
									</label>
									<select id="ReasonCode" class="form-control" onchange="">
										<option selected disabled value="">Reason Code</option>
										<?php
										if ($Reason_Code_result->num_rows > 0) {
											while($Reason_Code_row = $Reason_Code_result->fetch_assoc()) {
												?>
												<option value="<?php echo $Reason_Code_row['reason_code']; ?>"><?php echo $Reason_Code_row['reason_code']; ?></option>
												<?php
											}}
										?>
									</select>
								</div>
								</p>
							</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-md-6">
										<button data-dismiss="modal" id="closeReasonCodeModal" class="btn btn-default" style="width: 123px;" type="button">Close</button>
									</div>
									<div class="col-md-6">
										<button class="btn btn-primary"  id="setReasonCode" style="width: 123px;" type="button">Tag Product</button>
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
								<h1 class="panel-title"style = "font-size: 20px;">Merchants Data<?php if(isset($_GET['Categorised'])){echo " - Categorised";}elseif(isset($_GET['Uncategorised'])){echo " - Uncategorised";}?></h1>
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
								<table class="table table-striped table-bordered table-hovered table-full-width" id="sample_1">
									<thead>
									<tr>
<!--										<th width="9%">Item Image</th>-->
										<th width="25%">Item Name</th>
										<th width="25%">Url</th>
										<th width="12%">Price</th>
										<th>Model No.</th>
										<th>Category</th>
										<?php if(isset($_GET['Tagged'])){?>
											<th>Reason Code</th>
										<?php }?>
										<?php if(isset($_GET['Uncategorised'])){?>
											<th width="10%">Edit</th>
										<?php }else{?>
											<th width="10%">Check SC</th>
										<?php }?>
									</tr>
									</thead>
									<tbody>
									<?php
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {

											?>
											<tr class="">

<!--												<td>--><?php //if(!empty($row["image"])){
//														echo '<a class="thumb-info" href="data:image;base64,'.$row["image"].' " data-lightbox="gallery" data-title="'.$row["product_name"].'">
//																<img src="data:image;base64,'.$row["image"].' " class="img-responsive" alt="" height="50" width="50">
//																<span class="thumb-info-title"></span>
//															</a>';
//													}else{
//														//echo '<img src="" height="50" width="50">';
//													} ?><!--</td>-->
												<td><?php echo $row["name"];?></td>
												<td><a href="<?php echo $row['url'];?>" target="blank"><?php echo $row["url"];?></a></td>
												<td  style="cursor:pointer;">
													<label for="price" class="control-label"  >
														<p class="text-info" ><?php echo $row["price"];?></p>
													</label>
													<input type="text" class="price-edit-input" style="display:none;width: 100px;" value="<?php echo $row['price'];?>"  />
													<img src="assets/images/loading.gif"  style="width:10px; height: 10px; display:none;">
													<span class="product_id" style="display:none;"><?php echo $row["product_ID"];?></span>
												</td>
												<td><?php echo $row["model_number"];?></td>
												<td><?php echo $row["cat_name"];?></td>
												<?php if(isset($_GET['Tagged'])){?>
													<td><?php echo $row["sc_status"];?></td>
												<?php }?>
												<td class="center">
													<div class="visible-md visible-lg hidden-sm hidden-xs">

														<a href="#" class="btn btn-xs btn-red tooltips" style="width:30px; height: 20px;" data-placement="top" data-original-title="Categorize" data-target=".bs-example-modal-sm" data-toggle="modal" onclick="set_levels(<?php echo $row["category"];?>); $('#p_ID').val('<?php echo $row["product_ID"];?>'); set_row(this)"><i class="fa fa-puzzle-piece"></i></a>

														<a href="check_sc.php?rpid=<?php echo urlencode($row["product_ID"]);?>" class="btn btn-xs btn-green tooltips" style="width:30px; height: 20px;" onclick=""><i class="fa fa-save"></i></a>

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
							<div class="row">
								<div class="col-md-6">
									<div class="pull-left">
										<?php if(isset($numrows)){echo $numrows." Products";}?>
									</div>
								</div>
								<div class="col-md-6">
									
								</div>

							</div>

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
<?php include("include/footer.php"); ?>
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
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script>
<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="assets/plugins/jQuery/jquery-2.1.1.min.js"></script>
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
<script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="assets/js/table-data.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="assets/plugins/mixitup/src/jquery.mixitup.js"></script>
<script src="assets/plugins/lightbox2/js/lightbox.min.js"></script>
<!-- start: CORE JAVASCRIPTS  -->
<script src="assets/js/main.js"></script>
<!-- end: CORE JAVASCRIPTS  -->
<script>
	jQuery(document).ready(function() {
		Main.init();
		SVExamples.init();
		TableData.init();
	});

	//GLOBAL row variable- will be set to the current row being edited
	var row;


	function get_cat_lev_2(ele){
		var Cat_Lev_1 = $(ele).val();
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

	var Fill_lev3_timer;
	var Fill_lev4_timer;
	var Set_lev4_timer;

	function testAPI(){
		alert('rr');
		$.ajax({
			url: 'api.php',
			type: 'GET',
			data:{},
			success:function(data){
				alert(data);
				console.log(data);
			},
			error:function() {
				alert('no');
			}
		});
	}
	//testAPI();


	function set_levels(cat){
		$.ajax({
			url: 'include/get_parent_level_cat.php',
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

	function clear_all_Intervals(){
		clearInterval(Fill_lev3_timer);
		clearInterval(Fill_lev4_timer);
		clearInterval(Set_lev4_timer);
	}

	function set_row(ele){ //set the row variable above to the row of the current product row being edited
		row = $(ele).closest('tr');
	}


	$("#closeLevModal").click(function() {
		clear_all_Intervals()
	});
	$("#UpdateLev").click(function() {
		clear_all_Intervals();
		$("#UpdateLev").prop('disabled',true);
		var cat_level = $('#Drill_Level').text();
		var L1 = $('#lev1').val();
		var L2 = $('#lev2').val();
		var L3 = $('#lev3').val();
		var L4 = $('#lev4').val();
		var p_ID = $('#p_ID').val();

		//alert(p_ID);
		$.ajax({
			url: 'include/update_retailer_product_category.php',
			type: 'POST',
			data: {Cat_level:cat_level,Level1:L1,Level2:L2,Level3:L3,Level4:L4,pID:p_ID},
			success:function(data){
				//alert(data);
				$('#Levels_modal').modal('hide');
				//row.remove();
				$("#UpdateLev").prop('disabled',false);
			},
			error:function() {
				alert('Category Update Failed!!.');
				$("#UpdateLev").prop('disabled',false);
			}
		});
	});

	//display item processed message
	var ups = $('#processed').val();
	if(ups){

		$("#Upload_div").show().delay(2000).fadeOut();
	}



	//Process the tagging of product with reason code
	$("#setReasonCode").click(function() {
		clear_all_Intervals();
		$("#setReasonCode").prop('disabled',true);
		var P_to_tag_ID = $('#P_to_tag_ID').val();
		var reason = $('#ReasonCode').val();

		$.ajax({
			url: 'include/tag_product_with_reason_code.php',
			type: 'POST',
			data: {pID:P_to_tag_ID,reason:reason},
			success:function(data){
				//alert(data);
				$('#ReasonCode_modal').modal('hide');
				row.remove();
				$("#setReasonCode").prop('disabled',false);
			},
			error:function() {
				alert('Unable to tag Product!!');
				$("#setReasonCode").prop('disabled',false);
			}
		});
	});



	function StartPriceEdit(ele){
		//var dad = $(ele).parent().parent();
		var dad = $(ele);
		var Oprice = $.trim(dad.find('label').find('p').html());
		dad.find('label').hide();

		dad.find('input[type="text"]').val(Oprice).show().focus();
	}

	function ProcessPriceChange(ele){
		var dad = $(ele).parent();
		var prod_ID = dad.find('.product_id').html();
		var price = $(ele).val();

		var loading = dad.find('img');
		loading.show();

		if(price==""){price = 0;}

		$.ajax({
			url: 'include/update_product_price.php',
			type: 'POST',
			data: {Product_ID:prod_ID,Price:price},
			success:function(data){
				//alert(data);

				$(ele).hide();
				dad.find('label').find('p').html(price);
				dad.find('label').show();
				$(ele).val('');
				loading.hide();
			},
			error:function() {
				alert('no');
			}
		});

	}

	$('.price-edit-input').keypress(function(e){
		if(e.which == 13){
			$(this).blur();
		}
	});


</script>
</body>
<!-- end: BODY -->
</html>

<?php
include('connections/db_close_connect.php');//close the connection to the database
?>																																	