<!-- START PANEL WITH COLLAPSE CALLBACKS -->
<div class="panel panel-success panel-hidden-controls">
	<div class="panel-heading">
		<h3 class="panel-title">Not In Standard Catalogue</h3>
	</div>
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
			<div class="form-group" id="OtherSpecsContainer">
				<label>Product Information:</label>
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
		<div class="row">
			<div class="col-md-6">
			<!--
			<input type="checkbox" id="Change_Status_Only" name="Process_Status" value="Change_Status_Only" >
		<label for="Change_Status_Only">Procss Without Adding To SC</label>
		-->
			</div>
			<div class="col-md-6">
			<button onclick="Check_Categories();" class="btn btn-success btn-block pull-right">Add to Standard Catalogue</button>
		</div>
		</div>
		
		
	</div>  
</div>