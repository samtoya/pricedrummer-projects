<?php
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

//GLOBAL VARIABLES FOR ALL COUNTRIES DATABASE CONNECTION
$servername = "localhost";
$password = "7936_Pxd$*M";

//COLLECT THE CURRENT PAGE URL
$Base_Url = baseURL();

//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ($Base_Url) {
    case "http://ng.pricedrummer.com":
        //CONNECT TO THE NG DATABASE
        $username = "pxdm_ng";
        $dbname = "pxdm_ng";
        break;

    case "http://za.pricedrummer.com":
        //CONNECT TO THE SA DATABASE
        $username = "pxdm_sa";
        $dbname = "pxdm_sa";
        break;

    case "http://ke.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "pxdm_ke";
        $dbname = "pxdm_ke";
        break;

    case "http://gh.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "root";
        $dbname = "pxdm_cr";
        break;

    case "http://mu.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "pxdm_mu";
        $dbname = "pxdm_mu";
        break;

    case "http://eg.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "pxdm_eg";
        $dbname = "pxdm_eg";
        break;

    case "http://prototype.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "pxdm_gh";
        $dbname = "pxdm_twitch";
        break;
}
?>
