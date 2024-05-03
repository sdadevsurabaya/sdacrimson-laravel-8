@extends('ui/layout')

@section('konten')
<!-- section of cart -->
<section id="cartProduct">
   <div class="container">
      <div class="row">

         <div class="col-lg-7 col-xl mb-5 mb-lg-0" id="cartList">

            <div class="lh-sm mb-2">
               <strong class="gotham-bold  fs-2 fs-lg-3">Shopping Cart.</strong>
               <br>
               (A total of 4 pcs)
            </div>

            <div class="table-responsive">
               <table class="table-cart table table-borderless text-capitalize mb-xl-0" style="width: 695px;">
                  <thead>
                     <tr>
                        <th scope="col"></th>
                        <th scope="col" style="width: 125px;"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col" style="width: 105px;"></th>
                     </tr>
                  </thead>
                  <tbody>

                     <!-- cart item -->
                     <tr>
                        <th scope="row"><button class="btn border-0 btn-delete-cart p-0 lh-1 rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteCart">
                              <i class="bi bi-x-lg"></i>
                           </button></th>
                        <td><img src="ui/img/product/produk1.png" class="img-fluid" alt=""></td>
                        <td>
                           <p class="mb-0">
                              <strong>sumatra mandheling coffee capsules</strong>
                              <br>
                              200g
                           </p>
                           <div class="harga-produk mb-0">
                              <!-- <span class="harga-normal">S$ 7.50</span> -->
                              <span class="harga-promo d-flex align-items-center gap-2">
                                 <span class="harga-setelah-diskon">S$ 6.55</span>
                                 <span class="harga-awal small">S$ 7.50</span>
                              </span>
                           </div>
                        </td>
                        <td>
                           <form action="">
                              <div class="input-group mx-4">
                                 <button class="btn border-0 fs-5 p-0"><i class="bi bi-dash-circle"></i></button>
                                 <input type="text" class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold" value="1" min="1" max="100" style="max-width: 55px;">
                                 <button class="btn border-0 fs-5 p-0"><i class="bi bi-plus-circle"></i></button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <div class="harga-produk">
                              <div class="harga-normal fs-5 fw-bold text-end d-flex justify-content-between">
                                 <span>S$</span> <span>6.55</span>
                              </div>
                           </div>
                        </td>
                     </tr>

                     <!-- cart item -->
                     <tr>
                        <th scope="row"><button class="btn border-0 btn-delete-cart p-0 lh-1 rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteCart">
                              <i class="bi bi-x-lg"></i>
                           </button></th>
                        <td><img src="ui/img/product/produk1.png" class="img-fluid" alt=""></td>
                        <td>
                           <p class="mb-0">
                              <strong>sumatra mandheling coffee capsules</strong>
                              <br>
                              200g
                           </p>
                           <div class="harga-produk mb-0">
                              <!-- <span class="harga-normal">S$ 7.50</span> -->
                              <span class="harga-promo d-flex align-items-center gap-2">
                                 <span class="harga-setelah-diskon">S$ 6.55</span>
                                 <span class="harga-awal small">S$ 7.50</span>
                              </span>
                           </div>
                        </td>
                        <td>
                           <form action="">
                              <div class="input-group mx-4">
                                 <button class="btn border-0 fs-5 p-0"><i class="bi bi-dash-circle"></i></button>
                                 <input type="text" class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold" value="1" min="1" max="100" style="max-width: 55px;">
                                 <button class="btn border-0 fs-5 p-0"><i class="bi bi-plus-circle"></i></button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <div class="harga-produk">
                              <div class="harga-normal fs-5 fw-bold text-end d-flex justify-content-between">
                                 <span>S$</span> <span>6.55</span>
                              </div>
                           </div>
                        </td>
                     </tr>

                     <!-- cart item -->
                     <tr>
                        <th scope="row"><button class="btn border-0 btn-delete-cart p-0 lh-1 rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteCart">
                              <i class="bi bi-x-lg"></i>
                           </button></th>
                        <td><img src="ui/img/product/produk1.png" class="img-fluid" alt=""></td>
                        <td>
                           <p class="mb-0">
                              <strong>sumatra mandheling coffee capsules</strong>
                              <br>
                              200g
                           </p>
                           <div class="harga-produk mb-0">
                              <!-- <span class="harga-normal">S$ 7.50</span> -->
                              <span class="harga-promo d-flex align-items-center gap-2">
                                 <span class="harga-setelah-diskon">S$ 6.55</span>
                                 <span class="harga-awal small">S$ 7.50</span>
                              </span>
                           </div>
                        </td>
                        <td>
                           <form action="">
                              <div class="input-group mx-4">
                                 <button class="btn border-0 fs-5 p-0"><i class="bi bi-dash-circle"></i></button>
                                 <input type="text" class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold" value="1" min="1" max="100" style="max-width: 55px;">
                                 <button class="btn border-0 fs-5 p-0"><i class="bi bi-plus-circle"></i></button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <div class="harga-produk">
                              <div class="harga-normal fs-5 fw-bold text-end d-flex justify-content-between">
                                 <span>S$</span> <span>6.55</span>
                              </div>
                           </div>
                        </td>
                     </tr>

                     <!-- cart item (GIFT BOX = add/remove "d-none" on <tr> tag to hide/ show) -->
                     <tr class="item-giftbox">
                        <th scope="row"><button class="btn-close invisible opacity-0"></button></th>
                        <td><img src="ui/img/cart/giftbox.png" class="img-fluid" alt=""></td>
                        <td>
                           <p class="mb-0">
                              <strong>Supresso FREE gift box</strong>
                              <br>
                              120g
                           </p>
                        </td>
                        <td>
                           <form action="">
                              <div class="input-group mx-4">
                                 <button class="btn border-0 fs-5 p-0 disabled opacity-25" disabled><i class="bi bi-dash-circle"></i></button>
                                 <input type="text" class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold" value="1" min="1" max="1" style="max-width: 55px;" disabled>
                                 <button class="btn border-0 fs-5 p-0 disabled opacity-25" disabled><i class="bi bi-plus-circle"></i></button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <div class="harga-produk opacity-50">
                              <div class="harga-normal fs-5 fw-bold text-end d-flex justify-content-between">
                                 <span>S$</span> <span>0.00</span>
                              </div>
                           </div>
                        </td>
                     </tr>

                  </tbody>
               </table>
            </div>

         </div>

         <div class="col-lg sidepanel ms-lg-auto">
            <div class="rounded h-100" style="background-color: #f1f2f2;">
               <div class="container-fluid py-3 h-100">
                  <div class="row align-content-between h-100">

                     <div class="col-12">

                        <!-- info free gift -->
                        <div class="row align-items-center py-4">
                           <div class="col-4">
                              <img src="ui/img/cart/giftbox.png" class="img-fluid" alt="">
                           </div>
                           <div class="col-8">
                              <p class="fw-bold mb-2">Just add "$30.50" more to receive a FREE gift box this season of gifting!</p>
                              <a href="/coffee" class="text-inherit"><u>Continue Shopping <i class="bi bi-chevron-right"></i></u></a>
                           </div>
                        </div>

                        <hr>

                        <!-- subtotal -->
                        <div class="row mb-3">
                           <div class="col-7">Subtotal</div>
                           <div class="col-5 d-flex justify-content-between"><span>S$</span> <span>9.50</span></div>
                        </div>

                        <!-- vouchers -->
                        <div class="input-group align-items-center mb-2 bg-white rounded" id="triggerInputVouchers">
                           <input type="text" class="form-control border-0 text-center" placeholder="vouchers Code">
                           <button class="btn">
                              <i class="bi bi-x-circle"></i>
                           </button>
                        </div>
                        <!-- <button class="btn btn-secondary w-100 mb-3">Apply Vouchers</button> -->

                        <div class="alert alert-danger alert-dismissible fade show text-capitalize" role="alert">
                           <i class="bi bi-exclamation-triangle-fill"></i> required member registration to use this promo code. <a href="#" class="alert-link"><u>login to my account</u></a>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <!-- discount -->
                        <div class="row">
                           <div class="col-7">Vouchers</div>
                           <div class="col-5 d-flex justify-content-between"><span>S$</span> <span>9.50</span></div>
                        </div>

                        <hr class="opacity-50">

                        <!-- total -->
                        <div class="row fw-bold fs-5 mb-5">
                           <div class="col-7">Total</div>
                           <div class="col-5 d-flex justify-content-between"><span>S$</span> <span>9.50</span></div>
                        </div>

                     </div>

                     <div class="col-12">
                        <a href="/checkout" class="btn btn-lg btn-dark w-100">Checkout</a>
                     </div>

                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</section>

