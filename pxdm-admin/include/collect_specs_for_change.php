<?php
	
	require_once('../connections/db_connect.php');//connect to the database
	
	//COLLECT THE CATEGORY DETAILS/SPCS
	$Cat_Specs_sql = 'SELECT * FROM category_details WHERE category_ID ='.$_POST['cat_id'];
	$Cat_Specs_result = $conn->query($Cat_Specs_sql);
	

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
						if(preg_match('/\s/',$Cat_Specs_row['details_name']) > 0){ echo preg_replace('/\s+/', '_', $Cat_Specs_row['details_name']);}else{ echo $Cat_Specs_row['details_name'];} ?>" name="ItemSpecs[<?php echo  $Cat_Specs_row['details_name']."|".$Cat_Specs_row['details_code']  ?>]" class="form-control">
					
						<?php
							foreach ($drop_options as $option) {
							?>
							<option value="<?php echo $option; ?>"><?php echo $option; ?></option>
							<?php	
							}
						?>
					</select>
				</td>
				
				<?php
					}elseif($Cat_Specs_row['type'] == 'Fixed'){	
				?>
				<td><input style="width: 100%; color: black;" name="ItemSpecs[<?php echo  $Cat_Specs_row['details_name']."|".$Cat_Specs_row['details_code']  ?>]" type="text" value="N/A"  onkeydown="<?php if(isset($Cat_Specs_row['NumCheck']) && $Cat_Specs_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" onfocus="this.select();<?php if(isset($Cat_Specs_row['NumCheck']) && $Cat_Specs_row['NumCheck'] =="1"){echo 'numberOnly(this);';} ?>" alt="<?php if(isset($Cat_Specs_row['suggestion']) && $Cat_Specs_row['suggestion'] !=''){echo  $Cat_Specs_row['suggestion'];}?>" id="<?php
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
						foreach ($multiple_select_options as $Moption) {
						?>
						<input type="checkbox" 
						id="<?php 
							//if the detail_name contain space, then replace the space with _ before using it as id.
							//this is to aid id targeting it from jquery
						if(preg_match('/\s/',$Cat_Specs_row['details_name']) > 0){ echo preg_replace('/\s+/', '_', $Cat_Specs_row['details_name']);}else{ echo $Cat_Specs_row['details_name'];} ?>" name="ItemSpecs[<?php echo  $Cat_Specs_row['details_name']."|".$Cat_Specs_row['details_code']  ?>][<?php echo $Moption; ?>]" value="<?php echo $Moption; ?>"> <?php echo $Moption; ?>
						
						<br>
						
					<?php }?>
				</td>
			<?php }?>
		</tr>
		<?php	
		}}
?>