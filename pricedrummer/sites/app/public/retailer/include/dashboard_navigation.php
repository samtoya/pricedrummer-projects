<?php
    $size = 300;

    $retailer_id            = $conn->real_escape_string( $_SESSION[ 'retailer_user_id' ] );
    $sql                    = "SELECT * FROM retailers WHERE id = $retailer_id LIMIT 1";
    $retailer_result        = $conn->query( $sql );
    $retailer_results_query = $retailer_result->fetch_object();
    $merchant_id            = trim( $retailer_results_query->merchant_ID );

    # Get the merchant information
    $sql             = "SELECT * FROM merchant WHERE merchant_ID = $merchant_id LIMIT 1";
    $merchant_query  = $conn->query( $sql );
    $merchant_result = $merchant_query->fetch_object();

    $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $retailer_results_query->email ) ) ) . "?s=" . $size;
?>
<div class="menu-wrapper">
    <div id="user-info">
        <div class="avatar-container">
            <?php if ( ! empty( $merchant_result->logo ) ) : ?>
                <img class="avatar" src="data:image/jpeg;base64,<?= $merchant_result->logo; ?>">
            <?php else : ?>
<!--                <img class="avatar" src="assets/images/no-image.png" alt="">-->
                <img class="avatar" src="<?php echo $grav_url; ?>" alt="" />
            <?php endif; ?>
        </div>
        <?php if ( ! empty( $merchant_result->url ) ): ?>
            <a href="<?= $merchant_result->url; ?>" target="_blank">
                <p id="company-name"><i class="fa fa-building-o"
                                        aria-hidden="true"></i> <?php echo $retailer_results_query->company_name; ?></p>
            </a>
        <?php else: ?>
            <p id="company-name"><i class="fa fa-building-o"
                                    aria-hidden="true"></i> <?php echo $retailer_results_query->company_name; ?></p>
        <?php endif; ?>
    </div>
    <ul class="menu">
        <a href="dashboard.php">
            <!-- Apply class:active to li -->
            <li class="<?php if ( isset( $DASHBOARD ) ) {
                echo 'active';
            } ?>">
                <i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>
                <span>Dashboard</span>
            </li>
        </a>
        <a href="budget.php">
            <li class="<?php if ( isset( $SET_BUDGET ) ) {
                echo 'active';
            } ?>">
                <i class="fa fa-money fa-2x"></i>
                <span><?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
                        echo 'Set a Budget';
                    } else {
                        echo 'Update Budget';
                    } ?></span>
            </li>
        </a>
        <a href="list_product.php"
           class="<?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
               echo 'no-action';
           } ?>">
            <li class="
                        <?php if ( isset( $LIST_PRODUCTS ) ) {
                echo 'active';
            } ?>
                        <?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
                echo 'no-action';
            } ?>
                        ">
                <i class="fa fa-plus fa-2x"></i>
                <span>List Products</span>
            </li>
        </a>
        <a href="select_overview_category.php"
           class="<?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
               echo 'no-action';
           } ?>">
            <li class="<?php if ( isset( $PRODUCT_OVERVIEW ) ) {
                echo 'active';
            } ?> <?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
                echo 'no-action';
            } ?>">
                <i class="fa fa-database fa-2x"></i>
                <span>Products Overview</span>
            </li>
        </a>
        <a href="invoice.php"
           class="<?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
               echo 'no-action';
           } ?>">
            <li class="<?php if ( isset( $INVOICES ) ) {
                echo 'active';
            } ?> <?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
                echo 'no-action';
            } ?>">
                <i class="fa fa-file-o fa-2x"></i>
                <span>Invoices</span>
            </li>
        </a>
        <a href="settings.php"
           class="<?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
               echo 'no-action';
           } ?>">
            <li class="<?php if ( isset( $SETTINGS ) ) {
                echo 'active';
            } ?> <?php if ( isset( $_SESSION[ 'retailer_status' ] ) && $_SESSION[ 'retailer_status' ] == 'First_Time' ) {
                echo 'no-action';
            } ?>">
                <i class="fa fa-gear fa-2x"></i>
                <span>Settings</span>
            </li>
        </a>
        <a href="index.php?logout" class="visible-xs">
            <!-- Apply class:active to li -->
            <li>
                <i class="fa fa-power-off fa-2x" aria-hidden="true"></i>
                <span>Logout</span>
            </li>
        </a>
    </ul>
</div> <!-- end menu wrapper -->
