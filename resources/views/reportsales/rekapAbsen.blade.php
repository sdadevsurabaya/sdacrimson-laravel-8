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
                        $lastCheckOut = !empty($start) ? $start->created_at : null;
                        $total = 0;
                    @endphp

                    {{-- @dump($start)
                    @dump($stop) --}}
                    @php
                        $userCabang = trim(strtolower($userJadwal->user->cabang->cabang ?? ''));
                        $startLocation = 'SDA GLOBAL INDONESIA';
                        $startAddress = 'Pertokoan Raden Saleh, Jalan Raden Saleh No.45, Permai Kav No.19-20';

                        if ($userCabang == 'surabaya') {
                            $startLocation = 'SDA Surabaya';
                            $startAddress = 'Pertokoan Raden Saleh, Jalan Raden Saleh No.45, Permai Kav No.19-20';
                        } elseif ($userCabang == 'jakarta') {
                            $startLocation = 'SDA Jakarta';
                            $startAddress = 'Komp. Puri Mutiara Blok BD No. 8 Jl. Raya Griya Utama, Sunter Agung';
                        } elseif ($userCabang == 'semarang') {
                            $startLocation = 'SDA Semarang';
                            $startAddress = 'Komp. THD Blok C No. 25-26 Jl. KH. Agus Salim Purwodinatan';
                        } elseif ($userCabang == 'balikpapan') {
                            $startLocation = 'SDA Balikpapan';
                            $startAddress = 'Jl. Mayjen Sutoyo No. 39 Gunung Sari Ulu, Balikpapan';
                        } else {
                            $debugCabang = $userCabang == '' ? 'Tanpa Cabang' : $userCabang;
                            $startLocation = $userJadwal->user->hasRole('Driver') ? 'SDA MARGOMULYO' : 'SDA GLOBAL INDONESIA (' . $debugCabang . ')';
                            $startAddress = $userJadwal->user->hasRole('Driver') ? 'Jl. Margomulyo Indah 1A No. 7-8, Surabaya' : 'Pertokoan Raden Saleh, Jalan Raden Saleh No.45, Permai Kav No.19-20';
                        }
                    @endphp
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            @if (!empty($start))
                                {{ $start->created_at->format('H:i') }}
                            @endif

                        </td>
                        <td>{{ $startLocation }}</td>
                        <td>{{ $startAddress }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    {{-- @dump(end($laporan)) --}}
                    @foreach ($laporan as $key => $item)
                        <tr>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                @php $current_checkin = null; @endphp
                                @if ($key == count($laporan) - 1 && !empty($stop))
                                    @php $current_checkin = $stop->created_at; @endphp
                                    {{ $stop->created_at->format('H:i') }}
                                @else
                                    @foreach ($item->attendance as $attendances)
                                        @if ($attendances->status == 'check in')
                                            @php $current_checkin = $attendances->created_at; @endphp
                                            {{ $attendances->created_at->format('H:i') }}
                                        @break
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                        <td>
                            @php $current_checkout = null; @endphp
                            @if (!($key == count($laporan) - 1 && !empty($stop)))
                                @foreach ($item->attendance as $attendances)
                                    @if ($attendances->status == 'check out')
                                        @php $current_checkout = $attendances->created_at; @endphp
                                        {{ $attendances->created_at->format('H:i') }}
                                    @break
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    <td>{{ $item->general_id == 553 ? $startLocation : ($item->general->nama_usaha ?? '') }}</td>
                    <td>{{ $item->general_id == 553 ? $startAddress : ($item->general->alamat_kantor ?? '') }}</td>
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
                    @php
                        $durasi_menit = 0;
                        if ($current_checkin && $lastCheckOut) {
                            $time1 = \Carbon\Carbon::parse($lastCheckOut->format('Y-m-d H:i:00'));
                            $time2 = \Carbon\Carbon::parse($current_checkin->format('Y-m-d H:i:00'));
                            $diff = $time1->diffInMinutes($time2, false);
                            $durasi_menit = $diff > 0 ? $diff : 0;
                        }
                    @endphp
                    {{ $durasi_menit }} Menit
                </td>
                <td>{{ $item->odo_km ?? '-' }}</td>
        </tr>
        @php
            if ($current_checkout) {
                $lastCheckOut = $current_checkout;
            } elseif ($current_checkin) {
                $lastCheckOut = $current_checkin;
            }
        @endphp
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
                            <div style="font-weight: bold; margin-bottom: 10px;">Dibuat Oleh</div>
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">...........................</div>
                                    <div style="font-size: 12px; margin-top: 4px; font-weight: bold;">&nbsp;</div>
                                </div>
                            </div>
                        </td>
                        {{-- Menyetujui --}}
                        <td style="border: none; text-align: center; width: 33%; padding: 0 10px;">
                            <div style="font-weight: bold; margin-bottom: 10px;">Menyetujui</div>
                            <div style="display: flex; justify-content: space-around; gap: 10px;">
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">...........................</div>
                                    <div style="font-size: 12px; margin-top: 4px; font-weight: bold;">Log Margo</div>
                                </div>
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">...........................</div>
                                    <div style="font-size: 12px; margin-top: 4px; font-weight: bold;">Log Toko</div>
                                </div>
                            </div>
                        </td>
                        {{-- Mengetahui --}}
                        <td style="border: none; text-align: center; width: 33%; padding: 0 10px;">
                            <div style="font-weight: bold; margin-bottom: 10px;">Mengetahui</div>
                            <div style="display: flex; justify-content: center; gap: 10px;">
                                <div style="flex: 1; text-align: center;">
                                    <div style="height: 70px;">&nbsp;</div>
                                    <div style="padding-top: 5px;">...........................</div>
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
