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
			
			//CHECK IF THERE IS A NEXT PAGE OR PAGINATION.
			//IF SO, LOAD THE URL AND COLLECT THE ITEMS.
			$pages = array();
			$children = $html->find('div[class="pagination paging clearfix"] div[class="links"] a'); // get an array 
			foreach ($children AS $child) {
				$child_text = trim($child->plaintext);
				if($child_text == ">" || $child_text == "&gt;" || $child_text == "&#62;"){
					
					continue;
				}
				$pages[] = str_replace("&amp;amp;","&",$child->href);
			}
			 
			$pages[count($pages)-1] = $url;
			echo '<br><hr/><pre>';
			print_r($pages);
			echo '</pre><hr/>';
			
			foreach ($pages as $page){
				// Load HTML from a string
				//$html = file_get_html("".$page."");
				$curl_channel = curl_init();
		curl_setopt($curl_channel, CURLOPT_URL, $page);
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
				$html = new simple_html_dom();
			// Load HTML from a string
			$html->load($result['EXE']);
			
			if(count($html->find('div[class="products-block"]')) < 2){// Its The Main Product Page
				//SET URL STATUS TO ACTIVE
				$Update_sql = sprintf("Update crawl_url set url_status = 'ACTIVE' where crawl_url_ID='%s'",
				mysqli_real_escape_string($conn,$crawl_url_ID));
				$result = $conn->query($Update_sql);
				
				//LOOP THROUGH THE ITEMS FOUND ON THE PAGE AND COLLECT THE VITAL DETAILS NEEDED.
				foreach ($html->find('div[class="products-block"] div[class="product-block"]') as $div) {
					echo'<br/>rr<br/>';
					echo	$item_url = $div->find('div[class="product-meta"] h3[class="name"] a', 0)->href;
					echo'<br/>';
					echo	$price = preg_replace("/[^0-9.]/", "",$div->find('div[class="product-meta"] div[class="price"] span',  0)->innertext);
					echo'<br/>';
					echo	$item_title = $div->find('div[class="product-meta"] h3[class="name"] a', 0)->innertext;	 
					$Item_Model = "";;	
					echo $image_url = $div->find('div[class="image"] div[class="flip"] img[class="front"]', 0)->src;
					echo'<br/>';echo'<br/>';
					
					// Read image path, convert to base64 encoding
					$imageData = mysqli_real_escape_string($conn,base64_encode(file_get_contents($image_url)));
					// Format the image SRC:  data:{mime};base64,{data};
					$src = 'data: ;base64,'.$imageData;
					// Echo out a sample image
					echo '<img src="' . $src . '" height="100" width="100">';
					
					
					//SAVE THE COLLECTED DATA INTO THE DATABASE
					//First check if the item exist in the database
					$sql = sprintf("SELECT * FROM products where product_name='%s' or url='%s'and merchant_ID='%s' and status <> 'DELETED' LIMIT 1",
					mysqli_real_escape_string($conn,$item_title),
					mysqli_real_escape_string($conn,$item_url),
					mysqli_real_escape_string($conn,$merchantID));
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					
					if ($result->num_rows > 0) {
						//UPDATE EXISTING PRODUCT AND DISABLE IT
						$sql = sprintf("UPDATE products SET status='%s' where product_ID='%s'",
						mysqli_real_escape_string($conn,'DELETED'),
						mysqli_real_escape_string($conn,$row["product_ID"]));
						$result = $conn->query($sql);
						
						//INSERT A NEW RECORD IN PLACE OF THE DISABLED PRODUCT (By Copying Some Fields From The Previous One)
						$sql = sprintf("INSERT INTO products (product_name, url, price, merchant_ID, category, status, sc_status, model_number, Image_url) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
						mysqli_real_escape_string($conn,$row["product_name"]),
						mysqli_real_escape_string($conn,$row["url"]),
						mysqli_real_escape_string($conn,$price),
						mysqli_real_escape_string($conn,$row["merchant_ID"]),
						mysqli_real_escape_string($conn,$row["category"]),
						mysqli_real_escape_string($conn,'ACTIVE'),
						mysqli_real_escape_string($conn,$row["sc_status"]), //inherit from the existing one so it does not show up in uncategorized list
						mysqli_real_escape_string($conn,$row["model_number"]),
						mysqli_real_escape_string($conn,$image_url));
						
						if ($conn->query($sql) === TRUE) {
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
				
				
				//CHECK IF THERE IS A NEXT PAGE OR PAGINATION.
				//IF SO, LOAD THE URL AND COLLECT THE ITEMS.
				$Has_Next_Page = '';
				$children = $html->find('div[class="pagination paging clearfix"] div[class="links"] a'); // get an array of children
				foreach ($children AS $child) {
					echo"<h1>". trim($child->plaintext) ."</h1>";
					$child_text = trim($child->plaintext);
					if($child_text == ">" || $child_text == "&gt;" || $child_text == "&#62;"){
						
						$Has_Next_Page = $child->href;
						
					}
				}
				
				if(!empty($Has_Next_Page)){
					echo '<br><hr/><h1>' . $Has_Next_Page;
					echo '</h1><hr/>';
					$html->clear();
					unset($html);
					//sleep for set seconds
					sleep($crawler_sleep_seconds);
					get_items($Has_Next_Page,$category_id,$merchantID,$crawl_url_ID,$crawl_image);
				}
				
				
				echo '<h1>COMPLETED</h1>';
				
				}else{//	Product List Container Was Not Found
				echo"URL Not Found Please";
				//SET URL STATUS TO CHANGED
				$Update_sql = sprintf("Update crawl_url set url_status = 'CHANGED' where crawl_url_ID='%s'",
				mysqli_real_escape_string($conn,$crawl_url_ID));
				$result = $conn->query($Update_sql);
			}
			
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
	
	$merchant_name = strtolower('Ederickltd');
	
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
	
	include('../connections/db_connect.php');//close the connection to the database
?>