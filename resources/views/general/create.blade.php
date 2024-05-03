@extends('layouts.master')
@section('title')
    @lang('General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

<style>
    .loading{
        display: none;
    }
</style>

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            General
        @endslot
        @slot('title')
           Buat General Informasi
        @endslot
    @endcomponent

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-warning  alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('sweetalert::alert')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Form General Informasi</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mt-4">
                                {{-- <form action="{{ route('generals.store') }}" method="POST"> --}}
                                    {{-- {!! Form::open(array('route' => 'generals.store','method'=>'POST')) !!} --}}
                                    <form id="create_general" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-xl-6 col-md-12">
                                            @php
                                                date_default_timezone_set('Asia/Jakarta');
                                            @endphp
                                            <input type="hidden" class="form-control" name="created_date" id="created_date" value="{{ date("Y-m-d")}}">
                                            <input type="hidden" class="form-control" name="ar" id="ar" value="{{Str::ucfirst(Auth::user()->id)}}">

                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-Fullname-input"><span style="color: crimson;">*</span> Usaha</label>
                                                <select class="form-select @error('type_usaha') border border-danger @enderror" name="type_usaha" id="floatingSelectGrid type_usaha" aria-label="Floating label select example">
                                                    <option value="">-- Pilih Type Usaha --</option>
                                                    <option value="TK" @if (old('type_usaha') == 'TK') selected="selected" @endif>TK</option>
                                                    <option value="UD" @if (old('type_usaha') == 'UD') selected="selected" @endif>UD</option>
                                                    <option value="CV" @if (old('type_usaha') == 'CV') selected="selected" @endif>CV</option>
                                                    <option value="PT" @if (old('type_usaha') == 'PT') selected="selected" @endif>PT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="alamat_kantor"><span style="color: crimson;">*</span> Alamat Kantor</label>
                                                <input type="text" class="form-control @error('alamat_kantor') border border-danger @enderror" name="alamat_kantor" id="alamat_kantor" placeholder="Contoh : Jl. Sungai Bahari No 5 Pontianak Kalimantan Barat" value="{{ old('alamat_kantor') }}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_usaha"><span style="color: crimson;">*</span> Nama Usaha</label>
                                                <input type="text" class="form-control @error('nama_usaha') border border-danger @enderror" name="nama_usaha" id="nama_usaha" placeholder="Contoh : SUKA CERIA ABADI" value="{{ old('nama_usaha') }}"style="text-transform:uppercase;" >
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_lengkap"><span style="color: crimson;">*</span> Nama Lengkap</label>
                                                <input type="text" class="form-control @error('nama_lengkap') border border-danger @enderror" name="nama_lengkap" id="nama_lengkap" placeholder="Contoh : Budi Utomo" value="{{ old('nama_lengkap') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-email-input"><span style="color: crimson;">*</span> Jabatan</label>
                                                {{-- <input type="text" class="form-control @error('jabatan') border border-danger @enderror" name="jabatan" id="formrow-nama-input" placeholder="Contoh : Pemilik / Owner" value="{{ old('jabatan') }}"> --}}
                                                <input type="text" class="form-control" name="jabatan" id="jabatan" value="Pemilik" readonly>

                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="mobile_phone"><span style="color: crimson;">*</span> Mobile</label>
                                                <input type="Number" class="form-control @error('mobile_phone') border border-danger @enderror" name="mobile_phone" id="mobile_phone" placeholder="Contoh : 081123456789" value="{{ old('mobile_phone') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="telepon">Telepon</label>
                                                <input type="number" class="form-control @error('telepon') border border-danger @enderror" name="telepon" id="telepon" placeholder="Contoh : (031)123456" value="{{ old('telepon') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" class="form-control @error('email') border border-danger @enderror" name="email" id="email" placeholder="Contoh : ceriaabadi@gmail.com" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="web_site">Website</label>
                                                <input type="text" class="form-control @error('web_site') border border-danger @enderror" name="web_site" id="web_site" placeholder="Contoh : www.ceriabadi.com" value="{{ old('web_site') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-password-input">NO NPWP</label>
                                                <input type="Number" class="form-control @error('no_npwp') border border-danger @enderror" name="no_npwp" id="no_npwp" placeholder="Masukan nomor NPWP " value="{{ old('no_npwp') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_npwp">Nama NPWP</label>
                                                <input type="text" class="form-control @error('nama_npwp') border border-danger @enderror" name="nama_npwp" id="nama_npwp" placeholder="Masukan nama NPWP" value="{{ old('nama_npwp') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="alamat_npwp">Alamat NPWP</label>
                                                <input type="text" class="form-control @error('alamat_npwp') border border-danger @enderror" name="alamat_npwp" id="alamat_npwp" placeholder="Masukan alamat NPWP" value="{{ old('alamat_npwp') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="nik">NIK</label>
                                                <input type="number" class="form-control @error('nik') border border-danger @enderror" name="nik" id="nik" placeholder="Masukan nomor induk kependudukan" value="{{ old('nik') }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-password-input">Account Representative</label>
                                                <input type="hidden" class="form-control" name="id_general" id="id_general" value="{{ $id }}">
                                                <input type="text" class="form-control" name="" id="" value="{{Str::ucfirst(Auth::user()->name)}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="color:crimson;">* Wajib diisi</div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center selanjutnya">
                                        <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Selanjutnya</button>
                                        {{-- <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-title">Click
                                            me</button> --}}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center loading">
                                        {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                        <button class="btn btn-primary" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </div>
                                {!! Form::close() !!}
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal pilih tempat penyimpanan --}}
    <div class="modal fade" id="ModalTempatMenyimpan" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Tempat Penyimpanan</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>
                    {{-- <form id="tempat_menyimpan" action="javascript:void(0)" method="POST" accept-charset="utf-8" enctype="multipart/form-data"> --}}
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                        @endphp
                        <div class="row col-xl-12 col-md-12">
                            {{-- <div class="col-xl-6 col-md-6"> --}}
                                <div class="mb-3">
                                    {{-- <label class="form-label">Pilih Tempat Penyimpanan</label> --}}
                                    <select class="form-select tempat" name="tempat" id="floatingSelectGrid" aria-label="Floating label select example">
                                        <option value="0" selected="selected" >-- Pilih Tempat Penyimpanan --</option>
                                        <option value="Server">Server</option>
                                        <option value="Lokal">Lokal</option>
                                    </select>
                                </div>
                            {{-- </div> --}}
                        </div>
                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Export</button>
                        </div> --}}
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            //open modal tempat penyimpanan
            $('#ModalTempatMenyimpan').modal('show');
        });

        // change tempat penyimpanan
        $('.tempat').change(function(){
            let tempat_val = $('.tempat').val();
            // console.log(tempat_val);
            localStorage.setItem('tempat_penyimpanan',tempat_val);
            $('#ModalTempatMenyimpan').modal('hide');
        });

        // proses submit contact person
        $('#create_general').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            Swal.fire({
                icon: 'warning',
                title: 'Cek Data',
                text: 'Pastikan kembali data yang anda masukan sudah sesuai?',
                showCancelButton: !0,
                confirmButtonText: "Ya",
                cancelButtonText: "Cek Kembali",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    // console.log(formData);
                    document.getElementsByClassName('selanjutnya')[0].style.display = "none";
                    document.getElementsByClassName("loading")[0].style.display = "block";

                    var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
                    if (tempat_penyimpanan == "Server") {
                        // console.log("server iki");
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('admin/generals/store') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: (data) => {
                                if ($.isEmptyObject(data.error)) {
                                    // Swal.fire({
                                    //     icon: 'success',
                                    //     title: 'Berhasil ditambahkan. ',
                                    //     text: 'Data General ID '+data.success+' Berhasil ditambahkan.',
                                    //     showConfirmButton: false,
                                    //     timer: 3000
                                    // });

                                    window.location.href = "{{ url('admin/generals/berkas') }}/" + data.success;
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal ditambahkan. ',
                                        text: 'Data General Belum Lengkap.',
                                        showConfirmButton: true,
                                        // timer: 3000
                                    });
                                    document.getElementsByClassName('selanjutnya')[0].style.display = "block";
                                    document.getElementsByClassName("loading")[0].style.display = "none";
                                }
                            }
                        });
                    } else {
                        // console.log("duduk server");
                        let nama_usaha = $('#nama_usaha').val();
                        let id_general = $('#id_general').val();
                        let alamat_kantor = $('#alamat_kantor').val();
                        let nama_lengkap = $('#nama_lengkap').val();
                        let mobile_phone = $('#mobile_phone').val();
                        let email = $('#email').val();
                        let token = $("meta[name='csrf-token']").attr("content");
                        // console.log(nama_usaha)
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('admin/generals/generate_id_customer') }}",
                            data:{
                                "nama_usaha" : nama_usaha,
                                "id_general" : id_general,
                                "alamat_kantor" : alamat_kantor,
                                "nama_lengkap" : nama_lengkap,
                                "mobile_phone" : mobile_phone,
                                "email" : email,
                                "_token": token
                            },
                            cache: false,
                            // contentType: false,
                            // processData: false,
                            success: (data) => {
                                // console.log(data.success);
                                const myGeneral = {
                                    id_general : formData.get("id_general"),
                                    id_customer_draf : data.success,
                                    type_usaha  : formData.get("type_usaha"),
                                    nama_usaha  : formData.get("nama_usaha"),
                                    nama_lengkap    : formData.get("nama_lengkap"),
                                    alamat_kantor   : formData.get("alamat_kantor"),
                                    jabatan : formData.get("jabatan"),
                                    telepon : formData.get("telepon"),
                                    mobile_phone    : formData.get("mobile_phone"),
                                    email   : formData.get("email"),
                                    web_site    : formData.get("web_site"),
                                    no_npwp : formData.get("no_npwp"),
                                    nama_npwp   : formData.get("nama_npwp"),
                                    alamat_npwp : formData.get("alamat_npwp"),
                                    nik : formData.get("nik"),
                                    ar  : formData.get("ar"),
                                    created_date    : formData.get("created_date"),
                                }

                                let daftar_general;
                                if (localStorage.getItem('daftar_general') === null) {
                                    daftar_general = [];
                                } else {
                                    daftar_general = JSON.parse(localStorage.getItem('daftar_general'));
                                }

                                daftar_general.push(myGeneral);
                                localStorage.setItem('daftar_general', JSON.stringify(daftar_general));

                                window.location.href = "{{ url('admin/generals/berkas') }}/" + data.success;
                            }
                        });

                        // window.location.href = "{{ url('admin/generals/berkas') }}/" + data.success;
                    }

                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            });

        });
    </script>
     <!-- Sweet Alerts js -->
     <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

     <!-- Range slider init js-->
     <script src="{{ URL::asset('/assets/js/pages/sweet-alerts.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>

    {{-- <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script> --}}
@endsection
