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

                #print-area,
                #print-area * {
                    visibility: visible;
                }

                #print-area {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }

                .no-print {
                    display: none !important;
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
            <div class="mb-3 text-end no-print">
                <button class="btn btn-dark" onclick="printContent()">Print</button>
                <button onclick="exportToExcel()" class="btn btn-success">Export ke Excel</button>
            </div>
            <div id="print-area">
            {{-- <h5 class="text-start mb-3"></h5> --}}
            <table id="data-excel">
                <thead>
                    <tr>
                        <th colspan="8" style="border: none; text-transform:capitalize;">Rekap Absen
                            {{ $userJadwal->user->name }}</th>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Nama Customer</th>
                        <th>Alamat</th>
                        <th>Jarak</th>
                        <th>Durasi</th>
                        <th>Odo KM</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $lastCheckIn = null;
                        $lastCheckOut = null;
                        $total = 0;
                    @endphp

                    {{-- @dump($start)
                    @dump($stop) --}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            @if (!empty($start))
                                {{ $start->created_at->format('H:i') }}
                            @endif

                        </td>
                        <td>SDA GLOBAL INDONESIA</td>
                        <td>Pertokoan Raden Saleh, Jalan Raden Saleh No.45, Permai Kav No.19-20 </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @dump(end($laporan)) --}}
                    @foreach ($laporan as $key => $item)
                        <tr>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($key == count($laporan) - 1 && !empty($stop))
                                    {{ $stop->created_at->format('H:i') }}
                                @else
                                    @foreach ($item->attendance as $attendances)
                                        @if ($attendances->status == 'check in')
                                            {{ $attendances->created_at->format('H:i') }}
                                        @break
                                        @endif
                                    @endforeach
                                @endif
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
            <td>{{ $item->odo_km ?? '-' }}</td>
    </tr>
@endforeach
<tr>
    <td colspan="5" style="text-align: right; font-weight:bold;">TOTAL</td>
    <td style="font-weight:bold;">{{ number_format($total, 2, ',', '.') }} km</td>
    <td colspan="2"></td>
</tr>
</tbody>
</table>

            {{-- Area Tanda Tangan --}}
            <div id="area-ttd" style="margin-top: 40px; width: 100%;">
                <table style="width: 100%; border: none; border-collapse: collapse;">
                    <tr style="vertical-align: top;">
                        {{-- Dibuat Oleh --}}
                        <td style="border: none; text-align: center; width: 33%; padding: 0 10px;">
                            <div style="font-weight: bold; margin-bottom: 10px;">Dibuat Oleh,</div>
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">( ........................... )</div>
                                    <div style="font-size: 12px; margin-top: 4px; font-weight: bold;">&nbsp;</div>
                                </div>
                            </div>
                        </td>
                        {{-- Menyetujui --}}
                        <td style="border: none; text-align: center; width: 33%; padding: 0 10px;">
                            <div style="font-weight: bold; margin-bottom: 10px;">Menyetujui,</div>
                            <div style="display: flex; justify-content: space-around; gap: 10px;">
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">( ........................... )</div>
                                    <div style="font-size: 12px; margin-top: 4px; font-weight: bold;">Log Margo</div>
                                </div>
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">( ........................... )</div>
                                    <div style="font-size: 12px; margin-top: 4px; font-weight: bold;">Log Toko</div>
                                </div>
                            </div>
                        </td>
                        {{-- Mengetahui --}}
                        <td style="border: none; text-align: center; width: 33%; padding: 0 10px;">
                            <div style="font-weight: bold; margin-bottom: 10px;">Mengetahui,</div>
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">( ........................... )</div>
                                    <div style="font-size: 12px; margin-top: 4px; font-weight: bold;">HCS</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            </div>{{-- end print-area --}}

        </div>


</body>
<script>
    function printContent() {
        window.print();
    }
</script>

</html>

</div>
