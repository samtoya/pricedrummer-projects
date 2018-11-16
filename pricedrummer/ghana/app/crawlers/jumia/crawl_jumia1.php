<?php
	include('../connections/db_connect.php');//connect to the database
	include_once('../include/simple_html_dom.php');
	
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
			
				
				if($html->find('ul[class="osh-pagination -horizontal"]',0)){
					echo '1';
					$li_Current_Page_link = $html->find('ul[class="osh-pagination -horizontal"]',0)->first_child()->find('a',0)->href . '&page=' ;
					$li_Last_Page_link_Text = intval($html->find('ul[class="osh-pagination -horizontal"]',0)->last_child()->prev_sibling ()->find('a',0)->innertext);
					
					//echo '<br><hr/>' . $next_page_url;
					
					}else{
						echo '2';
					$li_Current_Page_link = $url.'?facet_is_mpg_child=0&viewType=gridView&page=';
					$li_Last_Page_link_Text = 1;
					
				}
				
				for ($page = 1; $page <= $li_Last_Page_link_Text; $page++) {
					
				echo	$Current_Page_link =  $li_Current_Page_link.$page;
					
					$html_new = file_get_html($Current_Page_link);
					
					
					foreach ($html_new->find('section [class="products"] div[class="sku -gallery"]') as $div) {
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
						$sql = sprintf("SELECT * FROM products where product_name='%s' or url='%s' or unique_ID like '%s' and merchant_ID='%s' and status <> 'DELETED' LIMIT 1",
						mysqli_real_escape_string($conn,$item_title),
						mysqli_real_escape_string($conn,$item_url),
						mysqli_real_escape_string($conn,$item_sku),
						mysqli_real_escape_string($conn,$merchantID));
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						
						if ($result->num_rows > 0) {
							//UPDATE EXISTING PRODUCT AND DISABLE IT
							$sql = sprintf("UPDATE products SET status='%s' where url like '%s' or unique_ID like '%s'",
							mysqli_real_escape_string($conn,'DELETED'),
							mysqli_real_escape_string($conn,$item_url),
							mysqli_real_escape_string($conn,$item_sku));
							$result = $conn->query($sql);
							
							//INSERT A NEW RECORD IN PLACE OF THE DISABLED PRODUCT
							$sql = sprintf("INSERT INTO products (product_name, url, price, merchant_ID, category, status, sc_status, unique_ID, model_number, Image_url) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
							mysqli_real_escape_string($conn,$row["product_name"]),
							mysqli_real_escape_string($conn,$row["url"]),
							mysqli_real_escape_string($conn,$price),
							mysqli_real_escape_string($conn,$row["merchant_ID"]),
							mysqli_real_escape_string($conn,$row["category"]),
							mysqli_real_escape_string($conn,'ACTIVE'),
							mysqli_real_escape_string($conn,$row["sc_status"]),
							mysqli_real_escape_string($conn,$row["unique_ID"]), //inherit from the existing one so it does not show up in uncategorized list
							mysqli_real_escape_string($conn,$row["model_number"]),
							mysqli_real_escape_string($conn,$image_url));
							
							if ($conn->query($sql) === TRUE) {
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
									$Image_sql = "INSERT INTO `dbpxdm_cr`.`crawled_images` (`image`, `product_ID`) VALUES ('".$imageData."', '".$Product_ID."');";
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
				
				echo '<h1>COMPLETED</h1>';
				
				
				
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
	/*
	$merchant_sql = sprintf("SELECT * FROM merchant where `merchant`.`name` = LCASE('%s')",
	mysqli_real_escape_string($conn,$merchant_name));
	$merchant_result = $conn->query($merchant_sql);
	
	if ($merchant_result->num_rows > 0) {
		
		while($merchant_row = $merchant_result->fetch_assoc()) {
			//set the merchant id
			$merchantID = mysqli_real_escape_string($conn,$merchant_row["merchant_ID"]);
			//select the urls co crawl for that merchant
			$sql = sprintf("SELECT crawl_url.*, `category`.`crawl_image` FROM crawl_url left join category on crawl_url.category_ID = category.category_ID where merchant_ID='%s'",
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
	*/
	get_items('https://www.jumia.com.gh/laptops/','57','1','ACTIVE','YES');
	include('../connections/db_close_connect.php');//close the connection to the database
?>	
