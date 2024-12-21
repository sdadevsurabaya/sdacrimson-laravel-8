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
                    {{-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>2.65%</span> since last week
                </p> --}}
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
                    {{-- <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>0.82%</span> since last week
                </p> --}}
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
                    {{-- <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>6.24%</span> since last week
                </p> --}}
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
                    {{-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> since last week
                </p> --}}
                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->

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
                                            @endif
                                        </span></h3>
                                </li>

                            </ul>
                        </div>
                        <div class="">
                            <button id="startBtn"
                                class="btn btn-success m-1"@if ($start) disabled @endif>Start</button>
                            <button id="endBtn" class="btn btn-danger m-1"
                                @if (!$start || $stop) disabled @endif>End</button>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div style="height:25%; id="app">
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
