@extends('layouts.master')
@section('title')
    @lang('Pemetaan Wilayah')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Delivery Planner
        @endslot
        @slot('title')
            Pemetaan Area Customer
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Filter Pemetaan Area</h4>
                    <p class="card-title-desc">Filter customer berdasarkan Kota dan Area untuk merencanakan delivery.</p>

                    <form action="{{ route('pemetaan.area.index') }}" method="GET">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="filter_kota">Kota</label>
                                    <select class="form-control select2" id="filter_kota" name="kota">
                                        <option value="">-- Semua Kota --</option>
                                        @foreach($kotas as $kota)
                                            <option value="{{ $kota->kota }}" {{ request('kota') == $kota->kota ? 'selected' : '' }}>{{ $kota->kota }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="filter_area">Area</label>
                                    <select class="form-control select2" id="filter_area" name="area">
                                        <option value="">-- Semua Area --</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->area }}" {{ request('area') == $area->area ? 'selected' : '' }}>{{ $area->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-md">Filter</button>
                                    <a href="{{ route('pemetaan.area.index') }}" class="btn btn-secondary w-md">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Customer</th>
                                    <th>Nama Usaha</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Area</th>
                                    <th>Koordinat GPS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key => $customer)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $customer->id_customer }}</td>
                                    <td>{{ $customer->nama_usaha }}</td>
                                    <td>{{ $customer->alamat_kantor }}</td>
                                    <td>{{ $customer->kota }}</td>
                                    <td>{{ $customer->area }}</td>
                                    <td>
                                        @if($customer->latitude && $customer->longitude)
                                            <span class="badge bg-success">Sesuai ({{ $customer->latitude }}, {{ $customer->longitude }})</span>
                                        @else
                                            <span class="badge bg-danger">Belum ada titik</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
