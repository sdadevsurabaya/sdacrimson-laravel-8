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
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="floatingSelectGrid" class="col-form-label">Sales / PIC</label>
                            <div class="">
                                <select class="form-select" name="user_id" id="user_id"
                                    aria-label="Floating label select example">
                                    <option value="">-- Pilih User --</option>
                                    <option value="1">Dargombez</option>
                                    <option value="5">agus</option>
                                    <option value="6">Adi Prasetyo</option>
                                    <option value="8">Dian Saputro</option>
                                    <option value="9">manager01</option>
                                    <option value="10">alfin fachrizal</option>
                                    <option value="12">rois</option>
                                    <option value="13">Rois Yusuf Wahyudi</option>
                                    <option value="14">syaiful wanda</option>
                                    <option value="16">sylvia</option>
                                    <option value="18">Kholis</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="floatingSelectGrid" class="col-form-label">Bulan</label>
                            <div class="">
                                <select class="form-select" name="user_id" id="user_id"
                                    aria-label="Floating label select example">
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="1">Januari</option>
                                    <option value="5">Februari</option>
                                    <option value="6">Maret</option>
                                    <option value="8">April</option>
                                    <option value="9">Mei</option>
                                    <option value="10">Juni</option>
                                    <option value="12">Juli</option>
                                    <option value="13">Agustus</option>
                                    <option value="14">September</option>
                                    <option value="16">Oktober</option>
                                    <option value="18">November</option>
                                    <option value="18">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('jadwal.previewJadwal') }}" class="btn btn-success">Preview</a>
                        </div>
                    </div>
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