<!-- section of alternate product -->
<section>
   <div class="container">
      <h4 class="gotham-bold text-center">
         Before you checkout, consider to
      </h4>
   </div>
</section>

<section>
   <div class="container">
      <div id="sliderAlternateProduct" class="carousel carousel-dark slide carousel-product" data-bs-ride="carousel" data-bs-pause="false">
         <div class="carousel-inner">

            <!-- product item -->
            <!-- untuk produk out of stock add class 'out-stock' on 'card-product', add class 'd-none' on 'wobler' when prodcut didn't have discount, harga produk ada dua pilihan 'harga-normal' dan 'harga-promo' -->
            <div class="carousel-item row flex-nowrap gx-xxl-5 bg-white active">
               <div class="col-auto col-product">
                  <div class="card card-product border-0 rounded-0 text-center">
                     <div class="card-header position-relative p-0 rounded-0 border-0">
                        <a href="/detail-coffee" class="text-text-decoration-none">
                           <img src="ui/img/product/produk1.png" class="img-fluid">
                           <img src="ui/img/product/produk2.png" class="img-fluid">
                        </a>
                        <button class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
                           <i class="bi bi-cart-plus"></i>
                        </button>
                     </div>
                     <div class="card-body text-capitalize px-0 pb-0">
                        <div class="cart-title fw-bold lh-sm">sumatra mandheling coffee capsules</div>
                        <div class="cart-text my-1">200g</div>
                        <div class="harga-produk mb-0">
                           <!-- <span class="harga-normal">S$ 7.50</span> -->
                           <span class="harga-promo d-flex justify-content-center align-items-center gap-2">
                              <span class="harga-setelah-diskon">S$ 6.55</span>
                              <span class="harga-awal">S$ 7.50</span>
                           </span>
                        </div>
                     </div>
                     <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
                  </div>
               </div>
            </div>

            <div class="carousel-item row flex-nowrap gx-xxl-5 bg-white">
               <div class="col-auto col-product">
                  <div class="card card-product border-0 rounded-0 text-center">
                     <div class="card-header position-relative p-0 rounded-0 border-0">
                        <a href="/detail-coffee" class="text-text-decoration-none">
                           <img src="ui/img/product/produk1.png" class="img-fluid">
                           <img src="ui/img/product/produk2.png" class="img-fluid">
                        </a>
                        <button class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
                           <i class="bi bi-cart-plus"></i>
                        </button>
                     </div>
                     <div class="card-body text-capitalize px-0 pb-0">
                        <div class="cart-title fw-bold lh-sm">sumatra mandheling coffee capsules</div>
                        <div class="cart-text my-1">200g</div>
                        <div class="harga-produk mb-0">
                           <!-- <span class="harga-normal">S$ 7.50</span> -->
                           <span class="harga-promo d-flex justify-content-center align-items-center gap-2">
                              <span class="harga-setelah-diskon">S$ 6.55</span>
                              <span class="harga-awal">S$ 7.50</span>
                           </span>
                        </div>
                     </div>
                     <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
                  </div>
               </div>
            </div>

            <div class="carousel-item row flex-nowrap gx-xxl-5 bg-white">
               <div class="col-auto col-product">
                  <div class="card card-product border-0 rounded-0 text-center out-stock">
                     <div class="card-header position-relative p-0 rounded-0 border-0">
                        <a href="/detail-coffee" class="text-text-decoration-none">
                           <img src="ui/img/product/produk1.png" class="img-fluid">
                           <img src="ui/img/product/produk2.png" class="img-fluid">
                        </a>
                        <button class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
                           <i class="bi bi-cart-plus"></i>
                        </button>
                     </div>
                     <div class="card-body text-capitalize px-0 pb-0">
                        <div class="cart-title fw-bold lh-sm">sumatra mandheling coffee capsules</div>
                        <div class="cart-text my-1">200g</div>
                        <div class="harga-produk mb-0">
                           <!-- <span class="harga-normal">S$ 7.50</span> -->
                           <span class="harga-promo d-flex justify-content-center align-items-center gap-2">
                              <span class="harga-setelah-diskon">S$ 6.55</span>
                              <span class="harga-awal">S$ 7.50</span>
                           </span>
                        </div>
                     </div>
                     <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
                  </div>
               </div>
            </div>

         </div>

         <!-- carousel control/ navigator slider -->
         <div class="carousel-control d-none d-lg-block">
            <button class="carousel-control-prev justify-content-end align-items-start bg-white translate-middle-y py-4" type="button" data-bs-target="#sliderAlternateProduct" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" style="width: 40px; height: 40px;" aria-hidden="true"></span>
               <span class="visually-hidden">Preview</span>
            </button>
            <button class="carousel-control-next justify-content-end align-items-start bg-white translate-middle-y py-4" type="button" data-bs-target="#sliderAlternateProduct" data-bs-slide="next">
               <span class="carousel-control-next-icon" style="width: 40px; height: 40px;" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
            </button>
         </div>

      </div>
   </div>
