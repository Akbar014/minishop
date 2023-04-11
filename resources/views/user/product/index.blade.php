@extends('user.master')
@section('title') Products @endsection
@section('product') active @endsection

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('user.home') }}">Mini Sales</a>
        <a class="breadcrumb-item" href="{{ url('/product') }}">Product</a>
        <!-- <a class="breadcrumb-item" href="{{ url('/projects') }}">All Projects</a> -->
        <span class="breadcrumb-item active">Product Details</span>


    </nav>

    <div class="row">
        <div class="sl-pagebody col-md-12">

            <a href="" class="btn btn-info pd-x-20" data-toggle="modal" data-target="#modaldemo3">Add New Product</a>
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
                <table id="products-table" class="table table-bordered responsive">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Image</th>
                            <th>Purchase price</th>
                            <th>Sales price</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Description</th>
                        </tr>
                    </thead>

                </table>
                
            </div>
        </div>
        <!-- modal -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Product</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {!! Form::open(['id' => 'products-form', 'enctype' => 'multipart/form-data']) !!}
                    <div class="modal-body pd-20" style="width:700px;">
                        <h4 class=" lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary"></a></h4>
                        
                        <div class="form-group">
                            {!! Form::label('name', 'Product Name:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('name'))

                            <span class="invalid-feedback">{{ $error }}</span>

                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description:') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('description'))
                            @foreach ($errors->get('description') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('quantity', 'Quantity:') !!}
                            {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('quantity'))
                            @foreach ($errors->get('quantity') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('unit', 'Unit:') !!}
                            {!! Form::text('unit', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('unit'))

                            <span class="invalid-feedback">{{ $error }}</span>

                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('purchase_price', 'Purchase Price:') !!}
                            {!! Form::text('purchase_price', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('purchase_price'))
                            @foreach ($errors->get('purchase_price') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('sales_price', 'Sales Price:') !!}
                            {!! Form::text('sales_price', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('sales_price'))
                            @foreach ($errors->get('sales_price') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('image', 'Image:') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                            @if ($errors->has('image'))
                            @foreach ($errors->get('image') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        <!-- <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                            
                        </div> -->
                        
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><!-- modal-dialog -->
        </div>

        <!-- modal -->
    </div>




</div>

@push('scripts')
<!-- datatable -->
<script>
    // Initialize DataTable
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("user.products.data") }}',
        columns: [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'image',
                name: 'image',
                render: function(data, type, full, meta) {

                    return '<img src="' + '{{ asset("images/products") }}/' + data + '" style="max-width: 100px;">';
                }
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
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'unit',
                name: 'unit'
            },
            {
                data: 'description',
                name: 'description'
            },
        ]
    });
</script>

<!-- datatable -->
<!-- add product -->
<script>
    $(document).ready(function() {
        $('#products-form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData($(this)[0]);
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $.ajax({
                url: '{{ route("user.product.store") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {

                    // console.log(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';

                    // $.each(errors, function(key, value) {
                    //     errorMessage += value[0] + '\n';

                    // });
                    $.each(errors, function(key, value) {
                        var input = $('input[name=' + key + ']');
                        var feedback = $('<div class="invalid-feedback">' + value.join('<br>') + '</div>');
                        input.addClass('is-invalid').after(feedback);

                    });

                    // alert(errorMessage);
                }
            });
        });
    });
</script>
<!-- add product -->
@endpush

@endsection