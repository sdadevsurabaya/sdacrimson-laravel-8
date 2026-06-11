@extends('layouts.master')
@section('title')
    Laporan Kunjungan - {{ $customer->nama_usaha }}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Magnific Popup -->
    <link href="{{ URL::asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            History Kunjungan
        @endslot
        @slot('title')
            Laporan Kunjungan {{ $customer->nama_usaha }}
        @endslot
    @endcomponent

    <!-- Info Customer -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">Info Customer</h4>
                        <a href="{{ route('history.kunjungan.index') }}" class="btn btn-sm btn-secondary">
                            <i class="uil-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th width="140">ID Customer</th>
                                    <td>: {{ $customer->id_customer }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Usaha</th>
                                    <td>: {{ $customer->nama_usaha }}</td>
                                </tr>
                                <tr>
                                    <th>Nama PIC</th>
                                    <td>: {{ $customer->nama_lengkap ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th width="140">Alamat</th>
                                    <td>: {{ $customer->alamat_kantor ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>: {{ $customer->mobile_phone ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Laporan Kunjungan -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="uil-clipboard-notes me-1"></i>
                        Laporan Kunjungan
                        <span class="badge bg-primary ms-2">{{ $laporan->count() }} kunjungan</span>
                    </h4>

                    @if ($laporan->count() > 0)
                        <div class="table-responsive">
                            <table id="datatable-laporan" class="table table-striped table-bordered dt-responsive"
                                style="border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Sales</th>
                                        <th>Laporan Kunjungan</th>
                                        <th>Lampiran Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y H:i') }}</td>
                                            <td>{{ $item->user->name ?? '-' }}</td>
                                            <td>
                                                <div style="min-width: 280px; white-space: normal;">
                                                    {{ $item->pesan ?? '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @forelse ($item->gambar as $gambar)
                                                        <a class="image-popup-no-margins"
                                                            href="{{ url('laporan/' . $gambar->foto) }}">
                                                            <img src="{{ url('laporan/' . $gambar->foto) }}"
                                                                width="80" height="60"
                                                                style="object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6;">
                                                        </a>
                                                    @empty
                                                        <span class="text-muted">-</span>
                                                    @endforelse
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="uil-clipboard-blank" style="font-size: 48px; color: #ccc;"></i>
                            <p class="text-muted mt-2">Belum ada laporan kunjungan untuk customer ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#datatable-laporan').DataTable({
                order: [[1, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [4] }
                ]
            });

            $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom',
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300
                }
            });
        });
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
