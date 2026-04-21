@extends('layouts.master')
@section('title')
@lang('translation.Dashboard')
@endsection
@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle')
Dashboard
@endslot
@slot('title')
Dashboard
@endslot
@endcomponent

@php
    $isSalesRole = Auth::user()->hasRole('Sales') || Auth::user()->hasRole('Driver') || Auth::user()->hasRole('Collector');
@endphp

@if ($isSalesRole)
{{-- ===== SPEEDOMETER GAUGE: Khusus Sales, Driver, Collector ===== --}}
<div class="row justify-content-center mb-4">
    <div class="col-md-10 col-xl-8">
        <div class="card shadow-sm">
            <div class="card-body py-4">
                <h5 class="card-title text-center fw-semibold mb-4" style="letter-spacing:.04em;color:#555;">
                    <i class="mdi mdi-map-marker-check me-2 text-primary"></i>
                    Rekapitulasi Kunjungan &mdash; {{ now()->translatedFormat('F Y') }}
                </h5>
                <div class="row align-items-center">
                    {{-- Speedometer --}}
                    <div class="col-md-5 text-center">
                        <div class="position-relative mx-auto" style="width:220px;">
                            <canvas id="speedometerChart" width="220" height="220"></canvas>
                            <div class="position-absolute w-100 text-center" style="bottom:18px;left:0;">
                                <div class="fw-bold" style="font-size:2rem;line-height:1;color:#333;">{{ $persenVisit }}%</div>
                                <div class="text-muted" style="font-size:.75rem;">Persentase Kunjungan</div>
                            </div>
                        </div>
                    </div>
                    {{-- Stat Cards --}}
                    <div class="col-md-7 mt-3 mt-md-0">
                        <div class="row g-3 justify-content-center">
                            <div class="col-4">
                                <div class="border rounded-3 text-center py-3 px-2 h-100" style="background:#f8f9fa;">
                                    <div class="fw-bold text-success" style="font-size:1.8rem;">{{ $totalAktual }}</div>
                                    <div class="text-muted mt-1" style="font-size:.78rem;font-weight:500;">Aktual</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded-3 text-center py-3 px-2 h-100" style="background:#f8f9fa;">
                                    <div class="fw-bold text-primary" style="font-size:1.8rem;">{{ $totalPlan }}</div>
                                    <div class="text-muted mt-1" style="font-size:.78rem;font-weight:500;">Plan</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded-3 text-center py-3 px-2 h-100" style="background:#f8f9fa;">
                                    <div class="fw-bold text-danger" style="font-size:1.8rem;">{{ max(0, $totalPlan - $totalAktual) }}</div>
                                    <div class="text-muted mt-1" style="font-size:.78rem;font-weight:500;">Sisa</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 px-1">
                            <div class="d-flex justify-content-between mb-1" style="font-size:.8rem;">
                                <span class="text-muted">Progress Kunjungan</span>
                                <span class="fw-semibold">{{ $persenVisit }}%</span>
                            </div>
                            <div class="progress" style="height:10px;border-radius:10px;">
                                <div class="progress-bar
                                    @if($persenVisit >= 80) bg-success
                                    @elseif($persenVisit >= 50) bg-warning
                                    @else bg-danger @endif"
                                    role="progressbar"
                                    style="width: {{ min(100, $persenVisit) }}%;border-radius:10px;"
                                    aria-valuenow="{{ $persenVisit }}" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
{{-- ===== 4 CARD SUMMARY: Role lain ===== --}}
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart"></div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ count($get_general) }}</span></h4>
                    <p class="text-muted mb-0">Total General</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="orders-chart"> </div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ count($get_legal) }}</span></h4>
                    <p class="text-muted mb-0">Total Legal</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="customers-chart"> </div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{ count($get_kontak) }}</span></h4>
                    <p class="text-muted mb-0">Total Contact Person</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="growth-chart"></div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"> <span data-plugin="counterup">{{ count($get_outlet) }}</span></h4>
                    <p class="text-muted mb-0">Total Outlet</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->
</div> <!-- end row-->
@endif

<input type="hidden" class="form-control" name="latitude" id="latitude" placeholder="Masukan gps">
<input type="hidden" class="form-control" name="longitude" id="longitude" placeholder="Masukan gps">
<input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ Auth::id() }}"
    placeholder="Masukan gps">

