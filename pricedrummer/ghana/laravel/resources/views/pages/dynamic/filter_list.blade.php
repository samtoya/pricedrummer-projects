<div id="list" class="tab-pane fade in active">
    <div class="product-list">
        <div class="row">
            <div class="col-md-12">
                @foreach($compare_products as $key => $compare_product)
                {{-- {{ dd($compare_product)}} --}}
                <div class="single-list-product" style="height: 100px;">
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xs-3">
                        <div class="show-img">
                            <a href="{{$compare_product->url}}">
                                {{-- <img src="//placehold.it/350x300" alt="image" title="{{$compare_product->name}}"> --}}
                                <img src="//pricedrummer.com/images/static/product_images/thumbs/{{$compare_product->image}}.png" alt="{{$compare_product->name}}'s image" title="{{$compare_product->name}}">
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-7 col-md-7 col-lg-7 col-xs-7">
                        <div class="prod-list-detail">
                            <div class="prod-info1">
                                @if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 )
                                    <h3 class="pro_name">
                                        <a target="_blank" href="/redirect/{{$compare_product->product_id}}">{{ $compare_product->name }}</a>
                                    </h3>
                                @elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 )
                                    <h3 class="pro_name">
                                        <a href="{{$compare_product->url}}">{{ $compare_product->name }}</a>
                                    </h3>
                                @elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1)
                                    <h3 class="pro_name">
                                        <a href="{{$compare_product->url}}">{{ $compare_product->name }}</a>
                                    </h3>
                                @endif
                                <div class="hidden-md hidden-lg hidden-sm visible-xs">
                                    <span class="pri_range">
                                        {{$country_currency}}{{sprintf("%.2f", $compare_product->min_price)}}
                                    </span>
                                    <span>
                                        {{ $compare_product->prices_count }} {{ str_plural('price', $compare_product->prices_count) }}
                                    </span>
                                </div>
                                <div class="rating">
                                    @for($i=0;$i<=4;$i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-2 hidden-sm hidden-md hidden-lg">
                        @if( $compare_product->prices_count == 1 && $compare_product->isMerchantProduct == 1 )
                            <a class="change_btn_co mobile_button" target="_blank" href="/redirect/{{$compare_product->product_id}}">
                                <span class="btn btn-warning"><i class="fa fa-3x fa-angle-right" aria-hidden="true"></i></span>
                            </a>
                        @elseif( $compare_product->prices_count == 1 && $compare_product->isRetailerProduct == 1 )
                            <a class="change_btn_co mobile_button" href="{{$compare_product->url}}">
                                <span class="btn btn-warning"><i class="fa fa-3x fa-angle-right" aria-hidden="true"></i></span>
                            </a>
                        @elseif( $compare_product->prices_count > 1 && $compare_product->isBothMerchantAndRetailer == 1 || $compare_product->prices_count > 1 && $compare_product->isMerchantProduct == 1 || $compare_product->prices_count > 1 && $compare_product->isRetailerProduct == 1)
                            <a class="change_btn_co mobile_button" href="{{$compare_product->url}}">
                                <span class="btn btn-warning"><i class="fa fa-3x fa-angle-right" aria-hidden="true"></i></span>
                            </a>
                        @endif
                    </div>

                    <div class="hidden-xs hidden-sm hidden-lg hidden-md">
                        <a href="{{$compare_product->url}}"><h3> {{ $compare_product->name }} </h3>
                        </a>
                        <span class="mf-price">
                            {{$country_currency}}{{$compare_product->min_price}}
                        </span>
                        <span>
                                 {{$compare_product->prices_count}} 
                                @if($compare_product->prices_count >1)
                                    {{'Prices'}}
                                @else
                                    {{'Price'}}
                                @endif
                            </span>
                        <div class="mf-rating">
                            <i class="fa fa-star"></i>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3 col-lg-3 hidden-xs">
                        <div class="actions">
                            <div class="actions_aling">
                                <span class="pri_range">
                                {{$country_currency}}{{sprintf("%.2f", $compare_product->min_price)}}
                                </span>
                                <br>
                                <span class="add-to-cart">
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
                                    
                                    <p>
                                        {{$compare_product->prices_count}} 
                                        @if($compare_product->prices_count >1)
                                            {{'Prices'}}
                                        @else
                                            {{'Price'}}
                                        @endif
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div> <!-- end list div -->