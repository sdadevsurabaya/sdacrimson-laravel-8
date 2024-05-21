<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" media="screen"
        href="{{ url('/assets/js/easywebcam/style/webcam-demo.css') }}">
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
            <div class="text-light">Checkout</div>
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
            <div class="lokasi text-light opacity-75"
                style="position: absolute; top: 64px; left: 15px; z-index: 1032; font-size: .875em;">
                <div id="pendeteksian"><i class="bi bi-x-circle fs-4 ms-2" style="color: red;"></i></div>
                <div id="longitude" style="visibility: hidden;"></div>
                <div id="latitude" style="visibility: hidden;"></div>
                <p id='distance' style="visibility: hidden;"></p>

                <input type="hidden" id="iduser" name="iduser" value="{{ Auth::id() }}">
                <input type="hidden" id="general_id" name="general_id" value="{{ request('id_general') }}">

                <input type="hidden" id="status" name="status" value="absen masuk">

            </div>
        </div>

        <!-- preview photo -->
        <div class="collapse">
            <canvas id="canvas" class="d-none"></canvas>

            <button id="resume-camera" class="btn btn-outline-light d-flex align-items-center" data-bs-toggle="collapse"
                data-bs-target=".collapse" style="position: absolute; z-index: 1032; bottom: 13px; left: 15px;">
                <small style="font-size: 12px;">Retake Photo</small> <i class="bi bi-x-circle fs-4 ms-2"></i>
            </button>

            <div id="cameraControls" class="cameraControls">
                <a href="#" id="download-photo" download="selfie.jpeg" target="_blank" title="Save Photo"
                    class="d-none"><i class="material-icons"></i></a>
            </div>
        </div>


        <!-- maps area -->
        <div class="position-absolute w-100" style="z-index: 1032; left: 0; bottom: 52px;">
            <div class="container-fluid w-100">
                <iframe class="border-0 rounded overflow-hidden" id="gmapsx" width="40%" height="auto"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p id="mapinfo" class="small text-light">
                </p>
            </div>
        </div>
        {{-- src="https://maps.google.com/maps?q=-7.4016,112.5929&z=12&output=embed" --}}
    </main>

    <!-- modal textarea / message -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        <i class="bi bi-chat"></i> <span>Write Message</span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea name="note" id="note" cols="30" rows="5" class="form-control border-0 rounded-0"
                        placeholder="Write your message here"></textarea>
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
    <nav id="navdown" class="navbar position-absolute start-0 bottom-0 end-0"
        style="padding-bottom: .75rem; padding-top: 10rem;">
        <div class="container-fluid d-block">
            <div class="row row-cols-2 g-2">
                <div class="col">
                    <button class="btn btn-secondary w-100 py-2" id="take-photo" data-bs-toggle="collapse"
                        data-bs-target=".collapse">
                        <i class="bi bi-camera me-2"></i> TAKE PHOTO
                    </button>
                </div>
                <div class="col">
                    <button class="btn btn-primary w-100 py-2" id="sendbut" onClick="sendabsence()"
                        style="display: none;">
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

        $("#take-photo").on('click', function() {
            $("#sendbut").show();
            $("#take-photo").hide();
        });

        $("#resume-camera").click(function() {
            webcam.stream()
                .then(facingMode => {
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
                    // console.log(response.data);
                    // console.log('space');
                    // console.log('space');
                    // console.log(response.data.features[0].context);

                    // console.log('ini isinya place');
                    // console.log(response.data.features[0].context[2].text);
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
                    // document.getElementById('alamat').value = text;
                    // document.getElementById('mapinfo').innerHTML = 'undefined mapbox timeout exceeded';
                    // document.getElementById('alamat').value = '-';
                    $("#gmapsx").attr("src", 'https://maps.google.com/maps?q=' + lat + ',' + long +
                        '&z=12&output=embed');
                    $("#take-photo").show();
                })
                .catch(function(err) {
                    // console.log(err);
                    // console.log('iki gak metu mape')
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
            // console.log("coba");
            // console.log(Latitude);
            // console.log(Longitude);
            document.getElementById('pendeteksian').innerHTML =
                '<i class="bi bi-check-circle fs-4 ms-2" style="color: lime;"></i>';
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

            getmapinfo(Longitude, Latitude);
        }

        window.onload = function() {
            // console.log("test lagi");
            getLocation()
            webcam.start()
                .then(result => {
                    cameraStarted();
                    // console.log("webcam started");
                })
                .catch(err => {
                    displayError();
                });
        }

        function sendabsence() {
            // Mulai: Hilangkan button send dan tampilkan loader
            $("#sendbut").hide();
            $(".loader").show(); // Menggunakan jQuery untuk menampilkan loader
            // Selesai: Hilangkan button send dan tampilkan loader

            var datauri = $('#download-photo').attr('href'); // Menggunakan jQuery untuk mendapatkan href
            // console.log(datauri);

            function dataURItoBlob(dataURI) {
                var byteString = atob(dataURI.split(',')[1]);
                var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]
                var ab = new ArrayBuffer(byteString.length);
                var ia = new Uint8Array(ab);
                for (var i = 0; i < byteString.length; i++) {
                    ia[i] = byteString.charCodeAt(i);
                }
                return new Blob([ab], {
                    type: mimeString
                });
            }

            var imageBlob = dataURItoBlob(datauri);


            var bodyFormData = new FormData();
            bodyFormData.append('iduser', $('#iduser').val());
            bodyFormData.append('general_id', $('#general_id').val());
            bodyFormData.append('note', $('#note').val());
            bodyFormData.append('status', 'check out');
            bodyFormData.append('latitude', Latitude); // Pastikan Latitude didefinisikan sebelumnya
            bodyFormData.append('longitude', Longitude); // Pastikan Longitude didefinisikan sebelumnya
            bodyFormData.append('foto', imageBlob, 'photo.jpg');

            var url = "{{ url('/') }}";
            var urlPost = url + '/api/attendance';
            $.ajax({
                type: 'POST',
                url: urlPost,
                data: bodyFormData,
                processData: false, // Jangan proses data
                contentType: false, // Jangan set tipe konten
                success: function(response) {
                    // console.log(response);
                    window.location.href = "{{ 'admin/generals' }}";
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                    alert("Lokasi Anda Tidak Ditemukan, Silahkan Lakukan Kembali");
                    // Bisa tambahkan untuk menampilkan kembali tombol send dan menyembunyikan loader jika diperlukan
                    $("#sendbut").show();
                    $(".loader").hide();
                }
            });
        }
    </script>

</body>

</html>
