<?php
// Report all PHP errors (see changelog)
error_reporting(E_ALL);

	include('../connections/db_connect.php');//connect to the database
	include_once('../include/simple_html_dom.php');
	echo "Theo";
	//funtion to collect items from jumia
	function check_items ($url,$product_ID,$merchant_ID){
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
			
			if(count($html->find('div[class="actions"] a[class="osh-btn  -default js-trigger-reminder-popup"]')) > 0){
			// CHECK IF THE SOLD OUT DIV IS PRESENT IN THE PAGE

				//UPDATE EXISTING PRODUCT AND DISABLE IT
				$sql = sprintf("UPDATE products SET status='%s' where product_ID ='%s'",
					mysqli_real_escape_string($conn,"OUT_OF_STOCK"),
					mysqli_real_escape_string($conn,$product_ID));
				$result = $conn->query($sql);

				echo '<h1>PRODUCT OUT OF STOCK</h1>';
				sleep($crawler_sleep_seconds);
				
			}elseif(count($html->find('div[class="actions"] a[class="osh-btn  -default js-trigger-reminder-popup"]')) < 1 && count($html->find('div[class="actions"] button[class="osh-btn -primary -add-to-cart js-link js-add_cart_tracking"]')) < 1){
				//CHECK IF BOTH THE SOLD OUT AND INSTOCK BUTTON EXIT(To know if the product does not exist anymore)
				//UPDATE EXISTING PRODUCT AND DISABLE IT
				$sql = sprintf("UPDATE products SET status='%s' where product_ID ='%s'",
					mysqli_real_escape_string($conn,"OUT_OF_STOCK"),
					mysqli_real_escape_string($conn,$product_ID));
				$result = $conn->query($sql);

				echo '<h1>PRODUCT DOES NOT EXIST</h1>';
				sleep($crawler_sleep_seconds);
			}else{
			//	DID NOT FIND THE SOLD OUT DIV (PRODUCR IS STILL ACTIVE)

				//UPDATE EXISTING PRODUCT AND DISABLE IT
				$sql = sprintf("UPDATE products SET status='%s' where product_ID ='%s'",
					mysqli_real_escape_string($conn,"ACTIVE"),
					mysqli_real_escape_string($conn,$product_ID));
				$result = $conn->query($sql);
				echo '<h1>PRODUCT IN STOCK</h1>';
				sleep($crawler_sleep_seconds);

			}



			}else { //there was a problem with request 
			// resend request 
				if($retry_count<$retry_max){
					echo 'ERROR IN CONNECTION'.$result['ERR'];

					check_items($url,$product_ID,$merchant_ID);

					$retry_count++;
				}
			}

		}

		
		// check_items("https://www.jumia.com.gh/itel-it1407-8gb-hdd-dark-blue-37880.html","1","1");
		// check_items("https://www.jumia.com.gh/hotwav-cosmos-v8-dual-sim-32gb-hdd-black-41028.html","1","1");
		// check_items("https://www.jumia.com.gh/hotwav-cosmos-v8-dual-sim-32gb-hdd-black-4102W8.html","1","1");

		$merchant_name = strtolower('Jumia');
		echo $merchant_name;

		$merchant_sql = sprintf("SELECT * FROM merchant where `merchant`.`name` = LCASE('%s')",
			mysqli_real_escape_string($conn,$merchant_name));
		$merchant_result = $conn->query($merchant_sql);

		if ($merchant_result->num_rows > 0) {

			while($merchant_row = $merchant_result->fetch_assoc()) {
			//set the merchant id
				$merchantID = mysqli_real_escape_string($conn,$merchant_row["merchant_ID"]);
				echo $merchantID;
			//select the urls co crawl for that merchant
				$sql = sprintf("SELECT * FROM `products` WHERE `merchant_ID` = '%s'",
					mysqli_real_escape_string($conn,$merchantID));
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				//collect the data from each url return
					while($row = $result->fetch_assoc()) {
						
						check_items($row["url"],$row["product_ID"],$row["merchant_ID"]);
					}

				} else {
					echo "0 list to crawl";
				}

			}

		} else {
			echo "Merchant Not Found";
		}

	include('../connections/db_close_connect.php');//close the connection to the database
	?>	