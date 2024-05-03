@extends('layouts.master')
@section('title')
    @lang('translation.Datatables')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Tables
        @endslot
        @slot('title')
            Users Permissions
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    {{-- @can('permission-create') --}}
                    <button class="btn btn-success" onclick="create()"> Buat Permission</button>
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
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th width="280px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('permission-edit')
                                            <button class="btn btn-medium btn-success" onclick="update({{ $permission->id }})">Edit</button>
                                        @endcan
                                        @can('permission-delete')
                                            <button class="btn btn-medium btn-danger" onclick="destroyPermission({{ $permission->id }})">Hapus</button>
                                        @endcan
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
     <div class="modal fade" id="ModalCreatePermission" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Create New Permission</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="alert alert-danger print-error-msg error-contact-edit"
                         style="display:none">
                         <ul></ul>
                     </div>

                     <form id="create_permission" method="POST" action="javascript:void(0)"
                         accept-charset="utf-8" enctype="multipart/form-data">
                         {{-- {!! csrf_field() !!} --}}
                         @csrf
                         <div class="col-xl-12 col-md-12">
                             <div class="mb-3">
                                 <label class="form-label">Permission</label>
                                 <input type="text" class="form-control"
                                     name="permission"
                                     id="permission" placeholder="Contoh: permission-create">
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
     <div class="modal fade" id="ModalUpdatePermission" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Update Permission</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="alert alert-danger print-error-msg error-contact-edit"
                         style="display:none">
                         <ul></ul>
                     </div>

                     <form id="update_permission" method="POST" action="javascript:void(0)"
                         accept-charset="utf-8" enctype="multipart/form-data">
                         {{-- {!! csrf_field() !!} --}}
                         @csrf
                         <div class="col-xl-12 col-md-12">
                             <div class="mb-3">
                                 <input type="hidden" class="form-control"
                                     name="id_update"
                                     id="id_update" value="">
                             </div>
                         </div>
                         <div class="col-xl-12 col-md-12">
                             <div class="mb-3">
                                 <label class="form-label">Permission</label>
                                 <input type="text" class="form-control"
                                     name="permission_update"
                                     id="permission_update" placeholder="Contoh: permission-create">
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
            $('#ModalCreatePermission').modal('show');
        }

        // proses submit type outlet
        $('#create_permission').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/permissions/store') }}",
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
                            text: 'Data Permission Berhasil ditambahkan.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{url('permissions')}}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahkan. ',
                            text: 'Data Permission Belum Lengkap.',
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
                url: "{{ url('admin/permissions/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_update').val(response.data.id);
                    $('#permission_update').val(response.data.name);
                    //open modal
                    $('#ModalUpdatePermission').modal('show');
                }
            });
        }

        // proses update type outlet
        $('#update_permission').submit(function(e) {
            e.preventDefault();
            let id = $('#id_update').val();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/permissions/update') }}/"+ id,
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
                            text: 'Data Permission Berhasil diubah.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{url('permissions')}}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal diubah. ',
                            text: 'Data Permission Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                    }
                }
            });
        });

        function destroyPermission(id) {
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
                        url: "{{ url('admin/permissions/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Permission Berhasil dihapus.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            window.location.href = "{{url('permissions')}}";
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
