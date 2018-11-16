<div id="grid" class="row tab-pane fade in active">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="margin-left: -15px;">

        <div style="display: none;">
            <div style="text-align: center;"><br/>
                <h1>No Products</h1></div>
        </div>
        @foreach($compare_products as $key => $compare_product)
        <div class="col-sm-6 col-md-4 col-lg-4 col-xs-6">
            <div class="single-product">
                <div class="product-image">
                    <div class="show-img">
                        <a href="{{$compare_product->url}}">
                            <img src="//pricedrummer.com/images/static/product_images/thumbs/{{$compare_product->image}}.png" alt="{{$compare_product->name}}'s image" title="{{$compare_product->name}}"></a>
                    </div> <!-- end show-img div -->
                </div> <!-- end product-image div -->
                <div class="prod-info">
                    @if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 )
                        <h2 class="pro-name">
                            <a target="_blank" href="/redirect/{{$compare_product->product_id}}">{{ $compare_product->name }}</a>
                        </h2>
                    @elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 )
                        <h2 class="pro-name">
                            <a href="{{$compare_product->url}}">{{ $compare_product->name }}</a>
                        </h2>
                    @elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1)
                        <h2 class="pro-name">
                            <a href="{{$compare_product->url}}">{{ $compare_product->name }}</a>
                        </h2>
                    @endif
                    <div class="price-box">
                        <div class="price">
                            <span>
                                {{$country_currency}}{{sprintf("%.2f", $compare_product->min_price)}}
                            </span>
                        </div>
                    </div>
                    <div class="actions">
                        <span class="add-to-cart">
                            <!--If there is only one merchant/retailer then goto store else compare page-->
                            @if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 )
                                <a target="_blank" href="/redirect/{{$compare_product->product_id}}">
                                    <span>Goto Store</span>
                                </a>
                            @elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 )
                                <a href="{{$compare_product->url}}">
                                    <span>Contact Seller</span>
                                </a>
                            @elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1)
                                <a href="{{$compare_product->url}}">
                                    <span>Compare Prices</span>
                                </a>
                            @endif

                        </span>
                        <div class="ret_ail">
                            <span>
                                 {{$compare_product->prices_count}}
                                @if($compare_product->prices_count >1)
                                    {{'Prices'}}
                                @else
                                    {{'Price'}}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="rating">
                        @for($i=0;$i<=4;$i++)
                            <i class="fa fa-star-o"></i>
                        @endfor
                    </div>
                </div> <!-- end prod-info div -->
            </div> <!-- end single-product div -->
        </div> <!-- end col-sm-4 col-md-3 col-lg-3 col-xs-6 div -->
        @endforeach
    </div>


</div> <!-- end grid div -->