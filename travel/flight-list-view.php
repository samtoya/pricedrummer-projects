<?php
	$auth_code = "pricedrummer";
	$auth_passphrase = "pricedrummer1216";
	$auth_service = "ultrasearch";
	$auth_version = "1.0";
	$client = new SoapClient("http://ws.za.gotogate.com/ws/pricedrummer?WSDL");
	// var_dump($client->__getFunctions());
	//var_dump($client->__getTypes());
	
	//Initialize Search variables from the get request on the flight form
	$destination_from = $_GET['dfrom'];
	$destination_to = $_GET['dto'];
	$date_from = $_GET['date_from'];
	$date_to = $_GET['date_to'];
	$Adults = $_GET['Adults'];  //Representing Passengers
	//$Kids = $_GET['Kids'];
	$Trip_type = $_GET['t_type'];
	$Ticket_class = $_GET['t_class'];
	
	
	
	//Prepare Passengers (Traveller)
	$Travellers = new StdClass();
	for($i=1; $i<=$Adults; $i++){
		$Travellers->Traveller[] = array("id"=>"t".$i);
	}
	
	//Prepare the Trip type(Bond)
	if($Trip_type=="1"){ //if its a one way flight
		$Bounds = new StdClass();
		$Bounds->Bound[] = array("Origin"=>array("iata"=>$destination_from),
		                         "Destination"=>array("iata"=>$destination_to),
		                         "Date"=>$date_to);
	}else{// its a Return Trip
		$Bounds = new StdClass();
		//In Trip
		$Bounds->Bound[] = array("Origin"=>array("iata"=>$destination_from),
		                         "Destination"=>array("iata"=>$destination_to),
		                         "Date"=>$date_to);
		//Return Trip
		$Bounds->Bound[] = array("Origin"=>array("iata"=>$destination_to),
		                         "Destination"=>array("iata"=>$destination_from),
		                         "Date"=>$date_to);
	}
	
	//Prepare Additional FlightOptions
	$Flight_Options = new StdClass();
	if($Ticket_class !="0"){
		$Flight_Options->option[] = array("cabin"=>$Ticket_class);
	}
	//direct flight condition will follow and add to the $Flight_Options->option[] array
	
	
	
	$params =  array("Request"=>array("code"=>$auth_code,
	                                  "passphrase"=>$auth_passphrase,
	                                  "service"=>$auth_service,
	                                  "version"=>$auth_version,
	                                  "Search"=>array("Traveller"=> $Travellers->Traveller,
	                                                  "FlightSearch"=> array("Bound"=>$Bounds->Bound))));
	if(!empty($Flight_Options->option)){
		$params['Request']['Search']['FlightOptions']=$Flight_Options->option;
	}
	// echo"<pre>";
//print_r($params);
	
	
	try {
		$response = $client->__soapCall("UltraSearch10", $params);
	}catch(Exception $e) {
		header('Location: 404.php');
		// die("Bad");
  // 		echo 'Message: ' .$e->getMessage();
	}

// print_r($response);
// die();
	// echo"</pre>";
	$Currency = $response->Result->Offers->Currency;
	$Offers = $response->Result->Offers->Offer;
	$flightOffers = $response->Result->FlightOffers->FlightOffer;
	$Airport = $response->Result->StaticContent->Airport;
	$Carrier = $response->Result->StaticContent->Carrier;
	$CuccCode = $response->Result->Offers->Currency->code;
	
	
	

?>
<?php require 'include/header.php'; ?>
	
	<div class="page-title-container">
	<div class="container">
		<div class="page-title pull-left">
			<h2 class="entry-title">Flight Search Results</h2>
		</div>
		<ul class="breadcrumbs pull-right">
			<li><a href="index.php">HOME</a></li>
			<li class="active">Flight Search Results</li>
		</ul>
	</div>
