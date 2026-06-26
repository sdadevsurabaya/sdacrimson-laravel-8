@extends('layouts.master')
@section('title')
    @lang('Tracking Delivery')
@endsection
@section('css')
<style>
    /* ===== TRACKING DELIVERY PAGE ===== */
    :root {
        --brand-crimson: #c0233d;
        --brand-dark:    #871726;
        --brand-soft:    #fdf2f4;
    }

    /* Header banner */
    .tracking-header {
        background: linear-gradient(135deg, #dd939d 0%, #c0233d 55%, #871726 100%);
        border-radius: 16px;
        padding: 28px 32px;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: 0 8px 32px rgba(192,35,61,.28);
    }
    .tracking-header::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 240px; height: 240px;
        background: rgba(255,255,255,.07);
        border-radius: 50%;
        pointer-events: none;
    }
    .tracking-header::after {
        content: '';
        position: absolute;
        bottom: -40px; left: 30%;
        width: 160px; height: 160px;
        background: rgba(255,255,255,.04);
        border-radius: 50%;
        pointer-events: none;
    }
    .tracking-header .th-icon {
        font-size: 48px;
        opacity: .9;
        margin-right: 18px;
    }
    .tracking-header h4 {
        font-weight: 800;
        font-size: 22px;
        margin-bottom: 4px;
        letter-spacing: .3px;
    }
    .tracking-header p {
        font-size: 14px;
        opacity: .8;
        margin-bottom: 0;
    }
    .tracking-header .date-filter-form .form-control {
        background: rgba(255,255,255,.18);
        border: 1px solid rgba(255,255,255,.35);
        color: #fff;
        border-radius: 10px;
        font-weight: 600;
        min-width: 175px;
    }
    .tracking-header .date-filter-form .form-control::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
    .tracking-header .btn-filter-date {
        background: #fff;
        color: var(--brand-crimson);
        font-weight: 700;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        transition: all .2s;
    }
    .tracking-header .btn-filter-date:hover { background: #ffe5ea; }

    /* Summary stat cards */
    .stat-card {
        border-radius: 14px;
        padding: 20px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        box-shadow: 0 4px 18px rgba(0,0,0,.07);
        background: #fff;
        border-left: 4px solid transparent;
        transition: transform .2s;
    }
    .stat-card:hover { transform: translateY(-2px); }
    .stat-card.crimson { border-left-color: var(--brand-crimson); }
    .stat-card.success { border-left-color: #28a745; }
    .stat-card.warning { border-left-color: #ffc107; }
    .stat-card.info    { border-left-color: #17a2b8; }
    .stat-card .stat-icon {
        width: 52px; height: 52px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; flex-shrink: 0;
    }
    .stat-card.crimson .stat-icon { background: #fdf2f4; color: var(--brand-crimson); }
    .stat-card.success .stat-icon { background: #f0fff4; color: #28a745; }
    .stat-card.warning .stat-icon { background: #fffbf0; color: #e0a800; }
    .stat-card.info    .stat-icon { background: #f0feff; color: #17a2b8; }
    .stat-card .stat-value { font-size: 28px; font-weight: 800; line-height: 1; }
    .stat-card .stat-label { font-size: 13px; color: #6c757d; margin-top: 2px; }

    /* Driver card */
    .driver-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 2px 14px rgba(0,0,0,.06);
        margin-bottom: 24px;
        overflow: hidden;
        transition: box-shadow .2s;
    }
    .driver-card:hover { box-shadow: 0 6px 28px rgba(0,0,0,.11); }
    .driver-card-header {
        padding: 18px 24px;
        background: linear-gradient(90deg, #f9f9f9, #fff);
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .driver-avatar {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--brand-crimson), var(--brand-dark));
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        flex-shrink: 0;
    }
    .driver-name { font-size: 16px; font-weight: 700; margin-bottom: 2px; }
    .driver-meta { font-size: 12px; color: #888; }
    .status-pill {
        display: inline-flex; align-items: center; gap: 6px;
        border-radius: 20px; padding: 5px 14px;
        font-size: 12px; font-weight: 700; letter-spacing: .3px;
    }
    .status-pill.success  { background: #d4edda; color: #155724; }
    .status-pill.warning  { background: #fff3cd; color: #856404; }
    .status-pill.secondary{ background: #e9ecef; color: #495057; }

    /* Progress bar delivery */
    .delivery-progress-wrap { padding: 14px 24px 0; }
    .delivery-progress-label { display: flex; justify-content: space-between; font-size: 12px; color: #888; margin-bottom: 6px; }
    .delivery-progress-bar { height: 8px; border-radius: 4px; background: #f0f0f0; overflow: hidden; }
    .delivery-progress-bar .fill {
        height: 100%;
        border-radius: 4px;
        background: linear-gradient(90deg, var(--brand-crimson), var(--brand-dark));
        transition: width .6s ease;
    }

    /* Info chips */
    .info-chips { display: flex; gap: 10px; padding: 14px 24px; flex-wrap: wrap; }
    .info-chip {
        display: inline-flex; align-items: center; gap: 6px;
        background: #f8f9fa; border-radius: 8px; padding: 6px 12px;
        font-size: 12px; color: #495057; font-weight: 500;
    }
    .info-chip i { font-size: 14px; color: var(--brand-crimson); }

    /* Customer stops table */
    .stops-table-wrap { padding: 0 24px 18px; overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .stops-table { width: 100%; border-collapse: collapse; min-width: 800px; }
    .stops-table thead tr { background: #fdf2f4; }
    .stops-table th {
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .8px; color: var(--brand-crimson);
        padding: 10px 12px; border-bottom: 2px solid #f0d0d5;
        white-space: nowrap;
    }
    .stops-table td {
        padding: 10px 12px; font-size: 13px;
        border-bottom: 1px solid #f5f5f5; vertical-align: middle;
        white-space: nowrap;
    }
    .stops-table tr:last-child td { border-bottom: none; }
    .stops-table tr:hover td { background: #fdf9f9; }

    /* Customer name pill */
    .customer-name { font-weight: 600; font-size: 13px; }
    .customer-area { font-size: 11px; color: #aaa; }

    /* Done / pending badge */
    .badge-done    { background: #d4edda; color: #155724; border-radius: 6px; padding: 3px 9px; font-size: 11px; font-weight: 700; }
    .badge-pending { background: #f8d7da; color: #721c24; border-radius: 6px; padding: 3px 9px; font-size: 11px; font-weight: 700; }
    .badge-ongoing { background: #fff3cd; color: #856404; border-radius: 6px; padding: 3px 9px; font-size: 11px; font-weight: 700; }

    /* Odo KM pill */
    .odo-pill {
        background: #e8f4fd; color: #0c5460; border-radius: 6px;
        padding: 2px 8px; font-size: 11px; font-weight: 700;
    }

    /* Empty state */
    .empty-state {
        text-align: center; padding: 60px 20px;
        background: #fff; border-radius: 16px;
        box-shadow: 0 2px 14px rgba(0,0,0,.06);
    }
    .empty-state i { font-size: 56px; color: #e0e0e0; margin-bottom: 16px; display: block; }
    .empty-state h5 { font-weight: 700; color: #555; }
    .empty-state p  { color: #999; font-size: 14px; }

    /* Expand toggle */
    .toggle-stops-btn {
        background: none; border: none; color: var(--brand-crimson);
        font-size: 12px; font-weight: 600; padding: 6px 24px 16px;
        cursor: pointer; width: 100%; text-align: left;
    }
    .toggle-stops-btn i { margin-right: 5px; }
    .stops-body { display: none; }
    .stops-body.show { display: block; }

    /* Laporan text preview */
    .laporan-text {
        max-width: 200px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        font-size: 12px; color: #555;
        cursor: pointer;
        display: inline-block;
        vertical-align: middle;
    }
    .laporan-text:hover { color: var(--brand-crimson); }

    @media (max-width: 768px) {
        .tracking-header { padding: 20px; }
        .driver-card-header { flex-direction: column; align-items: flex-start; }
        .stops-table-wrap { padding: 0 16px 16px; }
        .stops-table { font-size: 12px; }
        .stops-table th, .stops-table td { padding: 8px; }
    }
</style>
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Delivery Planner @endslot
    @slot('title') Tracking Delivery @endslot
@endcomponent

{{-- ========= HEADER BANNER ========= --}}
<div class="tracking-header">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <i class="mdi mdi-truck-delivery th-icon"></i>
            <div>
                <h4>Tracking Pengiriman Driver</h4>
                <p>Pantau progres pengiriman seluruh driver secara real-time</p>
            </div>
        </div>
        {{-- Filter Tanggal --}}
        <form method="GET" action="{{ route('tracking.delivery.index') }}" class="date-filter-form d-flex align-items-center gap-2">
            <input type="date" name="date" class="form-control"
                   value="{{ $selectedDate->format('Y-m-d') }}"
                   max="{{ now()->format('Y-m-d') }}"
                   id="input-tracking-date">
            <button type="submit" class="btn-filter-date">
                <i class="mdi mdi-magnify me-1"></i>Lihat
            </button>
        </form>
    </div>
    <p class="mt-3 mb-0" style="font-size:13px; opacity:.7;">
        <i class="mdi mdi-calendar-check me-1"></i>
        Menampilkan data tanggal: <strong>{{ $selectedDate->translatedFormat('d F Y') }}</strong>
    </p>
</div>

{{-- ========= STAT SUMMARY CARDS ========= --}}
@php
    $totalDrivers   = $summaries->count();
    $totalSelesai   = $summaries->where('status_label', 'Selesai')->count();
    $totalBerjalan  = $summaries->where('status_label', 'Sedang Berjalan')->count();
    $totalBelumMulai= $summaries->where('status_label', 'Belum Mulai')->count();
    $totalStops     = $summaries->sum('total_stop');
    $totalLaporanAll= $summaries->sum('total_laporan');
@endphp

<div class="row">
    <div class="col-6 col-md-3">
        <div class="stat-card crimson">
            <div class="stat-icon"><i class="mdi mdi-account-multiple"></i></div>
            <div>
                <div class="stat-value">{{ $totalDrivers }}</div>
                <div class="stat-label">Total Driver</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card success">
            <div class="stat-icon"><i class="mdi mdi-check-circle"></i></div>
            <div>
                <div class="stat-value">{{ $totalSelesai }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card warning">
            <div class="stat-icon"><i class="mdi mdi-truck-fast"></i></div>
            <div>
                <div class="stat-value">{{ $totalBerjalan }}</div>
                <div class="stat-label">Sedang Berjalan</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card info">
            <div class="stat-icon"><i class="mdi mdi-clipboard-list"></i></div>
            <div>
                <div class="stat-value">{{ $totalLaporanAll }}/{{ $totalStops }}</div>
                <div class="stat-label">Laporan Terisi</div>
            </div>
        </div>
    </div>
</div>

{{-- ========= DRIVER CARDS ========= --}}
@if ($summaries->isEmpty())
    <div class="empty-state">
        <i class="mdi mdi-truck-outline"></i>
        <h5>Tidak Ada Jadwal Driver</h5>
        <p>Belum ada jadwal pengiriman driver pada tanggal <strong>{{ $selectedDate->translatedFormat('d F Y') }}</strong>.</p>
    </div>
@else
    @foreach ($summaries as $idx => $summary)
    @php
        $progress = $summary['total_stop'] > 0
            ? round(($summary['total_laporan'] / $summary['total_stop']) * 100)
            : 0;
        $driver = $summary['driver'];
        $driverInitial = $driver ? strtoupper(substr($driver->name, 0, 1)) : '?';
    @endphp
    <div class="driver-card">
        {{-- Header --}}
        <div class="driver-card-header">
            <div class="d-flex align-items-center gap-3">
                <div class="driver-avatar">{{ $driverInitial }}</div>
                <div>
                    <div class="driver-name">{{ $driver ? $driver->name : '–' }}</div>
                    <div class="driver-meta">
                        <i class="mdi mdi-calendar me-1"></i>{{ $summary['jadwal']->date }}
                        &nbsp;·&nbsp;
                        <i class="mdi mdi-barcode me-1"></i>{{ $summary['jadwal']->kode ?? '-' }}
                    </div>
                </div>
            </div>
            <span class="status-pill {{ $summary['status_class'] }}">
                @if($summary['status_label'] === 'Selesai')
                    <i class="mdi mdi-check-circle"></i>
                @elseif($summary['status_label'] === 'Sedang Berjalan')
                    <i class="mdi mdi-truck-fast"></i>
                @else
                    <i class="mdi mdi-clock-outline"></i>
                @endif
                {{ $summary['status_label'] }}
            </span>
        </div>

        {{-- Progress --}}
        <div class="delivery-progress-wrap">
            <div class="delivery-progress-label">
                <span><i class="mdi mdi-map-marker-multiple me-1"></i>{{ $summary['total_laporan'] }} / {{ $summary['total_stop'] }} stop terselesaikan</span>
                <span style="font-weight:700; color: var(--brand-crimson);">{{ $progress }}%</span>
            </div>
            <div class="delivery-progress-bar">
                <div class="fill" style="width: {{ $progress }}%;"></div>
            </div>
        </div>

        {{-- Info chips --}}
        <div class="info-chips">
            <div class="info-chip">
                <i class="mdi mdi-map-marker-check"></i>
                <span>{{ $summary['total_stop'] }} Tujuan</span>
            </div>
            <div class="info-chip">
                <i class="mdi mdi-file-document-outline"></i>
                <span>{{ $summary['total_laporan'] }} Laporan</span>
            </div>
            @if($summary['total_odo_km'] > 0)
            <div class="info-chip">
                <i class="mdi mdi-speedometer"></i>
                <span>Odo: {{ number_format($summary['total_odo_km'], 0, ',', '.') }} km</span>
            </div>
            @endif
            @if($summary['first_checkin'])
            <div class="info-chip">
                <i class="mdi mdi-clock-start"></i>
                <span>Mulai: {{ \Carbon\Carbon::parse($summary['first_checkin']->created_at)->format('H:i') }}</span>
            </div>
            @endif
            @if($summary['last_checkout'])
            <div class="info-chip">
                <i class="mdi mdi-clock-end"></i>
                <span>Selesai: {{ \Carbon\Carbon::parse($summary['last_checkout']->created_at)->format('H:i') }}</span>
            </div>
            @endif
        </div>

        {{-- Toggle button --}}
        <button class="toggle-stops-btn" onclick="toggleStops({{ $idx }})">
            <i class="mdi mdi-chevron-down" id="icon-{{ $idx }}"></i>Lihat Detail Tujuan ({{ $summary['total_stop'] }} stop)
        </button>

        {{-- Detail stops --}}
        <div class="stops-body" id="stops-{{ $idx }}">
            <div class="stops-table-wrap">
                <table class="stops-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Area</th>
                            <th>Tipe Aktivitas</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Odo KM</th>
                            <th>Catatan Laporan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($summary['customer_details'] as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>
                                <div class="customer-name">{{ $item['customer'] ? $item['customer']->nama_usaha : '–' }}</div>
                                <div class="customer-area">{{ $item['customer'] ? $item['customer']->id_customer : '' }}</div>
                            </td>
                            <td>
                                @if($item['customer'] && $item['customer']->kota)
                                    <span style="font-size:11px; color:#888;">{{ $item['customer']->area ?? '-' }}, {{ $item['customer']->kota }}</span>
                                @else
                                    <span style="color:#ccc; font-size:11px;">–</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size:12px; background:#f0f4ff; color:#3d5af1; border-radius:5px; padding:2px 8px; font-weight:600;">
                                    {{ $item['detail']->activity_type ?? '–' }}
                                </span>
                            </td>
                            <td>
                                @if($item['checkin'])
                                    <span style="color:#28a745; font-size:12px; font-weight:600;">
                                        <i class="mdi mdi-check"></i>
                                        {{ \Carbon\Carbon::parse($item['checkin']->created_at)->format('H:i') }}
                                    </span>
                                @else
                                    <span style="color:#ccc; font-size:12px;">–</span>
                                @endif
                            </td>
                            <td>
                                @if($item['checkout'])
                                    <span style="color:#dc3545; font-size:12px; font-weight:600;">
                                        <i class="mdi mdi-check"></i>
                                        {{ \Carbon\Carbon::parse($item['checkout']->created_at)->format('H:i') }}
                                    </span>
                                @else
                                    <span style="color:#ccc; font-size:12px;">–</span>
                                @endif
                            </td>
                            <td>
                                @if($item['laporan'] && $item['laporan']->odo_km)
                                    <span class="odo-pill">{{ number_format($item['laporan']->odo_km, 0, ',', '.') }} km</span>
                                @else
                                    <span style="color:#ccc; font-size:12px;">–</span>
                                @endif
                            </td>
                            <td>
                                @if($item['laporan'] && $item['laporan']->pesan)
                                    <span class="laporan-text" title="{{ $item['laporan']->pesan }}">
                                        {{ $item['laporan']->pesan }}
                                    </span>
                                @else
                                    <span style="color:#ccc; font-size:12px;">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                @if($item['laporan'])
                                    <span class="badge-done"><i class="mdi mdi-check-circle me-1"></i>Terisi</span>
                                @elseif($item['checkin'])
                                    <span class="badge-ongoing"><i class="mdi mdi-truck-fast me-1"></i>On-site</span>
                                @else
                                    <span class="badge-pending"><i class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3">Tidak ada tujuan pada jadwal ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
@endif

@endsection

@section('script')
<script>
    function toggleStops(idx) {
        var body = document.getElementById('stops-' + idx);
        var icon = document.getElementById('icon-' + idx);
        var btn  = body.previousElementSibling;

        if (body.classList.contains('show')) {
            body.classList.remove('show');
            icon.classList.remove('mdi-chevron-up');
            icon.classList.add('mdi-chevron-down');
            btn.innerHTML = '<i class="mdi mdi-chevron-down me-1"></i>' + btn.innerHTML.replace(/<[^>]+>/g,'').trim().replace('Sembunyikan', 'Lihat');
        } else {
            body.classList.add('show');
            icon.classList.remove('mdi-chevron-down');
            icon.classList.add('mdi-chevron-up');
        }
    }

    // Auto-open jika hanya 1 driver
    @if($summaries->count() === 1)
    toggleStops(0);
    @endif
</script>
@endsection
