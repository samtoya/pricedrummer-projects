<?php
// include('../connections/db_connect.php');//connect to the database
include_once('include/simple_html_dom.php');

//FUNCTION TO CHECK PRODUCT STATUS
function collect_new_price ($url,$merchant){
    $retry_count = 0;
    $retry_max = 5;
    $crawler_sleep_seconds = rand(3, 10);
    include('include/proxies.php');
    include('include/useragents.php');
    include('include/referers.php');

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
            case '2'://electroland
                $element = 'span[id="our_price_display"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }
                break;

            case '1'://jumia
                $element = 'div[class=details-footer] span[class*="price]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }
                break;

            case '33'://baahe
                $element = 'ul[class=list-unstyled]';

                if(count($html->find('ul[class=list-unstyled]')) > 0){
                    echo"rr";
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,-1)->plaintext));
                }
                break;

            // case '29'://Abbey Tech Hub
            //     $element = 'span[class="woocommerce-Price-amount amount"]';
            //     if(count($html->find($element)) > 0){
            //     	echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
            //     }
            //     //preceeding code
            // break;

            case '30'://africakart
                $element = 'span[class="price"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '34'://Cheki
                $element = 'div[class="listing-detail__price"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '36'://Compu Ghana
                $element = 'div[class="price-box"] span[class="price"]';
            //echo $url;
                if(count($html->find($element)) > 0){

                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '4'://tisu
                $element = 'div[class="price-box"] span[class="price"]';
                //echo $url;
                if(count($html->find($element)) > 0){

                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;
            //  case '38'://CreditFlex
            //         $element = 'div[class="detail-info"]h3';
            //         if(count($html->find($element)) > 0){
            //         	echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
            //         }

            // break;

            case '41'://Ederick Limited
                $element = 'div[class="price"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '42'://Electromart
                $element = 'span[class="price"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '43'://Electrocity
                $element = 'em[class*="ProductPrice]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            // case '44'://Etoys&more
            //         $element = 'em[class*="ProductPrice]';
            //         if(count($html->find($element)) > 0){
            //         	echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
            //         }

            // break;

            // case '45'://iSHOP Ghana
            //         $element = 'em[class*="ProductPrice]';
            //         if(count($html->find($element)) > 0){
            //         	echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
            //         }

            // break;

            case '50'://Jumia Market
                $element = 'span[class="discount-price price fsize-24 bold"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '52'://Kpakpakpa Market
                $element = 'td[class=font5]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '54'://MyJoyMarket
                $element = 'div[class="ad-price"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '55'://'Odo Asem
                $element = 'span[class="price-tax"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;


            case '56'://olx
                $element = 'strong[class="xxxx-large margintop7 block arranged"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;


            case '57'://Palace Stores
                $element = 'ul[class="list-unstyled"]li h2';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '58'://QwickMART
                $element = 'span[class="price-tax"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            case '59'://Slay Africa
                $element = 'h5[class="price left"]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;

            // case '60'://Sprog Store
            //         $element = ' span[class="woocommerce-Price-amount amount]';
            //         if(count($html->find($element)) > 0){
            // 		echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
            //         }

            // break;

            case '65'://Tonaton
                $element = 'div[class="ui-price-tag"] span[class=amount]';
                if(count($html->find($element)) > 0){
                    echo preg_replace("/[^0-9.]/", "",preg_replace("/&#8373;/", "",$html->find($element,0)->plaintext));
                }

                break;


            case '80'://Franko Trading'
                $element = 'p[class="price"] span[class="woocommerce-Price-amount amount"]';
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

//$url = 'www.frankophones.com/product/hp-envy-touchsmart-15/?v=6848ae6f8e78';
//$merchant = '80';
//

$data = json_decode(file_get_contents("php://input"));

$url = trim($data->url);
$merchant = trim($data->merchant) ;
collect_new_price ($url,$merchant);

?>