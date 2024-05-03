@extends('ui/layout')

@section('konten')
<section>
   <div class="container">

      <div class="mb-5">
         <div class="position-relative clearfix">
            <img src="ui/img/membership/banner.jpg" class="img-fluid float-end w-75 rounded" alt="" style="max-width: 860px;">
            <div class="position-absolute" style="left: 0; bottom: 0;">
               <h2 class="display-4 gotham-bold mb-0">Hello.</h2>
               <h5 style="font-size: calc(1em + 1.75vw)!important;">Our loyalty program is
                  here!.</h5>
            </div>
         </div>
         <h1 class="display-1 gotham-bold" style="font-size: calc(1.75em + 6vw) !important;">
            Membership
         </h1>
      </div>

      <div id="benefit">
         <div class="container-fluid">
            <h3 class="benefit-title">
               <strong class="gotham-bold">OUR</strong> <span class="gotham-thin">BENEFITS</span>
            </h3>
            <div class="row row-cols-1 row-cols-md-2">
               <!-- ROBUSTA -->
               <div class="col mb-5 mb-md-0">
                  <div class="card shadow">
                     <div class="card-header border-0">
                        <div class="header-title">
                           <h1 class="gotham-bold">Robusta</h1>
                           <a href="#" class="btn btn-outline-dark">
                              Join Now
                           </a>
                        </div>
                        <img src="ui/img/membership/robusta_medal.svg" class="img-fluid img-medal" width="15%" alt="">
                     </div>
                     <div class="card-body p-xl-5">
                        <ul class="list-group list-group-flush"">
                                 <li class=" list-group-item px-0">
                           <div class="media d-flex">
                              <span class="bi bi-circle-fill"></span>
                              <div class="media-body">
                                 Free sign-up for all.
                              </div>
                           </div>
                           </li>
                           <li class="list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Anyone can join.
                                 </div>
                              </div>
                           </li>
                           <li class="list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Collect Beans.
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <!-- ARABICA -->
               <div class="col">
                  <div class="card shadow">
                     <div class="card-header border-0">
                        <div class="header-title">
                           <h1 class="gotham-bold">Arabica</h1>
                        </div>
                        <img src="ui/img/membership/arabica_medal.svg" class="img-fluid img-medal" width="15%" alt="">
                     </div>
                     <div class="card-body p-xl-5">
                        <ul class="list-group list-group-flush">
                           <li class=" list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Spend a minimum of S$300 within six months to progress to Arabica.
                                 </div>
                              </div>
                           </li>
                           <li class="list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Maintain a minimum spend of S$300 within six months.
                                 </div>
                              </div>
                           </li>
                           <li class="list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Collect Beans.
                                 </div>
                              </div>
                           </li>
                           <li class="list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Access to birthday treats.
                                 </div>
                              </div>
                           </li>
                           <li class="list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Exclusive discount campaigns.
                                 </div>
                              </div>
                           </li>
                           <li class="list-group-item px-0">
                              <div class="media d-flex">
                                 <span class="bi bi-circle-fill"></span>
                                 <div class="media-body">
                                    Free local delivery with minimum spending of S$100 in a single receipt.
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
</section>

<section>
   <div class="container">
      <hr class="border-dark">
   </div>
</section>

<section>
   <div class="container">
      <div class="row align-items-md-stretch">

         <div class="col-lg-6 mb-5">
            <div class="kolom-layer rounded border shadow">
               <div class="container-fluid py-5 p-xl-5">
                  <h3 class="mb-5">
                     <strong class="gotham-bold">STEPS</strong> <span class="gotham-thin">TO JOIN</span>
                  </h3>
                  <ul class="list-unstyled">
                     <li class="media d-flex">
                        <div class="media-title">1</div>
                        <div class="media-body">
                           <h3 class="gotham-bold lh-1">Registration</h3>
                           <p class="text-break">
                              Visit our website and simply sign up to the membership program:
                              <a href="#">https://www.supresso.com/sg/register/</a>
                           </p>
                        </div>
                     </li>
                     <li class="media d-flex">
                        <div class="media-title">2</div>
                        <div class="media-body">
                           <h3 class="gotham-bold lh-1">Login</h3>
                           <p class="text-break">
                              Once the registration is complete, login to access our full features.
                           </p>
                        </div>
                     </li>
                     <li class="media d-flex">
                        <div class="media-title">3</div>
                        <div class="media-body">
                           <h3 class="gotham-bold lh-1">Start Earning Beans</h3>
                           <p class="text-break mb-0">
                              As a member, you can start earning beans through our website or store. Please refer
                              to our FAQ for more details.
                              <br><br>
                              To check your membership status, please visit: <a href="#">www.supresso.com/sg/membership.</a>
                           </p>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>

         <div class="col-lg-6 mb-5">
            <div class="kolom-layer rounded border shadow">
               <div class="container-fluid py-5 p-xl-5">
                  <h3 class="mb-5">
                     <strong class="gotham-bold">HOW TO COLLECT</strong> <span class="gotham-thin">BEANS</span>
                  </h3>
                  <ul class="list-unstyled">
                     <li class="media d-flex">
                        <div class="media-title">1</div>
                        <div class="media-body">
                           <h3 class="gotham-bold lh-1">Purchase Products</h3>
                           <p class="text-break">
                              Get your favourite coffee through Supresso website or store.
                           </p>
                        </div>
                     </li>
                     <li class="media d-flex">
                        <div class="media-title">2</div>
                        <div class="media-body">
                           <h3 class="gotham-bold lh-1">Collect Beans</h3>
                           <p class="text-break">
                              Get 1 Bean (point) for every S$1 spent. Collect more Beans to upgrade your
                              membership level.
                           </p>
                        </div>
                     </li>
                     <li class="media d-flex">
                        <div class="media-title">3</div>
                        <div class="media-body">
                           <h3 class="gotham-bold lh-1">Redeem Your Gift</h3>
                           <p class="text-break mb-0">
                              Claim your rewards for every collected beans with PRODUCTS | ACCESSORIES | VOUCHERS!
                           </p>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>

         <div class="col-12">
            <div class="row g-0 mx-lg-0">
               <div class="col">
                  <img src="ui/img/membership/images.jpg" class="img-fluid w-100" alt="">
               </div>
            </div>
         </div>

      </div>
   </div>
