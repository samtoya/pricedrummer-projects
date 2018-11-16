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
			<h3 class="panel-title" style ="color: green; font-size: 29px;">Product Image</h3>
		</div>
		<div class="panel-body" style="height:460px; overflow-x: scroll;">
			<?php
				if ($sc_result->num_rows > 0) {
					while($sc_row = $sc_result->fetch_assoc()) {
						
						$SC_IMG_sql = 'SELECT * FROM sc_images WHERE product_ID ='.$sc_row["sc_ID"];
						$SC_IMG_result = $conn_sc->query($SC_IMG_sql);
						
						
						if ($SC_IMG_result->num_rows > 0) {
						echo'<center><p><b>Click To View Large Size</b></p></center>';
						
							while($SC_IMG_row = $SC_IMG_result->fetch_assoc()) {
								/*this to display only the raw Image without style
									echo '<img height="150" align="center" width="200" src="data:image;base64,'.$SC_IMG_row['image'].' " data-lightbox="gallery"> <br/><br/>';
								*/	
								//Display LightBox Image
								echo '<a class="thumb-info" href="data:image;base64,'.$SC_IMG_row['image'].' " data-lightbox="gallery" data-title="Product Image">
								<img src="data:image;base64,'.$SC_IMG_row['image'].' " class="img-responsive" alt="">
								<span class="thumb-info-title"> <br/> </span>
								</a>';
								
								
							}
						}
						
					}
					
					} else {
					
					echo "<h2>No Image Uploaded For this Product</h2>";
				}
				
			?>
		</div>
	</div>
	
	
	<?php
	}
	
	include('../connections/db_connect.php');//close the connection to the database
	include('../connections/db_connect_sc.php');//close the connection to the database
?>