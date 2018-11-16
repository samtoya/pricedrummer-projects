<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PriceDrummer Newsletter</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<style>
		body {
			font-family: Merriweather, sans-serif;
		}
		
		div.input-wrapper {
			margin-top: 10px;
		}
		
		.input-wrapper input[type=text],
		.input-wrapper input[type=email] {
			padding: 8px;
			width: 220px;
			-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;
			border: thin solid #9c9c9c;
			font-size: 12px;
		}
		
		ul {
			margin: 0;
			padding: 0;
		}
		
		.error {
			background-color: #f00;
			color: #fff;
			margin: 5px 0;
			padding: 10px;
			-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;
			width: 450px;
		}
		
		.success {
			background-color: #0f0;
			color: #fff;
			margin: 5px 0;
			padding: 10px;
			-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;
			width: 450px;
		}
	</style>
</head>
<body>

<?php
	# Requre the MySQL connection file.
	require_once '../connections/MySQL.php';
	# Require the functions file.
	require_once "../include/functions.php";
	# Require the PHPMailer autoloader.
	require_once "../vendor/autoload.php";
	//	require_once "../vendor/phpmailer/phpmailer/class.phpmailer.php";
	//	require_once "../vendor/phpmailer/phpmailer/class.smtp.php";
	
	//	use PHPMailer\PHPMailer;
	
	# Start processing the email field.
	if ( isset( $_POST[ 'submit' ] ) ) {
		# Error messages
		$messages = [];
		# Check if the email field is empty or blank
		if ( $_POST[ 'email' ] == '' || empty( $_POST[ 'email' ] ) ) {
			$messages[ 'error' ] = "Please provide your email address.";
		} elseif ( $_POST[ 'full_name' ] == '' || empty( $_POST[ 'full_name' ] ) ) {
			$messages[ 'error' ] = "Please provide your full name.";
		} else {
			# Process the email field.
			$full_name = mysqli_real_escape_string( $link, trim( $_POST[ 'full_name' ] ) );
			$email = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) );
			
			# Check if the user already exist in the database
			$query = "SELECT id FROM pxdm_cr.newsletter WHERE email = '{$email}'";
			$result = mysqli_query( $link, $query );
			
			if ( mysqli_num_rows( $result ) == 1 ) {
				$messages[ 'error' ] = "You have already subscribed for our newsletter";
			} else {
				# User has not subscribe to our newsletter.
				# Insert the email into the database.
				$query = "INSERT INTO pxdm_cr.newsletter( full_name, email ) VALUES ( '{$full_name}', '{$email}' )";
				if ( ! $result ) $messages[ 'error' ] = "Oh dear! Something went wrong, please contact the site administrator";
				# Send the email to the database.
				$result = mysqli_query( $link, $query );
				
				# Instantiate the PHPMailer
//				$mail = new PHPMailer;
//				$mail->isSendmail();
//				$mail->isSMTP();
//				$mail->Host = "smtp.google.com";
//				$mail->Port = 25;
//				$mail->Username = "admin@pricedrummer.com.gh";
//				$mail->Password = "PxDmAdmin12!";
//				$mail->SMTPAuth = false;
//				$mail->SMTPSecure = "ssl";
				# PHPMailer Configuration
//				$mail->setFrom( 'no-reply@pricedrummer.com.gh', 'PriceDrummer Newsletter' );
//				$mail->addReplyTo( 'support@pricedrummer.com.gh', 'Support Center' );
//
//				$mail->addAddress( 'admin@pricedrummer.com.gh', 'Administrator' );
//				$mail->addAddress( $email );
				# Send a confirmation message to the email.
				
//				$mail->Subject = "PriceDrummer Newsletter Subscription";
//				$mail->Body = "Thank you for subscribing with us.";
				
				# Send message to the email provided
//				if ( $mail->send() ) {
//					$messages[ 'success' ] = "Message has been sent successfully!";
//					redirect_to( 'index.php?success=true' );
//				} else {
//					$messages[ 'error' ] = "Not sent: " . $mail->ErrorInfo;
//				}
				
				$fromEmail = "no-reply@pricedrummer.com.gh";
				$fromName = "PriceDrummer Newsletter";
				
				$subject = "Newsletter Subscription";
				$body = "Thank you for subscribing with us";
				
				$headers = "From: {$fromName}<{$fromEmail}>" . "\r\n";
				$headers .= "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/plain;charset=UTF-8";
				
				if ( mail( $email, $subject, $body, $headers ) ) {
					$messages[ 'success' ] = "Message has been sent successfully!";
				} else {
					$messages[ 'error' ] = "Failed to send message.";
				}
			}
		}
	}
?>

<h2>Newsletter</h2>
<?php if ( isset( $messages ) && $messages != '' ): ?>
	<ul>
		<?php foreach ( $messages as $key => $message ): ?>
			<li class="<?php echo $key; ?>"> <?php echo $message ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>


<form action="index.php" method="post">
	<div class="input-wrapper">
		<input type="text" name="full_name" placeholder="Enter your name"
		       value="<?php if ( isset( $_POST[ 'full_name' ] ) ) {
			       echo $_POST[ 'full_name' ];
		       } ?>">
	</div>
	
	<div class="input-wrapper">
		<input type="email" name="email" placeholder="Enter your email" value="<?php if ( isset( $_POST[ 'email' ] ) ) {
			echo $_POST[ 'email' ];
		} ?>">
	</div>
	
	<div class="input-wrapper">
		<input type="submit" name="submit" value="Subscribe">
	</div>
</form>
</body>
</html>