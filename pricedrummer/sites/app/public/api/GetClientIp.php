<?php
	include( 'connections/db_connect.php' );//connect to the database
	// CORS enablement
	header( "Access-Control-Allow-Origin: *" );

	$sql = "INSERT INTO `visitors`(country, city, ip, latitude, longitude, region, user_a_ip) VALUES(?, ?, ?, ?, ?, ?, ?)";

	# Prepare the sql query
	$stmt = $conn->prepare( $sql );

	$country     = $_POST[ 'country' ];
	$city        = $_POST[ 'city' ];
	$ip          = $_POST[ 'ip' ];
	$region      = $_POST[ 'region' ];
	$location    = explode( ',', $_POST[ 'location' ] );
	$latitude    = $location[0];
	$longitude   = $location[1];
    $user_agent   = $ip.$_SERVER['HTTP_USER_AGENT'];

	# Bind the parameters
	$stmt->bind_param( 'sssssss', $country, $city, $ip, $latitude, $longitude, $region, $user_agent );

	# Execute the query.
	$stmt->execute();

	# Free the stmt variable.
	$stmt->close();

	$conn->close();