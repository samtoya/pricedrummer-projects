<?php require 'include/header.php'; ?>
<section id="content" class="slideshow-bg">
	<div id="slideshow">
		<div class="flexslider">
			<ul class="slides">
				<li>
					<div class="slidebg" style="background-image: url('images/hotels/hotel.jpg');"></div>
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
						<li class="active"><a href="#hotels-tab" data-toggle="tab"><i
										class="soap-icon-hotel"></i><span>HOTELS</span></a></li>
						</li>
						<li><a href="#cars-tab" data-toggle="tab"><i class="soap-icon-car"></i><span>CARS</span></a>
						</li>
					</ul>
					<div class="visible-mobile">
						<ul id="mobile-search-tabs" class="search-tabs clearfix">
							<li><a href="#flights-tab">FLIGHTS</a></li>
							<li class="active"><a href="#hotels-tab">HOTELS</a></li>
							<li><a href="#cars-tab">CARS</a></li>
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

                        <div class="tab-pane fade active in" id="hotels-tab">
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

                        <div class="tab-pane fade" id="cars-tab">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Popular Destinations -->
<div class="destinations section">
	<div class="container">
		<h2>Recommended Hotels</h2>
		<div class="row image-box style1 add-clearfix">
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        style="animation-duration: 1s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations01.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$490</span>
						<h4 class="box-title"><a href="hotel-detailed.php">Atlantis - The Palm
								<small>Paris</small>
							</a></h4>
					</div>
				</article>
			</div>
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        data-animation-delay="0.3"
					        style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations02.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$170</span>
						<h4 class="box-title"><a href="hotel-detailed.php">Hilton Hotel
								<small>LONDON</small>
							</a></h4>
					</div>
				</article>
			</div>
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        data-animation-delay="0.6"
					        style="animation-duration: 1s; animation-delay: 0.6s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations03.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$130</span>
						<h4 class="box-title"><a href="hotel-detailed.php">MGM Grand
								<small>LAS VEGAS</small>
							</a></h4>
					</div>
				</article>
			</div>
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        data-animation-delay="0.9"
					        style="animation-duration: 1s; animation-delay: 0.9s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations04.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$290</span>
						<h4 class="box-title"><a href="hotel-detailed.php">Crown Casino
								<small>ASUTRALIA</small>
							</a></h4>
					</div>
				</article>
			</div>
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        style="animation-duration: 1s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations01.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$490</span>
						<h4 class="box-title"><a href="hotel-detailed.php">Atlantis - The Palm
								<small>Paris</small>
							</a></h4>
					</div>
				</article>
			</div>
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        data-animation-delay="0.3"
					        style="animation-duration: 1s; animation-delay: 0.3s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations02.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$170</span>
						<h4 class="box-title"><a href="hotel-detailed.php">Hilton Hotel
								<small>LONDON</small>
							</a></h4>
					</div>
				</article>
			</div>
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        data-animation-delay="0.6"
					        style="animation-duration: 1s; animation-delay: 0.6s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations03.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$130</span>
						<h4 class="box-title"><a href="hotel-detailed.php">MGM Grand
								<small>LAS VEGAS</small>
							</a></h4>
					</div>
				</article>
			</div>
			<div class="col-sms-6 col-sm-6 col-md-3">
				<article class="box">
					<figure class="animated fadeInDown" data-animation-type="fadeInDown" data-animation-duration="1"
					        data-animation-delay="0.9"
					        style="animation-duration: 1s; animation-delay: 0.9s; visibility: visible;">
						<a href="ajax/slideshow-popup.html" title="" class="hover-effect popup-gallery"><img
									src="images/destinations04.jpg" alt="" width="270" height="160"></a>
					</figure>
					<div class="details">
						<span class="price"><small>FROM</small>$290</span>
						<h4 class="box-title"><a href="hotel-detailed.php">Crown Casino
								<small>ASUTRALIA</small>
							</a></h4>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>
<!-- End popular destinations -->


<?php require 'include/footer.php'; ?>
