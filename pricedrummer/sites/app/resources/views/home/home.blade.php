@extends('layouts.app')

@section('content')
    <header>

        </header>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1>home</h1>
                        </div>

                        <div class="panel-body">
                            {{print_r($merchants)}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop