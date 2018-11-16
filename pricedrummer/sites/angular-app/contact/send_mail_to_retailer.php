<?php
include('../api/connections/db_connect.php');//connect to the database

function baseURL() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) and $_SERVER['HTTPS'] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"];
    }
    return $pageURL;
}
//COLLECT THE CURRENT PAGE URL
$Base_Url = baseURL();

    if(isset($_POST) && !empty($_POST)){
       //Collect and Validate User Inputs
        $email_to = $conn->real_escape_string($_POST['email_to']);
        $email_from = $conn->real_escape_string($_POST['email_from']);
        $subject = "Retailer Message";
        $tel = '';
        if(isset($_POST['tel'])){$tel = $conn->real_escape_string($_POST['tel']);}
        $message = $conn->real_escape_string(trim($_POST['message']));
        $redirect_to = $conn->real_escape_string(trim($_POST['redirect_to']));
        $copyFlag = 'false';
        if(isset($_POST['copy_flg'])){$copyFlag = $conn->real_escape_string($_POST['copy_flg']);}

        $email_message_sql = "INSERT INTO `emails` (`email_to`, `email_from`, `subject`, `telephone`, `message`,`copy_flag`) VALUES
		('".$email_to."', '".$email_from."', '".$subject."', '".$tel."', '".$message."', '".$copyFlag."');";

        if ($conn->query($email_message_sql) === TRUE) {
            echo "1";
        } else {
            echo "Error: " . $email_message_sql . "<br>" . $conn->error;

        }

    }


?>