<?php
	
	$link = new mysqli( 'localhost', 'pxdm', '7936_Pxd$*M' );
	
	$sql = "INSERT INTO pxdm_cr.newsletter(email) VALUES(?) ";
	
	$stmt = $link->prepare( $sql );
	
	$stmt->bind_param( 's', $_POST[ 'email' ] );
	
	if ( $stmt->execute() ) {
		echo "Thank you for subscribing with us";
	} else {
		echo "Oops! Something went wrong";
	}
	
	$stmt->close();
	
	$link->close();