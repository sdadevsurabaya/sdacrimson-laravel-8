<div class="accordion-item">
    <div class="accordion-header d-lg-none">
        <button id="btnUserDashboard" class="btn btn-user" data-bs-toggle="collapse" data-bs-target="#userDashboard">
            <span class="me-3">dashboard</span> <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    <div id="userDashboard" class="accordion-collapse collapse fade show" data-bs-parent="#accordionUser">
        <div class="accordion-body">


            @if (file_exists(public_path('uploads/' . Str::ucfirst(Auth::user()->email) . '.jpg')))
                <img src="../uploads/{{ Str::ucfirst(Auth::user()->email) }}.jpg" width="88.85" height="88.85"
                    class="img-thumbnail mx-auto d-block p-0 rounded-circle mb-4 mb-lg-5" alt="...">
            @else
                <img src="../ui/img/user/user.jpg" width="88.85" height="88.85"
                    class="img-thumbnail mx-auto d-block p-0 rounded-circle mb-4 mb-lg-5" alt="...">
            @endif



            {{-- <img src="../ui/img/user/user.jpg" width="88.85" height="88.85" class="img-thumbnail mx-auto d-block p-0 rounded-circle mb-4 mb-lg-5" alt="..."> --}}
            {{-- <img src="../uploads/{{Str::ucfirst(Auth::user()->email)}}.jpg" width="88.85" height="88.85" class="img-thumbnail mx-auto d-block p-0 rounded-circle mb-4 mb-lg-5" alt="..."> --}}
            <input type="hidden" id="filename" value="{{ Str::ucfirst(Auth::user()->email) }}">

            
                <div class="row mb-5">
                    <div class="col-md-6">
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <button onclick="uploadimage()" class="btn btn-primary" type="submit"
                            class="btn btn-success">Upload</button>
                    </div>
                </div>
           

            <div class="position-relative mb-5">
                <div class="progress">
                    <div class="progress-bar bg-secondary" role="progressbar" aria-label="Example with label"
                        style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">45%</div>
                </div>
                <p class="position-absolute start-0" style="top: 24px;">Robusta</p>
                <p class="position-absolute end-0" style="top: 24px;">Arabica</p>
            </div>
            {{-- <input type="range" class="form-range mb-4" min="0" max="5" id="customRange1"> --}}

            <div class="text-bg-secondary rounded-pill p-3 mb-2" style="border-end-start-radius: 0!important;">
                $150 to go before 3 Januari 2022 to keep your rewards for the next 6 months.
            </div>

            <div class="text-bg-primary rounded-pill p-3 mb-5" style="border-end-start-radius: 0!important;">
                Let’s go to Supresso to see more benefits?
            </div>

            <h4 class="gotham-bold">Your Level</h4>

            <div class="row gx-lg-5 mb-5">
                <div class="col-md-6 mb-2 mb-md-0">
                    <a data-bs-toggle="offcanvas" href="#sideMember" class="text-decoration-none text-inherit">
                        <div class="rounded"
                            style="background-image: linear-gradient(to left, rgba(0,0,0,.1), transparent);">
                            <div class="container-fluid py-3">
                                <div class="mb-3 opacity-0 invisible">Range Membership</div>
                                <div><span class="text-uppercase fs-3">{{ $caption }}</span> <span
                                        class="text-capitalize">memberships</span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="rounded"
                        style="background-image: linear-gradient(to left, rgba(0,0,0,.1), transparent);">
                        <div class="container-fluid py-3">
                            <div class="mb-3">
                                <a data-bs-toggle="collapse" href="#userRedeemHistory"
                                    class="text-inherit btn-history-redeem"><u>History Redeem <i
                                            class="bi bi-chevron-right"></i></u></a>
                            </div>
                            <div><span class="text-uppercase fs-3">{{ $totalpoint }}</span> <span
                                    class="text-capitalize">Beans</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="gotham-bold">Vouchers</h4>

            <div class="table-responsive mb-5">
                <div id="membersvouchers" class="row flex-nowrap g-2">
                    {{-- <div class="col-auto">
                   <div class="card-vouchers">20% OFF <small>Cristmas Sale</small></div>
                </div>
                <div class="col-auto">
                   <div class="card-vouchers">20% OFF <small>Cristmas Sale</small></div>
                </div>
                <div class="col-auto">
                   <div class="card-vouchers">20% OFF <small>Cristmas Sale</small></div>
                </div>
                <div class="col-auto">
                   <div class="card-vouchers">20% OFF <small>Cristmas Sale</small></div>
                </div> --}}
                </div>
            </div>

            <a href="#" class="text-inherit"><u>FAQ Memberships <i class="bi bi-chevron-right"></i></u></a>

        </div>
    </div>
</div>
<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
<script>
    function uploadimage() {
      $('#loading').collapse('show');
        //alert("test");
        //console.log($('#images')[0].files[0]);

        var bodyFormData = new FormData();
        bodyFormData.append('idmembers', 1);
        bodyFormData.append('file', $('#image')[0].files[0]);
        bodyFormData.append('filename', document.getElementById("filename").value);
        axios({
                method: 'post',
                url: '../api/updateimage',
                data: bodyFormData,
                headers: {
                    "Content-Type": "multipart/form-data"
                },
            })
            .then(response => {
                console.log(response.data)
                //console.log(response.data.length)
                location.reload();

            })
            .catch(error => {
                console.log('Error:' + error.message);
            });

    }
</script>
