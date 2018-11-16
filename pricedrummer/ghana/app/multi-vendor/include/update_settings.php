<?php
if ( empty( $_SESSION ) ) {
	session_start();
}
# Update the fields
include "../connections/db_connect.php";

$retailer_id     = $conn->real_escape_string( $_POST[ 'retailer_id' ] );
$sql             = "SELECT * FROM `retailers` WHERE id = " . $retailer_id;
$retailer_result = $conn->query( $sql );

$retailer_returned_row = $retailer_result->fetch_object();
$merchant_id           = $retailer_returned_row->merchant_ID;

# Company Information Processing
if ( isset( $_POST[ 'com_info_submit' ] ) ) {
	$company_name        = $conn->real_escape_string( $_POST[ 'company_name' ] );
	$registration_number = $conn->real_escape_string( $_POST[ 'registration_number' ] );
	$company_address     = $conn->real_escape_string( $_POST[ 'shop_address' ] );
	$website             = $conn->real_escape_string( $_POST[ 'url' ] );

	$retailer_update_sql    = "UPDATE retailers  SET company_name = '" . $company_name . "', registration_number = '" . $registration_number . "', shop_address = '" . $company_address . "' WHERE id = " . $retailer_id;
	$retailer_update_result = $conn->query( $retailer_update_sql );
	if ( $retailer_update_result ) {
		echo "y";
		//First Image
		$Image_1_name      = $_FILES[ 'logo' ][ 'name' ];
		$Image_1_type      = $_FILES[ 'logo' ][ 'type' ];
		$Image_1_extension = strtolower( substr( $Image_1_name, strpos( $Image_1_name, '.' ) + 1 ) );
		$Image_1_size      = $_FILES[ 'logo' ][ 'size' ];

		$merchant_sql      = "UPDATE `merchant` SET url = '" . $website . "' WHERE merchant_ID =" . $merchant_id;
		$merchant_result   = $conn->query( $merchant_sql );

		if ( ! empty( $Image_1_name ) ) {
			if ( ( $Image_1_extension == 'jpg' || $Image_1_extension == 'jpeg' || $Image_1_extension == 'png' ) && ( $Image_1_type == 'image/jpeg' || $Image_1_type == 'image/png' ) ) {

				// Image submitted by form. Open it
				$image        = addslashes( $_FILES[ 'logo' ][ 'tmp_name' ] );
				$content      = file_get_contents( $image );
				$content      = base64_encode( $content );
				$name         = $conn->real_escape_string( $Image_1_name );
				$image_sql    = "UPDATE `merchant` SET logo='" . $content . "', url='" . $website . "' where merchant_ID =" . $merchant_id;
				$image_result = $conn->query( $image_sql );
			} else {
				die( 'File must be jpg/jpeg/png and must be 1mb or less! ' );
			}
		}
		header( "Location: ../public/settings.php?update=true&tab=1" );
		exit();
	} else {
		echo "Error: " . $retailer_update_sql . "<br>" . $conn->error;
	}
}

# Account information processing
if ( isset( $_POST[ 'acc_info_submit' ] ) ) {
	$email      = $conn->real_escape_string( $_POST[ 'email' ] );
	$telephone1 = $conn->real_escape_string( $_POST[ 'telephone1' ] );
	$telephone2 = $conn->real_escape_string( $_POST[ 'telephone2' ] );
	$country    = $conn->real_escape_string( $_POST[ 'country' ] );
	$city       = $conn->real_escape_string( $_POST[ 'city' ] );

	$sql  = "UPDATE retailers 
				SET email = ?, telephone1 = ?, telephone2 = ?, country = ?, city = ? WHERE id = $retailer_id";
	$stmt = $conn->prepare( $sql );
	$stmt->bind_param( 'sssss', $email, $telephone1, $telephone2, $country, $city );
	if ( $stmt->execute() ) {
		if ( $stmt->affected_rows == 1 ) {
			header( "Location: ../public/settings.php?update=true&tab=2" );
			exit();
		} else {
			echo "<h1>" . "Failed to update: " . $stmt->error . "</h1>";
		}
	}
}

# Change password processing
if ( isset( $_POST[ 'ch_pass_submit' ] ) ) {
	$sanitized_password = trim( $conn->real_escape_string( $_POST[ 'current_password' ] ) );
	$encrypted_password = hash( 'sha512', $sanitized_password );

	$sql    = "SELECT id FROM users WHERE username = '{$_SESSION['retailer_email']}' AND password = '{$encrypted_password}' LIMIT 1";
	$stmt   = $conn->query( $sql );
	$result = $stmt->fetch_object();
	if ( ! empty( $result ) ) {
		# The curent provided password is correct!
		$new_password    = trim( $conn->real_escape_string( $_POST[ 'password' ] ) );
		$repeat_password = trim( $conn->real_escape_string( $_POST[ 'repeat_password' ] ) );

		if ( $new_password === $repeat_password ) {
			# Update the password field.
			$encrypted_password = hash( 'sha512', $new_password );
			$sql                = "UPDATE users SET password = ? WHERE id = $result->id";
			$stmt               = $conn->prepare( $sql );
			$stmt->bind_param( 's', $encrypted_password );
			$stmt->execute();
			if ( $stmt->affected_rows == 1 ) {
				header( 'Location: ../public/settings.php?update=true&tab=3' );
				exit();
			} else {
				echo "Update failed";
				exit();
			}
		} else {
			echo "Passwords do not match!";
		}

	} else {
		echo "The password you provided is wrong!";
	}
}