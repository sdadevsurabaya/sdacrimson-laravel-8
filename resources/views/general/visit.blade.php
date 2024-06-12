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
            General
        @endslot
        @slot('title')
            List Kunjungan {{ $general->nama_usaha }}
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">List Check In & Check Out</h3>
                    <div class="table-responsive">
                        <table id="datatable-home" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>AR</th>
                                    <th>Tanggal</th>
                                    <th>Note</th>
                                    <th>Status</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $key => $general)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> {{-- This will give you the sequential number --}}
                                        <td>{{ $general->user->name }}</td> {{-- Assuming 'user' relation has 'name' attribute --}}
                                        <td>{{ \Carbon\Carbon::parse($general->created_at)->format('d-M-Y H:i') }}</td>
                                        {{-- Formatting the date --}}
                                        <td>{{ $general->description }}</td> {{-- Assuming there's a 'description' field --}}
                                        <td>{{ $general->status }}</td> {{-- Assuming there's a 'status' field --}}
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success m-1 detail-visit"
                                                data-id="{{ $general->id }}" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Detail Visit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">List Laporan Kunjungan</h3>
                    <div class="table-responsive">
                        <table id="datatable-kunjungan" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>AR</th>
                                    <th>Tanggal</th>
                                    <th >Laporan</th>
                                    <th>Lampiran Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $key => $general)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> {{-- This will give you the sequential number --}}
                                        <td>{{ $general->user->name }}</td> {{-- Assuming 'user' relation has 'name' attribute --}}
                                        <td>{{ \Carbon\Carbon::parse($general->created_at)->format('d-M-Y H:i') }}</td>
                                        {{-- Formatting the date --}}
                                        <td width="280px">{{ $general->pesan }}</td> {{-- Assuming there's a 'status' field --}}
                                        <td width="280px">
                                            @foreach ($general->gambar as $gambar)
                                            <a class="image-popup-no-margins" href="{{ url('laporan/' . $gambar->foto) }}">
                                                <img src="{{ url('laporan/' . $gambar->foto) }}" width="107" height="75">
                                            </a>
                                        @endforeach
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
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Kunjungan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2 mb-lg-5">
                        <div class="col col-12 text-center">
                            <p class="fw-bold text-capitalize fs-4">Check In</p>
                            <img src="" alt="Check-in Image" width="350" height="550">
                            <!-- Gambar akan diubah melalui AJAX -->
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <iframe src="" width="600" height="450" style="border:0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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


            $(document).on('click', '.detail-visit', function() {
                console.log('klikl');
                var attendanceId = $(this).data('id');

                $.ajax({
                    url: '/api/attendance-id/' + attendanceId,
                    type: 'GET',
                    success: function(response) {
                        $('#exampleModal .modal-body .fw-bold').text(response.status);
                        $('#exampleModal .modal-body img').attr('src', response.foto);
                        var mapUrl =
                            `https://maps.google.com/maps?q=${response.latitude},${response.longitude}&z=15&output=embed`;



                        $('#exampleModal .modal-body iframe').attr('src', mapUrl);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                }
            });

        });
    </script>


    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
