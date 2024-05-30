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
            Jadwal
        @endslot
        @slot('title')
            Buat Jadwal Untuk Tanggal 20/02/2021
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
            <div class="card">
                {{-- <div class="card-body">
                    <div class="gap-3 d-flex justify-content-center">
                        <div class="col col-auto" id="checkin">
                            <a href="{{ route('check.checkin', ['id_general' => $general->id]) }}"
                                class="btn  @if ($checkin) btn-success disabled @else btn-outline-success @endif  w-100 fw-bold">Check
                                In <i class="uil uil-arrow-from-right"></i></a>
                        </div>
                        <div class="col col-auto" id="checkout">
                            <a href="{{ route('check.checkout', ['id_general' => $general->id]) }}"
                                class="btn w-100 fw-bold  @if ($checkout) btn-danger disabled @else btn-outline-danger @endif">
                                Check Out <i class="uil uil-left-arrow-from-left"></i></a>
                        </div>
                    </div>
                </div> --}}
            </div>

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
                                {!! Form::open(['route' => 'laporan.post', 'method' => 'POST', 'files' => true]) !!}
                                {{-- <form id="create_general" method="POST" action="javascript:void(0)" accept-charset="utf-8"
                                    enctype="multipart/form-data"> --}}
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="floatingSelectGrid" class="col-form-label">Toko / Customer</label>
                                        <select class="form-select " name="type_usaha" id="floatingSelectGrid"
                                            aria-label="Floating label select example">
                                            <option value="">-- Pilih Customer --</option>
                                            <option value="TK">toko a</option>
                                            <option value="UD">toko b</option>
                                            <option value="CV">toko c</option>
                                            <option value="PT">toko d</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="floatingSelectGrid" class="col-form-label">Type Aktifitas</label>
                                        <select class="form-select " name="type_usaha" id="floatingSelectGrid"
                                            aria-label="Floating label select example">
                                            <option value="">-- Pilih --</option>
                                            <option value="TK">Telepon</option>
                                            <option value="UD">Meeting</option>
                                            <option value="CV">Email</option>
                                            <option value="PT">Visit</option>
                                            <option value="PT">Demo</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label" for="alamat_kantor">Jam Kunjungan</label>
                                        <input type="time" class="form-control" name="jam"
                                            placeholder="Jam Kunjungan">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label" for="alamat_kantor">
                                            </span>Note</label>
                                        <div class="form-floating">
                                            <textarea name="laporan" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                style="height: 100px"></textarea>
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
                                                <div class="col-4 col-md-2 p-1">
                                                    <img src="{{ URL::asset('/assets/images/no-image.jpg') }}"
                                                        class="img-thumbnail mb-4 output_member_img" id="output_member0">
                                                </div>
                                                <div class="col-5 col-md-2 p-1"style="align-self: center">
                                                    <input type="text" class="form-control namafoto" name="namafoto[]"
                                                        id="namafoto" placeholder="Nama foto">
                                                </div>
                                                <div class="col-1 col-md-1 p-1 btn btn-danger btn-block"
                                                    id="remove-member-fieldss" style="align-self:center; opacity:0;">
                                                    <i class="uil-trash"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="general_id" value="{{ request()->segment(2) }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                    {{-- </form> --}}
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary submit-contact">Submit</button>
                                </div>
                                {!! Form::close() !!}
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
