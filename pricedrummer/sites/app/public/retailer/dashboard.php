<?php
    include 'configuration/config.php';
    include 'connections/db_connect.php';
    require 'include/header.php';
    require_once UTILITIES_PATH . DS . 'Country.php';

//    ini_set( 'display_errors', 1 );
    
    $DASHBOARD              = "";

    $retailer_id            = $conn->real_escape_string( $_SESSION[ 'retailer_user_id' ] );
//    $sql                    = "SELECT * FROM retailers WHERE id = $retailer_id LIMIT 1";
//    $retailer_result        = $conn->query( $sql );
//    $retailer_results_query = $retailer_result->fetch_object();
//    $merchant_id            = trim( $retailer_results_query->merchant_ID );

    # Get the merchant information
//    $sql             = "SELECT * FROM merchant WHERE merchant_ID = $merchant_id LIMIT 1";
//    $merchant_query  = $conn->query( $sql );
//    $merchant_result = $merchant_query->fetch_object();

    # Get the retailer_invoice_trail information
    # Also the total clicks
    $sql                    = "SELECT COUNT(*) AS num_rows FROM retailer_invoice_trail WHERE retailer_id = $retailer_id AND invoice_type = 'ITEM_CLICKED'";
    $retailer_invoice_query = $conn->query( $sql );
    if ( $retailer_invoice_query ) {
        $data         = $retailer_invoice_query->fetch_assoc();
        $total_clicks = $data[ 'num_rows' ];
    }
    //$retailer_invoice_results = $retailer_invoice_query->fetch_object();

    # Get the budget balance
    $sql           = "SELECT current_balance FROM retailer_budget WHERE retailer_id = $retailer_id LIMIT 1";
    $budget_query  = $conn->query( $sql );
    $budget_result = $budget_query->fetch_object();

    # Get the balance of the retailer budget
    $sql                  = "SELECT SUM(amount) AS budget_balance FROM retailer_invoice_trail WHERE retailer_id = $retailer_id";
    $budget_balance_query = $conn->query( $sql );
    $budget_balance       = $budget_balance_query->fetch_object()->budget_balance;

    # Get the retailers total inactive products
    $sql                     = "SELECT * FROM retailer_products WHERE availability = 0 AND retailer_id = $retailer_id";
    $inactive_query          = $conn->query( $sql );
    $total_inactive_products = $inactive_query->num_rows;

    # Get the retailers total active products
    $sql                   = "SELECT * FROM retailer_products WHERE status = 'ACTIVE' AND retailer_id = $retailer_id";
    $active_query          = $conn->query( $sql );
    $total_active_products = $active_query->num_rows;

    # Total products
    $sql                  = "SELECT COUNT(*) AS total_products FROM retailer_products WHERE status = 'ACTIVE' AND retailer_id = $retailer_id";
    $total_products_query = $conn->query( $sql );
    if ( $total_products_query ) {
        $data           = $total_products_query->fetch_assoc();
        $total_products = $data[ 'total_products' ];
    }

    # Total number of products in stock
    $sql                            = "SELECT * FROM retailer_products WHERE availability = 1 AND status = 'ACTIVE' AND retailer_id = $retailer_id";
    $total_products_in_stock_query  = $conn->query( $sql );
    $total_products_in_stock_result = $total_products_in_stock_query->num_rows;

    # Total number of products out ofstock
    $sql                             = "SELECT * FROM retailer_products WHERE availability = 0 AND retailer_id = $retailer_id";
    $total_products_out_stock_query  = $conn->query( $sql );
    $total_products_out_stock_result = $total_products_out_stock_query->num_rows;
?>

<div class="container-fluid">
    <div class="row">
        <nav id="mob-menu-wrapper" class="hidden-xs">
            <?php include 'include/dashboard_navigation.php'; ?>
        </nav> <!-- end navigation -->

        <div class="col-md-11 col-lg-11 col-sm-11 col-xs-12 col-md-offset-2 col-lg-offset-2 col-sm-offset-3">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-10 col-xs-12">
                    <div class="row cf">
                        <div class="ovr-all">
                            <p>Total Clicks</p>
                            <h1><?php echo $total_clicks; ?></h1>
                        </div>
                        <div class="ovr-all">
                            <p>Total Products</p>
                            <h1><?php echo $total_products; ?></h1>
                        </div>
                        <div class="ovr-all">
                            <p>Active Products</p>
                            <h1><?php echo $total_active_products; ?></h1>
                        </div>
                        <div class="ovr-all">
                            <p>Budget Balanace</p>
                            <h1>&#x20b5;<?php echo round( $budget_balance, 2 ); ?></h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-9">
                        <div class="box box-wrapper">
                            <div class="box-header">
                                <h4>Products</h4>
                            </div>
                            <div class="box-body cf">
                                <div class="ovr-all">
                                    <p>Total Products</p>
                                    <h1><?php echo $total_products; ?></h1>
                                </div>
                                <div class="ovr-all">
                                    <p>Products in stock</p>
                                    <h1><?php echo $total_products_in_stock_result; ?></h1>
                                </div>
                                <div class="ovr-all ">
                                    <p>Products out of stock</p>
                                    <h1><?php echo $total_products_out_stock_result; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-9">
                        <div class="box box-wrapper">
                            <div class="box-header">
                                <h4>CSV Template</h4>
                            </div>
                            <div class="box-body download-tem cf">
                                <div class="ovr-all">
                                    <p>Download template</p>
                                    <h1><a href="assets/downloads/pricedrummer_csv_template.csv"><img width="20%" style="display: block; width: 20%; margin: 10px auto 0;" src="assets/svg/document-icon.svg" alt=""></a></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'include/scripts.php'; ?>
<?php require 'include/footer.php'; ?>
