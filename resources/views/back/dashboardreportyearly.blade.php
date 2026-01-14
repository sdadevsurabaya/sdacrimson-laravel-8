@extends('layouts.master')
@section('title')
    @lang('Report Yearly')
@endsection
@section('css')
    <style>
        .company-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .bg-sda {
            background-color: #8a2432;
        }

        .month-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .month-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .productivity-badge {
            font-size: 1.5rem;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .productivity-excellent {
            background-color: #d4edda;
            color: #155724;
        }

        .productivity-good {
            background-color: #fff3cd;
            color: #856404;
        }

        .productivity-fair {
            background-color: #ffeaa7;
            color: #d63031;
        }

        .productivity-poor {
            background-color: #f8d7da;
            color: #721c24;
        }

        .yearly-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            margin-top: 2rem;
        }

        .progress-custom {
            height: 25px;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Report
        @endslot
        @slot('title')
            Report Sales Yearly
        @endslot
    @endcomponent

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('sweetalert::alert')

    <div class="wrapper">
        <h1 class="mb-4">Laporan Tahunan Sales</h1>

        <div class="row mb-4">
            <form method="GET" action="{{ route('back.report.yearly') }}" class="row g-3">
                <div class="col-auto">
                    <label for="year" class="form-label">Tahun</label>
                    <select class="form-select" name="year" id="year">
                        @foreach ($years as $yearOption)
                            <option value="{{ $yearOption }}" {{ $year == $yearOption ? 'selected' : '' }}>
                                {{ $yearOption }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($role == 1 || $role == 8)
                    <div class="col-auto">
                        <label for="cabang" class="form-label">Cabang</label>
                        <select class="form-select" name="cabang" id="cabang">
                            <option value="">Pilih Cabang</option>
                            @foreach ($cabangs as $cabang)
                                <option value="{{ $cabang->id }}"
                                    {{ isset($_GET['cabang']) && $cabang->id == $_GET['cabang'] ? 'selected' : '' }}>
                                    {{ $cabang->cabang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="col-auto d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>
        </div>

        <div class="list-group mb-5">
            @if ($sales && count($sales) > 0)
                <div class="row g-4">
                    @foreach ($sales as $sale)
                        <div class="col-sm-6 col-lg-4 col-xl-3" style="cursor: pointer;">
                            <div class="card position-relative shadow-sm"
                                onclick="showYearlyModal('yearlyModal{{ $sale->id }}');">
                                <div class="card-body">
                                    <span class="badge bg-danger company-badge">active</span>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar bg-sda me-3">{{ Str::upper(Str::substr($sale->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-capitalize">{{ $sale->name }}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-muted">
                                        <i class='bx bx-child bx-md'></i> Sales Representative
                                    </div>
                                    @php
                                        $yearlyAvg = $monthlyData[$sale->id]['yearly_avg'] ?? 0;
                                        $badgeClass = 'bg-secondary';
                                        if ($yearlyAvg >= 80) {
                                            $badgeClass = 'bg-success';
                                        } elseif ($yearlyAvg >= 60) {
                                            $badgeClass = 'bg-warning';
                                        } elseif ($yearlyAvg >= 40) {
                                            $badgeClass = 'bg-info';
                                        } elseif ($yearlyAvg > 0) {
                                            $badgeClass = 'bg-danger';
                                        }
                                    @endphp
                                    <div class="mt-3">
                                        <span class="badge {{ $badgeClass }} w-100 py-2">
                                            Yearly: {{ number_format($yearlyAvg, 1) }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @foreach ($sales as $sale)
                    <!-- Modal Yearly Report -->
                    <div class="modal fade" id="yearlyModal{{ $sale->id }}" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="yearlyModalLabel{{ $sale->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title text-capitalize" id="yearlyModalLabel{{ $sale->id }}">
                                        <i class='bx bx-calendar'></i> Laporan Tahunan {{ $year }} - {{ $sale->name }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Legend -->
                                    <div class="alert alert-info">
                                        <h6 class="mb-2"><strong>📊 Keterangan Produktivitas:</strong></h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small>
                                                    <span class="badge bg-success">≥ 80%</span> Excellent<br>
                                                    <span class="badge bg-warning text-dark">60-79%</span> Good
                                                </small>
                                            </div>
                                            <div class="col-md-6">
                                                <small>
                                                    <span class="badge bg-info">40-59%</span> Fair<br>
                                                    <span class="badge bg-danger">< 40%</span> Needs Improvement
                                                </small>
                                            </div>
                                        </div>
                                        <hr>
                                        <small><strong>Formula:</strong> 3 kunjungan valid per hari = 100% | Valid = Visit type, check-in/out lengkap, durasi ≥ 20 menit</small>
                                    </div>

                                    <!-- 12 Months Grid -->
                                    <div class="row">
                                        @php
                                            $monthNames = [
                                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                            ];
                                        @endphp

                                        @for ($month = 1; $month <= 12; $month++)
                                            @php
                                                $data = $monthlyData[$sale->id]['months'][$month] ?? null;
                                                $productivity = $data['productivity'] ?? 0;
                                                $totalVisits = $data['total_visits'] ?? 0;
                                                $workDays = $data['work_days'] ?? 0;
                                                $visitedDays = $data['visited_days'] ?? 0;

                                                if ($productivity >= 80) {
                                                    $cardClass = 'productivity-excellent';
                                                    $progressClass = 'bg-success';
                                                } elseif ($productivity >= 60) {
                                                    $cardClass = 'productivity-good';
                                                    $progressClass = 'bg-warning';
                                                } elseif ($productivity >= 40) {
                                                    $cardClass = 'productivity-fair';
                                                    $progressClass = 'bg-info';
                                                } else {
                                                    $cardClass = 'productivity-poor';
                                                    $progressClass = 'bg-danger';
                                                }
                                            @endphp

                                            <div class="col-md-6 col-lg-4 mb-3">
                                                <div class="month-card {{ $cardClass }}">
                                                    <h6 class="mb-2"><strong>{{ $monthNames[$month] }}</strong></h6>
                                                    <div class="productivity-badge {{ $cardClass }} mb-2">
                                                        {{ number_format($productivity, 1) }}%
                                                    </div>
                                                    <div class="progress progress-custom mb-2">
                                                        <div class="progress-bar {{ $progressClass }}" role="progressbar"
                                                            style="width: {{ min($productivity, 100) }}%"
                                                            aria-valuenow="{{ $productivity }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class='bx bx-check-circle'></i> {{ $totalVisits }} kunjungan<br>
                                                        <i class='bx bx-calendar-check'></i> {{ $visitedDays }}/{{ $workDays }} hari kerja
                                                    </small>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>

                                    <!-- Yearly Summary -->
                                    <div class="yearly-summary">
                                        <h3 class="mb-2">
                                            <i class='bx bx-trending-up'></i> Produktivitas Tahunan {{ $year }}
                                        </h3>
                                        <h1 class="display-3 mb-3">
                                            {{ number_format($monthlyData[$sale->id]['yearly_avg'], 1) }}%
                                        </h1>
                                        <div class="row justify-content-center">
                                            <div class="col-md-4">
                                                <div class="card bg-white text-dark mb-2">
                                                    <div class="card-body py-2">
                                                        <h5 class="mb-1">{{ $monthlyData[$sale->id]['total_visits'] }}</h5>
                                                        <small>Total Kunjungan</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card bg-white text-dark mb-2">
                                                    <div class="card-body py-2">
                                                        <h5 class="mb-1">{{ $monthlyData[$sale->id]['total_work_days'] }}</h5>
                                                        <small>Total Hari Kerja</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">Tidak ada data sales untuk filter yang dipilih.</div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showYearlyModal(modalId) {
            const modal = new bootstrap.Modal(document.getElementById(modalId));
            modal.show();
        }
    </script>
@endsection
