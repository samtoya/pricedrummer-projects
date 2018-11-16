<?php $page="Register_Results_page"; ?>
<?php require 'include/header.php'; ?>
<?php
if (isset($_GET["success"])) {
    $success = trim($_GET["success"]);
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav class="col-md-1 col-lg-1">
<!--                --><?php //include 'include/dashboard_navigation.php'; ?>
            </nav> <!-- end navigation -->

            <div class="col-md-11 col-lg-11" style="margin-left: -45px;">
                <div class="col-md-12 col-lg-12">
                    <?php if ($success == "1") { ?>
                        <div class="message col-md-7 col-lg-7 col-md-offset-3 col-lg-offset-3">
                            <h3><i style="color: #9affca;" class="fa fa-check"></i> Registration Completed Successfully!
                            </h3>
                            <p>A mail will be sent to you within 24hours with an
                                activation code to activate your account.</p>
                            <p>Please Check your mail to continue.</p>
                            <p><a href="index.php">Return to login page</a></p>
                        </div>
                    <?php } elseif ($success == "0") { ?>

                        <div class="message col-md-7 col-lg-7 col-md-offset-3 col-lg-offset-3">
                            <h3><i style="color: #ff9595;" class="fa fa-times"></i> Sorry!!. Something went wrong with the registration prosess
                            </h3>
                            <p></p>
                            <p>
                                <a href="register.php">Return to Register Page</a> Or <a href="index.php">Return to login
                                    page</a>
                            </p>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'include/scripts.php'; ?>
<?php require 'include/footer.php'; ?>
