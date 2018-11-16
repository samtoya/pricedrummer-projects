@extends('layouts.app')

@section('content')
    <header>

        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1>Welcome to PriceDrummer API.</h1>
                        </div>

                        <div class="panel-body">
                            <ul>
                                @foreach ($api_links as $key => $link )
                                    <li>{{ $key }}: <a href="http://{{ $link }}">{{ $link }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop