@extends('front/layout')

@section('konten')
<script>
   document.getElementById("navcafe").classList.add("active");
</script>
<section>
   <div class="container-fluid container-lg mb-4">
      <div class="row align-items-md-center">
         <div class="col-md-6 text-md-start">
            <h1 class="gotham-bold mb-3">
               LOVE FOOD,
               <br>
               LIFE AND <span class="latin display-4" style="line-height: 0;">Refresh</span>
               <br>
               BALANCE
            </h1>
            <p class="mb-4 mb-md-0">
               Supresso Coffee Café adalah tempat yang sesuai bagi anda para pecinta kopi, dimana barista kami
               siap menyajikan kopi, minuman dan makanan yang sesuai dengan selera anda. Pelayanan kami dipadukan
               dengan suasana café yang tenang serta nyaman, untuk memastikan pengalaman anda di Supresso Coffee
               Café tidak terlupakan!
            </p>
         </div>
         <div class="col-md-6 px-0 px-lg-3">
            <div class="row g-0">
               <div class="col">
                  <div class="layer">
                     <img src="ui/img/cafe/header1.png" class="img-fluid end-0 shadow-lg" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-sulur">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row g-0">
            <div class="col">
               <img src="ui/img/cafe/header2.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/header3.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/header4.png" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- MANUAL BREW -->
<section>
   <div class="container-fluid container-lg px-0 px-lg-3">
      <div class="row g-0">
         <div class="col">
            <h1 class="d-flex align-items-center">
               <hr class="w-100 border-dark">
               <span class="gotham-bold mx-3">MANUAL</span>
               <span class="mx-3 display-2 latin lh-1">Brew</span>
               <hr class="w-100 border-dark">
            </h1>
            <img src="ui/img/cafe/brew1.gif" class="img-fluid w-100" alt="">
         </div>
      </div>
   </div>
   <div class="container">
      <nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
         <ol class="breadcrumb justify-content-center mb-5 text-uppercase">
            <li class="breadcrumb-item">
               <a href="#">aceh gayo</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">peaberry</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">sumatra mandheling</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">lampung</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">manglayang</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">west java</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">java</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">bali kintamani</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">flores bajawa</a>
            </li>
            <li class="breadcrumb-item">
               <a href="#">toraja kalosi</a>
            </li>
         </ol>
      </nav>
      <style>
         .breadcrumb li a {
            color: inherit;
         }
      </style>
      <p class="mb-5">
         Diseduh dengan hati dan teknik yang akurat, minuman Manual Brew dari Supresso menjanjikan pengalaman
         meminum kopi yangbaru bagi anda, dengan pilihan Single Origin Coffee by Supresso, masing-masing karakter
         kopi yang kami sajikan akan anda nikmati. Padukan Single Origin favorit mu dari Supresso dengan varian
         brewer yang kami sediakan: V60, Chemex, Syphon!
      </p>
   </div>
   <div class="bg-sulur">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row g-0">
            <div class="col">
               <img src="ui/img/cafe/brew2.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/brew3.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/brew4.png" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- COFFEE -->
<section>
   <div class="container-fluid container-lg mb-4">
      <div class="row align-items-center">
         <div class="col-md-6 text-md-start order-md-2">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <h1 class="d-flex align-items-center">
                     <hr class="w-100 border-dark d-md-none">
                     <span class="px-3 display-1 latin lh-1 ps-lg-0">Coffee</span>
                     <hr class="w-100 border-dark">
                  </h1>
               </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 text-uppercase mb-4">
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>americano</li>
                     <li>cappuccino</li>
                     <li>coffee latte</li>
                     <li>coffee mocha</li>
                     <li>caramel macchiato</li>
                     <li>delasia latte</li>
                  </ul>
               </div>
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>supresso nanyang</li>
                     <li>supresso chocolate</li>
                     <li>espresso</li>
                     <li>espresso macchiato</li>
                     <li>ristretto</li>
                  </ul>
               </div>
            </div>
            <p class="mb-4 mb-md-0">
               Nikmatnya kopi tentu tidak lepas dari biji kopi yang digunakan, rasakan nikmatnya Coffee drinks
               dari Supresso dengan Espresso terbuat dari Espresso Blend. Karakter kopi yang imbang antara
               kekentalan dan keasaman espresso yang kita buat, menjadi perpaduan yang sempurna untuk dibuat
               menjadi minuman Coffee drinks kami!
            </p>
         </div>
         <div class="col-md-6">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <div class="layer">
                     <img src="ui/img/cafe/coffee1.jpg" class="img-fluid start-0 shadow-lg" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-sulur">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row g-0">
            <div class="col">
               <img src="ui/img/cafe/coffee2.jpg" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/coffee3.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/coffee4.jpg" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- DRIP COFFEE -->
