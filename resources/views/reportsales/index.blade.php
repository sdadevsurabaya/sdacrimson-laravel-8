@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Sales
        @endslot
        @slot('title')
            Report Sales
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
                    <div class="d-flex">
                        {{-- <button class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat
                            Jadwal</button> --}}
                        <div class="col-md-2 mt-1">
                            <input class="form-control" name="daterange" value=""/>
                        </div>
                    </div>
                </div>
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

                                        <td><button data-bs-toggle="modal" data-bs-target="#Show" type="button"
                                                data-id="{{ $jadwal->id }}" class="btn btn-sm btn-secondary show-jadwal">Show</button>
                                            
                                        </td>

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
                                <select class="form-select" name="user_id" id="user_id" id="floatingSelectGrid"
                                    aria-label="Floating label select example">
                                    <option value="">-- Pilih User --</option>
                                    @foreach ($users as $id => $name)
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
                                name="date" id="date" type="date">
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

    <!-- Modal SHOW -->
    <div class="modal fade" id="Show" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalShowLabel">Show</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="datatable-show" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Customer</th>
                                    <th>Type Aktifitas</th>
                                    <th>Jam Kunjungan</th>
                                    <th>Note</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan dirender di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal EDIT -->
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
                                name="date_edit" id="date_edit" type="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary update-jadwal">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function() {

         
         

            $('#datatable-home').DataTable();
            $('#datatable-kunjungan').DataTable();


            $(document).on('click', '.show-jadwal', function() {
                $('#datatable-show tbody').empty();


                var id = $(this).data('id');
                loadModalData(id);

            });

            function loadModalData(id) {
                $.ajax({
                    url: '/getByidDetailJadwal',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {


                        response.forEach(function(item, index) {
                            var editUrl = `/admin/general/visit/${item.general_id}?jadwal_id=${item.jadwal_id}`;


                            var row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item.customer.nama_usaha}</td>
                            <td>${item.activity_type}</td>
                            <td>${item.plant_date}</td>
                            <td>${item.note}</td>
                            <td>
                                <a href="${editUrl}" class="btn btn-sm btn-warning">Visit</a>
                            </td>
                        </tr>`;
                            $('#datatable-show tbody').append(row);
                        });


                        $('#Show').modal('show');
                        $('#datatable-show').DataTable();
                    },
                    error: function(xhr, status, error) {
                        console.error("Terjadi kesalahan: ", status, error);
                    }
                });
            }

      



        });
    </script>
    <script>
       $(function() {
    $('input[name="daterange"]').daterangepicker({
        opens: 'left'
    }, function(start, end, label) {
        // Callback saat rentang tanggal dipilih
        var startDate = start.format('YYYY-MM-DD');
        var endDate = end.format('YYYY-MM-DD');

        // Buat URL dengan parameter start dan end
        var url = 'report-sales?start=' + startDate + '&end=' + endDate;

        // Redirect ke halaman report-sales dengan parameter
        window.location.href = url;
    });
});

    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection
