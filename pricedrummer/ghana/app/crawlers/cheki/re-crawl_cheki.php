<?php
	include('../connections/db_connect.php');//connect to the database
	include_once('../include/simple_html_dom.php');
	
	
	
	//FUNCTION TO SCAP ITEM DETAILS FROM SPECIFIED URL
	function get_items($url,$category_id,$merchantID,$crawl_url_ID,$crawl_image){	
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
			if(count($html->find('ul[class="listing-unit__container"]')) < 2){// The Main Product List Container Was Found
				//SET URL STATUS TO ACTIVE
				$Update_sql = sprintf("Update crawl_url set url_status = 'ACTIVE' where crawl_url_ID='%s'",
					mysqli_real_escape_string($conn,$crawl_url_ID));
				$result = $conn->query($Update_sql);
				
				//LOOP THROUGH THE ITEMS FOUND ON THE PAGE AND COLLECT THE VITAL DETAILS NEEDED.
				foreach ($html->find('ul[class="listing-unit__container"] li[class*="listing-unit]') as $div) {
					echo'<br/>rr<br/>';
					echo $item_url = $div->getAttribute('data-url');

					
					echo $price = preg_replace("/[^0-9.]/", "",$div->find('div[class="listing-unit__price"] strong', 0)->innertext);
					echo'<br/>';
					echo "Title=>". $item_title = $div->find('div[class="listing-unit__title"]', 0)->plaintext;	 
					echo'<br/>';

					echo "Location=>". $item_location = $div->find('div[class="listing-unit__location"]', 0)->innertext;	 
					echo'<br/>';

					echo "Year=>". $item_year = $div->find('div[class="listing-unit__detail-container"] div[class="listing-unit__detail"]', 1)->innertext;	 
					echo'<br/>';
					

					if(empty($price)){
						$curl_channel1 = curl_init();
						curl_setopt($curl_channel1, CURLOPT_URL, $item_url); //GOTO THE CURRENT PRODUCTS DETAILS PAGE 
						//curl_setopt($curl_channel1, CURLOPT_PROXY, $proxy);
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

					if (empty($result1['ERR'])) {//there was no erros with request
						// Create a DOM object
						$html1 = new simple_html_dom();
						// Load HTML from a string
						$html1->load($result1['EXE']);

						echo $price = preg_replace("/[^0-9.]/", "",$html1->find('div[class="listing-detail__price"]', 0)->innertext);
						echo'<br/>';

					}

					
				}



				if(count($div->find('div[class="listing-unit__image-container"] img')) > 0){
					echo $image_url = $div->find('div[class="listing-unit__image-container"] img', 0)->getAttribute('data-src');
						//copy($image_url, 'img/'.$imageName);	//this would download the item images into a local folder

						// Read image path, convert to base64 encoding
					$imageData = mysqli_real_escape_string($conn,base64_encode(file_get_contents($image_url)));
						// Format the image SRC:  data:{mime};base64,{data};
						//$src = 'data: ;base64,'.$imageData;
						// Echo out a sample image
						//echo '<img src="' . $src . '" height="100" width="100">';

				}else{

					echo	$image_url = "https://www.cheki.com.gh/build/img/adaptive/cheki-logo-ghana-fe620961b4.svg";

						// Read image path, convert to base64 encoding
					$imageData = mysqli_real_escape_string($conn,base64_encode(file_get_contents($image_url)));
						// Format the image SRC:  data:{mime};base64,{data};
						//$src = 'data: ;base64,'.$imageData;
						// Echo out a sample image
					//	echo '<img src="' . $src . '" height="100" width="100">';

				}


				$itemDescriotion = $item_location."|".$item_year;

				if(!empty($item_year)){

					//SAVE THE COLLECTED DATA INTO THE DATABASE
					//First check if the item exist in the database 
					$sql = sprintf("SELECT * FROM products where url like '%s' and merchant_ID='%s' and status <> 'DELETED' LIMIT 1",
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
							$sql = sprintf("INSERT INTO products (product_name, url, price, merchant_ID, category, status, sc_status, model_number, Image_url,Description) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
								mysqli_real_escape_string($conn,$item_title),
								mysqli_real_escape_string($conn,$item_url),
								mysqli_real_escape_string($conn,$price),
								mysqli_real_escape_string($conn,$merchantID),
								mysqli_real_escape_string($conn,$category_id),
								mysqli_real_escape_string($conn,'ACTIVE'),
								mysqli_real_escape_string($conn,'NEW'),
								mysqli_real_escape_string($conn,$Item_Model),
								mysqli_real_escape_string($conn,$image_url),
								mysqli_real_escape_string($conn,$itemDescriotion));

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

					}//=====End Of Car Year Check
					
				}

				echo '<h1>COMPLETED</h1>';
				
				//CHECK IF THERE IS A NEXT PAGE OR PAGINATION.
				//IF SO, LOAD THE URL AND COLLECT THE ITEMS.
				if($next = $html->find('ul[class="pagination"] li', -1)->find('a', 0)) {
					$next_page_url = urldecode(html_entity_decode ($next->href));
					//echo '<br>' . $next_page_url;
					echo '<br><hr/>' . $next_page_url;
					echo '<hr/>';
					$html->clear();
					unset($html);
					
					//sleep for 5 seconds
					sleep($crawler_sleep_seconds);
					//load the next page from the pagination to collect its items
					get_items($next_page_url,$category_id,$merchantID,$crawl_url_ID,$crawl_image);
				}
				
				//CHANGE CRAWED_STATUS TO 1 AFTER CRAWLING A FULL LINK
				$Update_sql = sprintf("Update crawl_url set crawled_status = '1' where crawl_url_ID='%s'",
					mysqli_real_escape_string($conn,$crawl_url_ID));
				$result = $conn->query($Update_sql);

				
				}else{//	Product List Container Was Not Found
					echo"URL Not Found Please";
				//SET URL STATUS TO CHANGED
					$Update_sql = sprintf("Update crawl_url set url_status = 'CHANGED' where crawl_url_ID='%s'",
						mysqli_real_escape_string($conn,$crawl_url_ID));
					$result = $conn->query($Update_sql);
				}

			} else { //there was a problem with request 
			// resend request 
				if($retry_count<$retry_max){
					echo 'ERROR IN CONNECTION'.$result['ERR'];

					get_items($url,$category_id,$merchantID,$crawl_url_ID,$crawl_image);

					$retry_count++;
				}
			}


		}

		$merchant_name = strtolower('Cheki');

		$merchant_sql = sprintf("SELECT * FROM merchant where `merchant`.`name` = LCASE('%s')",
			mysqli_real_escape_string($conn,$merchant_name));
		$merchant_result = $conn->query($merchant_sql);

		if ($merchant_result->num_rows > 0) {

			while($merchant_row = $merchant_result->fetch_assoc()) {
			//set the merchant id
				$merchantID = mysqli_real_escape_string($conn,$merchant_row["merchant_ID"]);
			//select the urls co crawl for that merchant
				$sql = sprintf("SELECT crawl_url.*, `category`.`crawl_image` FROM crawl_url left join category on crawl_url.category_ID = category.category_ID where merchant_ID='%s'  and crawled_status=1",
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



	include('../connections/db_close_connect.php');//close the connection to the database
	?>