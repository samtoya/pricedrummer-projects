<?php
	require_once('../connections/db_connect.php');//connect to the sc database
	require_once('../connections/db_connect_sc.php');//connect to the database
	
	//COLLECT THE CATEGORY DETAILS/SPCS
	$Cat_Specs_sql = 'SELECT * FROM category_details WHERE category_ID ='.$_GET['cat_id'];
	$Cat_Specs_result = $conn_sc->query($Cat_Specs_sql);
	
	
	$SC_Specs_sql = 'SELECT * FROM sc_details WHERE info_type="COMPULSORY" and product_ID ='.$_GET['prod_id'];
	$SC_Specs_result = $conn_sc->query($SC_Specs_sql);
	
	$SC_Specs_sql_optional = 'SELECT * FROM sc_details WHERE info_type="OPTIONAL" and product_ID ='.$_GET['prod_id'];
	$SC_Specs_result_optional = $conn_sc->query($SC_Specs_sql_optional);
	
	//create an assoc array with the prod specs
	$SC_Specs_rows = array();
	if ($SC_Specs_result->num_rows > 0) {
		while($SC_Specs_row = $SC_Specs_result->fetch_assoc()) {
			$SC_Specs_rows[$SC_Specs_row['detail_name']] = $SC_Specs_row['details_value'];
		}
	}
	
	if ($Cat_Specs_result->num_rows > 0) {
		while($Cat_Specs_row = $Cat_Specs_result->fetch_assoc()) {
		?>
		<tr  class="Specs_tr">
			<td>Standard</td>
			<td><?php echo $Cat_Specs_row['details_name']; ?></td>
			<?php 
				if($Cat_Specs_row['type'] == 'Drop'){
					
					$drop_options = explode("|",$Cat_Specs_row['details_value']);
				?>
				<td>
					<select alt="<?php if(isset($Cat_Specs_row['suggestion']) && $Cat_Specs_row['suggestion'] !=''){echo  $Cat_Specs_row['suggestion'];}?>" id="<?php 
						//if the detail_name contain space, then replace the space with _ before using it as id.
						//this is to aid id targeting it from jquery
						if(preg_match('/\s/',$Cat_Specs_row['details_name']) > 0){ echo preg_replace('/\s+/', '_', $Cat_Specs_row['details_name']);}else{ echo $Cat_Specs_row['details_name'];} ?>" name="ItemSpecs[<?php echo  $Cat_Specs_row['details_code']."|".$Cat_Specs_row['details_name']."_COMPULSORY_Standard" ?>]" class="form-control">
						<?php
							foreach ($drop_options as $option) {
							?>
							<option <?php if(isset($SC_Specs_rows[''.$Cat_Specs_row['details_name'].'']) && $option == $SC_Specs_rows[''.$Cat_Specs_row['details_name'].'']){echo 'selected';} ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
							<?php	
								
							}
						?>
					</select>
				</td>
				
				<?php
					}elseif($Cat_Specs_row['type'] == 'Fixed'){	
				?>
				<td><input style="width: 100%; color: black;" name="ItemSpecs[<?php echo  $Cat_Specs_row['details_code']."|".$Cat_Specs_row['details_name']."_COMPULSORY_Standard" ?>]" type="text" value="<?php if(isset($SC_Specs_rows[''.$Cat_Specs_row['details_name'].''])){echo htmlentities(trim($SC_Specs_rows[''.$Cat_Specs_row['details_name'].'']));} ?> " onkeydown="<?php if(isset($Cat_Specs_row['NumCheck']) && $Cat_Specs_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" onfocus="<?php if(isset($Cat_Specs_row['NumCheck']) && $Cat_Specs_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" alt="<?php if(isset($Cat_Specs_row['suggestion']) && $Cat_Specs_row['suggestion'] !=''){echo  $Cat_Specs_row['suggestion'];}?>" id="<?php
					//if the detail_name contain space, then replace the space with _ before using it as id.
					//this is to aid id targeting it from jquery
				if(preg_match('/\s/',$Cat_Specs_row['details_name']) > 0){ echo preg_replace('/\s+/', '_', $Cat_Specs_row['details_name']);}else{ echo $Cat_Specs_row['details_name'];} ?>">
				<?php if(isset($Cat_Specs_row['suggestion']) && $Cat_Specs_row['suggestion'] !=""){echo '<p style="margin: 0px 0px -6px; font-size: 9px;">Unit entry should be in '. $Cat_Specs_row['suggestion'] .'</p>';} ?></td>
				<?php 
					}elseif($Cat_Specs_row['type'] == 'Multiple'){	
					
					$multiple_select_options = explode("|",$Cat_Specs_row['details_value']);
				?>
				<td>
					<?php 
						$multiple_specs_options=array();
						if(isset($SC_Specs_rows[''.$Cat_Specs_row['details_name'].''])){
							//split the string of multiple select optiond
							$multiple_specs_options = explode("|",$SC_Specs_rows[''.$Cat_Specs_row['details_name'].'']);
						} 
						//create an asso array to hold the multiple select options
						$multiple_select_options_assoc = array();
						foreach ($multiple_specs_options as $M) {
							$multiple_select_options_assoc[trim($M)]=trim($M);
						}
						
					?>
					<?php
						foreach ($multiple_select_options as $Moption) {
						?>
						<input type="checkbox" 
						id="<?php 
							//if the detail_name contain space, then replace the space with _ before using it as id.
							//this is to aid id targeting it from jquery
						if(preg_match('/\s/',$Cat_Specs_row['details_name']) > 0){ echo preg_replace('/\s+/', '_', $Cat_Specs_row['details_name']);}else{ echo $Cat_Specs_row['details_name'];} ?>" name="ItemSpecs[<?php echo  $Cat_Specs_row['details_code']."|".$Cat_Specs_row['details_name']."_COMPULSORY_Standard" ?>][<?php echo $Moption; ?>]"  <?php if(isset($multiple_select_options_assoc[$Moption]) && $Moption == $multiple_select_options_assoc[$Moption]){echo 'checked';}?> value="<?php echo trim($Moption); ?>"> <?php echo $Moption; ?>
						
						<br>
						
					<?php }?>
				</td>
			<?php }?>
			<td>COMPULSORY</td>
			<td></td>
		</tr>
		<?php	
		}}
