<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ url('/assets/js/easywebcam/style/webcam-demo.css') }}">
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        html {
            background-color: #323232;
        }

        body {
            background-color: white;
            color: #323232;
        }

        .navbar {
            z-index: 1030;
        }

        #navtop {
            background-image: linear-gradient(to bottom, black, transparent);
        }

        #navdown {
            background-image: linear-gradient(to top, black, transparent);
        }

        @media (min-width: 768px) {
            html {
                display: flex;
                align-items: center;
            }

            body {
                max-width: 400px;
                max-height: 700px;
                margin: auto;
            }
        }
        .loader {
            display: none;
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%, -50%);
            z-index: 99;
        }

        .loading {
            border: 2px solid #ccc;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border-top-color: #1ecd97;
            border-left-color: #1ecd97;
            animation: spin 1s infinite ease-in;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="position-relative">

    <!-- navtop -->
    <nav id="navtop" class="navbar position-absolute start-0 top-0 end-0"
        style="padding-top: .75rem; padding-bottom: 7rem;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="/assets/images/logo-sda-hitam.png" class="img-fluid" width="160" alt="">
            </a>
            <div class="text-light">Checkin</div>
            <button class="btn text-light p-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bi bi-chat-square-text fs-5"></i>
            </button>
            <a href="admin/dashboard" class="btn-close btn-close-white"></a>
        </div>
    </nav>

    <main class="wrapper overflow-auto h-100 position-relative">

        <div class="col loader">
            <div class="loading"></div>
        </div>
        <!-- photo area -->

        <div class="collapse fade show">
            <div id="webcam-container" class="webcam-container col-12 d-none p-0 m-0">
                <video id="webcam" autoplay playsinline></video>
                <div class="flash"></div>
                <audio id="snapSound" src="/assets/js/easywebcam/audio/snap.wav" preload = "auto"></audio>
            </div>
            <!-- take photo -->

            <!-- cek lokasi -->
            <div class="lokasi text-light opacity-75" style="position: absolute; top: 64px; left: 15px; z-index: 1032; font-size: .875em;">
                <div id="pendeteksian"><i class="bi bi-x-circle fs-4 ms-2" style="color: red;"></i></div>
                <div id="longitude" style="visibility: hidden;"></div>
                <div id="latitude" style="visibility: hidden;"></div>
                <p id='distance' style="visibility: hidden;"></p>

                <input type="hidden" id="iduser" name="iduser" value="{{ Session::get('IDUser') }}">
                <input type="hidden" id="nama" name="nama" value="{{ Session::get('NMUser') }}">
                <input type="hidden" id="departement" name="departement" value="{{ Session::get('Departemen') }}">
                <input type="hidden" id="bagian" name="bagian" value="{{ Session::get('Divisi') }}">
                <input type="hidden" id="nik" name="nik" value="{{ Session::get('Nik') }}">
                <input type="hidden" id="kota" name="kota" value="{{ Session::get('Kota') }}">
                <input type="hidden" id="company" name="company" value="{{ Session::get('Unitusaha') }}">
                <input type="hidden" id="status" name="status" value="absen masuk">
                <input type="hidden" id="alamat" name="alamat">
                <input type="hidden" id="ke" name="ke" value="{{ Session::get('Ke') }}">
                <input type="hidden" id="ke2" name="ke2" value="{{ Session::get('Ke2') }}">
                <input type="hidden" id="ke3" name="ke3" value="{{ Session::get('Ke3') }}">
                <input type="hidden" id="ke4" name="ke4" value="{{ Session::get('Ke4') }}">
                <input type="hidden" id="ke5" name="ke5" value="{{ Session::get('Ke5') }}">
                <input type="hidden" id="lokasikerja" name="lokasikerja" value="{{ Session::get('Lokasikerja') }}">

            </div>
        </div>

        <!-- preview photo -->
        <div class="collapse">
            <canvas id="canvas" class="d-none"></canvas>

            <button id="resume-camera" class="btn btn-outline-light d-flex align-items-center" data-bs-toggle="collapse" data-bs-target=".collapse" style="position: absolute; z-index: 1032; bottom: 13px; left: 15px;">
                <small style="font-size: 12px;">Retake Photo</small> <i class="bi bi-x-circle fs-4 ms-2"></i>
            </button>

            <div id="cameraControls" class="cameraControls">
                <a href="#" id="download-photo" download="selfie.jpeg" target="_blank" title="Save Photo" class="d-none"><i class="material-icons"></i></a>
            </div>
        </div>


        <!-- maps area -->
        <div class="position-absolute w-100" style="z-index: 1032; left: 0; bottom: 52px;">
            <div class="container-fluid w-100">
                <iframe class="border-0 rounded overflow-hidden" id="gmapsx" width="40%" height="auto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p id="mapinfo" class="small text-light">
                </p>
            </div>
        </div>
        {{-- src="https://maps.google.com/maps?q=-7.4016,112.5929&z=12&output=embed" --}}
    </main>

    <!-- modal textarea / message -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        <i class="bi bi-chat"></i> <span>Write Message</span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea name="" id="" cols="30" rows="5" class="form-control border-0 rounded-0" placeholder="Write your message here"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit Message</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="form-control webcam-start" id="webcam-control">
        <label class="form-switch">
            <input type="checkbox" id="webcam-switch">
            <i></i>
            <span id="webcam-caption"></span>
        </label>
        <button id="cameraFlip" class="btn d-none"></button>
    </div> --}}

    <!-- navdown -->
    <nav id="navdown" class="navbar position-absolute start-0 bottom-0 end-0" style="padding-bottom: .75rem; padding-top: 10rem;">
        <div class="container-fluid d-block">
            <div class="row row-cols-2 g-2">
                <div class="col">
                    <button class="btn btn-secondary w-100 py-2" id="take-photo" data-bs-toggle="collapse" data-bs-target=".collapse">
                        <i class="bi bi-camera me-2"></i> TAKE PHOTO
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-primary w-100 py-2" id="sendbut" onClick="sendabsence()" style="display: none;">
                        <i class="bi bi-send me-2"></i> SEND
                    </button>
                </div>
            </div>

        </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ url('/assets/js/easywebcam/dist/webcam-easy.min.js') }}"></script>

    {{-- <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script> --}}
    <script src="{{ url('/assets/js/easywebcam/js/app.js') }}"></script>
    <script>
        var datauri = '';
        var Latitude = '';
        var Longitude = '';

        $("#take-photo").on('click', function () {
            $("#sendbut").show();
            $("#take-photo").hide();
        });

        $("#resume-camera").click(function () {
            webcam.stream()
            .then(facingMode =>{
                removeCapture();
            });
            $("#sendbut").hide();
            $("#take-photo").show();
        });
    </script>
    <script>
        // fungsi lokasi
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
                // console.log("Geolocation is not supported by this browser.");
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        function getmapinfo(long, lat) {
            axios({
                    method: 'get',
                    url: `https://api.mapbox.com/geocoding/v5/mapbox.places/` + long + `,` + lat +
                        `.json?types=poi&access_token=pk.eyJ1Ijoic2dpd2ViIiwiYSI6ImNrc3E1bDFpazA5cnIyd252amJ6dmV6YzgifQ.eGVUcbmYW0T0vZ3rfZkEFw`,
                })
                .then(response => {
                    console.log(response.data);
                    console.log('space');
                    console.log('space');
                    console.log(response.data.features[0].context);

                    console.log('ini isinya place');
                    console.log(response.data.features[0].context[2].text);
                    var text = '';
                    var i = 0;
                    while (i < response.data.features[0].context.length) {
                        if (i == response.data.features[0].context.length - 1) {
                            text += response.data.features[0].context[i].text;
                        } else {
                            text += response.data.features[0].context[i].text + ', ';
                        }

                        i++;
                    }
                    // console.log(text);
                    //this.setState({place: text});
                    document.getElementById('mapinfo').innerHTML = text;
                    document.getElementById('alamat').value = text;
                    // document.getElementById('mapinfo').innerHTML = 'undefined mapbox timeout exceeded';
                    // document.getElementById('alamat').value = '-';
                    $("#gmapsx").attr("src", 'https://maps.google.com/maps?q='+lat+','+long+'&z=12&output=embed');
                    $("#take-photo").show();
                })
                .catch(function(err) {
                    console.log(err);
                    console.log('iki gak metu mape')
                    // document.getElementById('mapinfo').innerHTML = 'undefined mapbox timeout exceeded';
                    // document.getElementById('alamat').value = 'undefined mapbox timeout exceeded';
                    // this.setState({status_loading: false});
                });
        }

        function showPosition(position) {
            // var Latitude = position.coords.latitude;
            // var Longitude = position.coords.longitude;

            Latitude = position.coords.latitude;
            Longitude = position.coords.longitude;
            console.log("coba");
            console.log(Latitude);
            console.log(Longitude);
            document.getElementById('pendeteksian').innerHTML = '<i class="bi bi-check-circle fs-4 ms-2" style="color: lime;"></i>';
            document.getElementById('longitude').innerHTML = Longitude;
            document.getElementById('latitude').innerHTML = Latitude;
            var from = turf.point([document.getElementById('longitude').innerHTML, document.getElementById('latitude')
                .innerHTML
            ]);
            var to = turf.point([Longitude, Latitude]);
            var options = {
                units: 'kilometers'
            };

            var distance = turf.distance(from, to, options);

            document.getElementById('distance')
                .innerHTML = new Number(distance).toFixed(2) + " Km";
            document.getElementById('alamat').value = '-';
            getmapinfo(Longitude, Latitude);
        }

        window.onload = function() {
            console.log("test lagi");
            getLocation()
            webcam.start()
            .then(result =>{
              cameraStarted();
              console.log("webcam started");
            })
            .catch(err => {
                displayError();
            });
        }

        function sendabsence() {
            // begin hilangkan button send dan tampilkan loader
            $("#sendbut").hide();
            document.getElementsByClassName("loader")[0].style.display = "block";
            // end hilangkan button send dan tampilkan loader
            var datauri = document.querySelector('#download-photo').href;

            // console.log("save absen luar kota");
            // // console.log(datauri);
            // console.log(Latitude)
            // console.log(Longitude)

            var bodyFormData = new FormData();
            bodyFormData.append('idabsen', 2);
            bodyFormData.append('iduser', document.getElementById('iduser').value);
            // console.log("ikie user "+document.getElementById('iduser').value)
            bodyFormData.append('nama', document.getElementById('nama').value);
            bodyFormData.append('departement', document.getElementById('departement').value);
            bodyFormData.append('bagian', document.getElementById('bagian').value);
            bodyFormData.append('nik', document.getElementById('nik').value);
            bodyFormData.append('kota', document.getElementById('kota').value);
            bodyFormData.append('company', document.getElementById('company').value);
            bodyFormData.append('status', 'absen masuk');
            bodyFormData.append('latitude', Latitude);
            bodyFormData.append('longitude', Longitude);
            bodyFormData.append('alamat', document.getElementById('alamat').value);
            bodyFormData.append('gambar', datauri);
            bodyFormData.append('ke', document.getElementById('ke').value);
            bodyFormData.append('ke2', document.getElementById('ke2').value);
            bodyFormData.append('ke3', document.getElementById('ke3').value);
            bodyFormData.append('ke4', document.getElementById('ke4').value);
            bodyFormData.append('ke5', document.getElementById('ke5').value);

            var departement = document.getElementById('departement').value;
            if (departement == "SALES & MARKETING") {
                bodyFormData.append('lokasikerja', "ib");
            } else {
                bodyFormData.append('lokasikerja', document.getElementById('lokasikerja').value);
            }

            axios({
                    method: 'post',
                    // url: `http://127.0.0.1:8080/api/absenluarkota/betapostabsenluarkota`,
                    url: `https://new.sidar.id/api/absenluarkota/betapostabsenluarkota`,
                    data: bodyFormData,
                })
                .then(response => {
                    // clearTable();
                    // getAddress();
                    // console.log('success');
                    window.location.href = "{{'admin/dashboard'}}";
                    // $('#modalAddRecipients').modal('hide');
                })
                .catch(error => {
                    // console.log("gagal gaes");
                    // console.log(bodyFormData);
                    // console.log('Error:' + error.message);
                    alert("Lokasi Anda Tidak Ditemukan, Silahkan Lakukan Kembali");
                    window.location.href = "{{'admin/dashboard'}}";

                });
        }
    </script>

</body>

</html>
