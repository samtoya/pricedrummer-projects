<?php

    require_once '../connections/db_connect.php';

    if ( isset( $_GET[ 'email' ] ) ) {

        $email = $conn->real_escape_string( trim( $_GET[ 'email' ] ) );

        $sql = "SELECT * FROM `users` WHERE username = '". $email ."' LIMIT 1";

        $result = $conn->query( $sql );

        if ($result) {
            $user = $result->fetch_object();
            if ( $result->num_rows > 0 ) {
                // Found a user
                echo "false";
            } else {
                // Dint find a user
                echo "true" ;
            }
        }
    }
?>

