<?php
include('../connections/db_connect.php');//connect to the database
require '../include/header.php'; 
require '../utilities/Category.php'; 

$LIST_PRODUCTS="";
	// CORS enablement
	/*
	// set up request for access token
		$data = array(
		'client_id'=>"rC3BTCmZBGyjbUVnQmh4KbKGN5wTPosL9jShl7uk",
		'client_secret'=>"YGmDUukH4dzRYYuujio7SXbPnCWFx2YDhoub1HN4m2xZUSwPGBn9ZIhmAjoMP8XUVnPOPhx14jN3iikpMlnxJuShcMzNLOsEaRGE4sfxMO824xTSNogehREcRirANklo",
		'grant_type'=>"password",
		'username'=>"pxdm",
		'password'=>"7936_Pxd$*M"
		);
	
		// $request     = "138.68.135.191:8080/o/token/";
		// $request     = "http://138.68.135.191:8080/o/token/";
		$request     = "https://api.pricedrummer.com.gh/o/token/";
		// $request         = "http://pricedrummer.com.gh/o/token/";
		$ch             = curl_init($request);
		curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_POSTFIELDS => $data
		));
		$response = curl_exec($ch);
		curl_close($ch);
		// Check for errors
		if ($response === FALSE) {
			die(curl_error($ch));
		}
		// Decode the response
		$responseData = json_decode($response, TRUE);
		$access_token = $responseData["access_token"];
	
		
		//collect the category level one details
		//set the header token
		$headers = array('Authorization: Bearer ' . $access_token);
		//category level 1 url
		$url = "https://api.pricedrummer.com.gh/categories/?level=1&limit=1000";
	
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_SSL_VERIFYPEER => FALSE,
		CURLOPT_HTTPHEADER => $headers
		));
		$response = curl_exec($ch);
		curl_close($ch);
		 // Decode the response
		$responseData = json_decode($response, TRUE);
	
		$Category_Level_1 = $responseData['results'];
	*/
	// $url = "https://api.pricedrummer.com.gh/categories/?level=1&limit=1000";
	$url = "http://gh.pricedrummer.com/api/lev1n2n3n4.php";
	
	$curl_channel = curl_init();
	curl_setopt($curl_channel, CURLOPT_URL, $url);
	//curl_setopt($curl_channel, CURLOPT_PROXY, $proxy);
	curl_setopt($curl_channel, CURLOPT_HEADER, FALSE);
	curl_setopt($curl_channel, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl_channel, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($curl_channel, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl_channel, CURLOPT_HTTPPROXYTUNNEL, 1);
	curl_setopt($curl_channel, CURLOPT_CONNECTTIMEOUT, 0);
	
	$result['EXE'] = curl_exec($curl_channel);
	$result['INF'] = curl_getinfo($curl_channel);
	$result['ERR'] = curl_error($curl_channel);
	
	
	curl_close($curl_channel);
	
	if(empty($result['ERR'])){

// echo $result['EXE'];
		$Categories = json_decode($result['EXE'], TRUE);
		
	}else{
		echo $result['ERR'];
	}

	$retailer_delevery_sql = 'SELECT * FROM `retailer_delevery`';
	$retailer_delevery_result = $conn->query($retailer_delevery_sql);

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<nav class="col-md-1 col-lg-1">
				<?php include '../include/dashboard_navigation.php'; ?>
			</nav> <!-- end navigation -->
			
			<div class="col-md-11 col-lg-11" style="margin-left: -45px;">
				<div class="col-md-12 col-lg-12" id="CategoriesSelection" >
					
					<div class="col-md-3 col-lg-3">
						<div class="cat-wrapper">
							<div class="cat-header">
								<h3>Select a category</h3>
							</div>
							<div class="cat-body">
								<ul id="Categories_level_1">
									<?php foreach( $Categories as $Level1 ):  ?>
										<li>
											<a href="javascript:void(0);" class="l1" onclick="setLevel2(this,'<?php echo $Level1['name']; ?>','<?php echo $Level1['category_ID']; ?>');">
                                            <?php echo $Level1['name']; ?>
                                            <i class="fa fa-angle-right fa-2x pull-right"></i></a>
											<div class="has-sub">
												<ul id="Categories_level_2">
													<?php foreach( $Level1['lev2s'] as  $level2): ?>
														<li>
															<a href="javascript:void(0);" class="l2" onclick="setLevel3(this,'<?php echo $level2['name']; ?>','<?php echo $level2['category_id']; ?>');">
																<?php echo $level2['name']; ?>
																<?php if(count($level2['lev3s'])>0){ ?> <i class="fa fa-angle-right fa-2x pull-right"></i> <?php }?>
															</a>
															</a>
															<div class="has-sub">
																<ul id="Categories_level_3">
																	<?php foreach($level2['lev3s'] as  $level3): ?>
																		<li>
																			<a href="javascript:void(0);" class="l3" 
                                                                                onclick="setLevel4(this,'<?php echo $level3['name']; ?>','<?php echo $level3['category_id']; ?>'); <?php if(count($level3['lev4s'])<1){
                                                                                	echo"ShowForm(".$level3['category_id'].",this,3);";
                                                                                	echo"$('#Current_Category').val(".$level3['category_id'].");";
                                                                                	}
                                                                                	?> ">
																				<?php echo $level3['name']; ?>
																				<?php if(count($level3['lev4s'])>0){ ?> <i class="fa fa-angle-right fa-2x pull-right"></i> <?php }?>
																			</a>
																			<div class="has-sub">
																				<ul id="Categories_level_4">
																					<?php foreach( $level3['lev4s'] as  $level4): ?>
																						<li>
																							<a href="javascript:void(0);" class="l4" onclick="ShowForm(<?php echo $level4['category_id']; ?>,this,4); $('#Current_Category').val(<?php echo $level4['category_id']; ?>)">
																								<?php echo $level4['name']; ?>
																							</a>
																						</li>
																					<?php endforeach; ?>
																				</ul>
																			</div>
																		</li>
																	<?php endforeach; ?>
																</ul>
															</div>
														</li>
													<?php endforeach; ?>
												</ul>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-lg-3">
						<div class="cat-wrapper hidden">
							<div class="cat-header">
								<h3>Select a subcategory</h3>
							</div>
							<div class="cat-body" id="has-sub2"></div>
						</div>
					</div>
					
					<div class="col-md-3 col-lg-3">
						<div class="cat-wrapper hidden">
							<div class="cat-header">
								<h3>Select a subcategory</h3>
							</div>
							<div class="cat-body" id="has-sub3"></div>
						</div>
					</div>
					
					<div class="col-md-3 col-lg-3">
						<div class="cat-wrapper hidden">
							<div class="cat-header">
								<h3>Select a subcategory</h3>
							</div>
							<div class="cat-body" id="has-sub4"></div>
						</div>
					</div>
				
				</div>






                <input type="hidden" value="<?php if(isset($_GET['cid'])){echo $_GET['cid'];} ?>" id="SelectedCategory">





