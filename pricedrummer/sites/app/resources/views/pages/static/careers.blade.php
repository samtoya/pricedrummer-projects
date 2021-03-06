@extends('layouts.master')

@section('title') Careers at PriceDrummer @stop

@section('meta')

    <meta name="keywords" content="Careers at PriceDrummer" />
    <meta name="description" content="Careers at PriceDrummer" />
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2 rm-pad">
                <div class="handle_category">
                    <div>@include('pages.static.shared.sidebar')</div>
                </div> <!-- end handle category div -->
            </div> <!-- end col-*-2 div -->

            <div class="col-md-8 col-lg-8" style="margin-top: 10px;">
                <div class="tab-content">
                    <div id="contact" class="tab-pane active fade in">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1 style="font-size: 1.5em; margin-top: 5px; margin-bottom: 0px;">Careers</h1>
                            </div> <!-- end panel heading div -->
                            <div class="panel-body" style="height: 575px;">
                                <p>
                                    We are always looking to recruit the best and the brightest. Become a part of our international team.
                                    <a style="color: #104e84; border-bottom: thin dotted;" href="mailto:career@pricedrummer.com">career@pricedrummer.com</a>
                                </p>
                            </div> <!-- end panel body div -->
                        </div> <!-- end panel div -->
                    </div> <!-- end contact div -->
                </div> <!-- end tab content div -->
            </div> <!-- end col-*-8 div -->

        </div> <!-- end row div -->
    </div> <!-- end container div -->
@stop