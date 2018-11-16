<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	require '../assets/plugins/PHPMailer-master/PHPMailerAutoload.php';
	require_once('../connections/db_connect.php');//connect to the database
	
	//get the current user from the session variable set at login
	$user_id = 0;
	if(isset($_SESSION['user_id'])){
		$user_id = $conn->real_escape_string($_SESSION['user_id']);
	}
	$retailer_id = $conn->real_escape_string($_POST['retailer_id']);
	$status = $_POST['status'];

	if($status ==1){
		$Update_Retailer_sql = 'UPDATE `users` SET `status` = "A", `reviewed_by`='.$user_id.' WHERE `users`.`id` = '.$retailer_id;
		$Update_Retailer_result = $conn->query($Update_Retailer_sql);

		$retailers_sql = 'SELECT * FROM `users` where `id`='.$retailer_id;
		$retailers_result = $conn->query($retailers_sql);
		$row = $retailers_result->fetch_assoc();
		$Activation_Code = $row['activation_code'];

		if($Update_Retailer_result){
			//Send the retailer a mail

			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'mail.pricedrummer.com.gh';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'admin@pricedrummer.com.gh';                 // SMTP username
			$mail->Password = 'PxDmAdmin12!';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('admin@pricedrummer.com.gh', 'PRICEDRUMMER');
			$mail->addAddress('theoshark22@gmail.com', 'Theophilus Sharkson');     // Add a recipient

			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'PRICEDRUMMER Retailer Activation';
			$mail->Body    = 'Please click the following link to activate your account<br/> 
							<a href="http://localhost/multi-vendor/public/retailer_account_activation.php?code='.$Activation_Code.'">Click Here<a/>
							<br/><br/><hr/>
							<h5>Having Troubles with the link??</h5>
							Please use the following activation code to activate your account
							<br/><strong>Activatoin Code:</strong>'.$Activation_Code.'<br/>';
			$mail->AltBody = 'Please use the following activation code to activate your account \n Activatoin Code:'.$Activation_Code.'\n
							use the following link and paste activatoin code.';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}


// 			//Create a new PHPMailer instance
// $mail = new PHPMailer;
// //Set who the message is to be sent from
// $mail->setFrom('theoshark22@gmail.com', 'First Last');
// //Set an alternative reply-to address
// $mail->addReplyTo('theoshark22@gmail.com', 'First Last');
// //Set who the message is to be sent to
// $mail->addAddress('theoshark22@gmail.com', 'John Doe');
// //Set the subject line
// $mail->Subject = 'PHPMailer mail() test';
// //Read an HTML message body from an external file, convert referenced images to embedded,
// $mail->Body    = 'Please click the following link to activate your account<br/> 
// 							<a href="http://localhost/multi-vendor/public/retailer_account_activation.php?code='.$Activation_Code.'">Click Here<a/>
// 							<br/><br/><hr/>
// 							<h5>Having Troubles with the link??</h5>
// 							Please use the following activation code to activate your account
// 							<br/><strong>Activatoin Code:</strong>'.$Activation_Code.'<br/>';
// //Replace the plain text body with one created manually
// $mail->AltBody = 'This is a plain-text message body';
// //send the message, check for errors
// if (!$mail->send()) {
//     echo "Mailer Error: " . $mail->ErrorInfo;
// } else {
//     echo "Message sent!";
// }



		}else{
			//Dispay error message
			
		}
	
	}else{
		$Update_Retailer_sql = 'UPDATE `users` SET `status` = "N", `reviewed_by`='.$user_id.' WHERE `users`.`id` = '.$retailer_id;
		$Update_Retailer_result = $conn->query($Update_Retailer_sql);
	}
	
	
	include('../connections/db_close_connect.php');//close the connection to the database
?>