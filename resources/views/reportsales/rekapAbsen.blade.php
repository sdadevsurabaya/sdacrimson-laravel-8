<div class="col-12">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Preview Rekap Visit</title>
        <style>
            @media print {
                body * {
                    visibility: hidden;
                }

                #data-excel,
                #data-excel * {
                    visibility: visible;
                }

                #data-excel {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black;
                text-align: center;
                padding: 5px;
            }

            th {
                background-color: #c0272d;
                color: #fff;
            }

            .highlight {
                background-color: yellow;
            }

            .holiday {
                background-color: pink;
            }
        </style>


        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
        <script>
            function exportToExcel() {
                // Ambil data dari tabel
                var table = document.getElementById('data-excel');

                // Ubah data tabel ke dalam bentuk yang dapat diexport ke Excel
                var wb = XLSX.utils.table_to_book(table, {
                    sheet: "Sheet JS"
                });

                // Tulis data ke file Excel
                XLSX.writeFile(wb, 'Rekap-Visit-Sales.xlsx');
            }
        </script>
    </head>

    <body>
        <div class="container-fluid" style="padding-top: 2rem;">
            <div class="mb-3 text-end">
                <button class="btn btn-dark" onclick="printContent()">Print</button>
                <button onclick="exportToExcel()" class="btn btn-success">Export ke Excel</button>
            </div>
            {{-- <h5 class="text-start mb-3"></h5> --}}
            <table id="data-excel">
                <thead>
                    <tr>
                        <th colspan="10" style="border: none;">Rekap Absen {{ $userJadwal->user->name }}</th>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Nama Customer</th>
                        <th>Alamat</th>
                        <th>Jarak</th>
                        <th>Durasi</th>
                        <th>Area</th>
                        <th>Type Aktifitas</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $lastCheckIn = null;
                        $lastCheckOut = null;
                        $total = 0;
                    @endphp
                    @foreach ($laporan as $item)
                        <tr>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>

                            {{-- @php
                            $checkInTime = null;
                            $checkOutTime = null;

                            foreach ($item->attendance as $attendances) {
                                if ($attendances->status == 'check in' && $attendances->jadwal_id == $item->jadwal_id) {
                                    $checkInTime = $attendances->created_at->format('H:i');
                                    $lastCheckIn = $checkInTime;
                                }
                                if ($attendances->status == 'check out' && $attendances->jadwal_id == $item->jadwal_id) {
                                    $checkOutTime = $attendances->created_at->format('H:i');
                                    $lastCheckOut = $checkOutTime;
                                }
                            }
                        @endphp
                 --}}
                            {{-- <td>{{ $loop->last && $lastCheckIn == $checkInTime ? '' : $checkInTime }}</td>
                        <td>{{ $loop->last && $lastCheckOut == $checkOutTime ? '' : $checkOutTime }}</td> --}}

                            <td>
                                @foreach ($item->attendance as $attendances)
                                    @if ($attendances->status == 'check in')
                                        {{ $attendances->created_at->format('H:i') }}
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->attendance as $attendances)
                                @if ($attendances->status == 'check out')
                                    {{ $attendances->created_at->format('H:i') }}
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $item->general->nama_usaha }}</td>
                    <td>{{ $item->general->alamat_kantor }}</td>
                    <td>
                        @foreach ($item->jarak as $jaraks)
                            @if ($jaraks->jadwal_id == $item->jadwal_id && $jaraks->general_id == $item->general_id)
                            @php
                                    $jarak=$jaraks->distance/1000;
                                    $total+= $jarak;
                                    @endphp
                            {{ number_format($jarak, 2, ',', '.') }} km
                            @break
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($item->jarak as $jaraks)
                        @if ($jaraks->jadwal_id == $item->jadwal_id && $jaraks->general_id == $item->general_id)
                            {{ $jaraks->duration_web }} Menit
                        @break
                    @endif
                @endforeach
            </td>
            <td>{{ $item->general->area }}</td>
            <td>
                @foreach ($item->detailJadwal as $detail)
                    @if ($detail->jadwal_id == $item->jadwal_id && $detail->general_id == $item->general_id)
                        {{ $detail->activity_type }}
                    @break
                @endif
            @endforeach
        </td>
        <td>{{ $item->general->email }}</td>

    </tr>
@endforeach
<tr>
    <td colspan="5">TOTAL</td>
    <td>{{ number_format($total, 2, ',', '.') }} km</td>
    <td colspan="4"></td>
</tr>
</tbody>
</table>
</div>


</body>
<script>
    function printContent() {
        window.print();
    }
</script>

</html>

</div>
