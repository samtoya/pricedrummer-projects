<?php 
include('../connections/db_connect.php');//connect to the database
require '../include/header.php'; 
require '../utilities/Category.php'; 

$PRODUCT_OVERVIEW="";
	$url = "https://www.pricedrummer.com.gh/api/lev1n2n3n4.php";
	
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

	if(isset($_GET['Pid'])){
		$product_id = $conn->real_escape_string(urldecode($_GET['Pid']));
	

	$retailer_products_sql = 'SELECT * FROM `retailer_product_list` where `id` ='.$product_id;
	$retailer_products_result = $conn->query($retailer_products_sql);
	
	if($retailer_products_result){
		$Product = $retailer_products_result->fetch_assoc();
		//var_dump($Product);
		//die();
	}

	$retailer_products_images_sql = 'SELECT * FROM `retailer_product_images` where `status`="ACTIVE" and `retailer_product_id` ='.$product_id;
	$retailer_products_images_result = $conn->query($retailer_products_images_sql);

}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<nav class="col-md-1 col-lg-1">
				<?php include '../include/dashboard_navigation.php'; ?>
			</nav> <!-- end navigation -->
			
			<div class="col-md-11 col-lg-11" style="margin-left: -45px;">
				<div class="col-md-12 col-lg-12 hidden" id="CategoriesSelection" >
					
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
					<div class="prod-wrapper " id="EditProductForm">
                    <div class="col-md-12">
                    <p id="Category_Links">

                    </p>
                    </div>
						<div class="row">
							<div class="col-md-9 col-lg-9">
								<div class="prod-header">
									<h3>Edit Product</h3>
								</div>
							</div>
							<div class="col-md-3 col-lg-3 pull-right">
								<a href="javascript:void(0);" class="pull-right" onclick="$('#CategoriesSelection').removeClass('hidden');">Change Category</a>
							</div>
						</div>
						<div class="prod-body">
							<div class="row">
								<form action="../include/edit_products.php" method="post" enctype="multipart/form-data" id="Retailer_Products_Form">
									<div class="col-lg-4 col-md-4">
