<?php
	include('../connections/db_connect.php');//connect to the database
	include_once('../include/simple_html_dom.php');
	
	
	
	//FUNCTION TO SCAP ITEM DETAILS FROM SPECIFIED URL
	function get_items($url,$category_id,$merchantID){	
		global $conn;
		$retry_count = 0;
		$retry_max = 5;
		$crawler_sleep_seconds = 0;
		include('../include/proxies.php');
		include('../include/useragents.php');
		include('../include/referers.php');
		
		// Choose a random proxy
		if (isset($proxies)) {  // If the $proxies array contains items, then
			$proxy = $proxies[array_rand($proxies)];    // Select a random proxy from the array and assign to $proxy variable
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
		
		if (empty($result['ERR'])) {//there was no erros with request
			// Create a DOM object
			$html = new simple_html_dom();
			// Load HTML from a string
			$html->load($result['EXE']);
		
			echo $html->find('div[class="category-products"] ul[class*="products-grid] li[class*="item]',0)->tag;
			
			
			} else { //there was a problem with request 
			// resend request 
			if($retry_count<$retry_max){
				echo 'ERROR IN CONNECTION'.$result['ERR'];
				
				get_items($url,$category_id,$merchantID);
				
				$retry_count++;
			}
		}
		
		
	}
	
	$merchant_name = strtolower('CompuGhana');
	
	$merchant_sql = sprintf("SELECT * FROM merchant where `merchant`.`name` = LCASE('%s')",
	mysqli_real_escape_string($conn,$merchant_name));
	$merchant_result = $conn->query($merchant_sql);
	
	if ($merchant_result->num_rows > 0) {
		
		while($merchant_row = $merchant_result->fetch_assoc()) {
			//set the merchant id
			$merchantID = mysqli_real_escape_string($conn,$merchant_row["merchant_ID"]);
			//select the urls co crawl for that merchant
			$sql = sprintf("SELECT * FROM crawl_url where merchant_ID='%s'",
			mysqli_real_escape_string($conn,$merchantID));
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				//collect the data from each url return
				while($row = $result->fetch_assoc()) {
					get_items($row["merchant_url"],$row["category_ID"],$row["merchant_ID"]);
				}
				
				} else {
				echo "0 list to crawl";
			}
			
		}
		
		} else {
		echo "Merchant Not Found";
	}
	
	
	include('../connections/db_connect.php');//close the connection to the database
?>