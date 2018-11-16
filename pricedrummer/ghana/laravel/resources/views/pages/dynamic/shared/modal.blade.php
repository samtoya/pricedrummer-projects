<div class="modal-dialog modal-lg">
    <div class="modal-body" id="modal-body" style="padding: 0px; z-index: 2000;">
        <section>
            <div class="">
                <button ng-click="Close_ShowProductsImages(modalInstance);"
                        class="close" type="button" style="margin: 22px 30px;">×
                </button>

                <ul class="nav nav-tabs nav-pills" style="margin-left: 0; border-top: medium none;">
                    <li class="active">
                        <a style="padding: 23px 32px; z-index: 1000;" aria-expanded="true"
                           data-toggle="tab" target="_self" href="#home" class="style_aheader">Images</a>
                    </li>
                    <li>
                        <a style="padding: 23px 32px" aria-expanded="false"
                           data-toggle="tab" target="_self" href="#menu1" class="style_aheader">Video</a></li>
                </ul>

                <div class="tab-content" style="margin-left: 0px; padding: 15px; height: 400px;">
                    <div id="home" class="tab-pane fade active in">
                        <div class="row" style="height: 400px;">
                            <div style="width:70%; height:auto;">
                                <section class="slider">
                                    <div id="slider" class="flexslider" style="margin-bottom: 10px;">
                                        <ul class="slides">

                                            <li ng-repeat="product_image in product_images"
                                                on-finish-render="ngRepeatFinished">
                                                <img class="SilDImg"
                                                     ng-src="http://www.pricedrummer.com/images/static/product_images/large/@{{product_image.image_id}}.png"/>
                                            </li>

                                        </ul>
                                    </div>
                                    <div id="carousel" class="flexslider"
                                         style="
									width: 390px !important;
									transform: rotate(90deg) !important;
									-ms-transform: rotate(90deg) !important;
									-webkit-transform: rotate(90deg) !important;
									position: absolute !important;
									top: 218px !important;
									left: -113px !important;
									margin: auto !important;
									z-index: 1;">
                                        <ul class="slides">

                                            <li class="FSthumb-li" ng-repeat="product_image in product_images"
                                                on-finish-render="ngRepeatFinished">
                                                <img class="galImg"
                                                     ng-src="http://www.pricedrummer.com/images/static/product_images/thumbs/@{{product_image.image_id}}.png"/>
                                            </li>

                                        </ul>
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>


                    <div id="menu1" class="tab-pane fade">
                        <br>
                        <h3>Product Information</h3>
                        <div class="row" style="padding-left:15px">
                            <center>
                                <span ng-bind-html='VideoLink'></span>
                            </center>
                        </div>
                        <p></p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <br>
                        <h3>Product Reviews</h3>

                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <br>
                        <h3>Local Shops</h3>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <div class="modal-footer" style="height: 100px;">
        <div class="row no-padding" style="display: none;">
            <div class="col-md-3 col-sm-2" ng-repeat="retailer in product_retailers | orderBy:'price' | limitTo:4">
                <img ng-src="http://www.pricedrummer.com/images/static/merchant_images/@{{retailer.merchant_id}}.jpg"
                     style="height: 70px; float:left;">
                <span>@{{retailer.price}}</span>
            </div>
        </div>
    </div>

</div>

