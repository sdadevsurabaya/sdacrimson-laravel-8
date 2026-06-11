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
                    <!-- Tampilan Desktop (Table) -->
                    <div class="table-responsive d-none d-md-block">
                        <table id="datatable-history" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>NO</th>
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

                    <!-- Tampilan Mobile (Card List) -->
                    <div class="d-block d-md-none" id="mobile-card-list">
                        @forelse ($customers as $customer)
                            <div class="card border mb-3 shadow-sm mobile-card-item">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0 text-primary fw-bold text-truncate pe-2">{{ $customer->nama_usaha }}</h6>
                                        <span class="badge bg-danger rounded-pill" style="white-space: nowrap;">
                                            {{ $customer->laporanSales->count() }} Kali
                                        </span>
                                    </div>
                                    <p class="text-muted small mb-2 text-truncate">
                                        <i class="uil-location-point me-1"></i> {{ $customer->alamat_kantor ?? 'Alamat tidak tersedia' }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                                        <small class="text-muted">
                                            <i class="uil-calendar-alt me-1"></i>
                                            @if ($customer->laporanSales->count() > 0)
                                                {{ \Carbon\Carbon::parse($customer->laporanSales->sortByDesc('created_at')->first()->created_at)->format('d-M-Y') }}
                                            @else
                                                -
                                            @endif
                                        </small>
                                        <a href="{{ route('history.kunjungan.show', $customer->id) }}"
                                            class="btn btn-sm btn-success px-3">
                                            <i class="uil-eye"></i> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-3">Belum ada history kunjungan.</div>
                        @endforelse
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
                order: [[4, 'desc']] // Mengurutkan berdasarkan Kunjungan Terakhir (Index ke-4)
            });

            // Pagination khusus mobile list
            var itemsPerPage = 10;
            var $cards = $('.mobile-card-item');
            var totalItems = $cards.length;
            var totalPages = Math.ceil(totalItems / itemsPerPage);
            var currentPage = 1;

            function showPage(page) {
                var start = (page - 1) * itemsPerPage;
                var end = start + itemsPerPage;
                
                $cards.hide();
                $cards.slice(start, end).show();
                
                $('#mobile-page-info').text('Halaman ' + page + ' dari ' + totalPages);
                $('#btn-prev').prop('disabled', page === 1);
                $('#btn-next').prop('disabled', page === totalPages || totalPages === 0);
            }

            if(totalItems > itemsPerPage) {
                var paginationHtml = `
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                        <button class="btn btn-sm btn-outline-primary" id="btn-prev"><i class="uil-angle-left"></i> Kembali</button>
                        <span id="mobile-page-info" class="text-muted small fw-bold"></span>
                        <button class="btn btn-sm btn-outline-primary" id="btn-next">Lanjut <i class="uil-angle-right"></i></button>
                    </div>
                `;
                $('#mobile-card-list').append(paginationHtml);
                
                $('#btn-prev').click(function(e) {
                    e.preventDefault();
                    if(currentPage > 1) {
                        currentPage--;
                        showPage(currentPage);
                    }
                });
                
                $('#btn-next').click(function(e) {
                    e.preventDefault();
                    if(currentPage < totalPages) {
                        currentPage++;
                        showPage(currentPage);
                    }
                });
                
                showPage(1);
            }
        });
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
