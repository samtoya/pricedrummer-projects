<?php
	include '../configuration/config.php';
	include '../connections/db_connect.php';
	require '../include/header.php';
	require_once UTILITIES_PATH . DS . 'Country.php';
	
	ini_set( 'display_errors', 1 );
	$DASHBOARD = "";
	$retailer_id = $conn->real_escape_string( $_SESSION[ 'retailer_user_id' ] );
	$sql = "SELECT * FROM retailers WHERE id = $retailer_id LIMIT 1";
	$retailer_result = $conn->query( $sql );
	$retailer_results_query = $retailer_result->fetch_object();
	$merchant_id = trim( $retailer_results_query->merchant_ID );
	
	# Get the merchant information
	$sql = "SELECT * FROM merchant WHERE merchant_ID = $merchant_id LIMIT 1";
	$merchant_query = $conn->query( $sql );
	$merchant_result = $merchant_query->fetch_object();
	
	# Get the retailer_invoice_trail information
	# Also the total clicks
	$sql = "SELECT COUNT(*) AS num_rows FROM retailer_invoice_trail WHERE retailer_id = $retailer_id AND invoice_type = 'ITEM_CLICKED'";
	$retailer_invoice_query = $conn->query( $sql );
	if ( $retailer_invoice_query ) {
		$data = $retailer_invoice_query->fetch_assoc();
		$total_clicks = $data[ 'num_rows' ];
	}
	//$retailer_invoice_results = $retailer_invoice_query->fetch_object();
	
	# Get the budget balance
	$sql = "SELECT current_balance FROM retailer_budget WHERE retailer_id = $retailer_id LIMIT 1";
	$budget_query = $conn->query( $sql );
	$budget_result = $budget_query->fetch_object();
	
	# Get the balance of the retailer budget
	$sql = "SELECT SUM(amount) AS budget_balance FROM retailer_invoice_trail WHERE retailer_id = $retailer_id";
	$budget_balance_query = $conn->query($sql);
	$budget_balance = $budget_balance_query->fetch_object()->budget_balance;
	
	# Get the retailers total inactive products
	$sql = "SELECT * FROM retailer_products WHERE availability = 0 AND retailer_id = $retailer_id";
	$inactive_query = $conn->query( $sql );
	$total_inactive_products = $inactive_query->num_rows;
	
	# Get the retailers total active products
	$sql = "SELECT * FROM retailer_products WHERE status = 'ACTIVE' AND retailer_id = $retailer_id";
	$active_query = $conn->query( $sql );
	$total_active_products = $active_query->num_rows;
	
	# Total products
	$sql = "SELECT COUNT(*) AS total_products FROM retailer_products WHERE status = 'ACTIVE' AND retailer_id = $retailer_id";
	$total_products_query = $conn->query( $sql );
	if ($total_products_query) {
		$data = $total_products_query->fetch_assoc();
		$total_products = $data['total_products'];
	}
	
	# Total number of products in stock
	$sql = "SELECT * FROM retailer_products WHERE availability = 1 AND status = 'ACTIVE' AND retailer_id = $retailer_id";
	$total_products_in_stock_query = $conn->query( $sql );
	$total_products_in_stock_result = $total_products_in_stock_query->num_rows;
	
	# Total number of products out ofstock
	$sql = "SELECT * FROM retailer_products WHERE availability = 0 AND retailer_id = $retailer_id";
	$total_products_out_stock_query = $conn->query( $sql );
	$total_products_out_stock_result = $total_products_out_stock_query->num_rows;
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<nav class="col-md-1 col-lg-1">
				<?php include '../include/dashboard_navigation.php'; ?>
			</nav> <!-- end navigation -->
			
			<div class="col-md-11 col-lg-11" style="margin-left: -45px;">
				<div class="row">
					<div class="col-md-8 col-lg-8">
						<div class="col-md-12 col-lg-12">
							<div class="row cf">
								<div class="ovr-all">
									<h1><?php echo $total_clicks; ?></h1>
									<p>Total Clicks</p>
								</div>
								<div class="ovr-all">
									<h1><?php echo $total_products; ?></h1>
									<p>Total Products</p>
								</div>
								<div class="ovr-all">
									<h1><?php echo $total_active_products; ?></h1>
									<p>Active Products</p>
								</div>
							</div>
						</div>
						<div class="col-md-8 col-lg-8">
							<div style="margin-bottom: 5px;" class="box box-wrapper">
								<div class="box-header">
									<h4>Products</h4>
								</div>
								<div class="box-body cf">
									<div class="tt-p">
										<h1><?php echo $total_products; ?></h1>
										<p>Total Products</p>
									</div>
									<div class="act-p">
										<h1><?php echo $total_products_in_stock_result; ?></h1>
										<p>Products in stock</p>
									</div>
									<div class="inact-p">
										<h1><?php echo $total_products_out_stock_result; ?></h1>
										<p>Products out of stock</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="box box-wrapper">
								<div class="box-header">
									<h4>Invoices</h4>
								</div>
								<div class="box-body cf">
									<div class="bud-bal">
										<h1>&#x20b5;<?php echo round($budget_balance, 2); ?></h1>
										<p>Budget Balanace</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="margin-top: 5px;" class="col-md-4 col-lg-4">
						<div class="box box-wrapper">
							<div class="box-header">
								<h4>Owner Information</h4>
							</div>
							<div class="box-body cf">
								<div class="owner-image col-md-12 col-lg-12">
									<?php
										if ( ! empty( $merchant_result->logo ) ) {
											echo '<div style="text-align: center;"><img src="data:image/jpeg;base64,' . $merchant_result->logo . ' " style="max-height:160px; max-width:150px;"></div>';
										} else {
											echo '<img src="assets/images/no-image.png"
																				     alt="">';
										}
									?>
								</div>
								<div class="owner-info-left col-md-6 col-lg-6">
									<ul>
										<li>
											<i class="fa fa-building-o"></i> <?php echo $retailer_results_query->company_name; ?>
										</li>
										<li><i class="fa fa-globe"></i> <?php echo $merchant_result->url; ?></li>
									</ul>
								</div>
								<div class="owner-info-right col-md-6 col-lg-6">
									<ul>
										<?php if ( ! empty( $retailer_results_query->telephone1 ) ): ?>
											<li>
												<i class="fa fa-phone"></i> <?php echo $retailer_results_query->telephone1 ?>
											</li>
										<?php endif; ?>
										<?php if ( ! empty( $retailer_results_query->telephone2 ) ): ?>
											<li>
												<i class="fa fa-phone"></i> <?php echo $merchant_result->telephone2; ?>
											</li>
										<?php endif; ?>
									</ul>
								</div>
								<div class="address-box col-md-12 col-lg-12">
									<p>
										<i class="fa fa-map-marker"></i> <?php echo $retailer_results_query->shop_address; ?>
										,
										<?php echo $retailer_results_query->city; ?>,
										<?php foreach ( Country::all() as $country => $code ) { ?>
											<?php if ( trim( $retailer_results_query->country ) == trim( $code ) ) { ?>
												<?php echo $country; ?>
											<?php } ?>
										<?php } ?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require '../include/scripts.php'; ?>
<?php require '../include/footer.php'; ?>
