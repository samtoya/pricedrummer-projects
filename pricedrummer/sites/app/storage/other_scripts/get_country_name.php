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

//COLLECT THE CURRENT PAGE URL
$Base_Url = baseURL();
$country = '';
//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ($Base_Url) {
    case "http://ng.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        echo"nigeria";
        $country = "nigeria";
        break;

    case "http://sa.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        echo"southafrica";
        $country = "southafrica";
        break;

    case "http://ke.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        echo"kenya";
        $country = "kenya";
        break;

    case "http://gh.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        echo"ghana";
        $country = "ghana";
        break;

    case "http://mu.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        echo"mauritius";
        $country = "mauritius";
        break;

    case "http://eg.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        echo"egypt";
        $country = "egypt";
        break;
}
?>
