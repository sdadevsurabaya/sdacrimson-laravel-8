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
                        <!-- TAMPILAN DESKTOP (Table) -->
                        <div class="table-responsive d-none d-md-block">
                            <table id="datatable-laporan" class="table table-striped table-bordered dt-responsive"
                                style="border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Sales</th>
                                        <th>Laporan Kunjungan</th>
                                        <th>Lampiran Foto</th>
                                        <th>Foto Checkin/Checkout</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $item)
                                        @php
                                            $tglLaporan = \Carbon\Carbon::parse($item->created_at)->toDateString();
                                            $attHari = $attendance->get($tglLaporan, collect());
                                            $checkIn  = $attHari->firstWhere('status', 'check in');
                                            $checkOut = $attHari->firstWhere('status', 'check out');
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td data-order="{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i:s') }}">{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y H:i') }}</td>
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
                                            <td>
                                                <div class="d-flex flex-wrap gap-2 align-items-start">
                                                    @if ($checkIn && $checkIn->foto)
                                                        <div class="text-center">
                                                            <a class="image-popup-no-margins"
                                                                href="{{ url('attendance/' . $checkIn->foto) }}">
                                                                <img src="{{ url('attendance/' . $checkIn->foto) }}"
                                                                    width="60" height="60"
                                                                    style="object-fit: cover; border-radius: 4px; border: 2px solid #34c38f;">
                                                            </a>
                                                            <div><span class="badge bg-success mt-1" style="font-size:10px;">Check In</span></div>
                                                        </div>
                                                    @endif
                                                    @if ($checkOut && $checkOut->foto)
                                                        <div class="text-center">
                                                            <a class="image-popup-no-margins"
                                                                href="{{ url('attendance/' . $checkOut->foto) }}">
                                                                <img src="{{ url('attendance/' . $checkOut->foto) }}"
                                                                    width="60" height="60"
                                                                    style="object-fit: cover; border-radius: 4px; border: 2px solid #f46a6a;">
                                                            </a>
                                                            <div><span class="badge bg-danger mt-1" style="font-size:10px;">Check Out</span></div>
                                                        </div>
                                                    @endif
                                                    @if ((!$checkIn || !$checkIn->foto) && (!$checkOut || !$checkOut->foto))
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- TAMPILAN MOBILE (Card List) -->
                        <div class="d-block d-md-none" id="mobile-laporan-list">
                            @foreach ($laporan as $item)
                                @php
                                    $tglLaporan = \Carbon\Carbon::parse($item->created_at)->toDateString();
                                    $attHari    = $attendance->get($tglLaporan, collect());
                                    $checkIn    = $attHari->firstWhere('status', 'check in');
                                    $checkOut   = $attHari->firstWhere('status', 'check out');
                                @endphp
                                <div class="card border mb-3 shadow-sm mobile-laporan-item">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-xs me-2">
                                                    <span class="avatar-title bg-soft-primary text-primary rounded-circle" style="width: 32px; height: 32px;">
                                                        <i class="uil-user"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 font-size-14">{{ $item->user->name ?? '-' }}</h6>
                                                    <span class="text-muted small">
                                                        <i class="uil-clock me-1"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="text-muted mb-3" style="font-size: 14px;">
                                            {{ $item->pesan ?? 'Tidak ada pesan laporan.' }}
                                        </p>

                                        <!-- Lampiran foto laporan -->
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            @forelse ($item->gambar as $gambar)
                                                <a class="image-popup-no-margins" href="{{ url('laporan/' . $gambar->foto) }}">
                                                    <img src="{{ url('laporan/' . $gambar->foto) }}"
                                                        alt="Lampiran" class="rounded"
                                                        style="width: 70px; height: 70px; object-fit: cover; border: 1px solid #dee2e6;">
                                                </a>
                                            @empty
                                                <span class="badge bg-soft-secondary text-secondary">Tidak ada lampiran</span>
                                            @endforelse
                                        </div>

                                        <!-- Foto checkin / checkout -->
                                        @if ($checkIn || $checkOut)
                                            <div class="border-top pt-2 mt-1">
                                                <small class="text-muted fw-semibold d-block mb-2">
                                                    <i class="uil-map-marker me-1"></i>Foto Checkin/Checkout
                                                </small>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @if ($checkIn && $checkIn->foto)
                                                        <div class="text-center">
                                                            <a class="image-popup-no-margins" href="{{ url('attendance/' . $checkIn->foto) }}">
                                                                <img src="{{ url('attendance/' . $checkIn->foto) }}"
                                                                    alt="Check In" class="rounded"
                                                                    style="width: 65px; height: 65px; object-fit: cover; border: 2px solid #34c38f;">
                                                            </a>
                                                            <div><span class="badge bg-success mt-1" style="font-size:10px;">Check In</span></div>
                                                        </div>
                                                    @endif
                                                    @if ($checkOut && $checkOut->foto)
                                                        <div class="text-center">
                                                            <a class="image-popup-no-margins" href="{{ url('attendance/' . $checkOut->foto) }}">
                                                                <img src="{{ url('attendance/' . $checkOut->foto) }}"
                                                                    alt="Check Out" class="rounded"
                                                                    style="width: 65px; height: 65px; object-fit: cover; border: 2px solid #f46a6a;">
                                                            </a>
                                                            <div><span class="badge bg-danger mt-1" style="font-size:10px;">Check Out</span></div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
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
                    { orderable: false, targets: [4, 5] }
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

            // Pagination mobile
            var itemsPerPage = 5;
            var $cards = $('.mobile-laporan-item');
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

            if (totalItems > itemsPerPage) {
                var paginationHtml = `
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                        <button class="btn btn-sm btn-outline-primary" id="btn-prev"><i class="uil-angle-left"></i> Kembali</button>
                        <span id="mobile-page-info" class="text-muted small fw-bold"></span>
                        <button class="btn btn-sm btn-outline-primary" id="btn-next">Lanjut <i class="uil-angle-right"></i></button>
                    </div>
                `;
                $('#mobile-laporan-list').append(paginationHtml);

                $('#btn-prev').click(function(e) {
                    e.preventDefault();
                    if (currentPage > 1) { currentPage--; showPage(currentPage); }
                });
                $('#btn-next').click(function(e) {
                    e.preventDefault();
                    if (currentPage < totalPages) { currentPage++; showPage(currentPage); }
                });

                showPage(1);
            }
        });
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
