<?php require 'include/header.php'; ?>
	<section id="content" class="slideshow-bg">
		<div id="slideshow">
			<div class="flexslider">
				<ul class="slides">
					<li>
						<div class="slidebg" style="background-image: url('images/car-rental/car-rental-2.jpg');"></div>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="container">
			<div id="main">
				<h1 class="page-title">Fly with us in Comfort!</h1>
				<h2 class="page-description col-md-6 no-float no-padding">We're bringing you a modern, comfortable and
					connected flight experience.</h2>
				<div class="search-box-wrapper style2">
					<div class="search-box">
						<ul class="search-tabs clearfix">
							<li><a href="#flights-tab" data-toggle="tab"><i
											class="soap-icon-plane-right takeoff-effect"></i><span>FLIGHTS</span></a></li>
							<li><a href="#hotels-tab" data-toggle="tab"><i
									class="soap-icon-hotel"></i><span>HOTELS</span></a></li>
							<li class="active"><a href="#cars-tab" data-toggle="tab"><i class="soap-icon-car"></i><span>CARS</span></a>
							</li>
						</ul>
						<div class="visible-mobile">
							<ul id="mobile-search-tabs" class="search-tabs clearfix">
								<li><a href="#flights-tab">FLIGHTS</a></li>
								<li><a href="#hotels-tab">HOTELS</a></li>
								<li class="active"><a href="#cars-tab">CARS</a></li>
							</ul>
						</div>
						
						<div class="search-tab-content">
                            <div class="tab-pane fade" id="flights-tab">
                                <form action="flight-list-view.php" method="post">
                                    <h4 class="title">Where do you want to go?</h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="input-text full-width" name="dfrom"
                                                       placeholder="Leaving From (city, distirct or specific airpot)"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="input-text full-width" name="dto"
                                                       placeholder="Going To (city, distirct or specific airpot)"/>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from"
                                                               class="input-text full-width"
                                                               placeholder="Departing On"/>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width" name="t_type">
                                                            <option value="1" selected>One-way trip</option>
                                                            <option value="2">Return trip</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_to"
                                                               class="input-text full-width"
                                                               placeholder="Arriving On"/>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width" name="t_class">
                                                            <option value="0" selected>Ticket class</option>
                                                            <option value="Y" >Economy class</option>
                                                            <option value="S">Premium Economy class</option>
                                                            <option value="C">Business class</option>
                                                            <option value="J">Premium Business class</option>
                                                            <option value="F">First class</option>
                                                            <option value="2">Premium First class</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group row">
                                                <div class="col-xs-12">
                                                    <div class="selector">
                                                        <select class="full-width" name="Adults">
                                                            <option value="1" selected>1 passenger</option>
                                                            <option value="2">2 passengers</option>
                                                            <option value="3">3 passengers</option>
                                                            <option value="4">4 passengers</option>
                                                            <option value="5">5 passengers</option>
                                                            <option value="6">6 passengers</option>
                                                            <option value="7">7 passengers</option>
                                                            <option value="8">8 passengers</option>
                                                            <option value="9">9 passengers</option>
                                                            <option value="10">10 passengers</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-xs-3">
                                                    <div class="selector">
                                                        <select class="full-width" name="Kids">
                                                            <option value="0" selected>0 Kids</option>
                                                            <option value="1">01</option>
                                                            <option value="2">02</option>
                                                            <option value="3">03</option>
                                                            <option value="4">04</option>
                                                            <option value="5">05</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-3">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 clearfix">
                                            <div class="col-md-3 col-md-offset-2 col-xs-4 col-sm-4 col-sm-offset-5 col-xs-offset-4">
                                                <button id="round-btn">SEARCH</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="hotels-tab">
                                <form action="hotel-list-view.php" method="post">
                                    <h4 class="title">Where do you want to go?</h4>
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-3">
                                            <input type="text" class="input-text full-width"
                                                   placeholder="Rome, Paris, New York..."/>
                                        </div>
                                        <div class="form-group col-sm-6 col-md-4">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from"
                                                               class="input-text full-width" placeholder="Check In"/>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_to" class="input-text full-width"
                                                               placeholder="Check Out"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="1">1 Room</option>
                                                            <option value="2">2 Rooms</option>
                                                            <option value="3">3 Rooms</option>
                                                            <option value="4">4 Rooms</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="1">1 Guest</option>
                                                            <option value="2">2 Guests</option>
                                                            <option value="3">3 Guests</option>
                                                            <option value="4">4 Guests</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 clearfix">
                                            <div class="col-md-3 col-md-offset-2 col-xs-4 col-sm-4 col-sm-offset-5 col-xs-offset-4">
                                                <button id="round-btn" class="hotel-btn">SEARCH</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade active in" id="cars-tab">
                                <form action="car-list-view.php" method="post">
                                    <h4 class="title">Where do you want to go?</h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="input-text full-width"
                                                       placeholder="Pick Up (city, distirct or specific airpot)"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="input-text full-width"
                                                       placeholder="Drop Off (city, distirct or specific airpot)"/>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="datepicker-wrap">
                                                            <input type="text" name="date_from"
                                                                   class="input-text full-width"
                                                                   placeholder="Pick-Up Date / Time"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="selector">
                                                            <select class="full-width">
                                                                <option value="1">anytime</option>
                                                                <option value="2">morning</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="datepicker-wrap">
                                                            <input type="text" name="date_to"
                                                                   class="input-text full-width"
                                                                   placeholder="Drop-Off Date / Time"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <div class="selector">
                                                            <select class="full-width">
                                                                <option value="1">anytime</option>
                                                                <option value="2">morning</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group row">
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">Adults</option>
                                                            <option value="1">01</option>
                                                            <option value="2">02</option>
                                                            <option value="3">03</option>
                                                            <option value="4">04</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">Kids</option>
                                                            <option value="1">01</option>
                                                            <option value="2">02</option>
                                                            <option value="3">03</option>
                                                            <option value="4">04</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-xs-12">
                                                    <div class="selector">
                                                        <select class="full-width">
                                                            <option value="">select a car type</option>
                                                            <option value="economy">Economy</option>
                                                            <option value="compact">Compact</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 clearfix">
                                            <div class="col-md-3 col-md-offset-2 col-xs-4 col-sm-4 col-sm-offset-5 col-xs-offset-4">
                                                <button id="round-btn">SEARCH</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
						</div> <!-- end tab content -->
					</div> <!-- end search box div -->
				</div> <!-- end search box wrapper div -->
			</div> <!-- end main div -->
		</div> <!-- end container div -->
	</section> <!-- end content section -->

	<!-- cAR content goes here -->
