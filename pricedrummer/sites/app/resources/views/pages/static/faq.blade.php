@extends('layouts.master')

@section('title') Frequently Asked Questions - PriceDrummer @stop

@section('meta')

    <meta name="keywords" content="Compare Prices, PriceRunner UK price comparison engine, compare prices, online product reviews, best product deals, lowest price comparison, online shopping guide. PriceRunner UK " />
    <meta name="description" content="PriceRunner UK. Compare Ghana prices, read user and expert product reviews and use our range of easy price comparison tools to help you find the best and cheapest online shopping deals around at PriceDrummer Ghana" />
    <meta property="og:description" content="Compare and find best prices for everything in Ghana."/>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 rm-pad col-lg-2">
                <div class="handle_category">
                    <div>@include('pages.static.shared.sidebar')</div>
                </div> <!-- end handle category div -->
            </div> <!-- end col-*-2 div -->

            <div class="col-md-8 col-lg-8" style="margin-top: 10px;">
                <div class="tab-content">
                    <div id="contact" class="tab-pane active fade in">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1>Frequently Asked Questions</h1>
                            </div> <!-- end panel heading div -->
                            <div class="panel-body" style="height: 575px;">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" data-target="#collapse1">How Frequently Are Prices Updated?</a></h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <p>Price Information on PriceDrummer are updated once a day. In the future,
                                                    we will update
                                                    price information several times per day to ensure that you see the best
                                                    deals. If you
                                                    find any discrepancy, we will appreciate if you prompt us: <a
                                                            href="mailto:support@pricedrummer.com">support@pricedrummer.com</a>
                                                </p>

                                                <p>Is Shipping/Delivery Cost Included in the Listed Prices?
                                                    Some retailers do offer free delivery for specific products. At this
                                                    point it is
                                                    difficult to separate them from the other products. We are working hard
                                                    to ensure that
                                                    we get this information from retailers. Prices listed in Ghana mostly
                                                    include applicable
                                                    fees and taxes.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-parent="#accordion" data-target="#collapse2" data-toggle="collapse">How Independent Are You?</a></h4>
                                        </div>
                                        <div id="collapse2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>We will ALWAYS list prices in descending order (lowest to highest). That is, best deals
                                                    will be shown when comparing prices. We are not influenced by how much</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-target="#collapse3" data-parent="#accordion"
                                                                       data-toggle="collapse">How Do You Make Money?</a></h4>
                                        </div>
                                        <div id="collapse3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>When you find a product on PriceDrummer and you click through to the retailer site, the
                                                    retailer pay us a small fee. In most cases, we are not paid. We always show the best
                                                    deal first, no matter how much we are paid.</p>

                                                <p>Secondly, some of our associates/clients ask us to promote their products on
                                                    PriceDrummer. These are run as advertising banners on our site. For this, we take a
                                                    small fee.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><a data-target="#collapse4" data-parent="#accordion"
                                                                       data-toggle="collapse">Who Do I Contact?</a></h4>
                                        </div>
                                        <div id="collapse4" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                If you have a product that you have purchased from a retailer shop, we advise that you
                                                contact the retailer directly in case you have any issues with the product. However, if it
                                                is about a specific feature on PriceDrummer, then send a mail to <a
                                                        href="mailto:support@pricedrummer.com">support@pricedrummer.com</a>.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end panel body div -->
                        </div> <!-- end panel div -->
                    </div> <!-- end contact div -->
                </div> <!-- end tab content div -->
            </div> <!-- end col-*-8 div -->

        </div> <!-- end row div -->
    </div> <!-- end container div -->
@stop