<section>
   <div class="container-fluid container-lg mb-4">
      <div class="row align-items-md-center">
         <div class="col-md-6 text-md-start">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <h1 class="d-flex align-items-center">
                     <hr class="w-100 border-dark d-md-none">
                     <span class="px-3 ps-lg-0 gotham-bold">DRIP</span>
                     <span class="mx-3 display-2 latin lh-1">Coffee</span>
                     <hr class="w-100 border-dark">
                  </h1>
               </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 text-uppercase mb-4">
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>brazilia blend</li>
                     <li>costa rica blend</li>
                     <li>nanyang</li>
                  </ul>
               </div>
            </div>
            <p class="mb-4 mb-md-0">
               Kemudahan dipertemukan dengan kenikmatan di Drip Coffee kami, nikmati seri world blend kami yang
               membawakan anda pengalaman yang berbeda, dengan proses penyeduhan melalui drip bag.
            </p>
         </div>
         <div class="col-md-6">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <div class="layer">
                     <img src="ui/img/cafe/drip1.png" class="img-fluid end-0 shadow-lg" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-sulur pb-5">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row g-0 shadow-lg">
            <div class="col">
               <img src="ui/img/cafe/drip2.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/drip3.png" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- FRAPPE -->
<section>
   <div class="container-fluid container-lg mb-4">
      <div class="row align-items-center">
         <div class="col-md-6 text-md-start order-md-2">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <h1 class="d-flex align-items-center">
                     <hr class="w-100 border-dark d-md-none">
                     <span class="px-3 display-1 latin lh-1 ps-lg-0">Frappe</span>
                     <hr class="w-100 border-dark">
                  </h1>
               </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 text-uppercase mb-4">
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>pinky</li>
                     <li>matcha</li>
                     <li>cookies crumble</li>
                     <li>chocochip</li>
                     <li>banana</li>
                  </ul>
               </div>
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>monster milo</li>
                     <li>monster supresso</li>
                     <li>coffee craumble</li>
                     <li>mocha</li>
                     <li>salted caramel</li>
                  </ul>
               </div>
            </div>
            <p class="mb-4 mb-md-0">
               Merupakan favorit semua kalangan, minuman blended dari Supresso di Frappe kami membawakan banyak
               pilihan bagi banyak selera, baik penikmat kopi maupun penikmat non-kopi dapat menikmati Frappe kami
               dengan pilihannya yang ada.
            </p>
         </div>
         <div class="col-md-6">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <div class="layer">
                     <img src="ui/img/cafe/frappe1.png" class="img-fluid start-0 shadow-lg" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-sulur">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row g-0">
            <div class="col">
               <img src="ui/img/cafe/frappe2.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/frappe3.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/frappe4.png" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- TEA -->
<section>
   <div class="container-fluid container-lg mb-4">
      <div class="row align-items-md-center">
         <div class="col-md-6 text-md-start">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <h1 class="d-flex align-items-center">
                     <hr class="w-100 border-dark d-md-none">
                     <span class="px-3 ps-lg-0 display-1 latin lh-1">Tea</span>
                     <hr class="w-100 border-dark">
                  </h1>
               </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 text-uppercase mb-4">
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>green tea latte</li>
                     <li>black tea latte</li>
                     <li>iced lychee tea</li>
                     <li>iced orange tea</li>
                  </ul>
               </div>
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>iced berry lemonade</li>
                     <li>iced green tea lemonade</li>
                     <li>iced straight tea</li>
                     <li>hot tea</li>
                  </ul>
               </div>
            </div>
            <p class="mb-4 mb-md-0">
               Teh tidak terlepas dari pengalaman anda di Supresso, nikmati racikan teh khusus yang dibuat menjadi
               berbagai macam minuman teh dari Supresso dan rasakan kesegarannya!
            </p>
         </div>
         <div class="col-md-6">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <div class="layer">
                     <img src="ui/img/cafe/tea1.png" class="img-fluid end-0 shadow-lg" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-sulur pb-5">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row g-0 shadow-lg">
            <div class="col">
               <img src="ui/img/cafe/tea2.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/tea3.png" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- SODA -->
<section>
   <div class="container-fluid container-lg mb-4">
      <div class="row align-items-center">
         <div class="col-md-6 text-md-start order-md-2">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <h1 class="d-flex align-items-center">
                     <hr class="w-100 border-dark d-md-none">
                     <span class="px-3 display-1 latin lh-1 ps-lg-0">Soda</span>
                     <hr class="w-100 border-dark">
                  </h1>
               </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 text-uppercase mb-4">
               <div class="col">
                  <ul class="list-unstyled m-0">
                     <li>strawberry soda</li>
                     <li>orange soda</li>
                     <li>coco pandan soda</li>
                     <li>lemon soda</li>
                  </ul>
               </div>
            </div>
            <p class="mb-4 mb-md-0">
               Supresso menyajikan jenis minuman bagi anda yang sedang ingin sesuatu yang manis, tapi beda!
               Soda
               di Supresso membawakan anda 4 macam rasa dari buah-buahan yang anda suka, mana yang kira-kira
               akan
               menjadi soda favorit kamu di Supresso?
            </p>
         </div>
         <div class="col-md-6">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <div class="layer">
                     <img src="ui/img/cafe/soda1.png" class="img-fluid start-0 shadow-lg" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-sulur">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row g-0">
            <div class="col">
               <img src="ui/img/cafe/soda2.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/soda3.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/soda4.png" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- FOOD -->
