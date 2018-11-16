<?php 
include('../connections/db_connect.php');//connect to the database
include '../configuration/config.php'; 
require '../include/header.php'; 
require UTILITIES_PATH.DS.'Category.php';

$PRODUCT_OVERVIEW="";

$faker = Faker\Factory::create();
$categories = [ 'Mobile Phones', 'Tablets', 'Camera', 'TVs', 'Audio Speakers', 'Cars', 'Computers' ];
$status = [ 'In stock', 'Out of stock' ];

 if(isset($_SESSION['retailer_user_id'])){
  $retailer_id = $conn->real_escape_string($_SESSION['retailer_user_id']); 
}else{
	$retailer_id = -1;
}
$Url_Params_For_Post="";
if(isset($_GET['Cid'])){
	$category_id = $conn->real_escape_string(urldecode($_GET['Cid']));
	$Url_Params_For_Post="Cid=".$conn->real_escape_string(urldecode($_GET['Cid']));

	$retailer_products_sql = 'SELECT * FROM `retailer_product_list` where `category`='.$category_id.' and `retailer_id` ='.$retailer_id;
	$retailer_products_result = $conn->query($retailer_products_sql);
}elseif(isset($_GET['All'])){
	$Url_Params_For_Post="All=".$conn->real_escape_string(urldecode($_GET['All']));

	$retailer_products_sql = 'SELECT * FROM `retailer_product_list` where `retailer_id` ='.$retailer_id;
	$retailer_products_result = $conn->query($retailer_products_sql);
}



?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<nav class="col-md-1 col-lg-1">
				<?php include '../include/dashboard_navigation.php'; ?>
			</nav> <!-- end navigation -->
			
			<div class="col-md-11 col-lg-11" style="margin-left: -45px;">
				<div class="col-md-12 col-lg-12">
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
							<div class="search-wrapper">
								<form action="" method="get">
									<label for="search-item"><i class="fa fa-search"></i></label>
									<input class="search-item" type="search" id="search-item" name="search"
									       placeholder="Search product by name or category">
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-lg-10">
							<div class="box box-wrapper">
								<div class="box-header">
									<h4>Products Overview</h4>
								</div>
								<div class="box-body">
									<table id="products_list">
										<thead>
										<tr>
											<th style="width: 3%;">No.</th>
											<th style="width: 40%;">Product</th>
											<th style="width: 20%;">Category</th>
											<th style="width: 12%;">Availability</th>
											<th style="width: 15%;text-align: center;">Action</th>
										</tr>
										</thead>
										<tbody>
											<?php
											$No = 1;
												if ($retailer_products_result->num_rows > 0) {
													while($row = $retailer_products_result->fetch_assoc()) {
													?>
													<tr>
														<td><?php echo $No; ?></td>

														<td><?php echo $row['manufacturer']." ".$row['model_nuber']; ?></td>
														<td><?php echo $row['category_name']; ?></td>
														<td>
															<div class="onoffswitch">
															   <input type="checkbox" onclick="ProcessAvailability(this,'<?php echo $row['id']; ?>');" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch<?php echo $No;?>"
															    <?php if(trim($row['availability'])==1){echo "checked";}?>>
															   <label class="onoffswitch-label" for="myonoffswitch<?php echo $No;?>">
															       <span class="onoffswitch-inner"></span>
															       <span class="onoffswitch-switch"></span>
															   </label>
															</div>
														</td>
														<td style="text-align: right;">
															<a href="edit_product.php?Pid=<?php echo $row['id']; ?>&sgoto=<?php echo urlencode($Url_Params_For_Post);?>" class="action edit"><img src="assets/images/edit.png" alt="edit icon"></a>
															<a title="delete" onclick="deleteProduct(this,'<?php echo $row['id']; ?>');"
															   href="javascript:void(0);" class="action delete"><img src="assets/images/delete.png" alt="delete icon"></a>
														</td>
													</tr>
													<?php	
													$No++;
													}}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Site Modal -->
<div class="modal fade edit-product" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Apple iPhone 5s 32GB Single Sim</h4>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
	
	<?php require '../include/scripts.php'; ?>
	<script type="text/javascript">
        $(document).ready(function(){
            var dTable = $('#products_list').DataTable({
                searching: true
            });
            $('#search-item').keyup(function(){
                dTable.search($(this).val()).draw() ;
            })
        });
//================================================================================//
//================================PRODUCT OVERVIEW PAGE =========================//
//==============================================================================//

function ProcessAvailability(ele,product_Id){
  if($(ele).is(":checked")){ 
    console.log("Checked");

    $.ajax({
        url: '../include/update_product_availability.php',
        type: 'POST',
        data: {product_id:product_Id,availability:1},
        success:function(data){ 
        	console.log(data);
        	if(data.trim() =="1"){
        		//$("#ErrorMsg").html("Product Successfully Set to Active").show().delay(5000).fadeOut();
        	}else{
        		$(ele).attr('checked', false);
        		console.log('no');
        	}
           
        },
        error:function() {
                //if there was an error 
                console.log('no');
                $(ele).attr('checked', false);
                //$("#ErrorMsg").html("Something Went Wrong. Please Try Later After Some Seconds.").show().delay(5000).fadeOut();
            }
    });

  }else{
    console.log("Unchecked");
    $.ajax({
        url: '../include/update_product_availability.php',
        type: 'POST',
        data: {product_id:product_Id,availability:0},
        success:function(data){ 
        	console.log(data);
        	if(data.trim() =="1"){
        		//$("#ErrorMsg").html("Product Successfully Set to Inactive").show().delay(5000).fadeOut();
        	}else{
        		$(ele).attr('checked', true);
        		console.log('no');
        		$(ele).attr('checked', true);
        		$(ele).prop('checked', true); 
        	}
           
        },
        error:function() {
                //if there was an error 
                console.log('no');
                $(ele).attr('checked', true);
                $(ele).attr('checked', true);
        		$(ele).prop('checked', true); 
                //$("#ErrorMsg").html("Something Went Wrong. Please Try Later After Some Seconds.").show().delay(5000).fadeOut();
            }
    });
  }

}

function deleteProduct(ele,product_Id){
	
	if(confirm('Are you sure you want to DELETE this product?')){
		var row = $(ele).closest( "tr" );

		$.ajax({
            url: '../include/delete_product.php',
            type: 'POST',
            data: {product_id:product_Id},
            success:function(data){ 
            	if(data.trim() =="1"){
            		//row.css( "background-color", "red" );
            		row.remove();
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
<?php require '../include/footer.php'; ?>
