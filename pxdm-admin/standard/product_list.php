<?php
	//CHECK IF USER IS LOGED IN --> Also Contain SESSION START
	include('../include/check_user_login.php');//check if user is logged in
	
	require_once('../connections/db_connect.php');//connect to the database
	require_once('../connections/db_connect_sc.php');//connect to the database
	
	if(isset($_GET['Category']) && isset($_GET['Cat_level'])){
		
		
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
			$result = $conn_sc->query($sql);
			
			if ($result->num_rows > 0) {
				$i=0;
				while($row = $result->fetch_assoc()) {
					$Categories[] = $row["CAT_ID"];
					
					$sql1 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
					b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
					FROM category a, category b  
					WHERE a.parent_id = b.category_ID and b.category_ID='.$row["CAT_ID"];
					$result1 = $conn_sc->query($sql1);
					if ($result1->num_rows > 0) {
						while($row1 = $result1->fetch_assoc()) {
							
							$Categories[] = $row1["CAT_ID"];
							
							$sql2 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
							b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
							FROM category a, category b  
							WHERE a.parent_id = b.category_ID and b.category_ID='.$row1["CAT_ID"];
							$result2 = $conn_sc->query($sql2);
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
			$result1 = $conn_sc->query($sql1);
			if ($result1->num_rows > 0) {
				while($row1 = $result1->fetch_assoc()) {
					
					$Categories[] = $row1["CAT_ID"];
					
					$sql2 = 'SELECT a.category_ID AS "CAT_ID",a.name AS "CAT Name",  
					b.category_ID AS "PARENT ID",b.name AS "PARENT CAT Name"  
					FROM category a, category b  
					WHERE a.parent_id = b.category_ID and b.category_ID='.$row1["CAT_ID"];
					$result2 = $conn_sc->query($sql2);
					if ($result2->num_rows > 0) {
						while($row2 = $result2->fetch_assoc()) {
							
							$Categories[] = $row2["CAT_ID"];
						}
					}
				}
			}
			
			
		}
		
		$child_categories_ids = "'".join("','",$Categories)."'"; 
	
		// find out how many rows are in the table 
		$sql_count = "SELECT count(*) as numrows FROM `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` WHERE `sc`.`status` <>'DELETED' and `sc`.`status` <>'RECHECK' AND `sc`.`category_ID`IN(".$child_categories_ids.")";
		$result9 = $conn_sc->query($sql_count);
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
		/*
			Since we have our list of 106 rows, and we want to only grab 10 specific rows of our target page, we need to find the "offset." That is, for example, page 8 is not going to start at the top of the list. It's going to start on row 80. Actually, it's going to start on row 70, since computers like to start counting at zero, not one. So we take our current page (let's say page 8), subtract 1 from it, and then multiply by our rows per page (10). Again, computers start at zero, so:
			
			page 1 of our list will be rows 0-9.
			page 2 of our list will be rows 10-19.
		*/
		$offset = ($currentpage - 1) * $rowsperpage;
		
		
		// get the info from the db 
		$sql = "SELECT`sc`.*,`category`.`name`,(select image_ID from sc_images where product_ID= sc_ID limit 1)as image_ID,`category`.`category_ID` FROM `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` WHERE `sc`.`status` <>'DELETED' and `sc`.`status` <>'RECHECK' AND `sc`.`category_ID`IN(".$child_categories_ids.") LIMIT $offset, $rowsperpage";
		$result = $conn_sc->query($sql);

		if(isset($_GET['quality_check'])){
			// find out how many rows are in the table
			$sql_count = "SELECT count(*) as numrows FROM `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` WHERE `sc`.`status` <>'DELETED' and `sc`.`status` <>'RECHECK' AND  `sc`.`added_by_crawler` <> 0 AND `sc`.`category_ID`IN(".$child_categories_ids.")";
			$result9 = $conn_sc->query($sql_count);
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
			/*
                Since we have our list of 106 rows, and we want to only grab 10 specific rows of our target page, we need to find the "offset." That is, for example, page 8 is not going to start at the top of the list. It's going to start on row 80. Actually, it's going to start on row 70, since computers like to start counting at zero, not one. So we take our current page (let's say page 8), subtract 1 from it, and then multiply by our rows per page (10). Again, computers start at zero, so:

                page 1 of our list will be rows 0-9.
                page 2 of our list will be rows 10-19.
            */
			$offset = ($currentpage - 1) * $rowsperpage;


			// get the info from the db
			$sql = "SELECT`sc`.*,`category`.`name`,(select image_ID from sc_images where product_ID= sc_ID limit 1)as image_ID,`category`.`category_ID` FROM `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` WHERE `sc`.`status` <>'DELETED' and `sc`.`status` <>'RECHECK'  AND  `sc`.`added_by_crawler` <> 0 AND `sc`.`category_ID`IN(".$child_categories_ids.") ORDER BY `sc`.`posted_timestamp` DESC LIMIT $offset, $rowsperpage";
			$result = $conn_sc->query($sql);
		}
		
		
		}elseif(isset($_GET['Find_Duplicate']) && isset($_GET['Search'])){ //but the search parameter will not be used
		//======WHEN SEARCH FOR FINDING DUPLICATE RECORDS.======//
		
		if($_GET['Find_Duplicate'] =="byModel_Num"){//===========FIND DUPLICATES BY MODEL NUMBERS
			$Find_Duplicate = "byModel_Num";
			$Search ="";
			// find out how many rows are in the table 
			$sql_count = 'SELECT count(*) as numrows from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>"DELETED" and ( `modal_number`) in ( select `modal_number` from `sc` where `sc`.`status` <>"DELETED" group by `modal_number` having count(*) > 1 and `sc`.`modal_number`<>"") ORDER BY `sc`.`modal_number` ASC';
			$result9 = $conn_sc->query($sql_count);
			if($result9){
            $data = $result9->fetch_assoc();
            $numrows = $data['numrows'];
        	}
			
			// number of rows to show per page
			$rowsperpage = 500;
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
			} 
			$offset = ($currentpage - 1) * $rowsperpage;
			// get the info from the db 
			$sql = "SELECT`sc`.*,`category`.`name`,`category`.`category_ID` from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>'DELETED' and ( `modal_number`) in ( select `modal_number` from `sc` where `sc`.`status` <>'DELETED' group by `modal_number` having count(*) > 1  and `sc`.`modal_number`<>'') ORDER BY `sc`.`modal_number` ASC LIMIT $offset, $rowsperpage";
			$result = $conn_sc->query($sql);
			
			
			}elseif($_GET['Find_Duplicate'] =="byProd_Name"){//===========FIND DUPLICATES BY PRODUCT NAME
			$Find_Duplicate = "byProd_Name";
			$Search ="";
			// find out how many rows are in the table 
			$sql_count = 'SELECT`sc`.*,`category`.`name`,`category`.`category_ID` from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>"DELETED" and ( `product_name` ) in ( select `product_name` from `sc` where `sc`.`status` <>"DELETED" group by `product_name` having count(*) > 1 and `sc`.`product_name`<>"") ';
			$result9 = $conn_sc->query($sql_count);
			$numrows = $result9->num_rows;
			
			// number of rows to show per page
			$rowsperpage = 500;
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
			} 
			$offset = ($currentpage - 1) * $rowsperpage;
			// get the info from the db 
			$sql = "SELECT`sc`.*,`category`.`name`,`category`.`category_ID` from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>'DELETED' and ( `product_name` ) in ( select `product_name` from `sc`  where `sc`.`status` <>'DELETED' group by `product_name` having count(*) > 1 and `sc`.`product_name`<>'') LIMIT $offset, $rowsperpage";
			$result = $conn_sc->query($sql);
			
		}elseif($_GET['Find_Duplicate'] =="With_Model_Num"){//===========SEARCH FOR PRODUCTS WITH MODEL NUMBERS
			$Find_Duplicate = "With_Model_Num";
			$Search ="";
			// find out how many rows are in the table 
			$sql_count = 'SELECT`sc`.*,`category`.`name`,`category`.`category_ID` from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>"DELETED" and `sc`.`modal_number`<>""';
			$result9 = $conn_sc->query($sql_count);
			$numrows = $result9->num_rows;
			
			// number of rows to show per page
			$rowsperpage = 500;
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
			} 
			$offset = ($currentpage - 1) * $rowsperpage;
			// get the info from the db 
			$sql = "SELECT`sc`.*,`category`.`name`,`category`.`category_ID` from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>'DELETED' and `sc`.`modal_number`<>'' LIMIT $offset, $rowsperpage";
			$result = $conn_sc->query($sql);
			
		}elseif($_GET['Find_Duplicate'] =="Without_Model_Num"){//===========SEARCH FOR PRODUCTS WITHOUT MODEL NUMBERS
			$Find_Duplicate = "Without_Model_Num";
			$Search ="";
			// find out how many rows are in the table 
			$sql_count = 'SELECT`sc`.*,`category`.`name`,`category`.`category_ID` from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>"DELETED" and `sc`.`modal_number`=""';
			$result9 = $conn_sc->query($sql_count);
			$numrows = $result9->num_rows;
			
			// number of rows to show per page
			$rowsperpage = 500;
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
			} 
			$offset = ($currentpage - 1) * $rowsperpage;
			// get the info from the db 
			$sql = "SELECT`sc`.*,`category`.`name`,`category`.`category_ID` from `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` where `sc`.`status` <>'DELETED' and `sc`.`modal_number`='' LIMIT $offset, $rowsperpage";
			$result = $conn_sc->query($sql);
			
		}elseif($_GET['Find_Duplicate'] =="MissingSpecs"){//===========SEARCH FOR MISSING SPECS
			$Find_Duplicate = "MissingSpecs";
			$Search ="";
			// find out how many rows are in the table 
			$sql_count = 'SELECT `sc`.* FROM `sc` left join `sc_details` on `sc_details`.`product_ID` = `sc`.`sc_ID` where (`sc_details`.`detail_name` like "Manufacturer" and `sc`.`status` <>"DELETED" and `sc_details`.`details_value` ="") or (`sc_details`.`detail_name` IS NULL) GROUP BY `sc`.`sc_ID`';
			$result9 = $conn_sc->query($sql_count);
			$numrows = $result9->num_rows;
			
			// number of rows to show per page
			$rowsperpage = 500;
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
			} 
			$offset = ($currentpage - 1) * $rowsperpage;
			// get the info from the db 
			$sql = "SELECT `sc`.* FROM `sc` left join `sc_details` on `sc_details`.`product_ID` = `sc`.`sc_ID` where (`sc_details`.`detail_name` like 'Manufacturer' and `sc`.`status` <>'DELETED' and `sc_details`.`details_value` ='') or (`sc_details`.`detail_name` IS NULL) GROUP BY `sc`.`sc_ID` LIMIT $offset, $rowsperpage";
			$result = $conn_sc->query($sql);
		}
		
		
		
		}elseif(isset($_GET['Search']) && !isset($_GET['Find_Duplicate'])){
		$Search = urlencode($_GET['Search']);
		//======WHEN SEARCH PARAMETER IS SENT HERE.======//
		$Search = $conn_sc->real_escape_string($_GET['Search']);
		// find out how many rows are in the table 
		$sql_count = 'SELECT `sc`.`category_ID` FROM `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` WHERE (`sc`.`modal_number` LIKE"%'.$Search.'%" or `sc`.`product_name` LIKE"%'.$Search.'%" or `sc`.`alt_name1` LIKE"%'.$Search.'%" or `sc`.`alt_name2` LIKE"%'.$Search.'%") and (`sc`.`status` <>"DELETED" and `sc`.`status` <>"RECHECK") GROUP BY `sc`.`sc_ID`';
		$result9 = $conn_sc->query($sql_count);
		$numrows = $result9->num_rows;
		
		
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
		/*
			Since we have our list of 106 rows, and we want to only grab 10 specific rows of our target page, we need to find the "offset." That is, for example, page 8 is not going to start at the top of the list. It's going to start on row 80. Actually, it's going to start on row 70, since computers like to start counting at zero, not one. So we take our current page (let's say page 8), subtract 1 from it, and then multiply by our rows per page (10). Again, computers start at zero, so:
			
			page 1 of our list will be rows 0-9.
			page 2 of our list will be rows 10-19.
		*/
		$offset = ($currentpage - 1) * $rowsperpage;
		
		
		// get the info from the db 
		$sql = "SELECT`sc`.*,`category`.`name`,`category`.`category_ID` FROM `sc` left join `category` on `sc`.`category_ID` = `category`.`category_ID` WHERE (`sc`.`modal_number` LIKE'%".$Search."%' or `sc`.`product_name` LIKE'%".$Search."%' or `sc`.`alt_name1` LIKE'%".$Search."%' or `sc`.`alt_name2` LIKE'%".$Search."%') and (`sc`.`status` <>'DELETED' and `sc`.`status` <>'RECHECK') LIMIT $offset, $rowsperpage";
		$result = $conn_sc->query($sql);
		
		
	}	
	
	$Cat_lev1_sql = 'SELECT * FROM category WHERE level = 1';
	$Cat_lev1_result = $conn_sc->query($Cat_lev1_sql);
	
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
						<!-- start: PAGE HEADER -->
						<!-- start: TOOLBAR -->
						
						<!--start modal -->
						<div class="modal fade bs-example-modal-lg" id="Levels_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header"style="background-color:#428BCA; color: #FFF; text-align: center;">
										<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><br/>
										
										<p id="Cat_change_modal_lable" class="modal-title" ></p>
									</div>
									<form id="edit_sc_item_form">
										<input type="hidden" value="" id="P_ID" name="P_ID" />
										<input type="hidden" value="" id="CAT" name="CAT" />
										<div class="modal-body">
											<div class="row">
												<div class="col-md-8" id="Prod_specs">
													
												</div>
												<div class="col-md-4" id="Prod_Image">
													
												</div>
												
											</div>
											
										</div>
									</form>
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
										<h1 class="panel-title"style = "font-size: 20px;">SC PRODUCTS > Electronics and Computers 
											
										</h1>
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
									<?php //print_r($result9);?>
										<div id="Upload_div" align="center" style="display:none"><font color="green"><strong> Product Prcessed Successfully </strong></font></div>
										<?php // echo $result->num_rows; echo'<br/>';?>
										<?php //echo $child_categories_ids ;?>
										<table class="table table-striped datatable table-bordered table-hover table-full-width" id="sample_1">
											<thead>
												<tr>
													<th width="7%">Item Image</th>
													<th width="25%">Item Name</th>
													<th>Model No.</th>
													<th>Category</th>
													<th>View Details</th>
													<th>Delete</th>
													
												</tr>
											</thead>
											<tbody>
												<?php
													if ($result->num_rows > 0) {
														while($row = $result->fetch_assoc()) {
															
														?>
														<tr class="">
															
															<td><?php if(!empty($row["image"])){
																echo '<a class="thumb-info" href="data:image;base64,'.$row["image"].' " data-lightbox="gallery" data-title="'.$row["product_name"].'">
																<img src="data:image;base64,'.$row["image"].' " class="img-responsive" alt="" height="50" width="50">
																<span class="thumb-info-title"></span>
																</a>';
																}else{
																echo '<img src="../../static/product_images/thumbs/'.$row["image_ID"].'.png" style="max-width:50px; max-height:50px;" >';
															} ?></td>
															<td><?php echo $row["product_name"];?></td>
															<td><?php echo $row["modal_number"];?></td>
															<td><?php echo $row["name"];?></td>
															<td class="center">
																<div class="visible-md visible-lg hidden-sm hidden-xs">
																	<a href="#" class="btn btn-xs btn-green tooltips" style="width:40px; height: 25px;"data-placement="top" data-original-title="Edit" data-target=".bs-example-modal-lg" data-toggle="modal" onclick="get_Product_Specs('<?php echo $row["sc_ID"];?>'); $('#P_ID').val(<?php echo $row["sc_ID"];?>); $('#CAT').val(<?php echo $row["category_ID"];?>); ele = this; " ><i class="fa fa-edit"></i></a>
																</div>
															</td>
															<td><a class="btn btn-xs btn-red tooltips pull-right" onclick="delete_prod('<?php echo $row['sc_ID']; ?>',this)" style="width:40px; height: 25px;"><i class="fa fa-trash-o" style="padding-top: 5px;"></i></a></td>
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
									<div class="row">
										<div class="col-md-6">
											<div class="pull-left">
											<?php if(isset($numrows)){echo $numrows." Products";}?>
										</div>
										</div>
										<div class="col-md-6">
											<div class=" pull-right">
												<?php
													
													/******  build the pagination links ******/
													// if not on page 1, don't show back links
													if ($currentpage > 1) {
														// show << link to go back to page 1
														$link = " <a href='{$_SERVER['PHP_SELF']}?";
														if(isset($_GET['Category']) && isset($_GET['Cat_level'])){
															$link .="Category=$Category&Cat_level=$Cat_level";
															}elseif(isset($_GET['Find_Duplicate']) && isset($_GET['Search'])){
															$link .="Find_Duplicate=$Find_Duplicate&Search=$Search";
															}elseif(isset($_GET['Search']) && !isset($_GET['Find_Duplicate']) ){
															$link .="Search=$Search";
														}
														$link .="&currentpage=1' style='width: 30px; height: 30px; padding: 5px; padding-top: 7px;' class='btn btn-default'><i class='fa fa-angle-double-left fa-lg'></i></a> ";
														echo $link;
														// get previous page num
														$prevpage = $currentpage - 1;
														// show < link to go back to 1 page
														$link1 =" <a href='{$_SERVER['PHP_SELF']}?";
														if(isset($_GET['Category']) && isset($_GET['Cat_level'])){
															$link1 .="Category=$Category&Cat_level=$Cat_level";
															}elseif(isset($_GET['Find_Duplicate']) && isset($_GET['Search'])){
															$link1 .="Find_Duplicate=$Find_Duplicate&Search=$Search";
															}elseif(isset($_GET['Search']) && !isset($_GET['Find_Duplicate']) ){
															$link1 .="Search=$Search";
														}
														$link1 .="&currentpage=$prevpage' style='width: 30px; height: 30px; padding: 5px; padding-top: 7px;' class='btn btn-primary'><i class='fa fa-angle-left fa-lg'></i></a> ";
														
														echo $link1;
													} // end if
													
													
													// range of num links to show
													$range = 3;
													
													// loop to show links to range of pages around current page
													for ($x = ($currentpage - $range); $x < (($currentpage + $range)  + 1); $x++) {
														// if it's a valid page number...
														if (($x > 0) && ($x <= $totalpages)) {
															// if we're on current page...
															if ($x == $currentpage) {
																// 'highlight' it but don't make a link
																echo " <p style='width: 30px; height: 30px; padding: 5px;' class='btn btn-danger'>$x</p> ";
																// if not current page...
																} else {
																// make it a link
																$link2 = " <a href='{$_SERVER['PHP_SELF']}?";
																if(isset($_GET['Category']) && isset($_GET['Cat_level'])){
																	$link2 .="Category=$Category&Cat_level=$Cat_level";
																	}elseif(isset($_GET['Find_Duplicate']) && isset($_GET['Search'])){
																	$link2 .="Find_Duplicate=$Find_Duplicate&Search=$Search";
																	}elseif(isset($_GET['Search']) && !isset($_GET['Find_Duplicate']) ){
																	$link2 .="Search=$Search";
																}
																$link2 .="&currentpage=$x' style='width: 30px; height: 30px; padding: 5px;' class='btn btn-primary'>$x</a> ";
																echo $link2 ;
															} // end else
														} // end if 
													} // end for
													
													// if not on last page, show forward and last page links        
													if ($currentpage != $totalpages) {
														// get next page
														$nextpage = $currentpage + 1;
														// echo forward link for next page 
														$link3=" <a href='{$_SERVER['PHP_SELF']}?";
																if(isset($_GET['Category']) && isset($_GET['Cat_level'])){
																	$link3 .="Category=$Category&Cat_level=$Cat_level";
																	}elseif(isset($_GET['Find_Duplicate']) && isset($_GET['Search'])){
																	$link3 .="Find_Duplicate=$Find_Duplicate&Search=$Search";
																	}elseif(isset($_GET['Search']) && !isset($_GET['Find_Duplicate']) ){
																	$link3 .="Search=$Search";
																}
																$link3 .="&currentpage=$nextpage' style='width: 30px; height: 30px; padding: 5px; padding-top: 7px;' class='btn btn-primary'><i class='fa fa-angle-right fa-lg'></i></a> ";
																
																echo $link3;
														
														// echo forward link for lastpage
															$link4 = " <a href='{$_SERVER['PHP_SELF']}?";
																if(isset($_GET['Category']) && isset($_GET['Cat_level'])){
																	$link4 .="Category=$Category&Cat_level=$Cat_level";
																	}elseif(isset($_GET['Find_Duplicate']) && isset($_GET['Search'])){
																	$link4 .="Find_Duplicate=$Find_Duplicate&Search=$Search";
																	}elseif(isset($_GET['Search']) && !isset($_GET['Find_Duplicate']) ){
																	$link4 .="Search=$Search";
																}
																$link4 .="&currentpage=$totalpages' style='width: 30px; height: 30px; padding: 5px; padding-top: 7px;' class='btn btn-default'><i class='fa fa-angle-double-right fa-lg'></i></a> ";
																echo $link4;
													} // end if
													/****** end build pagination links ******/	
												?>
											</div>
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
		
		function get_Product_Specs(product_id){
			
			$.ajax({
				url: 'get_sc_prod_details.php',
				type: 'POST',
				data: {Prod_ID:product_id},
				success:function(data){
					//alert(data);
					$('#Prod_specs').html(data);
				},
				error:function() {
					alert('no');
				}
			});
			$.ajax({
				url: 'get_sc_prod_image.php',
				type: 'POST',
				data: {Prod_ID:product_id},
				success:function(data){
					//alert(data);
					$('#Prod_Image').html(data);
				},
				error:function() {
					alert('no image');
				}
			});
			
		}
		
		function Edit_Product_Specs(product_id,Cat){
			$.ajax({
				url: 'get_edit_form.php',
				type: 'GET',
				data: {Prod_ID:product_id,cat:Cat},
				success:function(data){
					//alert(data);
					$('#Prod_specs').html(data);
				},
				error:function() {
					alert('no');
				}
			});
			/*
				$.ajax({
				url: 'get_sc_prod_image.php',
				type: 'POST',
				data: {Prod_ID:product_id},
				success:function(data){
				//alert(data);
				$('#Prod_Image').html(data);
				},
				error:function() {
				alert('no image');
				}
				});
			*/
			
		}
		
		
		function process_edit(p_id){
			$.ajax('../include/process_sc_item_edit.php', {
				type: 'POST',
				data: $( "#edit_sc_item_form" ).serialize(),
				success:function(data1){
					get_Product_Specs(p_id);
				},
				error:function(jqXHR, textStatus, errorThrown) {
					alert(errorThrown+'   '+textStatus);
				}
			});
		}
		
		function delete_prod(spec_id,ele){
			var row = $(ele).closest('tr');
			var ask_to_delete = confirm('Are you sure you want to delete this Product?');
			if(ask_to_delete==true){
				$.ajax({
					url: '../include/delete_sc_product_and_specs.php',
					type: 'POST',
					data: {spec_id:spec_id},
					success:function(data){
						row.remove();
					},
					error:function() {
						alert('Error Deleting Product');
					}
				});
				
				}else{
				//do nothing
			}
			var product_id = $('#SCProductID').val();
			
		}
		var ele = null;
		function mark_for_review(spec_id){
			var row = $(ele).closest('tr');
			var ask_to_delete = confirm('Are you sure you want to Mark this Product For Review?');
			if(ask_to_delete==true){
				$.ajax({
					url: '../include/mark_sc_prod_for_review.php',
					type: 'POST',
					data: {spec_id:spec_id},
					success:function(data){
						alert('Product Marked For Review Successfully!!');
						$('#Levels_modal').modal('hide');
						row.remove();
						
					},
					error:function() {
						alert('Error Marking Product');
					}
				});
				
				}else{
				//do nothing
			}
			
		}
	</script>
</body>
<!-- end: BODY -->
</html>					

<?php
	include('../connections/db_close_connect.php');//close the connection to the database	
	include('../connections/db_close_connect_sc.php');//close the connection to the database
	?>