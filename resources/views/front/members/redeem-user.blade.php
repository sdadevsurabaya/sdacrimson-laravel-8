<div class="accordion-item">
    <div class="accordion-header d-lg-none">
        <button id="btnUserRedeem" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userRedeem">
            <span class="me-3">redeem</span> <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    <div id="userRedeem" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
        <div class="accordion-body">

            <div class="text-end mb-4">
                <a data-bs-toggle="collapse" href="#filterRedeem" class="text-inherit me-4"><u>Sort by</u></a>
                <a data-bs-toggle="collapse" href="#userRedeemHistory" class="text-inherit btn-history-redeem"><u>Redeem
                        History</u> <i class="bi bi-chevron-right"></i></a>
            </div>

            <div class="collapse show" id="filterRedeem">
                <hr class="m-0 opacity-50">
            </div>

            <!-- filter redeem -->
            <div class="collapse" id="filterRedeem">
                <div class="rounded border">
                    <div class="container-fluid py-3">
                        <div class="row">
                            <div class="col-lg-8">
                                <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i
                                        class="bi bi-x"></i></button>
                                <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i
                                        class="bi bi-x"></i></button>
                                <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i
                                        class="bi bi-x"></i></button>
                                <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i
                                        class="bi bi-x"></i></button>
                                <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i
                                        class="bi bi-x"></i></button>
                            </div>
                            <div class="col-12 d-lg-none">
                                <hr class="opacity-50">
                            </div>
                            <div class="col-lg-4">
                                <div class="btn-group w-100">
                                    <button class="btn btn-secondary px-4">Reset</button>
                                    <button class="btn btn-primary px-4">Apply</button>
                                </div>
                            </div>
                        </div>
                        <hr class="opacity-50 d-none d-lg-block">
                        <div>
                            <form action="">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="radioPalingPopuler" checked>
                                    <label class="form-check-label ms-1" for="radioPalingPopuler">
                                        Paling Populer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="radioTerendah">
                                    <label class="form-check-label ms-1" for="radioTerendah">
                                        Paling Populer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="radioTertinggi">
                                    <label class="form-check-label ms-1" for="radioTertinggi">
                                        Paling Populer
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- menu tab user redeem -->
            <div class="table-lg-responsive my-lg-3">
                <nav class="nav nav-pills nav-justified gap-2 my-4 my-lg-3 flex-lg-nowrap">
                    <a class="nav-link active" data-bs-toggle="pill" href="#pills-coffee">coffee</a>
                    <a class="nav-link" data-bs-toggle="pill" href="#pills-accessories">accessories</a>
                    <a class="nav-link" data-bs-toggle="pill" href="#pills-coupon">vouchers</a>
                </nav>
            </div>

            <!-- tab user redeem -->
            <div class="tab-content" id="pills-tabUser">

                <div class="tab-pane fade show active" id="pills-coffee" role="tabpanel"
                    aria-labelledby="pills-coffee-tab" tabindex="0">
                    <div id="merchandise" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">



                        {{-- <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/product/produk1.png" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 points</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div>
                   <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/product/produk1.png" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 points</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div>
                   <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/product/produk1.png" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 points</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div>
                   <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/product/produk1.png" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 points</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div>
                   <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/product/produk1.png" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 points</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div>
                   <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/product/produk1.png" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 points</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div>
                   <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/product/produk1.png" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 points</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div> --}}

                    </div>
                </div>

                <div class="tab-pane fade" id="pills-accessories" role="tabpanel"
                    aria-labelledby="pills-accessories-tab" tabindex="0">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

                        <div class="col">
                            <div class="card card-product border-0 rounded-0 text-center mb-4">
                                <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                                    <img src="../ui/img/accessories.jpg" class="img-fluid">
                                </div>
                                <div class="card-body text-capitalize py-2 px-0">
                                    <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling
                                            coffee capsules</span> 200g</div>
                                    <div class="cart-text my-1 gotham-bold">10 Beanss</div>
                                    <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="pills-coupon" role="tabpanel" aria-labelledby="pills-coupon-tab"
                    tabindex="0">

                    <div id="vouchers" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

                        {{-- <div class="col">
                      <div class="card card-product border-0 rounded-0 text-center mb-4">
                         <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                            <img src="ui/img/vouchers.jpg" class="img-fluid">
                         </div>
                         <div class="card-body text-capitalize py-2 px-0">
                            <div class="cart-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                            <div class="cart-text my-1 gotham-bold">10 Beans</div>
                            <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                         </div>
                      </div>
                   </div> --}}

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<script>
    function setRedeem(idproduct) {

    }

    function getMembersVouchers() {
        var bodyFormData = new FormData();
        var url = "<?php echo url('/'); ?>";
        console.log(url);
        var membersvouchers = '';
        bodyFormData.append('idmembers', document.getElementById('idmembers').value);
        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/api/getVouchersByIdMembers`,
                //url: `https://project-supresso.suryoatmojo.id/api/getVouchersByIdMembers`,
                url: 'api/getVouchersByIdMembers',
                data: bodyFormData,
            })
            .then(response => {
                console.log(response.data);
                for (let m = 0; m < response.data.length; m++) {
                    if (response.data[m].type == 'persen') {
                        var content = '<div class="col-auto"><div class="card-vouchers">' + response.data[m]
                            .nominal + '% OFF <small>' + response.data[m].kodecoupon + '</small></div></div>';
                    }
                    membersvouchers = membersvouchers + content;
                }
                document.getElementById("membersvouchers").innerHTML = membersvouchers;
            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }

    function getVouchers() {
        var url = "<?php echo url('/'); ?>";
        console.log(url);
        var vouchers = '';
        axios({
                method: 'get',
                // url: `http://127.0.0.1:8000/api/getVouchersAll`,
                //url: `https://project-supresso.suryoatmojo.id/api/getVouchersAll`,
                url: 'api/getVouchersAll',

            })
            .then(response => {

                console.log(response.data);
                for (let m = 0; m < response.data.length; m++) {
                    var actualpoint = (+document.getElementById("finalpoint").value) - (response.data[m].poinneed);
                    var form_open =
                        '<form action="{{ route('cart.store') }}" id="frm" method="POST" enctype="multipart/form-data"> @csrf ';
                    var form_input_redeem = '<input type="hidden" value="true" name="redeem">';
                    var form_input_id = '<input type="hidden" value="' + response.data[m].id + '" name="id">';
                    var form_input_name = '<input type="hidden" name="name" value="' + response.data[m].kodecoupon +
                        '">';
                    var form_input_price = '<input type="hidden" value="500" name="price" value=0>';
                    var form_input_qty = '<input type="hidden" id="hiddenqty" name="quantity" value="1">';
                    var form_input_gramature =
                        '<input type="hidden" id="hiddengramature"  name="gramature" value="100">';
                    var form_input_images = '<input type="hidden"  name="images" value="' + response.data[m]
                        .gambar + '">';
                    var form_iduser = '<input type="hidden" name="iduser" value="' + (document.getElementById(
                        "iduser").value) + '">';
                    var form_idproduct_redeem = '<input type="hidden" name="idproduct_redeem" value="' + response
                        .data[m].id + '">';
                    var form_member_point_origin = '<input type="hidden" name="member_point_origin" value="' + (
                        document.getElementById("finalpoint").value) + '">';
                    var form_member_point_redeem = '<input type="hidden" name="member_point_redeem" value="' +
                        response.data[m].poinneed + '">';
                    var persentage = Math.round(document.getElementById("finalpoint").value / (response.data[m]
                        .poinneed) * 100);
                    if (persentage > 100) {
                        persentage = 100;
                    }
                    var form_progress =
                        '<div class="progress"><div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: ' +
                        persentage + '%;">' + persentage + '%</div></div>';

                    var form_close = '';
                    if (document.getElementById("finalpoint").value < (response.data[m].poinneed)) {

                        form_close =
                            '<button disabled class="btn btn-sm    w-100" id="btnAddcart" onClick=setRedeem(' +
                            response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
                    } else {
                        form_close =
                            '<button class="btn btn-sm btn-primary w-100" id="btnAddcart" onClick=setRedeem(' +
                            response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
                    }

                    var form = form_open + form_input_redeem + form_input_id + form_input_name + form_input_price +
                        form_input_qty + form_input_gramature + form_input_images + form_iduser +
                        form_idproduct_redeem + form_member_point_origin + form_member_point_redeem +
                        form_progress + form_close;

                    vouchers = vouchers +
                        '<div class="col"><div class="card card-product border-0 rounded-0 text-center mb-4"><div class="card-header position-relative p-0 border-0 rounded overflow-hidden"><img src="../ui/img/' +
                        response.data[m].gambar +
                        '" class="img-fluid"></div><div class="card-body text-capitalize py-2 px-0"><div class="cart-title lh-sm small mb-2" style="min-height:60px"><span class="fw-bold">' +
                        response.data[m].kodecoupon + '</span></div><div class="cart-text my-1 gotham-bold">' +
                        response.data[m].poinneed + ' Beans</div>' + form + '</div></div></div>';

                }

                document.getElementById("vouchers").innerHTML = vouchers;



            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }


    function getMerchandise() {
        var bodyFormData = new FormData();
        var merchandise = '';
        bodyFormData.append('idmembers', document.getElementById('idmembers').value);
        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/api/getMerchandiseAll`,
                //url: `https://project-supresso.suryoatmojo.id/api/getMerchandiseAll`,
                url: 'api/getMerchandiseAll',

            })
            .then(response => {

                for (let m = 0; m < response.data.length; m++) {
                    var actualpoint = (+document.getElementById("finalpoint").value) - (response.data[m].poinneed);
                    var form_open =
                        '<form action="{{ route('cart.store') }}" id="frm" method="POST" enctype="multipart/form-data"> @csrf ';
                    var form_input_redeem = '<input type="hidden" value="true" name="redeem">';
                    var form_input_id = '<input type="hidden" value="' + 'REDEEM-' + response.data[m].id_product +
                        '" name="id">';
                    var form_input_name = '<input type="hidden" name="name" value="' + response.data[m].name + '">';
                    var form_input_price = '<input type="hidden" value="0" name="price" value=0>';
                    var form_input_qty = '<input type="hidden" id="hiddenqty" name="quantity" value="1">';
                    var form_input_gramature =
                        '<input type="hidden" id="hiddengramature"  name="gramature" value="100">';
                    var form_input_images = '<input type="hidden"  name="images" value="' + response.data[m].img +
                        '">';

                    var form_iduser = '<input type="hidden" name="iduser" value="' + (document.getElementById(
                        "iduser").value) + '">';
                    var form_idproduct_redeem = '<input type="hidden" name="idproduct_redeem" value="' + response
                        .data[m].id_product + '">';
                    var form_member_point_origin = '<input type="hidden" name="member_point_origin" value="' + (
                        document.getElementById("finalpoint").value) + '">';
                    var form_member_point_redeem = '<input type="hidden" name="member_point_redeem" value="' +
                        response.data[m].poinneed + '">';
                    var form_member_point_actual = '<input type="hidden" name="member_point_actual" value="' +
                        actualpoint + '">';
                    // var form_redeem_description ='<input type="hidden" name="redeem_description" value=0>';
                    var persentage = Math.round(document.getElementById("finalpoint").value / (response.data[m]
                        .poinneed) * 100);

                    if (persentage > 100) {
                        persentage = 100;
                    }

                    var form_progress =
                        '<div class="progress"><div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: ' +
                        persentage + '%;">' + persentage + '%</div></div>';

                    var form_close = '';
                    if (document.getElementById("finalpoint").value < (response.data[m].poinneed)) {

                        form_close =
                            '<button disabled class="btn btn-sm    w-100" id="btnAddcart" onClick=setRedeem(' +
                            response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
                    } else {
                        form_close =
                            '<button class="btn btn-sm btn-primary w-100" id="btnAddcart" onClick=setRedeem(' +
                            response.data[m].id_product + ')>Redeem<i class="bi bi-cart-plus"></i></button></form>';
                    }

                    var form = form_open + form_input_redeem + form_input_id + form_input_name + form_input_price +
                        form_input_qty + form_input_gramature + form_input_images + form_iduser +
                        form_idproduct_redeem + form_member_point_origin + form_member_point_redeem +
                        form_member_point_actual + form_progress + form_close;

                    merchandise = merchandise +
                        '<div class="col"><div class="card card-product border-0 rounded-0 text-center mb-4"><div class="card-header position-relative p-0 border-0 rounded overflow-hidden"><img src="' +
                        response.data[m].images +
                        '" class="img-fluid"></div><div class="card-body text-capitalize py-2 px-0"><div class="cart-title lh-sm small mb-2" style="min-height:60px"><span class="fw-bold">' +
                        response.data[m].name + '</span></div><div class="cart-text my-1 gotham-bold">' + response
                        .data[m].poinneed + ' Beans</div>' + form + '</div></div></div>';

                }

                document.getElementById("merchandise").innerHTML = merchandise;


            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }
</script>
