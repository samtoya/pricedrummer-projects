<?php 
$page ="Activation_page";
require '../include/header.php'; ?>
<?php

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <nav class="col-md-1 col-lg-1">
            </nav> <!-- end navigation -->

            <div class="col-md-11 col-lg-11" style="margin-left: -45px;">
                <div class="col-md-12 col-lg-12">
                <?php if(isset($_GET['a_success']) && $_GET['a_success'] ==0){
                ?>
                <p>There was a problem with activation please try again or contact pricedrummer</p>
                <?php
                    }
                ?>
                    <form action="../include/activate_retailer.php" method="POST">
                        <input type="text" name="code" value="<?php if(isset($_GET['code'])){echo $_GET['code'];}?>" onclick="$(this).select();">
                        <input type="submit" name="" value="Activate Account">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../include/scripts.php'; ?>
<?php require '../include/footer.php'; ?>
