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
            List Kunjungan TOKO ABC
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
                                {{-- @foreach ($data as $key => $general) --}}
                                <tr>
                                    <td>1</td>
                                    <td>Eko Budi</td>
                                    <td>23-Juli-2023</td>
                                    <td>tes sadasd</td>
                                    <td>checkin</td>
                                    <td><a href="#" class="btn btn-sm btn-success m-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Detail Visit</a></td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
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
                    <div class="row mb-2 mb-lg-5 ">
                        <div class="col col-12 text-center">
                            <p class="fw-bold text-capitalize fs-4">Check In</p>
                            <img src="{{ URL::asset('/attendance/checkin.jpg') }}" width="350" height="550">
                        </div>
                        {{-- <div class="col col-md-6">
                            <p class="fw-bold text-capitalize fs-4">Check Out</p>
                            <img src="{{ URL::asset('/attendance/checkin.jpg') }}" class="img-fluid">
                        </div> --}}
                    </div>
                    <div class="col-12 text-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.909822137097!2d112.73070261744382!3d-7.2511037000000025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f946c8d959b5%3A0xc2d2e219e8d38e3d!2sSDA%20Fluid%20Power!5e0!3m2!1sid!2sid!4v1716346126503!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