{{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">

            </div>
        </div>
    </div> --}}
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Selamat Datang.</h4>
                <div class="d-flex justify-content-between">
                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h3 class="text-primary">{{ Str::ucfirst(Auth::user()->name) }}<span
                                        class="text-muted d-inline-block font-size-15 ms-3">Role Anda Sebagai
                                        @if (Str::ucfirst(Auth::user()->hasRole('Admin')) == 1)
                                        Admin
                                        @elseif (Str::ucfirst(Auth::user()->hasRole('Sales')) == 1)
                                        Sales
                                        @elseif (Str::ucfirst(Auth::user()->hasRole('Verifikator')) == 1)
                                        Verifikator
                                        @elseif (Str::ucfirst(Auth::user()->hasRole('Manager Sales')) == 1)
                                        Manager Sales
                                        @endif
                                    </span></h3>
                            </li>

                        </ul>
                    </div>
                    <div class="">
                        <button id="startBtn"
                            class="btn btn-success m-1" @if ($start) disabled @endif>Start</button>
                        <button id="endBtn" class="btn btn-danger m-1"
                            @if (!$start || $stop) disabled @endif>End</button>
                    </div>
                </div>

                <div class="mt-3">
                    <div style="height:25%; id=" app">
                        {{-- {!! $chart->container() !!} --}}
                    </div>
                    {{-- <div id="sales-analytics-chart" class="apex-charts" dir="ltr"></div> --}}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-xl-4">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <p class="text-white font-size-18">Register Outlet </p>
                        <div class="mt-4">
                            {{-- <a href="javascript: void(0);" class="btn btn-success waves-effect waves-light">Analyse Sales</a> --}}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mt-4 mt-sm-0">
                            <img src="{{ URL::asset('/assets/images/setup-analytics-amico.svg') }}" class="img-fluid"
                                alt="">
                        </div>
                    </div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->

        {{-- <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Top Selling Products</h4>
            </div> <!-- end card-body-->
        </div> <!-- end card--> --}}
    </div> <!-- end Col -->
</div> <!-- end row-->
@endsection
@section('script')
@if ($isSalesRole)
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    var pct     = {{ $persenVisit }};
    var aktual  = {{ $totalAktual }};
    var plan    = {{ $totalPlan }};

    // Warna gauge berdasarkan persentase
    var gaugeColor = pct >= 80 ? '#28a745' : (pct >= 50 ? '#ffc107' : '#dc3545');

    var ctx = document.getElementById('speedometerChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [pct, 100 - pct],
                backgroundColor: [gaugeColor, '#e9ecef'],
                borderWidth: 0,
                circumference: 180,
                rotation: 270,
            }]
        },
        options: {
            responsive: false,
            cutout: '72%',
            animation: {
                animateRotate: true,
                duration: 1000,
            },
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false },
            }
        }
    });
})();
</script>
@endif
<script>
    $(document).ready(function() {
        handlePermission(this);

        // get lat and long location
        function handlePermission(geoBtn) {
            navigator.permissions.query({
                name: 'geolocation'
            }).then(function(result) {
                if (result.state == 'prompt' || result.state == 'granted') {
                    navigator.geolocation.getCurrentPosition(revealPosition, showErrorLocation);
                } else {
                    console.log(result.state);
                }

                result.onchange = function() {
                    console.log(result.state);
                }
            });
        }

        function revealPosition(position) {
            var data = position.coords;
            var lat = data.latitude;
            var long = data.longitude;

            // alert("Lat : " + lat + ", Long: " + long );
            // console.log(lat);
            // console.log(long);
            $("#latitude").val(lat);
            $("#longitude").val(long);

        }

        function showErrorLocation(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    var err = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    var err = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    var err = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    var err = "An unknown error occurred."
                    break;
            }

            console.log(err);
        }

        $('#startBtn').click(function() {

            var latitude = $('#latitude').val();
            var longitude = $('#longitude').val();
            var userId = $('#user_id').val();


            var data = {
                user_id: userId,
                type: 'start',
                latitude: latitude,
                longitude: longitude,
                _token: "{{ csrf_token() }}",
            };


            $.ajax({
                url: '/location-times',
                type: 'POST',
                data: data,
                success: function(response) {
                    alert('Location recorded successfully');

                    $('#startBtn').prop('disabled', true);
                    $('#buatJadwalBtn').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred');
                }
            });
        });

        document.getElementById('endBtn').addEventListener('click', function() {
            $.ajax({
                url: '/getDetailByJadwal',
                method: 'GET',
                success: function(response) {
                    const customerData = response;


                    let selectOptions = '';
                    for (const [key, value] of Object.entries(customerData)) {

                        const isSelected = key === '470' ? 'selected' : '';
                        selectOptions +=
                            `<option value="${key}" ${isSelected}>${value}</option>`;
                    }

                    const selectHtml =
                        `<select id="customerSelect" class="swal2-select">${selectOptions}</select>`;


                    Swal.fire({
                        title: 'Select Customer',
                        html: selectHtml,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Ok',
                        preConfirm: () => {
                            return document.getElementById('customerSelect')
                                .value;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const selectedCustomerId = result.value;

                            var latitude = $('#latitude').val();
                            var longitude = $('#longitude').val();
                            var userId = $('#user_id').val();


                            var data = {
                                user_id: userId,
                                type: 'stop',
                                latitude: latitude,
                                longitude: longitude,
                                customer: selectedCustomerId,
                                _token: "{{ csrf_token() }}",
                            };


                            $.ajax({
                                url: '/location-times',
                                type: 'POST',
                                data: data,
                                success: function(response) {
                                    //    window.location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    alert('An error occurred');
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                }
            });
        });

    });
</script>
@endsection