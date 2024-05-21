@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="absen">
        <div class="col-12 mb-3">
            <div class="gap-3 d-flex justify-content-center">
                <div class="col col-auto" id="checkin">
                    <a href="{{ route('check.checkin') }}" class="btn btn-outline-success w-100 fw-bold"> Check In</a>
                    {{-- <a href="#" class="btn btn-outline-success w-100 fw-bold"> Check In
                        &nbsp;<i class="uil uil-arrow-from-right"></i></i></a> --}}
                </div>
                <div class="col col-auto" id="checkout">
                    <a href="{{ route('check.checkout') }}" class="btn btn-outline-danger w-100 fw-bold"> Check Out</a>
                    {{-- <a href="#" class="btn btn-outline-danger w-100 fw-bold"> Check Out
                        &nbsp;<i class="uil uil-left-arrow-from-left"></i></i></i></a> --}}
                </div>
            </div>
        </div>
    </div>
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            General
        @endslot
        @slot('title')
            Edit Customers
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



    @if (session()->has('error'))
        <div class="alert alert-warning  alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('sweetalert::alert')

    {!! Form::model($general, ['method' => 'PATCH', 'route' => ['generals.update', $general[0]->id_general]]) !!}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="formrow-nama-input" class="col-md-2 col-form-label">ID Customer</label>
                        <div class="col-md-10">
                            <input type="hidden" name="created_date" value="{{ $general[0]->created_date }}">
                            <input type="hidden" name="created_by" value="{{ $general[0]->created_by }}">
                            @php
                                date_default_timezone_set('Asia/Jakarta');
                            @endphp
                            <input type="hidden" name="update_date" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="update_time" value="{{ date('H:i:s') }}">
                            <input type="text" class="form-control @error('id_customer') border border-danger @enderror"
                                name="id_customer" id="formrow-nama-input"
                                value="{{ old('id_customer', $general[0]->id_customer) }}" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="floatingSelectGrid" class="col-md-2 col-form-label">Type Usaha</label>
                        <div class="col-md-10">
                            <select class="form-select @error('type_usaha') border border-danger @enderror"
                                name="type_usaha" id="floatingSelectGrid" aria-label="Floating label select example">
                                <option value="">-- Pilih Type Usaha --</option>
                                <option value="TK" @if (old('type_usaha') == 'TK') selected="selected" @endif
                                    {{ $general[0]->type_usaha == 'TK' ? 'selected' : '' }}>TK</option>
                                <option value="UD" @if (old('type_usaha') == 'UD') selected="selected" @endif
                                    {{ $general[0]->type_usaha == 'UD' ? 'selected' : '' }}>UD</option>
                                <option value="CV" @if (old('type_usaha') == 'CV') selected="selected" @endif
                                    {{ $general[0]->type_usaha == 'CV' ? 'selected' : '' }}>CV</option>
                                <option value="PT" @if (old('type_usaha') == 'PT') selected="selected" @endif
                                    {{ $general[0]->type_usaha == 'PT' ? 'selected' : '' }}>PT</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-nama-input" class="col-md-2 col-form-label">Nama Usaha</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('nama_usaha') border border-danger @enderror"
                                name="nama_usaha" id="formrow-nama-input"
                                placeholder="Contoh : SUKA CERIA ABADI (*Wajib kapital)"
                                value="{{ old('nama_usaha', $general[0]->nama_usaha) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-nama-input" class="col-md-2 col-form-label">Nama Lengkap</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('nama_lengkap') border border-danger @enderror"
                                name="nama_lengkap" id="formrow-nama-input" placeholder="Contoh : Budi Utomo"
                                value="{{ old('nama_lengkap', $general[0]->nama_lengkap) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-nama-input" class="col-md-2 col-form-label">Jabatan</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('jabatan') border border-danger @enderror"
                                name="jabatan" id="formrow-nama-input" placeholder="Contoh : Pemilik / Owner"
                                value="{{ old('jabatan', $general[0]->jabatan) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-nama-input" class="col-md-2 col-form-label">Alamat Kantor</label>
                        <div class="col-md-10">
                            <input type="text"
                                class="form-control @error('alamat_kantor') border border-danger @enderror"
                                name="alamat_kantor" id="formrow-nama-input" placeholder="Contoh : Pemilik / Owner"
                                value="{{ old('alamat_kantor', $general[0]->alamat_kantor) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-telepon-input" class="col-md-2 col-form-label">Telepon</label>
                        <div class="col-md-10">
                            <input type="Number" class="form-control @error('telepon') border border-danger @enderror"
                                name="telepon" id="formrow-telepon-input" placeholder="Contoh : (031)123456"
                                value="{{ old('telepon', $general[0]->telepon) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-mobile-input" class="col-md-2 col-form-label">Mobile</label>
                        <div class="col-md-10">
                            <input type="Number"
                                class="form-control @error('mobile_phone') border border-danger @enderror"
                                name="mobile_phone" id="formrow-mobile-input" placeholder="Contoh : 081123456789"
                                value="{{ old('mobile_phone', $general[0]->mobile_phone) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-email-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control @error('email') border border-danger @enderror"
                                name="email" id="formrow-email-input" placeholder="Contoh : ceriaabadi@gmail.com"
                                value="{{ old('email', $general[0]->email) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-web-input" class="col-md-2 col-form-label">Website</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('web_site') border border-danger @enderror"
                                name="web_site" id="formrow-web-input" placeholder="Contoh : www.ceriabadi.com"
                                value="{{ old('web_site', $general[0]->web_site) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-nonpwp-input" class="col-md-2 col-form-label">NO NPWP</label>
                        <div class="col-md-10">
                            <input type="Number" class="form-control @error('no_npwp') border border-danger @enderror"
                                name="no_npwp" id="formrow-nonpwp-input" placeholder=an nomor NPWP "
                                value="{{ old('no_npwp', $general[0]->no_npwp) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-namanpwp-input" class="col-md-2 col-form-label">Nama NPWP</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control @error('nama_npwp') border border-danger @enderror"
                                name="nama_npwp" id="formrow-namanpwp-input" placeholder="Masukan nama NPWP"
                                value="{{ old('nama_npwp', $general[0]->nama_npwp) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-alamatnpwp-input" class="col-md-2 col-form-label">Alamat NPWP</label>
                        <div class="col-md-10">
                            <input type="text"
                                class="form-control @error('alamat_npwp') border border-danger @enderror"
                                name="alamat_npwp" id="formrow-alamatnpwp-input" placeholder="Masukan alamat NPWP"
                                value="{{ old('alamat_npwp', $general[0]->alamat_npwp) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-nik-input" class="col-md-2 col-form-label">NIK</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control @error('nik') border border-danger @enderror"
                                name="nik" id="formrow-nik-input" placeholder="Masukan nomor induk kependudukan"
                                value="{{ old('nik', $general[0]->nik) }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-ar-input" class="col-md-2 col-form-label">AR</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="" id="formrow-ar-input"
                                value="{{ $general[0]->name }}" disabled>
                            <input type="hidden" class="form-control" name="ar" id="formrow-ar-input"
                                value="{{ $general[0]->ar }}">
                            <input type="hidden" class="form-control" name="update_by" id="formrow-ar-input"
                                value="{{ Str::ucfirst(Auth::user()->id) }}
                            ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    {!! Form::close() !!}
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