?>	

<?php
	if ($SC_Specs_result_optional->num_rows > 0) {
		while($SC_Specs_optional_row = $SC_Specs_result_optional->fetch_assoc()) {
		?>
		<tr  class="Specs_tr">
			<td><?php echo $SC_Specs_optional_row['category_section']; ?></td>
			<td><?php echo $SC_Specs_optional_row['detail_name']; ?></td>
			<?php 
				if($SC_Specs_optional_row['type'] == 'Fixed'){	
				?>
				<td><input style="width: 100%; color: black;" name="ItemSpecs[<?php echo  $SC_Specs_optional_row['details_code']."|".$SC_Specs_optional_row['detail_name']."_OPTIONAL_". $SC_Specs_optional_row['category_section']?>]" type="text" value="<?php echo  htmlentities(trim($SC_Specs_optional_row['details_value']));?>" onkeydown="<?php if(isset($SC_Specs_optional_row['NumCheck']) && $SC_Specs_optional_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" onfocus="<?php if(isset($SC_Specs_optional_row['NumCheck']) && $SC_Specs_optional_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" id="<?php
					//if the detail_name contain space, then replace the space with _ before using it as id.
					//this is to aid id targeting it from jquery
				if(preg_match('/\s/',$SC_Specs_optional_row['detail_name']) > 0){ echo preg_replace('/\s+/', '_', $SC_Specs_optional_row['detail_name']);}else{ echo $SC_Specs_optional_row['detail_name'];} ?>">
				<?php if(isset($SC_Specs_optional_row['suggestion']) && $SC_Specs_optional_row['suggestion'] !=""){echo '<p style="margin: 0px 0px -6px; font-size: 9px;">Unit entry should be in '. $SC_Specs_optional_row['suggestion'] .'</p>';} ?></td>
				<?php 
					}elseif($SC_Specs_optional_row['type'] == 'Multiple'){
					
					//Multiple condition for optional check goes here
					
					}?>
			<td>OPTIONAL</td>
			<td><a class="btn btn-xs btn-red tooltips pull-right" onclick="delete_prod_specs('<?php echo $SC_Specs_optional_row['sc_ID']; ?>',this)" style="width:40px; height: 25px;"><i class="fa fa-trash-o" style="padding-top: 5px;"></i></a></td>
		</tr>
		<?php	
		}}
		
?>