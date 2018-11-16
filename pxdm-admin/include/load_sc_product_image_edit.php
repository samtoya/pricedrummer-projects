<?php
	require_once('../connections/db_connect.php');//connect to the database
	
	
	$SC_IMG_sql = 'SELECT * FROM sc_images WHERE product_ID ='.$_POST['product_id'];
	$SC_IMG_result = $conn->query($SC_IMG_sql);
	
?>
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
			<div class="form-group">
				<label>Other Product Information:</label>  
				<textarea name="Product_Information" id="item_info" class="form-control fomstyl" rows="10" placeholder="item informations" data-placement="right" data-toggle="tooltip" data-original-title="item_info" style="_height: 64px;"></textarea>
				<textarea name="Product_Information_hidden" id="item_info_hidden" style="display: none;"></textarea>
				<input type="text" value="" id="specs_tokenizer" style="width:90px;"/>
				<a class="btn btn-danger" id="item_info_check_btn" style="width:100px;" onclick="Check_Product_Other_info();">Check Format</a>
			</div>
		</div>
	</div> 
	
	<div class="panel-footer">
		<button class="btn btn-info btn-lg" onclick="Check_Categories();" style="width: 123px;" type="submit">Update Specs</button>
	</div>  
</div>