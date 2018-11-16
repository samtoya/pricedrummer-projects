<?php require 'include/header.php'; ?>
        <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Hotel Search Results</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">HOME</a></li>
                    <li class="active">Hotel Search Results</li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b>1,984</b> results found.</h4>
                            <div class="toggle-container filters-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                                    </h4>
                                    <div id="price-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <div id="price-range"></div>
                                            <br />
                                            <span class="min-price-label pull-left"></span>
                                            <span class="max-price-label pull-right"></span>
                                            <div class="clearer"></div>
                                        </div><!-- end content -->
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#rating-filter" class="collapsed">User Rating</a>
                                    </h4>
                                    <div id="rating-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <div id="rating" class="five-stars-container editable-rating"></div>
                                            <br />
                                            <small>2458 REVIEWS</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#accomodation-type-filter" class="collapsed">Accomodation Type</a>
                                    </h4>
                                    <div id="accomodation-type-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">All<small>(722)</small></a></li>
                                                <li><a href="#">Hotel<small>(982)</small></a></li>
                                                <li><a href="#">Resort<small>(127)</small></a></li>
                                                <li class="active"><a href="#">Bed &amp; Breakfast<small>(222)</small></a></li>
                                                <li><a href="#">Condo<small>(158)</small></a></li>
                                                <li><a href="#">Residence<small>(439)</small></a></li>
                                                <li><a href="#">Guest House<small>(52)</small></a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#amenities-filter" class="collapsed">Amenities</a>
                                    </h4>
                                    <div id="amenities-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">Bathroom<small>(722)</small></a></li>
                                                <li><a href="#">Cable tv<small>(982)</small></a></li>
                                                <li class="active"><a href="#">air conditioning<small>(127)</small></a></li>
                                                <li class="active"><a href="#">mini bar<small>(222)</small></a></li>
                                                <li><a href="#">wi - fi<small>(158)</small></a></li>
                                                <li><a href="#">pets allowed<small>(439)</small></a></li>
                                                <li><a href="#">room service<small>(52)</small></a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#language-filter" class="collapsed">Host Language</a>
                                    </h4>
                                    <div id="language-filter" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <ul class="check-square filters-option">
                                                <li><a href="#">English<small>(722)</small></a></li>
                                                <li><a href="#">Español<small>(982)</small></a></li>
                                                <li class="active"><a href="#">Português<small>(127)</small></a></li>
                                                <li class="active"><a href="#">Français<small>(222)</small></a></li>
                                                <li><a href="#">Suomi<small>(158)</small></a></li>
                                                <li><a href="#">Italiano<small>(439)</small></a></li>
                                                <li><a href="#">Sign Language<small>(52)</small></a></li>
                                            </ul>
                                            <a class="button btn-mini">MORE</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label>destination</label>
                                                    <input type="text" class="input-text full-width" placeholder="" value="Paris" />
                                                </div>
                                                <div class="form-group">
                                                    <label>check in</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>check out</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_to" class="input-text full-width" placeholder="mm/dd/yy" />
                                                    </div>
                                                </div>
                                                <br />
                                                <button class="btn-medium icon-check uppercase full-width">search again</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
                            <div class="sort-by-section clearfix">
                                <h4 class="sort-by-title block-sm">Sort results by:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                                    <li class="clearer visible-sms"></li>
                                    <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li>
                                    <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li>
                                </ul>
                                
                                <ul class="swap-tiles clearfix block-sm">
                                    <li class="swap-list">
                                        <a href="hotel-list-view.php"><i class="soap-icon-list"></i></a>
                                    </li>
                                    <li class="swap-grid active">
                                        <a href="hotel-grid-view.php"><i class="soap-icon-grid"></i></a>
                                    </li>
                                    <li class="swap-block">
                                        <a href="hotel-block-view.php"><i class="soap-icon-block"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="hotel-list">
                                <div class="row image-box hotel listing-style1">
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price">
                                                    <small>avg/night</small>
                                                    $620
                                                </span>
                                                <h4 class="box-title">Hotel Hilton<small>Paris france</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">270 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="48.856614, 2.352222">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$120</span>
                                                <h4 class="box-title">Forte Do Vale<small>Albufeira</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">170 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="37.089072, -8.247880">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$322</span>
                                                <h4 class="box-title">Gran Canaria<small>spain</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">485 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="40.463667, -3.749220">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$170</span>
                                                <h4 class="box-title">Roosevelt Hotel<small>New york</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">75 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="40.705631, -73.978003">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price">
                                                    <small>avg/night</small>
                                                    $620
                                                </span>
                                                <h4 class="box-title">Costa Brava<small>Spain</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">423 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="40.463667, -3.749220">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$322</span>
                                                <h4 class="box-title">Ruzzini Palace<small>Venice</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">199 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="40.463667, -3.749220">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$170</span>
                                                <h4 class="box-title">Plaza Tour Eiffel<small>Paris</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">112 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="48.856614, 2.352222">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$620</span>
                                                <h4 class="box-title">Le Ville Del Lido<small>Venice Lido</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">269 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="48.856614, 2.352222">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price">
                                                    <small>avg/night</small>
                                                    $322
                                                </span>
                                                <h4 class="box-title">Park Central<small>New york</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">178 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="40.705631, -73.978003">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$120</span>
                                                <h4 class="box-title">Brisa Sol Hotel<small>Albufeira</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">170 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="37.089072, -8.247880">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$620</span>
                                                <h4 class="box-title">Sultan Gardens<small>Rome</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">578 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="37.089072, -8.247880">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="ajax/slideshow-popup.html" class="hover-effect popup-gallery"><img width="270" height="160" alt="" src="http://placehold.it/270x160"></a>
                                            </figure>
                                            <div class="details">
                                                <span class="price"><small>avg/night</small>$322</span>
                                                <h4 class="box-title">Grand Hotel Dore<small>Disneyland Paris</small></h4>
                                                <div class="feedback">
                                                    <div data-placement="bottom" data-toggle="tooltip" class="five-stars-container" title="4 stars"><span style="width: 80%;" class="five-stars"></span></div>
                                                    <span class="review">280 reviews</span>
                                                </div>
                                                <p class="description">Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massa idporta nequetiam.</p>
                                                <div class="action">
                                                    <a class="button btn-small" href="hotel-detailed.php">SELECT</a>
                                                    <a class="button btn-small yellow popup-map" href="#" data-box="48.856614, 2.352222">VIEW ON MAP</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="uppercase full-width button btn-large">load more listing</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php require 'include/footer.php'; ?>