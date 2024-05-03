@extends('front/layout')
@section('konten')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- section of checkout -->
    <section>
        <div class="container">
            <form action={{ route('payment') }} method="POST" class="mb-4" id="paymentform">
                @csrf
                <div class="row">

                    <div class="col-lg-6 col-xxl-5">
                        <h2 class="fs-2 fs-lg-3 mb-3"><strong class="gotham-bold">Checkout.</strong></h2>
                        @if (empty(Auth::user()))
                            <h5 class="mb-5">
                                Let us know more about you!
                                <br>
                                OR <a href="#" class="text-primary">Login with your account</a>
                            </h5>
                        @endif

                        <!-- form biodata penerima/ customer untuk yang belum login (jika sudah login ada value di input form untuk menampilkan informasi biodata penerima/ customer) -->
                        {{-- <form action={{ route('payment') }} method="POST" class="mb-4"> --}}
                        <div class="form-floating mb-3 border-bottom">
                            @if (!empty($member[0]))
                                <input name="cfullname" type="name" class="form-control px-0 border-0 rounded-0"
                                    id="floatingInputFullName" placeholder="name@example.com"
                                    value="{{ $member[0]->firstname }} {{ $member[0]->lastname }}">
                            @else
                                <input name="cfullname" type="name" class="form-control px-0 border-0 rounded-0"
                                    id="floatingInputFullName" placeholder="name@example.com">
                            @endif

                            <label class="px-0" for="floatingInputFullName">Full Name*</label>
                        </div>
                        <div class="form-floating mb-3 border-bottom">
                            @if (!empty($member[0]))
                                <input name="cemail" type="email" class="form-control px-0 border-0 rounded-0"
                                    id="floatingInputEmail" placeholder="name@example.com" value="{{ $member[0]->email }}">
                            @else
                                <input name="cemail" type="email" class="form-control px-0 border-0 rounded-0"
                                    id="floatingInputEmail" placeholder="name@example.com">
                            @endif
                            <label class="px-0" for="floatingInputEmail">Email address*</label>
                        </div>
                        <div class="form-floating mb-4 border-bottom">
                            @if (!empty($member[0]))
                                <input name="cphone" type="phone" class="form-control px-0 border-0 rounded-0"
                                    id="floatingInputPhone" placeholder="name@example.com" value="{{ $member[0]->notelp }}">
                            @else
                                <input name="cphone" type="phone" class="form-control px-0 border-0 rounded-0"
                                    id="floatingInputPhone" placeholder="name@example.com">
                            @endif

                            <label class="px-0" for="floatingInputPhone">Phone Number*</label>
                        </div>

                        {{-- </form> --}}

                        <h5 class="mb-5">
                            Where would you like your item(s) to be sent?
                        </h5>

                        <!-- form alamat pengiriman/ shiping untuk yang belum login -->
                        {{-- <form action="" class="mb-5"> --}}
                        <div class="form-select2 mb-3 border-bottom">
                            <label class="px-0" for="shippingTo">Shipping to :</label>
                            <select name="cshippingto" class="form-select px-0 border-0 rounded-0" id="shippingTo"
                                aria-label="Floating label select" onchange="getAddressMember()">
                                <option value="0" selected>New Address</option>
                                @foreach ($member[0]->AddressMember as $Address)
                                    <option value="{{ $Address->id }}">{{ $Address->subject }}</option>
                                @endforeach
                            </select>

                        </div>

                        <!-- collapse user id recepients -->
                        {{-- <button class="btn btn-light" id="btnRecipientsID">Open Collapse Recepients ID</button> --}}
                        <div class="collapse" id="recipientsName">
                            <div class="form-floating mb-3 border-bottom">
                                <input name="crecepientsName" type="name" class="form-control px-0 border-0 rounded-0"
                                    id="floatingInputRecipientsName" placeholder="Home">
                                <label class="px-0" for="floatingInputRecipientsName">Recipients Name*</label>
                            </div>
                        </div>
                        <!-- end of collapse user id recepients -->

                        <div class="form-floating mb-3 border-bottom">
                            <input name="crecepientsFullName" type="name" class="form-control px-0 border-0 rounded-0"
                                id="rfullname" placeholder="name@example.com">
                            <label class="px-0" for="floatingInputFullName2">Full Name*</label>
                        </div>
                        <div class="form-floating mb-3 border-bottom">
                            <input name="crecepientsEmail" type="email" class="form-control px-0 border-0 rounded-0"
                                id="remail" placeholder="name@example.com">
                            <label class="px-0" for="floatingInputEmail2">Email address*</label>
                        </div>
                        <div class="form-floating mb-4 border-bottom">
                            <input name="crecepientsPhone" type="phone" class="form-control px-0 border-0 rounded-0"
                                id="rphone" placeholder="name@example.com">
                            <label class="px-0" for="floatingInputPhone3">Phone Number*</label>
                        </div>

                        <div class="form-select2 mb-3 border-bottom">
                            <label class="px-0" for="floatingSelectCountry">Country*</label>
                            <select name="crecepientsState"
                                class="js-example-placeholder-single form-select px-0 border-0 rounded-0" name="state"
                                id="rstate">

                                <?php
                                 for($x = 0; $x < sizeof($arraynegara); $x++){
                                ?>
                                <option value="<?php echo $arraynegara[$x]->alpha_2; ?>"><?php echo $arraynegara[$x]->name; ?></option>
                                {{-- <option value="<?php echo $arraynegara[$x]->alpha_2; ?>"><?php echo $arraynegara[$x]->id . '-' . $arraynegara[$x]->name . '-' . $arraynegara[$x]->alpha_2; ?></option>                  --}}
                                <?php 
                                 }
                                 ?>
                                <br>
                            </select>


                        </div>

                        <div class="form-select2 mb-3 border-bottom">
                            <label class="px-0" for="floatingSelectProvince">Province*</label>
                            <select name="crecepientsProvince" class="form-select px-0 border-0 rounded-0" id="rprovince"
                                aria-label="Floating label select">
                                <option value="1" selected>Jawa Timur</option>
                                <option value="2">Jawa Tengah</option>
                                <option value="3">Jawa Barat</option>
                            </select>
                        </div>

                        <div class="form-floating mb-4 border-bottom">
                            <input name="crecepientsCity" class="form-control px-0 border-0 rounded-0"
                                {{-- name="city"  --}} id="rcity" placeholder="" required>

                            <label class="px-0" for="city">City*</label>
                        </div>


                        <div class="form-floating mb-4 border-bottom">
                            <input name="cpostcode" class="form-control px-0 border-0 rounded-0" type="number"
                                {{-- name="postcode" --}} id="rpostcode" placeholder="" required>
                            <label class="px-0" for="postcode">Post Code*</label>
                        </div>

                        <div class="form-floating mb-3 border-bottom">
                            <textarea name="caddress1" class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here"
                                id="rAddress1" {{-- name="alamat1"  --}} required></textarea>
                            <label class="px-0" for="rAddress1">Address 1*</label>
                        </div>
                        <div class="form-floating mb-3 border-bottom">
                            <textarea name="caddress2" class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here"
                                id="rAddress2"></textarea>
                            <label class="px-0" for="rAddress2">Address 2 (Optional)</label>
                        </div>
                        <div class="form-floating mb-4 border-bottom">
                            <textarea name="cmessage" class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here"
                                id="rMessage" style="height: 160px;"></textarea>
                            <label class="px-0" for="floatingTextareaMessage">Leave a message to seller
                                (Optional)</label>
                        </div>



                        {{-- </form> --}}
                        <div class="collapse" id="recipientsButton">
                            <button class="btn btn-light" onclick="saveAddress()">Save New Recipients <i
                                    class="bi bi-save ml-2"></i></button>
                        </div>

                    </div>

                    <div class="col-lg sidepanel ms-lg-auto">

                        <!-- panel with background -->
                        <div class="rounded mb-5" style="background-color: #f1f2f2;">
                            <div class="container-fluid p-3">

                                <!-- summary product from cart -->
                                <div>
                                    <h4 class="gotham-bold fs-4 fs-lg-5 mb-3">Summary (2)</h4>

                                    @foreach ($cartItems as $item)
                                        <!-- produk item -->
                                        <div class="row align-items-center g-0 mb-3">
                                            <div class="col-4">
                                                <img src="{{ url('files/product-images/' . $item->attributes->images) }}"
                                                    class="img-fluid bg-white rounded" alt="">
                                            </div>
                                            <div class="col-6 small ps-3">
                                                <p class="mb-2 lh-sm text-capitalize">
                                                    @if ($item->id == 'GIFT-' . $product_free_gift_models->product_id)
                                                        <strong style="color:#fd4f00">(FREE) </strong>
                                                    @endif
                                                    <strong>{{ $item->name }}</strong>
                                                    {{ $item->attributes->gramature }}g
                                                </p>
                                                <p class="fw-bold mb-2 lh-sm">QTY. {{ $item->quantity }}</p>
                                                <div class="harga-produk lh-sm">
                                                    <div class="harga-normal lh-sm">
                                                        <span>$</span> <span>{{ $item->price }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <p class="text-end"><a href="/fcart" class="text-inherit">[EDIT CART]</a></p>
                                </div>

                                <hr class="opacity-100">

                                <!-- subtotal -->
                                <div class="row fw-bold mb-3">
                                    <div class="col-6">Subtotal</div>
                                    <div class="col-6 d-flex justify-content-between">
                                        <span>$</span>
                                        <span id="atsubtotal" class="nominal">{{ session('totalbeforediscount') }}</span>
                                    </div>

                                    {{-- <span id="atsubtotal" class="nominal">
                                        <?php
                                        // if (empty($jumlahsubtotprod)) { echo '0.00';
                                        // } else {
                                        //     echo number_format((float) $jumlahsubtotprod, 2, '.', '');
                                        //}
                                        ?></span> --}}

                                </div>

                                <!-- diskon -->
                                <div class="row mb-3">
                                    <div class="col-6">Discount</div>
                                    <div class="col-6 d-flex justify-content-between">
                                        <span>$</span>
                                        <span>
                                            {{-- {{session('discountvalue')}} --}}
                                        </span><input
                                            class="form-check-input w-100 bg-transparent rounded-0 border-0 text-end"
                                            type="text" id="discount" value="{{ session('discountvalue') }}">
                                    </div>
                                </div>


                                {{-- </form> --}}
                                <div id="response"></div>

                                <hr>

                                <!-- Shipping -->
                                @if (!empty($shipping))
                                    <div class="row">
                                        <div class="col-6">Shipping</div>
                                        <div class="col-6 d-flex justify-content-between">
                                            <span>$</span>

                                            {{-- <span>{{$shipping->getValue()}}</span> --}}
                                            <input
                                                class="form-check-input w-100 bg-transparent rounded-0 border-0 text-end"
                                                type="text" id="shipping">

                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-6">Shipping</div>
                                        <div class="col-6 d-flex justify-content-between">
                                            <span>$</span>

                                            {{-- <span>{{$shipping->getValue()}}</span> --}}
                                            <input
                                                class="form-check-input w-100 bg-transparent rounded-0 border-0 text-end"
                                                type="text" id="shipping">
                                            <input
                                                class="form-check-input w-100 bg-transparent rounded-0 border-0 text-end"
                                                type="hidden" id="shippingname">
                                            <input
                                                class="form-check-input w-100 bg-transparent rounded-0 border-0 text-end"
                                                type="hidden" id="shippingid">
                                                <input
                                                class="form-check-input w-100 bg-transparent rounded-0 border-0 text-end"
                                                type="hidden" id="kodecountry">
                                        </div>
                                    </div>
                                @endif


                                <hr class="opacity-100">

                                <!-- Total -->
                                <div class="row fw-bold fs-5 my-3">
                                    <div class="col-6">Total</div>
                                    <div class="col-6 d-flex justify-content-between">
                                        <span>$</span>
                                        {{-- <span>{{ Cart::getTotal() }}</span> --}}
                                        <input name="total"
                                            class="form-check-input w-100 bg-transparent rounded-0 border-0 text-end fs-5"
                                            type="text" id="total">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- payment -->
                        <h4 class="gotham-bold fs-4 fs-lg-5 mb-3">Payment Method</h4>

                        {{-- <form action={{ route('payment') }} method="POST" class="mb-4"> --}}

                        {{-- <div style="display:none" class="form-check">
                            <input class="form-check-input" type="radio" name="payment">
                            <label class="form-check-label" for="paypal">

                            </label>
                        </div> --}}

                        <div class="form-check">
                            <input name="cpayment" class="form-check-input" type="radio" {{-- name="flexRadioDefault"  --}}
                                id="paypal" value="paypal">
                            <label class="form-check-label ms-1" for="paypal">Paypal</label>
                        </div>
                        <div class="form-check">
                            <input name="cpayment" class="form-check-input" type="radio" {{-- name="flexRadioDefault"  --}}
                                id="creditCard" value="stripe" checked>
                            <label class="form-check-label ms-1" for="creditCard">Credit card/ ApplePay/ GooglePay</label>
                        </div>
                        <hr>
                        <div class="form-check">
                            <input name="cnotifikasiNews" class="form-check-input" type="checkbox" value="1"
                                id="notifikasiNews" checked>
                            <label class="form-check-label" for="notifikasiNews">
                                I want the latest news, innovations and offers from Supresso
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="cnotifikasiTnc" class="form-check-input" type="checkbox" value="1"
                                id="notifikasiTNC">
                            <label class="form-check-label" for="notifikasiTNC">
                                I accept Supresso <a href="#" target="_blank" class="text-primary"><u>Terms &
                                        Conditions</u></a>
                            </label>
                        </div>
                        {{-- <button class="btn btn-lg btn-dark w-100" onClick="createcheckouts()">Proceed to Payment</button> --}}
                        {{-- </form> --}}



                    </div>

                </div>
            </form>
            <button class="btn btn-lg btn-dark w-100" onClick="createcheckouts()">Proceed to Payment</button>


            <form style="" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_xclick" />
                <input type="hidden" name="business" value="dm@indraco.com" />
                <!--Your Paypal Email-->
                <input type="hidden" name="lc" value="US" />
                <input type="hidden" name="item_name" value="Item Description" />
                <!--ITEM NAME WITH DESCRIPTION-->
                <input type="hidden" id="amount" name="amount" value="0" />
                <!--AMOUNT TO TRANSFER-->
                <input type="hidden" name="currency_code" value="SGD" />
                <!--CURRENCY CODE-->
                <input type="hidden" name="button_subtype" value="services" />
                <input type="hidden" name="no_note" value="0" />
                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                <input id="pay" style="display:none" type="submit" name="submit" />
            </form>


        </div>
    </section>
@endsection

@section('popup')
@endsection

{{-- <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script> --}}
<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
<script>
    window.onload = function() {
        $("#rstate").select2().val("sg").trigger("change");
        document.getElementById('rprovince').value = '';
        document.getElementById('rcity').value = '';
        document.getElementById('rpostcode').value = '';
        document.getElementById('rAddress1').value = '';
        document.getElementById('rAddress2').value = '';
        document.getElementById('shipping').value = 0;
        $('#recipientsName').collapse('show');
        $('#recipientsButton').collapse('show');

        //output ="<div class='form-check mb-3'> <input name='cShipperName' type='hidden' value='Supresso Domestic' ><input name = 'cShippingPrice' checked class = 'form-check-input radio' type = 'radio' id = 'shippingsupresso' value = '3.5'> <label class = 'form-check-label ms-1' for='shippingJNEReluler'> <strong> " + "Supresso Domestic" + "</strong></label><br><small>" + "Estimated Shipping: 2 - 3 Working days" + "</small><br>$ 3.50</div>";
        getShipping('sg');


        console.log(output);
        // and then display it
        $('#response').html(output);

        my_function(3.5);
    }

    function saveAddress() {
        // var table = document.getElementById("tablerecepient");
        // var totalRowCount = table.rows.length;
        // var nextrow = +totalRowCount + 1;
        // var row = table.insertRow(totalRowCount);
        var bodyFormData = new FormData();
        bodyFormData.append('idmembers', document.getElementById('idmembers').value);
        bodyFormData.append('subject', document.getElementById('subject').value);
        bodyFormData.append('recepient', document.getElementById('recepient').value);
        bodyFormData.append('phone', document.getElementById('phone').value);
        bodyFormData.append('email', document.getElementById('email').value);
        bodyFormData.append('country', document.getElementById('country').value);
        bodyFormData.append('province', document.getElementById('rprovince').value);
        bodyFormData.append('city', document.getElementById('rcity').value);
        bodyFormData.append('post_code', document.getElementById('rpostcode').value);
        bodyFormData.append('address1', document.getElementById('raddress1').value);
        bodyFormData.append('address2', document.getElementById('raddress2').value);

        axios({
                method: 'post',
                //url: `http://127.0.0.1:8000/api/postMemberAddress`,
                //url: `https://project-supresso.suryoatmojo.id/api/postMemberAddress`,
                url: 'api/postMemberAddress',
                data: bodyFormData,
            })
            .then(response => {
                clearTable();
                getAddress();

                $('#modalAddRecipients').modal('hide');

            })
            .catch(error => {
                console.log('Error:' + error.message);
            });
    }

    function getShipping(idnegara) {
        console.log("change here");
        var kodenegara = idnegara;
        var nemnegara = document.querySelector('#select2-rstate-container');
        console.log("ck2");
        var namanegara = nemnegara.title;
        var postcod = document.querySelector('#rpostcode');
        var postcode = postcod.value;
        var citi = document.querySelector('#rcity');
        var city = citi.value;
        var lamat = document.querySelector('#rAddress1');
        var alamat = lamat.value;
        var sbtl = document.querySelector('#atsubtotal'); //new
        var sbtel = sbtl.innerHTML; //new
        var iduser = '0';

        if (namanegara == 'Singapore') {

            $('#provin').val('Singapore');
            $('#rcity').val('Singapore');
            $('#rpostcode').val('');
            $('#ralamat').val('');

        }
        // else {
        //     $('#provin').val('');
        //    //  $('#rcity').val('');
        //     $('#ralamat').val('');
        //     $('#rpostcode').val('');
        //     $('#rpostcode').val('');
        //     $('#ralamat').val('');
        // }

        console.log("select2");
        console.log(kodenegara);
        console.log(postcode);
        console.log(city);
        console.log(alamat);
        console.log(iduser);
        console.log(namanegara);
        console.log(sbtel);
        //console.log($('meta[name="csrf-token"]').attr('content'));
        const isSG = kodenegara == 'sg' || kodenegara == 'SG';
        $.ajax({
            type: 'post',
            url: '../checkshipping',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'state=' + kodenegara + '&postcode=' + postcode + '&city=' + city +
                '&alamat=' + alamat + '&iduser=' + iduser + '&namanegara=' + namanegara +
                '&subtotal=' + sbtel,
            success: function(data) {
                console.log(data)
                console.log((data.rates.length))

                var output = "<hr>";
                for (i = 0; i < data.rates.length; i++) {

                    const courierName = data.rates[i].courier_name;
                    //const selectedCourier = courierName.includes("Qxpress") || courierName.includes("J&T") || courierName.includes("NinjaVan");
                    const selectedCourier = courierName.includes("Qxpress - Domestic");
                    if (isSG && !selectedCourier)
                        continue;

                    var estimasimin = data.rates[i].min_delivery_time + 1;
                    var estimasimax = data.rates[i].max_delivery_time + 1;
                    var estimasi = "Estimated Shipping: " + estimasimin + " days - " + estimasimax +
                        " days";
                    var price = data.rates[i].total_charge;
                    var name = '"' + data.rates[i].courier_name + '"';
                    var shippingid = '"' + data.rates[i].courier_id + '"';
                    var kodecountry = '"' + kodenegara + '"';
                    //output = output + "<div class='form-check mb-3'><input class='form-check-input radio' type='radio' name='flexRadioDefault' id='shippingJNEReluler' value='2' onchange='this.form.submit()'><label class='form-check-label ms-1' for='shippingJNEReluler'><strong>"+data.rates[i].courier_name+"</strong></label><br><small>"+estimasi+"</small><br>$"+price+"</div>";
                    // output = output + "<div class='form-check mb-3'><input  type='radio' name='bedStatus' id='shipping' value='"+data.rates[i].total_charge+"' ><label class='form-check-label ms-1' for='shippingJNEReluler'><strong>"+data.rates[i].courier_name+"</strong></label><br><small>"+estimasi+"</small><br>$"+price+"</div>";
                    output = output +
                        "<div class='form-check mb-3'> <input name='cShipperName' type='hidden' id='checkshippingname' value='" +
                        data.rates[i].courier_name +
                        "'> <input type='text' name='cShipperId' id='checkshippingId' value='" + data.rates[
                            i].courier_id +
                        "'><input type='text' name='ckodenegara' id='checkkodenegara' value='" + kodenegara +
                        "'><input class = 'form-check-input radio' type='radio' name='cShippingPrice' id='checkshipping' value='" +
                        data.rates[i].total_charge + "' onchange='my_function(" + data.rates[i]
                        .total_charge + "," + name + "," + shippingid + "," + kodecountry +
                        ")'><label class='form-check-label ms-1' for='shippingJNEReluler'><strong>" + data
                        .rates[i].courier_name + "</strong></label><br><small>" + estimasi +
                        "</small><br>$" + price + "</div>";

                }
                // output = "<input type='radio' name='bedStatus' id='allot' checked='checked' value='allot'>Allot";
                console.log("asik");
                console.log(output);
                // and then display it
                $('#response').html(output);
                $('.fetched-datad').html(data); //menampilkan data ke dalam modal
                $("input[type='radio']").click(function() {
                    var radioValue = $("input[name='shipping']:checked").val();
                    if (radioValue) {

                        var myarr = radioValue.split("/");
                        var radioValuee = myarr[0];
                        var priceidd = myarr[1];
                        var layananship = myarr[2];
                        var hargashipping = parseFloat(radioValuee);
                        // var subtott = parseFloat($('#atsubtotal').html());
                        var subtott = 0;
                        var subtotall = subtott + hargashipping;
                        var subtotal = (subtotall).toFixed(2);
                        //   $('#atassubtotal').html(subtotal);
                        $('#atpriceid').val(priceidd);
                        $('#atshipping').val(radioValuee);
                        $('#hargashipping').val(radioValuee);
                        $('#layananship').val(layananship);
                        $('#priceid').val(priceidd);
                        $('#shipping').html(hargashipping.toFixed(2));
                        $('#subtotalfix').val(subtotal);
                        $('#subtotfix').html(subtotal);
                        $('#total').html(subtotal);
                        $('#totalfix').html(subtotal);

                    }
                    hargashipping
                });

            },
            error: function(error) {
                console.log(error.responseJSON.message);
            }

        });
    }

    function getAddressMember() {

        var id = (document.getElementById('shippingTo').value)
        var bodyFormData = new FormData();
        bodyFormData.append('id', id);
        axios({
                method: 'post',
                // url: `http://127.0.0.1:8000/api/getMemberAddressById`,
                //url: `https://project-supresso.suryoatmojo.id/api/getMemberAddressById`,
                url: 'api/getMemberAddressById',
                data: bodyFormData,
            })
            .then(response => {
                console.log(response.data)
                document.getElementById('rfullname').value = response.data[0].recepient;
                document.getElementById('remail').value = response.data[0].email;
                document.getElementById('rphone').value = response.data[0].phone;
                // document.getElementById('rstate').value = 3;
                $("#rstate").select2().val(response.data[0].country).trigger("change");
                document.getElementById('rprovince').value = response.data[0].province;
                document.getElementById('rcity').value = response.data[0].city;
                document.getElementById('rpostcode').value = response.data[0].post_code;
                document.getElementById('rAddress1').value = response.data[0].address1;
                document.getElementById('rAddress2').value = response.data[0].address2;
                getShipping(response.data[0].country);
                $('#recipientsName').collapse('hide');
                $('#recipientsButton').collapse('hide');
                // document.getElementById('rMessage').value = response.data[0].
            })
            .catch(error => {
                console.log('Error:' + error.message);
                document.getElementById('rfullname').value = '';
                document.getElementById('remail').value = '';
                document.getElementById('rphone').value = '';
                $("#rstate").select2().val("sg").trigger("change");
                document.getElementById('rprovince').value = '';
                document.getElementById('rcity').value = '';
                document.getElementById('rpostcode').value = '';
                document.getElementById('rAddress1').value = '';
                document.getElementById('rAddress2').value = '';
                getShipping('sg');
                $('#recipientsName').collapse('show');
                $('#recipientsButton').collapse('show');
            });



    }

    function my_functionCheck(val) {
        //  alert(val);
        var checkBox = document.getElementById("checkshipping");
        if (checkBox.checked == true) {
            document.getElementById('shipping').value = val;

            var discount = document.getElementById('discount').value
            var sbtl = document.querySelector('#atsubtotal'); //new
            var sbtel = sbtl.innerHTML;
            var fulltotal = parseFloat(sbtel) - parseFloat(discount) + parseFloat(val);

            document.getElementById('total').value = fulltotal.toFixed(2);
        } else {
            document.getElementById('shipping').value = 0;
            var discount = document.getElementById('discount').value
            var sbtl = document.querySelector('#atsubtotal'); //new
            var sbtel = sbtl.innerHTML;
            var fulltotal = parseFloat(sbtel) - parseFloat(discount)
            console.log("subtotal : " + sbtel)
            console.log("discount : " + discount)
            console.log("shipping : " + val)
            document.getElementById('total').value = fulltotal.toFixed(2);
        }

    }

    function my_function(val, shippingname, shippingid, kodenegara) {
        //  alert(val);
        document.getElementById('shipping').value = val;
        document.getElementById('shippingname').value = shippingname;
        document.getElementById('shippingid').value = shippingid;
        document.getElementById('kodecountry').value = kodenegara;
        console.log("test my function");
        // document.getElementById('kodenegara').value = kodenegara;
        var discount = document.getElementById('discount').value
        var sbtl = document.querySelector('#atsubtotal'); //new
        var sbtel = sbtl.innerHTML;
        var fulltotal = parseFloat(sbtel) - parseFloat(discount) + parseFloat(val);
        console.log("subtotal : " + sbtel)
        console.log("discount : " + discount)
        console.log("shipping : " + val)
        console.log("shipping name : " + shippingname)
        console.log("shipping id : " + shippingid)
        console.log("kodenegara/kodecountry : " + kodenegara)
        console.log("countrycode" + document.getElementById('kodecountry').value)
        document.getElementById('total').value = fulltotal.toFixed(2);
    }

    $(document).ready(function() {


        $('input:radio[name=flexRadioDefault]').change(function() {
            console.log("test");
        });


        $('input:radio[name=bedStatus]').change(function() {
            console.log("test");
        });


        $(".js-example-placeholder-single").select2({
            width: "100%",
            maximumSelectionLength: 2,
            placeholder: 'Select an option'

        });

        $('#btnRecipientsID').click(function() {
            $('#recipientsName').collapse('show');
            $('#recipientsButton').collapse('show');
        });

        // $('.js-example-placeholder-single').val().trigger('change');
        $('.js-example-placeholder-single').on('select2:select', function(e) {

            getShipping($(this).val());

        });


        $("input[type='radio']").click(function() {
            var radioValue = $("input[name='shipping']:checked").val();
            if (radioValue) {

                //   var myarr = radioValue.split("/");
                //   var radioValuee = myarr[0];
                //   var priceidd = myarr[1];
                //   var layananship = myarr[2];

                //   var hargashipping = parseFloat(radioValuee);
                //   //var subtott = parseFloat($('#atsubtotal').html());

                //   var subtotall = subtott + hargashipping;
                //   var subtotal = (subtotall).toFixed(2);
                //   //   $('#atassubtotal').html(subtotal);
                //   $('#atpriceid').val(priceidd);
                //   $('#atshipping').val(radioValuee);
                //   $('#hargashipping').val(radioValuee);
                //   $('#layananship').val(layananship);
                //   $('#priceid').val(priceidd);
                //   $('#shipping').html(hargashipping.toFixed(2));
                //   $('#subtotalfix').val(subtotal);
                //   $('#subtotfix').html(subtotal);
                //   $('#total').html(subtotal);
                //   $('#totalfix').html(subtotal);
            }
        });

        // $("input[name='cpayment']").click(function() {
        //     var radioValue = $("input[name='cpayment']:checked").val();
        //     if (radioValue == "paypal") {


        //         alert("ikie paypal");
        //         $('#paymentform').attr('action', '{{ route('paymentpaypal') }}');

        //     }

        //     if (radioValue == "stripe") {
        //         alert("ikie stripe")
        //         $('#paymentform').attr('action', '{{ route('paymentstripe') }}');


        //     }

        //     if (radioValue == "alipay") {
        //         alert("ikie alipay")

        //     }

        // });




        function Cloud() {
            $.ajax({
                url: 'https://developers.onemap.sg/commonapi/search?searchVal=' + $('#rpostcode')
                    .val() +
                    '&returnGeom=Y&getAddrDetails=Y&pageNum=1',
                success: function(result) {
                    //Set result to a variable for writing
                    var len = result.results.length
                    var i = 0
                    var dump = []
                    while (i < 1) {
                        dump.push(result.results[i].ADDRESS)
                        i++
                    }

                    console.log("ini di cloud");

                    var yangdidump = dump.join('')
                    var hasildump = yangdidump.split(" ").slice(0, -2).join(" ")
                    console.log(len, hasildump)
                    $('#rAddress1').val(hasildump)

                    //   var textboxalamatt = document.getElementById("alamat");
                    var textboxalamatt = document.getElementById("rAddress1");
                    console.log(textboxalamatt.value)
                    inputalamatt = textboxalamatt.value;

                    if (inputalamatt == '') {
                        $("#parsley-id-19").css("display", "");

                    } else {
                        $("#parsley-id-19").css("display", "none");
                    }



                }
            });
        }

        //setup before functions
        var typingTimer; //timer identifier
        var doneTypingInterval = 1000; //time in ms, 5 second for example
        var $input = $('#rpostcode');

        //on keyup, start the countdown
        $input.on('keyup', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown 
        $input.on('keydown', function() {
            clearTimeout(typingTimer);
        });

        $input.on('focusout', function() {
            var nemnegara = document.querySelector('#select2-rstate-container');
            var namanegara = nemnegara.title;
            if (namanegara == 'Singapore') {

                Cloud()
            }
        });

        //user is "finished typing," do something
        function doneTyping() {
            console.log('sudah type');
            //do something
            var nemnegara = document.querySelector('#select2-rstate-container');
            console.log(nemnegara);
            var namanegara = nemnegara.title;
            if (namanegara == 'Singapore') {

                Cloud()

            }
        }

    });
</script>

<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function createcheckouts() {
        var radioValue = $("input[name='cpayment']:checked").val();
        if (radioValue == "paypal") {
            // alert("ikie paypal");

            document.getElementById('amount').value = document.getElementById('total').value
            document.getElementById("pay").click();


            // $('#paymentform').attr('action', '{{ route('paymentpaypal') }}');
            //         alert("test payment  " + document.getElementById('total').value + " - " + document.getElementById('shipping').value + " - " + document.getElementById('shippingname').value);
            //         var PK_TEST = '{{ env('PUBLISHABLE_KEY') }}';
            //         alert(name);
            //         var bodyFormData = new FormData();
            //         bodyFormData.append('total', document.getElementById('total').value);
            //         bodyFormData.append('shipping', document.getElementById('shipping').value);
            //         bodyFormData.append('shippingname', document.getElementById('shippingname').value);
            //         axios({
            //                 method: 'post',
            //                 url: `http://127.0.0.1:8000/paypalcheckouts`,
            //                 data: bodyFormData,
            //             })
            //             .then(response => {
            //                 console.log(response.data);
            //                 //masukkan kode pk_test disini
            //                 // var stripe = Stripe(PK_TEST);
            //                 // stripe
            //                 //     .redirectToCheckout({
            //                 //         sessionId: response.data.sessionId,
            //                 //     })
            //                 //     .then(handleResult);
            //             })
            //             .catch(function(err) {
            //                 console.log(err);
            //             });
        }

        if (radioValue == "stripe") {
            // alert("ikie stripe")
            $('#loading').collapse('show');
            $('#paymentform').attr('action', '{{ route('paymentstripe') }}');
            //alert("test payment  " + document.getElementById('total').value + " - " + document.getElementById('shipping').value + " - " + document.getElementById('shippingname').value);
            var PK_TEST = '{{ env('PUBLISHABLE_KEY') }}';
            //alert(name);
            var bodyFormData = new FormData();
            bodyFormData.append('total', document.getElementById('total').value);
            bodyFormData.append('shipping', document.getElementById('shipping').value);
            bodyFormData.append('shippingid', document.getElementById('shippingid').value);
            bodyFormData.append('shippingname', document.getElementById('shippingname').value);
            bodyFormData.append('kodecountry', document.getElementById('kodecountry').value);
            axios({
                    method: 'post',
                    // url: `http://127.0.0.1:8000/stripecheckouts`,
                    // url: `https://project-supresso.suryoatmojo.id/stripecheckouts`,
                    url: 'stripecheckouts',
                    data: bodyFormData,
                })
                .then(response => {
                    console.log(response.data);
                    //masukkan kode pk_test disini
                    var stripe = Stripe(PK_TEST);
                    stripe
                        .redirectToCheckout({
                            sessionId: response.data.sessionId,
                        })
                        .then(handleResult);
                })
                .catch(function(err) {
                    console.log(err);
                });

        }

        if (radioValue == "alipay") {
            // alert("ikie alipay")

        }



    }

    function redirectTopayment() {
        var PK_TEST = '{{ env('PUBLISHABLE_KEY') }}';
        var stripe = Stripe(PK_TEST);
        stripe
            .redirectToCheckout({
                sessionId: response.data.sessionId,
            })
            .then(handleResult);
    }
</script>
