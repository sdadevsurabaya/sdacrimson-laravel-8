@extends('layouts.master')
@section('title')
    @lang('translation.Maps')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Maps
        @endslot
        @slot('title')
            Maps
        @endslot
    @endcomponent

    <style>
        #map {
            height: 580px;
        }

        .btn-dir{
            background-color: cadetblue;
            border:none;
            color: white;
        }

        .nama {
            font-size: 1rem;
            font-weight: 500;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div id="map" class="mb-3"></div>
        </div>
        <div class="col-xl-12 col-md-6">
            <div class="row">
                <div class="col col-md-12">
                    {{-- <h3><b>Jumlah Outlet : <label id="jumlah"></label></b></h3> --}}
                    <div class="row col-6">
                        <div class="mb-3 col-6">
                            <label class="form-label" for="area"><span style="color: crimson;">*</span> Area</label>
                            <select class="form-select area" name="area" id="area"
                                aria-label="Floating label select example">
                                <option value="">-- Pilih Area --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->area }}">{{ $area->area }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 mt-4 col-6">
                            <button class="btn btn-danger m-1" onclick="cek_outlet_terdekat()">Lihat Outlet Terdekat</button>
                            <input type="hidden" name="lat" id="lat" value="0">
                            <input type="hidden" name="long" id="long" value="0">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable-maps" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 30%">Nama Outlet</th>
                                    <th style="width: 10%">Kode Area</th>
                                    <th style="width: 15%">Kota</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody id="t_points">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- @php
            dd($outlet);
        @endphp --}}
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    {{-- <script src="../dist/leaflet-rotate-src.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}

    <script type="text/javascript">
        var map = L.map('map').setView([-7.29605, 112.67646], 16);
        var OpenStreetMap_Mapnik = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker_now = [];
        var markerInRadius = [];
        var array_data_by_radius = [];
        var markers = [];
        var markersByClick = [];
        var selPts = [];
        var all_outlet;
        var all_marker;
        var all_outlet_by_radius;
        var lat;
	    var long;
        var circle;

        function addMarkerByAll(nama, alamat, lat, lng) {
            removeOldMarkerByAll()
            var p = L.marker([lat, lng], {icon: redIcon});
            var html = `<b>`+nama+`</b><br><p>`+alamat+`</p> <a target=_blank href=https://www.google.com/maps/dir//`+lat+`,`+lng+`/@`+lat+`,`+lng+`,15z?entry=ttu><button type="submit" class="btn-dir">Get Direction</button><a>`;
            p.bindPopup(html).openTooltip();
            p.addTo(map);
            map.flyTo([lat, lng], 11)
            map.addLayer(p)
            markers.push(p);
        }

        function addMarker(nama, alamat, lat, lng) {
            var p = L.marker([lat, lng]);
            var html = `<b>`+nama+`</b><br><p>`+alamat+`</p> <a target=_blank href=https://www.google.com/maps/dir//`+lat+`,`+lng+`/@`+lat+`,`+lng+`,15z?entry=ttu><button type="submit" class="btn-dir">Get Direction</button><a>`;
            p.bindPopup(html).openTooltip();
            p.addTo(map);
            map.flyTo([lat, lng], 11)
            map.addLayer(p)
            markers.push(p);
        }

        function addMarkerByClick(nama, alamat, lat, lng) {
            removeOldMarkerByClick()
            var p = L.marker([lat, lng], {icon: redIcon});
            var html = `<b>`+nama+`</b><br><p>`+alamat+`</p> <a target=_blank href=https://www.google.com/maps/dir//`+lat+`,`+lng+`/@`+lat+`,`+lng+`,15z?entry=ttu><button type="submit" class="btn-dir">Get Direction</button><a>`;
            p.bindPopup(html).openTooltip();
            p.addTo(map);
            map.flyTo([lat, lng], 15)
            map.addLayer(p)
            markersByClick.push(p);
            console.log(markersByClick)
        }

        function removeOldMarker() {
            var new_markers = []
            markers.forEach(function(marker) {
                map.removeLayer(marker)
            })
            markers = new_markers
        }

        $(document).ready(function() {
            handlePermission(this);
            $.ajax({
                url: "{{ url('show_all_outlet') }}",
                type: "get",
                cache: false,
                // dataType: 'json',
                success: function(response) {
                    data = JSON.parse(response);
                    all_outlet = data;
                    isi_table = '';
                    data.forEach(function(item, index) {

                        // console.log(item.foto);

                        isi_table += `
                        <tr class="baris" onclick="addMarkerByAll('` + item.nama_outlet + `', '` + item.alamat + `', '` +
                            item.latitude + `', '` + item.longitude + `')">
                            <td>` + (index + 1) + `</td>
                            <td>` + (item.nama_outlet) + `</td>
                            <td>` + (item.area) + `</td>
                            <td>` + (item.kota) + `</td>
                            <td>` + (item.alamat) + `</td>
                        </tr>
                        `;
                    });
                    $('#t_points').html(isi_table);
                    $('#datatable-maps').DataTable();
                }
            });
        });

        function handlePermission(geoBtn) {
            navigator.permissions.query({name:'geolocation'}).then(function(result) {
                if( result.state == 'prompt' || result.state == 'granted' )
                {
                    navigator.geolocation.getCurrentPosition(revealPosition,showErrorLocation);
                }else{
                    console.log( result.state );
                }

                result.onchange = function() {
                    console.log(result.state);
                }
            });
        }

        function revealPosition(position) {
            var data = position.coords;
            lat  = data.latitude;
            long = data.longitude;
        }

        function showErrorLocation(error) {
            switch(error.code) {
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

        // setting icon marker titik saat ini.
        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        function cek_outlet_terdekat() {
            $('#datatable-maps').DataTable().clear().destroy();
            var lat_old = $('#lat').val();
            var long_old = $('#long').val();

            Koordinat = [lat,long];  //Titik kordinat saat ini.
            // console.log(Koordinat);

		    var theRadius = 5000; //Dalam satuan meter.

            selPts.length = 0;

            all_outlet.forEach(function(element) {
                // console.log(element);

                // get marker
                var all_marker = L.marker([element.latitude,element.longitude]);
                // console.log(all_marker);

                // Lat, long of current point as it loops through.
                layer_lat_long = all_marker.getLatLng();
                // console.log(layer_lat_long);

                // Distance from our circle marker To current point in meters
                distance_from_centerPoint = layer_lat_long.distanceTo(Koordinat);
                // console.log(distance_from_centerPoint);

                // See if meters is within radius, add the to array
                if (distance_from_centerPoint <= theRadius) {
                    // console.log("push array");
                    selPts.push(all_marker);
                }

                // console.log(selPts);
            });

            if (lat_old != lat && long_old != long) {
                // console.log("koordinat tidak sama")
                removeOldMarker();
                removeOldMarkerByClick();
                // looping marker yang termasuk dalam radius titik saat ini
                console.log(selPts.length);
                console.log(selPts);
                selPts.forEach(function(element) {
                    // console.log(element);
                    $.ajax({
                        url: "{{ url('show_all_outlet_by_radius') }}",
                        type: "get",
                        cache: false,
                        data:{
                            lat  : element._latlng.lat,
                            long  : element._latlng.lng,
                        },
                        // dataType: 'json',
                        success: function(response) {
                            data_by_radius = JSON.parse(response);
                            // console.log(data_by_radius[0].id)
                            // all_outlet_by_radius = data_by_radius;
                            var object_data_by_radius = {lat:data_by_radius[0].latitude, long:data_by_radius[0].longitude};
                            var marker2 = L.marker([data_by_radius[0].latitude,data_by_radius[0].longitude]);
                            var html2 = `<b>`+data_by_radius[0].nama_outlet+`</b><br><p>`+data_by_radius[0].alamat+`</p> <a target=_blank href=https://www.google.com/maps/dir//`+data_by_radius[0].latitude+`,`+data_by_radius[0].longitude+`/@`+data_by_radius[0].latitude+`,`+data_by_radius[0].longitude+`,15z?entry=ttu><button type="submit" class="btn-dir">Get Direction</button><a>`;
                            marker2.bindPopup(html2).openTooltip();
                            marker2.addTo(map);
                            markerInRadius.push(marker2);
                            array_data_by_radius.push(object_data_by_radius);
                        }
                    });
                });

                // display titik lokasi saat ini
                var marker = L.marker([lat,long], {icon: redIcon});
                var html = `<b>Posisi anda saat ini</b>`;
                marker.bindTooltip(html).openTooltip();
                marker.addTo(map);
                map.flyTo([lat, long], 13)
                map.addLayer(marker)
                marker_now.push(marker)

                // console.log(array_data_by_radius);

                // // display list outlet by radius
                // isi_table_by_radius = '';
                // array_data_by_radius.forEach(function(item, index) {
                //     // isi_table_by_radius += `
                //     //     <tr class="baris" onclick="addMarker('` + item.nama_outlet + `', '` + item.alamat + `', '` +
                //     //         item.latitude + `', '` + item.longitude + `')">
                //     //         <td>` + (index + 1) + `</td>
                //     //         <td>` + (item.nama_outlet) + `</td>
                //     //         <td>` + (item.area) + `</td>
                //     //         <td>` + (item.kota) + `</td>
                //     //         <td>` + (item.alamat) + `</td>
                //     //     </tr>
                //     //     `;
                //     console.log(item.nama_outlet);
                // });
                // $('#t_points').html(isi_table_by_radius);
                // $('#datatable-maps').DataTable();

                // setting and display circle
                circle = L.circle([lat,long], {
                    color: '#c95d5c',
                    fillColor: '#edbdbd',
                    fillOpacity: 0.3,
                    radius: theRadius //dalam satuan meter.
                });
                circle.addTo(map);
            } else {
                // console.log("koordinat sama")
            }

            $('#lat').val(lat);
            $('#long').val(long);

        }

        function removeOldMarker() {
            var new_markers = []
            markers.forEach(function(marker) {
                map.removeLayer(marker)
            })
            markers = new_markers
        }

        function removeOldMarkerByAll() {
            var emptyMarkerByAll = []
            markers.forEach(function(marker) {
                map.removeLayer(marker)
            })
            markers = emptyMarkerByAll
        }

        function removeOldMarkerByClick() {
            var emptyMarkerByClick = []
            markersByClick.forEach(function(marker) {
                map.removeLayer(marker)
            })
            markersByClick = emptyMarkerByClick
        }

        function removeOldMarkerNow() {
            var new_markers = []
            marker_now.forEach(function(marker) {
                map.removeLayer(marker)
            })
            marker_now = new_markers

            if (circle != undefined) {
                map.removeLayer(circle);
            };
        }

        function removeOldMarkerInRadius() {
            var emptyMarkerInRadus = []
            markerInRadius.forEach(function(marker) {
                map.removeLayer(marker)
            })
            markerInRadius = emptyMarkerInRadus;
        }

        L.control.scale({
            maxWidth: 240,
            metric: true,
            position: 'bottomleft'
        }).addTo(map);

        $('.area').change(function() {
            removeOldMarker();
            removeOldMarkerNow();
            removeOldMarkerByClick();
            removeOldMarkerInRadius();
            $('#lat').val("0");
            $('#long').val("0");
            $('#datatable-maps').DataTable().clear().destroy();
            let area_val = $('.area').val();
            $.ajax({
                url: "{{ url('show_all_outlet_by_area') }}/" + area_val,
                type: "get",
                cache: false,
                // dataType: 'json',
                success: function(response) {

                    data = JSON.parse(response);

                    for (var i = 0; i < data.length; i++) {
                        addMarker(data[i].nama_outlet, data[i].alamat, data[i].latitude, data[i]
                            .longitude);
                    }

                    isi_table = '';
                    data.forEach(function(item, index) {
                        isi_table += `
                        <tr class="baris" onclick="addMarkerByClick('` + item.nama_outlet + `', '` + item.alamat + `', '` +
                            item.latitude + `', '` + item.longitude + `')">
                            <td>` + (index + 1) + `</td>
                            <td>` + (item.nama_outlet) + `</td>
                            <td>` + (item.area) + `</td>
                            <td>` + (item.kota) + `</td>
                            <td>` + (item.alamat) + `</td>
                        </tr>
                        `;
                    });
                    $('#t_points').html(isi_table);
                    $('#datatable-maps').DataTable();
                }
            });
        });
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
