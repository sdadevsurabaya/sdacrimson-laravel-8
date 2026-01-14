@extends('layouts.master')
@section('title')
    Report Bulanan
@endsection
@section('css')
    <style>
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

        .card-sales {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .card-sales:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1) !important;
            border-color: #3b71ca !important;
        }

        .search-container {
            position: relative;
            max-width: 400px;
        }

        .search-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
        }

        .search-container input {
            padding-left: 45px;
            border-radius: 30px;
            border: 1px solid #ced4da;
            transition: all 0.2s;
        }

        .search-container input:focus {
            box-shadow: 0 0 0 0.25rem rgba(59, 113, 202, 0.15);
            border-color: #3b71ca;
        }

        .branch-group {
            transition: all 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease forwards;
        }

        .bg-sda {
            background-color: #8a2432;
        }

        .company-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        #monthlyChart {
            max-height: 400px;
        }
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Report
        @endslot
        @slot('title')
            Report Analisis Sales
        @endslot
    @endcomponent

    <div class="wrapper">
        <!-- Summary Chart Overview -->
        @if (count($sales) > 0)
            <div class="card shadow-sm mb-5 border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar bg-primary text-white me-3" style="width: 45px; height: 45px;">
                            <i class="bx bx-stats font-size-24"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Ringkasan Performa Seluruh Sales</h5>
                            <p class="text-muted mb-0 font-size-13">Perbandingan akumulasi pencapaian tahunan antar sales
                                (Tahun {{ $year }})</p>
                        </div>
                    </div>
                    <div style="height: 350px; overflow-y: auto;">
                        <canvas id="summaryComparisonChart"></canvas>
                    </div>
                </div>
            </div>
        @endif

        <div class="d-flex align-items-center mb-4">
            <h1 class="mb-0">Daftar Sales</h1>
            <span class="badge bg-primary ms-3 font-size-18">{{ count($sales) }} User</span>
        </div>

        <form method="GET" action="{{ route('back.monthlyreport.index') }}" class="row g-3 mb-4 align-items-end">
            <div class="col-auto">
                <label for="year" class="form-label">Tahun</label>
                <select name="year" id="year" class="form-select">
                    @foreach ($years as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($role == 1 || $role == 8 || $role == 9)
                <div class="col-auto">
                    <label for="cabang" class="form-label">Cabang</label>
                    <select class="form-select" name="cabang" id="cabang">
                        <option value="">Semua Cabang</option>
                        @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" {{ $cabangId == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->cabang }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="col-auto">
                <button type="submit" class="btn btn-primary px-4">Tampilkan</button>
                <a href="{{ route('back.monthlyreport.excel', ['year' => $year, 'cabang' => $cabangId]) }}"
                    class="btn btn-success ms-1">
                    <i class="bx bx-file"></i> Excel
                </a>
                <a href="{{ route('back.monthlyreport.pdf', ['year' => $year, 'cabang' => $cabangId]) }}"
                    class="btn btn-danger ms-1">
                    <i class="bx bx-file-pdf"></i> PDF
                </a>
            </div>

            <div class="col-md-4 ms-auto">
                <div class="search-container">
                    <i class="bx bx-search font-size-18"></i>
                    <input type="text" id="salesSearch" class="form-control"
                        placeholder="Cari nama sales atau cabang...">
                </div>
            </div>
        </form>

        @php $currentBranch = null; @endphp
        <div class="row g-4">
            @forelse ($sales as $sale)
                @php
                    $branchName = $sale->nama_cabang ?? 'No Branch';
                @endphp

                @if ($currentBranch !== $branchName)
                    @if ($currentBranch !== null)
        </div>
        <div class="row g-4 mt-2">
            @endif
            <div class="col-12 mt-5 mb-2">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 fw-bold text-primary"><i class='bx bx-buildings me-2'></i>Cabang: {{ $branchName }}
                    </h5>
                    <div class="flex-grow-1 ms-3 border-bottom opacity-25"></div>
                </div>
            </div>
            @php $currentBranch = $branchName; @endphp
            @endif

            @php
                // Generate a consistent light color based on branch ID
                $hue = ($sale->cabang_id * 137) % 360;
                $bgColor = "hsla($hue, 70%, 90%, 0.6)";
                $borderColor = "hsla($hue, 70%, 40%, 0.3)";
            @endphp
            <div class="col-sm-6 col-lg-4 col-xl-3 sales-card-item" data-name="{{ strtolower($sale->name) }}"
                data-branch="{{ strtolower($branchName) }}">
                <div class="card card-sales position-relative shadow-sm h-100"
                    onclick="showMonthlyAnalysis({{ $sale->id }}, '{{ $sale->name }}')"
                    style="cursor: pointer; background-color: {{ $bgColor }}; border: 1px solid {{ $borderColor }}; border-radius: 15px;">
                    <div class="card-body">
                        <span class="badge bg-success company-badge">Active</span>
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar bg-sda me-3">{{ Str::upper(Str::substr($sale->name, 0, 1)) }}</div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ ucwords(strtolower($sale->name)) }}</h6>
                                <small class="text-muted d-block mt-1">
                                    <i class='bx bx-buildings me-1'></i>{{ $sale->nama_cabang ?? 'No Branch' }}
                                </small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class='bx bx-user-circle me-1'></i> {{ $sale->role }}
                        </div>

                        <div class="mt-2">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted fw-bold">Tahunan: {{ $sale->actual_yearly }} /
                                    {{ $sale->target_yearly }}</small>
                                <small class="fw-bold">{{ $sale->percentage_yearly }}%</small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                @php
                                    $progColor = 'bg-danger';
                                    if ($sale->percentage_yearly >= 80) {
                                        $progColor = 'bg-success';
                                    } elseif ($sale->percentage_yearly >= 50) {
                                        $progColor = 'bg-warning';
                                    }
                                @endphp
                                <div class="progress-bar {{ $progColor }}" role="progressbar"
                                    style="width: {{ $sale->percentage_yearly }}%"
                                    aria-valuenow="{{ $sale->percentage_yearly }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Tidak ada data sales untuk filter ini.</div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Analysis Modal -->
    <div class="modal fade" id="analysisModal" tabindex="-1" aria-labelledby="analysisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="analysisModalLabel">Analisis Kunjungan: <span id="modalUserName"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Column: Charts -->
                        <div class="col-lg-7">
                            <!-- Monthly Chart -->
                            <div class="h-100 d-flex flex-column">
                                <h6 class="text-uppercase font-size-13 mb-3 text-center fw-bold">Grafik Pencapaian
                                    Kunjungan
                                    Bulanan</h6>
                                <div class="flex-grow-1" style="min-height: 450px;">
                                    <canvas id="monthlyChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Summary Table -->
                        <div class="col-lg-5">
                            <div id="statsSummary">
                                <div class="card bg-light border-0 shadow-none">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted text-uppercase font-size-12 mb-3 fw-bold border-bottom pb-2">
                                            Rincian Data Tahun {{ $year }}</h6>
                                        <div id="statsContent">
                                            <p class="text-center font-size-14">Memuat data...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Section: Monthly Cards Detail -->
                    <hr class="mb-5">
                    <h6 class="text-uppercase font-size-14 mb-4 fw-bold"><i class="bx bx-calendar-event me-1"></i> Detail
                        Pencapaian Per Bulan</h6>
                    <div id="monthlyDetailCards" class="row g-3">
                        <!-- Populated via JS -->
                    </div>

                    <!-- New Section: Yearly Recap Large Card -->
                    <hr class="my-5">
                    <div id="yearlyRecapLargeCard">
                        <!-- Populated via JS -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        let myChart = null;
        let myPieChart = null;
        let mySummaryChart = null;
        let myBranchChart = null;
        Chart.register(ChartDataLabels);

        $(document).ready(function() {
            renderSummaryChart();

            // Real-time Search Logic
            $('#salesSearch').on('keyup', function() {
                const value = $(this).val().toLowerCase();

                $('.sales-card-item').each(function() {
                    const name = $(this).data('name');
                    const branch = $(this).data('branch');
                    const isVisible = name.includes(value) || branch.includes(value);
                    $(this).toggle(isVisible);
                });

                // Hide branch headers if all their items are hidden
                $('.mt-5.mb-2').each(function() {
                    const nextRow = $(this).next('.row.g-4');
                    const hasVisibleItems = nextRow.find('.sales-card-item:visible').length > 0;
                    $(this).toggle(hasVisibleItems);
                    nextRow.toggle(hasVisibleItems);
                });
            });
        });

        function renderSummaryChart() {
            let salesData = @json($sales);
            if (!salesData || salesData.length === 0) return;

            // --- SALES CHART ---
            // Sort by percentage yearly descending (Ranking)
            const sortedSales = [...salesData].sort((a, b) => b.percentage_yearly - a.percentage_yearly);
            const salesLabels = sortedSales.map(s => s.name.toLowerCase().replace(/\b\w/g, l => l.toUpperCase()));
            const salesPercentages = sortedSales.map(s => s.percentage_yearly);
            const salesActuals = sortedSales.map(s => s.actual_yearly);

            const salesCtx = document.getElementById('summaryComparisonChart').getContext('2d');
            const salesHeight = Math.max(350, sortedSales.length * 40);
            salesCtx.canvas.parentElement.style.height = salesHeight + 'px';

            if (mySummaryChart) mySummaryChart.destroy();
            mySummaryChart = new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        data: salesPercentages,
                        backgroundColor: (c) => salesPercentages[c.dataIndex] >= 80 ?
                            'rgba(52, 195, 143, 0.8)' : (salesPercentages[c.dataIndex] >= 50 ?
                                'rgba(241, 180, 76, 0.8)' : 'rgba(244, 106, 106, 0.8)'),
                        borderColor: (c) => salesPercentages[c.dataIndex] >= 80 ? '#34c38f' : (
                            salesPercentages[c.dataIndex] >= 50 ? '#f1b44c' : '#f46a6a'),
                        borderWidth: 1,
                        borderRadius: 5,
                        barThickness: 25
                    }]
                },
                options: getCommonOptions(salesActuals, sortedSales)
            });
        }

        function getCommonOptions(actuals, sourceData) {
            return {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        offset: 5,
                        color: '#444',
                        font: {
                            weight: 'bold',
                            size: 10
                        },
                        formatter: (val, ctx) => val + '% (' + actuals[ctx.dataIndex] + ')'
                    },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => {
                                const item = sourceData[ctx.dataIndex];
                                return `Pencapaian: ${item.actual_yearly} / ${item.target_yearly} (${item.percentage_yearly}%)`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 120,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        },
                        ticks: {
                            callback: v => v + '%'
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            color: '#333'
                        }
                    }
                },
                layout: {
                    padding: {
                        right: 80
                    }
                }
            };
        }

        function showMonthlyAnalysis(userId, userName) {
            const capitalizedName = userName.toLowerCase().replace(/\b\w/g, s => s.toUpperCase());
            $('#modalUserName').text(capitalizedName);
            $('#statsContent').html('<p class="text-center font-size-14">Memuat data...</p>');

            const modal = new bootstrap.Modal(document.getElementById('analysisModal'));
            modal.show();

            const year = $('#year').val();
            const target = 60; // Hardcoded constant value

            $.ajax({
                url: "{{ route('back.monthlyreport.stats') }}",
                method: 'GET',
                data: {
                    userId: userId,
                    year: year,
                    target: target
                },
                success: function(response) {
                    if (response.success) {
                        renderChart(response.data);
                        renderStats(response.data);
                        renderPieChart(response.data);
                    }
                },
                error: function() {
                    $('#statsContent').html('<p class="text-danger">Gagal memuat data.</p>');
                }
            });
        }

        function renderChart(data) {
            const labels = data.map(item => item.month);
            const percentages = data.map(item => item.percentage);
            const actuals = data.map(item => item.actual);

            const ctx = document.getElementById('monthlyChart').getContext('2d');

            if (myChart) {
                myChart.destroy();
            }

            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Persentase Kunjungan (%)',
                            data: percentages,
                            backgroundColor: 'rgba(138, 36, 50, 0.7)',
                            borderColor: 'rgba(138, 36, 50, 1)',
                            borderWidth: 1,
                            yAxisID: 'y',
                            datalabels: {
                                color: '#ffffff',
                                anchor: 'center',
                                align: 'center',
                                rotation: -60,
                                formatter: (value) => value > 0 ? value + '%' : ''
                            }
                        },
                        {
                            label: 'Total Kunjungan (Actual)',
                            data: actuals,
                            type: 'line',
                            borderColor: '#28a745',
                            backgroundColor: '#28a745',
                            borderWidth: 2,
                            pointBackgroundColor: '#28a745',
                            yAxisID: 'y1',
                            datalabels: {
                                color: '#28a745',
                                anchor: 'end',
                                align: 'top',
                                offset: 5,
                                formatter: (value) => value > 0 ? value : ''
                            }
                        }
                    ]
                },
                options: {
                    responsive: true,
                    layout: {
                        padding: {
                            top: 30
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 130, // Increased to accommodate labels
                            title: {
                                display: true,
                                text: 'Persentase (%)'
                            },
                            position: 'left'
                        },
                        y1: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Kunjungan'
                            },
                            position: 'right',
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            font: {
                                weight: 'bold'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const index = context.dataIndex;
                                    const item = data[index];
                                    if (context.datasetIndex === 0) {
                                        return `Persentase: ${item.percentage}%`;
                                    } else {
                                        return `Aktual: ${item.actual} / Target: ${item.target}`;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        }

        function renderPieChart(data) {
            let totalActual = 0;
            let totalTarget = 0;
            data.forEach(item => {
                totalActual += Number(item.actual);
                totalTarget += Number(item.target);
            });

            const remaining = Math.max(0, totalTarget - totalActual);
            const ctx = document.getElementById('yearlyPieChart').getContext('2d');

            if (myPieChart) {
                myPieChart.destroy();
            }

            myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Tercapai', 'Sisa Target'],
                    datasets: [{
                        data: [totalActual, remaining],
                        backgroundColor: ['#ffffff', 'rgba(255, 255, 255, 0.2)'],
                        borderColor: 'transparent',
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 10,
                                padding: 10,
                                color: '#ffffff',
                                font: {
                                    size: 10
                                }
                            }
                        },
                        datalabels: {
                            color: (context) => context.dataIndex === 0 ? '#333' : '#fff',
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            anchor: 'center',
                            align: 'center',
                            formatter: (value, context) => {
                                if (value === 0) return '';
                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${percentage}%`;
                            }
                        }
                    }
                }
            });
        }

        function renderStats(data) {
            let html =
                '<div class="table-responsive"><table class="table table-sm table-borderless mb-0" style="font-size: 13px;">';
            let cardsHtml = '';
            let totalActual = 0;
            let totalTarget = 0;

            data.forEach(item => {
                const actual = Number(item.actual);
                const target = Number(item.target);
                totalActual += actual;
                totalTarget += target;

                // Table Row HTML
                html += `
                    <tr>
                        <td><strong>${item.month}</strong></td>
                        <td class="text-end">${item.actual} / ${item.target}</td>
                        <td class="text-end"><span class="badge ${item.percentage >= 80 ? 'bg-success' : (item.percentage >= 50 ? 'bg-warning' : 'bg-danger')}">${item.percentage}%</span></td>
                    </tr>
                `;

                // Monthly Card HTML Status Logic (Based on Yearly Report Reference)
                let cardColor, statusLabel, themeColor, lightBg;

                if (item.percentage >= 80) {
                    cardColor = 'success';
                    statusLabel = 'Excellent';
                    themeColor = '#34c38f';
                    lightBg = 'rgba(52, 195, 143, 0.08)';
                } else if (item.percentage >= 60) {
                    cardColor = 'warning';
                    statusLabel = 'Good';
                    themeColor = '#f1b44c';
                    lightBg = 'rgba(241, 180, 76, 0.1)';
                } else if (item.percentage >= 40) {
                    cardColor = 'info';
                    statusLabel = 'Fair';
                    themeColor = '#50a5f1';
                    lightBg = 'rgba(80, 165, 241, 0.1)';
                } else {
                    cardColor = 'danger';
                    statusLabel = 'Poor';
                    themeColor = '#f46a6a';
                    lightBg = 'rgba(244, 106, 106, 0.1)';
                }

                cardsHtml += `
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-none border" style="background-color: ${lightBg}; border-color: ${themeColor}33 !important;">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 fw-bold text-dark">${item.month}</h6>
                                    <span class="badge bg-${cardColor}-subtle text-${cardColor} border border-${cardColor}">${item.percentage}%</span>
                                </div>
                                <div class="mb-3">
                                    <span class="badge rounded-pill bg-${cardColor}" style="font-size: 9px; padding: 2px 8px;">${statusLabel}</span>
                                </div>
                                <h5 class="mb-2" style="color: ${themeColor}; font-weight: 700;">${item.actual} <small class="text-muted" style="font-size: 0.7em;">/ ${item.target}</small></h5>
                                <div class="progress" style="height: 6px; background-color: rgba(0,0,0,0.05);">
                                    <div class="progress-bar bg-${cardColor}" role="progressbar" style="width: ${Math.min(item.percentage, 100)}%" aria-valuenow="${item.percentage}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            const avgPercentage = totalTarget > 0 ? ((totalActual / totalTarget) * 100).toFixed(1) : '0.0';

            let yearlyColorName, yearlyThemeColor;
            if (avgPercentage >= 80) {
                yearlyColorName = 'success';
                yearlyThemeColor = '#34c38f';
            } else if (avgPercentage >= 60) {
                yearlyColorName = 'warning';
                yearlyThemeColor = '#f1b44c';
            } else if (avgPercentage >= 40) {
                yearlyColorName = 'info';
                yearlyThemeColor = '#50a5f1';
            } else {
                yearlyColorName = 'danger';
                yearlyThemeColor = '#f46a6a';
            }

            // Finalizing Table
            html += `
                <tr class="border-top">
                    <td><strong>TOTAL</strong></td>
                    <td class="text-end"><strong>${totalActual} / ${totalTarget}</strong></td>
                    <td class="text-end"><strong><span class="badge bg-primary">${avgPercentage}%</span></strong></td>
                </tr>
            </table></div>`;

            // Yearly Recap Large Card HTML
            const recapHtml = `
                <div class="card border-0 overflow-hidden shadow" style="background: linear-gradient(135deg, ${yearlyThemeColor}f0 0%, ${yearlyThemeColor} 100%);">
                    <div class="card-body p-4 position-relative">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <div class="row align-items-center text-white">
                                    <div class="col-sm-8">
                                        <h4 class="text-white mb-1 fw-bold">Rekapitulasi Tahunan</h4>
                                        <p class="text-white-50 mb-4 opacity-75">Ringkasan performa kunjungan selama periode tahun berjalan</p>
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <h2 class="text-white mb-0 fw-bold">${totalActual}</h2>
                                                <small class="text-white-50">Total Kunjungan</small>
                                            </div>
                                            <div class="col-6">
                                                <h2 class="text-white mb-0 fw-bold">${totalTarget}</h2>
                                                <small class="text-white-50">Total Target</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-center mt-4 mt-sm-0">
                                        <div class="display-4 fw-bold mb-0">${avgPercentage}%</div>
                                        <div class="badge bg-white text-${yearlyColorName} px-3 py-2 mt-2 shadow-sm">Achievement</div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-2">
                                    <div class="progress" style="height: 12px; background-color: rgba(255,255,255,0.2); border-radius: 10px;">
                                        <div class="progress-bar bg-white" role="progressbar" style="width: ${avgPercentage}%" aria-valuenow="${avgPercentage}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 border-start border-white-50 mt-4 mt-lg-0">
                                <h6 class="text-white text-center text-uppercase font-size-12 mb-3 fw-bold">Distribusi Pencapaian Tahunan</h6>
                                <div style="height: 180px;">
                                    <canvas id="yearlyPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('#statsContent').html(html);
            $('#monthlyDetailCards').html(cardsHtml);
            $('#yearlyRecapLargeCard').html(recapHtml);
        }
    </script>
@endsection
```
