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
            Export Jadwal
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

                    <form action="{{ route('jadwal.previewJadwal') }}" method="GET">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="floatingSelectGrid" class="col-form-label">Sales / PIC</label>
                                <div class="">
                                    <select class="form-select" name="user_id" id="user_id"
                                        aria-label="Floating label select example">
                                        <option value="">-- Pilih User --</option>
                                        @foreach ($users as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="floatingSelectGrid" class="col-form-label">Bulan</label>
                                <div class="">
                                    <select class="form-select" name="month" id="month"
                                        aria-label="Floating label select example">
                                        <option value="">-- Pilih Bulan --</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="text-center">
                            <a href="{{ route('jadwal.previewJadwal') }}" class="btn btn-success">Preview</a>
                        </div> --}}

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Preview</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
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
    <script></script>


    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
