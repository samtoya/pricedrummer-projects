<?php
    include 'configuration/config.php';
    include 'connections/db_connect.php';
    $page = "Register_Results_page"; ?>

<?php
    if ( isset( $_GET[ "ac" ] ) ) {
        $activation_code = trim( $_GET[ "ac" ] );

        $sql = "SELECT * FROM `users` WHERE `status` = 'N' AND `activation_code` LIKE '". $activation_code ."'";

        $retailer_results = $conn->query( $sql );

        if ( $retailer_results ) {
            if ( $retailer_results->num_rows > 0 ) {
                $sql = "UPDATE users SET status = 'A' WHERE activation_code = '". $activation_code ."'";
                $result = $conn->query( $sql );
                if ($conn->affected_rows == 1) {
//                    return true;
                } else {
                    // Activation wasnt successful, call PRICEDRUMMER.
//                    return false;
                }
            }
        }
    } else {
        header("Location: index.php");
        exit;
    }
?>

<?php require 'include/header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <nav class="col-md-1 col-lg-1">
                    <!--                --><?php //include 'include/dashboard_navigation.php'; ?>
                </nav> <!-- end navigation -->

                <div class="col-md-11 col-lg-11"
                ">
                <div class="col-md-12 col-lg-12">
                    <div class="message col-md-7 col-lg-7 col-md-offset-3 col-lg-offset-3">
                        <h3><i style="color: #9affca;" class="fa fa-check"></i> Email Verification Successful!
                        </h3>
                        <p>Your account has been activated.</p>
                        <p>Please login to continue.</p>
                        <p><a class="btn btn-primary" href="index.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php require 'include/scripts.php'; ?>
<?php require 'include/footer.php'; ?>