@extends('layouts.admin')

@section('title') @stop

@section('meta') @stop

@section('content')
    @include('pages.admin.shared.navigation')

    <div class="container">

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
                <h2>Choose...</h2>
                @if(isset($Customer_details))
                    <form method="post" action="{{route('collect_invoice')}}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="{{$customer_type}}">
                                        <option selected disabled>Please Choose a Merchant Or Retailer</option>
                                        @if(count($Customer_details)>0)
                                            <option value="all">View All</option>
                                        @endif
                                        @foreach($Customer_details as $value)

                                            <option value="{{$value['id']}}">{{$value['name']}}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-daterange">
                                        <input type="text" name="date_from" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                        <div class="input-group-addon">to</div>
                                        <input type="text" name="date_to" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary" value="View Invoices">
                                </div>
                            </div>
                        </div>
                    </form>
                @else

                    <form method="post" action="{{route('collect_invoice_both')}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-daterange">
                                        <input type="text" name="date_from" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                        <div class="input-group-addon">to</div>
                                        <input type="text" name="date_to" value="<?php echo date('Y-m-d');?>" class="form-control date-picker">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary" value="View Invoices">
                                </div>
                            </div>
                        </div>
                    </form>

                @endif

            </div>


        </div>

    </div> <!-- /container -->
@stop

@section('scripts')
    <script>
        $(function () {
            $(".input-daterange").datepicker({
                format: 'yyyy-mm-dd',
                endDate: '0d'
            });
        });
    </script>
@stop