<section>
   <div class="container-fluid container-lg mb-4">
      <div class="row align-items-md-center">
         <div class="col-lg-7 text-md-start px-0 mb-4 mb-lg-0 px-0 px-lg-3">
            <h1 class="d-flex align-items-center">
               <hr class="w-100 border-dark d-lg-none">
               <span class="px-3 ps-lg-0 display-1 latin lh-1">Food</span>
               <hr class="w-100 border-dark">
            </h1>
            <div class="container">
               <div class="row row-cols-1 row-cols-md-2 text-uppercase">
                  <div class="col">
                     <ul class="list-unstyled m-0">
                        <li>gourmet breakfast</li>
                        <li>eggs benedict</li>
                        <li>mushroom omelette</li>
                        <li>tuna sandwich</li>
                        <li>supresso sandwich</li>
                        <li>banh mi</li>
                        <li>bacon and cheese sandwich</li>
                        <li>cheese and cheese fries</li>
                        <li>supresso sampler</li>
                        <li>seafood sampler</li>
                        <li>kaya toast</li>
                        <li>supresso pizza</li>
                        <li>margarita pizza</li>
                        <li>pepperoni pizza</li>
                        <li>supresso salad</li>
                     </ul>
                  </div>
                  <div class="col">
                     <ul class="list-unstyled m-0">
                        <li>fish n chips</li>
                        <li>supresso cordon bleu</li>
                        <li>pasta bolognese</li>
                        <li>pasta aglio olio</li>
                        <li>pasta aglio olio seafood</li>
                        <li>pasta carbonara</li>
                        <li>pasta all fungi</li>
                        <li>pasta new orleans</li>
                        <li>pasta japanese curry</li>
                        <li>pasta teriyaki</li>
                        <li>pasta vegetable</li>
                        <li>supresso fried rice</li>
                        <li>barbeque fried rice</li>
                        <li>suresso teriyaki bowl</li>
                        <li>crispy chicken thai mango sauce</li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-5">
            <div class="row">
               <div class="col px-0 px-lg-3">
                  <div class="layer">
                     <img src="ui/img/cafe/food1.png" class="img-fluid end-0 shadow-lg img-header-food" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="bg-sulur">
      <div class="container-fluid container-lg px-0 px-lg-3">
         <div class="row row-cols-3 g-0">
            <div class="col">
               <img src="ui/img/cafe/food2.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/food3.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/food4.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/food5.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/food6.png" alt="" class="img-fluid w-100">
            </div>
            <div class="col">
               <img src="ui/img/cafe/food7.png" alt="" class="img-fluid w-100">
            </div>
         </div>
      </div>
   </div>
</section>

<section>
   <div class="container mb-5">
      <h1 class="mb-5 latin display-1 lh-1">Stay In The Know</h1>
      <P class="mb-5">Sign up and get clued in on our great dining experiences, exclusive news and deals</P>
      <form action="" class="form-submit">
         <div class="d-md-flex mx-auto" style="max-width: 520px;">
            <input type="text" class="form-control mb-2 mb-md-0 mx-md-1" placeholder="Your Name">
            <input type="email" class="form-control mb-3 mb-md-0 mx-md-1" placeholder="Your Email">
            <a href="#" class="btn btn-dark mx-md-1">SUBMIT</a>
         </div>
      </form>
      <style>
         .form-submit input {
            border-radius: 0 !important;
            background-color: transparent !important;
            border-left-width: 0 !important;
            border-top-width: 0 !important;
            border-right-width: 0 !important;
            padding-left: 0;
            padding-right: 0;
         }
      </style>
   </div>
   <div class="bg-sulur">
      <div class="container-fluid container-lg">
         <div class="row">
            <div class="col px-0 px-lg-3">
               <img src="ui/img/cafe/footer.png" class="img-fluid w-100" alt="">
            </div>
         </div>
      </div>
   </div>
</section>

<section>
   <div class="container">
      <h1 class="latin display-1 lh-1">
         Explore our Instagram
      </h1>
      <a href="#" target="_blank" class="btn btn-lg btn-primary">
         <i class="bi bi-instagram me-2"></i> Follow Us
      </a>
   </div>
</section>
@endsection