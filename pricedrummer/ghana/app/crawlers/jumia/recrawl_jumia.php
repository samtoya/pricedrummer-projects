<?php
// Report all PHP errors (see changelog)
error_reporting(E_ALL);

	include('../connections/db_connect.php');//connect to the database
	include_once('../include/simple_html_dom.php');
	echo "Theo";
	//funtion to collect items from jumia
	function get_items ($url, $cat_ID,$merchantID,$crawl_url_ID,$crawl_image){
		global $conn;
		$retry_count = 0;
		$retry_max = 5;
		$crawler_sleep_seconds = 180;
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
			
			if(count($html->find('section [class="osh-content"]')) < 2){//	Product List Container Was Found

				//SET URL STATUS TO ACTIVE
				$Update_sql = sprintf("Update crawl_url set url_status = 'ACTIVE' where crawl_url_ID='%s'",
					mysqli_real_escape_string($conn,$crawl_url_ID));
				$result = $conn->query($Update_sql);
				

				if($html->find('ul[class="osh-pagination -horizontal"]',0)){

					$li_Current_Page_link = $html->find('ul[class="osh-pagination -horizontal"]',0)->first_child()->find('a',0)->href . '&page=' ;
					$li_Last_Page_link_Text = intval($html->find('ul[class="osh-pagination -horizontal"]',0)->last_child()->prev_sibling ()->find('a',0)->innertext);
					
					//echo '<br><hr/>' . $next_page_url;
					
				}else{
					$li_Current_Page_link = $url.'?facet_is_mpg_child=0&viewType=gridView&page=';
					$li_Last_Page_link_Text = 1;
					
				}
				
				for ($page = 1; $page <= $li_Last_Page_link_Text; $page++) {
					
					$Current_Page_link =  $li_Current_Page_link.$page;
					
					// Create a DOM object
					echo $Current_Page_link;
					//$html_new = file_get_html($Current_Page_link);

					$curl_channel1 = curl_init();
					curl_setopt($curl_channel1, CURLOPT_URL, $url);
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


						//echo $html_new;
						 echo "ttt";
						// echo $html_new->find('div[class*="-gallery]',0)->innertext;
						// echo "string";
						foreach ($html_new->find('section[class="products"] div[class="sku -gallery"]') as $div) {

							echo'<br/>rr<br/>';
							echo $item_url = $div->find('[class="link"]a', 0)->href;
							echo'<br/>';
							$price = preg_replace("/[^0-9.]/", "", $div->find('span[class="price"]', 0)->last_child()->innertext);
							echo'<br/>';
							echo $price;
							$item_brand = $div->find('h2[class="title"] span[class="brand"]', 0)->innertext;	
						//$pro = $item_brand ." ". $item_title;
							echo'<br/>';
							echo $item_title = $item_brand.$div->find('h2[class="title"]', 0)->last_child()->innertext;
							echo'<br/>';
							$image_url = $div->find('div[class="image-wrapper default-state"]  img', 0)->attr['data-src'];
							echo $image_url . "<br/>";
							$item_sku = $div->attr['data-sku'];	
							$Item_Model = '';

						// Read image path, convert to base64 encoding
							$imageData = mysqli_real_escape_string($conn,base64_encode(file_get_contents($image_url)));
						// Format the image SRC:  data:{mime};base64,{data};
							$src = 'data: ;base64,'.$imageData;
						// Echo out a sample image
							echo '<img src="' . $src . '" height="100" width="100">';



							$Product_ID = '';
						//SAVE THE COLLECTED DATA INTO THE DATABASE
						//First check if the item exist in the database
							$sql = sprintf("SELECT * FROM products where unique_ID like '%s' and merchant_ID='%s' and status <> 'DELETED' LIMIT 1",
								mysqli_real_escape_string($conn,$item_sku),
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
									$sql = sprintf("UPDATE products SET price='%s' where unique_ID like '%s'",
										mysqli_real_escape_string($conn,$price),
										mysqli_real_escape_string($conn,$item_sku));
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

							//INSERT A NEW RECORD IF PRODUCT WAS NOT FOUND IN THE SYSTEM
									$sql = sprintf("INSERT INTO products (product_name, url, price, merchant_ID, category, status, sc_status, unique_ID, model_number, Image_url) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
										mysqli_real_escape_string($conn,$item_title),
										mysqli_real_escape_string($conn,$item_url),
										mysqli_real_escape_string($conn,$price),
										mysqli_real_escape_string($conn,$merchantID),
										mysqli_real_escape_string($conn,$cat_ID),
										mysqli_real_escape_string($conn,'ACTIVE'),
										mysqli_real_escape_string($conn,'NEW'),
										mysqli_real_escape_string($conn,$item_sku),
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
				$Update_sql = sprintf("Update crawl_url set crawled_status = '0' where crawl_url_ID='%s'",
					mysqli_real_escape_string($conn,$crawl_url_ID));
				$result = $conn->query($Update_sql);
				
				
				}else{//	Product List Container Was Not Found
				//SET URL STATUS TO CHANGED
					$Update_sql = sprintf("Update crawl_url set url_status = 'CHANGED' where crawl_url_ID='%s'",
						mysqli_real_escape_string($conn,$crawl_url_ID));
					$result = $conn->query($Update_sql);
				}

			}else { //there was a problem with request 
			// resend request 
				if($retry_count<$retry_max){
					echo 'ERROR IN CONNECTION'.$result['ERR'];

					get_items($url,$cat_ID,$merchantID,$crawl_url_ID,$crawl_image);

					$retry_count++;
				}
			}

		}

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
				$sql = sprintf("SELECT crawl_url.*, `category`.`crawl_image` FROM crawl_url left join category on crawl_url.category_ID = category.category_ID where merchant_ID='%s'  and crawled_status=1",
					mysqli_real_escape_string($conn,$merchantID));
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
				//collect the data from each url return
					while($row = $result->fetch_assoc()) {
						echo $row["merchant_url"];
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