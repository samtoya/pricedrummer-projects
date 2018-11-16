<?php
// include('../connections/db_connect.php');//connect to the database
include_once('simple_html_dom.php');

//FUNCTION TO CHECK PRODUCT STATUS
function collect_new_price ($url,$merchant){
    global $conn;
    $retry_count = 0;
    $retry_max = 5;
    $crawler_sleep_seconds = rand(3, 10);
    include('../include/proxies.php');
    include('../include/useragents.php');
    include('../include/referers.php');

    if(isset($proxies)){
        $proxy = $proxies[array_rand($proxies)]; // Select a random proxy from the array and assign to $proxy variable
    }

    // Choose a random user agent
    if (isset($user_agent_choices)) {  // If the $user_agent_choices array contains items, then
        // Select a random user agent from the array and assign to $agent variable
        $agent = $user_agent_choices[array_rand($user_agent_choices)];
    }

    // Choose a random user agent
    if (isset($referer_choices)) {  // If the $referer_choices array contains items, then
        // Select a random referer from the array and assign to $referer variable
        $referer = $referer_choices[array_rand($referer_choices)];
    }

    $curl_channel = curl_init();
    curl_setopt($curl_channel, CURLOPT_URL, $url);
    //curl_setopt($curl_channel, CURLOPT_PROXY, $proxy);
    curl_setopt($curl_channel, CURLOPT_HEADER, FALSE);
    curl_setopt($curl_channel, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl_channel, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl_channel, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_channel, CURLOPT_HTTPPROXYTUNNEL, 1);
    curl_setopt($curl_channel, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($curl_channel, CURLOPT_REFERER, $referer);
    curl_setopt($curl_channel, CURLOPT_USERAGENT, $agent);

    $result['EXE'] = curl_exec($curl_channel);
    $result['INF'] = curl_getinfo($curl_channel);
    $result['ERR'] = curl_error($curl_channel);


    curl_close($curl_channel);

    if(empty($result['ERR'])){

        // Create a DOM object
        $html = new simple_html_dom();
        // Load HTML from a string
        $html->load($result['EXE']);


        switch ($merchant) {
            case '2': //electroland
                $element = 'span[id="our_price_display"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }
                break;

            case 'jumia':
                $element = 'span[class*="price]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }
                break;

            case '33': //baahe
                $element = 'ul[class="list-unstyled"] li h2';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }
                break;
        }


    }else { //there was a problem with request
        // resend request
        if($retry_count<$retry_max){
            echo 'ERROR IN CONNECTION'.$result['ERR'];

            // check_items($url,$product_ID,$merchant_ID);

            $retry_count++;
        }
    }

}

$url = $_POST['url'];
$merchant = $_POST['merchant'];
prinr_r($_POST);
//collect_new_price($url,$merchant);

?>