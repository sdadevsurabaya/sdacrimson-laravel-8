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
                                    <th>Nama Role</th>
                                    <th>Nama Permissions</th>
                                    <th width="280px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accesss as $key => $acces)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $acces->name }}</td>

                                    @php
                                        $get_permissions = DB::table('role_has_permissions')
                                                        ->join("permissions","permissions.id","=","role_has_permissions.permission_id")
                                                        ->where('role_id', $acces->roles_id)
                                                        ->get(['permissions.name as permissions_name']);
                                        // $jumlah_outlet = $get_outlet->count();
                                    @endphp

                                    <td>
                                        @foreach ( $get_permissions as $get_permission)
                                            <label> {{$get_permission->permissions_name}} </label>,
                                        @endforeach
                                    </td>
                                    <td>
                                        {{-- @can('access-permission-edit') --}}
                                            {{-- <button class="btn btn-medium btn-success" onclick="update({{ $acces->roles_id }})">Edit</button> --}}
                                            <a href="{{ url('admin/access/show/'.$acces->roles_id) }}" class="btn btn-medium btn-success">Edit</a>
                                        {{-- @endcan --}}
                                        {{-- @can('access-permission-delete') --}}
                                            <button class="btn btn-medium btn-danger" onclick="destroyAccessPermission({{ $acces->roles_id }})">Hapus</button>
                                        {{-- @endcan --}}
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
     <div class="modal fade" id="ModalCreateAccessPermission" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Create New Access Permission</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="alert alert-danger print-error-msg error-contact-edit"
                         style="display:none">
                         <ul></ul>
                     </div>

                     <form id="create_access_permission" method="POST" action="javascript:void(0)"
                         accept-charset="utf-8" enctype="multipart/form-data">
                         {{-- {!! csrf_field() !!} --}}
                         @csrf
                         <div class="col-xl-12 col-md-12">
                             <div class="mb-3">
                                 <label class="form-label">Pilih Role</label>
                                 <select class="form-select role" name="role" id="floatingSelectGrid" aria-label="Floating label select example">
                                    <option value="">-- Pilih role --</option>
                                    @foreach ($roles as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                             </div>
                         </div>
                         <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Pilih Permissions</label> <br/>
                                @foreach ($permissions as $key => $data)
                                    <input type="checkbox" id="permission{{$key}}" name="permission[]" value="{{$data->id}}">
                                    <label for="permission{{$key}}">{{$data->name}}</label> <br/>
                                @endforeach
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
     <div class="modal fade" id="ModalUpdateAccessPermission" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Update Access Permission</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"
                         aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="alert alert-danger print-error-msg error-contact-edit"
                         style="display:none">
                         <ul></ul>
                     </div>

                     <form id="update_access_permission" method="POST" action="javascript:void(0)"
                         accept-charset="utf-8" enctype="multipart/form-data">
                         {{-- {!! csrf_field() !!} --}}
                         @csrf
                         <div class="col-xl-12 col-md-12">
                             <div class="mb-3">
                                <label class="form-label">Role</label>
                                 <input type="text" class="form-control" name="role_update" id="role_update" value="" readonly>
                             </div>
                         </div>
                         <div class="col-xl-12 col-md-12">
                             <div class="mb-3">
                                 <label class="form-label">Pilih Permission</label>
                                 <div for="" id="permission_update"></div>
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
            $('#ModalCreateAccessPermission').modal('show');
        }

        // proses submit type outlet
        $('#create_access_permission').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/access/store') }}",
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
                            text: 'Data Access Permission Berhasil ditambahkan.',
                            showConfirmButton: false,
                            timer: 30000
                        });
                        window.location.href = "{{url('access')}}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahkan. ',
                            text: 'Data Access Permission Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                    }
                }
            });
        });

        // show modal edit type outlet
        function update(id) {
            // console.log(id);
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/access/showRole') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    //  console.log(response);
                    $('#role_update').val(response.data.name);
                    let role_id = response.data.id;
                    response.data.name
                    $.ajax({
                        url: "{{ url('admin/access/showPermission') }}/" + role_id,
                        type: "get",
                        cache: false,
                        success: function(response) {
                            //fill data to form
                            // console.log(response);
                            // for (i=0; i < response.data.length; i++) {
                            //     let html = `<input type="checkbox" class="form-control" value="` + response.data[i].id + `" name="access_permission_update" id="namafoto_edit_outlet` + [i] + `">
                            //     <label for="permission` + [i] + `">` + response.data[i].name + `</label> <br/>

                            //     `;

                            //     $(html).appendTo("#permission_update");
                            // }
                            $('#permission_update').html(response);
                        }
                    });
                    //open modal
                    $('#ModalUpdateAccessPermission').modal('show');
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

        function destroyAccessPermission(id) {
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
                        url: "{{ url('admin/access/destroy') }}/" + id,
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Hapus Data. ',
                                text: 'Data Access Permission Berhasil dihapus.',
                                showConfirmButton: true,
                                // timer: 3000
                            });
                            window.location.href = "{{url('access')}}";
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
