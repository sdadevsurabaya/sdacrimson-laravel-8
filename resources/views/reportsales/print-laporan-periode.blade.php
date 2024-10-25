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
                background-color: #f2f2f2;
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
      var wb = XLSX.utils.table_to_book(table, {sheet:"Sheet JS"});

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
                <a href="{{ route('laporan.index') }}" class="btn btn-danger">Back</a>
            </div>
            {{-- <h5 class="text-start mb-3"></h5> --}}
            <table id="data-excel">
                <thead>
                    <tr>
                        {{-- <th colspan="9" style="border: none;">Rekap Visit {{ $userJadwal->user->name}}</th> --}}
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <th>Sales</th>
                        <th>Nama Customer</th>
                        <th>Alamat</th>
                        <th>Area</th>
                        <th>CP</th>
                        <th>HP</th>
                        <th>Keterangan</th>
                        <th>Type Aktifitas</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        dd($laporan)
                    @endphp
                    @foreach($laporan as $item)
                    <tr>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->general->nama_usaha }}</td>
                        <td>{{ $item->general->alamat_kantor }}</td>
                        <td>{{ $item->general->area }}</td>
                        <td>{{ $item->contact_person }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->pesan }}</td>
                        <td>
                            @foreach($item->detailJadwal as $detail)
                            @if($detail->jadwal_id == $item->jadwal_id && $detail->general_id == $item->general_id)
                                {{ $detail->activity_type }}
                                @break
                            @endif
                        @endforeach
                        </td>
                        <td>{{ $item->general->email }}</td>
                    </tr>
                    @endforeach

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
