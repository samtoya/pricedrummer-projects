<?php
include_once('../api/connections/db_connect.php');//connect to the database
include_once('../api/get_country_name_redirect.php');

function random20() {
    $number = "";
    for($i=0; $i<20; $i++) {
        $min = ($i == 0) ? 1:0;
        $number .= mt_rand($min,9);
    }
    return $number;
}

$merchant_url    = "";
$merchant_logo   = "";
$merchant_id     = "";
$category_id     = "";
$CurrentUserIP   = "";
$CurrentUserCountry  = "";

//Collect the merchant url if any was sent
    if ( isset( $_POST[ 'merchant_url' ] ) ) {
        $merchant_url = $conn->real_escape_string($_POST[ 'merchant_url' ]);
    }
    
    //Collect the merchant logo if any was sent
    if ( isset( $_POST[ 'merchant_logo' ] ) ) {

        $merchant_logo = $_POST[ 'merchant_logo' ];
    }

    if ( isset( $_POST[ 'merchant_id' ] ) ) {
        $merchant_ID = $conn->real_escape_string($_POST[ 'merchant_id' ]);

        $sql = "SELECT * FROM products where product_ID = ".$merchant_ID." limit 1";
        $result = $conn->query($sql);
        if($result){
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $merchant_id =  $row["merchant_ID"];
                }
            }
        }

    }

    if ( isset( $_POST[ 'category_id' ] ) ) {
        $category_id = $conn->real_escape_string($_POST[ 'category_id' ]);
    }

    if ( isset( $_POST[ 'CurrentUserIP' ] ) ) {
        $CurrentUserIP= $conn->real_escape_string($_POST[ 'CurrentUserIP' ]);
    }

    if ( isset( $_POST[ 'CurrentUserCountry' ] ) ) {
            $CurrentUserCountry= $conn->real_escape_string($_POST[ 'CurrentUserCountry' ]);
    }


    $Click_amount 					= -0.1;
    $doc_number 					= "IC";
    $doc_number 					.=  random20();




    //Charge the amount set to the retailer for item clicked
    $add_budget_trail_sql = "INSERT INTO `retailer_invoice_trail` (`retailer_id`, `user_ip`, `country`, `category`, `item_clicked`, `doc_number`, `amount`, `invoice_type`) VALUES ( ".$merchant_id.", '".$CurrentUserIP."', '".$CurrentUserCountry."', '".$category_id."', '".$merchant_url."', '".$doc_number."', '".$Click_amount."', 'ITEM_CLICKED')";
    $add_budget_trail_result = $conn->query($add_budget_trail_sql);

    if ($add_budget_trail_result === TRUE) {
        //echo "1";		//All is well
    } else {

    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Thank you for visiting our site</title>
    <style>
        .container {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            width: 1000px;
            margin: 0 auto;
        }

        .message_container {
            width: 50%;
            margin: 150px auto;
            text-align: center;
            box-shadow: 0px 0px 4px #DDD;
            padding: 20px;
        }

        .message_container p.link {
            font-size: 18px;
        }

        .message_container #merchant_logo {
            margin-top: 0;
            margin-left: -20px;
        }

        .message_container #site_logo {
            width: 200px;
        }

        img#merchant_logo {
            margin-left: 30px;
        }

        .message_container #preloader {
            display: block;
            margin: 0 auto;
        }


    </style>
</head>
<body>
<div class="container" style="margin-top: 20px;">
    <div class="message_container">
        <h2>Thanks for visiting PriceDrummer</h2>
        <p class="link">You're on your way to </p>
        <a href="#"><img id="merchant_logo" width="100px"
                         src="http://www.pricedrummer.com/images/static/merchants/<?php echo $country; ?>/<?php echo $merchant_logo; ?>.jpg"
                         alt=""></a>
        <img id="preloader" src="../img/preloader.gif" alt="">
        <p>We hope to see you again</p>
        <img id="site_logo" src="../img/site-logo/pxdm_logo.png" alt="">
    </div>
</div>
<div style="display: none">
    <?php
    var_dump($_POST);
    echo "<br>Merchant ".$merchant_id;
    ?>
</div>
</body>
</html>

<script>

    // Redirect the user to the selected product site after 5 seconds
    window.setTimeout(function () {

        // Goto the product site
        window.location.href = "<?php echo $merchant_url;?>";

    }, 5000);

</script>