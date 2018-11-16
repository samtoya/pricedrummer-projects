<?php
	include('../connections/db_connect.php');//connect to the database
	include('../connections/db_connect_sc.php');//connect to the database
	if(isset($_GET['Prod_ID'])){
		$SC_Specs_sql = 'SELECT * FROM sc_details WHERE product_ID ='.$_GET['Prod_ID'];
		$SC_Specs_result = $conn_sc->query($SC_Specs_sql);
	?>
	<div class="panel panel-warning" style="_display:none;" >
		<div class="panel-heading" style="height:3px;">
			<h3 class="panel-title" style ="color: green; font-size: 29px;">Edit Product Specifications</h3>
			<a class="btn btn-xs btn-green tooltips pull-right" onclick="get_Product_Specs($('#P_ID').val())" style="width:40px; height: 25px; margin-top: -35px;"data-placement="top" data-original-title="Cancel Edit"><i class="fa fa-minus-circle" style="padding-top: 5px;"></i></a>
		</div>
		<div class="panel-body" style="height:460px; overflow-x: scroll;">
			
			<table class = "table table-bordered">
				<thead>
					<tr>
						<th width="30%" bgcolor="#FCF8E3" style="color:black;"><b>Item Specs.</b></th>
						<th  width="70%" bgcolor="#FCF8E3" style="color:black;"><b>Details</b></th>
					</tr>
				</thead>
				<tbody>
					<?php
						if ($SC_Specs_result->num_rows > 0) {
							while($SC_Specs_row = $SC_Specs_result->fetch_assoc()) {
							?>
							<tr  class="Specs_tr">
								<td><?php echo $SC_Specs_row['detail_name']; ?></td>
								<?php 
									if($SC_Specs_row['type'] == 'Fixed'){	
									?>
									<td><input style="width: 100%; color: black;" name="ItemSpecs[<?php echo  $SC_Specs_row['detail_name'] ?>]" type="text" value="<?php echo $SC_Specs_row['details_value']?>" onkeydown="<?php if(isset($SC_Specs_row['NumCheck']) && $SC_Specs_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" onfocus="<?php if(isset($SC_Specs_row['NumCheck']) && $SC_Specs_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" id="<?php 
										//if the detail_name contain space, then replace the space with _ before using it as id.
										//this is to aid id targeting it from jquery
									if(preg_match('/\s/',$SC_Specs_row['detail_name']) > 0){ echo preg_replace('/\s+/', '_', $SC_Specs_row['detail_name']);}else{ echo $SC_Specs_row['detail_name'];} ?>">
									<?php if(isset($SC_Specs_row['suggestion']) && $SC_Specs_row['suggestion'] !=""){echo '<p style="margin: 0px 0px -6px; font-size: 9px;">Unit entry should be in '. $SC_Specs_row['suggestion'] .'</p>';} ?></td>
									<?php 
										}elseif($SC_Specs_row['type'] == 'Multiple'){	
										$multiple_select_options = explode("|",$SC_Specs_row['details_value']);
										
										//COLLECT THE CATEGORY DETAILS/SPCS
										$Cat_Specs_sql = 'SELECT * FROM category_details WHERE category_ID ='.$_GET['cat'].' and details_name ="'.$SC_Specs_row['detail_name'].'"';
										$Cat_Specs_result = $conn_sc->query($Cat_Specs_sql);
										
										$multiple_specs = '';
										while($Cat_Specs_row = $Cat_Specs_result->fetch_assoc()) {
											if ($Cat_Specs_row['details_name']==$SC_Specs_row['detail_name']){
												$multiple_specs = $Cat_Specs_row['details_value'];
											}
										}
										$multiple_specs_options = explode("|",$multiple_specs);
										
									?><br/>
									<td>
										<?php
											$multiple_select_options_assoc = array();
											foreach ($multiple_select_options as $Moption) {
												$multiple_select_options_assoc[$Moption]=$Moption;
											}
											
											foreach ($multiple_specs_options as $Doption) {
												if($Doption == $multiple_select_options_assoc[$Doption]){
													
												?>
												<input type="checkbox" 
												id="<?php 
													//if the detail_name contain space, then replace the space with _ before using it as id.
													//this is to aid id targeting it from jquery
												if(preg_match('/\s/',$SC_Specs_row['detail_name']) > 0){ echo preg_replace('/\s+/', '_', $SC_Specs_row['detail_name']);}else{ echo $SC_Specs_row['detail_name'];} ?>" name="ItemSpecs[<?php echo  $SC_Specs_row['detail_name'] ?>][<?php echo $Doption; ?>]" checked value="<?php echo $Doption; ?>"> <?php echo $Doption; ?>
												
												<br>
												<?php
													
													}else{
												?>
												<input type="checkbox" 
												id="<?php 
													//if the detail_name contain space, then replace the space with _ before using it as id.
													//this is to aid id targeting it from jquery
												if(preg_match('/\s/',$SC_Specs_row['detail_name']) > 0){ echo preg_replace('/\s+/', '_', $SC_Specs_row['detail_name']);}else{ echo $SC_Specs_row['detail_name'];} ?>" name="ItemSpecs[<?php echo  $SC_Specs_row['detail_name'] ?>][<?php echo $Doption; ?>]" value="<?php echo $Doption; ?>"> <?php echo $Doption; ?>
												
												<br>
												
												<?php }
											}?>
											
									</td>
								<?php }?>
							</tr>
							<?php	
							}}
							
							
					}
				?>		
			</tbody>
		</table>	
	</div>
	<button class="btn btn-info" onclick="process_edit($('#P_ID').val());//the id in this call is to load the item after editing" style="width: 123px;" type="button">Update Specs</button>
											
</div>
<?php
include('../connections/db_connect.php');//close the connection to the database
include('../connections/db_connect_sc.php');//close the connection to the database
?>