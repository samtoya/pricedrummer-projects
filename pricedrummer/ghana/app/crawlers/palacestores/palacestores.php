<?php
	include('../connections/db_connect.php');//connect to the database
	include_once('../include/simple_html_dom.php');
	
	
	
	//FUNCTION TO SCAP ITEM DETAILS FROM SPECIFIED URL
	function get_items($url,$category_id,$merchantID,$crawl_url_ID,$crawl_image){	
		global $conn;
		$retry_count = 0;
		$retry_max = 5;
		$crawler_sleep_seconds = 10;
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
			
			$Number_of_Pages = 1;//set number of pages the crawler will find in this link to 1 in the begining
			$Raw_Url = $url;
			
			if(!empty($html->find('ul[class="pagination"] li', -1))){
				
				if(!empty($html->find('ul[class="pagination"] li', -1)->find('a', 0))){
					echo $next_text = $html->find('ul[class="pagination"] li', -1)->find('a', 0)->href;
					
					echo"<br/>";
					$Number_of_Pages = (int) substr($next_text, -1);
					echo"<br/>";
					$Raw_Url = substr($next_text, 0, -1);
				}
				
			}
			
			for ($x = 1; $x <= $Number_of_Pages; $x++) {
				if($Number_of_Pages <2){
					$Current_Page_link = $Raw_Url;
				}else{
					$Current_Page_link = $Raw_Url.$x;
				}
				
				// Clean up things like &amp;
				$Current_Page_link = html_entity_decode($Current_Page_link);
				// Strip out any url-encoded stuff
				$Current_Page_link = urldecode($Current_Page_link);
				//Load page content 


				$curl_channel1 = curl_init();
				curl_setopt($curl_channel1, CURLOPT_URL, $Current_Page_link);
		//curl_setopt($curl_channel, CURLOPT_PROXY, $proxy);
				curl_setopt($curl_channel1, CURLOPT_HEADER, FALSE);
				curl_setopt($curl_channel1, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($curl_channel1, CURLOPT_FOLLOWLOCATION, TRUE);
				curl_setopt($curl_channel1, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl_channel1, CURLOPT_HTTPPROXYTUNNEL, 1);
				curl_setopt($curl_channel1, CURLOPT_CONNECTTIMEOUT, 0);
				curl_setopt($curl_channel1, CURLOPT_REFERER, $referer);
				curl_setopt($curl_channel1, CURLOPT_USERAGENT, $agent);

				$result1['EXE'] = curl_exec($curl_channel1);
				$result1['INF'] = curl_getinfo($curl_channel1);
				$result1['ERR'] = curl_error($curl_channel1);


				curl_close($curl_channel1);
				if(empty($result1['ERR'])){
			// Create a DOM object
					$html_new = new simple_html_dom();
			// Load HTML from a string
					$html_new->load($result1['EXE']);
					
					
					
				//LOOP THROUGH THE ITEMS FOUND ON THE PAGE AND COLLECT THE VITAL DETAILS NEEDED.
					foreach ($html_new->find('div[class="product-thumb"]') as $div) {

						echo'<br/>rr<br/>';
						echo	$item_url = $div->find('div[class="caption"] h4 a', 0)->href;
						echo'<br/>';
						$price_div = $div->find('div[class="caption"] p[class="price"]', 0);
					$children = $price_div->children; // get an array of children
					foreach ($children AS $child) {
						$child->outertext = ''; // This removes the element, but MAY NOT remove it from the original $Price_Div
					}
					echo $price = preg_replace("/[^0-9.]/", "",trim($price_div->innertext));
					
					echo'<br/>';
					// Clean up things like &amp;
					$item_url = html_entity_decode($item_url);
					// Strip out any url-encoded stuff
					$item_url = urldecode($item_url);
					//load the content 
					$Product_page = file_get_html($item_url);
					echo	$item_title = $Product_page->find('div[id="content"] h1', 0)->innertext;	 
					$Item_Model = "";	
					echo $image_url = str_replace(' ', '%20',$Product_page->find('a[class="thumbnail"] img', 0)->src);
					echo'<br/>';echo'<br/>';
					
					// Read image path, convert to base64 encoding
					$imageData = mysqli_real_escape_string($conn,base64_encode(file_get_contents($image_url)));
					// Format the image SRC:  data:{mime};base64,{data};
					$src = 'data: ;base64,'.$imageData;
					// Echo out a sample image
					echo '<img src="' . $src . '" height="100" width="100">';
					
					
					//SAVE THE COLLECTED DATA INTO THE DATABASE
					//First check if the item exist in the database
					$sql = sprintf("SELECT * FROM products where url='%s'and merchant_ID='%s' and status <> 'DELETED' LIMIT 1",
						mysqli_real_escape_string($conn,$item_url),
						mysqli_real_escape_string($conn,$merchantID));
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					
					if($result){
						if ($result->num_rows > 0) {

							//check the price to handel event of the crowler not getting a price.
							//if so then use the existing price
							if(trim($price) ==""){
								$price = $row["price"];
							}

							//UPDATE EXISTING PRODUCT AND DISABLE IT
							$sql = sprintf("UPDATE products SET price='%s' where url like '%s'",
								mysqli_real_escape_string($conn,$price),
								mysqli_real_escape_string($conn,$item_url));
							$result = $conn->query($sql);

							//INSERT A NEW RECORD IN PLACE OF THE DISABLED PRODUCT
							$sql = sprintf("INSERT INTO products_history (product_ID,product_name, url, price, merchant_ID, category, status, sc_status, unique_ID, model_number, Image_url, video_url, Description, sc_ID, review_timestamp, reviewed_by) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
								mysqli_real_escape_string($conn,$row["product_ID"]),
								mysqli_real_escape_string($conn,$row["product_name"]),
								mysqli_real_escape_string($conn,$row["url"]),
								mysqli_real_escape_string($conn,$row["price"]),
								mysqli_real_escape_string($conn,$row["merchant_ID"]),
								mysqli_real_escape_string($conn,$row["category"]),
								mysqli_real_escape_string($conn,'DELETED'),
								mysqli_real_escape_string($conn,$row["sc_status"]),
								mysqli_real_escape_string($conn,$row["unique_ID"]), 
								mysqli_real_escape_string($conn,$row["model_number"]),
								mysqli_real_escape_string($conn,$row["Image_url"]),
								mysqli_real_escape_string($conn,$row["video_url"]),
								mysqli_real_escape_string($conn,$row["Description"]),
								mysqli_real_escape_string($conn,$row["sc_ID"]),
								mysqli_real_escape_string($conn,$row["review_timestamp"]),
								mysqli_real_escape_string($conn,$row["reviewed_by"]));

							if ($conn->query($sql) === TRUE) {
								//PRODUCRT WAS FOUND AND COPIED TO THE HISTORY TABLE
								echo "<br/>History Copy Made<br/>";

							} else {
								//DISPLAY ERROR MESSAGE IF PROCESS FAILS
								echo "Error: " . $sql . "<br>" . $conn->error;
							}

						} else {
						//RECORD DOES NOT EXIST 
						//INSERT A NEW RECORD IF PRODUCT WAS NOT FOUND IN THE SYSTEM
							$sql = sprintf("INSERT INTO products (product_name, url, price, merchant_ID, category, status, sc_status, model_number, Image_url) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
								mysqli_real_escape_string($conn,$item_title),
								mysqli_real_escape_string($conn,$item_url),
								mysqli_real_escape_string($conn,$price),
								mysqli_real_escape_string($conn,$merchantID),
								mysqli_real_escape_string($conn,$category_id),
								mysqli_real_escape_string($conn,'ACTIVE'),
								mysqli_real_escape_string($conn,'NEW'),
								mysqli_real_escape_string($conn,$Item_Model),
								mysqli_real_escape_string($conn,$image_url));

							if ($conn->query($sql) === TRUE) {
								echo "Item Added";
							//IF PRODUCT IS INSERTED AND CRAW IMAGE IS SET TO YES FOR THE CATEGORY, THEN DOWNLOAD IMAGES TO THE DB
								$Product_ID = mysqli_real_escape_string($conn,$conn->insert_id);
							//CHECK IF CRAWL IMAGE WAS SET ON
								if(strtolower(trim($crawl_image)) == strtolower(trim("YES"))){
									$Image_sql = "INSERT INTO `crawled_images` (`image`, `product_ID`) VALUES ('".$imageData."', '".$Product_ID."');";
									if ($conn->query($Image_sql) === TRUE) {
										echo "image Added";
									} else {
										echo "Error: " . $Image_sql . "<br>" . $conn->error;
									}
								}
							} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
						}
					}
					
					
				}

			}
		}

		echo '<h1>COMPLETED</h1>';
			//CHANGE CRAWED_STATUS TO 1 AFTER CRAWLING A FULL LINK
		$Update_sql = sprintf("Update crawl_url set crawled_status = '1' where crawl_url_ID='%s'",
			mysqli_real_escape_string($conn,$crawl_url_ID));
		$result = $conn->query($Update_sql);



			} else { //there was a problem with request 
			// resend request 
				if($retry_count<$retry_max){
					echo 'ERROR IN CONNECTION'.$result['ERR'];

					get_items($url,$category_id,$merchantID,$crawl_url_ID,$crawl_image);

					$retry_count++;
				}
			}


		}




		

		//FUNCTION TO CHECK PRODUCT STATUS
		function check_items ($url,$product_ID,$merchant_ID){
			global $conn;
			$retry_count = 0;
			$retry_max = 5;
			$crawler_sleep_seconds = rand(3, 5);
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
			
			if(count($html->find('button[id="button-cart"]')) < 1){
			// CHECK IF THE SOLD OUT DIV IS PRESENT IN THE PAGE

				//UPDATE EXISTING PRODUCT AND DISABLE IT
				$sql = sprintf("UPDATE products SET status='%s' where product_ID ='%s'",
					mysqli_real_escape_string($conn,"OUT_OF_STOCK"),
					mysqli_real_escape_string($conn,$product_ID));
				$result = $conn->query($sql);

				echo '<h1>PRODUCT OUT OF STOCK</h1>\n';
				sleep($crawler_sleep_seconds);
				
			}else{
			//	DID NOT FIND THE SOLD OUT DIV (PRODUCR IS STILL ACTIVE)

				//UPDATE EXISTING PRODUCT AND DISABLE IT
				$sql = sprintf("UPDATE products SET status='%s' where product_ID ='%s'",
					mysqli_real_escape_string($conn,"ACTIVE"),
					mysqli_real_escape_string($conn,$product_ID));
				$result = $conn->query($sql);
				echo '<h1>PRODUCT IN STOCK</h1>\n';
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





$merchant_name = strtolower('Palace Stores');

				
$opts = getopt('t:');
if($opts['t'] ==1){ //////////////////////////////////////////===========================DO RECRAWLING =======================/////////////

	$merchant_sql = sprintf("SELECT * FROM merchant where `merchant`.`name` = LCASE('%s')",
		mysqli_real_escape_string($conn,$merchant_name));
	$merchant_result = $conn->query($merchant_sql);
	
	if ($merchant_result->num_rows > 0) {
		
		while($merchant_row = $merchant_result->fetch_assoc()) {
			//set the merchant id
			$merchantID = mysqli_real_escape_string($conn,$merchant_row["merchant_ID"]);
			//select the urls co crawl for that merchant
			$sql = sprintf("SELECT crawl_url.*, `category`.`crawl_image` FROM crawl_url left join category on crawl_url.category_ID = category.category_ID where merchant_ID='%s' and crawled_status=1",
				mysqli_real_escape_string($conn,$merchantID));
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				//collect the data from each url return
				while($row = $result->fetch_assoc()) {
					get_items($row["merchant_url"],$row["category_ID"],$row["merchant_ID"],$row["crawl_url_ID"],$row["crawl_image"]);
				}
				
			} else {
				echo "0 list to crawl";
			}
			
		}
		
	} else {
		echo "Merchant Not Found";
	}
	

}elseif($opts['t'] ==2){//////////////////////////////////////////===========================DO PRODUCT STATUS CHECK =======================/////////////

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

}


	include('../connections/db_connect.php');//close the connection to the database
	?>