@extends('front/layout')

@section('konten')
<!-- BANNER -->
<section class="mb-0">
   <div class="jumbotron machines-banner w-100 overflow-hidden position-relative">
      <div class="bg-banner" style="display: flex; justify-content: space-between; align-items: flex-end; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(45deg); z-index: 1;">
         <p class="m-0" style="animation-delay: 5s; font-size: 0;"><img src="ui/img/kraton/mesin-atas.png" class="img-fluid"></p>
         <p class="m-0" style="font-size: 0;"><img src="ui/img/kraton/mesin-telentang.png" class="img-fluid"></p>
         <p class="m-0" style="animation-delay: 10s; font-size: 0;"><img src="ui/img/kraton/mesin-atas.png" class="img-fluid"></p>
      </div>
      <div class="container h-100">
         <div class="row h-100 align-items-center">
            <div class="col text-lg-start">
               <h1 class="display-1 display-lg-4 gotham-bold">
                  Welcome to
                  <br>
                  KRATON
               </h1>
               <a href="/detailmesin" class="btn btn-primary px-4">BUY <i class="bi bi-chevron-end"></i></a>
            </div>
         </div>
      </div>
   </div>
</section>
<style>
   .bg-banner {
      width: 150vw;
      height: 85vh;
   }

   .bg-banner p img {
      transform: scale(.75);
   }

   .bg-banner p {
      animation-name: mesin;
      animation-duration: 15s;
      animation-iteration-count: infinite;
      opacity: 0;
   }

   @keyframes mesin {
      0% {
         transform: translateY(0);
      }

      25% {
         opacity: .35;
      }

      75% {
         opacity: .35;
      }

      100% {
         transform: translateY(-1440px);
         opacity: 0;
      }
   }

   @media(min-width: 992px) {
      section.banner {
         height: 720px;
         padding-top: 148px;
      }

      .bg-banner {
         width: calc(992px + 10vw);
         max-width: 1200px;
         height: 720px;
      }
   }
</style>

<section>
   <div class="container">
      <div class="row align-items-xl-center justify-content-xl-around">
         <div class="col-xl-auto">
            <h1 class="gotham-bold mb-5 mb-xl-0" style="font-size: 2.5rem!important;">
               <span>How KRATON works for your </span>
               <span class="position-relative" style="overflow: hidden; height: 48px; color: #999; display: inline-grid;">
                  <span style="opacity: 0; height: 48px;">kosong</span>
                  <span class="position-absolute text-slide text-lg-start" style="top: 0; left: 0;">
                     kitchen
                     <br>
                     home
                     <br>
                     office
                  </span>
               </span>
            </h1>
         </div>
         <div class="col-xl-auto">
            <img src="ui/img/kraton/mesin-atas.png" class="img-fluid" width="175" alt="">
         </div>
      </div>
   </div>
</section>
<style type="text/css">
   .text-slide {
      opacity: 0;
      animation: textSlide 7.5s linear infinite;
   }

   @keyframes textSlide {
      0% {
         margin-top: -144px;
      }

      3% {
         margin-top: -96px;
         opacity: 1;
      }

      33% {
         margin-top: -96px;
      }

      36% {
         margin-top: -48px;
      }

      66% {
         margin-top: -48px;
      }

      69% {
         margin-top: 0px;
      }

      99% {
         opacity: 1;
      }

      100% {
         margin-top: 0px;
         opacity: 0;
      }
   }

   .daftar-ikon li {
      max-width: 45%;
      flex-basis: 45%;
   }

   @media (min-width: 768px) {
      .daftar-ikon li {
         max-width: 20%;
         flex-basis: 20%;
      }
   }

   @media (min-width: 992px) {
      .daftar-ikon li {
         max-width: 175px;
         flex-basis: 175px;
      }
   }
</style>

<section>
   <div class="container">
      <h1 class="gotham-bold display-4 display-lg-6 mb-5">New Normal, New Changes.</h1>
      <img src="ui/img/kraton/mesin_miring.png" class="img-fluid mb-5" alt="">
      <div class="row row-cols-2 row-cols-md-4 ikon-list mx-auto" style="max-width: 720px;">
         <div class="col">
            <img src="ui/img/kraton/ikon_jam.svg" class="img-fluid mb-3" alt="">
            <p>Heats up within 25 secs</p>
         </div>
         <div class="col">
            <img src="ui/img/kraton/ikon_petir.svg" class="img-fluid mb-3" alt="">
            <p>Power saving mode after 10 mins</p>
         </div>
         <div class="col">
            <img src="ui/img/kraton/ikon_compact.svg" class="img-fluid mb-3" alt="">
            <p>Compact and simple</p>
         </div>
         <div class="col">
            <img src="ui/img/kraton/ikon_20bar.svg" class="img-fluid mb-3" alt="">
            <p>Pressure</p>
         </div>
      </div>
   </div>
</section>

<section class="bg-white">
   <div class="container py-5">
      <div class="row align-items-lg-center justify-content-xxl-between">
         <div class="col-lg-6 col-xxl-5 mb-5 mb-lg-0">
            <img src="ui/img/kraton/foto-mesin.png" class="img-fluid" alt="">
         </div>
         <div class="col-lg-6 text-lg-start">
            <h1 class="gotham-bold mb-4">Specification</h1>
            <p class="mb-2">
               Dimensions :
            </p>
            <p class="mb-4">
               <span class="mx-3">
                  <img src="ui/img/kraton/width-box.svg" class="img-fluid me-2" width="30" alt="">
                  102mm
               </span>
               <span class="mx-3">
                  <img src="ui/img/kraton/length-box.svg" class="img-fluid me-2" width="30" alt="">
                  337mm
               </span>
               <span class="mx-3">
                  <img src="ui/img/kraton/height-box.svg" class="img-fluid me-2" width="30" alt="">
                  220mm
               </span>
            </p>
            <p class="mb-2">
               Weight : 2.6kg
            </p>
            <p class="mb-0">
               Water container capacity : 550ml
            </p>
         </div>
      </div>
   </div>
</section>

<section>
   <div class="container px-0 px-md-3">
      <div class="row mb-5 g-0" style="mix-blend-mode: darken;">
         <div class="col-md-6">
            <img src="ui/img/kraton/barista-top.jpg" class="img-fluid w-100" alt="">
         </div>
         <div class="col-md-6">
            <img src="ui/img/kraton/barista-bottom.jpg" class="img-fluid w-100" alt="">
         </div>
      </div>
   </div>
</section>

<section>
   <div class="container">
      <h1 class="gotham-bold display-4 display-lg-6 mb-5">Register Your Machines</h1>
      <a href="#" class="btn btn-primary">
         Register Now <i class="bi bi-chevron-right"></i>
      </a>
   </div>
</section>

<section>
   <div class="container">
      <h4 class="gotham-bold mb-5 text-lg-start">Related Product</h4>
      <div id="sliderAlternateProduct" class="carousel carousel-dark slide carousel-product" data-bs-ride="carousel" data-bs-pause="false">
         <div class="carousel-inner">

            <!-- product item -->
            <!-- untuk produk out of stock add class 'out-stock' on 'card-product', add class 'd-none' on 'wobler' when prodcut didn't have discount, harga produk ada dua pilihan 'harga-normal' dan 'harga-promo' -->
            <div class="carousel-item row flex-nowrap gx-xxl-5 active">
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

            <div class="carousel-item row flex-nowrap gx-xxl-5">
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

            <div class="carousel-item row flex-nowrap gx-xxl-5">
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