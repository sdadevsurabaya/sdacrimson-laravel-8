@extends('ui/layout')

@section('konten')
<section class="mb-5">
   <div class="container-fluid container-lg">
      <div class="row align-items-lg-center">
         <div class="col-lg-auto mb-5 order-lg-2 mb-lg-0">
            <div class="px-xl-5">
               <h5 class="gotham-bold">
                  Explore your variant
               </h5>
               <select name="" id="" class="custom-select w-auto rounded-0">
                  <option value="1" selected>Aceh</option>
                  <option value="2">Sumatra Mandheling</option>
                  <option value="3">Sumatra Mandheling Rainforest</option>
                  <option value="4">Lampung</option>
                  <option value="5">Peaberry</option>
                  <option value="6">Manglayang</option>
                  <option value="7">West Java</option>
                  <option value="8">Java</option>
                  <option value="9">Bali Kintamani</option>
                  <option value="10">Flores Bajawa</option>
                  <option value="11">Toraja Kalosi</option>
                  <option value="12">Papua</option>
               </select>
            </div>
         </div>
         <div class="col-lg order-lg-1 pe-0 pe-lg-3">
            <img src="ui/img/maps/aceh.svg" class="img-fluid w-100" alt="">
         </div>
      </div>
   </div>
</section>

<section class="mb-5">
   <div class="container product-specification">
      <div class="row justify-content-lg-between">
         <div class="col-lg-5">
            <h3 class="gotham-bold fs-1 fs-lg-3">Aceh Gayo</h3>
            <p class="variant-text">
               Aceh Gayo coffee is often used in most coffee shops commonly for cafe latte. It has light earthy
               notes with a mild body and bittersweet spicy chocolate taste. Soft in acidity, this coffee reveals
               some elegant caramel-fruity flavours, marrying a perfect combination of spicy and sweet. Its unique
               taste will make you crave for more.
            </p>
         </div>
         <div class="col-lg-5">
            <ul class="list-group list-group-flush text-capitalize font-weight-bold">
               <li class="list-group-item px-0 text-uppercase">
                  Spicy - Caramel & Chocolaty - Fruity - Slightly Earthy Notes
               </li>
               <li class="list-group-item px-0 text-md-left">
                  <div class="row">
                     <div class="col-md-6 mb-2 mb-md-0">
                        <p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p>
                        <img src="ui/img/bulat/bulat3-5.svg" alt="">
                     </div>
                     <div class="col-md-6">
                        <p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p>
                        <img src="ui/img/bulat/bulat3.svg" alt="">
                     </div>
                  </div>
               </li>
               <li class="list-group-item px-0 text-md-left">
                  <div class="row">
                     <div class="col-md-6 mb-2 mb-md-0">full city roast</div>
                     <div class="col-md-6">100% arabica coffee</div>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</section>
<style>
   .variant-text {
      text-align: justify;
      text-align-last: center;
   }

   @media (min-width: 992px) {
      .variant-text {
         text-align-last: left;
      }

      .product-specification .col-lg-5 {
         max-width: 460px;
         flex-basis: 460px;
      }
   }

   @media (min-width: 1200px) {
      .product-specification .col-lg-5 {
         max-width: 520px;
         flex-basis: 520px;
      }
   }
</style>

<section>
   <div class="container">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

         <!-- product item -->
         <!-- untuk produk out of stock add class 'out-stock' on 'card-product', add class 'd-none' on 'wobler' when prodcut didn't have discount, harga produk ada dua pilihan 'harga-normal' dan 'harga-promo' -->
         <div class="col col-product mb-4 mb-xxl-5">
            <div class="card card-product border-0 rounded-0 text-center">
               <div class="card-header position-relative p-0 rounded-0 border-0">
                  <a href="/detail-coffee" class="text-text-decoration-none">
                     <img src="ui/img/product/produk1.png" class="img-fluid">
                     <img src="ui/img/product/produk2.png" class="img-fluid">
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#modalAddtocart" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
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
               <button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
                  <i class="bi bi-bookmark-fill"></i>
               </button>
               <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
            </div>
         </div>

         <!-- product item -->
         <!-- contoh product out of stock -->
         <div class="col col-product mb-4 mb-xxl-5">
            <div class="card card-product border-0 rounded-0 text-center out-stock">
               <div class="card-header position-relative p-0 rounded-0 border-0">
                  <a href="/detail-coffee" class="text-text-decoration-none">
                     <img src="ui/img/product/produk1.png" class="img-fluid">
                     <img src="ui/img/product/produk2.png" class="img-fluid">
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#modalAddtocart" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
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
               <button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
                  <i class="bi bi-bookmark-fill"></i>
               </button>
               <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
            </div>
         </div>
         <!-- product item -->
         <!-- contoh product out of stock -->
         <div class="col col-product mb-4 mb-xxl-5">
            <div class="card card-product border-0 rounded-0 text-center out-stock">
               <div class="card-header position-relative p-0 rounded-0 border-0">
                  <a href="/detail-coffee" class="text-text-decoration-none">
                     <img src="ui/img/product/produk1.png" class="img-fluid">
                     <img src="ui/img/product/produk2.png" class="img-fluid">
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#modalAddtocart" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
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
               <button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
                  <i class="bi bi-bookmark-fill"></i>
               </button>
               <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
            </div>
         </div>
         <!-- product item -->
         <!-- contoh product out of stock -->
         <div class="col col-product mb-4 mb-xxl-5">
            <div class="card card-product border-0 rounded-0 text-center out-stock">
               <div class="card-header position-relative p-0 rounded-0 border-0">
                  <a href="/detail-coffee" class="text-text-decoration-none">
                     <img src="ui/img/product/produk1.png" class="img-fluid">
                     <img src="ui/img/product/produk2.png" class="img-fluid">
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#modalAddtocart" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
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
               <button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
                  <i class="bi bi-bookmark-fill"></i>
               </button>
               <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
            </div>
         </div>
         <!-- product item -->
         <!-- contoh product out of stock -->
         <div class="col col-product mb-4 mb-xxl-5">
            <div class="card card-product border-0 rounded-0 text-center out-stock">
               <div class="card-header position-relative p-0 rounded-0 border-0">
                  <a href="/detail-coffee" class="text-text-decoration-none">
                     <img src="ui/img/product/produk1.png" class="img-fluid">
                     <img src="ui/img/product/produk2.png" class="img-fluid">
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#modalAddtocart" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
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
               <button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
                  <i class="bi bi-bookmark-fill"></i>
               </button>
               <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
            </div>
         </div>
         <!-- product item -->
         <!-- contoh product out of stock -->
         <div class="col col-product mb-4 mb-xxl-5">
            <div class="card card-product border-0 rounded-0 text-center out-stock">
               <div class="card-header position-relative p-0 rounded-0 border-0">
                  <a href="/detail-coffee" class="text-text-decoration-none">
                     <img src="ui/img/product/produk1.png" class="img-fluid">
                     <img src="ui/img/product/produk2.png" class="img-fluid">
                  </a>
                  <button data-bs-toggle="modal" data-bs-target="#modalAddtocart" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
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
               <button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
                  <i class="bi bi-bookmark-fill"></i>
               </button>
               <div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>
            </div>
         </div>

      </div>
   </div>
</section>
@endsection