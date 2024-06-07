@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Jadwal
        @endslot
        @slot('title')
            Export Jadwal
        @endslot
    @endcomponent

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('sweetalert::alert')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="floatingSelectGrid" class="col-form-label">Sales / PIC</label>
                            <div class="">
                                <select class="form-select" name="user_id" id="user_id"
                                    aria-label="Floating label select example">
                                    <option value="">-- Pilih User --</option>
                                    <option value="1">Dargombez</option>
                                    <option value="5">agus</option>
                                    <option value="6">Adi Prasetyo</option>
                                    <option value="8">Dian Saputro</option>
                                    <option value="9">manager01</option>
                                    <option value="10">alfin fachrizal</option>
                                    <option value="12">rois</option>
                                    <option value="13">Rois Yusuf Wahyudi</option>
                                    <option value="14">syaiful wanda</option>
                                    <option value="16">sylvia</option>
                                    <option value="18">Kholis</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="floatingSelectGrid" class="col-form-label">Bulan</label>
                            <div class="">
                                <select class="form-select" name="user_id" id="user_id"
                                    aria-label="Floating label select example">
                                    <option value="">-- Pilih Bulan --</option>
                                    <option value="1">Januari</option>
                                    <option value="5">Februari</option>
                                    <option value="6">Maret</option>
                                    <option value="8">April</option>
                                    <option value="9">Mei</option>
                                    <option value="10">Juni</option>
                                    <option value="12">Juli</option>
                                    <option value="13">Agustus</option>
                                    <option value="14">September</option>
                                    <option value="16">Oktober</option>
                                    <option value="18">November</option>
                                    <option value="18">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Export</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-12">
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <table>
                    <thead>
                        <tr>
                            <th>Sunday</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th rowspan="2">Uraian</th>
                            <th rowspan="2">Jumlah</th>
                            <th rowspan="2">Harga</th>
                            <th rowspan="2">Satuan</th>
                            <th rowspan="2">Total</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Hari Lahir Pancasila</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td>PT.HAP</td>
                            <td>PT.GOLDEN</td>
                            <td>PT.ARUKI</td>
                            <td>PT.SURYA PER</td>
                            <td>PT.HOKKAN</td>
                            <td>PT.LANGGEN</td>
                            <td rowspan="5" class="highlight"></td>
                            <td rowspan="5" class="highlight"></td>
                            <td rowspan="5" class="highlight"></td>
                            <td rowspan="5" class="highlight"></td>
                            <td rowspan="5" class="highlight"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>PT.SINARMAS</td>
                            <td>PT.MEGA SUR</td>
                            <td>PT.MIKATASA</td>
                            <td>PT.OTA</td>
                            <td>PT.TOAH</td>
                            <td>PT.ELODA</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>PT.AKTIF</td>
                            <td>PT.STT</td>
                            <td>PT.CAMPINA</td>
                            <td>PT.GRAND P</td>
                            <td>PT.CARBON</td>
                            <td>PT.INTIMAS</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>PT.BINA</td>
                            <td>PT.FILTRONA</td>
                            <td>PT.ATLANTIC</td>
                            <td>PT.TOAH</td>
                            <td>PT.BERCA</td>
                            <td>PT.UMBRA</td>
                        </tr>
                        <tr>
                            <td class="highlight">Sby Timur</td>
                            <td class="highlight">Sby Timur</td>
                            <td class="highlight">Sidoarjo</td>
                            <td class="highlight">Sidoarjo</td>
                            <td class="highlight">Sby Timur</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>PT.CAHAYA L</td>
                            <td>PT.HASIL</td>
                            <td>PT.PRIMA</td>
                            <td>PT.ULP</td>
                            <td>PT.UNILVR</td>
                            <td>PT.UNION</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>PT.CHAROEN</td>
                            <td>PT.MASINDO</td>
                            <td>PT.KOSMO</td>
                            <td>PT.JUL</td>
                            <td>PT.SONHINT</td>
                            <td>PT.WARNA</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>PT.INTI DUTA</td>
                            <td>PT.ISAT</td>
                            <td>PT.GTP</td>
                            <td>PT.JUL</td>
                            <td>PT.SONHINT</td>
                            <td>PT.SAKAE</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>PT.WARNA A</td>
                            <td>PT.DELTAPAK</td>
                            <td>PT.ATLAS</td>
                            <td>PT.JUL</td>
                            <td>PT.PAMAPRO</td>
                            <td>PT.PAMAPRO</td>
                        </tr>
                        <tr>
                            <td class="highlight">Sby Timur</td>
                            <td class="highlight">Sby Timur</td>
                            <td class="highlight">Sidoarjo</td>
                            <td class="highlight">Sidoarjo</td>
                            <td class="highlight">Sby Timur</td>
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
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>PT.OTA</td>
                            <td>PT.OTA</td>
                            <td>PT.OTIS</td>
                            <td>PT.UNION</td>
                            <td>PT.JMP</td>
                            <td>PT.SHOES</td>
                        </tr>
                        <tr>
                            <td class="holiday">18</td>
                            <td class="holiday" colspan="6">Hari Raya Idul Adha 1445 H</td>
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
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>PT.ARUKI</td>
                            <td>PT.PRIMA BET</td>
                            <td>PT.TOAH</td>
                            <td>PT.INTI DUTA</td>
                            <td>PT.SHOES</td>
                            <td>PT.CARINDO</td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>PT.ARUKI</td>
                            <td>PT.PRIMA BET</td>
                            <td>PT.TOAH</td>
                            <td>PT.INTI DUTA</td>
                            <td>PT.SHOES</td>
                            <td>PT.CARINDO</td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>PT.ARUKI</td>
                            <td>PT.PRIMA BET</td>
                            <td>PT.TOAH</td>
                            <td>PT.INTI DUTA</td>
                            <td>PT.SHOES</td>
                            <td>PT.CARINDO</td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>PT.ARUKI</td>
                            <td>PT.PRIMA BET</td>
                            <td>PT.TOAH</td>
                            <td>PT.INTI DUTA</td>
                            <td>PT.SHOES</td>
                            <td>PT.CARINDO</td>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>PT.ARUKI</td>
                            <td>PT.PRIMA BET</td>
                            <td>PT.TOAH</td>
                            <td>PT.INTI DUTA</td>
                            <td>PT.SHOES</td>
                            <td>PT.CARINDO</td>
                        </tr>
                    </tbody>
                </table>
                <p>Di buat oleh,</p>
                <p><strong>Rizqy Nanda D</strong><br>Sales Marketing</p>
                <p>Menyetujui,</p>
                <p><strong>Ibu Linda</strong><br></p>
                <p><strong>Bpk. Haryadi Tikoro Djanto</strong><br>CEO</p>
            </body>

            </html>

        </div>
    </div> <!-- end row -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Kunjungan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2 mb-lg-5">
                        <div class="col col-12 text-center">
                            <p class="fw-bold text-capitalize fs-4">Check In</p>
                            <img src="" alt="Check-in Image" width="350" height="550">
                            <!-- Gambar akan diubah melalui AJAX -->
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <iframe src="" width="600" height="450" style="border:0;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script></script>


    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