</div>
	<section id="content">
	<div class="container">
		<div id="main">
			<div class="row">
				<div class="col-sm-4 col-md-3">
					<h4 class="search-results-title"><i class="soap-icon-search"></i><b><?php echo count($Offers); ?></b> results found.</h4>
					<div class="toggle-container filters-container">
						<div class="panel style1 arrow-right">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
							</h4>
							<div id="price-filter" class="panel-collapse collapse">
								<div class="panel-content">
									<div id="price-range"></div>
									<br/>
									<span class="min-price-label pull-left"></span>
									<span class="max-price-label pull-right"></span>
									<div class="clearer"></div>
								</div><!-- end content -->
							</div>
						</div>
						
						<div class="panel style1 arrow-right">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#flight-times-filter" class="collapsed">Flight Times</a>
							</h4>
							<div id="flight-times-filter" class="panel-collapse collapse">
								<div class="panel-content">
									<div id="flight-times" class="slider-color-yellow"></div>
									<br/>
									<span class="start-time-label pull-left"></span>
									<span class="end-time-label pull-right"></span>
									<div class="clearer"></div>
								</div><!-- end content -->
							</div>
						</div>
						
						<div class="panel style1 arrow-right">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#flight-stops-filter" class="collapsed">Flight Stops</a>
							</h4>
							<div id="flight-stops-filter" class="panel-collapse collapse">
								<div class="panel-content">
									<ul class="check-square filters-option">
										<li><a href="#">1 Stop</a></li>
										<li><a href="#">2 Stops</a></li>
										<li class="active"><a href="#">3 Stops</a></li>
										<li><a href="#">MultiStops</a></li>
									</ul>
									<a class="button btn-mini">MORE</a>
								</div>
							</div>
						</div>
						
						<div class="panel style1 arrow-right">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#airlines-filter" class="collapsed">Airlines</a>
							</h4>
							<div id="airlines-filter" class="panel-collapse collapse">
								<div class="panel-content">
									<ul class="check-square filters-option">
										<li><a href="#">Major Airline
												<small>($620)</small>
											</a></li>
										<li><a href="#">United Airlines
												<small>($982)</small>
											</a></li>
										<li class="active"><a href="#">delta airlines
												<small>($1,127)</small>
											</a></li>
										<li><a href="#">Alitalia
												<small>($2,322)</small>
											</a></li>
										<li><a href="#">US airways
												<small>($3,158)</small>
											</a></li>
										<li><a href="#">Air France
												<small>($4,239)</small>
											</a></li>
										<li><a href="#">Air tahiti nui
												<small>($5,872)</small>
											</a></li>
									</ul>
									<a class="button btn-mini">MORE</a>
								</div>
							</div>
						</div>
						
						<div class="panel style1 arrow-right">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#flight-type-filter" class="collapsed">Flight Type</a>
							</h4>
							<div id="flight-type-filter" class="panel-collapse collapse">
								<div class="panel-content">
									<ul class="check-square filters-option">
										<li><a href="#">Business</a></li>
										<li><a href="#">First class</a></li>
										<li class="active"><a href="#">Economy</a></li>
										<li><a href="#">Premium Economy</a></li>
									</ul>
									<a class="button btn-mini">MORE</a>
								</div>
							</div>
						</div>
						
						<div class="panel style1 arrow-right">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#inflight-experience-filter" class="collapsed">Inflight
									Experience</a>
							</h4>
							<div id="inflight-experience-filter" class="panel-collapse collapse">
								<div class="panel-content">
									<ul class="check-square filters-option">
										<li><a href="#">Inflight Dining</a></li>
										<li><a href="#">Music</a></li>
										<li class="active"><a href="#">Sky Shopping</a></li>
										<li><a href="#">Wi-fi</a></li>
										<li><a href="#">Seats &amp; Cabin</a></li>
									</ul>
									<a class="button btn-mini">MORE</a>
								</div>
							</div>
						</div>
						
						<div class="panel style1 arrow-right">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify
									Search</a>
							</h4>
							<div id="modify-search-panel" class="panel-collapse collapse">
								<div class="panel-content">
									<form method="post">
										<div class="form-group">
											<label>Leaving from</label>
											<input type="text" class="input-text full-width" placeholder=""
											       value="city, district, or specific airpot"/>
										</div>
										<div class="form-group">
											<label>Departure on</label>
											<div class="datepicker-wrap">
												<input type="text" name="date_from" class="input-text full-width"
												       placeholder="mm/dd/yy"/>
											</div>
										</div>
										<div class="form-group">
											<label>Arriving On</label>
											<div class="datepicker-wrap">
												<input type="text" name="date_to" class="input-text full-width"
												       placeholder="mm/dd/yy"/>
											</div>
										</div>
										<br/>
										<button class="btn-medium icon-check uppercase full-width">search again</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-8 col-md-9">
					<div class="sort-by-section clearfix box">
						<h4 class="sort-by-title block-sm">Sort results by:</h4>
						<ul class="sort-bar clearfix block-sm">
							<li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
							<li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
							<li class="sort-by-rating active"><a class="sort-by-container"
							                                     href="#"><span>duration</span></a></li>
						</ul>
						
						<ul class="swap-tiles clearfix block-sm">
							<li class="swap-list active">
								<a href="flight-list-view.php"><i class="soap-icon-list"></i></a>
							</li>
							<!-- <li class="swap-grid">
								<a href="flight-grid-view.php"><i class="soap-icon-grid"></i></a>
							</li>
							<li class="swap-block">
								<a href="flight-block-view.php"><i class="soap-icon-block"></i></a>
							</li> -->
						</ul>
					</div>
					<div class="flight-list listing-style3 flight">
						
						<?php 

						foreach ($Offers as $offer_key => $offer) {
		$FlightOfferRef_id = $offer->FlightOfferRef->ref;
		$FlightOffer_Details;
		
		//collect the particular Flight Offer
		foreach($flightOffers as $FlightOffer) {
			if (trim($FlightOfferRef_id) == trim($FlightOffer->id)) {
				$FlightOffer_Details = $FlightOffer;
				break;
			}
		}
		
		if($Trip_type=="1"){/////////////////////////////////////////////===============ONE WAY TRIP =======================//////////////////
			
			// echo "Price : " .$CuccCode. $offer->Price.  "<br/>";
			// echo "Url : " . $offer->url . "<br/>";
			// echo"<pre>";
			// print_r($FlightOffer_Details);
			// echo"</pre>";
			// echo "TravelTime : " . $FlightOffer_Details->SegmentGroup->TravelTime . "<br/>";
			
			if(is_object($FlightOffer_Details->SegmentGroup->Segment)){
				// echo "From_city : " . $FlightOffer_Details->SegmentGroup->Segment->From->iata . "<br/>";
				// echo "From_date : " . $FlightOffer_Details->SegmentGroup->Segment->From->Date . "<br/>";
				// echo "From_time : " . $FlightOffer_Details->SegmentGroup->Segment->From->Time . "<br/>";
				$Airport_Details_F;
				foreach($Airport as $airport) {
					if ($FlightOffer_Details->SegmentGroup->Segment->From->iata == $airport->iata) {
						$Airport_Details_F = $airport;
						break;
					}
				}
				$Airport_Details;
				foreach($Airport as $airport) {
					if ($FlightOffer_Details->SegmentGroup->Segment->From->iata == $airport->iata) {
						$Airport_Details = $airport;
						break;
					}
				}
				// echo "To_city : " . $Airport_Details->Name . "<br/>";
				// echo "To_date : " . $FlightOffer_Details->SegmentGroup->Segment->To->Date . "<br/>";
				// echo "To_time : " . $FlightOffer_Details->SegmentGroup->Segment->To->Time . "<br/>";
				$Carrier_Details;
				foreach($Carrier as $carrier) {
					if ($FlightOffer_Details->SegmentGroup->Segment->carrier == $carrier->code) {
						$Carrier_Details = $carrier;
						break;
					}
				}
				// echo "Carrier : " . $Carrier_Details->Name . "<br/>";
				// echo "Flight_Number : " . $FlightOffer_Details->SegmentGroup->Segment->flight . "<br/><br/>";

				?>
					<article class="box">
						<figure class="col-xs-3 col-sm-2">
								<span><img alt="" src="<?php echo $Carrier_Details->Image->url; ?>"></span>
							</figure>
							<div class="details col-xs-9 col-sm-10">
								<div class="details-wrapper">
									<div class="first-row">
										<div>
											<h4 class="box-title"><?php echo $Airport_Details_F->Name; ?> to <?php echo $Airport_Details->Name; ?>
												<small>Oneway flight</small>
											</h4>
											<a class="button btn-mini stop">1 STOP</a>
											<div class="amenities">
												<!-- <i class="soap-icon-wifi circle"></i>
												<i class="soap-icon-entertainment circle"></i>
												<i class="soap-icon-fork circle"></i>
												<i class="soap-icon-suitcase circle"></i> -->
											</div>
										</div>
										<div>
											<span class="price"><small>AVG/PERSON</small><?php echo $offer->Price; ?><?php echo $CuccCode; ?></span>
										</div>
									</div>
									<div class="second-row">
										<div class="time">
											<div class="take-off col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">Take off</span><br/><?php echo $FlightOffer_Details->SegmentGroup->Segment->From->Date; ?>, <?php echo $FlightOffer_Details->SegmentGroup->Segment->To->Time; ?>
													Am
												</div>
											</div>
											<div class="landing col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">landing</span><br/><?php echo $FlightOffer_Details->SegmentGroup->Segment->To->Date; ?>, <?php echo $FlightOffer_Details->SegmentGroup->Segment->To->Time; ?>
												</div>
											</div>
											<div class="total-time col-sm-4">
												<div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
												<div>
													<span class="skin-color">Carrier</span><br/><?php echo $Carrier_Details->Name ; ?>
												</div>
											</div>
										</div>
										<div class="action">
											<a href="<?php echo $offer->url; ?>" target="new" class="button btn-small full-width">GO TO SITE</a>
										</div>
									</div>
								</div>
							</div>
							
						</article>
				<?php


			}else{

				// echo"<strong>";
				// echo "From_city : " . $FlightOffer_Details->SegmentGroup->Segment[0]->From->iata . "<br/>";
				// echo "From_date : " . $FlightOffer_Details->SegmentGroup->Segment[0]->From->Date . "<br/>";
				// echo "From_time : " . $FlightOffer_Details->SegmentGroup->Segment[0]->From->Time . "<br/>";
				$Airport_Details_F;
				foreach($Airport as $airport) {
					if ($FlightOffer_Details->SegmentGroup->Segment[0]->From->iata == $airport->iata) {
						$Airport_Details_F = $airport;
						break;
					}
				}
				$Airport_Details;
				foreach($Airport as $airport) {
					if ($FlightOffer_Details->SegmentGroup->Segment[0]->To->iata == $airport->iata) {
						$Airport_Details = $airport;
						break;
					}
				}

				// echo "To_city : " . $Airport_Details->Name . "<br/>";
				// echo "To_date : " . $FlightOffer_Details->SegmentGroup->Segment[0]->To->Date . "<br/>";
				// echo "To_time : " . $FlightOffer_Details->SegmentGroup->Segment[0]->To->Time . "<br/>";
				$Carrier_Details;
				foreach($Carrier as $carrier) {
					if ($FlightOffer_Details->SegmentGroup->Segment[0]->carrier == $carrier->code) {
						$Carrier_Details = $carrier;
						break;
					}
				}
				// echo "Carrier : " . $Carrier_Details->Name . "<br/>";
				// echo "Flight_Number : " . $FlightOffer_Details->SegmentGroup->Segment[0]->flight . "<br/>";
				// echo"<br/>";
				// echo "From_city1 : " . $FlightOffer_Details->SegmentGroup->Segment[1]->From->iata . "<br/>";
				// echo "From_date1 : " . $FlightOffer_Details->SegmentGroup->Segment[1]->From->Date . "<br/>";
				// echo "From_time1 : " . $FlightOffer_Details->SegmentGroup->Segment[1]->From->Time . "<br/>";
				// echo "To_city1 : " . $FlightOffer_Details->SegmentGroup->Segment[1]->To->iata . "<br/>";
				// echo "To_date1 : " . $FlightOffer_Details->SegmentGroup->Segment[1]->To->Date . "<br/>";
				// echo "To_time1 : " . $FlightOffer_Details->SegmentGroup->Segment[1]->To->Time . "<br/>";
				$Carrier_Details;
				foreach($Carrier as $carrier) {
					if ($FlightOffer_Details->SegmentGroup->Segment[0]->carrier == $carrier->code) {
						$Carrier_Details = $carrier;
						break;
					}
				}
				// echo "Carrier1 : " . $Carrier_Details->Name . "<br/>";
				// echo "Flight_Number1 : " . $FlightOffer_Details->SegmentGroup->Segment[1]->flight . "<br/><br/>";
				// echo"</strong>";
				
				?>
					<article class="box">
						<figure class="col-xs-3 col-sm-2">
								<span><img alt="" src="<?php echo $Carrier_Details->Image->url; ?>"></span>
							</figure>
							<div class="details col-xs-9 col-sm-10">
								<div class="details-wrapper">
									<div class="first-row">
										<div>
											<h4 class="box-title"><?php echo $Airport_Details_F->Name; ?> to <?php echo $Airport_Details->Name; ?>
												<small>Oneway flight</small>
											</h4>
											<a class="button btn-mini stop"><?php echo count($FlightOffer_Details->SegmentGroup->Segment) ?> STOP</a>
											<div class="amenities">
												<!-- <i class="soap-icon-wifi circle"></i>
												<i class="soap-icon-entertainment circle"></i>
												<i class="soap-icon-fork circle"></i>
												<i class="soap-icon-suitcase circle"></i> -->
											</div>
										</div>
										<div>
											<span class="price"><small>AVG/PERSON</small><?php echo $offer->Price; ?><?php echo $CuccCode; ?></span>
										</div>
									</div>
									<div class="second-row">
										<div class="time">
											<div class="take-off col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">Take off</span><br/><?php echo $FlightOffer_Details->SegmentGroup->Segment[0]->From->Date; ?>, <?php echo $FlightOffer_Details->SegmentGroup->Segment[0]->To->Time; ?>
													Am
												</div>
											</div>
											<div class="landing col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">landing</span><br/><?php echo $FlightOffer_Details->SegmentGroup->Segment[0]->To->Date; ?>, <?php echo $FlightOffer_Details->SegmentGroup->Segment[0]->To->Time; ?>
												</div>
											</div>
											<div class="total-time col-sm-4">
												<div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
												<div>
													<span class="skin-color">Carrier</span><br/><?php echo $Carrier_Details->Name ; ?>
												</div>
											</div>
										</div>
										<div class="action">
											<a href="<?php echo $offer->url; ?>" target="new" class="button btn-small full-width">GO TO SITE</a>
										</div>
									</div>
								</div>
							</div>
							
						</article>
				<?php
			}
			
			
		}else{/////////////////////////////////==========RETURN TRIP LOOP=========//////////////////////
			
			// echo "Price : " .$CuccCode. $offer->Price.  "<br/>";
			// echo "Url : " . $offer->url . "<br/>";
			
			foreach ($FlightOffer_Details->SegmentGroup as $key=>$segmentGroup) {
				// echo"<pre>";
				// print_r($segmentGroup);
				// echo"</pre>";
				if(is_array($segmentGroup->Segment)){
					//INDIRECT FLIGHT
					echo"<strong>";
					foreach ($segmentGroup->Segment as $key=>$segment) {

						// echo "TravelTime : " . $segmentGroup->TravelTime . "<br/>";
						
						//FLIGHT IN DETAILS
						// echo "From_city : " . $segment->From->iata . "<br/>";
						// echo "From_date : " . $segment->From->Date . "<br/>";
						// echo "From_time : " . $segment->From->Time . "<br/>";
						$Airport_Details_F;
						foreach($Airport as $airport) {
							if ($segment->From->iata == $airport->iata) {
								$Airport_Details_F = $airport;
								break;
							}
						}
						$Airport_Details;
						foreach($Airport as $airport) {
							if ($segment->To->iata == $airport->iata) {
								$Airport_Details = $airport;
								break;
							}
						}
						// echo "To_city : " . $Airport_Details->Name . "<br/>";
						// echo "To_date : " . $segment->To->Date . "<br/>";
						// echo "To_time : " . $segment->To->Time . "<br/>";
						$Carrier_Details;
						foreach($Carrier as $carrier) {
							if ($segment->carrier == $carrier->code) {
								$Carrier_Details = $carrier;
								break;
							}
						}
						// echo "Carrier : " . $Carrier_Details->Name . "<br/>";
						// echo "Flight_Number : " . $segment->flight . "<br/><br/>";

						if($key == count($segmentGroup->Segment)-1){
							?>
						<article class="box">
						<figure class="col-xs-3 col-sm-2">
								<span><img alt="" src="<?php echo $Carrier_Details->Image->url; ?>"></span>
							</figure>
							<div class="details col-xs-9 col-sm-10">
								<div class="details-wrapper">
									<div class="first-row">
										<div>
											<h4 class="box-title"><?php echo $Airport_Details_F->Name; ?> to <?php echo $Airport_Details->Name; ?>
												<small>Oneway flight</small>
											</h4>
											<a class="button btn-mini stop">1 STOP</a>
											<div class="amenities">
												<!-- <i class="soap-icon-wifi circle"></i>
												<i class="soap-icon-entertainment circle"></i>
												<i class="soap-icon-fork circle"></i>
												<i class="soap-icon-suitcase circle"></i> -->
											</div>
										</div>
										<div>
											<span class="price"><small>AVG/PERSON</small><?php echo $offer->Price; ?><?php echo $CuccCode; ?></span>
										</div>
									</div>
									<div class="second-row">
										<div class="time">
											<div class="take-off col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">Take off</span><br/><?php echo $segment->From->Date; ?>, <?php echo $segment->To->Time; ?>
													Am
												</div>
											</div>
											<div class="landing col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">landing</span><br/><?php echo $segment->To->Date; ?>, <?php echo $segment->To->Time; ?>
												</div>
											</div>
											<div class="total-time col-sm-4">
												<div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
												<div>
													<span class="skin-color">Carrier</span><br/><?php echo $Carrier_Details->Name ; ?>
												</div>
											</div>
										</div>
										<div class="action">
											<a href="<?php echo $offer->url; ?>" target="new" class="button btn-small full-width">GO TO SITE</a>
										</div>
									</div>
								</div>
							</div>
							
						</article>
						</article>
							<?php
						}

					}
					echo"</strong>";
				}else{
					//DIRECT FLIGHT
					// echo "TravelTime : " . $segmentGroup->TravelTime . "<br/>";
					
					//FLIGHT IN DETAILS
					// echo "From_city : " . $segmentGroup->Segment->From->iata . "<br/>";
					// echo "From_date : " . $segmentGroup->Segment->From->Date . "<br/>";
					// echo "From_time : " . $segmentGroup->Segment->From->Time . "<br/>";
					$Airport_Details_F;
					foreach($Airport as $airport) {
						if ($segmentGroup->Segment->From->iata == $airport->iata) {
							$Airport_Details_F = $airport;
							break;
						}
					}
					$Airport_Details;
					foreach($Airport as $airport) {
						if ($segmentGroup->Segment->To->iata == $airport->iata) {
							$Airport_Details = $airport;
							break;
						}
					}
					// echo "To_city : " . $Airport_Details->Name . "<br/>";
					// echo "To_date : " . $segmentGroup->Segment->To->Date . "<br/>";
					// echo "To_time : " . $segmentGroup->Segment->To->Time . "<br/>";
					$Carrier_Details;
					foreach($Carrier as $carrier) {
						if ($segmentGroup->Segment->carrier == $carrier->code) {
							$Carrier_Details = $carrier;
							break;
						}
					}
					// echo "Carrier : " . $Carrier_Details->Name . "<br/>";
					// echo "Flight_Number : " . $segmentGroup->Segment->flight . "<br/><br/>";
					
					?>
					<?php if($key==0){
						?>
							<article class="box">
							<article class="box">
							<figure class="col-xs-3 col-sm-2">
								<span><img alt="" src="<?php echo $Carrier_Details->Image->url; ?>"></span>
							</figure>
							<div class="details col-xs-9 col-sm-10">
								<div class="details-wrapper">
									<div class="first-row">
										<div>
											<h4 class="box-title"><?php echo $Airport_Details_F->Name; ?> to <?php echo $Airport_Details->Name; ?>
												<small>Oneway flight</small>
											</h4>
											<a class="button btn-mini stop">1 STOP</a>
											<div class="amenities">
												<!-- <i class="soap-icon-wifi circle"></i>
												<i class="soap-icon-entertainment circle"></i>
												<i class="soap-icon-fork circle"></i>
												<i class="soap-icon-suitcase circle"></i> -->
											</div>
										</div>
									</div>
									<div class="second-row">
										<div class="time">
											<div class="take-off col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">Take off</span><br/><?php echo $segmentGroup->Segment->From->Date; ?>, <?php echo $segmentGroup->Segment->To->Time; ?>
													Am
												</div>
											</div>
											<div class="landing col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">landing</span><br/><?php echo $segmentGroup->Segment->To->Date; ?>, <?php echo $segmentGroup->Segment->To->Time; ?>
												</div>
											</div>
											<div class="total-time col-sm-4">
												<div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
												<div>
													<span class="skin-color">Carrier</span><br/><?php echo $Carrier_Details->Name ; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</article>
						<?php
					}else{
						?>
						<article class="box">
						<figure class="col-xs-3 col-sm-2">
								<span><img alt="" src="<?php echo $Carrier_Details->Image->url; ?>"></span>
							</figure>
							<div class="details col-xs-9 col-sm-10">
								<div class="details-wrapper">
									<div class="first-row">
										<div>
											<h4 class="box-title"><?php echo $Airport_Details_F->Name; ?> to <?php echo $Airport_Details->Name; ?>
												<small>Oneway flight</small>
											</h4>
											<a class="button btn-mini stop">1 STOP</a>
											<div class="amenities">
												<!-- <i class="soap-icon-wifi circle"></i>
												<i class="soap-icon-entertainment circle"></i>
												<i class="soap-icon-fork circle"></i>
												<i class="soap-icon-suitcase circle"></i> -->
											</div>
										</div>
										<div>
											<span class="price"><small>AVG/PERSON</small><?php echo $offer->Price; ?><?php echo $CuccCode; ?></span>
										</div>
									</div>
									<div class="second-row">
										<div class="time">
											<div class="take-off col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">Take off</span><br/><?php echo $segmentGroup->Segment->From->Date; ?>, <?php echo $segmentGroup->Segment->To->Time; ?>
													Am
												</div>
											</div>
											<div class="landing col-sm-4">
												<div class="icon"><i class="soap-icon-plane-right yellow-color"></i>
												</div>
												<div>
													<span class="skin-color">landing</span><br/><?php echo $segmentGroup->Segment->To->Date; ?>, <?php echo $segmentGroup->Segment->To->Time; ?>
												</div>
											</div>
											<div class="total-time col-sm-4">
												<div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
												<div>
													<span class="skin-color">Carrier</span><br/><?php echo $Carrier_Details->Name ; ?>
												</div>
											</div>
										</div>
										<div class="action">
											<a href="<?php echo $offer->url; ?>" target="new" class="button btn-small full-width">GO TO SITE</a>
										</div>
									</div>
								</div>
							</div>
						</article>
						</article>
						<?php
						} ?>
					

					<?php

				}
				
			}   //End of segment group in Return trip
			
		}
		
		
	}
?>



						
					
					</div>
					<!-- <a class="button uppercase full-width btn-large">load more listings</a> -->
				</div>
			</div>
		</div>
	</div>
</section>

<?php require 'include/footer.php'; ?>
