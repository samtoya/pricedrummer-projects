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
function siteAdminBaseURL() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) and $_SERVER['HTTPS'] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"];
    }

    switch ($pageURL) {
        case "http://ngadmin.pricedrummer.com":
            return "http://ng.pricedrummer.com";
            break;

        case "http://zadmin.pricedrummer.com":
            return "http://za.pricedrummer.com";
            break;

        case "http://keadmin.pricedrummer.com":
            return "http://ke.pricedrummer.com";
            break;

        case "http://gadmin.pricedrummer.com":
            return "http://gh.pricedrummer.com";
            break;

        case "http://muadmin.pricedrummer.com":
            return "http://mu.pricedrummer.com";
            break;

        case "http://egadmin.pricedrummer.com":
            return "http://eg.pricedrummer.com";
            break;
    }
}

//GLOBAL VARIABLES FOR ALL COUNTRIES DATABASE CONNECTION
$servername = "localhost";
$password = "7936_Pxd$*M";

//COLLECT THE CURRENT PAGE URL
$Base_Url = baseURL();

//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ($Base_Url) {
    case "http://ngadmin.pricedrummer.com":
        //CONNECT TO THE NG DATABASE
        $username = "pxdm_ng";
        $dbname = "pxdm_ng";
        break;

    case "http://zadmin.pricedrummer.com":
        //CONNECT TO THE SA DATABASE
        $username = "pxdm_sa";
        $dbname = "pxdm_sa";
        break;

    case "http://keadmin.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "pxdm_ke";
        $dbname = "pxdm_ke";
        break;

    case "http://gadmin.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "root";
        $dbname = "pxdm_cr";
        break;

    case "http://muadmin.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "pxdm_mu";
        $dbname = "pxdm_mu";
        break;

    case "http://egadmin.pricedrummer.com":
        //CONNECT TO THE KE DATABASE
        $username = "pxdm_eg";
        $dbname = "pxdm_eg";
        break;
}
?>
