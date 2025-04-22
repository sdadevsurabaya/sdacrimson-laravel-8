<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Agenda Bulanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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
</head>

<body class="p-4 bg-light">
    <div class="container">
        <h1 class="mb-4">Daftar Sales</h1>

        <div class="row mb-4">
            <form method="GET" action="{{ route('back.dashboardreport.index') }}" class="row g-3">
                <div class="col-auto">
                    <label for="month" class="form-label">Bulan</label>
                    <input type="number" name="month" id="month" class="form-control" min="1"
                        max="12" value="{{ $month }}">
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
            {{-- <div class="row g-4">
                @foreach ($sales as $sale)
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card position-relative shadow-sm"
                            onclick="modalInitial1('agendaModal{{ $sale->id }}');">
                            <div class="card-body">
                                <span class="badge bg-danger company-badge">active</span>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar bg-sda me-3">R</div>
                                    <div>
                                        <h6 class="mb-0">Rizky Nanda</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class='bx bx-child bx-md'></i> Sales Representative
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}
            <div class="row g-4">
                @foreach ($sales as $sale)
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card position-relative shadow-sm"
                            onclick="modalInitial1('agendaModal{{ $sale->id }}');">
                            <div class="card-body">
                                <span class="badge bg-danger company-badge">active</span>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar bg-sda me-3">{{ Str::upper(Str::substr($sale->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $sale->name }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center text-muted">
                                    <i class='bx bx-child bx-md'></i> Sales Representative
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <button type="button" class="list-group-item list-group-item-action"
                    onclick="modalInitial1('agendaModal{{ $sale->id }}');">
                    {{ $sale->name }}
                </button> --}}
                    <!-- Modal -->
                    <div class="modal fade" id="agendaModal{{ $sale->id }}">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="agendaModalLabel{{ $sale->id }}">
                                        Agenda Bulanan - {{ $sale->name }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($weeks as $i => $week)
                                        <div class="table-responsive mb-4">
                                            <table class="table table-bordered text-center align-middle bg-white"
                                                style="table-layout: fixed;">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th class="week-label">W{{ $i + 1 }}</th>
                                                        @foreach ($week as $day)
                                                            @if ($day)
                                                                @php
                                                                    $carbonDate = \Carbon\Carbon::createFromFormat(
                                                                        'd/m/Y',
                                                                        $day['date'] . '/2025',
                                                                    );
                                                                @endphp
                                                                <th>
                                                                    {{ $carbonDate->translatedFormat('l') }}<br>({{ $carbonDate->format('Y-m-d') }})
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
                                                        <td class="week-label">Agenda {{ $sale->id }}</td>
                                                        @php $activeCount = 0; @endphp

                                                        @foreach ($week as $day)
                                                            @if ($day)
                                                                @php
                                                                    $dateFormatted = \Carbon\Carbon::createFromFormat(
                                                                        'd/m/Y',
                                                                        $day['date'] . '/2025',
                                                                    )->format('Y-m-d');
                                                                    $dayAgendas =
                                                                        $agendas[$sale->id][$dateFormatted] ?? [];
                                                                @endphp

                                                                <td>
                                                                    @foreach ($dayAgendas as $agenda)
                                                                        <div class="agenda-entry text-start"
                                                                            onclick="modalInitial2('ModalReport', `{{ $agenda->laporan_kunjungan }}`);"
                                                                            style="cursor:pointer;">
                                                                            <div><strong>Type:</strong>
                                                                                {{ $agenda->activity_type }}</div>
                                                                            <div><strong>Customer:</strong>
                                                                                {{ $agenda->customer }}</div>
                                                                        </div>
                                                                    @endforeach
                                                                </td>
                                                                @php $activeCount++; @endphp
                                                            @else
                                                                <td>-</td>
                                                            @endif
                                                        @endforeach

                                                        <td>{{ $activeCount }}</td>
                                                        <td class="productivity-cell">
                                                            {{ number_format(($activeCount / 7) * 100, 1) }}%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalReport" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Notes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Laporan:</strong> <small class="text-muted"
                        id="hasil-report">{{ $agenda->laporan_kunjungan }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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

            // Jika tidak ada modal yang terbuka, pastikan semua backdrop disembunyikan
            if (modalCount <= 0) {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => {
                    backdrop.classList.remove('show');
                    backdrop.style.display = 'none';
                });
                modalCount = 0; // Reset modalCount untuk mencegah nilai negatif
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
            // e.preventDefault();
            myModal1.show();
        }

        function modalInitial2(modalId, laporan) {
            const myModal2 = new bootstrap.Modal(document.getElementById(modalId));
            const report = document.getElementById('hasil-report');
            report.textContent = laporan;
            myModal2.show();
        }
    </script>


</body>

</html>
