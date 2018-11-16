<?php
	include('connections/db_connect.php');//connect to the database
	
	if (!isset($_SESSION)) {
		session_start();
	}
	
	if(isset($_POST['Existing_SC_Product'])){
		//==FIND THE SELECTE PRODUCT
		$Prod_ID = $_POST['Existing_SC_Product'];
		$sc_sql = "SELECT * FROM sc WHERE sc_ID = '".$Prod_ID."' limit 1";
		$sc_result = $conn->query($sc_sql);
		
	?>
	<div class="panel panel-warning" style="_display:none;" >
		<div class="panel-heading" style="height:3px;">
			<h3 class="panel-title" style ="color: green; font-size: 29px;">Review Product Specifications</h3>
		</div>
		<div class="panel-body" style="height:721px; overflow-x: scroll;">
			<?php
				if ($sc_result->num_rows > 0) { 
					while($sc_row = $sc_result->fetch_assoc()) {
						//collect all COMPULSORY specs for the selected product
						$SC_Specs_sql = 'SELECT * FROM sc_details WHERE info_type = "COMPULSORY" and product_ID ='.$sc_row["sc_ID"];
						$SC_Specs_result = $conn->query($SC_Specs_sql);
						
						//collect all OPTIONAL specs for the selected product
						$SC_Specs_sql_Optional = 'SELECT * FROM sc_details WHERE info_type = "OPTIONAL" and product_ID ='.$sc_row["sc_ID"];
						$SC_Specs_result_Optional = $conn->query($SC_Specs_sql_Optional);
						
						//==SPECS FROM THE POSTED FORM
						$ITEM_SPECKS = $_POST['ItemSpecs'];
						
						//==NEW OPTIONAL SPECS FROM THE POSTED FORM
						$Optional_Specs = explode("\n", $_POST['Product_Information_hidden']);
						
						$Optional_Specs_Array = array();	//Array to hold the prepared optional specs
						foreach ($Optional_Specs as $Spec){
							if(!empty($Spec)){
								$spec_details =	explode("|", $Spec);
								$Optional_Specs_Array[trim($spec_details[0])] = trim($spec_details[1]);	//populate the specs array with new specs
							}
						}
						
						
					?>
					
					<table class = "table table-bordered">
						<thead>
							<tr>
								<th width="30%" bgcolor="#FCF8E3" style="color:black;"><b>Item Specs.</b></th>
								<th  width="70%" bgcolor="#FCF8E3" style="color:black;"><b>Details</b></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Standard Name</td>
								<td><?php if(isset($_POST['STANDARD_NAME'])){ echo $_POST['STANDARD_NAME']; }else{ echo $sc_row["product_name"]; }?></td>
							</tr>
							<tr>
								
								<td><font color="green"><b>Model Number</b></font></td>
								<td><font color="green"><b><?php if(isset($_POST['MODEL_NUMBER'])){ echo $_POST['MODEL_NUMBER']; }else{ echo $sc_row["modal_number"]; }?></b></font></td>
							</tr>
							
							<!-- COMPULSORY SPECS LOOP -->
							<?php
								if ($SC_Specs_result->num_rows > 0) {
									/*
									->loop through the COMPULSORY specs
									->check if the same specs was sent for processing
									->display the sent specs if there was any else display the specs from the copied product
									*/
									while($SC_Specs_row = $SC_Specs_result->fetch_assoc()) {
									?>
									<tr>
										<td><?php echo $SC_Specs_row['detail_name']; ?></td>
										<?php 
											if($SC_Specs_row['type'] == 'Fixed'){
											?>
											<td>
												<?php if(isset($ITEM_SPECKS[''.$SC_Specs_row['detail_name'].'']) && $ITEM_SPECKS[''.$SC_Specs_row['detail_name'].''] != ""){ echo $ITEM_SPECKS[''.$SC_Specs_row['detail_name'].''];}else{ echo $SC_Specs_row['details_value'];}
													?>
											</td>
											<?php 
												}elseif($SC_Specs_row['type'] == 'Multiple'){	
												
												
											?>
											<td width="55px">
												<?php
													if(!empty($ITEM_SPECKS[''.$SC_Specs_row['detail_name'].''])){
														echo implode("<br/> ",$ITEM_SPECKS[''.$SC_Specs_row['detail_name'].'']);
														}else{ 
														$multiple_select_options = explode("|",$SC_Specs_row['details_value']);
														
														foreach ($multiple_select_options as $Moption) {
														?>
														<?php echo $Moption; ?><br/>
														
														<?php }
													}
												?>
											</td>
										<?php }?>
									</tr>
									<?php	
									}
								}
							?>
							
							<!-- OPTIONAL SPECS LOOP -->
							<?php
								if ($SC_Specs_result_Optional->num_rows > 0) {
									while($SC_Specs_row_Optional = $SC_Specs_result_Optional->fetch_assoc()) {
									?>
									<tr>
										<td><?php echo $SC_Specs_row_Optional['detail_name']; ?></td>
										<?php 
											if($SC_Specs_row_Optional['type'] == 'Fixed'){
											?>
											<td>
												<?php if(isset($Optional_Specs_Array[''.$SC_Specs_row_Optional['detail_name'].'']) && $Optional_Specs_Array[''.$SC_Specs_row_Optional['detail_name'].''] != ""){
													
													echo $Optional_Specs_Array[''.$SC_Specs_row_Optional['detail_name'].''];
													
													}else{
													echo $SC_Specs_row_Optional['details_value'];
												}
												?>
											</td>
										</tr>
										<?php	
										}
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
	?>			