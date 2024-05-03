@extends('layouts.master')
@section('title')
    @lang('General')
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
            Kontak
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

    @if(session()->has('error'))
        <div class="alert alert-warning  alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Kontak</h3>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-xl-4 col-md-12 mb-3">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="id_customer">ID Customers</label>
                                                    <input type="text" class="form-control @error('id_customer') border border-danger @enderror" name="" id="" value="{{ $general->id_customer}}" disabled>
                                                    <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="{{ $general->id_customer}}">
                                                </div>
                                            </div>
                                            <form action="" id="form_legal">
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan nama lengkap">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="no_telpon">No Telpon</label>
                                                        <input type="number" class="form-control" name="no_telpon" id="no_telpon" placeholder="Masukan nomor telp">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukan email">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="jabatan">Jabatan</label>
                                                        <input type="text" class="form-control jabatan" name="jabatan" id="jabatan" placeholder="Masukan jabatan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="status">Status</label>
                                                        <select class="form-select @error('ststus') border border-danger @enderror status" name="status" id="floatingSelectGrid" aria-label="Floating label select example">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Aktif" @if (old('ststus') == 'Aktif') selected="selected" @endif>Aktif</option>
                                                            <option value="Tidak Aktif" @if (old('ststus') == 'Tidak Aktif') selected="selected" @endif>Tidak Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-12">
                                            <button type="reset" class="btn btn-success">Reset</button>
                                        </form>
                                            <button type="submit" class="btn btn-primary" onclick="submitContactPerson()">Submit</button>
                                        </div>

                                    </div>
                                    <div class="col-xl-8 col-md-12">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>NO.</th>
                                                        <th>ID Customer</th>
                                                        <th>Nama Lengkap</th>
                                                        <th>No Telpon</th>
                                                        <th>Email</th>
                                                        <th>Jabatan</th>
                                                        <th>Status</th>
                                                        <th>AR</th>

                                                        <th width="280px">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($contact_person) > 0)
                                                    <?php $no=1; ?>
                                                        @foreach ($contact_person as $key => $data)
                                                            <tr>
                                                                <td>{{ $no++ }}</td>
                                                                <td>{{ $data->id_customer }}</td>
                                                                <td>{{ $data->nama_lengkap }}</td>
                                                                <td>{{ $data->no_telpon }}</td>
                                                                <td>{{ $data->email }}</td>
                                                                <td>{{ $data->jabatan }}</td>
                                                                <td>{{ $data->status }}</td>
                                                                <td>{{ $data->name }}</td>
                                                                <td>
                                                                    <button class="btn btn-medium btn-success" onclick="show({{$data->id_contact_person}})">Edit</button>
                                                                    <button class="btn btn-medium btn-danger" onclick="destroyContactPerson({{$data->id_contact_person}})">Hapus</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="9" class="text-center">Data tidak ada...</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);

            });

            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();

            });

        });
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    {{-- <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script> --}}
@endsection
