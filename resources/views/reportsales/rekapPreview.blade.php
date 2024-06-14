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
    </head>

    <body>
        <div class="container-fluid" style="padding-top: 2rem;">
            <div class="mb-3 text-end">
                <button class="btn btn-dark" onclick="printContent()">Print</button>
            </div>
            <h5 class="text-start mb-3">Rekap Visit Tony</h5>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Customer</th>
                        <th>Alamat</th>
                        <th>Area</th>
                        <th>CP</th>
                        <th>HP</th>
                        <th>Keterangan</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
