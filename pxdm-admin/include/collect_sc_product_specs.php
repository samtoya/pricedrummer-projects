<?php
	include('../connections/db_connect.php');//connect to the database
	include('../connections/db_connect_sc.php');//connect to the database
    //$pdo = connect_pdo();

    $IMAGE_PATH = "https://www.pricedrummer.com.gh/static/product_images/thumbs/";

	if(isset($_POST['model_number'])){
		$model_number_or_product_name = $_POST['model_number'];
		if(!empty($model_number_or_product_name)){
			//Perform the search if only the search parameter is not empty
			$sc_sql = "SELECT sc.*, (select image_ID from sc_images where product_ID= sc_ID limit 1)as image_ID  FROM sc WHERE ((modal_number <>'' and modal_number = '".$model_number_or_product_name."')  OR (product_name<>'' and product_name like '".trim($model_number_or_product_name)."%')) and `sc`.`status` <>'DELETED'";
			$sc_result = $conn_sc->query($sc_sql);
		}
		
		
	?>
	<div class="panel panel-warning" style="_display:none;" >
		<div class="panel-heading" style="height:3px;">
			<h3 class="panel-title" style ="color: green; font-size: 29px;">In Catalogue</h3>
		</div>
		<div class="panel-body" style="height:721px; overflow-x: scroll;">
			<center><h4 style="color:red"><?php echo $sc_result->num_rows; ?> Product(s) found with this model number</h4></center>
			<?php
				if ($sc_result->num_rows > 0) {
					while($sc_row = $sc_result->fetch_assoc()) {
						
						$SC_Specs_sql = 'SELECT * FROM sc_details WHERE product_ID ='.$sc_row["sc_ID"];
						$SC_Specs_result = $conn_sc->query($SC_Specs_sql);
						
					?>
					
					<table class = "table table-bordered">
						<thead>
							<tr onclick="$(this).find('input:radio').attr('checked', true);">
								<th width="30%" bgcolor="#FCF8E3" style="color:black;"><b>Specs Section.</b></th>
								<th width="30%" bgcolor="#FCF8E3" style="color:black;"><b>Item Specs.</b></th>
								<th onclick="$(this).find('input:radio').attr('checked', true);" width="55%" bgcolor="#FCF8E3" style="color:black;">
									<label style="color: black; width: 95%; display: inline-block;" for="<?php echo $sc_row["sc_ID"]; ?>">
										<b>Details</b>
									</label>
									<p style="text-align: right; float: right; margin: 0px; display: inline;">
										<input type="radio" name="Existing_SC_Product" id="<?php echo $sc_row["sc_ID"]; ?>" checked value="<?php echo $sc_row["sc_ID"]; ?>"/>							
									</p></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Standard</td>
								<td>Standard Name</td>
								<td><?php if(!empty($sc_row["sc_image"])){
                                        echo '<a class="thumb-info" href="data:image;base64,'.$sc_row["sc_image"].' " data-lightbox="gallery" data-title="'.$sc_row["product_name"].'">
																<img src="data:image;base64,'.$sc_row["sc_image"].' " class="img-responsive" alt="" height="50" width="50">
																<span class="thumb-info-title"></span>
															</a>';
                                    }else{
                                        echo '<img src="'.$IMAGE_PATH.$sc_row["image_ID"].'.png" style="max-height:50px; max-width:50px" class="img-responsive">';
                                    } ?>

                                    <?php echo $sc_row["product_name"]; ?></td>
							</tr>
							<tr>
								<td>Standard</td>
								<td><font color="green"><b>Model Number</b></font></td>
								<td><font color="green"><b><?php echo $sc_row["modal_number"]; ?></b></font></td>
							</tr>
							
							<?php
								if ($SC_Specs_result->num_rows > 0) {
									while($SC_Specs_row = $SC_Specs_result->fetch_assoc()) {
									?>
									<tr>
										<td><?php echo $SC_Specs_row['category_section']; ?></td>
										<td><?php echo $SC_Specs_row['detail_name']; ?></td>
										<?php 
											if($SC_Specs_row['type'] == 'Fixed'){
											?>
											<td>
												<?php
													if($SC_Specs_row['detail_name'] == 'Product Information'){
													?>	
													
													<textarea readonly rows="5" style="height: 95px; width: 100%;" ><?php echo $SC_Specs_row['details_value']; ?></textarea>
													<?php
														}else{
													?>
													<?php echo $SC_Specs_row['details_value'];
													} ?>
											</td>
											<?php 
												}elseif($SC_Specs_row['type'] == 'Multiple'){	
												
												$multiple_select_options = explode("|",$SC_Specs_row['details_value']);
											?>
											<td width="55px">
												<?php
													foreach ($multiple_select_options as $Moption) {
													?>
													<?php echo $Moption; ?><br/>
													
												<?php }?>
											</td>
										<?php }?>
									</tr>
									<?php	
									}}
							?>
						</tbody>
					</table>
					<?php
					}
					
					} else {
					
					// 0 result
				}
				
			?>
		</div>
	</div>
	
	
	
	
	
	
	<br/>
	<div class="panel panel-success panel-hidden-controls">
		<div class="panel-body">
			
			<div class="row">
				<div class="col-md-12">
					
					<div class="col-sm-6">
						<div class="form-group">
							
							<label>
								Product Image 1:
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
					<div class="col-sm-6">
						<div class="form-group">
							
							<label>
								Product Image 2:
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
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-sm-6">
						<div class="form-group">
							
							<label>
								Product Image 3:
							</label>
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt=""/>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail"></div>
								<div>
									<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o" style ="width: 20px;"></i> Change</span>
										<input type="file" name="Product_Image[]">
									</span>
									<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
										<i class="fa fa-times"></i> Remove
									</a>
								</div>
							</div>
						</div>	                                           
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							
							<label>
								Product Image 4:
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
				</div>	
			</div>
			<div class="col-md-12">
				<!--
					<div class="form-group">
					<label>Video link:</label>  
					<input placeholder=" " class="form-control" name="ItemSpecs[Video Link]" value=""  data-toggle="tooltip" type="text">
					</div>
				-->	
				<div class="row">
					<a href="#" class="btn btn-xs btn-green tooltips pull-right" style="width: 42px; height: 27px; margin-bottom: 5px;"data-placement="top" data-original-title="Wide View" data-target=".copy-past-m" onclick="raw_Oter_Specs = $('#item_info').val(); $('#OtherSpecsContainerLarge').html($('#OtherSpecsContainer').html()); $('#OtherSpecsContainer').empty(); $('#item_info').text(raw_Oter_Specs); " data-toggle="modal"><i class="fa fa-desktop fa-2x"></i></a>
				</div>
				
				<div class="form-group"  id="OtherSpecsContainer">
					<label>Product Information:</label>  
					<textarea name="Product_Information" id="item_info" class="form-control fomstyl" rows="10" placeholder="item informations" data-placement="right" data-toggle="tooltip" data-original-title="item_info" style="_height: 64px;"></textarea>
					
					
					<textarea class="form-control fomstyl" name="Product_Information_hidden" readonly rows="10" id="item_info_hidden" style="display: none;"></textarea><br/>
					<input type="text" value="" id="specs_tokenizer" style="width:90px;"/>
					<a class="btn btn-danger"  style="width:100px;"  id="item_info_check_btn" onclick="Check_Product_Other_info();">Check Format</a>
					
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
	</div>
	<br/><br/>
	
	
	
	<input type="radio" id="Change_Status_Only" name="Process_Status" value="Change_Status_Only" checked  onclick="$('#Product_Check_Form').attr('action', 'include/addtosc_copy.php');">
	<label for="Change_Status_Only">Procss Without Adding New</label>
	<br/>
	<input type="radio" id="Copy_From_SC" name="Process_Status" value="Copy_From_SC"  onclick="$('#Product_Check_Form').attr('action', 'include/addtosc_copy.php');">
	<label for="Copy_From_SC">Add With Copy From Selected SC Product</label>
	<br/>
	<input type="radio" id="Add_New" name="Process_Status" value="Add_New" onclick="$('#Product_Check_Form').attr('action', 'include/addtosc.php');">
	<label for="Add_New">Add New To SC</label>
	<br/>
	
	<div class="row">
		<div class="col-md-6">
			
			<button onclick="Check_Categories();" id="Process_Product" class="btn btn-success btn-block">Process Product</button>
		</div>
		<div class="col-md-6">
			<a href="#" class="btn btn-primary" onclick="Recheck_Product_Copy();">Review Details</a>
		</div>
	</div>
	
	
	
	
	<br/><br/>
	<br/><br/>
	<?php
	}
	
	include('../connections/db_connect.php');//close the connection to the database
	include('../connections/db_connect_sc.php');//close the connection to the database
?>