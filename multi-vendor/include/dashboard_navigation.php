<div class="menu-wrapper">
    <ul class="menu">
        <a href="dashboard.php">
            <!-- Apply class:active to li -->
            <li class="<?php if(isset($DASHBOARD)){echo'active';}?>">
                <i class="fa fa-home fa-2x"></i><br>
                <span>Home</span>
            </li>
        </a>
        <a href="budget.php">
            <li class="<?php if(isset($SET_BUDGET)){echo'active';} ?>">
                <i class="fa fa-money fa-2x"></i><br>
                <span><?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'Set a Budget';}else{echo 'Update Budget';}?></span>
            </li>
        </a>
        <a href="list_product.php" class="<?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>">
            <li  class="
                        <?php if(isset($LIST_PRODUCTS)){echo'active';}?>
                        <?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>
                        ">
                <i class="fa fa-plus fa-2x"></i><br>
                <span>List Products</span>
            </li>
        </a>
        <a href="select_overview_category.php" class="<?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>">
            <li class="<?php if(isset($PRODUCT_OVERVIEW)){echo'active';}?> <?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>">
                <i class="fa fa-database fa-2x"></i><br>
                <span>Products Overview</span>
            </li>
        </a>
        <a href="invoice.php" class="<?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>">
            <li class="<?php if(isset($INVOICES)){echo'active';}?> <?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>">
                <i class="fa fa-file-o fa-2x"></i><br>
                <span>Invoices</span>
            </li>
        </a>
        <a href="settings.php" class="<?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>">
            <li class="<?php if(isset($SETTINGS)){echo'active';}?> <?php if(isset($_SESSION['retailer_status'])&& $_SESSION['retailer_status'] =='First_Time'){echo 'no-action';}?>">
                <i class="fa fa-gear fa-2x"></i><br>
                <span>Settings</span>
            </li>
        </a>
    </ul>
</div> <!-- end menu wrapper -->
