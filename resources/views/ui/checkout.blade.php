@extends('ui/layout')

@section('konten')
<!-- section of checkout -->
<section>
   <div class="container">
      <div class="row">

         <div class="col-lg-6 col-xxl-5">
            <h2 class="fs-2 fs-lg-3 mb-3"><strong class="gotham-bold">Checkout.</strong></h2>
            <h5 class="mb-5">
               Let us know more about you!
               <br>
               OR <a href="#" class="text-primary">Login with your account</a>
            </h5>

            <!-- form biodata penerima/ customer untuk yang belum login (jika sudah login ada value di input form untuk menampilkan informasi biodata penerima/ customer) -->
            <form action="" class="mb-5">
               <div class="form-floating mb-3 border-bottom">
                  <input type="name" class="form-control px-0 border-0 rounded-0" id="floatingInputFullName" placeholder="name@example.com">
                  <label class="px-0" for="floatingInputFullName">Full Name*</label>
               </div>
               <div class="form-floating mb-3 border-bottom">
                  <input type="email" class="form-control px-0 border-0 rounded-0" id="floatingInputEmail" placeholder="name@example.com">
                  <label class="px-0" for="floatingInputEmail">Email address*</label>
               </div>
               <div class="form-floating mb-4 border-bottom">
                  <input type="phone" class="form-control px-0 border-0 rounded-0" id="floatingInputPhone" placeholder="name@example.com">
                  <label class="px-0" for="floatingInputPhone">Phone Number*</label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="dropshipper">
                  <label class="form-check-label" for="dropshipper">
                     Send as dropshipper
                  </label>
               </div>
            </form>

            <h5 class="mb-5">
               Where would you like your item(s) to be sent?
            </h5>

            <!-- form alamat pengiriman/ shiping untuk yang belum login -->
            <form action="" class="mb-5">

               <div class="form-select2 mb-3 border-bottom">
                  <label class="px-0" for="floatingSelectShipper">Shipping to :</label>
                  <select class="form-select px-0 border-0 rounded-0" id="floatingSelectShipper" aria-label="Floating label select">
                     <option value="1" selected>Other Recipients</option>
                     <option value="2">My Home</option>
                     <option value="3">Office</option>
                  </select>
               </div>

               <!-- collapse user id recepients -->
               <span class="btn btn-light" id="btnRecipientsID">Open Collapse Recepients ID</span>
               <div class="collapse" id="recipientsName">
                  <div class="form-floating mb-3 border-bottom">
                     <input type="name" class="form-control px-0 border-0 rounded-0" id="floatingInputRecipientsName" placeholder="Home">
                     <label class="px-0" for="floatingInputRecipientsName">Recipients Id*</label>
                  </div>
               </div>
               <!-- end of collapse user id recepients -->

               <div class="form-floating mb-3 border-bottom">
                  <input type="name" class="form-control px-0 border-0 rounded-0" id="floatingInputFullName2" placeholder="Yoggi Pradhokot">
                  <label class="px-0" for="floatingInputFullName2">Full Name*</label>
               </div>
               <div class="form-floating mb-3 border-bottom">
                  <input type="email" class="form-control px-0 border-0 rounded-0" id="floatingInputEmail2" placeholder="name@example.com">
                  <label class="px-0" for="floatingInputEmail2">Email address*</label>
               </div>
               <div class="form-floating mb-4 border-bottom">
                  <input type="phone" class="form-control px-0 border-0 rounded-0" id="floatingInputPhone3" placeholder="+63 81 3333 226 10">
                  <label class="px-0" for="floatingInputPhone3">Phone Number*</label>
               </div>

               <div class="form-select2 mb-3 border-bottom">
                  <label class="px-0" for="floatingSelectCountry">Country*</label>
                  <select class="form-select px-0 border-0 rounded-0" id="floatingSelectCountry" aria-label="Floating label select">
                     <option selected>Indonesia</option>
                     <option value="2">Singapore</option>
                     <option value="3">Malaysia</option>
                  </select>
               </div>

               <div class="form-select2 mb-3 border-bottom">
                  <label class="px-0" for="floatingSelectProvince">Province*</label>
                  <select class="form-select px-0 border-0 rounded-0" id="floatingSelectProvince" aria-label="Floating label select">
                     <option value="1" selected>Jawa Timur</option>
                     <option value="2">Jawa Tengah</option>
                     <option value="3">Jawa Barat</option>
                  </select>
               </div>

               <div class="form-select2 mb-3 border-bottom">
                  <label class="px-0" for="floatingSelectCity">City*</label>
                  <select class="form-select px-0 border-0 rounded-0" id="floatingSelectCity" aria-label="Floating label select">
                     <option value="1" selected>Surabaya</option>
                     <option value="2">Sidoarjo</option>
                     <option value="3">Mojokerto</option>
                  </select>
               </div>

               <div class="form-floating mb-3 border-bottom">
                  <input type="text" class="form-control px-0 border-0 rounded-0" id="floatingTextZIP" placeholder="Post Code">
                  <label class="px-0" for="floatingTextZIP">Post Code*</label>
               </div>
               <div class="form-floating mb-3 border-bottom">
                  <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="floatingTextareaAddress1"></textarea>
                  <label class="px-0" for="floatingTextareaAddress1">Address 1*</label>
               </div>
               <div class="form-floating mb-3 border-bottom">
                  <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="floatingTextareaAddress2"></textarea>
                  <label class="px-0" for="floatingTextareaAddress2">Address 2 (Optioanal)</label>
               </div>
               <div class="form-floating mb-4 border-bottom">
                  <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="floatingTextareaMessage" style="height: 160px;"></textarea>
                  <label class="px-0" for="floatingTextareaMessage">Leave a message to seller (Optional)</label>
               </div>

               <div class="collapse" id="recipientsSave">
                  <button class="btn btn-light">Save New Recipients <i class="bi bi-save ml-2"></i></button>
               </div>

            </form>

         </div>

         <div class="col-lg sidepanel ms-lg-auto">

            <!-- panel with background -->
            <div class="rounded mb-5" style="background-color: #f1f2f2;">
               <div class="container-fluid p-3">

                  <!-- summary product from cart -->
                  <div>
                     <h4 class="gotham-bold fs-4 fs-lg-5 mb-3">Summary (2)</h4>

                     <!-- produk item -->
                     <div class="row align-items-center g-0 mb-3">
                        <div class="col-4">
                           <img src="ui/img/product/produk1.png" class="img-fluid bg-white rounded" alt="">
                        </div>
                        <div class="col-6 small ps-3">
                           <p class="mb-2 lh-sm text-capitalize">
                              <strong>sumatra mandheling coffee capsules</strong> 200g
                           </p>
                           <p class="fw-bold mb-2 lh-sm">QTY. 3</p>
                           <div class="harga-produk lh-sm">
                              <div class="harga-normal lh-sm">
                                 <span>S$</span> <span>6.55</span>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- produk item -->
                     <div class="row align-items-center g-0 mb-3">
                        <div class="col-4">
                           <img src="ui/img/product/produk1.png" class="img-fluid bg-white rounded" alt="">
                        </div>
                        <div class="col-6 small ps-3">
                           <p class="mb-2 lh-sm text-capitalize">
                              <strong>sumatra mandheling coffee capsules</strong> 200g
                           </p>
                           <p class="fw-bold mb-2 lh-sm">QTY. 3</p>
                           <div class="harga-produk lh-sm">
                              <div class="harga-normal lh-sm">
                                 <span>S$</span> <span>6.55</span>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- produk item (khusus GIFT BOX) -->
                     <div class="row align-items-center g-0 mb-3">
                        <div class="col-4">
                           <img src="ui/img/cart/freeGiftBox.png" class="img-fluid" alt="">
                        </div>
                        <div class="col-6 small ps-3">
                           <p class="mb-2 lh-sm text-capitalize">
                              <strong>Supresso FREE Gift Box</strong> 200g
                           </p>
                           <p class="fw-bold mb-2 lh-sm">QTY. 1</p>
                           <div class="harga-produk lh-sm">
                              <div class="harga-normal lh-sm">
                                 <span>S$</span> <span>0.00</span>
                              </div>
                           </div>
                        </div>
                     </div>

                     <p class="text-end"><a href="/cart" class="text-inherit">[EDIT CART]</a></p>
                  </div>

                  <hr class="opacity-100">

                  <!-- subtotal -->
                  <div class="row fw-bold mb-3">
                     <div class="col-7">Subtotal</div>
                     <div class="col-5 d-flex justify-content-between">
                        <span>S$</span>
                        <span>17.60</span>
                     </div>
                  </div>

                  <!-- diskon -->
                  <div class="row">
                     <div class="col-7">Discount</div>
                     <div class="col-5 d-flex justify-content-between">
                        <span>S$</span>
                        <span>3.60</span>
                     </div>
                  </div>

                  <hr>

                  <!-- shipping choice -->
                  <form action="">
                     <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="shippingDomestic" checked>
                        <label class="form-check-label ms-1" for="shippingDomestic">
                           <strong>Supresso Domestic</strong>
                           <br>
                           <small>
                              Estimated Shipping: 2 - 3 Working days
                              <br>
                              Price : $ 3.50
                           </small>
                        </label>
                     </div>
                     <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="shippingJNEReluler">
                        <label class="form-check-label ms-1" for="shippingJNEReluler">
                           <strong>JNE Reguler</strong>
                           <br>
                           <small>
                              Estimated Shipping: 2 - 3 Working days
                              <br>
                              Price : $ 3.50
                           </small>
                        </label>
                     </div>
                     <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="shippingJNEPremium">
                        <label class="form-check-label ms-1" for="shippingJNEPremium">
                           <strong>JNE Premium</strong>
                           <br>
                           <small>
                              Estimated Shipping: 2 - 3 Working days
                              <br>
                              Price : $ 3.50
                           </small>
                        </label>
                     </div>
                  </form>

                  <hr>

                  <!-- Shipping -->
                  <div class="row">
                     <div class="col-7">Shipping</div>
                     <div class="col-5 d-flex justify-content-between">
                        <span>S$</span>
                        <span>3.60</span>
                     </div>
                  </div>

                  <hr class="opacity-100">

                  <!-- Total -->
                  <div class="row fw-bold fs-5 my-3">
                     <div class="col-7">Total</div>
                     <div class="col-5 d-flex justify-content-between">
                        <span>S$</span>
                        <span>17.60</span>
                     </div>
                  </div>

               </div>
            </div>

            <!-- payment -->
            <h4 class="gotham-bold fs-4 fs-lg-5 mb-3">Payment Method</h4>

            <form action="" class="mb-4">
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="paypal">
                  <label class="form-check-label ms-1" for="paypal">Paypal</label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="creditCard" checked>
                  <label class="form-check-label ms-1" for="creditCard">Credit card/ ApplePay/ GooglePay</label>
               </div>
               <hr>
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="notifikasiNews" checked>
                  <label class="form-check-label" for="notifikasiNews">
                     I want the latest news, innovations and offers from Supresso
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="notifikasiTNC">
                  <label class="form-check-label" for="notifikasiTNC">
                     I accept Supresso <a href="#" target="_blank" class="text-primary"><u>Terms & Conditions</u></a>
                  </label>
               </div>
            </form>

            <button class="btn btn-lg btn-dark w-100">Proceed to Payment</button>

         </div>

      </div>
   </div>
</section>
@endsection

@section('popup')

@endsection