</section>

<section>
   <div class="container">
      <hr class="border-dark">
   </div>
</section>

<section>
   <div class="container">
      <h3 class="benefit-title mb-5">
         <strong class="gotham-bold">FAQ</strong> <span class="gotham-thin">FREQUENTLY ASKED QUESTIONS</span>
      </h3>
      <h5><strong>OUR STORES</strong></h5>
      <hr>
      <ul class="list-unstyled mb-0">
         <li class="mb-4">
            <h6><u>WHAT IS SUPRESSO LOYALTY PROGRAM?</u></h6>
            <p class="ps-4 ps-xl-5">
               Supresso Membership is a loyalty program that rewards our customers with exciting benefits, perks
               and privileges.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>DO I HAVE TO PAY FOR A MEMBERSHIP?</u></h6>
            <p class="ps-4 ps-xl-5">
               No. You can join our membership for FREE.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>WHERE TO CHECK MY MEMBERSHIP DETAILS?</u></h6>
            <p class="ps-4 ps-xl-5">
               You can check your membership status including which level you are in, benefits, spending
               milestones, and ways to upgrade your level through your membership page here.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>HOW DO I GET TO THE NEXT LEVEL?</u></h6>
            <p class="ps-4 ps-xl-5">
               Once you are a registered member, you are on ROBUSTA membership level. To get to the next level
               which is ARABICA, you need to spend at least S$300 on our products within 6 month.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>WILL MY MEMBERSHIP EXPIRE?</u></h6>
            <p class="ps-4 ps-xl-5">
               No. There’s no expiry date for your membership. Each new account has 6 months to reach the S$300
               requirement to upgrade to the next level. And upon reaching that upgrade, you have another 6 months
               to maintain your benefits of that level.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>HOW DO I ACCUMULATE BEANS?</u></h6>
            <p class="ps-4 ps-xl-5">
               Spend S$1 to earn 1 Bean.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>WILL I ACCUMULATE BEANS DURING PROMOTION?</u></h6>
            <p class="ps-4 ps-xl-5">
               Of course you will. The amount of Beans earned depends on the amount of your total spending and
               accumulated based on your current level. For example: If the regular price is S$10 and it’s in a
               10% OFF promo, you will pay S$9 only. Thus, you will receive 9 Beans.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>HOW WILL I GET INFORMATION ABOUT PROMOTION?</u></h6>
            <p class="ps-4 ps-xl-5">
               As a member, you will always receive a heads-up about current or future promotions or programs.
               Brief info about any promotion program will be sent to your email while a complete guide will be
               published on the website.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>DOES THIS LOYALTY PROGRAM INCLUDE ALL OUTLETS?</u></h6>
            <p class="ps-4 ps-xl-5">
               Currently our Loyalty Program is available only for Supresso Gallery in Singapore.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>CAN MEMBERSHIP BE TRANSFERRED TO SOMEONE ELSE?</u></h6>
            <p class="ps-4 ps-xl-5">
               No. Each member’s account is unique. You cannot transfer your membership status and benefits to
               someone else, including your parents, spouse, kids or friends.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>WHAT IF I FORGET MY PASSWORD?</u></h6>
            <p class="ps-4 ps-xl-5">
               You can always request a password reset and input a new one through the “Forgot Password” page
               here. A password-reset how-to will be then sent to your email. REMEMBER: never reveal your password
               to any other person. Supresso staff will never ask for your password or any other login details.
            </p>
         </li>
         <li class="mb-4">
            <h6><u>WHO DO I CONTACT FOR TECHNICAL SUPPORT?</u></h6>
            <p class="ps-4 ps-xl-5">
               For any issue or problem, you can contact our Supresso team via email: sg@supresso.com.
            </p>
         </li>
      </ul>
   </div>
</section>
@endsection