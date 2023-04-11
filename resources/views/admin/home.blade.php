@extends('admin.master')
@section('title') Home @endsection
@section('dashboard') active @endsection

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Mini Sales</a>
        <span class="breadcrumb-item active">Admin Dashboard</span>
        <!-- BASIC MODAL -->

    </nav>
    <div class="sl-pagebody">


    <!-- modal  -->
        <div class="pd-y-30 tx-center bg-gray-700">
            <a href="" class="btn btn-info pd-x-20" data-toggle="modal" data-target="#modaldemo3">Add New User </a>
        </div>
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pd-20" style="width:700px;">
                        <h4 class=" lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary"></a></h4>
                        <form method="POST" action="{{ route('admin.register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div> -->
                   

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                        
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div>

                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div>
    <!-- modal --><!-- modal -->


    </div>


    <!-- sl-pagebody -->
    <div class="row">
        <div class="sl-pagebody col-md-12">
            <div class="card pd-20 pd-sm-40">
                @if(Session::get('message'))
                <p class="text-success pl-1">{{ Session::get('message') }}</p>
                @endif
                <table id="users-table" class="table table-bordered responsive">
                    <thead>
                        <tr>
                            <th>User name</th>
                            <th>Email </th>
                            
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
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.users.data") }}',
        columns: [{
                data: 'name',
                name: 'name'
            },
            
            {
                data: 'email',
                name: 'email'
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