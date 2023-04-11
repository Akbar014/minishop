@extends('user.master')
@section('title') Home @endsection
@section('dashboard') active @endsection

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Mini Sales</a>
        <span class="breadcrumb-item active">Dashboard</span>
        <!-- BASIC MODAL -->
    
    </nav>
    <div class="sl-pagebody">
       
        <!-- row -->
    </div>

    
    <!-- sl-pagebody -->
    <div class="row">
        <div class="sl-pagebody col-md-12">
        @if(Session::get('error'))
                    <p class="text-success pl-1">{{ Session::get('error') }}</p>
                @endif
        <div class="row row-sm">
                <div class="col-sm-6 col-xl-3">
                    <div class="card pd-20 bg-primary">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Product </h6>
                            <span href="#" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></span>
                        </div>
                        <!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <i class="fa fa-sellsy" style="color: white; font-size: 50px"></i>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$total_product}}</h3>
                        </div>
                    </div>
                    <!-- card -->
                </div>
                
                <div class="col-sm-6 col-xl-3">
                    <div class="card pd-20 bg-success">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total invoices</h6>
                            <span href="#" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></span>
                        </div>
                        <!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <i class="fa fa-sellsy" style="color: white; font-size: 50px"></i>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$invoice}}</h3>
                        </div>
                    </div>
                    <!-- card -->
                </div>
                
                
            </div>
           
        </div>
    </div>
</div>
@endsection