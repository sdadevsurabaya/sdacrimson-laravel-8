@extends('layouts.master')
@section('title')
    @lang('Cabang')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Hari Libur
        @endslot
        @slot('title')
            List Hari Libur
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
                <div class="card-body d-flex justify-content-end">
                    {{-- @can('brand-create') --}}
                    <button class="btn btn-success" onclick="create()">Tambah Hari Libur</button>
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
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach ($data as $key => $values)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $values->tanggal }}</td>
                                        <td>{{ $values->keterangan }}</td>
                                        <td>
                                            <button class="btn btn-medium btn-success"
                                                onclick="update({{ $values->id }})">Edit</button>
                                            <button class="btn btn-medium btn-danger"
                                                onclick="destroyArea({{ $values->id }})">Hapus</button>
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

    {{-- modal create --}}
    <div class="modal fade" id="ModalCreateArea" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Hari Libur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="create_area" method="POST" action="javascript:void(0)" accept-charset="utf-8"
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
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan"
                                    placeholder="Contoh: Hari Kemerdekaan Indonesia">
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
    <div class="modal fade" id="ModalUpdateArea" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Area</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit" style="display:none">
                        <ul></ul>
                    </div>

                    <form id="form-update-cabang" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                        @csrf
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                        @endphp

                        <input type="hidden" name="id" id="id_update" value="">
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal_update"
                                    placeholder="Contoh: Surabaya" required>
                                <div class="invalid-feedback" id="cabang-error"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan_update"
                                    placeholder="Contoh: Hari Raya Idul Fitri" required>
                                <div class="invalid-feedback" id="cabang-error"></div>
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
        function create() {
            //open modal create
            $('#ModalCreateArea').modal('show');
        }

        // proses submit type outlet
        $('#create_area').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ route('libur.store') }}",
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
                            text: 'Data Area Berhasil ditambahkan.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{ url('admin/libur') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahkan. ',
                            text: 'Data Area Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                    }
                }
            });
        });

        // show modal edit type outlet
        function update(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/libur/') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_update').val(response.data.id);
                    $('#created_date_update').val(response.data.created_date);
                    $('#created_by_update').val(response.data.created_by);
                    $('#tanggal_update').val(response.data.tanggal);
                    $('#keterangan_update').val(response.data.keterangan);
                    //open modal
                    $('#ModalUpdateArea').modal('show');
                }
            });
        }

        // proses update type outlet
        $('#form-update-cabang').submit(function(e) {
            e.preventDefault();
            let id = $('#id_update').val();
            var formData = new FormData(this);
            // console.log(id);
            // console.log(formData2);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/libur/update') }}/" + id,
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
                            text: 'Data Area Berhasil diubah.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{ url('admin/libur') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal diubah. ',
                            text: 'Data Area Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                    }
                }
            });
        });

        function destroyArea(id) {
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
                        url: "{{ url('admin/libur/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Area Berhasil dihapus.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            window.location.href = "{{ url('admin/libur') }}";
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
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
