<?php
    $REGISTER = "";
?>
<?php
    include( '../connections/db_connect.php' );//connect to the database
    include( 'generate_rand_char.php' );
//	echo "<pre>" .  print_r($_POST);

    $legal_name            = $conn->real_escape_string( $_POST[ 'legal_name' ] );
    $registration_number   = $conn->real_escape_string( $_POST[ 'registration_number' ] );
    $company_address       = $conn->real_escape_string( $_POST[ 'company_address' ] );
    $email                 = $conn->real_escape_string( $_POST[ 'email' ] );
    $password              = $conn->real_escape_string( hash( 'sha512', $_POST[ 'password' ] ) );
    $password_confirmation = $conn->real_escape_string( $_POST[ 'password_confirmation' ] );
    $contact_number        = $conn->real_escape_string( $_POST[ 'contact_number' ] );
    $country               = $conn->real_escape_string( $_POST[ 'country' ] );
    $city                  = $conn->real_escape_string( $_POST[ 'city' ] );
    $activation_code       = random_str( 50 );
    $activation_code       .= "-" . hash( 'sha512', $_POST[ 'email' ] );

    //Creat a merchant record for the ofline retailer then enter the rest of the info into the retailer table with refernce to the merchant id created here
    $Merchant_sql = "INSERT INTO `merchant` (`name`) VALUES ('" . $legal_name . "');";
    $result       = $conn->query( $Merchant_sql );

    if ( $result === true ) {
        echo "New record created successfully";
        $Merchant_ID = $conn->insert_id;
        $Merchant_ID = $conn->real_escape_string( $Merchant_ID );

//        die( $Merchant_ID );
    } else {
        //error creating merchant
//        echo "Error: " . $Merchant_sql . "<br>" . $conn->error;
        //die("<h1>no</h1>");
        header( 'Location: ../register_results.php?success=0' );
    }


    $Retailer_sql = sprintf( "INSERT INTO `retailers` (`merchant_ID`, `company_name`, `registration_number`, `shop_address`, `telephone1`, `email`, `country`, `city`, `account_status`)
		VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
        $Merchant_ID,
        $legal_name,
        $registration_number,
        $company_address,
        $contact_number,
        $email,
        $country,
        $city,
        "NEW" );
    $result1      = $conn->query( $Retailer_sql );
    if ( $result1 === true ) {
        //die("<h1>yes</h1>");
        $Users_sql = "INSERT INTO `users` (`username`, `password`, `user_type`, `status`, `activation_code`) VALUES ('" . $email . "', '" . $password . "', 'RETAILER', 'N', '" . $activation_code . "')";
        $result2   = $conn->query( $Users_sql );
        if ( $result2 === true ) {
            echo "User created successfully";
            // die("<h1>yes</h1>");
            header( 'Location: ../register_results.php?success=1' );
        } else {
            //error creating user
            //echo "Error: " . $Users_sql . "<br>" . $conn->error;
            //die("<h1>no</h1>");
            header( 'Location: ../register_results.php?success=0' );
        }


    } else {
        //error inserting retailer details
        //echo "Error: " . $Retailer_sql . "<br>" . $conn->error;
        //die("<h1>no</h1>");
        header( 'Location: ../register_results.php?success=0' );
    }
