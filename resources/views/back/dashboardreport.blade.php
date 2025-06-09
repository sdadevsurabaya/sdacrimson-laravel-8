@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <style>
        .week-label {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .productivity-cell {
            font-weight: bold;
            color: #28a745;
        }

        .agenda-entry {
            background-color: #f1f1f1;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .table>thead {
            vertical-align: middle;
        }

        .table td {
            vertical-align: baseline;
        }

        .table th {
            padding: 2px 4px 2px 4px;
        }

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
    </style>
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Report
        @endslot
        @slot('title')
            Report Sales Weekly
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

        <h1 class="mb-4">Daftar Sales</h1>

        <div class="row mb-4">
            <form method="GET" action="{{ route('back.dashboardreport.index') }}" class="row g-3">
                <div class="col-auto">
                    <label for="month" class="form-label">Bulan</label>
                    <input type="number" name="month" id="month" class="form-control" min="1" max="12"
                        value="{{ $month }}">
                </div>
                <div class="col-auto">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="number" name="year" id="year" class="form-control" min="2000"
                        value="{{ $year }}">
                </div>
                <div class="col-auto d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>
        </div>

        <div class="list-group mb-5">
            <div class="row g-4">
                @foreach ($sales as $sale)
                    <div class="col-sm-6 col-lg-4 col-xl-3" style="cursor: pointer;">
                        <div class="card position-relative shadow-sm"
                            onclick="modalInitial1('agendaModal{{ $sale->id }}');">
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @foreach ($sales as $sale)
                <!-- Modal -->
                <div class="modal fade" id="agendaModal{{ $sale->id }}" data-bs-backdrop="static" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-capitalize" id="agendaModalLabel{{ $sale->id }}">
                                    Agenda Bulanan - {{ $sale->name }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                @php
                                    $totalmonthproductivity = 0;
                                    $totalweeks = 0;
                                @endphp
                                @foreach ($weeks as $i => $week)
                                    @php
                                        $activeDays = 0;
                                        $totalProductivity = 0;
                                        $monthStart = \Carbon\Carbon::createFromFormat(
                                            'm',
                                            date('m', strtotime('2025-' . ($i + 1) . '-01')),
                                        )
                                            ->startOfMonth()
                                            ->format('d');
                                        $monthEnd = \Carbon\Carbon::createFromFormat(
                                            'm',
                                            date('m', strtotime('2025-' . ($i + 1) . '-01')),
                                        )
                                            ->endOfMonth()
                                            ->format('d');
                                    @endphp
                                    <div class="table-responsive mb-4">
                                        <table class="table table-bordered text-center align-middle bg-white"
                                            style="table-layout: fixed;">
                                            <thead class="table-primary" style="vertical-align:middle;">
                                                <tr>
                                                    <th class="week-label">W{{ $i + 1 }}</th>
                                                    @foreach ($week as $day)
                                                        @if ($day)
                                                        {{-- @dump($day) --}}
                                                            @php
                                                                $carbonDate = \Carbon\Carbon::createFromFormat(
                                                                    'd/m/Y',
                                                                    $day['date'] . '/2025',
                                                                );
                                                                $isProductive =
                                                                    $carbonDate->dayOfWeek < 6 &&
                                                                    $carbonDate->dayOfWeek > 0; // Senin-Jumat
                                                                $isInMonth =
                                                                    $carbonDate->day >= $monthStart &&
                                                                    $carbonDate->day <= $monthEnd;
                                                            @endphp
                                                            <th>
                                                                {{ $isInMonth ? $carbonDate->translatedFormat('l') : '-' }}<br>({{ $isInMonth ? $carbonDate->format('Y-m-d') : '-' }})
                                                            </th>
                                                        @else
                                                            <th>-</th>
                                                        @endif
                                                    @endforeach
                                                    <th>Total</th>
                                                    <th>Productivity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="week-label" style="vertical-align: middle">Agenda</td>
                                                    @php
                                                        $notActiveDays = 0;
                                                    @endphp
                                                    @foreach ($week as $day)
                                                        @if ($day)
                                                            @php
                                                                $dateFormatted = \Carbon\Carbon::createFromFormat(
                                                                    'd/m/Y',
                                                                    $day['date'] . '/2025',
                                                                )->format('Y-m-d');
                                                                $dayAgendas = $agendas[$sale->id][$dateFormatted] ?? [];
                                                                $carbonDate = \Carbon\Carbon::createFromFormat(
                                                                    'd/m/Y',
                                                                    $day['date'] . '/2025',
                                                                );
                                                                $isProductive =
                                                                    $carbonDate->dayOfWeek < 6 &&
                                                                    $carbonDate->dayOfWeek > 0; // Senin-Jumat
                                                                $isInMonth =
                                                                    $carbonDate->day >= $monthStart &&
                                                                    $carbonDate->day <= $monthEnd;
                                                            @endphp
                                                            <td>
                                                                @if ($day['off'])
                                                                    <span class="text-danger fw-bolder">HARI LIBUR | {{ $day['keteranganOff'] }}</span>
                                                                @elseif (!$isInMonth)
                                                                    <span>-</span>
                                                                @else
                                                                    @if (count($dayAgendas) > 0)
                                                                        @foreach ($dayAgendas as $agenda)
                                                                            <div class="agenda-entry text-start {{ $agenda->activity_type == 'Meeting' || $agenda->activity_type == 'Telepon Out' ? 'bg-info' : (!empty($agenda->checkin_status) && !empty($agenda->checkout_status) ? 'bg-success' : ((empty($agenda->checkin_status) && !empty($agenda->checkout_status)) || (!empty($agenda->checkin_status) && empty($agenda->checkout_status)) ? 'bg-warning' : 'bg-danger')) }}"
                                                                                onclick='modalInitial2("ModalReport", @json($agenda));'
                                                                                style="cursor:pointer;">
                                                                                <div><strong>Type:</strong>
                                                                                    {{ $agenda->activity_type }}</div>
                                                                                <div><strong>Customer:</strong>
                                                                                    {{ $agenda->customer }}</div>
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        @if ($carbonDate->translatedFormat('l') == 'Saturday')
                                                                            <span class="fw-bolder">REPORT WEEKLY</span>
                                                                        @else
                                                                        <span class="fw-bolder">TIDAK ADA AKTIVITAS</span>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @php
                                                                if ($isProductive && $isInMonth && !$day['off']) {
                                                                    $activeDays++;
                                                                }
                                                            @endphp
                                                        @else
                                                            @php
                                                                $notActiveDays++;
                                                            @endphp
                                                            <td>-</td>
                                                        @endif
                                                    @endforeach
                                                    <td rowspan="2" style="vertical-align: middle; font-weight:bold;">
                                                        @php
                                                            $productiveCount = 0;
                                                            foreach ($week as $day) {
                                                                if (
                                                                    $day &&
                                                                    $carbonDate->day >= $monthStart &&
                                                                    $carbonDate->day <= $monthEnd
                                                                ) {
                                                                    $dateFormatted = \Carbon\Carbon::createFromFormat(
                                                                        'd/m/Y',
                                                                        $day['date'] . '/2025',
                                                                    )->format('Y-m-d');
                                                                    $dayAgendas =
                                                                        $agendas[$sale->id][$dateFormatted] ?? [];
                                                                    $productivityCount = 0;
                                                                    $totalCount = 3; // Target minimum 3 per hari
                                                                    foreach ($dayAgendas as $agenda) {
                                                                        if (
                                                                            $agenda->activity_type == 'Visit' &&
                                                                            !empty($agenda->checkin_status) &&
                                                                            !empty($agenda->checkout_status)
                                                                        ) {
                                                                            $productivityCount++;
                                                                        }
                                                                    }
                                                                    $productiveCount += $productivityCount;
                                                                }
                                                            }
                                                            // echo $notActiveDays . ' hari tidak aktif<br>';
                                                            echo number_format($productiveCount, 0);
                                                        @endphp
                                                    </td>
                                                    <td rowspan="2" class="productivity-cell"
                                                        style="vertical-align: middle">
                                                        @php
                                                            $productiveCount = 0;
                                                            foreach ($week as $day) {
                                                                if (
                                                                    $day &&
                                                                    $carbonDate->day >= $monthStart &&
                                                                    $carbonDate->day <= $monthEnd
                                                                ) {
                                                                    $dateFormatted = \Carbon\Carbon::createFromFormat(
                                                                        'd/m/Y',
                                                                        $day['date'] . '/2025',
                                                                    )->format('Y-m-d');
                                                                    $dayAgendas =
                                                                        $agendas[$sale->id][$dateFormatted] ?? [];
                                                                    $productivityCount = 0;
                                                                    $totalCount = 3; // Target minimum 3 per hari
                                                                    foreach ($dayAgendas as $agenda) {
                                                                        if (
                                                                            $agenda->activity_type == 'Visit' &&
                                                                            !empty($agenda->checkin_status) &&
                                                                            !empty($agenda->checkout_status)
                                                                        ) {
                                                                            $productivityCount++;
                                                                        }
                                                                    }
                                                                    $effectiveCount = min(
                                                                        $productivityCount,
                                                                        $totalCount,
                                                                    );
                                                                    $productiveCount +=
                                                                        ($effectiveCount / $totalCount) * 100;
                                                                }
                                                            }
                                                            $productiveDays = $activeDays;
                                                            if ($productiveDays > 0) {
                                                                echo number_format(
                                                                    $productiveCount / $productiveDays,
                                                                    1,
                                                                );
                                                            } else {
                                                                echo '0';
                                                            }
                                                            echo ' %';
                                                        @endphp
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Productivity</td>
                                                    @foreach ($week as $day)
                                                        @if ($day)
                                                            @php
                                                                $dateFormatted = \Carbon\Carbon::createFromFormat(
                                                                    'd/m/Y',
                                                                    $day['date'] . '/2025',
                                                                )->format('Y-m-d');

                                                                $dayAgendas = $agendas[$sale->id][$dateFormatted] ?? [];
                                                                $carbonDate = \Carbon\Carbon::createFromFormat(
                                                                    'd/m/Y',
                                                                    $day['date'] . '/2025',
                                                                );
                                                                $isSaturday = $carbonDate->dayOfWeek < 6;
                                                                $dayOrNo = '-';
                                                                if ($isSaturday) {
                                                                    $isProductive =
                                                                        $carbonDate->dayOfWeek < 6 &&
                                                                        $carbonDate->dayOfWeek > 0; // Senin-Jumat
                                                                    $isInMonth =
                                                                        $carbonDate->day >= $monthStart &&
                                                                        $carbonDate->day <= $monthEnd;
                                                                    $productivityCount = 0;
                                                                    $totalCount = 3; // Target minimum 3 per hari
                                                                    foreach ($dayAgendas as $agenda) {
                                                                        if (
                                                                            $agenda->activity_type == 'Visit' &&
                                                                            !empty($agenda->checkin_status) &&
                                                                            !empty($agenda->checkout_status)
                                                                        ) {
                                                                            $productivityCount++;
                                                                        }
                                                                    }
                                                                    $effectiveCount = min(
                                                                        $productivityCount,
                                                                        $totalCount,
                                                                    );
                                                                    $productivityPercentage =
                                                                        $isProductive && $isInMonth && !$day['off']
                                                                            ? ($effectiveCount / $totalCount) * 100
                                                                            : 0;
                                                                    $dayOrNo = number_format(
                                                                        $productivityPercentage,
                                                                        1,
                                                                    ).'%';
                                                                }

                                                            @endphp
                                                            <td>{{ $dayOrNo }}</td>
                                                        @else
                                                            <td>-</td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @php
                                        if ($activeDays > 0) {
                                            $totalmonthproductivity += $productiveCount / $activeDays;
                                            $totalweeks++;
                                        }
                                    @endphp
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <div class="mx-auto">
                                <h3>Month Productivity @php
                                    if ($totalweeks > 0) {
                                        echo number_format($totalmonthproductivity / $totalweeks, 1);
                                    } else {
                                        echo '0';
                                    }
                                @endphp
                                    %
                                </h3>
                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="ModalReport" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Notes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Type Aktivitas:</strong> <small class="text-muted" id="type-modal2"></small>
                    <br>
                    <strong>Customer:</strong> <small class="text-muted" id="cst-modal2"></small>
                    <br>
                    <strong>Laporan:</strong> <small class="text-muted" id="hasil-report"></small>

                    <div id="multi-maps" class="row mt-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let modalCount = 0;

        function adjustModalZIndex(modal) {
            modalCount++;
            const zIndexModal = 1041 + (10 * modalCount);
            const zIndexBackdrop = 1039 + (10 * modalCount);

            modal.style.zIndex = zIndexModal;

            // Set z-index untuk backdrop terbaru
            const backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 0) {
                const backdrop = backdrops[backdrops.length - 1];
                backdrop.style.zIndex = zIndexBackdrop;
            }
        }

        function resetModalZIndex(modal) {
            modalCount--;

            // Reset z-index modal
            modal.style.zIndex = '';

            // Jika tidak ada modal yang terbuka, sembunyikan semua backdrop
            if (modalCount <= 0) {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => {
                    backdrop.classList.remove('show');
                    backdrop.style.display = 'none';
                });
                modalCount = 0; // Reset modalCount agar tidak negatif
            } else {
                // Atur z-index backdrop untuk modal yang masih terbuka
                const zIndexBackdrop = 1039 + (10 * modalCount);
                const backdrops = document.querySelectorAll('.modal-backdrop');
                if (backdrops.length > 0) {
                    const backdrop = backdrops[backdrops.length - 1];
                    backdrop.style.zIndex = zIndexBackdrop;
                }
            }
        }

        const modals = document.querySelectorAll('.modal');

        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', () => {
                adjustModalZIndex(modal);
            });

            modal.addEventListener('hidden.bs.modal', () => {
                resetModalZIndex(modal);
            });
        });

        function modalInitial1(modalId) {
            const myModal1 = new bootstrap.Modal(document.getElementById(modalId));
            myModal1.show();
        }

        function modalInitial2(modalId, dataObj) {
            const myModal2 = new bootstrap.Modal(document.getElementById(modalId));
            const type = document.getElementById('type-modal2');
            const cust = document.getElementById('cst-modal2');
            const report = document.getElementById('hasil-report');
            type.textContent = dataObj.activity_type;
            cust.textContent = dataObj.customer;
            report.textContent = dataObj.laporan_kunjungan;
            // console.log(dataObj);

            // report.textContent = laporan;
            initMap(dataObj);
            // var mapsUrl = `https://maps.google.com/maps?q=${lat},${long}&z=15&output=embed&t=k`;
            // document.getElementById('map-iframe-in').src = mapsUrl;
            // document.getElementById('map-iframe-out').src = mapsUrl;
            // Jika modal sudah terbuka, panggil initMap
            myModal2.show();
        }

        function initMap(jsonObj) {
            const multiMaps = document.getElementById('multi-maps');
            multiMaps.innerHTML = ''; // Clear previous content

            const assetPath = (file) => `https://crimson.sda.id/attendance/${file}`;

            const createSection = (type) => {
                const prefix = type === 'Check-In' ? 'checkin' : 'checkout';
                const foto = jsonObj[`${prefix}_foto`];
                const latitude = jsonObj[`${prefix}_latitude`];
                const longitude = jsonObj[`${prefix}_longitude`];
                const waktu = jsonObj[`${prefix}_time`];

                if (foto && latitude && longitude && waktu) {
                    const date = new Date(waktu);
                    // const timeWIB = date.toLocaleTimeString('id-ID', {
                    //     timeZone: 'Asia/Jakarta',
                    //     hour12: false
                    // });

                    let timeUTC = date.toLocaleTimeString('id-ID', {
                        timeZone: 'UTC',
                        hour12: false
                    });

                    return `
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center">
                    <strong>Foto (${type}):</strong>
                    <img src="${assetPath(foto)}" alt="${type}" width="70%" height="auto" class="img-fluid" />
                    <strong>Waktu (${type}):</strong>
                    <p>${timeUTC}</p>
                    <strong>Lokasi (${type}):</strong>
                    <iframe src="https://maps.google.com/maps?q=${latitude},${longitude}&z=15&output=embed&t=k"
                        width="100%" height="400" style="border:0;padding-top:30px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>`;
                } else {
                    return `
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-center">
                    <strong>Foto (${type}):</strong>
                    <p>Belum ${type.toLowerCase()}</p>
                    <strong>Lokasi (${type}):</strong>
                    <p>Belum tersedia</p>
                </div>
            </div>`;
                }
            };

            multiMaps.innerHTML = `
            <div class="row">
                ${createSection('Check-In')}
                ${createSection('Check-Out')}
            </div>`;
        }
    </script>
    {{-- <script src="{{ URL::asset('/assets/libs/jquery/jquery.min.js') }}"></script> --}}
@endsection
