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
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2"></th>
                        <th rowspan="2"></th>
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
                    <tr>
                        <td>1</td>
                        <td>PT.HAP</td>
                        <td>PT.GOLDEN</td>
                        <td>PT.ARUKI</td>
                        <td>PT.SURYA PER</td>
                        <td>PT.HOKKAN</td>
                        <td>PT.LANGGEN</td>
                        <td></td>
                        <td rowspan="6" class="highlight"></td>
                        <td rowspan="6" class="highlight"></td>
                        <td rowspan="6" class="highlight"></td>
                        <td rowspan="6" class="highlight"></td>
                        <td rowspan="6" class="highlight"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>PT.SINARMAS</td>
                        <td>PT.MEGA SUR</td>
                        <td>PT.MIKATASA</td>
                        <td>PT.OTA</td>
                        <td>PT.TOAH</td>
                        <td>PT.ELODA</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>PT.SINARMAS</td>
                        <td>PT.MEGA SUR</td>
                        <td>PT.MIKATASA</td>
                        <td>PT.OTA</td>
                        <td>PT.TOAH</td>
                        <td>PT.ELODA</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>PT.AKTIF</td>
                        <td>PT.STT</td>
                        <td>PT.CAMPINA</td>
                        <td>PT.GRAND P</td>
                        <td>PT.CARBON</td>
                        <td>PT.INTIMAS</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>PT.BINA</td>
                        <td>PT.FILTRONA</td>
                        <td>PT.ATLANTIC</td>
                        <td>PT.TOAH</td>
                        <td>PT.BERCA</td>
                        <td>PT.UMBRA</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>PT.CAHAYA L</td>
                        <td>PT.HASIL</td>
                        <td>PT.PRIMA</td>
                        <td>PT.ULP</td>
                        <td>PT.UNILVR</td>
                        <td>PT.UNION</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>PT.CHAROEN</td>
                        <td>PT.MASINDO</td>
                        <td>PT.KOSMO</td>
                        <td>PT.JUL</td>
                        <td>PT.SONHINT</td>
                        <td>PT.WARNA</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.ISAT</td>
                        <td>PT.GTP</td>
                        <td>PT.JUL</td>
                        <td>PT.SONHINT</td>
                        <td>PT.SAKAE</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>PT.WARNA A</td>
                        <td>PT.DELTAPAK</td>
                        <td>PT.ATLAS</td>
                        <td>PT.JUL</td>
                        <td>PT.PAMAPRO</td>
                        <td>PT.PAMAPRO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>PT.ARUKI</td>
                        <td>PT.MIKATASA</td>
                        <td>PT.MIRFA</td>
                        <td>PT.UNION</td>
                        <td>PT.MIRFA</td>
                        <td>PT.JMP</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>PT.OTA</td>
                        <td>PT.OTA</td>
                        <td>PT.OTIS</td>
                        <td>PT.UNION</td>
                        <td>PT.JMP</td>
                        <td>PT.SHOES</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="holiday">18</td>
                        <td class="holiday" colspan="6">Hari Raya Idul Adha 1445 H</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="holiday">19</td>
                        <td class="holiday" colspan="6">Hari Raya Idul Adha 1445 H</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>PT.PRIMA BET</td>
                        <td>PT.MIKATASA</td>
                        <td>PT.MIRFA</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.JMP</td>
                        <td>PT.SHOES</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>PT.ARUKI</td>
                        <td>PT.PRIMA BET</td>
                        <td>PT.MIRFA</td>
                        <td>PT.TOAH</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.SHOES</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>PT.ARUKI</td>
                        <td>PT.PRIMA BET</td>
                        <td>PT.TOAH</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.SHOES</td>
                        <td>PT.CARINDO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>PT.ARUKI</td>
                        <td>PT.PRIMA BET</td>
                        <td>PT.TOAH</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.SHOES</td>
                        <td>PT.CARINDO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>26</td>
                        <td>PT.ARUKI</td>
                        <td>PT.PRIMA BET</td>
                        <td>PT.TOAH</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.SHOES</td>
                        <td>PT.CARINDO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>27</td>
                        <td>PT.ARUKI</td>
                        <td>PT.PRIMA BET</td>
                        <td>PT.TOAH</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.SHOES</td>
                        <td>PT.CARINDO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>30</td>
                        <td>PT.ARUKI</td>
                        <td>PT.PRIMA BET</td>
                        <td>PT.TOAH</td>
                        <td>PT.INTI DUTA</td>
                        <td>PT.SHOES</td>
                        <td>PT.CARINDO</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
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
                        <div class="d-flex justify-content-between">
                            <p><strong>Ibu Linda</strong></p>
                            <p><strong>Ibu Sanny</strong></p>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <p>Menyetujui,</p><br><br><br><br>
                        <p><strong>Bpk. Haryadi Tikoro Djanto</strong><br>CEO</p>
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
