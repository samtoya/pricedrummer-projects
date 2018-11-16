<?php
    $LOGIN_PAGE = ""; //Initialise this variable to tell the program you are on the login or index page
?>
<?php require 'include/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 hidden-xs">
            <div class="map-area">
                <!-- <?php # include 'assets/svg/ghanaHigh.svg'; ?> -->
                <div id="mapdiv" style="width: 800px; height: 360px;"></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
            <div class="form-wrapper pull-right">
                <div class="form-wrapper-header">
                    <h4>Sign in to your account</h4>
                </div>

                <div class="form-wrapper-body">
                    <form action="include/login_retailer.php" method="POST">
                        <?php
                            if ( isset( $_GET[ 'login' ] ) ) {

                                echo "<p style='text-align:center; color:red'><b>USER NOT FOUND</b></p>";
                            }

                        ?>
                        <div class="form-input-wrapper">
                            <label for="email">Email:</label>
                            <input type="email" name="email">
                        </div>

                        <div class="form-input-wrapper">
                            <label for="password">Password:</label>
                            <input type="password" name="password">
                        </div>

                        <div class="form-button-wrapper">
                            <input type="submit" value="Login" name="submit">
                        </div>
                    </form>
                </div>

                <div class="form-wrapper-footer">
                    <p>Need help?: <a href="reset.php">Forgot Password</a></p>
                </div>
            </div> <!-- end form-wrapper div -->

            <div class="register-info pull-right">
                <h4>Create a retailer account</h4>
                <p><a href="register.php">Register</a> &amp; start
                    listing listing on PriceDrummer</p>
            </div>

        </div>
    </div>

    <div class="row middle-wrapper">
        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="icon-wrapper">
<!--                <h1 class="glyphicon glyphicon-cog"></h1>-->
                <h1><img src="assets/images/setup_account.svg" alt=""></h1>
                <h3>Setup Account</h3>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="icon-wrapper">
<!--                <h1 class="glyphicon glyphicon-plus"></h1>-->
                <h1><img src="assets/images/budget.png" alt=""></h1>
                <h3>Set a Budget</h3>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-12">
            <div class="icon-wrapper">
<!--                <h1 class="glyphicon glyphicon-shopping-cart"></h1>-->
                <h1><img src="assets/images/list_sell.png" alt=""></h1>
                <h3>List or Sell</h3>
            </div>
        </div>
    </div>
</div> <!-- end container div -->


<?php require 'include/scripts.php'; ?>
<?php require 'include/footer.php'; ?>
