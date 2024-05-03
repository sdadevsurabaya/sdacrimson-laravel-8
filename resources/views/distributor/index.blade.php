@extends('layouts.master')
@section('title')
    @lang('Distibutor')
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
            Distributor
        @endslot
        @slot('title')
            Distributor
        @endslot
    @endcomponent

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- @include('sweetalert::alert') --}}

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    {{-- @can('brand-create') --}}
                    <button class="btn btn-success" onclick="create()"> Buat Distributor Baru</button>
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
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Type Usaha</th>
                                    <th>Nama Distributor</th>
                                    <th>Type Alamat</th>
                                    <th>Alamat</th>
                                    <th>Provinsi</th>
                                    <th>Kota</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>Kode Pos</th>
                                    <th>Latitude</th>
                                    <th>Longtitude</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_Distributor as $key => $data)
                                    <?php $no = 1; ?>
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $data->type_usaha }}</td>
                                        <td>{{ $data->nama_cust }}</td>
                                        <td>{{ $data->address_type }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->provinsi }}</td>
                                        <td>{{ $data->kota }}</td>
                                        <td>{{ $data->kecamatan }}</td>
                                        <td>{{ $data->kelurahan }}</td>
                                        <td>{{ $data->kode_pos }}</td>
                                        <td>{{ $data->latitude }}</td>
                                        <td>{{ $data->longtitude }}</td>

                                        <td>
                                            <button class="btn btn-medium btn-success"
                                                onclick="update({{ $data->id }})">Edit</button>
                                            <button class="btn btn-medium btn-danger"
                                                onclick="destroyDist({{ $data->id }})">Hapus</button>
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

    {{-- modat add --}}
    <div class="modal fade" id="ModalCreateDistributor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Distributor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="create_dist" method="POST" action="javascript:void(0)" accept-charset="utf-8"
                        enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                        @endphp
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="created_date" id="created_date"
                                    value="{{ date('Y-m-d') }}">
                                <input type="hidden" class="form-control" name="created_by" id="created_by"
                                    value="{{ Str::ucfirst(Auth::user()->id) }}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">ID Distributor</label>
                                <input type="text" class="form-control" name="id_dist" id="id_dist"
                                    placeholder="Contoh: ABC55643">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Type Usaha</label>
                                <input type="text" class="form-control" name="type_usaha" id="type_usaha"
                                    placeholder="Contoh: Distributor">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Distributor</label>
                                <input type="text" class="form-control" name="nama_dist" id="nama_dist"
                                    placeholder="Contoh: Sari Pangan Abadi">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Type Alamat</label>
                                <select class="js-select2-multi brand address_type" name="address_type[]" id="address_type"
                                    multiple="multiple">
                                    <option value="Penagihan">Penagihan</option>
                                    <option value="Pengiriman">Pengiriman</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat"
                                    placeholder="Contoh: Jl. Ahmad Yani No. 12">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <select class="form-select provinsi_add_dist" name="provinsi_add_dist"
                                    id="provinsi_add_dist" aria-label="Floating label select example">
                                    <option value="0" selected="" disabled="">--
                                        Pilih Provinsi --</option>
                                    @foreach ($dist as $data)
                                        <option value="{{ $data->province_name }}">
                                            {{ $data->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <select class="form-select kota_add_dist" name="kota_add_dist" id="kota_add_dist"
                                    aria-label="Floating label select example">
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kecamatan</label>
                                <select class="form-select kecamatan_add_dist" name="kecamatan_add_dist"
                                    id="kecamatan_add_dist" aria-label="Floating label select example">
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kelurahan</label>
                                <select class="form-select kelurahan_add_dist" name="kelurahan_add_dist"
                                    id="kelurahan_add_dist" aria-label="Floating label select example">
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="kode_pos_add_dist">Kode
                                    Pos</label>
                                <input type="text" class="form-control" name="kode_pos_add_dist"
                                    id="kode_pos_add_dist" placeholder="Kode Pos akan terisi otomatis" readonly>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control" name="lat" id="lat"
                                    placeholder="Contoh: -654623.2311">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Longtitude</label>
                                <input type="text" class="form-control" name="longtitude" id="longtitude"
                                    placeholder="Contoh: 213546987.3213">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal update --}}
    <div class="modal fade" id="ModalUpdateDistributor" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Distributor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="update_dist" method="POST" action="javascript:void(0)" accept-charset="utf-8"
                        enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                        @endphp
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="id_update" id="id_update"
                                    value="">
                                <input type="hidden" class="form-control" name="created_date_update"
                                    id="created_date_update" value="">
                                <input type="hidden" class="form-control" name="created_by_update"
                                    id="created_by_update" value="">
                                <input type="hidden" class="form-control" name="update_date" id="update_date"
                                    value="{{ date('Y-m-d') }}">
                                <input type="hidden" class="form-control" name="update_by" id="update_by"
                                    value="{{ Str::ucfirst(Auth::user()->id) }}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">ID Distributor</label>
                                <input type="text" class="form-control" name="id_dist_update" id="id_dist_update"
                                    placeholder="Contoh: ABC55643">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Type Usaha</label>
                                <input type="text" class="form-control" name="type_update" id="type_update"
                                    placeholder="Contoh: Distributor">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Distributor</label>
                                <input type="text" class="form-control" name="nama_dist_update" id="nama_dist_update"
                                    placeholder="Contoh: Sari Pangan Abadi">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Type Alamat</label>
                                <select class="js-select2-multi brand address_type_update" name="address_type_update[]"
                                    id="address_type_update" multiple="multiple">
                                    <option value="Penagihan">Penagihan</option>
                                    <option value="Pengiriman">Pengiriman</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat_update" id="alamat_update"
                                    placeholder="Contoh: Jl. Ahmad Yani No. 12">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <select class="form-select provinsi_update_dist" name="provinsi_update_dist"
                                    id="provinsi_update_dist" aria-label="Floating label select example">
                                    <option value="0" selected="" disabled="">--
                                        Pilih Provinsi --</option>
                                    @foreach ($dist as $data)
                                        <option value="{{ $data->province_name }}">
                                            {{ $data->province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <select class="form-select kota_update_dist" name="kota_update_dist"
                                    id="kota_update_dist" aria-label="Floating label select example">
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kecamatan</label>
                                <select class="form-select kecamatan_update_dist" name="kecamatan_update_dist"
                                    id="kecamatan_update_dist" aria-label="Floating label select example">
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kelurahan</label>
                                <select class="form-select kelurahan_update_dist" name="kelurahan_update_dist"
                                    id="kelurahan_update_dist" aria-label="Floating label select example">
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="kode_pos_update_dist">Kode
                                    Pos</label>
                                <input type="text" class="form-control" name="kode_pos_update_dist"
                                    id="kode_pos_update_dist" placeholder="Kode Pos akan terisi otomatis" readonly>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control" name="lat_update" id="lat_update"
                                    placeholder="Contoh: -654623.2311">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Longtitude</label>
                                <input type="text" class="form-control" name="longtitude_update"
                                    id="longtitude_update" placeholder="Contoh: 213546987.3213">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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
            $(".js-select2-multi").select2();
            // handlePermission(this);
        });

        function create() {
            //open modal create
            $('#ModalCreateDistributor').modal('show');
        }

        function update(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/distributor/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_update').val(response.data.id);
                    $('#id_dist_update').val(response.data.id_cust);
                    $('#type_update').val(response.data.type_usaha);
                    $('#nama_dist_update').val(response.data.nama_cust);
                    var strArrayAddressType = response.data.address_type.split(",");
                    $("#address_type_update").select2().val(strArrayAddressType).change();
                    $('#alamat_update').val(response.data.alamat);
                    $('#provinsi_update_dist').val(response.data.provinsi);
                    $.get("{{ url('admin/distributor/get_kota_edit_dist') }}/" + id, function(data) {
                        $('#kota_update_dist').html(data);
                    });
                    $.get("{{ url('admin/distributor/get_kecamatan_edit_dist') }}/" + id, function(data) {
                        $('#kecamatan_update_dist').html(data);
                    });
                    $.get("{{ url('admin/distributor/get_kelurahan_edit_dist') }}/" + id, function(data) {
                        $('#kelurahan_update_dist').html(data);
                    });
                    $('#kode_pos_update_dist').val(response.data.kode_pos);
                    $('#lat_update').val(response.data.latitude);
                    $('#longtitude_update').val(response.data.longtitude);

                    //open modal
                    $('#ModalUpdateDistributor').modal('show');
                }
            });
        }

        // get alamat by api jne create
        $("#provinsi_add_dist").on("change", function() {
            var provinsi = $('#provinsi_add_dist').val();
            // console.log(provinsi);
            $.get("{{ url('admin/outlet/get_kota') }}/" + provinsi, function(data) {
                //  console.log(data);
                $('#kota_add_dist').html(data);
                // $('#kecamatan').prop('selectedIndex', 0);
            });
        });

        $("#kota_add_dist").on("change", function() {
            var p = $('#provinsi_add_dist').val();
            var d = $('#kota_add_dist').val();
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
                    $("#kecamatan_add_dist").html(ajaxData);
                }
            });
            // $.get("{{ url('admin/outlet/get_kecamatan') }}/" + kota, function(data){
            // //  console.log(data);
            //     $('#kecamatan').html(data);
            //     // $('#kecamatan').prop('selectedIndex', 0);
            // });
        });
        $("#kecamatan_add_dist").on("change", function() {
            var p = $('#provinsi_add_dist').val();
            var d = $('#kota_add_dist').val();
            var s = $('#kecamatan_add_dist').val();
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
                    $("#kelurahan_add_dist").html(ajaxData);
                }
            });
            // $.get("{{ url('admin/outlet/get_kelurahan') }}/" + kecamatan, function(data){
            // //  console.log(data);
            //     $('#kelurahan').html(data);
            //     // $('#kecamatan').prop('selectedIndex', 0);
            // });
        });
        $("#kelurahan_add_dist").on("change", function() {
            var p = $('#provinsi_add_dist').val();
            var d = $('#kota_add_dist').val();
            var s = $('#kecamatan_add_dist').val();
            var u = $('#kelurahan_add_dist').val();
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
                    $("#kode_pos_add_dist").val(ajaxData);
                }
            });
        });

        // proses submit distrubutor
        $('#create_dist').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/distributor/store') }}",
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
                            text: 'Data Distributor Berhasil ditambahkan.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{ url('admin/distributor') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahkan. ',
                            text: 'Data Distributor Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                    }
                }
            });
        });

        // proses update type outlet
        $('#update_dist').submit(function(e) {
            e.preventDefault();
            let id = $('#id_update').val();
            var formData = new FormData(this);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{url('admin/distributor/update')}}/" + id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil diubah. ',
                            text: 'Data Distributor Berhasil diubah.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{ url('admin/distributor') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal diubah. ',
                            text: 'Data Distributor Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                    }
                }
            });
        });

        function destroyDist(id) {
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
                        url: "{{ url('admin/distributor/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Distributor Berhasil dihapus.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            window.location.href = "{{ url('admin/distrbutor') }}";
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
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
