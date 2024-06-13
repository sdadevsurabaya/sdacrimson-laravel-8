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
                        <table id="datatable-report" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>AR</th>
                                    <th>Tanggal</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td>1</td> {{-- This will give you the sequential number --}}
                                    <td>Tonny</td> {{-- Assuming 'user' relation has 'name' attribute --}}
                                    <td>12-Jun-2024</td>
                                    {{-- Formatting the date --}}

                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#Show" type="button" data-id=""
                                            class="btn btn-sm btn-secondary show-jadwal">Show</button>
                                        {{-- <a href="{{ route('jadwal.addJadwal', ['id' => $jadwal->id]) }}">
                                                <button type="button" class="btn btn-sm btn-success">Tambah</button>
                                            </a> --}}
                                    </td>

                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

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
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#datatable-report').DataTable();

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
                            var editUrl = `/edit-detailJadwal/${item.id}`;

                            var row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item.customer.nama_usaha}</td>
                            <td>${item.activity_type}</td>
                            <td>${item.plant_date}</td>
                            <td>${item.note}</td>
                            <td>
                                <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger btn-cancel-detail" data-id="${item.id}">Batal</button>
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

            $(document).on('click', '.btn-cancel-detail', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Apakah Anda yakin ingin membatalkan Detail jadwal ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan soft delete menggunakan AJAX
                        $.ajax({
                            url: '/jadwal-detail/' + id,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location
                                            .reload(); // Reload halaman untuk melihat perubahan
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function(xhr) {
                                console.error('Error deleting data:', xhr);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Terjadi kesalahan saat membatalkan jadwal',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });

            $('#saveButton').click(function() {
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/createJadwal';
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: value[0],
                                confirmButtonText: 'OK'
                            });
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
