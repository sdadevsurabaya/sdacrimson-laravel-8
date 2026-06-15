@extends('layouts.master')
@section('title')
    @lang('Master Area Customer')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Area Customer
        @endslot
        @slot('title')
            List Master Area Customer
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success" onclick="create()"> Buat Area Customer Baru</button>
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
                                    <th>ID</th>
                                    <th>Area</th>
                                    <th>Kota</th>
                                    <th>Deskripsi</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_Area as $key => $data)
                                    <tr>
                                        <td>{{ $data->kode_area ?? '-' }}</td>
                                        <td>{{ $data->nama_area }}</td>
                                        <td>{{ $data->kota }}</td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>
                                            <button class="btn btn-medium btn-success" onclick="update({{ $data->id }})">Edit</button>
                                            <button class="btn btn-medium btn-danger" onclick="destroyArea({{ $data->id }})">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal create --}}
    <div class="modal fade" id="ModalCreateArea" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Area Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="create_area" method="POST" action="javascript:void(0)" accept-charset="utf-8">
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Area</label>
                                <input type="text" class="form-control" name="nama_area" id="nama_area" placeholder="Contoh: Sidoarjo Utara">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" class="form-control" name="kota" id="kota" placeholder="Contoh: Sidoarjo">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Area</label>
                                <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Contoh: Meliputi kec. gedangan, waru">
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
    <div class="modal fade" id="ModalUpdateArea" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Area Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_area" method="POST" action="javascript:void(0)" accept-charset="utf-8">
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="id_update" id="id_update" value="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Area</label>
                                <input type="text" class="form-control" name="nama_area_update" id="nama_area_update">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" class="form-control" name="kota_update" id="kota_update">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Area</label>
                                <input type="text" class="form-control" name="deskripsi_update" id="deskripsi_update">
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
        function create(){
            $('#ModalCreateArea').modal('show');
        }

        $('#create_area').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/area-customer/store') }}",
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
                            text: 'Data Area Berhasil ditambahkan.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "{{url('admin/area-customer')}}";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahkan.',
                            text: 'Data Area Belum Lengkap.',
                            showConfirmButton: true,
                        });
                    }
                }
            });
        });

        function update(id) {
            $.ajax({
                url: "{{ url('admin/area-customer/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    $('#id_update').val(response.data.id);
                    $('#nama_area_update').val(response.data.nama_area);
                    $('#kota_update').val(response.data.kota);
                    $('#deskripsi_update').val(response.data.deskripsi);
                    $('#ModalUpdateArea').modal('show');
                }
            });
        }

        $('#update_area').submit(function(e) {
            e.preventDefault();
            let id = $('#id_update').val();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/area-customer/update') }}/"+ id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil diubah.',
                            text: 'Data Area Berhasil diubah.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "{{url('admin/area-customer')}}";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal diubah.',
                            text: 'Data Area Belum Lengkap.',
                            showConfirmButton: true,
                        });
                    }
                }
            });
        });

        function destroyArea(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin mengapus data ini?',
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                reverseButtons: true
            }).then(function (e) {
                if (e.value === true) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/area-customer/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data.',
                                text: 'Data Area Berhasil dihapus.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "{{url('admin/area-customer')}}";
                            });
                        }
                    });
                }
            });
        }
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
