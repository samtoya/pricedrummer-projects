<?php
	include('../connections/db_connect.php');//connect to the database
	include('../connections/db_connect_sc.php');//connect to the database

	//$pdo = connect_pdo();
	if(isset($_POST['Prod_ID'])){
		$Prod_ID = $_POST['Prod_ID'];
		$sc_sql = "SELECT * FROM sc WHERE sc_ID = '".$Prod_ID."' limit 1";
		$sc_result = $conn_sc->query($sc_sql);
	?>
	<div class="panel panel-warning" style="_display:none;" >
		<div class="panel-heading" style="height:3px;">
			<div class="row">
				<div class="col-md-9">
					<h3 class="panel-title" style ="color: green; font-size: 29px;">Product Specifications</h3>
				</div>
				<div class="col-md-3">
					<a class="btn btn-xs btn-blue tooltips pull-left" onclick="mark_for_review('<?php echo $Prod_ID; ?>')" style="width:40px; height: 25px;"><i class="fa fa-eye fa-2x" ></i></a>
					
					<a class="btn btn-xs btn-red tooltips pull-right" onclick="window.location.href='edit_sc_product.php?Cat='+$('#CAT').val()+'&Prod='+$('#P_ID').val()+''" style="width:40px; height: 25px;"data-placement="top" data-original-title="Edit Product Details"><i class="fa fa-edit fa-2x" ></i></a>
				</div>
				
				
			</div>
		</div>
		<div class="panel-body" style="height:460px; overflow-x: scroll;">
			<?php
				if ($sc_result->num_rows > 0) {
					while($sc_row = $sc_result->fetch_assoc()) {
						
						$SC_Specs_sql = 'SELECT * FROM sc_details WHERE product_ID ='.$sc_row["sc_ID"];
						$SC_Specs_result = $conn_sc->query($SC_Specs_sql);
						
						
						$SC_IMG_sql = 'SELECT * FROM sc_images WHERE product_ID ='.$sc_row["sc_ID"];
						$SC_IMG_result = $conn_sc->query($SC_IMG_sql);
						
					?>
					
					<table class = "table table-bordered">
						<thead>
							<tr>
								<th width="30%" bgcolor="#FCF8E3" style="color:black;"><b>Specs Section.</b></th>
								<th width="30%" bgcolor="#FCF8E3" style="color:black;"><b>Item Specs.</b></th>
								<th  width="70%" bgcolor="#FCF8E3" style="color:black;"><b>Details</b></th>
								<th  width="70%" bgcolor="#FCF8E3" style="color:black;"><b>Specs Type</b></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Standard</td>
								<td>Standard Name</td>
								<td><?php echo $sc_row["product_name"]; ?></td>
								<td>COMPULSORY</td>
							</tr>
							<tr>
								<td>Standard</td>
								<td><font color="green"><b>Model Number</b></font></td>
								<td><font color="green"><b><?php echo $sc_row["modal_number"]; ?></b></font></td>
								<td>COMPULSORY</td>
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
										<td><?php echo $SC_Specs_row['info_type']; ?></td>
									</tr>
									<?php	
									}
								}
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
	
	
	<?php
	}
	
	include('../connections/db_connect.php');//close the connection to the database
	include('../connections/db_connect_sc.php');//close the connection to the database
?>