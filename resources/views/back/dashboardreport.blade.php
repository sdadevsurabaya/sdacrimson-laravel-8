<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Agenda Bulanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>

<body class="p-4 bg-light">
    <div class="container">
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
                    <input type="number" name="year" id="year" class="form-control" min="2000" value="{{ $year }}">
                </div>
                <div class="col-auto d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </form>
        </div>

        <div class="list-group mb-5">
            @foreach ($sales as $sale)
                <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal"
                    data-bs-target="#agendaModal{{ $sale->id }}">
                    {{ $sale->name }}
                </button>
                <!-- Modal -->
                <div class="modal fade" id="agendaModal{{ $sale->id }}" tabindex="-1"
                    aria-labelledby="agendaModalLabel{{ $sale->id }}" aria-hidden="true">
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
                                        <table class="table table-bordered text-center align-middle bg-white">
                                            <thead>
                                                <tr>
                                                    <th class="week-label">W{{ $i + 1 }}</th>
                                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                                        <th>{{ $hari }}</th>
                                                    @endforeach
                                                    <th>Total</th>
                                                    <th>Productivity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="week-label">Agenda {{$sale->id}}</td>
                                                    @php $activeCount = 0; @endphp
                                                    @foreach ($week as $day)
                                                        @if ($day)
                                                            @php
                                                            if(($sale->id)==19)
                                                            {
                                                                // @dump($agendas[$sale->id][\Carbon\Carbon::createFromFormat('d/m/Y', $day['date'] . '/2025')->format('Y-m-d')]);
                                                            }
                                                                $dayAgendas = $agendas[$sale->id][\Carbon\Carbon::createFromFormat('d/m/Y', $day['date'] . '/2025')->format('Y-m-d')] ?? [];
                                                            @endphp
                                                            <td>
                                                                
                                                                <div><strong>
                                                                    {{-- {{ $day['date'] }} --}}
                                                                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', $day['date'] . '/2025')->format('Y-m-d') }}    
                                                                </strong></div>
                                                                @foreach ($dayAgendas as $agenda)
                                                                    <div class="agenda-entry text-start" data-bs-toggle="modal" data-bs-target="#ModalReport" style="cursor:pointer;">                                                                    <div><strong>Type:</strong> {{ $agenda->activity_type }}</div>
                                                                        {{-- <div><strong>Catatan:</strong> {{ $agenda->catatan }}</div> --}}
                                                                        <div><strong>Customer:</strong> {{ $agenda->customer }}</div>
                                                                        {{-- <div><strongD>Laporan:</strong> <small class="text-muted">{{ $agenda->laporan_kunjungan }}</small></div> --}}
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
                                                        {{ number_format(($activeCount / 7) * 100, 1) }}%
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                         
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="ModalReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strongD>Laporan:</strong> <small class="text-muted">{{ $agenda->laporan_kunjungan }}</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
