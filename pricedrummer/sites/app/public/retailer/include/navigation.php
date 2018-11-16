<nav class="navbar navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header visible-xs">
            <!--            <a href="javascript:void(0)" class="offcanvas-toggle" id="offcanvas-toggle" aria-expanded="false">-->
            <!--                                <i class="fa fa-bars fa-2x" aria-hidden="true"></i>-->
            <!--            </a>-->
            <!--            <a href="javascript:void(0)" class="" aria-expanded="false">-->
            <!--                                <i class="fa fa-user-cicle fa-2x" aria-hidden="true"></i>-->
            <!--            </a>-->
            <button id="mob-menu" class="hamburger hamburger--elastic" type="button">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>

        <div class="navbar-header hidden-xs">
            <a href="javascript:void(0)" type="button" class="offcanvas-toggle" id="offcanvas-toggle"
               aria-expanded="false">

            </a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--      <a class="navbar-brand" href="index.php"><img src="assets/images/pxdm_logo_black.png" alt="" width="200" style="margin-top: -15px;"></a>-->
            <a class="hidden-xs navbar-brand" href="index.php">PriceDrummer Retailer</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">

                <?php if ( isset( $_SESSION[ 'retailer_user_id' ] ) ) { ?>
                    <li class="hidden-xs"><a href="index.php?logout">Logout</a></li>
                    <li class="visible-xs">
                        <a href="index.php?logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
                    </li>
                    <!-- <li><a href="dashboard.php">Dashboard</a></li> -->
                <?php } else { ?>
                    <li><a href="index.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php } ?>

                <!-- <li><a href="wizard.php">Wizard</a></li> -->
                <!-- <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li> -->
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