<div class="section gray-area text-left">
	<div class="container">
		<div class="block">
			<div class="row image-box style10">
				<div class="col-md-4">
					<article class="box">
						<figure class="animated fadeInRight" data-animation-type="fadeInRight" style="animation-duration: 1s; visibility: visible;">
							<a class="hover-effect" title="" href="car-detailed.html"><img width="370" height="132" alt="" src="images/shortcodes/image-box/style10/1.png"></a>
						</figure>
						<div class="details">
							<a href="car-detailed.html" class="button">MORE</a>
							<h4 class="box-title">Driven to save?<br><small>Save up to 35%</small></h4>
						</div>
					</article>
				</div>
				<div class="col-md-4">
					<article class="box">
						<figure class="animated fadeInRight" data-animation-type="fadeInRight" data-animation-delay="0.3" style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
							<a class="hover-effect" title="" href="car-detailed.html"><img width="370" height="132" alt="" src="images/shortcodes/image-box/style10/2.png"></a>
						</figure>
						<div class="details">
							<a href="car-detailed.html" class="button">MORE</a>
							<h4 class="box-title">Room to relax<br><small>Earn 250 miles</small></h4>
						</div>
					</article>
				</div>
				<div class="col-md-4">
					<article class="box">
						<figure class="animated fadeInRight" data-animation-type="fadeInRight" data-animation-delay="0.6" style="animation-duration: 1s; animation-delay: 0.6s; visibility: visible;">
							<a class="hover-effect" title="" href="car-detailed.html"><img width="370" height="132" alt="" src="images/shortcodes/image-box/style10/3.png"></a>
						</figure>
						<div class="details">
							<a href="car-detailed.html" class="button">MORE</a>
							<h4 class="box-title">Last Minute Car Deals<br><small>Get best car rental deals</small></h4>
						</div>
					</article>
				</div>
			</div>
		</div>
		
		<div class="block row">
			<div class="col-md-4">
				<h2>Last Minute Deals</h2>
				<div class="travelo-box image-box style13">
					<div class="box">
						<figure>
							<img width="63" height="59" alt="" src="images/cars/thumbnail/1.png">
						</figure>
						<div class="action">
							<span class="price"><small>per 3 day</small>$35</span>
						</div>
						<div class="details">
							<h4 class="box-title"><a href="#">Intermediate<small>Renault grand scenic</small></a></h4>
							<span class="time skin-color"><i class="soap-icon-clock"></i>24 hours remaining</span>
						</div>
					</div>
					<hr>
					<div class="box">
						<figure>
							<img width="63" height="59" alt="" src="images/cars/thumbnail/2.png">
						</figure>
						<div class="action">
							<span class="price"><small>per 2 day</small>$26</span>
						</div>
						<div class="details">
							<h4 class="box-title"><a href="#">Luxury Elite<small>bmw 5 series</small></a></h4>
							<span class="time skin-color"><i class="soap-icon-clock"></i>38 minutes remaining</span>
						</div>
					</div>
					<hr>
					<div class="box">
						<figure>
							<img width="63" height="59" alt="" src="images/cars/thumbnail/3.png">
						</figure>
						<div class="action">
							<span class="price"><small>per day</small>$49</span>
						</div>
						<div class="details">
							<h4 class="box-title"><a href="#">Economy Car<small>vokswagen polo</small></a></h4>
							<span class="time skin-color"><i class="soap-icon-clock"></i>24 hours remaining</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<h2>Why Book with us?</h2>
				<div class="travelo-box book-with-us-box">
					<ul>
						<li>
							<i class="soap-icon-car circle"></i>
							<h5 class="title"><a href="#">135,00+ Cars</a></h5>
							<p>Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
						</li>
						<li>
							<i class="soap-icon-savings circle"></i>
							<h5 class="title"><a href="#">Low Rates &amp; Savings</a></h5>
							<p>Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
						</li>
						<li>
							<i class="soap-icon-support circle"></i>
							<h5 class="title"><a href="#">Excellent Support</a></h5>
							<p>Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<h2>Explore More</h2>
				<div class="travelo-box explore-more image-box style5 clearfix">
					<div class="icon-box intro">
						<i class="soap-icon-recommend circle"></i>
						<h5 class="box-title"><small>Recommended for you!</small>Car Packages Starting at $35.99</h5>
					</div>
					<article class="box animated fadeIn" data-animation-type="fadeIn" data-animation-delay="0" style="animation-duration: 1s; visibility: visible;">
						<figure>
							<a title="" href="car-detailed.html"><img width="183" height="120" alt="" src="images/cars/thumbnail/4.png"></a>
							<figcaption>
								<h6 class="caption-title">Elite</h6>
								<span>Fiat 500</span>
							</figcaption>
						</figure>
					</article>
					<article class="box animated fadeIn" data-animation-type="fadeIn" data-animation-delay="0.3" style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
						<figure>
							<a title="" href="car-detailed.html"><img width="183" height="120" alt="" src="images/cars/thumbnail/5.png"></a>
							<figcaption>
								<h6 class="caption-title">Mini</h6>
								<span>BMW 5 S</span>
							</figcaption>
						</figure>
					</article>
					<article class="box animated fadeIn" data-animation-type="fadeIn" data-animation-delay="0.6" style="animation-duration: 1s; animation-delay: 0.6s; visibility: visible;">
						<figure>
							<a title="" href="car-detailed.html"><img width="183" height="120" alt="" src="images/cars/thumbnail/6.png"></a>
							<figcaption>
								<h6 class="caption-title">luxury</h6>
								<span>BMW 7 s</span>
							</figcaption>
						</figure>
					</article>
					<article class="box animated fadeIn" data-animation-type="fadeIn" data-animation-delay="0.9" style="animation-duration: 1s; animation-delay: 0.9s; visibility: visible;">
						<figure>
							<a title="" href="car-detailed.html"><img width="183" height="120" alt="" src="images/cars/thumbnail/7.png"></a>
							<figcaption>
								<h6 class="caption-title">Elite</h6>
								<span>Holden 6</span>
							</figcaption>
						</figure>
					</article>
				</div>
			</div>
		</div>
	</div>
</div>

	<!-- cAR content ends here -->

<?php require 'include/footer.php'; ?>
