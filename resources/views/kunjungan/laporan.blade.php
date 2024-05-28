@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            General
        @endslot
        @slot('title')
            Laporan
        @endslot
    @endcomponent

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('sweetalert::alert')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            {{-- <div class="card">
                <div class="card-body">
                    <div class="gap-3 d-flex justify-content-center">
                        <div class="col col-auto" id="checkin">
                            <a href="{{ route('check.checkin', ['id_general' => $general[0]->id_general]) }}"
                                class="btn  @if ($checkin) btn-success disabled @else btn-outline-success @endif  w-100 fw-bold">Check
                                In <i class="uil uil-arrow-from-right"></i></a>
                        </div>
                        <div class="col col-auto" id="checkout">
                            <a href="{{ route('check.checkout', ['id_general' => $general[0]->id_general]) }}"
                                class="btn w-100 fw-bold  @if ($checkout) btn-danger disabled @else btn-outline-danger @endif">
                                Check Out <i class="uil uil-left-arrow-from-left"></i></a>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Form Kunjungan</h3>
                    <div class="row">
                        <div class="col-lg-12">

                            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



                            <div class="mt-4">
                                {{-- <form action="{{ route('generals.store') }}" method="POST"> --}}
                                    {!! Form::open(array('route' => 'laporan.post', 'method' => 'POST', 'files' => true)) !!}
                                {{-- <form id="create_general" method="POST" action="javascript:void(0)" accept-charset="utf-8"
                                    enctype="multipart/form-data"> --}}
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="alamat_kantor">
                                                <span style="color: crimson;">*</span> Laporan</label>
                                            <div class="form-floating">
                                                <textarea name="laporan" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                <label for="floatingTextarea2">Masukan catatan..</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <span style="color: crimson;">*</span> Foto</label>
                                                <div class="foto col-12 d-flex">
                                                    <div class="col-2 col-md-1 p-1"style="align-self: center;">
                                                        <label for="takefoto" class="btn btn-md btn-secondary"><i
                                                                class="uil-camera-plus"></i>
                                                        </label>
                                                        <input id="takefoto" type="file" name="member_image[]"
                                                            onchange="preview_member(event, 0)"
                                                            style="visibility:hidden; width:0;"
                                                            class="output_member member_image">
                                                    </div>
                                                    <div class="col-4 col-md-3 p-1">
                                                        <img src="{{ URL::asset('/assets/images/no-image.jpg') }}"
                                                            class="img-thumbnail mb-4 output_member_img"
                                                            id="output_member0">
                                                    </div>
                                                    <div class="col-5 col-md-3 p-1"style="align-self: center">
                                                        <input type="text" class="form-control namafoto"
                                                            name="namafoto[]" id="namafoto" placeholder="Nama foto">
                                                    </div>
                                                    <div class="col-1 col-md-1 p-1 btn btn-danger btn-block"
                                                        id="remove-member-fieldss" style="align-self:center; opacity:0;">
                                                        <i class="uil-trash"></i>
                                                    </div>
                                                </div>
                                                <div id="team-member-fields"></div>
                                                <button type="button" class="btn btn-dark btn-block mb-3"
                                                    id="add-member-fields">
                                                    <i class="uil-plus-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-email-input">
                                                    <span style="color: crimson;">*</span> GPS</label>
                                                <input type="hidden" class="form-control" name="latitude" id="latitude"
                                                    placeholder="Masukan gps">
                                                <input type="hidden" class="form-control" name="longitude" id="longitude"
                                                    placeholder="Masukan gps">
                                                <iframe id="location" src="about:blank" width="100%" height="500"
                                                    frameborder="0" style="border:0"></iframe>
                                            </div>
                                        </div>

                                        <input type="hidden" name="general_id" value="{{ request()->segment(2) }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                                        </div>


                                        {!! Form::close() !!}
                                        {{-- </form> --}}
                                    </div>
                                {!! Form::close() !!}
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary submit-contact">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
        <script src="{{ URL::asset('/assets/libs/html5-qrcode/html5-qrcode.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $(".btn-success").click(function() {
                    var lsthmtl = $(".clone").html();
                    // console.log(lsthmtl);
                    $(".increment").after(lsthmtl);

                });

                $("body").on("click", ".btn-danger", function() {
                    $(this).parents(".hdtuto").remove();

                });

                $('select').prop('selectedIndex', 0);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // $(".js-select2-multi").select2();

                $(".js-select2-multi").select2();

                handlePermission(this);

            });

            // dinamis tambah foto
            var i = 0;

            function preview_member(event, inp) {
                var reader = new FileReader();
                // console.log("tambah "+inp);
                reader.onload = function() {
                    var output = document.getElementById("output_member" + inp);
                    output.src = reader.result;
                };

                reader.readAsDataURL(event.target.files[0]);
            }

            function preview_member_edit_outlet(event, inp) {
                var reader = new FileReader();
                console.log("tambah edit " + inp);
                reader.onload = function() {
                    var output = document.getElementById("output_member_edit_outlet" + inp);
                    output.src = reader.result;
                };

                reader.readAsDataURL(event.target.files[0]);
            }

            function preview_member_edit_outlet_edit(event, inp) {
                var reader = new FileReader();
                console.log("tambah edit " + inp);
                reader.onload = function() {
                    var output = document.getElementById("output_member_edit_outlet_edit" + inp);
                    output.src = reader.result;
                };

                reader.readAsDataURL(event.target.files[0]);
            }

            // jQuery(document).ready(function($) {
            //fadeout selected item and remove
            // var h = $('#count_foto').val();

            $(document).on("click", "#remove-member-fields", function(event) {
                event.preventDefault();
                $(this)
                    .parent()
                    .fadeOut(300, function() {
                        $(this).remove();
                        return false;
                    });
            });

            $(document).on("click", "#remove-member-fields_edit_outlet", function(event) {
                var idimages = $(this).data("idimages");
                // console.log(idimages);
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/outlet/deleteFoto') }}/" + idimages,
                    success: function(data) {

                    }
                });
                event.preventDefault();
                $(this)
                    .parent()
                    .fadeOut(300, function() {
                        $(this).remove();
                        return false;
                    });
            });

            //add input
            $("#add-member-fields").click(function() {
                i++;
                var rows = `<div class="foto2 d-flex col-12 mb-3">
                                <div class="col-2 col-md-1 p-1"style="align-self:center;">
                                    <label for="takefoto${i}" class="btn btn-md btn-secondary">
                                        <i class="uil-camera-plus"></i>
                                    </label>
                                </div>
                                <div class="col-4 col-md-3 p-1">
                                    <span>
                                        <input id="takefoto${i}" type="file" class="member_image" name="member_image[]" onchange="preview_member(event, ${i})"
                                        style="visibility:hidden; width:0;">
                                    </span>
                                    <img src="{{ URL::asset('/assets/images/no-image.jpg') }}" class="img-thumbnail mb-4 output_member_img" id="output_member${i}">
                                </div>
                                <div class="col-5 col-md-3 p-1"style="align-self: center">
                                    <input type="text" class="form-control namafoto" name="namafoto[]" id="namafoto" placeholder="Nama foto">
                                </div>
                                <div class="btn btn-danger btn-block" id="remove-member-fields" style="align-self:center;">
                                    <i class="uil-trash"></i>
                                </div>
                            </div>`;
                $(rows)
                    .fadeIn("fast")
                    .appendTo("#team-member-fields");
                return false;
            });

            //add update
            var j = 50;
            $("#add_member_fields_edit_outlet").click(function() {
                j++;
                console.log("sesudah " + j);
                var rows = `<div id="foto2_edit_outlet" class="foto2_edit_outlet d-flex justify-content-between mb-3">
                            <div style="align-self:center;"><label for="takefoto${j}" class="btn btn-md btn-secondary"><i class="uil-camera-plus"></i></label></div>
                            <span> <input id="takefoto${j}" type="file" name="member_image_edit_outlet[]" onchange="preview_member_edit_outlet(event, ${j})"
                            style="visibility:hidden; width:0;"></span>
                        <img src="{{ URL::asset('/assets/images/no-image.jpg') }}" class="img-thumbnail output_member_img" id="output_member_edit_outlet${j}">
                        <div style="align-self: center">
                            <input type="text" class="form-control " name="namafoto_edit_outlet[]" id="namafoto_edit_outlet" placeholder="Nama foto">
                        </div>
                        <div class="btn btn-danger btn-block" id="remove-member-fields" style="align-self:center;"><i class="uil-trash"></i></div>
                    </div>`;
                $(rows)
                    .fadeIn("fast")
                    .appendTo("#team_member_fields_edit_outlet");
                return false;
            });

            // get lat and long location
            function handlePermission(geoBtn) {
                navigator.permissions.query({
                    name: 'geolocation'
                }).then(function(result) {
                    if (result.state == 'prompt' || result.state == 'granted') {
                        navigator.geolocation.getCurrentPosition(revealPosition, showErrorLocation);
                    } else {
                        console.log(result.state);
                    }

                    result.onchange = function() {
                        console.log(result.state);
                    }
                });
            }

            function revealPosition(position) {
                var data = position.coords;
                var lat = data.latitude;
                var long = data.longitude;

                // alert("Lat : " + lat + ", Long: " + long );
                // console.log(lat);
                // console.log(long);
                $("#latitude").val(lat);
                $("#longitude").val(long);

                $('#location').attr('src', "https://maps.google.com/maps?q=" + lat + "," + long + "&z=15&output=embed");

            }

            function showErrorLocation(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        var err = "User denied the request for Geolocation."
                        break;
                    case error.POSITION_UNAVAILABLE:
                        var err = "Location information is unavailable."
                        break;
                    case error.TIMEOUT:
                        var err = "The request to get user location timed out."
                        break;
                    case error.UNKNOWN_ERROR:
                        var err = "An unknown error occurred."
                        break;
                }

                console.log(err);
            }


            // show div on error validation
            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        </script>
        <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    @endsection
