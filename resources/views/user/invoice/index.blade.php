@extends('user.master')
@section('title') Invoices @endsection
<!-- @section('project') active show-sub @endsection -->
@section('invoice') active @endsection

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('user.home') }}">Mini Sales</a>
        <a class="breadcrumb-item" href="{{ url('/invoice') }}">Invoices</a>
    </nav>

    <div class="row">
        <div class="sl-pagebody col-md-12">
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
                <table id="invoice-table" class="table table-bordered responsive">
                    <thead>
                        <tr>
                            <th> Id </th>
                            <th> Created_Date  </th>
                            <th>Customer name</th>
                            <th>Total</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



@push('scripts')
<!-- datatable -->
<script>
    // Initialize DataTable
    $('#invoice-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("user.invoices.data") }}',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'total_amount',
                name: 'total_amount'
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<a href="/user/invoice/' + row.id + '"><i class="fa fa-pencil text-info"></i></a>';
                }
            },

        ]

    });
</script>
<!-- datatable -->
@endpush

@endsection