</section>
@endsection

@section('popup')
<!-- konfirmasi delete product item in the cart list -->
<div class="modal fade modal-middle" id="deleteCart" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCartLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title opacity-25" id="deleteCartLabel">
               <i class="bi bi-exclamation-circle"></i>
               Delete Cart Item
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <h4 class="fw-bold mb-4">Are you sure wanna remove this product from your cart ?</h4>
               <div class="row">
                  <div class="col-md-8">
                     <div class="row align-items-center">
                        <div class="col-4 col-md-5">
                           <img src="ui/img/product/produk1.png" class="img-fluid rounded" style="background-color: #f1f2f2;" alt="">
                        </div>
                        <div class="col-8 col-md-7">
                           <div class="text-capitalize">
                              <strong>sumatra mandheling coffee capsules</strong>
                              <br>200g
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer flex-nowrap">
            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalMoveWhistlist">Move to Whistlist</button>
         </div>
      </div>
   </div>
</div>

<!-- success moved to whistlist/ delete cart item -->
<div class="modal fade modal-middle" id="modalMoveWhistlist" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalMoveWhistlistLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title opacity-25" id="modalMoveWhistlistLabel">
               <i class="bi bi-exclamation-circle"></i>
               Moved to Whistlist
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <div class="mb-4">
                  <div class="row">
                     <div class="col-auto">
                        <i class="bi bi-check-circle text-success fs-1"></i>
                     </div>
                     <div class="col">
                        <h4 class="fw-bold mb-0"> Succees remove product from your cart ?</h4>
                     </div>
                  </div>
               </div>
               <div class="row d-none">
                  <div class="col-md-8">
                     <div class="row align-items-center">
                        <div class="col-4 col-md-5">
                           <img src="ui/img/product/produk1.png" class="img-fluid rounded" style="background-color: #f1f2f2;" alt="">
                        </div>
                        <div class="col-8 col-md-7">
                           <div class="text-capitalize">
                              <strong>sumatra mandheling coffee capsules</strong>
                              <br>200g
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer flex-nowrap">
            <a href="#" class="btn btn-secondary w-100">Check Whistlist</a>
            <a href="/coffee" class="btn btn-primary w-100">Continue Shop</a>
         </div>
      </div>
   </div>
