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
            List General Information
        @endslot
    @endcomponent

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('sweetalert::alert')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    @can('generals-create')
                        <a class="btn btn-success m-1" href="{{ route('generals.create') }}"> Buat General Baru</a>
                    @endcan
                    @can('generals-excel-general')
                        <button class="btn btn-success m-1" onclick="excel_general()"> Export Excel General</button>
                    @endcan
                    @can('generals-excel-outlet')
                        <button class="btn btn-success m-1" onclick="excel_outlet()"> Export Excel Outlet</button>
                    @endcan
                    {{-- @can('generals-scan-outlet')
                        <button class="btn btn-success m-1" onclick="scan_qrcode()"> Scan QRCode</button>
                    @endcan --}}
                    {{-- @can('generals-synchronize') --}}
                        <button class="btn btn-success m-1 button" onclick="sync()">Synchronize</button>
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-home" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID Customer</th>
                                    <th>Nama Usaha</th>
                                    <th>Type Usaha</th>
                                    <th>Nama Pemilik</th>
                                    <th>Alamat</th>
                                    <th>Jumlah Outlet</th>
                                    <th>AR</th>
                                    <th width="280px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $general)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $general->id_customer }}</td>
                                        <td>{{ $general->nama_usaha }}</td>
                                        <td>{{ $general->type_usaha }}</td>
                                        <td>{{ $general->nama_lengkap }}</td>
                                        <td>{{ $general->alamat_kantor }}</td>

                                        @php
                                            $get_outlet = DB::table('outlet')
                                                            ->where('id_customer', $general->id_customer)
                                                            ->get();
                                            $jumlah_outlet = $get_outlet->count();
                                        @endphp

                                        <td>{{ $jumlah_outlet }}</td>
                                        <td>{{ $general->name }}</td>

                                        <td>
                                            @if (Auth::user()->hasRole("Admin") == 1)
                                                <a href="{{ route('generals.edit',$general->id_general) }}" class="btn btn-sm  btn-success m-1">Edit</a>
                                                <a href="{{ route('generals.show',$general->id_general) }}" class="btn btn-sm btn-primary m-1">Detail</a>
                                                <a href="{{URL('admin/generals/atribut', $general->id_general)}}" class="btn btn-sm btn-warning m-1">Berkas</a>
                                                <a href="{{ route('generals.visit', ['id' => $general->id_general])}}" class="btn btn-sm btn-secondary">Visit</a>
                                                <button class="btn btn-sm btn-danger m-1" onclick="destroyGeneral({{ $general->id_general }})">Hapus</button>
                                            @elseif (Auth::user()->hasRole("Sales") == 1)
                                                <a href="{{ route('generals.edit',$general->id_general) }}" class="btn btn-medium btn-success">Edit</a>
                                                <a href="{{ route('generals.show',$general->id_general) }}" class="btn btn-medium btn-primary">Detail</a>
                                                <a href="{{URL('admin/generals/atribut', $general->id_general)}}" class="btn btn-medium btn-warning">Berkas</a>
                                                {{-- <a href="{{URL('admin/generals/destroy', $general->id_general)}}" class="btn btn-xs btn-danger" onclick="return confirm('yakin?');">Delete</a> --}}
                                            @elseif (Auth::user()->hasRole("Verifikator") == 1)
                                                {{-- <a href="{{ route('generals.edit',$general->id_general) }}" class="btn btn-medium btn-success">Edit</a> --}}
                                                <a href="{{ route('generals.show',$general->id_general) }}" class="btn btn-medium btn-primary">Detail</a>
                                                {{-- <a href="{{URL('admin/generals/atribut', $general->id_general)}}" class="btn btn-medium btn-warning">Berkas</a> --}}
                                                {{-- <a href="{{URL('admin/generals/destroy', $general->id_general)}}" class="btn btn-xs btn-danger" onclick="return confirm('yakin?');">Delete</a> --}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    {{-- modal excel general --}}
    <div class="modal fade" id="ModalExcelGeneral" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Export Excel General</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>
                    {{-- action="{{ route('generals.export_excel') }}" --}}
                    {{-- action="javascript:void(0)" --}}
                    <form id="export_excel" action="{{ route('generals.export_excel_general') }}" method="POST"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                        @endphp
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control"
                                    name="created_date"
                                    id="created_date" value="{{ date('Y-m-d') }}">
                                <input type="hidden" class="form-control"
                                    name="created_by" id="created_by"
                                    value="{{ Str::ucfirst(Auth::user()->id) }}">
                            </div>
                        </div>
                        <div class="row col-xl-12 col-md-12">
                            <div class="col-xl-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Dari</label>
                                    <input type="date" class="form-control"
                                        name="dari"
                                        id="dari">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sampai</label>
                                    <input type="date" class="form-control"
                                        name="sampai"
                                        id="sampai">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal excel outlet --}}
    <div class="modal fade" id="ModalExcelOutlet" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Export Excel Outlet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>
                    {{-- action="{{ route('generals.export_excel') }}" --}}
                    {{-- action="javascript:void(0)" --}}
                    <form id="export_excel" action="{{ route('generals.export_excel_outlet') }}" method="POST"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                        @endphp
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control"
                                    name="created_date"
                                    id="created_date" value="{{ date('Y-m-d') }}">
                                <input type="hidden" class="form-control"
                                    name="created_by" id="created_by"
                                    value="{{ Str::ucfirst(Auth::user()->id) }}">
                            </div>
                        </div>
                        <div class="row col-xl-12 col-md-12">
                            <div class="col-xl-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Dari</label>
                                    <input type="date" class="form-control"
                                        name="dari"
                                        id="dari">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sampai</label>
                                    <input type="date" class="form-control"
                                        name="sampai"
                                        id="sampai">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal scan qrcode --}}
    <div class="modal fade" id="ModalScanQrcode" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Scan Qrcode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="reader" width="600px"></div>
                    <input type="hidden" name="hasil_qrcode" id="hasil_qrcode">
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    {{-- <script src="https://unpkg.com/html5-qrcode"></script> --}}
    <script src="{{ URL::asset('/assets/libs/html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-home').DataTable();
            cekLocalStorage();
        });

        let button = document.querySelector(".button");
        var dataGeneral = JSON.parse(localStorage.getItem('daftar_general'))
        var dataLegal = JSON.parse(localStorage.getItem('daftar_legal'))
        var dataContactPerson = JSON.parse(localStorage.getItem('daftar_contact_person'))
        var dataOutlet = JSON.parse(localStorage.getItem('daftar_outlet'))
        var dataDetailDistributor = JSON.parse(localStorage.getItem('daftar_detail_distributor'))
        var dataAccount = JSON.parse(localStorage.getItem('daftar_account'))
        var dataAttachment = JSON.parse(localStorage.getItem('daftar_attachment'))

        function cekLocalStorage(){
            if (dataGeneral || dataLegal || dataContactPerson || dataOutlet || dataDetailDistributor || dataAccount || dataAttachment) {
                button.disabled = false;
                console.log("data ada")
            } else {
                button.disabled = true;
                console.log("data kosong")
            }
        }

        function sync(){
            // alert("Sinkronkan data");
            button.disabled = true;
            button.innerHTML = `<span class="spinner-border spinner-border-sm span-spinner" role="status" aria-hidden="true"></span>
                                    Loading...`;

            if (typeof(Storage) !== "undefined") {
                // console.log("local storage available")
                if (dataGeneral || dataLegal || dataContactPerson || dataOutlet || dataDetailDistributor || dataAccount || dataAttachment) {
                    // console.log(localStorage.getItem("remarks"))
                    // console.log("ada data")
                    if (dataGeneral) {
                        dataGeneral.forEach(function(element) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('admin/generals/store') }}",
                                // data: formData,
                                data:{
                                    _methode : "POST",
                                    _token: "{{ csrf_token() }}",
                                    id_general  : element.id_general,
                                    id_customer_draf  : element.id_customer_draf,
                                    type_usaha  : element.type_usaha,
                                    nama_usaha  : element.nama_usaha,
                                    nama_lengkap    : element.nama_lengkap,
                                    alamat_kantor   : element.alamat_kantor,
                                    jabatan : element.jabatan,
                                    telepon : element.telepon,
                                    mobile_phone    : element.mobile_phone,
                                    email   : element.email,
                                    web_site    : element.web_site,
                                    no_npwp : element.no_npwp,
                                    nama_npwp   : element.nama_npwp,
                                    alamat_npwp : element.alamat_npwp,
                                    nik : element.nik,
                                    ar  : element.ar,
                                    created_date    : element.created_date,
                                    to_data : "localStorage",
                                },
                                // cache: false,
                                // contentType: false,
                                // processData: false,
                                // dataType: 'json',
                                success: (data) => {
                                    if ($.isEmptyObject(data.error)) {
                                        // Swal.fire({
                                        //     icon: 'success',
                                        //     title: 'Berhasil ditambahkan. ',
                                        //     text: 'Data Legal Berhasil ditambahkan.',
                                        //     showConfirmButton: false,
                                        //     timer: 30000
                                        // });
                                        console.log(data);
                                        dataGeneral.splice(element.length, 1)
                                        localStorage.setItem('daftar_general',JSON.stringify(dataGeneral));
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal ditambahkan. ',
                                            text: 'Data General Belum Lengkap.',
                                            showConfirmButton: true,
                                            // timer: 3000
                                        });
                                        // document.getElementsByClassName('submit-legal')[0].style.display = "block";
                                        // document.getElementsByClassName("loading-legal")[0].style.display = "none";
                                    }
                                }
                            });
                        });
                    }

                    if (dataLegal) {
                        dataLegal.forEach(function(element) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('admin/legal/store') }}",
                                // data: formData,
                                data:{
                                    _methode : "POST",
                                    _token: "{{ csrf_token() }}",
                                    id_customer: element.id_customer,
                                    tahun_berdiri : element.tahun_berdiri,
                                    no_siup: element.no_siup,
                                    no_tdp : element.no_tdp,
                                    remarks: element.remarks,
                                    ar: element.ar,
                                    created_date : element.created_date,
                                    to_data : "localStorage",
                                },
                                // cache: false,
                                // contentType: false,
                                // processData: false,
                                // dataType: 'json',
                                success: (data) => {
                                    if ($.isEmptyObject(data.error)) {
                                        // Swal.fire({
                                        //     icon: 'success',
                                        //     title: 'Berhasil ditambahkan. ',
                                        //     text: 'Data Legal Berhasil ditambahkan.',
                                        //     showConfirmButton: false,
                                        //     timer: 30000
                                        // });
                                        console.log(data);
                                        dataLegal.splice(element.length, 1)
                                        localStorage.setItem('daftar_legal',JSON.stringify(dataLegal));
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal ditambahkan. ',
                                            text: 'Data Legal Belum Lengkap.',
                                            showConfirmButton: true,
                                            // timer: 3000
                                        });
                                        // document.getElementsByClassName('submit-legal')[0].style.display = "block";
                                        // document.getElementsByClassName("loading-legal")[0].style.display = "none";
                                    }
                                }
                            });
                        });
                    }

                    if (dataContactPerson) {
                        dataContactPerson.forEach(function(element) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('admin/contact_person/store') }}",
                                // data: formData,
                                data:{
                                    _methode : "POST",
                                    _token: "{{ csrf_token() }}",
                                    id_customer: element.id_customer,
                                    id_outlet: element.id_outlet,
                                    nama_lengkap: element.nama_lengkap,
                                    no_telpon: element.no_telpon,
                                    email: element.email,
                                    jabatan: element.jabatan,
                                    status: element.status,
                                    ar: element.ar,
                                    created_date : element.created_date,
                                    to_data : "localStorage",
                                },
                                // cache: false,
                                // contentType: false,
                                // processData: false,
                                // dataType: 'json',
                                success: (data) => {
                                    if ($.isEmptyObject(data.error)) {
                                        // Swal.fire({
                                        //     icon: 'success',
                                        //     title: 'Berhasil ditambahkan. ',
                                        //     text: 'Data Legal Berhasil ditambahkan.',
                                        //     showConfirmButton: false,
                                        //     timer: 30000
                                        // });

                                        dataContactPerson.splice(element.length, 1)
                                        localStorage.setItem('daftar_contact_person',JSON.stringify(dataContactPerson));
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal ditambahkan. ',
                                            text: 'Data Legal Belum Lengkap.',
                                            showConfirmButton: true,
                                            // timer: 3000
                                        });
                                        // document.getElementsByClassName('submit-legal')[0].style.display = "block";
                                        // document.getElementsByClassName("loading-legal")[0].style.display = "none";
                                    }
                                }
                            });
                        });
                    }

                    if (dataOutlet) {
                        let no = 0;
                        dataOutlet.forEach(function(element) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('admin/outlet/store') }}",
                                // data: formData,
                                data:{
                                    _methode : "POST",
                                    _token: "{{ csrf_token() }}",
                                    id_customer: element.id_customer,
                                    id_outlet: element.id_outlet,
                                    created_date : element.created_date,
                                    ar : element.ar,
                                    nama_outlet : element.nama_outlet,
                                    outlet_type : element.outlet_type,
                                    address_type : element.address_type,
                                    area : element.area,
                                    alamat : element.alamat,
                                    nama_lengkap : element.nama_lengkap,
                                    no_telpon : element.no_telpon,
                                    email : element.email,
                                    jabatan : element.jabatan,
                                    provinsi : element.provinsi,
                                    alamat : element.alamat,
                                    kota : element.kota,
                                    kecamatan : element.kecamatan,
                                    kelurahan : element.kelurahan,
                                    kode_pos : element.kode_pos,
                                    latitude : element.latitude,
                                    longitude : element.longitude,
                                    foto : element.foto,
                                    nama_foto : element.nama_foto,
                                    aplikasi : element.aplikasi,
                                    jumlah_pengambilan : element.jumlah_pengambilan,
                                    status : element.status,
                                    remarks : element.remarks,
                                    to_data : "localStorage",
                                    iteration : no++,
                                },

                                success: (data) => {
                                    if ($.isEmptyObject(data.error)) {
                                        // Swal.fire({
                                        //     icon: 'success',
                                        //     title: 'Berhasil ditambahkan. ',
                                        //     text: 'Data Legal Berhasil ditambahkan.',
                                        //     showConfirmButton: false,
                                        //     timer: 30000
                                        // });
                                        console.log(data);
                                        dataOutlet.splice(element.length, 1)
                                        localStorage.setItem('daftar_outlet',JSON.stringify(dataOutlet));
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal ditambahkan. ',
                                            text: 'Data Outlet Belum Lengkap.',
                                            showConfirmButton: true,
                                            // timer: 3000
                                        });
                                        // document.getElementsByClassName('submit-legal')[0].style.display = "block";
                                        // document.getElementsByClassName("loading-legal")[0].style.display = "none";
                                    }
                                }
                            });
                        });
                    }

                    if (dataDetailDistributor) {
                        dataDetailDistributor.forEach(function(element) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('admin/detail_distributor/store') }}",
                                // data: formData,
                                data:{
                                    _methode : "POST",
                                    _token: "{{ csrf_token() }}",
                                    id_outlet: element.id_outlet,
                                    id_distributor : element.id_distributor,
                                    brand: element.brand_outlet,
                                    status_detail_distributor : element.status_detail_distributor,
                                    ar: element.ar,
                                    created_date : element.created_date,
                                    to_data : "localStorage",
                                },
                                // cache: false,
                                // contentType: false,
                                // processData: false,
                                // dataType: 'json',
                                success: (data) => {
                                    if ($.isEmptyObject(data.error)) {
                                        // Swal.fire({
                                        //     icon: 'success',
                                        //     title: 'Berhasil ditambahkan. ',
                                        //     text: 'Data Legal Berhasil ditambahkan.',
                                        //     showConfirmButton: false,
                                        //     timer: 30000
                                        // });
                                        console.log(data);
                                        dataDetailDistributor.splice(element.length, 1)
                                        localStorage.setItem('daftar_detail_distributor',JSON.stringify(dataDetailDistributor));
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal ditambahkan. ',
                                            text: 'Data Detail Distributor Belum Lengkap.',
                                            showConfirmButton: true,
                                            // timer: 3000
                                        });
                                        // document.getElementsByClassName('submit-legal')[0].style.display = "block";
                                        // document.getElementsByClassName("loading-legal")[0].style.display = "none";
                                    }
                                }
                            });
                        });
                    }

                    if (dataAccount) {
                        dataAccount.forEach(function(element) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('admin/account/store') }}",
                                // data: formData,
                                data:{
                                    _methode : "POST",
                                    _token: "{{ csrf_token() }}",
                                    id_customer: element.id_customer,
                                    payment_trems: element.payment_trems,
                                    id_price: element.id_price,
                                    credit_limit: element.credit_limit,
                                    max_nota: element.max_nota,
                                    bank: element.bank,
                                    atas_nama: element.atas_nama,
                                    no_rek: element.no_rek,
                                    cabang: element.cabang,
                                    status_account: element.status_account,
                                    remarks_account: element.remarks_account,
                                    ar: element.ar,
                                    created_date : element.created_date,
                                    to_data : "localStorage",
                                },
                                // cache: false,
                                // contentType: false,
                                // processData: false,
                                // dataType: 'json',
                                success: (data) => {
                                    if ($.isEmptyObject(data.error)) {
                                        // Swal.fire({
                                        //     icon: 'success',
                                        //     title: 'Berhasil ditambahkan. ',
                                        //     text: 'Data Legal Berhasil ditambahkan.',
                                        //     showConfirmButton: false,
                                        //     timer: 30000
                                        // });
                                        console.log(data);
                                        dataAccount.splice(element.length, 1)
                                        localStorage.setItem('daftar_account',JSON.stringify(dataAccount));
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal ditambahkan. ',
                                            text: 'Data Legal Belum Lengkap.',
                                            showConfirmButton: true,
                                            // timer: 3000
                                        });
                                        // document.getElementsByClassName('submit-legal')[0].style.display = "block";
                                        // document.getElementsByClassName("loading-legal")[0].style.display = "none";
                                    }
                                }
                            });
                        });
                    }

                    if (dataAttachment) {
                        dataAttachment.forEach(function(element) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('admin/attachment/store') }}",
                                // data: formData,
                                data:{
                                    _methode : "POST",
                                    _token: "{{ csrf_token() }}",
                                    id_customer: element.id_customer,
                                    filenames : element.filenames,
                                    namaFile: element.namaFile,
                                    ar: element.ar,
                                    created_date : element.created_date,
                                    to_data : "localStorage",
                                },

                                success: (data) => {
                                    if ($.isEmptyObject(data.error)) {
                                        // Swal.fire({
                                        //     icon: 'success',
                                        //     title: 'Berhasil ditambahkan. ',
                                        //     text: 'Data Legal Berhasil ditambahkan.',
                                        //     showConfirmButton: false,
                                        //     timer: 30000
                                        // });
                                        console.log(data);
                                        dataAttachment.splice(element.length, 1)
                                        localStorage.setItem('daftar_attachment',JSON.stringify(dataAttachment));
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal ditambahkan. ',
                                            text: 'Data Attachment Belum Lengkap.',
                                            showConfirmButton: true,
                                            // timer: 3000
                                        });
                                        // document.getElementsByClassName('submit-legal')[0].style.display = "block";
                                        // document.getElementsByClassName("loading-legal")[0].style.display = "none";
                                    }
                                }
                            });
                        });
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil disinkronkan. ',
                        text: 'Data berhasil tersimpan pada server.',
                        showConfirmButton: false,
                        timer: 30000
                    });

                    let span_spinner = document.querySelector(".span-spinner");
                    let synch_text = "Synchronize";
                    button.removeChild(span_spinner)
                    button.innerHTML = synch_text
                } else {
                    // console.log(localStorage.getItem("HTML5_QRCODE_DATA"))
                    console.log("localstorage kosong")
                    let span_spinner = document.querySelector(".span-spinner");
                    let synch_text = "Synchronize";
                    button.removeChild(span_spinner)
                    button.innerHTML = synch_text
                }
            } else {
                console.log("Oops. browser not suppoted")
                let span_spinner = document.querySelector(".span-spinner");
                let synch_text = "Synch";
                button.removeChild(span_spinner)
                button.innerHTML = synch_text
            }




        }

        function excel_general(){
            //open modal create
            $('#ModalExcelGeneral').modal('show');
        }

        function excel_outlet(){
            //open modal create
            $('#ModalExcelOutlet').modal('show');
        }

        function scan_qrcode(){
            //open modal create
            $('#ModalScanQrcode').modal('show');
        }

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            $('#hasil_qrcode').val(decodedText);
            let id = decodedText;
            html5QrcodeScanner.clear().then(_ => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({

                    url: "{{ route('generals.scan') }}",
                    type: 'POST',
                    data: {
                        _methode : "POST",
                        // _token: CSRF_TOKEN,
                        _token: "{{ csrf_token() }}",
                        qr_code : id
                    },
                    success: function (response) {
                        // console.log(response);
                        if(response.status == 400){
                            // JIKA DATA TIDAK DITEMUKAN
                            // console.log("data tidak ada");
                            // alert("tidak ada data");
                            Swal.fire({
                                icon: 'error',
                                title: 'Id outlet tidak ditemukan, Ingin scan ulang?',
                                confirmButtonText: 'Ya, Scan ulang',
                                denyButtonText: 'CANCEL',
                            }).then((result) => {
                                if(result.isConfirmed) {
                                    location.reload();
                                } else if (result.isDismissed) {
                                    console.log("hadehh");
                                }
                            })
                        }else{
                            // JIKA DATA DITEMUKAN
                            // alert("ada data " + response.status +" "+ response.id_general);
                            // console.log("ada data");
                            // console.log(response.id_general.id_general);
                            // console.log(JSON.parse(response));
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Ditemukan. ',
                                text: 'Data Id Outlet Ditemukan.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            window.location = response.url
                        }
                    }
                });
            }).catch(error => {
                alert('something wrong');
            });
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);

        function destroyGeneral(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin mengapus data ini ?',
                showCancelButton: !0,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/generals/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data General Berhasil dihapus.',
                                showConfirmButton: true,
                                timer: 3000
                            });
                            location.reload();
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            });
        }
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
