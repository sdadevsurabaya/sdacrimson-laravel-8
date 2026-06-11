@extends('layouts.master')
@section('title')
    History Kunjungan
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
            History Kunjungan Customer
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Daftar Customer Yang Pernah Dikunjungi</h4>
                    <div class="table-responsive">
                        <table id="datatable-history" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID Customer</th>
                                    <th>Nama Usaha</th>
                                    <th>Alamat</th>
                                    <th>Total Kunjungan</th>
                                    <th>Kunjungan Terakhir</th>
                                    <th width="120px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $key => $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->id_customer }}</td>
                                        <td>{{ $customer->nama_usaha }}</td>
                                        <td>{{ $customer->alamat_kantor ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-danger">
                                                {{ $customer->laporanSales->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($customer->laporanSales->count() > 0)
                                                {{ \Carbon\Carbon::parse($customer->laporanSales->sortByDesc('created_at')->first()->created_at)->format('d-M-Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('history.kunjungan.show', $customer->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="uil-eye"></i> Show
                                            </a>
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
    <script>
        $(document).ready(function() {
            $('#datatable-history').DataTable({
                order: [[6, 'desc']]
            });
        });
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
