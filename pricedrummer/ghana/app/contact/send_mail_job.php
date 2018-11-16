<?php
include('../pxdm-admin/connections/db_connect.php');//connect to the database

$email_list_sql = "SELECT * FROM `emails` WHERE `sent_status` = 0 Limit 1";
$email_list_result = $conn->query($email_list_sql);
if ($email_list_result->num_rows > 0) {
    while($email_row = $email_list_result->fetch_assoc()) {

        $mail_id = $email_row['id'];
        $email_to = $email_row['email_to'];
        $email_from = $email_row['email_from'];
        $subject = "Retailer Message";
        $tel = $email_row['telephone'];
        $message = trim($email_row['message']);
        $redirect_to = trim($_POST['redirect_to']);

        $headers = 'From: '.$email_from . "\r\n" .
            'Reply-To: '.$email_from . "\r\n";
        if($email_row['copy_flag'] == "true"){
            $email_to .= ", ".$email_from."\r\n";
        }


        $mail_result = mail($email_to,$subject,$message, $headers);
        if($mail_result){
            echo"Mail Sent Successfully - Mail_id :=>".$mail_id;
            $Update_Mail_Status_sql = 'UPDATE `emails` SET sent_status = 1 WHERE id ="'.$mail_id.'";';
            $Update_Mail_Status_result = $conn->query($Update_Mail_Status_sql);
            if($Update_Mail_Status_result){echo"Mail Status Updated successfully"; }else{ echo"Mail Status Not Updated! mail_id=>".$mail_id;}
        }else{
            echo"Mail Not Sent-Mail_id :=>".$mail_id;
        }

    }
}

?>