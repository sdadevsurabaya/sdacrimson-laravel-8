@extends('layouts.master')
@section('title')
    @lang('Bank')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Bank
        @endslot
        @slot('title')
            List Bank
        @endslot
    @endcomponent

    @if(session()->has('success'))
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
                    {{-- @can('bank-create') --}}
                    <button class="btn btn-success" onclick="create()"> Buat Bank Baru</button>
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
                                    <th>Bank</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_Bank as $key => $data)
                                    <?php $no = 1; ?>
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $data->bank }}</td>
                                        <td>
                                            <button class="btn btn-medium btn-success" onclick="update({{ $data->id }})">Edit</button>
                                            <button class="btn btn-medium btn-danger" onclick="destroyBank({{ $data->id }})">Hapus</button>
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
    <div class="modal fade" id="ModalCreateBank" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="create_bank" method="POST" action="javascript:void(0)"
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
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Bank</label>
                                <input type="text" class="form-control"
                                    name="bank"
                                    id="bank" placeholder="Contoh: Mandiri">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal update --}}
    <div class="modal fade" id="ModalUpdateBank" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="update_bank" method="POST" action="javascript:void(0)"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        @php
                            date_default_timezone_set('Asia/Jakarta');
                        @endphp
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control"
                                    name="id_update"
                                    id="id_update" value="">
                                <input type="hidden" class="form-control"
                                    name="created_date_update"
                                    id="created_date_update" value="">
                                <input type="hidden" class="form-control"
                                    name="created_by_update" id="created_by_update"
                                    value="">
                                <input type="hidden" class="form-control"
                                    name="update_date"
                                    id="update_date" value="{{ date('Y-m-d') }}">
                                <input type="hidden" class="form-control"
                                    name="update_by" id="update_by"
                                    value="{{ Str::ucfirst(Auth::user()->id) }}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Bank</label>
                                <input type="text" class="form-control"
                                    name="bank_update"
                                    id="bank_update" placeholder="Contoh: Mandiri">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"
                                data-bs-dismiss="modal">Close</button>
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
            //open modal create
            $('#ModalCreateBank').modal('show');
        }

        // proses submit type outlet
        $('#create_bank').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/bank/store') }}",
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
                            text: 'Data Bank Berhasil ditambahkan.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{url('admin/bank')}}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahkan. ',
                            text: 'Data Bank Belum Lengkap.',
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
                url: "{{ url('admin/bank/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_update').val(response.data.id);
                    $('#created_date_update').val(response.data.created_date);
                    $('#created_by_update').val(response.data.created_by);
                    $('#bank_update').val(response.data.bank);
                    //open modal
                    $('#ModalUpdateBank').modal('show');
                }
            });
        }

        // proses update type outlet
        $('#update_bank').submit(function(e) {
            e.preventDefault();
            let id = $('#id_update').val();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/bank/update') }}/"+ id,
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
                            text: 'Data Type Oulet Berhasil diubah.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{url('admin/bank')}}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal diubah. ',
                            text: 'Data Type Oulet Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                    }
                }
            });
        });

        function destroyBank(id) {
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
                        url: "{{ url('admin/bank/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Type Outlet Berhasil dihapus.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            window.location.href = "{{url('admin/bank')}}";
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
