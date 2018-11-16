@extends('layouts.admin')

@section('title') @stop

@section('meta') @stop

@section('content')
    @include('pages.admin.shared.navigation')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Invoices</h1>
                <table id="invoices_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <td>Time</td>
                        <td>IP Address</td>
                        <td>Product</td>
                        <td>URL</td>
                        <td>Type</td>
                        <td>Cost</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $total = 0; ?>
                    @foreach( $invoices as $invoice )
                        <tr>
                            <td>{{ $invoice->posted_timestamp }}</td>
                            <td>{{ $invoice->user_ip }}</td>
                            <td><a target="_blank" href="{{ $invoice->compare_url }}">{{ $invoice->product_name }}</a></td>
                            <td>{{ $invoice->item_clicked }}</td>
                            @if ( $invoice->invoice_type == "ITEM_CLICKED" )
                                <td>Cost per click</td>
                            @elseif( $invoice->invoice_type == "BUDGET_SET" )
                                <td>Budget set</td>
                            @endif
                            <td>{{ str_replace('-', '', $invoice->amount) }}</td>
                        </tr>
                        <?php $total = $total + str_replace( '-', '', $invoice->amount ); ?>
                    @endforeach
                    @if( count( $invoices ) > 0 )
                        <tr style="opacity: 0">
                            <td><strong>Total</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$country_currency}}{{ sprintf('%.2f', $total) }}</td>
                        </tr>
                    @endif
                    </tbody>
                    @if( count( $invoices ) > 0 )
                        <tfoot>
                        <td><strong>Total</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$country_currency}}{{ sprintf('%.2f', $total) }}</td>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $('#invoices_list').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
@stop