<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="prod-wrapper hidden" id="AddProductForm">
						<div class="col-md-12">
							<p id="Category_Links">
								<!-- <a href="#">Electronics &amp; Computers</a> &rarr;
								<a href="#">Mobile Phones</a> &rarr;
								<a href="#">Category 3</a> &rarr;
								<span>Category 4</span> &rarr;
								<a href="javascript:void(0);" onclick="ShowCategores();">Change</a> -->
							</p>
						</div>
						<div class="row">
							<div class="col-md-9 col-lg-9">
								<div class="prod-header">
									<h3>Add a Product</h3>
								</div>
							</div>
						</div>
						<div class="prod-body">
							<div class="row">
								<form action="../include/add_products.php" method="post" enctype="multipart/form-data" id="Retailer_Products_Form">
									<div class="col-lg-4 col-md-4">
<!--										<div class="input-wrapper">-->
<!--											<label class="input-label" for="sku">Model No.-->
<!--												<i class="important">*</i>-->
<!--												<span class="numbering pull-right">1</span>-->
<!--											</label>-->
<!--											<!-- <i class="fa fa-search pull-right"></i> -->
<!--											<input class="input required" type="text" id="sku" name="sku" value=""-->
<!--											       placeholder="SPH-L720">-->
<!--											<span class="tip">Example: SPH-L720.</span>-->
<!--										</div>-->
                                        <div class="input-wrapper">
                                            <label class="input-label" for="product_name">Product Name <i
                                                        class="important">*</i></label>
                                            <input class="input required" type="text" id="product_name" value="<?php if(isset($Product['name'])){echo $Product['name'];} ?>" name="product_name"
                                                   placeholder="">
                                            <span class="tip">Example: Samsung Galaxy S6 Plus.</span>
                                        </div>
									</div>
									
									<div class="col-md-4 col-lg-4">
										<div class="input-wrapper">
											<label class="input-label" for="manufacturer">Manufacturer
												<i class="important">*</i>
												<span class="numbering pull-right">2</span>
											</label>
											<input class="input required" type="text" id="manufacturer" value=""
											       name="manufacturer"
											       placeholder="Samsung">
											<span class="tip">Example: Apple.</span>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-4">
										<div class="input-wrapper">
											<label class="input-label" for="model_name">Model Number
												<i class="important">*</i>
												<span class="numbering pull-right">3</span>
											</label>
											<input class="input required" type="text" id="model_name" value="" name="model_name"
											       placeholder="model number">
											<span class="tip">Example: GT5300.</span>
										</div>
									</div>
									
									<div class="col-lg-8 col-md-8">

										<div class="input-wrapper">
											<label class="input-label" for="description">Description
												<span class="numbering pull-right">4</span>
											</label>
											<textarea id="description" class="desc-box" name="description"></textarea>
											<span class="tip">This is important for non-comparison products like jewelry, toys, clothing.</span>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-4">
										<!--<div class="input-wrapper image-wrapper" id="main-preview">
											<img src="assets/images/delete.png" alt="delete icon" class="img-close hidden">
											<input type="file" id="main-image" name="main_image" accept="image/*" >

											<label class="input-label" for="main-image" id="main-label">
												<i class="fa fa-image fa-3x"></i> Upload an image</label>
										</div>-->

										<div class="input-wrapper">

											<input id="product_main_image" name="main_image" type="file" class="file" data-preview-file-type="image" accept=".png,.jpg">

										</div>

										<div class="input-wrapper">
											<label class="input-label" for="image_url">Graphic URL <i
														class="important"></i></label>
											<input class="input" type="text" id="image_url" name="image_url"
											       placeholder="http://www.domain.com/product-url">
											<span class="tip">Required: Non-comparison categories eg; cloths.</span>
										</div>
									</div>
									
									<div class="">
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="price">Product Price
													<i class="important">*</i>
													<span class="numbering pull-right">5</span>
												</label>
												<input class="input required" onfocus="numberOnly(this);" onmouseenter="numberOnly(this);" onkeydown="numberOnly(this);" type="text" id="price" name="price" value="" placeholder="">
												<span
														class="tip">Product price (including VAT).</span>
											</div>
										</div>
										
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="availability">Availability
													<i class="important">*</i>
													<span class="numbering pull-right">6</span>
												</label>
												<select name="availability" id="availability" class="availability required">
													<option value="">Select an option</option>
													<option value="1">In stock</option>
													<option value="0">Out of stock</option>
												</select>
												<span class="tip">“In stock” or “out of stock”.</span>
											</div>
										</div>
										
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="model_name">Delivery Time
													<i class="important">*</i>
													<span class="numbering pull-right">7</span>
												</label>
												<select name="delivery_time" id="delivery_time" class="required">
													<option value="">Select an option</option>
													<?php
														if ($retailer_delevery_result->num_rows > 0) {
															while($row = $retailer_delevery_result->fetch_assoc()) {
																?>
																<option value="<?php echo $row['id']; ?>"><?php echo $row['delevery_details']; ?></option>
																<?php
															}}
													?>
												</select>
												<span class="tip">Example: Delivers 2-3 days.</span>
											</div>
										</div>
										
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="delivery_cost">Delivery Cost
													<span class="numbering pull-right">8</span>
												</label>
												<input class="input" onfocus="numberOnly(this);" onmouseenter="numberOnly(this);" onkeydown="numberOnly(this);"  type="text" id="delivery_cost" name="delivery_cost" placeholder="">
												<span class="tip">Delivery cost for product.</span>
											</div>
										</div>
									</div> <!-- end col-md-12 div -->
									
									<div class="">
										<div class="col-md-12 col-lg-12">
											<h4>Have more pictures to upload?</h4>
										</div>
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											<div class="input-wrapper " >
												<input id="product_main_image1" name="other_image1" type="file" class="file" data-preview-file-type="image" accept=".png,.jpg">
											</div>
										</div>
										
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											<div class="input-wrapper">
												<input id="product_main_image2" name="other_image2" type="file" class="file" data-preview-file-type="image" accept=".png,.jpg">
											</div>
										</div>
										
										<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
											<div class="input-wrapper ">
												<input id="product_main_image3" name="other_image3" type="file" class="file" data-preview-file-type="image" accept=".png,.jpg">
											</div>
										</div>
									
									</div> <!-- end 2nd col-md-12 div -->
									<input type="hidden" name="retailer_id" id="retailer_id" value="<?php if(isset($_SESSION['retailer_user_id'])){ echo $_SESSION['retailer_user_id']; } ?>"/>
									<input type="hidden" name="Current_category_id" id="Current_Category" value="<?php if(isset($_GET['cid'])){echo $_GET['cid'];} ?>"/>
									<input type="hidden" name="category_drill" id="category_drill" value="<?php if(isset($_GET['cdrill'])){echo urldecode($_GET['cdrill']);} ?>"/>
									
									<div class="col-lg-12 col-md-12">
										<input type="submit" id="submit" name="submit" value="Submit"
										       class="form-btn">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require '../include/scripts.php'; ?>
<script type="text/javascript">
	
//================================================================================//
//================================ ADD PRODUCT PAGE =============================//
//==============================================================================//

Re_GenerateCatLinks();

	function initialize_image_input(input_id) {
		$("#"+input_id).fileinput({
			'showUpload':false,
			'maxFileSize':2000,
			'allowedFileTypes':['image'],
			'allowedFileExtensions':['jpg', 'png'],
			'allowedPreviewTypes':['image'],
			'previewFileType':'image'
		});
	}

	initialize_image_input('product_main_image');
	initialize_image_input('product_main_image1');
	initialize_image_input('product_main_image2');
	initialize_image_input('product_main_image3');

</script>
<?php require '../include/footer.php'; ?>

