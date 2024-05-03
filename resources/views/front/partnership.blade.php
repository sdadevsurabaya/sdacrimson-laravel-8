@extends('front/layout')

@section('konten')

<script>
   document.getElementById("navpartnership").classList.add("active");
</script>
<section>
   <div class="container-fluid container-lg">
      <div class="row g-0 mx-lg-0">
         <div class="col">
            <div class="jumbotron bg-dark rounded-0 mb-0" style="background-image: url(ui/img/partnerships/header.png); background-repeat: no-repeat; background-position: center; background-size: cover; padding: 6rem 2rem;">
               <h3 class="gotham-bold text-light text-md-start">
                  GROW YOUR BUSINESS
                  <br>
                  WITH EXCEPTIONAL
                  <br>
                  COFFEE
               </h3>
            </div>
            <div class="bg-sulur py-4 mb-5"></div>
         </div>
      </div>
   </div>
   <div class="container">
      <p class="text-md-start mb-0">
         At Supresso, we work hand-in-hand with everyone, from businesses to offices, to bulk orders for personal
         uses. Contact us to see how we can work together, and how we can create a package, suited just for you.
      </p>
   </div>
</section>

<!-- WHOLESALE -->
<section>
   <div class="container-fluid container-lg">
      <div class="row row-cols-1 row-cols-md-2 align-items-md-center">
         <div class="col pe-md-4 pe-lg-5 text-md-start">
            <h1 class="gotham-bold">WHOLESALE</h1>
            <h1 class="display-2 latin lh-1">Coffee</h1>
            <p class="mb-4 mb-md-0">
               From supplying coffee beans, to ground coffee and even coffee capsules and drip coffee, get all
               your coffee needs with
               us at Supresso.
            </p>
         </div>
         <div class="col">
            <div class="row g-0 mx-lg-0">
               <div class="col">
                  <div class="bg-sulur pe-5">
                     <img src="ui/img/partnerships/wholesale.png" class="img-fluid" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- CUSTOMISED PRODUCTS -->
<section>
   <div class="container-fluid container-lg">
      <div class="row row-cols-1 row-cols-md-2 align-items-md-center">
         <div class="col order-md-2 ps-md-4 ps-lg-5 text-md-start">
            <h1 class="gotham-bold">CUSTOMISED PRODUCTS</h1>
            <h1 class="display-2 latin lh-1">White Label Services</h1>
            <p class="mb-4 mb-md-0">
               Have you got a new idea for your next product? From designing the packaging, to customising every
               aspect of your product, get your brand, and your products up and running with us.
            </p>
         </div>
         <div class="col order-md-1">
            <div class="row g-0 mx-lg-0">
               <div class="col">
                  <div class="bg-sulur ps-5">
                     <img src="ui/img/partnerships/custom_product.png" class="img-fluid" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- MOBILE COFFE -->
<section>
   <div class="container-fluid container-lg">
      <div class="row row-cols-1 row-cols-md-2 align-items-md-center">
         <div class="col pe-md-4 pe-lg-5 text-md-start">
            <h1 class="gotham-bold">MOBILE COFFE</h1>
            <h1 class="display-2 latin lh-1">Services</h1>
            <p class="mb-4 mb-md-0">
               Anytime, anywhere! With our mobile coffee service, fresh coffee is just mere steps away for you and
               your guests at all your events!
            </p>
         </div>
         <div class="col">
            <div class="row g-0 mx-lg-0">
               <div class="col">
                  <div class="bg-sulur pe-5">
                     <img src="ui/img/partnerships/mobile_coffee.png" class="img-fluid" alt="">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<section>
   <div class="container-fluid container-lg">
      <div class="row g-0 mx-lg-0">
         <div class="col">
            <div class="jumbotron bg-dark rounded-0 text-light text-center mb-0" style="background-image: url(ui/img/partnerships/bg_machines.png); background-repeat: no-repeat; background-position: center; background-size: cover; padding: 5rem 1rem 15rem 1rem; filter: grayscale(1);">
               <h3 class="gotham-bold">
                  Need coffee and a machine? Or just coffee?
               </h3>
               <p>
                  Coffee Beans, Coffee Capsules, Drip Coffee and Ground Coffee
               </p>
            </div>
            <div class="bg-sulur py-4 mb-5"></div>
         </div>
      </div>
   </div>
   <div class="container">
      <p class="text-center mb-5">
         Let us know how we can work together, side-by-side! Fill in the form below and we will get back to you as
         soon as possible, or contact +6562502000 to inquire more about our services!
      </p>
      <form action="" class="text-start">
         <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
               <div class="form-group border-bottom">
                  <label class="mb-0" for="">Name*</label>
                  <input type="text" class="form-control bg-transparent border-0 px-0">
               </div>
            </div>
            <div class="col">
               <div class="form-group border-bottom">
                  <label class="mb-0" for="">Email*</label>
                  <input type="email" class="form-control bg-transparent border-0 px-0">
               </div>
            </div>
            <div class="col">
               <div class="form-group border-bottom">
                  <label class="mb-0" for="">Phone*</label>
                  <input type="text" class="form-control bg-transparent border-0 px-0">
               </div>
            </div>
            <div class="col">
               <div class="form-group border-bottom">
                  <label class="mb-0" for="">Company*</label>
                  <input type="text" class="form-control bg-transparent border-0 px-0">
               </div>
            </div>
            <div class="col">
               <div class="form-group border-bottom mb-4">
                  <label class="mb-0" for="">Message*</label>
                  <textarea name="" id="" cols="30" rows="5" class="form-control bg-transparent border-0 px-0"></textarea>
               </div>
               <a href="#" class="btn btn-primary">
                  Send Message <i class="bi bi-chevron-right"></i>
               </a>
            </div>
         </div>
      </form>
   </div>
</section>
@endsection