@extends('user.master')
@section('title') Sale @endsection
@section('sale') active @endsection

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Mini Sales</a>
        <span class="breadcrumb-item active">Sale</span>
    </nav>
    <div class="row">
        <div class="sl-pagebody col-md-4">
            <div class="card pd-20 pd-sm-40">
                @if(Session::get('message'))
                <p class="text-success pl-1">{{ Session::get('message') }}</p>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('product', 'Select product to sell :', ['class' => 'form-control-label text-info']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($products as $data)
                    <div class="col-md-6">
                        <div class="card bg-dark mt-2 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <img src="{{asset('images/products/'.$data->image)}}" class="mx-auto mt-3" style="height:100px;width: 100px;cursor: pointer;" title="Click to sell product " onclick="product({{$data->id}} );" alt="">
                                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white mt-2">{{$data->name}}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class=" sl-pagebody col-md-8">
            <div class="card pd-20 pd-sm-40">
                @if(Session::get('delete'))
                <p class="text-success pl-1">{{ Session::get('delete') }}</p>
                @endif
                {!! Form::open(['route' => 'user.sale.store', 'method' => 'POST', 'enctype' => 'multipart/form-data','id' => 'invoiceForm']) !!}
                <div class="row">

                    <div class="d-flex justify-content-left">

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-right ml-auto">

                        {!! link_to('#', 'Add New Customer', ['class' => 'btn btn-info pd-x-20', 'data-toggle' => 'modal', 'data-target' => '#modaldemo3']) !!}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3>Customer Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::select('customer_id', $customers->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Customer', 'onchange' => 'customer();', 'id' => 'getid']) !!}
                                </div>
                            </div>
                            {!! Form::hidden('name', null, ['id' => 'CustomerName']) !!}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'CustomerPhone', 'placeholder' => 'Enter customer phone', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'CustomerAddress', 'placeholder' => 'Customer Address', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-condensed table-striped" id="invoiceItem">
                        <tbody>
                            <tr>
                                <th width="2%">
                                    <div class="custom-control custom-checkbox mb-3">
                                        {!! Form::checkbox('checkAll', null, false, ['class' => 'form-check-input', 'id' => 'checkAll']) !!}
                                    </div>
                                </th>
                                <th width="18%">Name</th>
                                <th width="10%">Quantity</th>
                                <th width="10%">Unit</th>
                                <th width="10%">Price</th>
                                <th width="10%">Total</th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" align="right"><b>Grand Total :</b></td>
                                <td><b>{!! Form::text('total_amount', null, ['class' => 'form-control', 'id' => 'totalAmount', 'autocomplete' => 'off', 'readonly']) !!}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-danger delete" id="removeSelected" type="button">- Delete</button>
                        <button class="btn btn-success" id="saveInvoice" type="button">Save Invoice </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- customer add modal -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Customer</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pd-20" style="width:500px;">
                        <h4 class=" lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary"></a></h4>
                        {!! Form::open(['id' => 'customer-form']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Customer Name:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('name'))

                            <span class="invalid-feedback">{{ $error }}</span>

                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone:') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('phone'))
                            @foreach ($errors->get('phone') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Address:') !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('address'))
                            @foreach ($errors->get('address') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                            @endforeach
                            @endif
                        </div>
                        <div class="form-group">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- customer add modal  -->
    </div>
</div>

@push('scripts')

<!-- add customer -->
<script>
    $('#customer-form').submit(function(e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $.ajax({
            url: '{{ route("user.customer.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                // alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {

                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                $.each(errors, function(key, value) {
                    var input = $('input[name=' + key + ']');
                    var feedback = $('<div class="invalid-feedback">' + value.join('<br>') + '</div>');
                    input.addClass('is-invalid').after(feedback);

                });

                // alert(errorMessage);
            }
        });
    });
</script>
<!-- add customer -->

<!-- customer details -->
<script>
    function customer() {
        var id = document.getElementById('getid').value;

        $.ajax({
            type: "GET",
            url: '{{ route("user.customer.show", ":id") }}'.replace(':id', id),
            contentType: "application/json",
            dataType: "json",

            success: function(res) {
                // console.log(res);          
                document.getElementById('CustomerName').value = res.name;
                document.getElementById('CustomerPhone').value = res.phone;
                document.getElementById('CustomerAddress').value = res.address;
            }
        });





    }
</script>
<!-- customer details -->

<!-- add product to sell -->
<script>
    function product(id) {
        var existingRow = $('#invoiceItem tbody tr[data-product-id="' + id + '"]');

        if (existingRow.length) {
            // If a row already exists for this product, check the quantity in the database and then update the total
            var productId = existingRow.find('.product-id').val();
            var quantityInput = existingRow.find('.quantity');
            var currentQuantity = parseInt(quantityInput.val());

            $.ajax({
                url: '{{ route("user.product.show", ":id") }}'.replace(':id', id),
                method: 'GET',
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    var maxQuantity = res.left_quantity; // Retrieve the maximum quantity allowed from the server response

                    if (currentQuantity >= maxQuantity) {
                        Swal.fire({
                            title: 'Error',
                            text: 'You have reached the maximum quantity allowed for this product.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        var newQuantity = currentQuantity + 1;
                        quantityInput.val(newQuantity).trigger('change'); // Trigger the change event after updating the quantity
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error retrieving product quantity:', textStatus, errorThrown);
                }
            });
        } else {
            $.ajax({
                type: "GET",
                url: '{{ route("user.product.show", ":id") }}'.replace(':id', id),
                contentType: "application/json",
                dataType: "json",
                success: function(res) {
                    // console.log(res);

                    var maxQuantity = res.left_quantity;
                    var selectedQuantity = 1;
                    var newRow = $('<tr>');
                    newRow.attr('data-product-id', res.id);
                    newRow.append($('<td>').html('<input type="checkbox" class="itemRow custom-control custom-checkbox ">'));
                    newRow.append($('<td>').html(res.name));
                    newRow.append($('<td>').html('<input type="number" name="quantity[]" class="form-control quantity" autocomplete="off" value="' + selectedQuantity + '">'));
                    newRow.append($('<td>').html(res.unit));
                    newRow.append($('<td>').html(res.sales_price));
                    newRow.append($('<td>').html('<input type="text" name="total[]" class="form-control total" autocomplete="off" readonly>'));
                    newRow.append($('<input>').attr({
                        'type': 'hidden',
                        'name': 'product_id[]',
                        'value': res.id
                    }));
                    if (maxQuantity == 0) {
                        Swal.fire({
                            title: 'Error',
                            text: 'You have reached the maximum quantity allowed for this product.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        // Append the new row to the table
                        $('#invoiceItem tbody').append(newRow);

                        // Calculate and update the total price for this row when the quantity changes
                        newRow.find('.quantity').on('change', function() {
                            var quantity = $(this).val();
                            var salesPrice = newRow.find('td:eq(4)').html();
                            var totalPrice = quantity * salesPrice;
                            newRow.find('.total').val(totalPrice.toFixed(2));
                           
                            updateGrandTotal();
                            // formData.push({name: 'total', value: totalPrice});
                        }).change(); 
                        
                        updateGrandTotal();
                    }
                }

            });
        }
    }

    function updateGrandTotal() {
        var grandTotal = 0;
        $('.total').each(function() {
            var total = $(this).val();
            if (!isNaN(total)) {
               
                var isChecked = $(this).closest('tr').find('.itemRow').prop('checked');
                if (!isChecked) {
                    grandTotal += parseFloat(total);
                }
            }
        });
        $('#totalAmount').val(grandTotal.toFixed(2));
    }

    $('#removeSelected').click(function() {
        var isChecked = false;

        $('#invoiceItem tbody tr').each(function() {
            if ($(this).find('.itemRow').prop('checked')) {
                $(this).remove();
                isChecked = true;
            }
            updateGrandTotal();
        });

        if (!isChecked) {
            Swal.fire({
                title: 'Error',
                text: 'Please select a row for deleting',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }
    })
</script>
<!-- add product to sell -->

<!-- save invoice  -->
<script>
    function validateForm() {
        // Check if customer and product are selected
        var customerId = document.getElementById("getid").value;
        var tableRows = document.getElementById("invoiceItem").getElementsByTagName("tr");
        if (customerId == "" || tableRows.length <= 1) {
            Swal.fire({
                title: 'Error',
                text: 'Please select Customer and product to create sale',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
            return false;
        }
        return true;
    }

    document.getElementById("saveInvoice").addEventListener("click", function() {
        if (validateForm()) {
            document.getElementById("invoiceForm").submit();
        }
    });
</script>
<!-- save invoice  -->
@endpush
@endsection