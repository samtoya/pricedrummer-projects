<?php

//COLLECT THE CURRENT PAGE URL
$Base_Url = baseURL();
$country = '';
//CHANGE USERS AND DATABASES BASED ON THE URL THAT IS REQUESTING THE APP
switch ($Base_Url) {
    case "http://ng.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        $country = "nigeria";
        break;

    case "http://sa.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        $country = "southafrica";
        break;

    case "http://ke.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        $country = "kenya";
        break;

    case "http://gh.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        $country = "ghana";
        break;

    case "http://mu.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        $country = "mauritius";
        break;

    case "http://eg.pricedrummer.com":
        //RETURN THE COUNTRY NAME
        $country = "egypt";
        break;
}
?>
