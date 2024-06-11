<div class="col-12">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Schedule</title>
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
    </head>

    <body>
        <div class="container-fluid" style="padding-top: 2rem;">
            <div class="mb-3 text-end">
                <button class="btn btn-dark" onclick="printContent()">Print</button>
            </div>
            <h3 class="text-center mb-3">Work Plan Sales</h3>
            <div class="ket fw-bold">
                <p>Sales : Rizki Nanda </p>
                <p>Periode : Juni 2024 </p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2"></th>
                        <th rowspan="2"></th>
                        <th rowspan="2"></th>
                        <th rowspan="2"></th>
                        <th rowspan="2">Week</th>
                        <th rowspan="2">Uraian</th>
                        <th rowspan="2">Jumlah</th>
                        <th rowspan="2">Harga</th>
                        <th rowspan="2">Satuan</th>
                        <th rowspan="2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $maxBusinesses = 0;
                        // Menghitung jumlah bisnis terbanyak dari semua baris
                        foreach($result as $value) {
                            if(isset($value['businesses']) && is_array($value['businesses'])) {
                                $maxBusinesses = max($maxBusinesses, count($value['businesses']));
                            }
                        }
                    @endphp
                    @foreach($result as $key => $value)
                        <tr>
                            <td>{{ $key }}</td> <!-- Ini adalah tanggal -->
                            @if(isset($value['businesses']) && is_array($value['businesses']) && count($value['businesses']) > 0)
                                <!-- Ambil nama-nama perusahaan dari array "businesses" -->
                                @foreach($value['businesses'] as $company)
                                    <td>{{ $company }}</td>
                                @endforeach
                            @endif
                            <!-- Tambahkan kolom kosong jika jumlah bisnis kurang dari $maxBusinesses -->
                            @for($i = count($value['businesses'] ?? []); $i < $maxBusinesses; $i++)
                                <td></td>
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>



            </table>
            <div class="ttd pt-3">
                <div class="row">
                    <div class="col-4">
                        <p>Di buat oleh,</p><br><br><br><br>
                        <p><strong>Rizqy Nanda D</strong><br>Sales Marketing</p>
                    </div>
                    <div class="col-4">
                        <p class="text-center">Menyetujui,</p><br><br><br><br>
                        <div class="d-flex justify-content-around">
                            <p><strong>Ibu Linda</strong></p>
                            <p><strong>Ibu Sanny</strong></p>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <p>Menyetujui,</p><br><br><br><br>
                        <div class="d-flex justify-content-around">
                            <p><strong>Bpk. Agus Sudiyanto</strong><br>Direktur</p>
                            <p><strong>Bpk. Haryadi Tjokro Djanto</strong><br>CEO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
    <script>
        function printContent() {
            window.print();
        }
    </script>

    </html>

</div>