<!--										<div class="input-wrapper">-->
<!--											<label class="input-label" for="sku">Model<i-->
<!--													class="important">*</i></label>-->
<!--													<!-- <i class="fa fa-search pull-right"></i> -->
<!--											<input class="input required" type="text" id="sku" name="sku" value="--><?php //if(isset($Product['manufacturer_sku'])){echo $Product['manufacturer_sku'];} ?><!--"-->
<!--											       placeholder="SKU-SG001">-->
<!--											<span class="tip">Required for computer items.</span>-->
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
											<label class="input-label" for="manufacturer">Manufacturer <i
													class="important">*</i></label>
											<input class="input required" type="text" id="manufacturer" value="<?php if(isset($Product['manufacturer'])){echo $Product['manufacturer'];} ?>"
											       name="manufacturer"
											       placeholder="Samsung">
											<span class="tip">Example: Apple.</span>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-4">
										<div class="input-wrapper">
											<label class="input-label" for="model_name">Model Name <i
													class="important">*</i></label>
											<input class="input required" type="text" id="model_name" value="<?php if(isset($Product['model_nuber'])){echo $Product['model_nuber'];} ?>" name="model_name"
											       placeholder="Galaxy S7">
											<span class="tip">Example: S6 Plus.</span>
										</div>
									</div>
									
									<div class="col-lg-8 col-md-8">

										<div class="input-wrapper">
											<label class="input-label" for="description">Description <i
													class="important"></i></label>
											<textarea id="description" class="desc-box" name="description"><?php if(isset($Product['description'])){echo $Product['description'];} ?></textarea>
											<span class="tip">This is important for non-comparison products like jewelry, toys, clothing.</span>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-4">
										<?php if(isset($Product['product_image']) && !empty($Product['product_image'])) {
											?><div id="Main_Image_C" class="row">
												<div class="col-md-6">
												<?php
												echo '<center><img src="data:image/jpeg;base64,'.$Product["product_image"].' " style="max-height:160px; max-width:150px;"></center>';
												?>
												<input type="hidden" name="Main_Image_id"  value="<?php if(isset($Product["image_id"])){echo $Product["image_id"];} ?>"/>
												</div>
												<div class="col-md-6">
												<div class="input-wrapper image-wrapper" id="main-preview-edit"> 
													<img src="assets/images/delete.png" alt="delete icon" class="img-close hidden">
													<input type="file" id="main-image-edit" name="main_image" accept="image/*" >
													
													<label class="input-label" for="main-image-edit" id="main-label-edit">
														<i class="fa fa-image fa-3x"></i> Change image</label>
												</div>
												</div></div>
												<?php
											}else{

												?>
													<div class="input-wrapper image-wrapper" id="main-preview"> 
													<img src="assets/images/delete.png" alt="delete icon" class="img-close hidden">
													<input type="file" id="main-image" name="main_image" accept="image/*" >
													
													<label class="input-label" for="main-image" id="main-label">
														<i class="fa fa-image fa-3x"></i> Upload an image</label>
												</div>
												

												<?php
											}
											 ?>
										

										<div class="input-wrapper">
											<label class="input-label" for="image_url">Graphic URL <i
													class="important"></i></label>
											<input class="input" type="text" id="image_url" value="<?php if(isset($Product['graphical_url'])){echo $Product['graphical_url'];} ?>" name="image_url"
											       placeholder="http://www.domain.com/product-url">
											<span class="tip">Required: Non-comparison categories eg; cloths.</span>
										</div>
									</div>
									
									<div class="">
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="price">Product Price <i
														class="important">*</i></label>
												<input class="input required" onfocus="numberOnly(this);" onmouseenter="numberOnly(this);" onkeydown="numberOnly(this);" type="text" id="price" name="price" value="<?php if(isset($Product['price'])){echo $Product['price'];} ?>" placeholder="">
												<span
													class="tip">Product price (including VAT).</span>
											</div>
										</div>
										
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="availability">Availability <i
														class="important">*</i></label>
												<select name="availability" id="availability" class="availability required">
													<option value="">Select an option</option>
													<option <?php if(isset($Product['availability']) && $Product['availability'] ==1){echo "Selected";} ?> value="1">In stock</option>
													<option <?php if(isset($Product['availability']) && $Product['availability'] ==0){echo "Selected";} ?> value="0">Out of stock</option>
												</select>
												<span class="tip">“In stock” or “out of stock”.</span>
											</div>
										</div>
										
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="model_name">Delivery Time <i
														class="important">*</i></label>
												<select name="delivery_time" id="delivery_time" class="required">
													<option value="">Select an option</option>
													<?php
														if ($retailer_delevery_result->num_rows > 0) {
															while($row = $retailer_delevery_result->fetch_assoc()) {
															?>
															<option <?php if(isset($Product['delevery_details']) && trim($Product['delevery_details']) ==trim($row['id'])){echo "Selected";} ?> value="<?php echo $row['id']; ?>"><?php echo $row['delevery_details']; ?></option>
															<?php	
															}}
													?>
												</select>
												<span class="tip">Example: Delivers 2-3 days.</span>
											</div>
										</div>
										
										<div class="col-lg-3 col-md-3">
											<div class="input-wrapper">
												<label class="input-label" for="delivery_cost">Delivery Cost <i
														class="important"></i></label>
												<input class="input" onfocus="numberOnly(this);" onmouseenter="numberOnly(this);" onkeydown="numberOnly(this);"  type="text" id="delivery_cost" name="delivery_cost" value="<?php if(isset($Product['delivery_cost'])){echo $Product['delivery_cost'];} ?>" placeholder="">
												<span class="tip">Delivery cost for product.</span>
											</div>
										</div>
									</div> <!-- end col-md-12 div -->

									<div class="">
										<div class="col-md-12 col-lg-12">
											<h4>Have more pictures to upload?</h4>
										</div>

										
										<?php
										$images = 0;
											if ($retailer_products_images_result->num_rows > 0) {
												$I_no = 0;
												while($Mimage = $retailer_products_images_result->fetch_assoc()) {
													if($I_no == 0){$I_no++;continue;}
													?>
													<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
													<?php
													if(isset($Mimage['image']) && !empty($Mimage['image'])) {
														?>
														<div class="row">
															<div class="col-md-6">
															<?php
															echo '<center><img src="data:image/jpeg;base64,'.$Mimage['image'].' " style="max-height:160px; max-width:150px;"></center>';
														
															?>
															<input type="hidden" name="Other_Image_<?php echo $I_no;?>_id"  value="<?php if(isset($Mimage['id'])){echo $Mimage['id'];} ?>"/>
															</div>
															<div class="col-md-6">
																<div class="input-wrapper image-wrapper" id="preview-<?php echo $I_no;?>">
																	<img src="assets/images/delete.png" alt="delete icon" class="img-close hidden">
																	<input type="file" id="image-<?php echo $I_no;?>" name="other_image<?php echo $I_no;?>" accept="image/*" >
																	
																	<label class="input-label" for="image-<?php echo $I_no;?>" id="label-<?php echo $I_no;?>">
																		<i class="fa fa-image fa-3x"></i> Change image</label>
																</div>
															</div>
														</div>
														<?php	
													}else{
														
													}
													?>
														</div>
													<?php
												$I_no++;
												$images++; }}
												//get the number of images not uploaded
												$un_uploaded_images = 3-$images;
												$i=1;
												while($i<=$un_uploaded_images){
													?><div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
														<div class="input-wrapper image-wrapper" id="preview-<?php echo $i+$images;?>">
																<img src="assets/images/delete.png" alt="delete icon" class="img-close hidden">
																<input type="file" id="image-<?php echo $i+$images;?>" name="other_image<?php echo $i+$images;?>" accept="image/*" >
																
																<label class="input-label" for="image-<?php echo $i+$images;?>" id="label-<?php echo $i+$images;?>">
																	<i class="fa fa-image fa-3x"></i> Upload an image</label>
															</div>
															</div>
														<?php	
														$i++;}
										?>
										

									</div> <!-- end 2nd col-md-12 div -->
									<input type="hidden" name="retailer_id" id="retailer_id" value="<?php if(isset($_SESSION['retailer_user_id'])){ echo $_SESSION['retailer_user_id']; } ?>"/>
									<input type="hidden" name="Current_category_id" id="Current_Category" value="<?php if(isset($Product['category'])){echo $Product['category'];} ?>"/>
									
									<input type="hidden" name="p_id" id="p_id" value="<?php if(isset($_GET['Pid'])){echo urldecode($_GET['Pid']);} ?>"/>
									<input type="hidden" name="url_params_goto" value="<?php if(isset($_GET['sgoto'])){echo urldecode($_GET['sgoto']);} ?>"/>
									
									<input type="hidden" name="category_drill" id="category_drill" value="<?php if(isset($_GET['cdrill'])){echo urldecode($_GET['cdrill']);} ?>"/>

									<div class="col-lg-12 col-md-12">
										<input type="submit" id="submit" name="submit" value="Update Product"
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
	
	function deleteImage(ele,Image_Id){
	
	if(confirm('Are you sure you want to DELETE this Image?')){
		
		$.ajax({
            url: '../include/delete_product_image.php',
            type: 'POST',
            data: {Image_Id:Image_Id},
            success:function(data){ 
            	if(data.trim() =="1"){
            		//row.css( "background-color", "red" );
            		$('#Main_Image_C').html('<div class="input-wrapper image-wrapper" id="main-preview"><img src="assets/images/delete.png" alt="delete icon" class="img-close hidden"><input type="file" id="main-image" name="main_image" accept="image/*" ><label class="input-label" for="main-image" id="main-label"><i class="fa fa-image fa-3x"></i> Upload an image</label></div>');

            	}else{
        		//$("#ErrorMsg").html("Something Went Wrong. Please Try Later After Some Seconds.").show().delay(5000).fadeOut();
        		}
               
            },
            error:function() {
                    //if there was an error 
                    console.log('no');
                }
            });
	}else{
		console.log("No");
	}
}
</script>
<script type="text/javascript">
	
//================================================================================//
//================================ ADD PRODUCT PAGE =============================//
//==============================================================================//

//Re_GenerateCatLinks();

</script>
<?php require '../include/footer.php'; ?>

