@extends('layouts.master')
@section('title')
    @lang('General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/libs/select2/select2.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            General
        @endslot
        @slot('title')
            Atribut {{ $general->type_usaha }} {{ $general->nama_usaha }}
        @endslot
    @endcomponent

    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <style>
        .img-thumbnail {
            width: 150px;
        }

        /* outlet */
        .loading-outlet {
            display: none;
        }

        .loading-update-outlet {
            display: none;
        }

        /* detail distributor */
        .loading-detail-distributor {
            display: none;
        }

        .loading-update-detail-distributor {
            display: none;
        }

        /* legal */
        .loading-legal {
            display: none;
        }

        .loading-update-legal {
            display: none;
        }

        /* contact */
        .loading-contact {
            display: none;
        }

        .loading-update-contact {
            display: none;
        }

        /* account */
        .loading-account {
            display: none;
        }

        .loading-update-account {
            display: none;
        }

        /* attachment */
        .loading-attachment {
            display: none;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="addproduct-accordion" class="custom-accordion">
                                @php
                                    date_default_timezone_set('Asia/Jakarta');
                                @endphp

                                {{-- legal --}}
                                <div class="card">
                                    <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
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
                                                    <h5 class="font-size-16 mb-1">Legal</h5>
                                                    <p class="text-muted text-truncate mb-0">Isi Detail Informasi Dibawah
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="addproduct-billinginfo-collapse" class="collapse show"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-12 mb-3">
                                                    <form id="create_legal" method="POST" action="javascript:void(0)"
                                                        accept-charset="utf-8" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_customer">ID
                                                                        Customer</label>
                                                                    <input type="text" class="form-control"
                                                                        name="id_customer" id="id_customer"
                                                                        value="{{ $general->id_customer }}" readonly>
                                                                    <input type="hidden" class="form-control"
                                                                        name="created_date" id="created_date"
                                                                        value="{{ date('Y-m-d') }}">
                                                                    <input type="hidden" class="form-control"
                                                                        name="ar" id="ar"
                                                                        value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="tahun_berdiri">Tahun
                                                                        Berdiri</label>
                                                                    <input type="number" class="form-control"
                                                                        name="tahun_berdiri" id="tahun_berdiri"
                                                                        placeholder="Contoh: 2013">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="no_siup">NO Siup</label>
                                                                    <input type="number" class="form-control"
                                                                        name="no_siup" id="no_siup"
                                                                        placeholder="Masukan No Siup">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="no_tdp">NO TDP</label>
                                                                    <input type="number" class="form-control"
                                                                        name="no_tdp" id="no_tdp"
                                                                        placeholder="Masukan No TDP">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row col-xl-12 col-md-12">
                                                            <label class="col-package-label"
                                                                for="remarks">Keterangan</label>
                                                            <div class="">
                                                                <textarea class="form-control" style="height:150px" name="remarks" id="remarks" placeholder=""></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row col-12">
                                                            <div class="col-md-4 d-flex">
                                                                <button type="reset"
                                                                    class="btn btn-success me-2">Reset</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary submit-legal">Submit</button>
                                                            </div>

                                                            <div class="col-md-4 loading-legal">
                                                                {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                                <button class="btn btn-primary" type="button" disabled>
                                                                    <span class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"></span>
                                                                    Loading...
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-xl-8 col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="datatable-legal"
                                                            class="table table-striped table-bordered dt-responsive nowrap"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>NO.</th>
                                                                    <th>ID Customer</th>
                                                                    <th>Tahuh Berdiri</th>
                                                                    <th>No SIUP</th>
                                                                    <th>NO TDP</th>
                                                                    <th>Status</th>
                                                                    <th>Keterangan</th>
                                                                    <th>AR</th>
                                                                    <th width="280px">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            {{-- <tbody id="contentLegal"></tbody> --}}
                                                            <tbody>
                                                                @if (count($legal) > 0)
                                                                    <?php $no = 1; ?>
                                                                    @foreach ($legal as $key => $data)
                                                                        <tr>
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>{{ $data->id_customer }}</td>
                                                                            <td>{{ $data->tahun_berdiri }}</td>
                                                                            <td>{{ $data->no_siup }}</td>
                                                                            <td>{{ $data->no_tdp }}</td>
                                                                            <td>{{ $data->status_legal }}</td>
                                                                            <td>{{ $data->remarks_legal }}</td>
                                                                            <td>{{ $data->name }}</td>
                                                                            <td>
                                                                                <button class="btn btn-medium btn-success"
                                                                                    onclick="showLegal({{ $data->id_legal }})">Edit</button>
                                                                                <button class="btn btn-medium btn-danger"
                                                                                    onclick="destroyLegal({{ $data->id_legal }})">Hapus</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    {{-- <tr>
                                                                        <td colspan="8" class="text-center">Data tidak ada...</td>
                                                                    </tr> --}}
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Edit Legal-->
                                <div class="modal fade" id="ModalLegal" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Legal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <div class="alert alert-danger print-error-msg error-legal-edit" style="display:none">
                                                    <ul></ul>
                                                </div> --}}

                                                <form id="update_legal" method="POST" action="javascript:void(0)"
                                                    accept-charset="utf-8" enctype="multipart/form-data">
                                                    {{-- {!! csrf_field() !!} --}}
                                                    @csrf
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tahun_berdiri">ID
                                                                Customer</label>
                                                            <input type="text" class="form-control"
                                                                name="id_customer_edit_legal" id="id_customer_edit_legal"
                                                                value="" readonly>
                                                            <input type="hidden" class="form-control"
                                                                name="id_edit_legal" id="id_edit_legal" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_date_edit_legal"
                                                                id="created_date_edit_legal" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_by_edit_legal" id="created_by_edit_legal"
                                                                value="">
                                                            <input type="hidden" class="form-control"
                                                                name="update_date_edit_legal" id="update_date_edit_legal"
                                                                value="{{ date('Y-m-d') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_time_edit_legal" id="update_time_edit_legal"
                                                                value="{{ date('H:i:s') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_by_edit_legal" id="update_by_edit_legal"
                                                                value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tahun_berdiri">Tahun
                                                                Berdiri</label>
                                                            <input type="text" class="form-control"
                                                                name="tahun_berdiri_edit_legal"
                                                                id="tahun_berdiri_edit_legal" placeholder="Contoh: 2013">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_siup">NO Siup</label>
                                                            <input type="number" class="form-control"
                                                                name="no_siup_edit_legal" id="no_siup_edit_legal"
                                                                placeholder="Masukan No Siup">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_tdp">NO TDP</label>
                                                            <input type="number" class="form-control"
                                                                name="no_tdp_edit_legal" id="no_tdp_edit_legal"
                                                                placeholder="Masukan No TDP">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label" for="remarks">Keterangan</label>
                                                        <div class="">
                                                            <textarea class="form-control" style="height:150px" name="remarks_edit_legal" id="remarks_edit_legal"
                                                                placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Status</label>
                                                        <select class="form-select status" name="status_edit_legal"
                                                            id="status_edit_legal"
                                                            aria-label="Floating label select example">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-md-12 d-flex">
                                                            <button type="button" class="btn btn-success me-2"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary update-legal me-2">Update</button>
                                                            <button class="btn btn-primary loading-update-legal me-2" type="button" disabled>
                                                                <span class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                Loading...
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Contact Person --}}
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
                                                    <h5 class="font-size-16 mb-1">Contact Person</h5>
                                                    <p class="text-muted text-truncate mb-0">Isi Detail Informasi Dibawah
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="addproduct-img-collapse" class="collapse"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-12 mb-3">
                                                    <form id="create_contact_person" method="POST"
                                                        action="javascript:void(0)" accept-charset="utf-8"
                                                        enctype="multipart/form-data">
                                                        {{-- {!! csrf_field() !!} --}}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_customer">ID
                                                                        Customer</label>
                                                                    <input type="text" class="form-control"
                                                                        name="id_customer" id="id_customer"
                                                                        value="{{ $general->id_customer }}" readonly>
                                                                    <input type="hidden" class="form-control"
                                                                        name="created_date" id="created_date"
                                                                        value="{{ date('Y-m-d') }}">
                                                                    <input type="hidden" class="form-control"
                                                                        name="ar" id="ar"
                                                                        value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_outlet">ID
                                                                        Outlet</label>
                                                                    <select class="form-select id_outlet" name="id_outlet"
                                                                        id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="0">-- Pilih ID Outlet --
                                                                        </option>
                                                                        @foreach ($outlet as $data)
                                                                            <option value="{{ $data->id_outlet_custom }}">
                                                                                {{ $data->id_outlet_custom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="nama_lengkap">Nama
                                                                        Lengkap</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_lengkap" id="nama_lengkap"
                                                                        placeholder="Masukan nama lengkap">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="no_telpon">No
                                                                        Telpon</label>
                                                                    <input type="number" class="form-control"
                                                                        name="no_telpon" id="no_telpon"
                                                                        placeholder="Masukan nomor telp">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="email">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        name="email" id="email"
                                                                        placeholder="Masukan email">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="jabatan">Jabatan</label>
                                                                    <select class="form-select jabatan_cont" name="jabatan" id="floatingSelectGrid" aria-label="Floating label select example">
                                                                        <option value="Pemilik" selected="selected">Pemilik</option>
                                                                        <option value="Karyawan">Karyawan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="status">Status</label>
                                                                    <select class="form-select status_contact"
                                                                        name="status" id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="Aktif" selected="selected">Aktif
                                                                        </option>
                                                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row col-12">
                                                                <div class="col-md-4 d-flex">
                                                                    <button type="reset"
                                                                        class="btn btn-success me-2">Reset</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary submit-contact">Submit</button>
                                                                </div>
                                                                <div class="col-md-4 loading-contact">
                                                                    {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                                    <button class="btn btn-primary" type="button"
                                                                        disabled>
                                                                        <span class="spinner-border spinner-border-sm"
                                                                            role="status" aria-hidden="true"></span>
                                                                        Loading...
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-xl-8 col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="datatable-kontak"
                                                            class="table table-striped table-bordered dt-responsive nowrap"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>NO.</th>
                                                                    <th>ID Customer</th>
                                                                    <th>ID Outlet</th>
                                                                    <th>Nama Lengkap</th>
                                                                    <th>No Telpon</th>
                                                                    <th>Email</th>
                                                                    <th>Jabatan</th>
                                                                    <th>Status</th>
                                                                    <th>AR</th>

                                                                    <th width="280px">Aksi</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($contact_person) > 0)
                                                                    <?php $no = 1; ?>
                                                                    @foreach ($contact_person as $key => $data)
                                                                        <tr>
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>{{ $data->id_customer }}</td>
                                                                            <td>{{ $data->id_outlet }}</td>
                                                                            <td>{{ $data->nama_lengkap }}</td>
                                                                            <td>{{ $data->no_telpon }}</td>
                                                                            <td>{{ $data->email_kontak }}</td>
                                                                            <td>{{ $data->jabatan }}</td>
                                                                            <td>{{ $data->status_kontak }}</td>
                                                                            <td>{{ $data->name }}</td>
                                                                            <td>
                                                                                <button class="btn btn-medium btn-success"
                                                                                    onclick="showContact({{ $data->id_contact_person }})">Edit</button>
                                                                                <button class="btn btn-medium btn-danger"
                                                                                    onclick="destroyContactPerson({{ $data->id_contact_person }})">Hapus</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    {{-- <tr>
                                                                        <td colspan="9" class="text-center">Data tidak ada...</td>
                                                                    </tr> --}}
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Modal Kontak-->
                                <div class="modal fade" id="ModalContact" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Kontak</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger print-error-msg error-contact-edit"
                                                    style="display:none">
                                                    <ul></ul>
                                                </div>

                                                <form id="update_contact" method="POST" action="javascript:void(0)"
                                                    accept-charset="utf-8" enctype="multipart/form-data">
                                                    {{-- {!! csrf_field() !!} --}}
                                                    @csrf
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tahun_berdiri">ID
                                                                Customer</label>
                                                            <input type="text" class="form-control"
                                                                name="id_outlet_edit_kontak" id="id_outlet_edit_kontak"
                                                                value="" readonly>
                                                            <input type="hidden" class="form-control"
                                                                name="id_edit_kontak" id="id_edit_kontak" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_date_edit_kontak"
                                                                id="created_date_edit_kontak" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_by_edit_kontak" id="created_by_edit_kontak"
                                                                value="">
                                                            <input type="hidden" class="form-control"
                                                                name="update_date_edit_kontak"
                                                                id="update_date_edit_kontak" value="{{ date('Y-m-d') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_time_edit_kontak"
                                                                id="update_time_edit_kontak" value="{{ date('H:i:s') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_by_edit_kontak" id="update_by_edit_kontak"
                                                                value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Lengkap</label>
                                                            <input type="text" class="form-control"
                                                                name="nama_lengkap_edit_kontak"
                                                                id="nama_lengkap_edit_kontak" placeholder="Contoh: 2013">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">No Telpon</label>
                                                            <input type="number" class="form-control"
                                                                name="no_telpon_edit_kontak" id="no_telpon_edit_kontak"
                                                                placeholder="Masukan No Siup">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_tdp">Email</label>
                                                            <input type="text" class="form-control"
                                                                name="email_edit_kontak" id="email_edit_kontak"
                                                                placeholder="Masukan No TDP">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label" for="remarks">Jabatan</label>
                                                        <div class="">
                                                            <input class="form-control" name="jabatan_edit_kontak"
                                                                id="jabatan_edit_kontak" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Status</label>
                                                        <select class="form-select status" name="status_edit_kontak"
                                                            id="status_edit_kontak"
                                                            aria-label="Floating label select example">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary update-contact">Update</button>
                                                            <button class="btn btn-primary loading-update-contact"
                                                                type="button" disabled>
                                                                <span class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                Loading...
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Outlet --}}
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
                                                    <h5 class="font-size-16 mb-1">Outlet</h5>
                                                    <p class="text-muted text-truncate mb-0">Isi Detail Informasi Dibawah
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="stripe-payment-gateway-collapse" class="collapse"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-xl-5 col-md-12">
                                                    <form id="create_outlet" method="POST" action="javascript:void(0)"
                                                        accept-charset="utf-8" enctype="multipart/form-data">
                                                        {{-- {!! csrf_field() !!} --}}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_customer">ID
                                                                        Customer</label>
                                                                    <input type="text" class="form-control"
                                                                        name="id_customer" id="id_customer"
                                                                        value="{{ $general->id_customer }}" readonly>
                                                                    <input type="hidden" class="form-control"
                                                                        name="created_date" id="created_date"
                                                                        value="{{ date('Y-m-d') }}">
                                                                    <input type="hidden" class="form-control"
                                                                        name="ar" id="ar"
                                                                        value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Nama Outlet</label>
                                                                    <input type="text"
                                                                        class="form-control @error('nama_outlet') border border-danger @enderror"
                                                                        name="nama_outlet" id="nama_outlet" value="{{ $general->nama_usaha }}"
                                                                        placeholder="Masukan nama_outlet">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Type Outlet</label>
                                                                    <select class="form-select outlet_type"
                                                                        name="outlet_type" id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="">-- Pilih Type Outlet --
                                                                        </option>
                                                                        @foreach ($type_outlet as $data)
                                                                            <option value="{{ $data->type_outlet }}">
                                                                                {{ $data->type_outlet }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="address_type">Type
                                                                        Alamat</label>
                                                                    <select class="js-select2-multi address_type"
                                                                        name="address_type[]" id="address_type"
                                                                        multiple="multiple">
                                                                        <option value="Penagihan">Penagihan</option>
                                                                        <option value="Pengiriman">Pengiriman</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="alamat">Alamat</label>
                                                                    <input type="text"
                                                                        class="form-control @error('alamat') border border-danger @enderror"
                                                                        name="alamat" id="alamat"
                                                                        value="{{ $general->alamat_kantor }}"
                                                                        placeholder="Masukan alamat">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="nama_lengkap">Nama
                                                                        Lengkap</label>
                                                                    <input type="text"
                                                                        class="form-control @error('nama_lengkap') border border-danger @enderror"
                                                                        name="nama_lengkap" id="nama_lengkap_cont"
                                                                        value="{{ $general->nama_lengkap }}"
                                                                        placeholder="Masukan nama lengkap">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="no_telpon">No
                                                                        Telpon</label>
                                                                    <input type="number"
                                                                        class="form-control @error('no_telpon') border border-danger @enderror"
                                                                        name="no_telpon" id="no_telpon_cont"
                                                                        value="{{ $general->mobile_phone }}"
                                                                        placeholder="Masukan nomor telp">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="email">Email</label>
                                                                    <input type="email"
                                                                        class="form-control @error('email') border border-danger @enderror"
                                                                        name="email" id="email_cont"
                                                                        value="{{ $general->email }}"
                                                                        placeholder="Masukan email">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="jabatan">Jabatan</label>
                                                                    <select class="form-select jabatan_cont"
                                                                        name="jabatan" id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="Pemilik" selected="selected">
                                                                            Pemilik</option>
                                                                        <option value="Karyawan">Karyawan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="provinsi">Provinsi</label>
                                                                    <select class="form-select provinsi" name="provinsi"
                                                                        id="provinsi"
                                                                        aria-label="Floating label select example">
                                                                        <option value="0" selected=""
                                                                            disabled="">-- Pilih Provinsi --</option>
                                                                        @foreach ($jne_api as $data)
                                                                            <option value="{{ $data->province_name }}">
                                                                                {{ $data->province_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="kota">Kota</label>
                                                                    <input type="hidden" class="form-control" name="area" id="area">
                                                                    <select class="form-select kota" name="kota"
                                                                        id="kota"
                                                                        aria-label="Floating label select example">
                                                                        <option value="">-- Pilih Kota --</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="kecamatan">Kecamatan</label>
                                                                    <select class="form-select kecamatan" name="kecamatan"
                                                                        id="kecamatan"
                                                                        aria-label="Floating label select example">
                                                                        <option value="">-- Pilih Kecamatan --
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="kelurahan">Kelurahan</label>
                                                                    <select class="form-select kelurahan" name="kelurahan"
                                                                        id="kelurahan"
                                                                        aria-label="Floating label select example">
                                                                        <option value="">-- Pilih Kelurahan --
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="kode_pos">Kode
                                                                        Pos</label>
                                                                    <input type="text" class="form-control"
                                                                        name="kode_pos" id="kode_pos"
                                                                        placeholder="Kode Pos akan terisi otomatis"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">GPS</label>
                                                                    <input type="hidden" class="form-control"
                                                                        name="latitude" id="latitude"
                                                                        placeholder="Masukan gps">
                                                                    <input type="hidden" class="form-control"
                                                                        name="longitude" id="longitude"
                                                                        placeholder="Masukan gps">
                                                                    <iframe id="location" src="about:blank"
                                                                        width="100%" height="500" frameborder="0"
                                                                        style="border:0"></iframe>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Foto</label>
                                                                    <div class="foto col-12 d-flex">
                                                                        <div
                                                                            class="col-2 col-md-2 p-1"style="align-self: center;">
                                                                            <label for="takefoto"
                                                                                class="btn btn-md btn-secondary"><i
                                                                                    class="uil-camera-plus"></i>
                                                                            </label>
                                                                            <input id="takefoto" type="file"
                                                                                name="member_image[]"
                                                                                onchange="preview_member(event, 0)"
                                                                                style="visibility:hidden; width:0;"
                                                                                class="output_member member_image">
                                                                        </div>
                                                                        <div class="col-4 col-md-4 p-1">
                                                                            <img src="{{ URL::asset('/assets/images/no-image.jpg') }}"
                                                                                class="img-thumbnail mb-4 output_member_img"
                                                                                id="output_member0">
                                                                        </div>
                                                                        <div
                                                                            class="col-5 col-md-5 p-1"style="align-self: center">
                                                                            <input type="text" class="form-control namafoto"
                                                                                name="namafoto[]" id="namafoto"
                                                                                placeholder="Nama foto">
                                                                        </div>
                                                                        <div class="col-1 col-md-1 p-1 btn btn-danger btn-block"
                                                                            id="remove-member-fieldss"
                                                                            style="align-self:center; opacity:0;">
                                                                            <i class="uil-trash"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div id="team-member-fields"></div>
                                                                    <button type="button"
                                                                        class="btn btn-dark btn-block mb-3"
                                                                        id="add-member-fields">
                                                                        <i class="uil-plus-circle"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Pilih Brand</label>
                                                                    <select class="js-select2-multi brand_outlet"
                                                                        name="brand[]" id="brand_outlet"
                                                                        multiple="multiple">
                                                                        @foreach ($brand as $data)
                                                                            <option value="{{ $data->brand }}">{{ $data->brand }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="aplikasi">Aplikasi</label>
                                                                    <input type="text"
                                                                        class="form-control @error('aplikasi') border border-danger @enderror"
                                                                        name="aplikasi" id="aplikasi"
                                                                        placeholder="Contoh: POS">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="jumlah_pengambilan">Jumlah Pengambilan</label>
                                                                    <input type="text"
                                                                        class="form-control @error('jumlah_pengambilan') border border-danger @enderror"
                                                                        name="jumlah_pengambilan" id="jumlah_pengambilan"
                                                                        placeholder="Contoh: 100 Karton">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Status</label>
                                                                    <select class="form-select status" name="status"
                                                                        id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="Aktif" selected="selected">Aktif
                                                                        </option>
                                                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="remarks">Keterangan</label>
                                                                    <div class="">
                                                                        <textarea class="form-control" style="height:150px" name="remarks" id="remarks_cont"
                                                                            placeholder="Masukan catatan atau informasi produk kompetitor"></textarea>
                                                                        <input type="hidden" class="form-control"
                                                                            name="ar" id="ar"
                                                                            value="{{ Str::ucfirst(Auth::user()->id) }}
                                                                        ">
                                                                        <input type="hidden" name="created_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                        {{-- <input type="text" name="created_by"  value="{{date("H:i:s")}}"> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row col-12">
                                                            <div class="col-md-4 d-flex">
                                                                <button type="reset"
                                                                    class="btn btn-success me-2">Reset</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary submit-outlet">Submit</button>
                                                            </div>
                                                            <div class="col-md-4 loading-outlet">
                                                                {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                                <button class="btn btn-primary" type="button" disabled>
                                                                    <span class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"></span>
                                                                    Loading...
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-xl-7 col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="datatable-outlet"
                                                            class="table table-striped table-bordered dt-responsive nowrap"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>ID Customer</th>
                                                                    <th>ID Outlet</th>
                                                                    <th>Nama Outlet</th>
                                                                    <th>Outlet Type</th>
                                                                    <th>Address Type</th>
                                                                    <th>Area</th>
                                                                    <th>Alamat</th>
                                                                    <th>Provinsi</th>
                                                                    <th>Kota</th>
                                                                    <th>Kecamatan</th>
                                                                    <th>Kelurahan</th>
                                                                    <th>Kode Pos</th>
                                                                    <th>Status</th>
                                                                    <th>Keterangan</th>
                                                                    <th>AR</th>
                                                                    <th width="280px">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($outlet) > 0)
                                                                    <?php $no = 1; ?>
                                                                    @foreach ($outlet as $key => $data)
                                                                        <tr>
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>{{ $data->id_customer }}</td>
                                                                            <td>{{ $data->id_outlet_custom }}</td>
                                                                            <td>{{ $data->nama_outlet }}</td>
                                                                            <td>{{ $data->outlet_type }}</td>
                                                                            <td>{{ $data->address_type }}</td>
                                                                            <td>{{ $data->area }}</td>
                                                                            <td>{{ $data->alamat }}</td>
                                                                            <td>{{ $data->provinsi }}</td>
                                                                            <td>{{ $data->kota }}</td>
                                                                            <td>{{ $data->kecamatan }}</td>
                                                                            <td>{{ $data->kelurahan }}</td>
                                                                            <td>{{ $data->kode_pos }}</td>
                                                                            <td>{{ $data->status }}</td>
                                                                            <td>{{ $data->remarks }}</td>
                                                                            <td>{{ $data->name }}</td>
                                                                            <td>
                                                                                @if ($data->status_generate_qrcode == 0)
                                                                                    <a href="{{ route('generals.generate', $data->id_outlet) }}"
                                                                                        class="btn btn-primary">Generate
                                                                                        Qrcode</a>
                                                                                @else
                                                                                    <button
                                                                                        class="btn btn-medium btn-primary"
                                                                                        disabled>Generate Qrcode</button>
                                                                                @endif
                                                                                <button class="btn btn-medium btn-success"
                                                                                    onclick="showOutlet({{ $data->id_outlet }})">Edit</button>
                                                                                <button class="btn btn-medium btn-danger"
                                                                                    onclick="destroyOutlet({{ $data->id_outlet }})">Hapus</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    {{-- <tr>
                                                                        <td colspan="8" class="text-center">Data tidak ada...</td>
                                                                    </tr> --}}
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Outlet-->
                                <div class="modal fade" id="ModalOutlet" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Outlet</h5>
                                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button> --}}
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger print-error-msg error-outlet-edit"
                                                    style="display:none">
                                                    <ul></ul>
                                                </div>

                                                <form id="update_outlet" method="POST" action="javascript:void(0)"
                                                    accept-charset="utf-8" enctype="multipart/form-data">
                                                    {{-- {!! csrf_field() !!} --}}
                                                    @csrf
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tahun_berdiri">ID
                                                                Customer</label>
                                                            <input type="text" class="form-control"
                                                                name="id_customer_edit_outlet"
                                                                id="id_customer_edit_outlet" value="" readonly>
                                                            <input type="hidden" class="form-control"
                                                                name="id_edit_outlet" id="id_edit_outlet" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="status_generate_qrcode_outlet"
                                                                id="status_generate_qrcode_outlet" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_date_edit_outlet"
                                                                id="created_date_edit_outlet" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_by_edit_outlet" id="created_by_edit_outlet"
                                                                value="">
                                                            <input type="hidden" class="form-control"
                                                                name="update_date_edit_outlet"
                                                                id="update_date_edit_outlet" value="{{ date('Y-m-d') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_time_edit_outlet"
                                                                id="update_time_edit_outlet" value="{{ date('H:i:s') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_by_edit_outlet" id="update_by_edit_outlet"
                                                                value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">ID Outlet</label>
                                                            <input type="text" class="form-control"
                                                                name="id_outlet_edit_outlet" id="id_outlet_edit_outlet"
                                                                placeholder="Contoh: 2013" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="nama_outlet_edit_outlet">Nama Outlet</label>
                                                            <input type="text" class="form-control" name="nama_outlet_edit_outlet" id="nama_outlet_edit_outlet"
                                                                placeholder="Contoh: POS">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-email-input">Type
                                                                Outlet</label>
                                                            <select class="form-select outlet_type_edit_outlet"
                                                                name="outlet_type_edit_outlet" id="floatingSelectGrid"
                                                                aria-label="Floating label select example">
                                                                <option value="">-- Pilih Type Outlet --</option>
                                                                @foreach ($type_outlet as $data)
                                                                    <option value="{{ $data->type_outlet }}">
                                                                        {{ $data->type_outlet }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="address_type_edit_outlet">Type
                                                                Alamat</label>
                                                            <select class="js-select2-multi brand address_type_edit_outlet"
                                                                name="address_type_edit_outlet[]"
                                                                id="address_type_edit_outlet" multiple="multiple">
                                                                <option value="Penagihan">Penagihan</option>
                                                                <option value="Pengiriman">Pengiriman</option>
                                                            </select>
                                                        </div>
                                                        {{-- <div>
                                                            <label id="address_type_edit_outlet1"></label>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="provinsi_edit_outlet">Provinsi</label>
                                                            <select class="form-select provinsi_edit_outlet"
                                                                name="provinsi_edit_outlet" id="provinsi_edit_outlet"
                                                                aria-label="Floating label select example">
                                                                <option value="0" selected="" disabled="">--
                                                                    Pilih Provinsi --</option>
                                                                @foreach ($jne_api as $data)
                                                                    <option value="{{ $data->province_name }}">
                                                                        {{ $data->province_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kota_edit_outlet">Kota</label>
                                                            <input type="hidden" class="form-control" name="area_edit_outlet" id="area_edit_outlet" value="">
                                                            <select class="form-select kota_edit_outlet"
                                                                name="kota_edit_outlet" id="kota_edit_outlet"
                                                                aria-label="Floating label select example">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="kecamatan_edit_outlet">Kecamatan</label>
                                                            <select class="form-select kecamatan_edit_outlet"
                                                                name="kecamatan_edit_outlet" id="kecamatan_edit_outlet"
                                                                aria-label="Floating label select example">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="kelurahan_edit_outlet">Kelurahan</label>
                                                            <select class="form-select kelurahan_edit_outlet"
                                                                name="kelurahan_edit_outlet" id="kelurahan_edit_outlet"
                                                                aria-label="Floating label select example">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="kode_pos_edit_outlet">Kode
                                                                Pos</label>
                                                            <input type="text" class="form-control"
                                                                name="kode_pos_edit_outlet" id="kode_pos_edit_outlet"
                                                                placeholder="Kode Pos akan terisi otomatis" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="formrow-email-input">GPS</label>
                                                            <input type="hidden" class="form-control"
                                                                name="latitude_edit_outlet" id="latitude_edit_outlet">
                                                            <input type="hidden" class="form-control"
                                                                name="longitude_edit_outlet" id="longitude_edit_outlet">
                                                        </div>
                                                        <iframe id="location_edit_outlet" src="about:blank"
                                                            width="100%" height="500" frameborder="0"
                                                            style="border:0"></iframe>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="alamat_edit_outlet">Alamat</label>
                                                            <input type="text" class="form-control"
                                                                name="alamat_edit_outlet" id="alamat_edit_outlet"
                                                                placeholder="Masukan alamat">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="formrow-email-input">Foto</label> <br>
                                                            <label class="form-label" for=""><span
                                                                    style="color: crimson;">*</span>)Foto hanya bisa di
                                                                ubah 1 kali / 1 kali aksi, jika dimungkinkan 2 kali aksi
                                                                maka simpan dahulu dan lakukan edit kembali.</label>
                                                            {{-- <input type="text" class="form-control" name="count_foto" id="count_foto"> --}}
                                                            <div id="team_member_fields_edit_outlet"></div>
                                                            <button type="button" class="btn btn-dark btn-block mb-3" id="add_member_fields_edit_outlet">
                                                                <i class="uil-plus-circle"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-email-input">Pilih
                                                                Brand</label>
                                                            <select class="js-select2-multi brand_outlet_edit_outlet"
                                                                name="brand_edit_outlet[]" id="brand_outlet_edit_outlet"
                                                                multiple="multiple">
                                                                @foreach ($brand as $data)
                                                                    <option value="{{ $data->brand }}">{{ $data->brand }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                    {{-- <div>
                                                            <label id="brand_outlet_edit_outlet1"></label>
                                                        </div> --}}
                                                    {{-- </div> --}}
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="aplikasi_edit_outlet">Aplikasi</label>
                                                            <input type="text" class="form-control"
                                                                name="aplikasi_edit_outlet" id="aplikasi_edit_outlet"
                                                                placeholder="Contoh: POS">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="jumlah_pengambilan_edit_outlet">Jumlah Pengambilan</label>
                                                            <input type="text" class="form-control"
                                                                name="jumlah_pengambilan_edit_outlet" id="jumlah_pengambilan_edit_outlet"
                                                                placeholder="Contoh: 100 Karton">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="formrow-email-input">Status</label>
                                                            <select class="form-select status_outlet_edit_outlet"
                                                                name="status_outlet_edit_outlet" id="floatingSelectGrid"
                                                                aria-label="Floating label select example">
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="remarks">Keterangan</label>
                                                            <div class="">
                                                                <textarea class="form-control" style="height:150px" name="remarks_edit_outlet" id="remarks_edit_outlet"
                                                                    placeholder="Masukan catatan atau informasi produk kompetitor"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-success"
                                                                data-bs-dismiss="modal"
                                                                onclick="closeModalOutlet()">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary update-outlet">Update</button>
                                                            <button class="btn btn-primary loading-update-outlet"
                                                                type="button" disabled>
                                                                <span class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                Loading...
                                                            </button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Detail Distributor --}}
                                <div class="card">
                                    <a href="#adddistributor-img-collapse" class="text-dark collapsed"
                                        data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                        aria-haspopup="true" aria-controls="adddistributor-img-collapse">
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
                                                    <h5 class="font-size-16 mb-1">Detail Distributor</h5>
                                                    <p class="text-muted text-truncate mb-0">Isi Detail Informasi Dibawah
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="adddistributor-img-collapse" class="collapse"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-12 mb-3">
                                                    <form id="create_detail_distributor" method="POST"
                                                        action="javascript:void(0)" accept-charset="utf-8"
                                                        enctype="multipart/form-data">
                                                        {{-- {!! csrf_field() !!} --}}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_customer">ID
                                                                        Customer</label>
                                                                    <input type="text" class="form-control"
                                                                        name="id_customer" id="id_customer"
                                                                        value="{{ $general->id_customer }}" readonly>
                                                                    <input type="hidden" class="form-control"
                                                                        name="created_date" id="created_date"
                                                                        value="{{ date('Y-m-d') }}">
                                                                    <input type="hidden" class="form-control"
                                                                        name="ar" id="ar"
                                                                        value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_outlet">ID
                                                                        Outlet</label>
                                                                    <select class="form-select id_outlet"
                                                                        name="id_outlet" id="id_outlet_distributor"
                                                                        aria-label="Floating label select example">
                                                                        {{-- <option value="0">-- Pilih ID Outlet --
                                                                        </option>
                                                                        @foreach ($outlet as $data)
                                                                            <option value="{{ $data->id_outlet_custom }}">
                                                                                {{ $data->id_outlet_custom }} | {{$data->nama_outlet}}</option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_distributor">ID
                                                                        Distributor</label>
                                                                    <select class="form-select id_distributor"
                                                                        name="id_distributor" id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="0">-- Pilih ID Distributor --
                                                                        </option>
                                                                        @foreach ($distributor as $data)
                                                                            <option value="{{ $data->id_cust }}">
                                                                                {{ $data->id_cust }} |
                                                                                {{ $data->nama_cust }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Pilih Brand</label>
                                                                    <select class="js-select2-multi brand_outlet"
                                                                        name="brand[]" id="brand_outlet"
                                                                        multiple="multiple">
                                                                        @foreach ($brand as $data)
                                                                            <option value="{{ $data->brand }}">
                                                                                {{ $data->brand }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12 col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Status</label>
                                                                    <select class="form-select status_detail_distributor"
                                                                        name="status_detail_distributor"
                                                                        id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="Aktif" selected="selected">Aktif
                                                                        </option>
                                                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row col-12">
                                                                <div class="col-md-4 d-flex">
                                                                    <button type="reset"
                                                                        class="btn btn-success me-2">Reset</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary submit-detail-distributor">Submit</button>
                                                                </div>
                                                                <div class="col-md-4 loading-detail-distributor">
                                                                    {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                                    <button class="btn btn-primary" type="button"
                                                                        disabled>
                                                                        <span class="spinner-border spinner-border-sm"
                                                                            role="status" aria-hidden="true"></span>
                                                                        Loading...
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-xl-8 col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="datatable-detail-distributor"
                                                            class="table table-striped table-bordered dt-responsive nowrap"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>NO.</th>
                                                                    <th>ID Outlet</th>
                                                                    <th>ID Distributor</th>
                                                                    <th>Nama Distributor</th>
                                                                    <th>Brand</th>
                                                                    <th>Status</th>
                                                                    <th>AR</th>

                                                                    <th width="280px">Aksi</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($detail_distributor) > 0)
                                                                    <?php $no = 1; ?>
                                                                    @foreach ($detail_distributor as $key => $data)
                                                                        <tr>
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>{{ $data->id_outlet }}</td>
                                                                            <td>{{ $data->id_customers }}</td>
                                                                            <td>{{ $data->nama_customer }}</td>
                                                                            <td>{{ $data->brand }}</td>
                                                                            <td>{{ $data->status }}</td>
                                                                            <td>{{ $data->name }}</td>
                                                                            <td>
                                                                                <button class="btn btn-medium btn-success"
                                                                                    onclick="showDetailDistributor({{ $data->id_detail_distributor }})">Edit</button>
                                                                                <button class="btn btn-medium btn-danger"
                                                                                    onclick="destroyDetailDistributor({{ $data->id_detail_distributor }})">Hapus</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    {{-- <tr>
                                                                        <td colspan="9" class="text-center">Data tidak ada...</td>
                                                                    </tr> --}}
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Detail Distributor-->
                                <div class="modal fade" id="ModalDetailDistributor" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Detail Distributor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger print-error-msg error-detail-distributor-edit"
                                                    style="display:none">
                                                    <ul></ul>
                                                </div>

                                                <form id="update_detail_distributor" method="POST"
                                                    action="javascript:void(0)" accept-charset="utf-8"
                                                    enctype="multipart/form-data">
                                                    {{-- {!! csrf_field() !!} --}}
                                                    @csrf
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            {{-- <label class="form-label" for="">ID
                                                                Customer</label>
                                                            <input type="text" class="form-control"
                                                                name="id_customer_edit_detail_distributor" id="id_customer_edit_detail_distributor"
                                                                value="" readonly> --}}
                                                            <input type="hidden" class="form-control"
                                                                name="id_edit_detail_distributor"
                                                                id="id_edit_detail_distributor" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_date_edit_detail_distributor"
                                                                id="created_date_edit_detail_distributor"
                                                                value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_by_edit_detail_distributor"
                                                                id="created_by_edit_detail_distributor" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="update_date_edit_detail_distributor"
                                                                id="update_date_edit_detail_distributor"
                                                                value="{{ date('Y-m-d') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_time_edit_detail_distributor"
                                                                id="update_time_edit_detail_distributor"
                                                                value="{{ date('H:i:s') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_by_edit_detail_distributor"
                                                                id="update_by_edit_detail_distributor"
                                                                value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="">ID
                                                                Outlet</label>
                                                            <input type="text" class="form-control"
                                                                name="id_outlet_edit_detail_distributor"
                                                                id="id_outlet_edit_detail_distributor" value=""
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-email-input">ID
                                                                Distributor</label>
                                                            <select
                                                                class="form-select id_distributor_edit_detail_distributor"
                                                                name="id_distributor_edit_detail_distributor"
                                                                id="floatingSelectGrid"
                                                                aria-label="Floating label select example">
                                                                <option value="">-- Pilih ID Distributor --</option>
                                                                @foreach ($distributor as $data)
                                                                    <option value="{{ $data->id_cust }}">
                                                                        {{ $data->id_cust }} | {{ $data->nama_cust }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-email-input">Pilih
                                                                Brand</label>
                                                            <select
                                                                class="js-select2-multi brand_detail_distributor_edit_detail_distributor"
                                                                name="brand_detail_distributor_edit_detail_distributor[]"
                                                                id="brand_detail_distributor_edit_detail_distributor"
                                                                multiple="multiple">
                                                                @foreach ($brand as $data)
                                                                    <option value="{{ $data->brand }}">
                                                                        {{ $data->brand }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Status</label>
                                                        <select class="form-select status"
                                                            name="status_edit_detail_distributor"
                                                            id="status_edit_detail_distributor"
                                                            aria-label="Floating label select example">
                                                            <option value="Aktif">Aktif</option>
                                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-md-12 d-flex">
                                                            <button type="button" class="btn btn-success me-2"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary me-2 update-detail-distributor">Update</button>
                                                            <button
                                                                class="btn btn-primary  loading-update-detail-distributor"
                                                                type="button" disabled>
                                                                <span class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                Loading...
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Account --}}
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
                                                            05
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Account</h5>
                                                    <p class="text-muted text-truncate mb-0">Isi Detail Informasi Dibawah
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>
                                        </div>
                                    </a>

                                    <div id="paypal-payment-gateway-collapse" class="collapse"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-12 mb-3">
                                                    <form id="create_account" method="POST"
                                                        action="javascript:void(0)" accept-charset="utf-8"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_customer">ID
                                                                        Customer</label>
                                                                    <input type="text" class="form-control"
                                                                        name="id_customer" id="id_customer"
                                                                        value="{{ $general->id_customer }}" readonly>
                                                                    <input type="hidden" class="form-control"
                                                                        name="created_date" id="created_date"
                                                                        value="{{ date('Y-m-d') }}">
                                                                    <input type="hidden" class="form-control"
                                                                        name="ar" id="ar"
                                                                        value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="payment_trems">Syarat
                                                                        Pembayaran
                                                                    </label>
                                                                    <input type="number" class="form-control"
                                                                        name="payment_trems" id="payment_trems"
                                                                        placeholder="Ex: 30 Hari">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="id_price">ID
                                                                        Harga</label>
                                                                    <input type="text" class="form-control"
                                                                        name="id_price" id="id_price"
                                                                        placeholder="ID Price">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="credit_limit">Kredit
                                                                        Limit</label>
                                                                    <input type="number" class="form-control"
                                                                        name="credit_limit" id="credit_limit"
                                                                        placeholder="Ex: 1.000.000">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="max_nota">Maks
                                                                        Nota</label>
                                                                    <input type="text" class="form-control"
                                                                        name="max_nota" id="max_nota"
                                                                        placeholder="Ex: 200.000">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Bank</label>
                                                                    <select class="form-select bank" name="bank"
                                                                        id="floatingSelectGrid"
                                                                        aria-label="Floating label select example">
                                                                        <option value="">-- Pilih Bank --</option>
                                                                        @foreach ($bank as $data)
                                                                            <option value="{{ $data->bank }}">
                                                                                {{ $data->bank }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="atas_nama">Atas
                                                                        Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        name="atas_nama" id="atas_nama"
                                                                        placeholder="Ex: David Silva">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="no_rek">Akun</label>
                                                                    <input type="number" class="form-control"
                                                                        name="no_rek" id="no_rek"
                                                                        placeholder="Ex: 1.000.000">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="cabang">Cabang</label>
                                                                    <input type="text" class="form-control"
                                                                        name="cabang" id="cabang"
                                                                        placeholder="Ex: Jl Said Anwar">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="formrow-email-input">Status</label>
                                                                    <select class="form-select status_account"
                                                                        id="floatingSelectGrid" name="status_account"
                                                                        aria-label="Floating label select example">
                                                                        <option value="Aktif" selected>Aktif</option>
                                                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="remarks_account">Keterangan</label>
                                                                    <div class="">
                                                                        <textarea class="form-control" style="height:150px" name="remarks_account" id="remarks_account"
                                                                            placeholder=""></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row col-12">
                                                                <div class="col-md-4 d-flex">
                                                                    <button type="reset"
                                                                        class="btn btn-success me-2">Reset</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary submit-account">Submit</button>
                                                                </div>

                                                                <div class="col-md-4 loading-account">
                                                                    {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                                    <button class="btn btn-primary" type="button"
                                                                        disabled>
                                                                        <span class="spinner-border spinner-border-sm"
                                                                            role="status" aria-hidden="true"></span>
                                                                        Loading...
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-xl-8 col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="datatable-akun"
                                                            class="table table-striped table-bordered dt-responsive nowrap"
                                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>NO.</th>
                                                                    <th>ID Customer</th>
                                                                    <th>Syarat Pembayaran</th>
                                                                    <th>ID Harga</th>
                                                                    <th>Kredit Limit</th>
                                                                    <th>Maks Nota</th>
                                                                    <th>Bank</th>
                                                                    <th>Atas Nama</th>
                                                                    <th>Akun</th>
                                                                    <th>Cabang</th>
                                                                    <th>Status</th>
                                                                    <th>Keterangan</th>
                                                                    <th>AR</th>

                                                                    <th width="280px">Aksi</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($account) > 0)
                                                                    <?php $no = 1; ?>
                                                                    @foreach ($account as $key => $data)
                                                                        <tr>
                                                                            <td>{{ $no++ }}</td>
                                                                            <td>{{ $data->id_customer }}</td>
                                                                            <td>{{ $data->payment_trems }}</td>
                                                                            <td>{{ $data->id_price }}</td>
                                                                            <td>Rp.
                                                                                {{ number_format($data->credit_limit, 2, ',', '.') }}
                                                                            </td>
                                                                            <td>Rp.
                                                                                {{ number_format($data->max_nota, 2, ',', '.') }}
                                                                            </td>
                                                                            <td>{{ $data->bank }}</td>
                                                                            <td>{{ $data->atas_nama }}</td>
                                                                            <td>{{ $data->no_rek }}</td>
                                                                            <td>{{ $data->cabang }}</td>
                                                                            <td>{{ $data->status }}</td>
                                                                            <td>{{ $data->remarks }}</td>
                                                                            <td>{{ $data->name }}</td>
                                                                            <td>
                                                                                <button class="btn btn-medium btn-success"
                                                                                    onclick="showAkun({{ $data->id_account }})">Edit</button>
                                                                                <button class="btn btn-medium btn-danger"
                                                                                    onclick="destroyAkun({{ $data->id_account }})">Hapus</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    {{-- <tr>
                                                                        <td colspan="8" class="text-center">Data tidak ada...</td>
                                                                    </tr> --}}
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Akun --}}
                                <div class="modal fade" id="ModalAkun" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Akun</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger print-error-msg error-akun-edit"
                                                    style="display:none">
                                                    <ul></ul>
                                                </div>

                                                <form id="update_akun" method="POST" action="javascript:void(0)"
                                                    accept-charset="utf-8" enctype="multipart/form-data">
                                                    {{-- {!! csrf_field() !!} --}}
                                                    @csrf
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="tahun_berdiri">ID
                                                                Customer</label>
                                                            <input type="text" class="form-control"
                                                                name="id_customer_edit_akun" id="id_customer_edit_akun"
                                                                value="" readonly>
                                                            <input type="hidden" class="form-control"
                                                                name="id_edit_akun" id="id_edit_akun" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_date_edit_akun"
                                                                id="created_date_edit_akun" value="">
                                                            <input type="hidden" class="form-control"
                                                                name="created_by_edit_akun" id="created_by_edit_akun"
                                                                value="">
                                                            <input type="hidden" class="form-control"
                                                                name="update_date_edit_akun" id="update_date_edit_akun"
                                                                value="{{ date('Y-m-d') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_time_edit_akun" id="update_time_edit_akun"
                                                                value="{{ date('H:i:s') }}">
                                                            <input type="hidden" class="form-control"
                                                                name="update_by_edit_akun" id="update_by_edit_akun"
                                                                value="{{ Str::ucfirst(Auth::user()->id) }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Syarat
                                                                Pembayaran
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                name="syaratpem_edit_akun" id="syaratpem_edit_akun"
                                                                placeholder="Ex: 30 Hari">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_siup">ID Harga</label>
                                                            <input type="number" class="form-control"
                                                                name="idharga_edit_akun" id="idharga_edit_akun"
                                                                placeholder="id harga">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="no_tdp">Kredit
                                                                Limit</label>
                                                            <input type="number" class="form-control"
                                                                name="kreditlimit_edit_akun" id="kreditlimit_edit_akun"
                                                                placeholder="Ex:1.000.000">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label" for="remarks">Maks
                                                            Nota</label>
                                                        <div class="">
                                                            <input class="form-control" name="MaksNota_edit_akun"
                                                                id="MaksNota_edit_akun" placeholder="Ex:200.000">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Bank</label>
                                                        <div class="">
                                                            <select class="form-select bank" name="bank_edit_akun"
                                                                id="bank_edit_akun"
                                                                aria-label="Floating label select example">
                                                                <option value="">-- Pilih Bank --</option>
                                                                @foreach ($bank as $data)
                                                                    <option value="{{ $data->bank }}">
                                                                        {{ $data->bank }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Atas Nama</label>
                                                        <div class="">
                                                            <input class="form-control" name="atas_nama_edit_akun"
                                                                id="atas_nama_edit_akun" placeholder="Ex:David">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Akun</label>
                                                        <div class="">
                                                            <input class="form-control" name="akun_edit_akun"
                                                                id="akun_edit_akun" placeholder="Ex:1.200.000">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Cabang</label>
                                                        <div class="">
                                                            <input class="form-control" name="cabang_edit_akun"
                                                                id="cabang_edit_akun" placeholder="Ex:200.000">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Status</label>
                                                        <div class="">
                                                            <select class="form-select status_account" id="statusakun"
                                                                name="status_edit_akun"
                                                                aria-label="Floating label select example">
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-12">
                                                        <label class="col-package-label">Keterangan</label>
                                                        <div class="">
                                                            <textarea class="form-control" style="height:150px" name="remarks_edit_akun" id="remarks_edit_akun"
                                                                placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="row col-12">
                                                            <div class="col-md-4">
                                                                <button type="button" class="btn btn-success"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                            <div class="col-md-4 update-account">
                                                                {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                            <div class="col-md-4 loading-update-account">
                                                                {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                                <button class="btn btn-primary" type="button" disabled>
                                                                    <span class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"></span>
                                                                    Loading...
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Attachment --}}
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
                                                            06
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Lampiran</h5>
                                                    <p class="text-muted text-truncate mb-0">Isi Detail Informasi Dibawah
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>
                                        </div>
                                    </a>

                                    <div id="midtrans-payment-gateway-collapse" class="collapse"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <form id="create_attachment" method="POST" action="javascript:void(0)"
                                                accept-charset="utf-8" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="id_customer">ID Customer</label>
                                                        <input type="text" class="form-control" name="id_customer"
                                                            id="id_customer" value="{{ $general->id_customer }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="input-group control-group lst increment">
                                                    {{-- <input type="file" id="filenames" name="filenames[]" class="myfrm form-control"> --}}
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" type="button"><i
                                                                class="fldemo glyphicon glyphicon-plus"></i>Tambah
                                                            Lampiran</button>
                                                    </div>
                                                </div>
                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenames[]" id="filenames"
                                                            multiple class="myfrm form-control filenames">
                                                        <div class="input-group-btn me-3">
                                                            <button class="btn btn-danger" type="button"><i
                                                                    class="fldemo glyphicon glyphicon-remove"></i>
                                                                Hapus</button>
                                                        </div>
                                                        <div style="align-self: center">
                                                            <input type="text" class="form-control namaFile"
                                                                name="namaFile[]" id="namaFile"
                                                                placeholder="Nama File">
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- tes upload file --}}
                                                {{-- <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenames" id="filenames"
                                                            class="myfrm form-control">
                                                        <div class="input-group-btn me-3">
                                                            <button class="btn btn-danger" type="button"><i
                                                                    class="fldemo glyphicon glyphicon-remove"></i>
                                                                Hapus</button>
                                                        </div>
                                                        <div style="align-self: center">
                                                            <input type="text" class="form-control "
                                                                name="namaFile" id="namafile"
                                                                placeholder="Nama File">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                {{-- end --}}

                                                <input type="hidden" class="form-control" name="created_date"
                                                    id="created_date" value="{{ date('Y-m-d') }}">
                                                <input type="hidden" class="form-control" name="ar"
                                                    id="ar" value="{{ Auth::user()->id }}">
                                                <div class="col-12 mt-3">
                                                    {{-- <button type="reset" class="btn btn-success">Reset</button> --}}
                                                    <div class="row col-12">
                                                        <div class="col-md-6 submit-attachment">
                                                            {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                        <div class="col-md-6 loading-attachment">
                                                            {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                                            <button class="btn btn-primary" type="button" disabled>
                                                                <span class="spinner-border spinner-border-sm"
                                                                    role="status" aria-hidden="true"></span>
                                                                Loading...
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
            <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a>
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
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>
                    <div class="row col-xl-12 col-md-12">
                        <div class="mb-3">
                            <select class="form-select tempat" name="tempat" id="floatingSelectGrid" aria-label="Floating label select example">
                                <option value="0" selected="selected" >-- Pilih Tempat Penyimpanan --</option>
                                <option value="Server">Server</option>
                                <option value="Lokal">Lokal</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ModalTempatMenyimpan').modal('show');
            $('#datatable-legal').DataTable();
            $('#datatable-kontak').DataTable();
            $('#datatable-outlet').DataTable();
            $('#datatable-detail-distributor').DataTable();
            $('#datatable-akun').DataTable();

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

            var id_customer = $('#id_customer').val();
            var dataOutlet = JSON.parse(localStorage.getItem('daftar_outlet'))
            // console.log(id_customer);
            if (dataOutlet) {
                $.get("{{ url('admin/outlet/get_distributor_draft_id') }}/" + id_customer, function(data) {
                    //  console.log(data);
                    $('#id_outlet_distributor').html(data);
                    // $('#kecamatan').prop('selectedIndex', 0);
                });
            } else {
                var id_customer = $('#id_customer').val();
                $.get("{{ url('admin/outlet/get_distributor_outlet') }}/" + id_customer, function(data) {
                    //  console.log(data);
                    $('#id_outlet_distributor').html(data);
                    // $('#kecamatan').prop('selectedIndex', 0);
                });
            }


        });

        // change tempat penyimpanan
        $('.tempat').change(function(){
            let tempat_val = $('.tempat').val();
            // console.log(tempat_val);
            localStorage.setItem('tempat_penyimpanan',tempat_val);
            $('#ModalTempatMenyimpan').modal('hide');
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


            // Swal.fire({
            //     icon: 'warning',
            //     title: 'Hapus Foto',
            //     text: 'Apakah anda yakin ingin mengapus foto ini ?',
            //     showCancelButton: !0,
            //     confirmButtonText: "Ya",
            //     cancelButtonText: "Tidak",
            //     reverseButtons: !0
            // }).then(function (e) {
            //     if (e.value === true) {
            //         $.ajax({
            //             type: "get",
            //             url: "{{ url('admin/outlet/deleteFoto') }}/" + idimages,
            //             success: function(data) {
            //                 // $(document).on("click", "#remove-member-fields_edit_outlet", function(event) {
            //                     // console.log();
            //                     // event.preventDefault();
            //                     // event.preventDefault();
            //                     // $(this)
            //                     //     .parent()
            //                     //     .fadeOut(300, function() {
            //                     //         $(this).remove();
            //                     //         // console.log(."remove div");
            //                     //         return false;
            //                     //     });
            //                 // });
            //             }
            //         });
            //         event.preventDefault();
            //         $(this)
            //             .parent()
            //             .fadeOut(300, function() {
            //                 $(this).remove();
            //                 // console.log(."remove div");
            //                 return false;
            //             });
            //     } else {
            //         e.dismiss;
            //     }
            // }, function (dismiss) {
            //     return false;
            // });
        });

        //add input
        $("#add-member-fields").click(function() {
            i++;
            var rows = `<div class="foto2 d-flex col-12 mb-3">
                            <div class="col-2 col-md-2 p-1"style="align-self:center;">
                                <label for="takefoto${i}" class="btn btn-md btn-secondary">
                                    <i class="uil-camera-plus"></i>
                                </label>
                            </div>
                            <div class="col-4 col-md-4 p-1">
                                <span>
                                    <input id="takefoto${i}" type="file" class="member_image" name="member_image[]" onchange="preview_member(event, ${i})"
                                    style="visibility:hidden; width:0;">
                                </span>
                                <img src="{{ URL::asset('/assets/images/no-image.jpg') }}" class="img-thumbnail mb-4 output_member_img" id="output_member${i}">
                            </div>
                            <div class="col-5 col-md-5 p-1"style="align-self: center">
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
        // });

        // proses submit legal
        $('#create_legal').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('submit-legal')[0].style.display = "none";
            document.getElementsByClassName("loading-legal")[0].style.display = "block";

            var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
            if (tempat_penyimpanan == "Server") {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/legal/store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil ditambahkan. ',
                                text: 'Data Legal Berhasil ditambahkan.',
                                showConfirmButton: false,
                                timer: 30000
                            });
                            $(".print-error-msg").css('display', 'none');
                            document.getElementById("tahun_berdiri").value = "";
                            document.getElementById("no_siup").value = "";
                            document.getElementById("no_tdp").value = "";
                            document.getElementById("remarks").value = "";
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal ditambahkan. ',
                                text: 'Data Legal Belum Lengkap.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            document.getElementsByClassName('submit-legal')[0].style.display = "block";
                            document.getElementsByClassName("loading-legal")[0].style.display = "none";
                        }
                    }
                });
            } else {
                const myLegal = {
                    id_customer: formData.get("id_customer"),
                    created_date: formData.get("created_date"),
                    ar: formData.get("ar"),
                    tahun_berdiri: formData.get("tahun_berdiri"),
                    no_siup: formData.get("no_siup"),
                    no_tdp: formData.get("no_tdp"),
                    remarks: formData.get("remarks"),
                }

                let daftar_legal;
                if (localStorage.getItem('daftar_legal') === null) {
                    daftar_legal = [];
                } else {
                    daftar_legal = JSON.parse(localStorage.getItem('daftar_legal'));
                }

                daftar_legal.push(myLegal);
                // console.log(JSON.stringify(myLegal));
                localStorage.setItem('daftar_legal', JSON.stringify(daftar_legal));

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil tersimpan.',
                    text: 'Data Legal Berhasil tersimpan pada local browser.',
                    showConfirmButton: false,
                    timer: 30000
                });

                document.getElementById("tahun_berdiri").value = "";
                document.getElementById("no_siup").value = "";
                document.getElementById("no_tdp").value = "";
                document.getElementById("remarks").value = "";

                document.getElementsByClassName('submit-legal')[0].style.display = "block";
                document.getElementsByClassName("loading-legal")[0].style.display = "none";
            }
        });
        // show modal edit legal
        function showLegal(id) { //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/legal/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_edit_legal').val(response.data.id);
                    $('#id_customer_edit_legal').val(response.data.id_customer);
                    $('#created_date_edit_legal').val(response.data.created_date);
                    $('#created_by_edit_legal').val(response.data.created_by);
                    $('#tahun_berdiri_edit_legal').val(response.data.tahun_berdiri);
                    $('#no_siup_edit_legal').val(response.data.no_siup);
                    $('#no_tdp_edit_legal').val(response.data.no_tdp);
                    $('#remarks_edit_legal').val(response.data.remarks);
                    $('[name="status_edit_legal"]').val(response.data.status);
                    //open modal
                    $('#ModalLegal').modal('show');
                    // location.reload();
                }
            });
        }
        // proses update legal
        $('#update_legal').submit(function(e) {
            e.preventDefault();
            let id = $('#id_edit_legal').val();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('update-legal')[0].style.display = "block";
            document.getElementsByClassName("loading-update-legal")[0].style.display = "none";
            $.ajax({
                type: "POST",
                url: "{{ url('admin/legal/update') }}/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        // alert(data.success);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil diupdate ',
                            text: 'Data legal berhasil diupdate !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        $('#ModalLegal').modal('hide');
                    } else {
                        $.each(data.error, function(key, value) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Update ',
                                text: 'Data legal harus lengkap !!',
                                showConfirmButton: true,
                                // timer: 1500
                            });
                        });
                        document.getElementsByClassName("update-legal")[0].style.display = "block";
                        document.getElementsByClassName('loading-update-legal')[0].style.display =
                            "none";
                    }
                }
            });
        });
        // proses destroy legal
        function destroyLegal(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin mengapus data ini ?',
                showCancelButton: !0,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/legal/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Legal Berhasil dihapus.',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            location.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            });
        }

        // proses submit contact person
        $('#create_contact_person').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('submit-contact')[0].style.display = "none";
            document.getElementsByClassName("loading-contact")[0].style.display = "block";

            var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
            // console.log(tempat_penyimpanan)
            if (tempat_penyimpanan == "Server") {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/contact_person/store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil ditambahkan. ',
                                text: 'Data Kontak Berhasil ditambahkan.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $(".print-error-msg").css('display', 'none');

                            $(".id_outlet").prop('selectedIndex', 0);
                            document.getElementById("nama_lengkap").value = "";
                            document.getElementById("no_telpon").value = "";
                            document.getElementById("email").value = "";
                            document.getElementById("jabatan").value = "";
                            $(".status_contact").prop('selectedIndex', 0);
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal ditambahkan. ',
                                text: 'Data Kontak Belum Lengkap.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            document.getElementsByClassName('submit-contact')[0].style.display = "block";
                            document.getElementsByClassName("loading-contact")[0].style.display = "none";
                        }
                    }
                });
            } else {
                const myContactPerson = {
                    id_customer: formData.get("id_customer"),
                    created_date: formData.get("created_date"),
                    ar: formData.get("ar"),
                    id_outlet: formData.get("id_outlet"),
                    nama_lengkap: formData.get("nama_lengkap"),
                    no_telpon: formData.get("no_telpon"),
                    email: formData.get("email"),
                    jabatan: formData.get("jabatan"),
                    status: formData.get("status"),
                }

                let daftar_contact_person;
                if (localStorage.getItem('daftar_contact_person') === null) {
                    daftar_contact_person = [];
                } else {
                    daftar_contact_person = JSON.parse(localStorage.getItem('daftar_contact_person'));
                }

                daftar_contact_person.push(myContactPerson);
                // console.log(JSON.stringify(daftar_contact_person));
                localStorage.setItem('daftar_contact_person', JSON.stringify(daftar_contact_person));

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil tersimpan.',
                    text: 'Data Contact Person Berhasil tersimpan pada local browser.',
                    showConfirmButton: false,
                    timer: 30000
                });

                $(".id_outlet").prop('selectedIndex', 0);
                document.getElementById("nama_lengkap").value = "";
                document.getElementById("no_telpon").value = "";
                document.getElementById("email").value = "";
                $(".jabatan").prop('selectedIndex', 0);
                $(".status_contact").prop('selectedIndex', 0);

                document.getElementsByClassName('submit-contact')[0].style.display = "block";
                document.getElementsByClassName("loading-contact")[0].style.display = "none";
            }

        });
        // show modal edit contact person
        function showContact(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/contact_person/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_edit_kontak').val(response.data.id);
                    $('#id_outlet_edit_kontak').val(response.data.id_outlet);
                    $('#created_date_edit_kontak').val(response.data.created_date);
                    $('#created_by_edit_kontak').val(response.data.created_by);
                    $('#nama_lengkap_edit_kontak').val(response.data.nama_lengkap);
                    $('#no_telpon_edit_kontak').val(response.data.no_telpon);
                    $('#email_edit_kontak').val(response.data.email);
                    $('#jabatan_edit_kontak').val(response.data.jabatan);
                    $('[name="status_edit_kontak"]').val(response.data.status);
                    //open modal
                    $('#ModalContact').modal('show');
                }
            });
        }
        // proses update kontak
        $('#update_contact').submit(function(e) {
            e.preventDefault();
            let id = $('#id_edit_kontak').val();
            var formData = new FormData(this);
            // console.log(id);
            document.getElementsByClassName('update-contact')[0].style.display = "none";
            document.getElementsByClassName("loading-update-contact")[0].style.display = "block";
            //ajax
            $.ajax({
                type: "POST",
                url: "{{ url('admin/contact_person/update') }}/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil diupdate. ',
                            text: 'Data Kontak Berhasil ditambahkan..',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        location.reload();
                        $('#ModalContact').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Update ',
                            text: 'Data kontak harus lengkap !!',
                            showConfirmButton: true,
                            // timer: 1500
                        });
                        document.getElementsByClassName('update-contact')[0].style.display = "block";
                        document.getElementsByClassName("loading-update-contact")[0].style.display =
                            "none";
                    }
                }
            });
        });
        // proses destroy contact person
        function destroyContactPerson(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin mengapus data ini ?',
                showCancelButton: !0,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/contact_person/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Kontak Berhasil dihapus.',
                                showConfirmButton: true,
                                timer: 3000
                            });
                            location.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            });
        }

        // get alamat by api jne create
        $("#provinsi").on("change", function() {
            var provinsi = $('#provinsi').val();
            // console.log(provinsi);
            $.get("{{ url('admin/outlet/get_kota') }}/" + provinsi, function(data) {
                //  console.log(data);
                $('#kota').html(data);
                // $('#kecamatan').prop('selectedIndex', 0);
            });
        });
        $("#kota").on("change", function() {
            var p = $('#provinsi').val();
            var d = $('#kota').val();
            // console.log(provinsi);
            // console.log(d);
            $.ajax({
                url: "{{ url('admin/outlet/get_kecamatan') }}",
                type: "GET",
                // dataType : "JSON",
                data: {
                    provinsi: p,
                    kota: d
                },
                success: function(ajaxData) {
                    // var json = JSON.parse(ajaxData);
                    //  console.log(json);
                    $("#kecamatan").html(ajaxData);
                }
            });

            $.ajax({
                url: "{{ url('get_area_id') }}",
                type: "GET",
                // dataType : "JSON",
                data: {
                    kota: d
                },
                success: function(response) {
                    // var json = JSON.parse(ajaxData);
                    console.log(response);
                    if (response.length > 0) {
                        $("#area").val(response);
                    } else {
                        $("#area").val("Area Belum Tersedia");
                    }

                }
            });
        });
        $("#kecamatan").on("change", function() {
            var p = $('#provinsi').val();
            var d = $('#kota').val();
            var s = $('#kecamatan').val();
            // console.log(kecamatan);
            $.ajax({
                url: "{{ url('admin/outlet/get_kelurahan') }}",
                type: "GET",
                // dataType : "JSON",
                data: {
                    provinsi: p,
                    kota: d,
                    kecamatan: s
                },
                success: function(ajaxData) {
                    // var json = JSON.parse(ajaxData);
                    //  console.log(json);
                    $("#kelurahan").html(ajaxData);
                }
            });
            // $.get("{{ url('admin/outlet/get_kelurahan') }}/" + kecamatan, function(data){
            // //  console.log(data);
            //     $('#kelurahan').html(data);
            //     // $('#kecamatan').prop('selectedIndex', 0);
            // });
        });
        $("#kelurahan").on("change", function() {
            var p = $('#provinsi').val();
            var d = $('#kota').val();
            var s = $('#kecamatan').val();
            var u = $('#kelurahan').val();
            $.ajax({
                url: "{{ url('admin/outlet/get_kode_pos') }}",
                type: "POST",
                // dataType : "JSON",
                data: {
                    provinsi: p,
                    kota: d,
                    kecamatan: s,
                    kelurahan: u
                },
                success: function(ajaxData) {
                    // var json = JSON.parse(ajaxData);
                    //  console.log(json);
                    $("#kode_pos").val(ajaxData);
                }
            });
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

        // proses submit outlet
        $('#create_outlet').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('submit-outlet')[0].style.display = "none";
            document.getElementsByClassName("loading-outlet")[0].style.display = "block";

            var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
            if (tempat_penyimpanan == "Server") {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/outlet/store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil ditambahkan.',
                                text: 'Data Outlet Berhasil ditambahkan.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $(".outlet_type").prop('selectedIndex', 0);
                            $("#address_type").val('').trigger('change');
                            document.getElementById("nama_outlet_edit_outlet").value = "";
                            document.getElementById("alamat").value = "";
                            document.getElementById("nama_lengkap_cont").value = "";
                            document.getElementById("no_telpon_cont").value = "";
                            document.getElementById("email_cont").value = "";
                            $(".jabatan_cont").prop('selectedIndex', 0);
                            $(".provinsi").prop('selectedIndex', 0);
                            $(".kota").prop('selectedIndex', 0);
                            $(".kecamatan").prop('selectedIndex', 0);
                            $(".kelurahan").prop('selectedIndex', 0);
                            document.getElementById("kode_pos").value = "";
                            document.getElementById("latitude").value = "";
                            document.getElementById("longitude").value = "";
                            $('img').attr('src', "{{ URL::asset('/assets/images/no-image.jpg') }}");
                            document.getElementById("namafoto").value = "";
                            $(".foto2").empty();
                            $("#brand_outlet").val('').trigger('change');
                            $(".status").prop('selectedIndex', 0);
                            document.getElementById("aplikasi").value = "";
                            document.getElementById("jumlah_pengambilan").value = "";
                            document.getElementById("remarks_cont").value = "";
                            document.getElementsByClassName('submit-outlet')[0].style.display = "block";
                            document.getElementsByClassName("loading-outlet")[0].style.display = "none";

                            var id_customer = $('#id_customer').val();
                            $.get("{{ url('admin/outlet/get_distributor_outlet') }}/" + id_customer, function(data) {
                                //  console.log(data);
                                $('#id_outlet_distributor').html(data);
                                // $('#kecamatan').prop('selectedIndex', 0);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal ditambahkan. ',
                                text: 'Data Outlet Belum Lengkap.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            document.getElementsByClassName('submit-outlet')[0].style.display = "block";
                            document.getElementsByClassName("loading-outlet")[0].style.display = "none";
                        }
                    }
                });
            } else {
                let nama_usaha = $('#nama_outlet').val();
                let id_general = $('#id_customer').val();
                let alamat_kantor = $('#alamat').val();
                let nama_lengkap = $('#nama_lengkap_cont').val();
                let mobile_phone = $('#no_telpon_cont').val();
                let email = $('#email_cont').val();
                let kota = $('#kota').val();
                let token = $("meta[name='csrf-token']").attr("content");
                // console.log(nama_usaha)
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/outlet/generate_id_outlet_berkas') }}",
                    data:{
                        "nama_usaha" : nama_usaha,
                        "id_general" : id_general,
                        "alamat_kantor" : alamat_kantor,
                        "nama_lengkap" : nama_lengkap,
                        "mobile_phone" : mobile_phone,
                        "email" : email,
                        "kota" : kota,
                        "_token": token
                    },
                    cache: false,
                    // contentType: false,
                    // processData: false,
                    success: (data) => {
                        // multiple image
                        const addressType = [];
                        $('#address_type :selected').each(function(i, sel){
                            addressType.push($(sel).val())
                        });

                        const nameImageOutlet = [];
                        const namaFile = document.querySelectorAll(".namafoto")
                        for(let name of namaFile){
                            const pushNameData = name.value
                            nameImageOutlet.push(pushNameData)
                        }

                        let filenamesImageOutlet  = [];
                        const files = document.querySelectorAll(".member_image")

                        // let n = 0;
                        // ;(async function() {
                        //     let daftar_outlet;
                        //     for(let item of files){
                        //         let filedata = item.files[0]
                        //         const reader = new FileReader();
                        //         reader.readAsDataURL(filedata);
                        //         // process isi file di sini

                        //         await new Promise(resolve => reader.onload = () => resolve());
                        //         // let resultFiledata = reader.result
                        //         // let pecahBase64 = resultFiledata.split(",")
                        //         // let pushFiledata = pecahBase64[1]
                        //         let pushFiledata = reader.result

                        //         filenamesImageOutlet[n] = pushFiledata;
                        //         // filenamesImageOutlet[n] = pecahBase64[1];
                        //         n++;

                        //         const myOutlet = {
                        //             id_customer : formData.get("id_customer"),
                        //             created_date : formData.get("created_date"),
                        //             ar : formData.get("ar"),
                        //             nama_outlet : formData.get("nama_outlet"),
                        //             outlet_type : formData.get("outlet_type"),
                        //             address_type : addressType,
                        //             area : formData.get("area"),
                        //             nama_lengkap : formData.get("nama_lengkap"),
                        //             no_telpon : formData.get("no_telpon"),
                        //             email : formData.get("email"),
                        //             jabatan : formData.get("jabatan"),
                        //             provinsi : formData.get("provinsi"),
                        //             alamat : formData.get("alamat"),
                        //             kota : formData.get("kota"),
                        //             kecamatan : formData.get("kecamatan"),
                        //             kelurahan : formData.get("kelurahan"),
                        //             kode_pos : formData.get("kode_pos"),
                        //             latitude : formData.get("latitude"),
                        //             longitude : formData.get("longitude"),
                        //             foto : filenamesImageOutlet,
                        //             nama_foto : nameImageOutlet,
                        //             aplikasi : formData.get("aplikasi"),
                        //             jumlah_pengambilan : formData.get("jumlah_pengambilan"),
                        //             status : formData.get("status"),
                        //             remarks : formData.get("remarks"),
                        //         }

                        //         // let daftar_outlet;
                        //         if (localStorage.getItem('daftar_outlet')===null)
                        //         {
                        //             daftar_outlet = [];
                        //         }
                        //         else
                        //         {
                        //             daftar_outlet = JSON.parse(localStorage.getItem('daftar_outlet'));
                        //         }

                        //         daftar_outlet.push(myOutlet);

                        //     }
                        //     console.log(JSON.stringify(daftar_outlet));
                        //     localStorage.setItem('daftar_outlet',JSON.stringify(daftar_outlet));
                        // })()

                        // data outlet save localstorage
                        const myOutlet = {
                            id_customer : formData.get("id_customer"),
                            created_date : formData.get("created_date"),
                            ar : formData.get("ar"),
                            nama_outlet : formData.get("nama_outlet"),
                            outlet_type : formData.get("outlet_type"),
                            address_type : addressType,
                            area : formData.get("area"),
                            nama_lengkap : formData.get("nama_lengkap"),
                            no_telpon : formData.get("no_telpon"),
                            email : formData.get("email"),
                            jabatan : formData.get("jabatan"),
                            provinsi : formData.get("provinsi"),
                            alamat : formData.get("alamat"),
                            kota : formData.get("kota"),
                            kecamatan : formData.get("kecamatan"),
                            kelurahan : formData.get("kelurahan"),
                            kode_pos : formData.get("kode_pos"),
                            latitude : formData.get("latitude"),
                            longitude : formData.get("longitude"),
                            foto : filenamesImageOutlet,
                            nama_foto : nameImageOutlet,
                            aplikasi : formData.get("aplikasi"),
                            jumlah_pengambilan : formData.get("jumlah_pengambilan"),
                            status : formData.get("status"),
                            remarks : formData.get("remarks"),
                        }

                        // let daftar_outlet;
                        if (localStorage.getItem('daftar_outlet')===null)
                        {
                            daftar_outlet = [];
                        }
                        else
                        {
                            daftar_outlet = JSON.parse(localStorage.getItem('daftar_outlet'));
                        }

                        daftar_outlet.push(myOutlet);

                        // console.log(JSON.stringify(daftar_outlet));
                        localStorage.setItem('daftar_outlet',JSON.stringify(daftar_outlet));

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil tersimpan.',
                            text: 'Data Outlet Berhasil tersimpan pada local browser.',
                            showConfirmButton: false,
                            timer: 30000
                        });

                        $(".outlet_type").prop('selectedIndex', 0);
                        $("#address_type").val('').trigger('change');
                        document.getElementById("nama_outlet_edit_outlet").value = "";
                        document.getElementById("alamat").value = "";
                        document.getElementById("nama_lengkap_cont").value = "";
                        document.getElementById("no_telpon_cont").value = "";
                        document.getElementById("email_cont").value = "";
                        $(".jabatan_cont").prop('selectedIndex', 0);
                        $(".provinsi").prop('selectedIndex', 0);
                        $(".kota").prop('selectedIndex', 0);
                        $(".kecamatan").prop('selectedIndex', 0);
                        $(".kelurahan").prop('selectedIndex', 0);
                        document.getElementById("kode_pos").value = "";
                        document.getElementById("latitude").value = "";
                        document.getElementById("longitude").value = "";
                        $('img').attr('src', "{{ URL::asset('/assets/images/no-image.jpg') }}");
                        document.getElementById("namafoto").value = "";
                        $(".foto2").empty();
                        document.getElementById("aplikasi").value = "";
                        document.getElementById("jumlah_pengambilan").value = "";
                        $(".status").prop('selectedIndex', 0);
                        document.getElementById("remarks_cont").value = "";
                        document.getElementsByClassName('submit-outlet')[0].style.display = "block";
                        document.getElementsByClassName("loading-outlet")[0].style.display = "none";

                        var id_customer = $('#id_customer').val();
                        $.get("{{ url('admin/outlet/get_distributor_draft_id') }}/" + id_customer, function(data) {
                            //  console.log(data);
                            $('#id_outlet_distributor').html(data);
                            // $('#kecamatan').prop('selectedIndex', 0);
                        });
                    }
                });


            }
        });
        // show modal edit contact person
        function showOutlet(id) {
            //fetch detail post with ajax
            // console.log("modal update Outlet")
            $.ajax({
                url: "{{ url('admin/outlet/show') }}/" + id,
                type: "get",
                // dataType : "JSON",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_edit_outlet').val(response.data.id);
                    $('#id_customer_edit_outlet').val(response.data.id_customer);
                    $('#id_outlet_edit_outlet').val(response.data.id_outlet);
                    $('#created_date_edit_outlet').val(response.data.created_date);
                    $('#created_by_edit_outlet').val(response.data.created_by);
                    $('[name="outlet_type_edit_outlet"]').val(response.data.outlet_type);
                    $('#area_edit_outlet').val(response.data.id_area);
                    $('#nama_outlet_edit_outlet').val(response.data.nama_outlet);
                    var strArrayAddressType = response.data.address_type.split(",");
                    $("#address_type_edit_outlet").select2().val(strArrayAddressType).change();
                    $('#address_type_edit_outlet1').text(response.data.address_type);

                    $('#alamat_edit_outlet').val(response.data.alamat);
                    $('#status_generate_qrcode_outlet').val(response.data.status_generate_qrcode);
                    $('[name="provinsi_edit_outlet"]').val(response.data.provinsi);

                    var id = response.data.id;
                    // console.log(id);

                    $.get("{{ url('admin/outlet/get_kota_edit_outlet') }}/" + id, function(data) {
                        $('#kota_edit_outlet').html(data);
                    });
                    $.get("{{ url('admin/outlet/get_kecamatan_edit_outlet') }}/" + id, function(data) {
                        $('#kecamatan_edit_outlet').html(data);
                    });
                    $.get("{{ url('admin/outlet/get_kelurahan_edit_outlet') }}/" + id, function(data) {
                        $('#kelurahan_edit_outlet').html(data);
                    });

                    $('#kode_pos_edit_outlet').val(response.data.kode_pos);
                    $('#latitude_edit_outlet').val(response.data.latitude);
                    $('#longitude_edit_outlet').val(response.data.longitude);
                    $('#location_edit_outlet').attr('src', "https://maps.google.com/maps?q=" + response.data
                        .latitude + "," + response.data.longitude + "&z=15&output=embed");

                    $.ajax({
                        url: "{{ url('admin/outlet/get_images_outlet') }}/" + id,
                        type: "get",
                        cache: false,
                        success: function(ajaxData) {

                            if (ajaxData.dataImages.length == 0) {
                                let count_foto = ajaxData.dataImages.length;
                                $('#count_foto').val(count_foto);
                            } else {
                                let count_foto = ajaxData.dataImages.length;
                                let j = 0;
                                $('#count_foto').val(count_foto);

                                while (j < ajaxData.dataImages.length) {
                                    // console.log(ajaxData.dataImages[j].foto);
                                    // console.log(ajaxData.dataImages[j].nama_foto);
                                    // console.log("lopping");
                                    let html = `<div id="foto2_edit_outlet" class="foto2_edit_outlet d-flex justify-content-between mb-3 no-reload">
                                            <div style="align-self:center;"><label for="takefoto` + [j] + `" class="btn btn-md btn-secondary"><i class="uil-camera-plus"></i></label></div>
                                        <span>
                                            <input id="takefoto` + [j] +
                                        `" type="file" capture="user" accept="image/*" value="" name="member_image_edit_outlet[]" onchange="preview_member_edit_outlet(event, ` +
                                        [j] + `)" style="visibility:hidden; width:0;">
                                        </span>
                                        <img src="{{ asset('files') }}/` + ajaxData.dataImages[j].foto +
                                        `" class="img-thumbnail output_member_img" id="output_member_edit_outlet` +
                                        [j] + `">
                                        <div style="align-self: center">
                                            <input type="text" class="form-control" value="` + ajaxData.dataImages[j]
                                        .nama_foto + `" name="namafoto_edit_outlet[` + ajaxData
                                        .dataImages[j].id +
                                        `]" id="namafoto_edit_outlet" placeholder="Nama foto">
                                        </div>
                                        <a class="btn btn-danger btn-block" style="align-self:center;" id="remove-member-fields_edit_outlet" data-idimages="` +
                                        ajaxData.dataImages[j].id + `"><i class="uil-trash"></i></a>

                                    </div>
                                    `;
                                    // console.log(html);
                                    // $('#team-member-fields_edit_outlet').html(html);
                                    j++;
                                    $(html)
                                        // .fadeIn("fast")
                                        .appendTo("#team_member_fields_edit_outlet");
                                    // return false;

                                    // j++;
                                }
                            }
                        }
                    });

                    // var strArrayBrand = response.data.brand.split(",");
                    // $("#brand_outlet_edit_outlet").select2().val(strArrayBrand).change();
                    $('#aplikasi_edit_outlet').val(response.data.aplikasi);
                    $('#jumlah_pengambilan_edit_outlet').val(response.data.jumlah_pengambilan);
                    $('[name="status_outlet_edit_outlet"]').val(response.data.status);
                    $('#remarks_edit_outlet').val(response.data.remarks);
                    //open modal
                    $('#ModalOutlet').modal('show');
                }
            });
        }

        function remove_member_fields_edit_outlet(id) {
            // Swal.fire({
            //     icon: 'warning',
            //     title: 'Hapus Foto',
            //     text: 'Apakah anda yakin ingin mengapus foto ini ?',
            //     showCancelButton: !0,
            //     confirmButtonText: "Ya",
            //     cancelButtonText: "Tidak",
            //     reverseButtons: !0
            // }).then(function (e) {
            //     if (e.value === true) {
            //         $.ajax({
            //             type: "get",
            //             url: "{{ url('admin/outlet/deleteFoto') }}/" + id,
            //             success: function(data) {
            //                 // $(document).on("click", "#remove-member-fields_edit_outlet", function(event) {
            //                     // console.log();
            //                     // event.preventDefault();
            //                     $(this)
            //                         .parent()
            //                         .fadeOut(300, function() {
            //                             $(this).hide();
            //                             // console.log(."remove div");
            //                             return false;
            //                         });
            //                 // });
            //             }
            //         });
            //     } else {
            //         e.dismiss;
            //     }
            // }, function (dismiss) {
            //     return false;
            // });
        }

        function closeModalOutlet() {
            location.reload();
        }

        // proses update outlet
        $('#update_outlet').submit(function(e) {
            let id = $('#id_edit_outlet').val();
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('update-outlet')[0].style.display = "none";
            document.getElementsByClassName("loading-update-outlet")[0].style.display = "block";
            //ajax
            $.ajax({
                type: "POST",
                url: "{{ url('admin/outlet/update') }}/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        // console.log(data.success);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Diupdate. ',
                            text: 'Data Outlet Berhasil diupdate.',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        location.reload();
                        $('#ModalOutlet').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Diupdate. ',
                            text: 'Data outlet gagal diupdate.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                        document.getElementsByClassName('update-outlet')[0].style.display = "block";
                        document.getElementsByClassName("loading-update-outlet")[0].style.display =
                            "none";
                    }
                }
            });
        });
        // proses destroy legal
        function destroyOutlet(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin mengapus data ini ?',
                showCancelButton: !0,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/outlet/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Outlet Berhasil dihapus.',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            location.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            });
        }

        // get alamat by api jne edit
        $("#provinsi_edit_outlet").on("change", function() {
            var provinsi = $('#provinsi_edit_outlet').val();
            // console.log(provinsi);
            $.get("{{ url('admin/outlet/get_kota') }}/" + provinsi, function(data) {
                //  console.log(data);
                $('#kota_edit_outlet').html(data);
                // $('#kecamatan').prop('selectedIndex', 0);
            });
        });
        $("#kota_edit_outlet").on("change", function() {
            var p = $('#provinsi_edit_outlet').val();
            var d = $('#kota_edit_outlet').val();
            // console.log(provinsi);
            // console.log(kota);
            $.ajax({
                url: "{{ url('admin/outlet/get_kecamatan') }}",
                type: "GET",
                // dataType : "JSON",
                data: {
                    provinsi: p,
                    kota: d
                },
                success: function(ajaxData) {
                    // var json = JSON.parse(ajaxData);
                    //  console.log(json);
                    $("#kecamatan_edit_outlet").html(ajaxData);
                }
            });

            $.ajax({
                url: "{{ url('get_area_id') }}",
                type: "GET",
                // dataType : "JSON",
                data: {
                    kota: d
                },
                success: function(response) {
                    // var json = JSON.parse(ajaxData);
                    // console.log(response);
                    $("#area_edit_outlet").val(response);
                }
            });

        });
        $("#kecamatan_edit_outlet").on("change", function() {
            var p = $('#provinsi_edit_outlet').val();
            var d = $('#kota_edit_outlet').val();
            var s = $('#kecamatan_edit_outlet').val();
            // console.log(kecamatan);
            $.ajax({
                url: "{{ url('admin/outlet/get_kelurahan') }}",
                type: "GET",
                // dataType : "JSON",
                data: {
                    provinsi: p,
                    kota: d,
                    kecamatan: s
                },
                success: function(ajaxData) {
                    // var json = JSON.parse(ajaxData);
                    //  console.log(json);
                    $("#kelurahan_edit_outlet").html(ajaxData);
                }
            });
        });
        $("#kelurahan_edit_outlet").on("change", function() {
            var p = $('#provinsi_edit_outlet').val();
            var d = $('#kota_edit_outlet').val();
            var s = $('#kecamatan_edit_outlet').val();
            var u = $('#kelurahan_edit_outlet').val();
            $.ajax({
                url: "{{ url('admin/outlet/get_kode_pos') }}",
                type: "POST",
                // dataType : "JSON",
                data: {
                    provinsi: p,
                    kota: d,
                    kecamatan: s,
                    kelurahan: u
                },
                success: function(ajaxData) {
                    // var json = JSON.parse(ajaxData);
                    //  console.log(json);
                    $("#kode_pos_edit_outlet").val(ajaxData);
                }
            });
        });

        // proses submit detail distributor
        $('#create_detail_distributor').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('submit-detail-distributor')[0].style.display = "none";
            document.getElementsByClassName("loading-detail-distributor")[0].style.display = "block";
            var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
            // console.log(tempat_penyimpanan)
            if (tempat_penyimpanan == "Server") {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/detail_distributor/store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil ditambahkan. ',
                                text: 'Data Detail Distributor Berhasil ditambahkan.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $(".print-error-msg").css('display', 'none');

                            $(".id_outlet").prop('selectedIndex', 0);
                            $(".id_distributor").prop('selectedIndex', 0);
                            $("#brand_outlet").val('').trigger('change');
                            $(".status_detail_distributor").prop('selectedIndex', 0);
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal ditambahkan. ',
                                text: 'Data Detail Distributor Belum Lengkap.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            document.getElementsByClassName('submit-detail-distributor')[0].style.display = "block";
                            document.getElementsByClassName("loading-detail-distributor")[0].style.display = "none";
                        }
                    }
                });
            } else {
                const BrandOutlet = [];
                $('#brand_outlet :selected').each(function(i, sel){
                    BrandOutlet.push($(sel).val())
                });

                const myDetailDistributor = {
                    id_customer: formData.get("id_customer"),
                    created_date: formData.get("created_date"),
                    ar: formData.get("ar"),
                    id_outlet: formData.get("id_outlet"),
                    id_distributor: formData.get("id_distributor"),
                    brand_outlet: BrandOutlet,
                    status_detail_distributor: formData.get("status_detail_distributor"),
                }

                let daftar_detail_distributor;
                if (localStorage.getItem('daftar_detail_distributor') === null) {
                    daftar_detail_distributor = [];
                } else {
                    daftar_detail_distributor = JSON.parse(localStorage.getItem('daftar_detail_distributor'));
                }

                daftar_detail_distributor.push(myDetailDistributor);
                // console.log(JSON.stringify(daftar_detail_distributor));
                localStorage.setItem('daftar_detail_distributor', JSON.stringify(daftar_detail_distributor));

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil tersimpan.',
                    text: 'Data Detail Distributor Berhasil tersimpan pada local browser.',
                    showConfirmButton: false,
                    timer: 30000
                });

                $(".id_outlet").prop('selectedIndex', 0);
                $(".id_distributor").prop('selectedIndex', 0);
                $("#brand_outlet").val('').trigger('change');
                $(".status_detail_distributor").prop('selectedIndex', 0);

                document.getElementsByClassName('submit-detail-distributor')[0].style.display = "block";
                document.getElementsByClassName("loading-detail-distributor")[0].style.display = "none";
            }

        });
        // show modal edit detail distributor
        function showDetailDistributor(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/detail_distributor/show') }}/" + id,
                type: "get",
                // dataType : "JSON",
                cache: false,
                success: function(response) {
                    //fill data to form
                    // console.log(response.data.id_cust)
                    $('#id_edit_detail_distributor').val(response.data.id);
                    // $('#id_customer_edit_detail_distributor').val(response.data.id_cust);
                    $('#created_date_edit_detail_distributor').val(response.data.created_date);
                    $('#created_by_edit_detail_distributor').val(response.data.created_by);
                    $('#id_outlet_edit_detail_distributor').val(response.data.id_outlet);
                    $('[name="id_distributor_edit_detail_distributor"]').val(response.data.id_cust);
                    var strArrayBrand = response.data.brand.split(",");
                    $("#brand_detail_distributor_edit_detail_distributor").select2().val(strArrayBrand)
                        .change();
                    $('[name="status_edit_detail_distributor"]').val(response.data.status);
                    //open modal
                    $('#ModalDetailDistributor').modal('show');
                }
            });
        }
        // proses update detail distributor
        $('#update_detail_distributor').submit(function(e) {
            e.preventDefault();
            let id = $('#id_edit_detail_distributor').val();
            var formData = new FormData(this);
            console.log(formData);
            document.getElementsByClassName('update-detail-distributor')[0].style.display = "block";
            document.getElementsByClassName("loading-update-detail-distributor")[0].style.display = "none";
            $.ajax({
                type: "POST",
                url: "{{ url('admin/detail_distributor/update') }}/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        // alert(data.success);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil diupdate ',
                            text: 'Data Detail Distributor berhasil diupdate !',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                        $('#ModalDetailDistributor').modal('hide');
                    } else {
                        $.each(data.error, function(key, value) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Update ',
                                text: 'Data detail distributor harus lengkap !!',
                                showConfirmButton: true,
                                // timer: 1500
                            });
                        });
                        document.getElementsByClassName("update-detail-distributor")[0].style.display =
                            "block";
                        document.getElementsByClassName('loading-update-detail-distributor')[0].style
                            .display = "none";
                    }
                }
            });
        });
        // proses destroy detail distributor
        function destroyDetailDistributor(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin mengapus data ini ?',
                showCancelButton: !0,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/detail_distributor/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Detail Distributor Berhasil dihapus.',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            location.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            });
        }

        // proses submit akun
        $('#create_account').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('submit-account')[0].style.display = "none";
            document.getElementsByClassName("loading-account")[0].style.display = "block";
            var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
            // console.log(tempat_penyimpanan)
            if (tempat_penyimpanan == "Server") {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/account/store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil ditambahkan. ',
                                text: 'Data Legal Berhasil ditambahkan.',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            document.getElementById("payment_trems").value = "";
                            document.getElementById("id_price").value = "";
                            document.getElementById("credit_limit").value = "";
                            document.getElementById("max_nota").value = "";
                            $(".bank").prop('selectedIndex', 0);
                            document.getElementById("atas_nama").value = "";
                            document.getElementById("no_rek").value = "";
                            document.getElementById("cabang").value = "";
                            $(".status_account").prop('selectedIndex', 0);
                            document.getElementById("remarks_account").value = "";
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal ditambahkan. ',
                                text: 'Data Akun Gagal ditambahkan.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            document.getElementsByClassName('submit-account')[0].style.display = "block";
                            document.getElementsByClassName("loading-account")[0].style.display = "none";
                        }
                    }
                });
            } else {
                const myAccount = {
                    id_customer: formData.get("id_customer"),
                    created_date: formData.get("created_date"),
                    ar: formData.get("ar"),
                    payment_trems: formData.get("payment_trems"),
                    id_price: formData.get("id_price"),
                    credit_limit: formData.get("credit_limit"),
                    max_nota: formData.get("max_nota"),
                    bank: formData.get("bank"),
                    atas_nama: formData.get("atas_nama"),
                    no_rek: formData.get("no_rek"),
                    cabang: formData.get("cabang"),
                    status_account: formData.get("status_account"),
                    remarks_account: formData.get("remarks_account"),
                }

                let daftar_account;
                if (localStorage.getItem('daftar_account') === null) {
                    daftar_account = [];
                } else {
                    daftar_account = JSON.parse(localStorage.getItem('daftar_account'));
                }

                daftar_account.push(myAccount);
                // console.log(JSON.stringify(daftar_account));
                localStorage.setItem('daftar_account', JSON.stringify(daftar_account));

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil tersimpan.',
                    text: 'Data Account Berhasil tersimpan pada local browser.',
                    showConfirmButton: false,
                    timer: 30000
                });

                document.getElementById("payment_trems").value = "";
                document.getElementById("id_price").value = "";
                document.getElementById("credit_limit").value = "";
                document.getElementById("max_nota").value = "";
                $(".bank").prop('selectedIndex', 0);
                document.getElementById("atas_nama").value = "";
                document.getElementById("no_rek").value = "";
                document.getElementById("cabang").value = "";
                $(".status_account").prop('selectedIndex', 0);
                document.getElementById("remarks_account").value = "";

                document.getElementsByClassName('submit-account')[0].style.display = "block";
                document.getElementsByClassName("loading-account")[0].style.display = "none";
            }

        });
        // show modal edit akun
        function showAkun(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/account/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_edit_akun').val(response.data.id);
                    $('#id_customer_edit_akun').val(response.data.id_customer);
                    $('#created_date_edit_akun').val(response.data.created_date);
                    $('#created_by_edit_akun').val(response.data.created_by);
                    $('#syaratpem_edit_akun').val(response.data.payment_trems);
                    $('#idharga_edit_akun').val(response.data.id_price);
                    $('#kreditlimit_edit_akun').val(response.data.credit_limit);
                    $('#MaksNota_edit_akun').val(response.data.max_nota);
                    $('[name="bank_edit_akun"]').val(response.data.bank);
                    $('#atas_nama_edit_akun').val(response.data.atas_nama);
                    $('#akun_edit_akun').val(response.data.no_rek);
                    $('#cabang_edit_akun').val(response.data.cabang);
                    $('[name="status_edit_akun"]').val(response.data.status);
                    $('#remarks_edit_akun').val(response.data.remarks);
                    //open modal
                    $('#ModalAkun').modal('show');
                }
            });
        }
        // proses update akun
        $('#update_akun').submit(function(e) {
            e.preventDefault();
            let id = $('#id_edit_akun').val();
            var formData = new FormData(this);
            // console.log(formData);
            document.getElementsByClassName('update-account')[0].style.display = "none";
            document.getElementsByClassName("loading-update-account")[0].style.display = "block";
            //ajax
            $.ajax({
                type: "POST",
                url: "{{ url('admin/account/update') }}/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil diupdate. ',
                            text: 'Data akun berhasil diupdate.',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        location.reload();
                        $('#ModalAkun').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal diupdate. ',
                            text: 'Data akun gagal diupdate.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                        document.getElementsByClassName('update-account')[0].style.display = "block";
                        document.getElementsByClassName("loading-update-account")[0].style.display =
                            "none";
                    }
                }
            });
        });
        // proses destroy akun
        function destroyAkun(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin mengapus data ini ?',
                showCancelButton: !0,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/account/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Account Berhasil dihapus.',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            location.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            });
        }

        // proses submit attachment
        $('#create_attachment').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            // insert no local storage
            document.getElementsByClassName('submit-attachment')[0].style.display = "none";
            document.getElementsByClassName("loading-attachment")[0].style.display = "block";

            var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
            if (tempat_penyimpanan == "Server") {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/attachment/store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil diupdate. ',
                                text: 'Data attachment berhasil diupdate.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();
                        } else {
                            // printErrorMsg(data.error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal diupdate. ',
                                text: 'Data attachment gagal diupdate.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            document.getElementsByClassName('submit-attachment')[0].style.display = "block";
                            document.getElementsByClassName("loading-attachment")[0].style.display = "none";
                        }
                    }
                });
            } else {
                // multiple image
                const nameAttachment = [];
                const namaFile = document.querySelectorAll(".namaFile")
                for(let name of namaFile){
                    const pushNameData = name.value
                    nameAttachment.push(pushNameData)
                }

                let filenamesAttachment = [];
                const files = document.querySelectorAll(".filenames")

                let n = 0;
                ;(async function() {
                    let daftar_attachment;
                    for(let item of files){
                        let filedata = item.files[0]
                        const reader = new FileReader();
                        reader.readAsDataURL(filedata);
                        // process isi file di sini

                        await new Promise(resolve => reader.onload = () => resolve());
                        // let resultFiledata = reader.result
                        // let pecahBase64 = resultFiledata.split(",")
                        // let pushFiledata = pecahBase64[1]
                        let pushFiledata = reader.result

                        filenamesAttachment[n] = pushFiledata;
                        // filenamesAttachment[n] = pecahBase64[1];
                        n++;

                        const myAttachment = {
                            id_customer : formData.get("id_customer"),
                            created_date : formData.get("created_date"),
                            ar : formData.get("ar"),
                            filenames : filenamesAttachment,
                            namaFile : nameAttachment,
                        }

                        // let daftar_attachment;
                        if (localStorage.getItem('daftar_attachment')===null)
                        {
                            daftar_attachment = [];
                        }
                        else
                        {
                            daftar_attachment = JSON.parse(localStorage.getItem('daftar_attachment'));
                        }

                        daftar_attachment.push(myAttachment);

                    }
                    console.log(JSON.stringify(daftar_attachment));
                    localStorage.setItem('daftar_attachment',JSON.stringify(daftar_attachment));
                })()
                // end multiple images

                // single images
                // const images = document.getElementById('filenames');
                // const file = images.files[0];
                // const reader = new FileReader();

                // reader.addEventListener('load', () => {
                //     const myAttachment = {
                //         id_customer : formData.get("id_customer"),
                //         created_date : formData.get("created_date"),
                //         ar : formData.get("ar"),
                //         filenames : reader.result,
                //         namaFile : formData.get("namaFile"),
                //     }

                //     console.log(myAttachment)

                //     let daftar_attachment;
                //     if (localStorage.getItem('daftar_attachment')===null)
                //     {
                //         daftar_attachment = [];
                //     }
                //     else
                //     {
                //         daftar_attachment = JSON.parse(localStorage.getItem('daftar_attachment'));
                //     }

                //     daftar_attachment.push(myAttachment);
                //     localStorage.setItem('daftar_attachment',JSON.stringify(daftar_attachment));
                // });

                // reader.readAsDataURL(file);
                // end single images
                // end tes local storage

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil tersimpan.',
                    text: 'Data Attachment Berhasil tersimpan pada local browser.',
                    showConfirmButton: false,
                    timer: 30000
                });
            }
        });

        // show div on error validation
        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
