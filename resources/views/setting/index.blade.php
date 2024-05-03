@extends('layouts.master')
@section('title')
    @lang('translation.Datatables')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Supresso
        @endslot
        @slot('title')
            Site Setup
        @endslot
    @endcomponent



    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <form action="{{ route('websetup.store') }}" method="POST">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @csrf

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="addproduct-accordion" class="custom-accordion">
                                    <div class="card">
                                        <a href="#addproduct-billinginfo-collapse" class="text-dark"
                                            data-bs-toggle="collapse" aria-expanded="true"
                                            aria-controls="addproduct-billinginfo-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                01
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Site Info</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="addproduct-billinginfo-collapse" class="collapse show"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Site Name: {{ $site_name }}</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="site_name" value="{{ $site_name }}">
                                                    </div>

                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Site Detail :</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" style="height:150px" name="site_detail" placeholder="">{{ $site_detail }}</textarea>
                                                    </div>

                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Site Type :</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name="site_type">
                                                            {{-- @foreach ($product_collection_models as $product_collection) --}}
                                                            <option value=1>Coffee Shop</option>
                                                            <option value=2>Resto</option>
                                                            <option value=3>Hardware Store</option>
                                                            {{-- @endforeach  --}}
                                                        </select>

                                                    </div>

                                                </div>


                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Site Currency
                                                        :</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name="site_currency" onchange="getformgst()">
                                                            {{-- @foreach ($product_collection_models as $product_collection) --}}
                                                            <option value=1>Rp.</option>
                                                            <option value=2>$</option>
                                                            
                                                            {{-- @endforeach  --}}
                                                        </select>

                                                    </div>

                                                </div>
                                                <div id="getgst"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <a href="#addproduct-img-collapse" class="text-dark collapsed"
                                            data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                            aria-haspopup="true" aria-controls="addproduct-img-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                02
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Site Image</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="addproduct-img-collapse" class="collapse"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">


                                                <div class="input-group hdtuto control-group lst increment">

                                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" type="button"><i
                                                                class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                                    </div>
                                                </div>

                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenames[]" class="myfrm form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-danger" type="button"><i
                                                                    class="fldemo glyphicon glyphicon-remove"></i>
                                                                Remove</button>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <a href="#stripe-payment-gateway-collapse" class="text-dark collapsed"
                                            data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                            aria-haspopup="true" aria-controls="stripe-payment-gateway-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                03
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Stripe Payment Gateway</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="stripe-payment-gateway-collapse" class="collapse"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Stripe Screet Key :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="stripe_screet_key" value="{{ $stripe_screet_key }}"placeholder="">
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Stripe Publishable Key :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="stripe_publishable_key" value="{{ $stripe_publishable_key }}" placeholder="">
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Stripe Webhook Secret :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="stripe_webhook_screet" value="{{ $stripe_webhook_screet }}" placeholder="">
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Domain :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="domain" value="{{ $domain }}" placeholder="">
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Price
                                                        :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" value="{{ $price }}" name="price" placeholder="">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <a href="#paypal-payment-gateway-collapse" class="text-dark collapsed"
                                            data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                            aria-haspopup="true" aria-controls="paypal-payment-gateway-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                04
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Paypal Payment Gateway</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="paypal-payment-gateway-collapse" class="collapse"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                                Under Construction
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <a href="#midtrans-payment-gateway-collapse" class="text-dark collapsed"
                                            data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                            aria-haspopup="true" aria-controls="midtrans-payment-gateway-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                05
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Midtrans Payment Gateway</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="midtrans-payment-gateway-collapse" class="collapse"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                                Under Construction
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>








                    </div>
                </div>
            </div>
            <div class="pull-right">
                {{-- <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a> --}}
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);

            });

            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();

            });

        });
    </script>
    <script>
        function getformgst(){
            document.getElementById("getgst").innerHTML = '<div class="mb-3 row"><label class="col-md-2 col-package-label"> GST:</label><div class="col-md-10"><input class="form-control" type="text" name="gst" value="{{ $gst }}" placeholder=""></div></div>';

        }
    </script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