</div>

<!-- MODAL NIPUT VOUCHERS -->
<div class="modal fade modal-middle" id="modalInputVouchers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalInputVouchers" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header d-block border-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
               <h5 class="modal-title opacity-25">Claim Vouchers</h5>
               <div>
                  <small>Cancel</small>
                  <button class="btn-close" data-bs-dismiss="modal"></button>
               </div>
            </div>
            <div class="input-group">
               <input type="text" class="form-control text-center" placeholder="Type Vouchers Code or">
               <button class="btn btn-dark">Apply <span class="d-none d-sm-inline">Vouchers</span></button>
            </div>
            <p></p>
         </div>
         <div class="modal-body py-0">
            <form action="">

               <!-- vouchers item -->
               <div class="form-check ps-0 mb-2">
                  <input class="form-check-input d-none" type="radio" name="flexRadioDefault" id="vouchers1">
                  <label class="form-check-label w-100" for="vouchers1">
                     <div class="card">
                        <div class="card-body">
                           <p class="text-end mb-2"><small>23 Oct' 22 - 02 Nov' 22</small></p>
                           <h5 class="gotham-bold mb-0">Diskon 5% untuk member karyawan</h5>
                           <p class="mb-0">Min. transaksi Rp 500.000,-</p>
                        </div>
                     </div>
                  </label>
               </div>

               <!-- vouchers item -->
               <div class="form-check ps-0 mb-2">
                  <input class="form-check-input d-none" type="radio" name="flexRadioDefault" id="vouchers2">
                  <label class="form-check-label w-100" for="vouchers2">
                     <div class="card">
                        <div class="card-body">
                           <p class="text-end mb-2"><small>23 Oct' 22 - 02 Nov' 22</small></p>
                           <h5 class="gotham-bold mb-0">Diskon 5% untuk member karyawan</h5>
                           <p class="mb-0">Min. transaksi Rp 500.000,-</p>
                        </div>
                     </div>
                  </label>
               </div>

               <!-- vouchers item -->
               <div class="form-check ps-0 mb-2">
                  <input class="form-check-input d-none" type="radio" name="flexRadioDefault" id="vouchers3">
                  <label class="form-check-label w-100" for="vouchers3">
                     <div class="card">
                        <div class="card-body">
                           <p class="text-end mb-2"><small>23 Oct' 22 - 02 Nov' 22</small></p>
                           <h5 class="gotham-bold mb-0">Diskon 5% untuk member karyawan</h5>
                           <p class="mb-0">Min. transaksi Rp 500.000,-</p>
                        </div>
                     </div>
                  </label>
               </div>

            </form>
         </div>
         <div class="modal-footer border-0"></div>
      </div>
   </div>
</div>
@endsection