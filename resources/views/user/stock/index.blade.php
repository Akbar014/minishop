@extends('user.master')
@section('title') Stock Report @endsection
@section('stock') active @endsection

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('user.home') }}">Mini Sales</a>
        <a class="breadcrumb-item" href="{{ url('/product') }}">Stock</a>
        <span class="breadcrumb-item active">Stock Details</span>
    </nav>

    <div class="row">
        <div class="sl-pagebody col-md-12">
            <a href="" class="btn btn-info pd-x-20" id="print-button"> Print </a>
            <div class="card pd-20 pd-sm-40 mt-2">
                @if(Session::get('message'))
                <p class="text-success pl-1">{{ Session::get('message') }}</p>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <table id="stocks-table" class="table table-bordered responsive">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Image</th>
                            <th>Quantity Sold</th>
                            <th>Current Stock</th>
                            <th>Purchase price</th>
                            <th>Sales price</th>
                            <th>Current Stock Sales price</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="6" style="text-align:right">Total Current Stock Sales price :</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- datatable -->
<script>
    // Initialize DataTable
    var table = $('#stocks-table').DataTable({
        processing: true,
        serverSide: true,
        footer: true,
        ajax: '{{ route("user.stocks.data") }}',
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'image',
                name: 'image',
                render: function(data, type, full, meta) {
                    return '<img src="{{ asset("images/products") }}/' + data + '" style="max-width: 100px;">';
                }
            },
            {
                data: 'total_quantity_sold',
                name: 'total_quantity_sold'
            },
            {
                data: 'left_quantity',
                name: 'left_quantity'
            },
            {
                data: 'purchase_price',
                name: 'purchase_price'
            },
            {
                data: 'sales_price',
                name: 'sales_price'
            },
            {
                data: 'sales_price',
                name: 'total_sales_price',
                render: function(data, type, full, meta) {
                    var leftQuantity = parseInt(full.left_quantity);
                    var salesPrice = parseFloat(full.sales_price);
                    var totalPrice = leftQuantity * salesPrice;
                    full.sales_price = totalPrice.toFixed(2);
                    return totalPrice.toFixed(2);
                }
            }
        ],
        footerCallback: function(row, data, start, end, display) {
            var api = this.api(),
                data;
            var total = api
                .column(6)
                .data()
                .reduce(function(a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0);

            $(api.column(6).footer()).html(
                '$' + total.toFixed(2)
            );
        }
    });

    $('#print-button').on('click', function() {

        var table = $('#stocks-table')[0];
        var win = window.open('', 'PrintWindow');

        win.document.write('<html><head><title>Table Printout</title>');
        win.document.write('<style type="text/css">');
        win.document.write('@media print {');
        win.document.write('table { margin-top: 50px; }');
        win.document.write('}');
        win.document.write('</style></head><body>');
        win.document.write(table.outerHTML);
        win.document.write('</body></html>');


        win.print();
    });
</script>

<!-- datatable -->

@endpush

@endsection