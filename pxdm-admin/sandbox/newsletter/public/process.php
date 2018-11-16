<?php
	# Require the functions file.
	require_once "../include/functions.php";
	
	# Start processing the email field.
	if ( isset( $_POST[ 'submit' ] ) ) {
		// Check if the email field is empty or blank
		if ( $_POST[ 'email' ] == '' || empty( $_POST[ 'email' ] ) ) {
			$error = "You cannot leave this field blank.";
			redirect('index.php?err=1');
		} else {
			// Process the email field.
			$email = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) );
			$sql = "INSERT INTO pxdm_cr.newsletter( email ) VALUES ( '{$email}' )";
			// Send the email to the database.
			$result = mysqli_query( $link, $sql );
			if ( ! $result ) echo "Query failed: " . mysqli_error( $link );
			// Send a confirmation message to the email.
			$message = "Thank you for subscribing with us.";
			$subject = "PriceDrummer Newsletter Subscription";
			
			if ( mail( $email, $subject, $message ) ) {
				$message = "Message sent";
				redirect('index.php?success=1');
			} else {
				$message = "Not sent";
				redirect('index.php?err=1');
			}
		}
	}
