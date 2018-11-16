@extends('layouts.admin')

@section('title') @stop

@section('meta') @stop

@section('content')
    @include('pages.admin.shared.navigation')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Please select an option from the dropdown menu</h3>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {

        });
    </script>
@stop