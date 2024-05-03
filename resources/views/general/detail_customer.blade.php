@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Lightbox -->
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            General
        @endslot
        @slot('title')
            Detail General {{ $general[0]->type_usaha }} {{ $general[0]->nama_usaha }}
        @endslot
    @endcomponent
    <style>
        .form-control {
            border: none;
        }
    </style>

    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                01
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">General</h5>
                        <p class="text-muted text-truncate mb-0">Detail General Customer
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-xl-6">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">ID
                                    Customer</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->id_customer }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Type
                                    Usaha</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->type_usaha }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Nama
                                    Usaha</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->nama_usaha }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Nama
                                    Lengkap</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->nama_lengkap }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input"
                                    class="col-3 col-md-2 col-xl-2 col-form-label">Jabatan</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->jabatan }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input"
                                    class="col-3 col-md-2 col-xl-2 col-form-label">Telepon</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->telepon }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input"
                                    class="col-3 col-md-2 col-xl-2 col-form-label">Mobile</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->mobile_phone }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Email</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->email_general }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-6">
                            <div class="mb-3 row">
                                <label for="example-text-input"
                                    class="col-3 col-md-2 col-xl-2 col-form-label">Website</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->web_site }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">NO
                                    NPWP</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->no_npwp }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Nama
                                    NPWP</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->nama_npwp }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Alamat
                                    NPWP</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->alamat_npwp }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">NIK</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->nik }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">AR</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->ar }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Dibuat
                                    Oleh</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->created_by }}</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-3 col-md-2 col-xl-2 col-form-label">Tanggal
                                    Dibuat</label>
                                <div class="col-9 col-md-9 col-xl-9">:
                                    <label class="col-form-label">{{ $general[0]->created_date }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                02
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">Legal</h5>
                        <p class="text-muted text-truncate mb-0">Detail Legal
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-legal" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>ID Customer</th>
                                    <th>Tahun Berdiri</th>
                                    <th>No Siup</th>
                                    <th>No TDP</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>

                                    <th>AR</th>

                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($legal as $key => $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->id_customer }}</td>
                                        <td>{{ $data->tahun_berdiri }}</td>
                                        <td>{{ $data->no_siup }}</td>
                                        <td>{{ $data->no_tdp }}</td>
                                        <td>{{ $data->remarks_legal }}</td>
                                        <td>{{ $data->status_legal }}</td>
                                        <td>{{ $data->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-6">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                03
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">Kontak</h5>
                        <p class="text-muted text-truncate mb-0">Detail & Daftar Kontak
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-kontak" class="table table-bordered dt-responsive nowrap"
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

                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($kontak as $key => $data)
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                04
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">Akun</h5>
                        <p class="text-muted text-truncate mb-0">Detail Akun
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-account" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>ID Customer</th>
                                    <th>Syarat Pembayaran</th>
                                    <th>ID Price</th>
                                    <th>Kredit Limit</th>
                                    <th>Max Nota</th>
                                    <th>Bank</th>
                                    <th>Atas Nama</th>
                                    <th>No Rek</th>
                                    <th>Cabang</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>AR</th>

                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($account as $key => $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->id_customer }}</td>
                                        <td>{{ $data->payment_trems }}</td>
                                        <td>{{ $data->id_price }}</td>
                                        <td>Rp. {{ number_format($data->credit_limit, 2, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($data->max_nota, 2, ',', '.') }}</td>
                                        <td>{{ $data->bank }}</td>
                                        <td>{{ $data->atas_nama }}</td>
                                        <td>{{ $data->no_rek }}</td>
                                        <td>{{ $data->cabang }}</td>
                                        <td>{{ $data->status_account }}</td>
                                        <td>{{ $data->remarks_account }}</td>
                                        <td>{{ $data->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-6">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                05
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">Lampiran</h5>
                        <p class="text-muted text-truncate mb-0">Detail & Daftar Lampiran
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach ($attachment as $data)
                            @php
                                $filesAttachment = explode(',', $data->files);
                                $namaFilesAttachment = explode(',', $data->nama_files);
                            @endphp

                            @for ($i = 0; $i < count($filesAttachment); $i++)
                                @php
                                    $ext = pathinfo($filesAttachment[$i]);
                                    $finalExt = $ext['extension'];
                                    // dump($finalExt);
                                @endphp
                                @if ($finalExt == 'pdf')
                                    <div class="col-xl-4 col-md-6 col-4" style="align-self: center">
                                        <div class="text-center text-gray">
                                            <a href="{{ asset('files/' . $filesAttachment[$i]) }}" target="_blank"
                                                style=" color:gray;">
                                                <i class="bx bxs-file-pdf" style="font-size: 100px;"></i>
                                            </a>
                                            <span style="font-size: 18px">
                                                <h5>{{ $namaFilesAttachment[$i] }}</h5>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- @elseif ($finalExt == "png") --}}
                                @else
                                    <div class="col-xl-4 col-md-6 col-4 ">
                                        <a class="image-popup-no-margins"
                                            href="{{ asset('files/' . $filesAttachment[$i]) }}">
                                            <img src="{{ asset('files/' . $filesAttachment[$i]) }}"
                                                class="img-fluid mb-3">
                                        </a>
                                        <span style="font-size: 14px"><b>{{ $namaFilesAttachment[$i] }}</b></span>
                                    </div>
                                @endif
                            @endfor
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="avatar-xs">
                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                06
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">Outlet</h5>
                        <p class="text-muted text-truncate mb-0">Detail & Daftar Outlet
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- looping start --}}

                        <div class="col-md-12">
                            <div id="addproduct-accordion" class="custom-accordion">
                                <div class="row">
                                    @for ($i = 0; $i < count($outlet); $i++)
                                        <div class="card col-md-12 col-lg-6 ">
                                            <a href="#addproduct-billinginfo-collapse{{ $i }}"
                                                class="text-dark collapsed" data-bs-toggle="collapse"
                                                aria-expanded="false"
                                                aria-controls="addproduct-billinginfo-collapse{{ $i }}">
                                                <div class="p-4">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="font-size-16 mb-1">
                                                                {{ $outlet[0]->type_usaha . ' ' . $outlet[0]->nama_usaha }}
                                                            </h5>
                                                            <p class="text-muted text-truncate mb-0"><i
                                                                    class="uil-location-point me-1"></i>{{ $outlet[$i]->alamat }}
                                                            </p>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <button type="button" class="btn btn-light waves-effect"
                                                                data-bs-dismiss="modal">Lihat</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div id="addproduct-billinginfo-collapse{{ $i }}" class="collapse"
                                                data-bs-parent="#addproduct-accordion" style="">
                                                <div class="p-4 border-top">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-md-12">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">ID
                                                                    Customer</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->id_customer }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">ID
                                                                    Outlet</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->id_outlet }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Nama
                                                                    Outlet</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->nama_outlet }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Type
                                                                    Outlet</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->outlet_type }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Area Outlet</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->area }}/{{ $outlet[$i]->detail }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Type
                                                                    Alamat</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->address_type }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Provinsi</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->provinsi }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Kota</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->kota }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Kecamatan</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->kecamatan }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Kelurahan</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->kelurahan }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Kode
                                                                    Pos</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->kode_pos }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                class="col-3 col-md-3 col-xl-3 col-form-label">Distributor / Brand</label>

                                                                @php
                                                                    $no = 1;
                                                                    $detail_customers = DB::table('detail_customers')
                                                                        ->join('customers', 'customers.id_cust', '=', 'detail_customers.id_cust')
                                                                        ->select('*')
                                                                        ->where('id_outlet', $outlet[$i]->id_outlet)
                                                                        ->get();

                                                                    // dump($data);
                                                                @endphp

                                                                <div class="col-9 col-md-9 col-xl-9">
                                                                    @foreach ($detail_customers as $data)
                                                                        : <label class="col-form-label"> {{$no++}}. {{$data->id_cust}}|{{$data->nama_cust}} / {{$data->brand}}</label> <br>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Aplikasi</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->aplikasi }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Jumlah Pengambilan</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->jumlah_pengambilan }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Status</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->status }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Keterangan</label>
                                                                <div class="col-9 col-md-8">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->remarks_outlet }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label">Titik
                                                                    GPS</label>
                                                                <div class="col-md-12">
                                                                    <iframe
                                                                        src="https://maps.google.com/maps?q={{ $outlet[$i]->latitude }},{{ $outlet[$i]->longitude }}&z=15&output=embed"
                                                                        width="100%" height="500" frameborder="0"
                                                                        style="border:0"></iframe>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-4 col-md-3 col-xl-3 col-form-label">Alamat
                                                                    Outlet</label>
                                                                <div class="col-8 col-md-8 col-xl-9">:
                                                                    <label
                                                                        class="col-form-label">{{ $outlet[$i]->alamat }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input"
                                                                    class="col-3 col-md-3 col-xl-3 col-form-label m-0">Foto</label>
                                                                @php
                                                                    $images_outlet = DB::table('images_outlet')
                                                                        ->select('*')
                                                                        ->where('id_outlet', $outlet[$i]->id)
                                                                        ->get();

                                                                    // dump(count($images_outlet));

                                                                @endphp

                                                                @if (count($images_outlet) == 0)
                                                                    <h4>Foto tidak ada.</h4>
                                                                @else
                                                                    <p class="card-title-desc">Klik untuk memperbesar
                                                                        gambar</p>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            @foreach ($images_outlet as $data)
                                                                                <div class="col-4 col-md-4">
                                                                                    <a class="image-popup-no-margins"
                                                                                        href="{{ asset('files/' . $data->foto) }}">
                                                                                        <img class="img-fluid"
                                                                                            alt=""
                                                                                            src="{{ asset('files/' . $data->foto) }}"
                                                                                            width="175">
                                                                                    </a>
                                                                                    <p style="font-size: 14px;">
                                                                                        {{ $data->nama_foto }}</p>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3 row">
                                                                @if ($outlet[$i]->status_generate_qrcode == 1)
                                                                    <label for="example-text-input"
                                                                        class="col-3 col-md-3 col-xl-3 col-form-label">QRCode
                                                                        Outlet</label>
                                                                    <div class="col-md-12">
                                                                        <a class="image-popup-no-margins"
                                                                            href="{{ asset('qrcode/' . $outlet[$i]->id_outlet . '.svg') }}">
                                                                            <img class="img-fluid mb-2" alt=""
                                                                                src="{{ asset('qrcode/' . $outlet[$i]->id_outlet . '.svg') }}"
                                                                                width="175">
                                                                        </a>
                                                                        <p style="font-size: 14px;">
                                                                            {{ $outlet[$i]->id_outlet }}</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div class="col-12 text-center">
        <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a>
        @if (Auth::user()->hasRole('Verifikator') == 1)
            @if (count($status_data) > 0)
                <button type="submit" class="btn btn-primary"
                    onclick="ShowEditModalStatusData({{ $status_data[0]->id_status_data }})">Edit Status Data</button>
            @else
                <button type="submit" class="btn btn-primary" onclick="ShowModalStatusData()">Status Data</button>
            @endif
        @endif
    </div>

    <!-- Modal Insert Status Data-->
    <div class="modal fade" id="ModalStatusData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">From Status Data Validator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-status-data" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="insert_status_data" method="POST" action="javascript:void(0)" accept-charset="utf-8"
                        enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            @php
                                date_default_timezone_set('Asia/Jakarta');
                            @endphp

                            <div class="mb-3">
                                <label class="form-label" for="tahun_berdiri">ID Customer</label>
                                <input type="hidden" class="form-control" name="id_customer" id="id_customer"
                                    value="{{ $general[0]->id_general }}">
                                <input type="text" class="form-control" name="code_customer" id="code_customer"
                                    value="{{ $general[0]->id_customer }}" readonly>
                                <input type="hidden" class="form-control" name="created_date" id="created_date"
                                    value="{{ date('Y-m-d') }}">
                                <input type="hidden" class="form-control" name="created_time" id="created_time"
                                    value="{{ date('H:i:s') }}">
                                <input type="hidden" class="form-control" name="id_user_validator"
                                    id="id_user_validator" value="{{ Str::ucfirst(Auth::user()->id) }}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="status_data">Status Data</label>
                                <select class="form-select status_data" name="status_data" id="floatingSelectGrid"
                                    aria-label="Floating label select example">
                                    {{-- <option value="">-- Pilih Status --</option> --}}
                                    <option value="Valid" selected>Valid</option>
                                    <option value="Tidak Valid">Tidak Valid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <label class="col-package-label" for="remarks">Keterangan</label>
                            <div class="">
                                <textarea class="form-control" style="height:150px" name="remarks_status_data" id="remarks_status_data"
                                    placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Status Data-->
    <div class="modal fade" id="ModalEditStatusData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">From Update Status Data Validator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-status-data" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="update_status_data" method="POST" action="javascript:void(0)" accept-charset="utf-8"
                        enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            @php
                                date_default_timezone_set('Asia/Jakarta');
                            @endphp

                            <div class="mb-3">
                                <label class="form-label" for="tahun_berdiri">ID Customer</label>
                                <input type="hidden" class="form-control" name="id_status_data_edit"
                                    id="id_status_data_edit" value="">
                                <input type="text" class="form-control" name="id_customer_edit" id="id_customer_edit"
                                    value="" readonly>
                                <input type="hidden" class="form-control" name="created_date_edit"
                                    id="created_date_edit" value="">
                                <input type="hidden" class="form-control" name="created_time_edit"
                                    id="created_time_edit" value="">
                                <input type="hidden" class="form-control" name="id_user_validator_edit_old"
                                    id="id_user_validator_edit_old" value="">
                                <input type="hidden" class="form-control" name="update_date_edit" id="update_date_edit"
                                    value="{{ date('Y-m-d') }}">
                                <input type="hidden" class="form-control" name="update_time_edit" id="update_time_edit"
                                    value="{{ date('H:i:s') }}">
                                <input type="hidden" class="form-control" name="id_user_validator_edit"
                                    id="id_user_validator_edit" value="{{ Str::ucfirst(Auth::user()->id) }}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="status_data">Status Data</label>
                                <select class="form-select status_data_edit" name="status_data_edit"
                                    id="floatingSelectGrid" aria-label="Floating label select example">
                                    {{-- <option value="">-- Pilih Status --</option> --}}
                                    <option value="Valid" selected>Valid</option>
                                    <option value="Tidak Valid">Tidak Valid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <label class="col-package-label" for="remarks">Keterangan</label>
                            <div class="">
                                <textarea class="form-control" style="height:150px" name="remarks_status_data_edit" id="remarks_status_data_edit"
                                    placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable-kontak').DataTable();
            $('#datatable-legal').DataTable();
            $('#datatable-account').DataTable();
        });

        // show modal insert status data
        function ShowModalStatusData() {
            $('#ModalStatusData').modal('show');
        }

        // proses insert status data
        $('#insert_status_data').submit(function(e) {
            e.preventDefault();
            // let id = $('#id_edit_legal').val();
            var formData = new FormData(this);
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "{{ url('admin/status_data/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);
                        location.reload();
                        $('#ModalStatusData').modal('hide');
                    } else {
                        $(".error-status-data").find("ul").html('');
                        $(".error-status-data").css('display', 'block');
                        $.each(data.error, function(key, value) {
                            $(".error-status-data").find("ul").append('<li>' + value + '</li>');
                        });
                    }
                }
            });
        });

        // show modal edit status data
        function ShowEditModalStatusData(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/status_data/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_status_data_edit').val(response.data.id);
                    $('#id_customer_edit').val(response.data.id_customer);
                    $('#created_date_edit').val(response.data.created_date);
                    $('#created_time_edit').val(response.data.created_time);
                    $('#id_user_validator_edit_old').val(response.data.created_by);
                    $('[name="status_data_edit"]').val(response.data.status_data);
                    $('#remarks_status_data_edit').val(response.data.remarks);
                    //open modal
                    $('#ModalEditStatusData').modal('show');
                }
            });
        }

        // proses update status data
        $('#update_status_data').submit(function(e) {
            e.preventDefault();
            let id = $('#id_status_data_edit').val();
            var formData = new FormData(this);
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "{{ url('admin/status_data/update') }}/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);
                        location.reload();
                        $('#ModalStatusData').modal('hide');
                    } else {
                        $(".error-status-data").find("ul").html('');
                        $(".error-status-data").css('display', 'block');
                        $.each(data.error, function(key, value) {
                            $(".error-status-data").find("ul").append('<li>' + value + '</li>');
                        });
                    }
                }
            });
        });
    </script>

    <!-- Magnific Popup-->
    <script src="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.js') }}"></script>
    <!-- lightbox init js-->
    <script src="{{ URL::asset('/assets/js/pages/lightbox.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
