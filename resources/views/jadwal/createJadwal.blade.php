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
            Jadwal
        @endslot
        @slot('title')
            Buat Jadwal Kunjungan
        @endslot
    @endcomponent

    @if (session()->has('success'))
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
                    <button class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat
                        Jadwal</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-kunjungan" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kode</th>
                                    <th>AR</th>
                                    <th>Tanggal</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($jadwals as $key => $jadwal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> {{-- This will give you the sequential number --}}
                                    <td>{{ $jadwal->kode }}</td> {{-- Assuming 'user' relation has 'name' attribute --}}
                                    <td>{{ $jadwal->user->name }}</td> {{-- Assuming 'user' relation has 'name' attribute --}}
                                    <td>{{ \Carbon\Carbon::parse($jadwal->date)->format('d-M-Y') }}</td>
                                    {{-- Formatting the date --}}
                                  
                                    <td><button data-bs-toggle="modal" data-bs-target="#Show" type="button" class="btn btn-sm btn-secondary">Show</button>
                                        <a href="{{ route('jadwal.addJadwal') }}"><button type="button" class="btn btn-sm btn-success">Tambah</button></a>
                                        <button data-bs-toggle="modal" data-bs-target="#Edit" type="button" class="btn btn-sm btn-warning">Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button></td> {{-- Assuming there's a 'status' field --}}
                                   
                                </tr>
                            @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    @role('Sales')
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
                @else
                <div class="mb-3">
                    <label for="floatingSelectGrid" class="col-form-label">Sales / PIC</label>
                    <div class="">
                        <select class="form-select" name="user_id" id="user_id" id="floatingSelectGrid" aria-label="Floating label select example">
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endrole
                    <div class="mb-3 row">
                        <label for="floatingSelectGrid" class="col-form-label">Tanggal Kunjungan</label>
                        <div class="">
                            <input placeholder="Tanggal Kunjungan" class="form-control form-control-solid mb-3 mb-lg-0"
                                name="date"  id="date" type="date">
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="floatingSelectGrid" class="col-form-label">Jam Kunjungan</label>
                        <div class="">
                            <input placeholder="active date" class="form-control form-control-solid mb-3 mb-lg-0"
                                name="active_date" type="time">
                        </div>
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveButton">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="Show" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalShowLabel">Show</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="floatingSelectGrid" class="col-form-label">Sales / PIC</label>
                        <div class="">
                            <select class="form-select " name="type_usaha" id="floatingSelectGrid"
                                aria-label="Floating label select example">
                                <option value="">-- Pilih Type Usaha --</option>
                                <option value="TK">TK</option>
                                <option value="UD">UD</option>
                                <option value="CV">CV</option>
                                <option value="PT">PT</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="floatingSelectGrid" class="col-form-label">Tanggal Kunjungan</label>
                        <div class="">
                            <input placeholder="active date" class="form-control form-control-solid mb-3 mb-lg-0"
                                name="active_date" type="date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="floatingSelectGrid" class="col-form-label">Jam Kunjungan</label>
                        <div class="">
                            <input placeholder="active date" class="form-control form-control-solid mb-3 mb-lg-0"
                                name="active_date" type="time">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="floatingSelectGrid" class="col-form-label">Tanggal Kunjungan</label>
                        <div class="">
                            <input placeholder="active date" class="form-control form-control-solid mb-3 mb-lg-0"
                                name="active_date" type="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#datatable-home').DataTable();
            $('#datatable-kunjungan').DataTable();

            $('#saveButton').click(function(){
            var user_id = $('#user_id').val();
            var date = $('#date').val();

            $.ajax({
                url: "{{ route('save.jadwal') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: user_id,
                    date: date
                },
                success: function(response) {
                    alert(response.message);
                    window.location.href = '/createJadwal';
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        alert(value[0]);
                    });
                }
            });
        });
        });
    </script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
