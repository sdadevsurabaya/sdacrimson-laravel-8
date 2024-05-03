@extends('ui/layout')

@section('konten')

<section>
   <div class="container">
      <div class="row justify-content-xl-between">
         <div class="col-lg-3 col-xl-auto">

            <header class="py-4 mb-4 mb-lg-5 d-none d-lg-block">
               <div class="fs-2 fs-lg-3"><strong class="gotham-bold">Welcome.</strong></div>
            </header>

            <div class="d-none d-lg-block">
               <hr class="opacity-50 m-0">
               <button id="btnUserDashboard" class="btn btn-user" data-bs-toggle="collapse" data-bs-target="#userDashboard">
                  <span class="me-3">dashboard</span>
               </button>
               <hr class="opacity-50 m-0">
               <button id="btnUserRedeem" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userRedeem">
                  <span class="me-3">redeem</span>
               </button>
               <hr class="opacity-50 m-0">
               <button id="btnUserAccount" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userAccount">
                  <span class="me-3">my account <span class="d-none d-xl-inline">information</span></span>
               </button>
               <hr class="opacity-50 m-0">
               <button id="btnUserOrders" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userOrders">
                  <span class="me-3">my orders</span>
               </button>
               <hr class="opacity-50 m-0">
               <button id="btnUserMachines" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userMachines">
                  <span class="me-3">my machines</span>
               </button>
               <hr class="opacity-50 m-0">
               <button id="btnUserLogout" class="btn btn-user collapsed">
                  <span class="me-3">logout</span>
               </button>
            </div>

         </div>
         <div class="col-lg-9">

            <!-- header dashboard -->
            <header class="collapse fade" id="headerUser">
               <div class="rounded-start text-capitalize mb-4 mb-lg-5" style="background-image: linear-gradient(to left, transparent, rgba(0,0,0,.1));">
                  <div class="container-fluid py-4 ps-lg-4">
                     <div class="row align-items-center">
                        <div class="col-lg-auto">
                           <div><strong class="text-uppercase gotham-bold display-4 fs-lg-3">yoggi</strong> <span>pradhokot</span></div>
                        </div>
                        <div class="col-auto">
                           <div><strong class="text-uppercase gotham-bold fs-3">arabica</strong> <span>membership</span></div>
                        </div>
                        <div class="col-auto">
                           <div><strong class="text-uppercase gotham-bold fs-3">97</strong> <span>beans</span></div>
                        </div>
                     </div>
                  </div>
               </div>
            </header>

            <!-- accordion user -->
            <div class="accordion" id="accordionUser">

               <hr class="opacity-50 m-0 d-lg-none">

               <!-- ====================================== USER DASHBOAR ====================================== -->
               <div class="accordion-item">
                  <div class="accordion-header d-lg-none">
                     <button id="btnUserDashboard" class="btn btn-user" data-bs-toggle="collapse" data-bs-target="#userDashboard">
                        <span class="me-3">dashboard</span> <i class="bi bi-chevron-down"></i>
                     </button>
                  </div>
                  <div id="userDashboard" class="accordion-collapse collapse fade show" data-bs-parent="#accordionUser">
                     <div class="accordion-body">

                        <img src="ui/img/user/user.jpg" width="88.85" height="88.85" class="img-thumbnail mx-auto d-block p-0 rounded-circle mb-4 mb-lg-5" alt="...">

                        <div class="position-relative mb-5">
                           <div class="progress">
                              <div class="progress-bar bg-secondary" role="progressbar" aria-label="Example with label" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">45%</div>
                           </div>
                           <p class="position-absolute start-0" style="top: 24px;">Robusta</p>
                           <p class="position-absolute end-0" style="top: 24px;">Arabica</p>
                        </div>

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
                                 <div class="rounded" style="background-image: linear-gradient(to left, rgba(0,0,0,.1), transparent);">
                                    <div class="container-fluid py-3">
                                       <div class="mb-3 opacity-0 invisible">Range Membership</div>
                                       <div><span class="text-uppercase fs-3">arabica</span> <span class="text-capitalize">memberships</span></div>
                                    </div>
                                 </div>
                              </a>
                           </div>
                           <div class="col-md-6">
                              <div class="rounded" style="background-image: linear-gradient(to left, rgba(0,0,0,.1), transparent);">
                                 <div class="container-fluid py-3">
                                    <div class="mb-3">
                                       <a data-bs-toggle="collapse" href="#userRedeemHistory" class="text-inherit btn-history-redeem"><u>History Redeem <i class="bi bi-chevron-right"></i></u></a>
                                    </div>
                                    <div><span class="text-uppercase fs-3">79</span> <span class="text-capitalize">beans</span></div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <h4 class="gotham-bold">Vouchers</h4>

                        <div class="table-responsive mb-5">
                           <div class="row flex-nowrap g-2">
                              <div class="col-auto">
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
                              </div>
                           </div>
                        </div>

                        <a href="#" class="text-inherit"><u>FAQ Memberships <i class="bi bi-chevron-right"></i></u></a>

                     </div>
                  </div>
               </div>

               <hr class="opacity-50 m-0 d-lg-none">

               <!-- ====================================== USER REDEEM ====================================== -->
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
                           <a data-bs-toggle="collapse" href="#userRedeemHistory" class="text-inherit btn-history-redeem"><u>Redeem History</u> <i class="bi bi-chevron-right"></i></a>
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
                                       <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i class="bi bi-x"></i></button>
                                       <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i class="bi bi-x"></i></button>
                                       <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i class="bi bi-x"></i></button>
                                       <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i class="bi bi-x"></i></button>
                                       <button class="btn btn-sm btn-light text-capitalize mb-1">beans terendah <i class="bi bi-x"></i></button>
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
                                          <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioPalingPopuler" checked>
                                          <label class="form-check-label ms-1" for="radioPalingPopuler">
                                             Paling Populer
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioTerendah">
                                          <label class="form-check-label ms-1" for="radioTerendah">
                                             Beans Terendah
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioTertinggi">
                                          <label class="form-check-label ms-1" for="radioTertinggi">
                                             Beans Tertinggi
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
                              <a class="nav-link" data-bs-toggle="pill" href="#pills-vouchers">vouchers</a>
                           </nav>
                        </div>

                        <!-- tab user redeem -->
                        <div class="tab-content" id="pills-tabUser">

                           <div class="tab-pane fade show active" id="pills-coffee" role="tabpanel" aria-labelledby="pills-coffee-tab" tabindex="0">
                              <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

                                 <div class="col">
                                    <div class="card card-product border-0 rounded-0 text-center mb-4">
                                       <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                                          <img src="ui/img/product/produk1.png" class="img-fluid">
                                       </div>
                                       <div class="card-body text-capitalize py-2 px-0">
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
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
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
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
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
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
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
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
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
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
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
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
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
                                          <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                                       </div>
                                    </div>
                                 </div>

                              </div>
                           </div>

                           <div class="tab-pane fade" id="pills-accessories" role="tabpanel" aria-labelledby="pills-accessories-tab" tabindex="0">
                              <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

                                 <div class="col">
                                    <div class="card card-product border-0 rounded-0 text-center mb-4">
                                       <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                                          <img src="ui/img/accessories.jpg" class="img-fluid">
                                       </div>
                                       <div class="card-body text-capitalize py-2 px-0">
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
                                          <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                                       </div>
                                    </div>
                                 </div>

                              </div>
                           </div>

                           <div class="tab-pane fade" id="pills-vouchers" role="tabpanel" aria-labelledby="pills-vouchers-tab" tabindex="0">
                              <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

                                 <div class="col">
                                    <div class="card card-product border-0 rounded-0 text-center mb-4">
                                       <div class="card-header position-relative p-0 border-0 rounded overflow-hidden">
                                          <img src="ui/img/vouchers.jpg" class="img-fluid">
                                       </div>
                                       <div class="card-body text-capitalize py-2 px-0">
                                          <div class="card-title lh-sm small mb-2"><span class="fw-bold">sumatra mandheling coffee capsules</span> 200g</div>
                                          <div class="card-text my-1 gotham-bold">10 beans</div>
                                          <div class="progress">
                                             <div class="progress-bar bg-secondary" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
                                          </div>
                                          <button class="btn btn-sm btn-primary w-100">REDEEM</button>
                                       </div>
                                    </div>
                                 </div>

                              </div>
                           </div>

                        </div>

                     </div>
                  </div>
               </div>

               <hr class="opacity-50 m-0 d-lg-none">

               <!-- ====================================== USER REDEEM HISTORY ====================================== -->
               <div class="accordion-item">
                  <div id="userRedeemHistory" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
                     <div class="accordion-body">

                        <div class="table-responsive mb-4">
                           <table class="table table-borderless table-hover text-capitalize mb-3" style="min-width: 560px;">
                              <thead class="border-bottom border-secondary">
                                 <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">transactions</th>
                                    <th scope="col" class="text-center">date</th>
                                    <th scope="col" class="text-center">poin</th>
                                    <th scope="col" class="text-center">redeem</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th scope="row">1.</th>
                                    <td>supresso sumatra mandheling coffee capsules</td>
                                    <td class="text-nowrap text-center">19/03/22</td>
                                    <td class="text-nowrap text-center">97 beans</td>
                                    <td class="text-nowrap text-center">3 beans</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">2.</th>
                                    <td>supresso sumatra mandheling coffee capsules</td>
                                    <td class="text-nowrap text-center">19/03/22</td>
                                    <td class="text-nowrap text-center">97 beans</td>
                                    <td class="text-nowrap text-center">3 beans</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">3.</th>
                                    <td>supresso sumatra mandheling coffee capsules</td>
                                    <td class="text-nowrap text-center">19/03/22</td>
                                    <td class="text-nowrap text-center">97 beans</td>
                                    <td class="text-nowrap text-center">3 beans</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>

                     </div>
                  </div>
               </div>

               <hr class="opacity-50 m-0 d-lg-none">

               <!-- ====================================== USER ACCOUNT INFORMATION ====================================== -->
               <div class="accordion-item">
                  <div class="accordion-header d-lg-none">
                     <button id="btnUserAccount" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userAccount">
                        <span class="me-3">my account information</span> <i class="bi bi-chevron-down"></i>
                     </button>
                  </div>
                  <div id="userAccount" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
                     <div class="accordion-body">

                        <div class="row">
                           <div class="col-12 mb-5">
                              <div class="row">
                                 <div class="col-lg-6">

                                    <div class="form-floating border-bottom mb-3">
                                       <input type="text" class="form-control border-0 px-0 text-uppercase" id="userName" placeholder="First Name" value="yoggi">
                                       <label for="userName" class="px-0">First Name*</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                       <input type="text" class="form-control border-0 px-0 text-uppercase" id="userLastname" placeholder="Last Name" value="pradhokot">
                                       <label for="userLastname" class="px-0">Last Name*</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                       <input type="text" class="form-control border-0 px-0 text-uppercase" id="userBirth" placeholder="Date of Birth">
                                       <label for="userBirth" class="px-0">Date of Birth</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                       <input type="text" class="form-control border-0 px-0 text-uppercase" id="userCompany" placeholder="Company">
                                       <label for="userCompany" class="px-0">Company</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                       <input type="email" class="form-control border-0 px-0 text-lowercase" id="userEmail" placeholder="Email" value="yoggi.supresso@gmail.com">
                                       <label for="userEmail" class="px-0">Email*</label>
                                    </div>

                                    <div class="form-floating border-bottom mb-3">
                                       <input type="text" class="form-control border-0 px-0 text-uppercase" id="userPhone" placeholder="Phone Number">
                                       <label for="userPhone" class="px-0">Phone Number*</label>
                                    </div>

                                 </div>
                                 <div class="col-lg-6">

                                    <div class="form-select2 mb-3 border-bottom">
                                       <label class="px-0" for="userSelectCountry">Country*</label>
                                       <select class="form-select px-0 border-0 rounded-0" id="userSelectCountry" aria-label="Floating label select">
                                          <option selected>Indonesia</option>
                                          <option value="2">Singapore</option>
                                          <option value="3">Malaysia</option>
                                       </select>
                                    </div>

                                    <div class="form-select2 mb-3 border-bottom">
                                       <label class="px-0" for="userSelectProvince">Province*</label>
                                       <select class="form-select px-0 border-0 rounded-0" id="userSelectProvince" aria-label="Floating label select">
                                          <option value="1" selected>Jawa Timur</option>
                                          <option value="2">Jawa Tengah</option>
                                          <option value="3">Jawa Barat</option>
                                       </select>
                                    </div>

                                    <div class="form-select2 mb-3 border-bottom">
                                       <label class="px-0" for="userSelectCity">City*</label>
                                       <select class="form-select px-0 border-0 rounded-0" id="userSelectCity" aria-label="Floating label select">
                                          <option value="1" selected>Surabaya</option>
                                          <option value="2">Sidoarjo</option>
                                          <option value="3">Mojokerto</option>
                                       </select>
                                    </div>

                                    <div class="form-floating mb-3 border-bottom">
                                       <input type="text" class="form-control px-0 border-0 rounded-0" id="userTextZIP" placeholder="Post Code">
                                       <label class="px-0" for="userTextZIP">Post Code*</label>
                                    </div>

                                    <div class="form-floating mb-3 border-bottom">
                                       <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="userTextareaAddress1"></textarea>
                                       <label class="px-0" for="userTextareaAddress1">Address 1*</label>
                                    </div>

                                    <div class="form-floating mb-3 border-bottom">
                                       <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="userTextareaAddress2"></textarea>
                                       <label class="px-0" for="userTextareaAddress2">Address 2 (Optioanal)</label>
                                    </div>

                                 </div>
                              </div>
                           </div>
                           <div class="col-12 mb-2">
                              <button class="btn btn-primary me-3" style="min-width: 250px;">Update Account</button>
                              <a href="#" class="text-dark"><u>Reset</u></a> or <a data-bs-toggle="modal" href="#modalChangePassword" class="text-dark"><u>Change</u></a> Password ?
                           </div>
                           <div class="col-12 mb-5">
                              <button data-bs-toggle="modal" data-bs-target="#modalAddRecipients" class="btn btn-secondary" style="min-width: 250px;">Add Recipients</button>
                           </div>

                           <div class="col-12">
                              <div class="table-responsive">
                                 <table class="table table-hover text-nowrap" style="width: 860px;">
                                    <thead>
                                       <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Subject</th>
                                          <th scope="col">Recipient</th>
                                          <th scope="col">Phone</th>
                                          <th scope="col">Country</th>
                                          <th scope="col">Province</th>
                                          <th scope="col">City</th>
                                          <th scope="col">Post Code</th>
                                          <th scope="col">Address</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                       <tr>
                                          <th scope="row">1.</th>
                                          <td>Home</td>
                                          <td>Galuh Pradhibta</td>
                                          <td>081333322610</td>
                                          <td>Indonesia</td>
                                          <td>Jawa Timur</td>
                                          <td>Mojokerto</td>
                                          <td class="text-center">61352</td>
                                          <td>Jl. Apel No. 35, RT. 03/ RW. 01, Wates</td>
                                          <td>
                                             <button type="button" name="button" class="btn btn-sm btn-secondary">Edit</button>
                                             <button type="button" name="button" class="btn btn-sm btn-outline-dark">Erase</button>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th scope="row">2.</th>
                                          <td>Office</td>
                                          <td>Murgiwati</td>
                                          <td>081333322610</td>
                                          <td>Indonesia</td>
                                          <td>Jawa Timur</td>
                                          <td>Mojokerto</td>
                                          <td class="text-center">61352</td>
                                          <td>Jl. Apel No. 35, RT. 03/ RW. 01, Wates</td>
                                          <td>
                                             <button type="button" name="button" class="btn btn-sm btn-secondary">Edit</button>
                                             <button type="button" name="button" class="btn btn-sm btn-outline-dark">Erase</button>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>

               <hr class="opacity-50 m-0 d-lg-none">

               <!-- ====================================== USER ORDERS ====================================== -->
               <div class="accordion-item">
                  <div class="accordion-header d-lg-none">
                     <button id="btnUserOrders" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userOrders">
                        <span class="me-3">my orders</span> <i class="bi bi-chevron-down"></i>
                     </button>
                  </div>
                  <div id="userOrders" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
                     <div class="accordion-body">

                        <div class="table-responsive mb-4">
                           <table class="table table-borderless table-hover text-capitalize mb-3" style="min-width: 560px;">
                              <thead class="border-bottom border-secondary">
                                 <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">orders no.</th>
                                    <th scope="col" class="text-center">date</th>
                                    <th scope="col" class="text-center">status</th>
                                    <th scope="col" class="text-center">total</th>
                                    <th scope="col" class="text-center">action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th scope="row">1.</th>
                                    <td>SKU 02574 77</td>
                                    <td class="text-nowrap text-center">19/03/22</td>
                                    <td class="text-nowrap text-center">delivered</td>
                                    <td class="text-nowrap text-center">148 k</td>
                                    <td class="text-nowrap text-center">
                                       <a data-bs-toggle="modal" href="#modalDetailOrder" class="text-primary"><u>details</u></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th scope="row">2.</th>
                                    <td>SKU 02574 77</td>
                                    <td class="text-nowrap text-center">19/03/22</td>
                                    <td class="text-nowrap text-center">delivered</td>
                                    <td class="text-nowrap text-center">148 k</td>
                                    <td class="text-nowrap text-center">
                                       <a data-bs-toggle="modal" href="#modalDetailOrder" class="text-primary"><u>details</u></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th scope="row">3.</th>
                                    <td>SKU 02574 77</td>
                                    <td class="text-nowrap text-center">19/03/22</td>
                                    <td class="text-nowrap text-center">delivered</td>
                                    <td class="text-nowrap text-center">148 k</td>
                                    <td class="text-nowrap text-center">
                                       <a data-bs-toggle="modal" href="#modalDetailOrder" class="text-primary"><u>details</u></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <th scope="row">4.</th>
                                    <td>SKU 02574 77</td>
                                    <td class="text-nowrap text-center">19/03/22</td>
                                    <td class="text-nowrap text-center">delivered</td>
                                    <td class="text-nowrap text-center">148 k</td>
                                    <td class="text-nowrap text-center">
                                       <a data-bs-toggle="modal" href="#modalDetailOrder" class="text-primary"><u>details</u></a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>

                     </div>
                  </div>
               </div>

               <hr class="opacity-50 m-0 d-lg-none">

               <!-- ====================================== USER MACHINES ====================================== -->
               <div class="accordion-item">
                  <div class="accordion-header d-lg-none">
                     <button id="btnUserMachines" class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userMachines">
                        <span class="me-3">my machines</span> <i class="bi bi-chevron-down"></i>
                     </button>
                  </div>
                  <div id="userMachines" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
                     <div class="accordion-body">

                        <div class="table-responsive mb-4">
                           <table class="table table-borderless table-hover text-capitalize mb-3" style="min-width: 480px;">
                              <thead class="border-bottom border-secondary">
                                 <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">machines</th>
                                    <th scope="col" class="text-center">status</th>
                                    <th scope="col" class="text-center">serial no.</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <th scope="row">1.</th>
                                    <td>Supresso Maker</td>
                                    <td class="text-nowrap text-center">Subscribe</td>
                                    <td class="text-nowrap text-end">#s12241ssd2</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">2.</th>
                                    <td>Supresso Maker</td>
                                    <td class="text-nowrap text-center">Subscribe</td>
                                    <td class="text-nowrap text-end">#s12241ssd2</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">3.</th>
                                    <td>Supresso Maker</td>
                                    <td class="text-nowrap text-center">Subscribe</td>
                                    <td class="text-nowrap text-end">#s12241ssd2</td>
                                 </tr>
                                 <tr>
                                    <th scope="row">4.</th>
                                    <td>Supresso Maker</td>
                                    <td class="text-nowrap text-center">Subscribe</td>
                                    <td class="text-nowrap text-end">#s12241ssd2</td>
                                 </tr>

                              </tbody>
                           </table>
                        </div>

                        <p class="text-end">
                           <a data-bs-toggle="collapse" href="#userAddMachines" class="text-primary">
                              <u>Add Your Machines</u> <i class="bi bi-chevron-right"></i>
                           </a>
                        </p>

                     </div>
                  </div>
               </div>

               <hr class="opacity-50 m-0 d-lg-none">

               <!-- ====================================== USER ADD MACHINES ====================================== -->
               <div class="accordion-item">
                  <div id="userAddMachines" class="accordion-collapse collapse fade" data-bs-parent="#accordionUser">
                     <div class="accordion-body">

                        <div class="form-floating border-bottom mb-1">
                           <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0" id="machinesSN" placeholder="Serial Number">
                           <label class="px-0" for="machinesSN">Serial Number</label>
                        </div>
                        <p><a href="#" target="_blank" class="mb-3">How to find my machine serial number</a></p>
                        <div class="form-floating border-bottom mb-3">
                           <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0" id="machinesOutletName" placeholder="Serial Number">
                           <label class="px-0" for="machinesOutletName">Outlet Name</label>
                        </div>
                        <div class="form-floating border-bottom mb-3">
                           <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0" id="machinesCity" placeholder="Serial Number">
                           <label class="px-0" for="machinesCity">City</label>
                        </div>
                        <div class="form-floating border-bottom mb-5">
                           <input type="text" class="form-control rounded-0 border-0 bg-transparent px-0" id="machinesDatePurchase" placeholder="Serial Number">
                           <label class="px-0" for="machinesDatePurchase">Date of Purchase</label>
                        </div>

                        <div class="mb-5" style="max-width: 320px;">
                           <label for="formFile" class="form-label">Photo Invoice:</label>
                           <input class="form-control" type="file" id="formFile">
                        </div>

                        <button class="btn btn-primary">
                           Add Machines
                        </button>

                     </div>
                  </div>
               </div>

               <div class="accordion-item">
                  <div class="accordion-header d-lg-none">
                     <div class="d-lg-none">
                        <button id="btnUserLogout" class="btn btn-user collapsed">
                           <span class="me-3">logout</span>
                        </button>
                     </div>
                  </div>
               </div>

            </div>

         </div>
      </div>
   </div>
</section>

@endsection

@section('popup')

<!-- OFFCANVAS SIDE PANEL MEMBERSHIP GRADE -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="sideMember" aria-labelledby="sideMemberLabel">
   <div class="offcanvas-header">
      <h5 class="offcanvas-title opacity-25" id="sideMemberLabel">Your Level</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
   </div>
   <div class="offcanvas-body">
      <div class="container-fluid">

         <!-- robusta -->
         <div class="card border-0 mb-4" style="background-color: #E0E1E3;">
            <div class="card-body text-center py-5">
               <h3 class="card-title gotham-bold lh-1">ROBUSTA</h3>
               <p class="card-text mb-5 lh-1">Membership</p>
               <a href="#" class="text-inherit">
                  <u>JOIN FOR FREE</u>
               </a>
            </div>
            <div class="card-body py-0 px-4">
               <ul class="list-group list-group-flush">
                  <li class="list-group-item text-inherit bg-transparent border-top border-bottom border-secondary">
                     Free sign-up for all
                  </li>
                  <li class="list-group-item text-inherit bg-transparent border-bottom border-secondary">
                     Eligibility: Anyone can join
                  </li>
                  <li class="list-group-item text-inherit bg-transparent border-bottom border-secondary">
                     Benefits: Collect dollars credits
                  </li>
               </ul>
            </div>
            <div class="card-body"></div>
         </div>

         <!-- arabica -->
         <div class="card border-0 text-light" style="background-color: #58595B;">
            <div class="card-body text-center py-5">
               <h3 class="card-title gotham-bold lh-1">ARABICA</h3>
               <p class="card-text mb-5 lh-1">Membership</p>
               <p class="card-text mb-0 lh-1">Spend $300 within 6 months</p>
            </div>
            <div class="card-body py-0 px-4">
               <ul class="list-group list-group-flush">
                  <li class="list-group-item text-inherit bg-transparent border-top border-bottom border-light">
                     Spend a minimum of $300 within six months to progress to Arabica.
                  </li>
                  <li class="list-group-item text-inherit bg-transparent border-bottom border-light">
                     Eligibility: Maintain a minimum spend of $300 within six months.
                  </li>
                  <li class="list-group-item text-inherit bg-transparent border-bottom border-light">
                     Benefits: Collect dollars credits.
                  </li>
                  <li class="list-group-item text-inherit bg-transparent border-bottom border-light">
                     Benefits: Access to birthday treats.
                  </li>
                  <li class="list-group-item text-inherit bg-transparent border-bottom border-light">
                     Exclusive discount campaigns.
                  </li>
                  <li class="list-group-item text-inherit bg-transparent border-bottom border-light">
                     Free local delivery with minimum spending of $100 in a single receipt.
                  </li>
               </ul>
            </div>
            <div class="card-body"></div>
         </div>

      </div>
   </div>
</div>


<!-- MODAL DETAILS ORDER -->
<div class="modal fade modal-middle" id="modalDetailOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: -1rem;"></button>
         </div>
         <div class="modal-body">
            <div class="container-fluid">

               <h4 class="modal-title mb-4" id="exampleModalLabel">Order No. : <strong>SKU 02574 77</strong></h4>

               <div class="table-responsive text-capitalize">
                  <table border="0" cellspacing="0" cellpadding="0" width="725">
                     <tbody>

                        <tr>
                           <td>
                              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                 <tbody>
                                    <tr>
                                       <td valign="top" width="150">name</td>
                                       <td valign="top" width="12">:</td>
                                       <td valign="top">sultan falah</td>
                                    </tr>
                                    <tr>
                                       <td valign="top" width="150">date</td>
                                       <td valign="top" width="12">:</td>
                                       <td valign="top">2022/10/24</td>
                                    </tr>
                                    <tr>
                                       <td valign="top" width="150">shipping</td>
                                       <td valign="top" width="12">:</td>
                                       <td valign="top">JNE one day services</td>
                                    </tr>
                                    <tr>
                                       <td valign="top" width="150">address</td>
                                       <td valign="top" width="12">:</td>
                                       <td valign="top">333A Orchard Road #03-11 Mandarin Gallery Singapore 238897
                                          Copyright © 2022 Indraco. All Rights Reserved.</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <hr class="opacity-100">
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <table border="0" cellspacing="0" cellpadding="10" width="100%">
                                 <tbody>

                                    <!-- product item -->
                                    <tr>
                                       <td>1.</td>
                                       <td width="120">
                                          <img src="ui/img/product/produk1.png" class="img-fluid bg-light rounded" alt="">
                                       </td>
                                       <td>
                                          <p class="mb-1"><strong>sumatra mandheling coffee beans</strong> <br><small>200g</small></p>
                                          <div class="harga-produk mb-0">
                                             <!-- <span class="harga-normal">$ 7.50</span> -->
                                             <span class="harga-promo d-flex align-items-center gap-2">
                                                <span class="harga-setelah-diskon">$ 6.55</span>
                                                <span class="harga-awal small">$ 7.50</span>
                                             </span>
                                          </div>
                                       </td>
                                       <td><span>X 1</span></td>
                                       <td width="120">
                                          <div class="harga-produk d-flex justify-content-between">
                                             <span>$</span> <span>7.50</span>
                                          </div>
                                       </td>
                                    </tr>

                                    <!-- product item -->
                                    <tr>
                                       <td>2.</td>
                                       <td width="120">
                                          <img src="ui/img/product/produk1.png" class="img-fluid bg-light rounded" alt="">
                                       </td>
                                       <td>
                                          <p class="mb-1"><strong>sumatra mandheling coffee beans</strong> <br><small>200g</small></p>
                                          <div class="harga-produk mb-0">
                                             <!-- <span class="harga-normal">$ 7.50</span> -->
                                             <span class="harga-promo d-flex align-items-center gap-2">
                                                <span class="harga-setelah-diskon">$ 6.55</span>
                                                <span class="harga-awal small">$ 7.50</span>
                                             </span>
                                          </div>
                                       </td>
                                       <td><span>X 1</span></td>
                                       <td width="120">
                                          <div class="harga-produk d-flex justify-content-between">
                                             <span>$</span> <span>7.50</span>
                                          </div>
                                       </td>
                                    </tr>

                                 </tbody>
                              </table>
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <hr class="opacity-50">
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <table border="0" cellspacing="0" cellpadding="10" align="right">
                                 <tbody>
                                    <tr>
                                       <td width="100" style="padding-top: 0; padding-bottom: 1rem;">
                                          <strong>subtotal</strong>
                                       </td>
                                       <td width="120" style="padding-top: 0; padding-bottom: 1rem;">
                                          <div class="harga-produk d-flex justify-content-between">
                                             <strong>$</strong> <strong>15.00</strong>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td width="100" style="padding-top: 0; padding-bottom: 0;">
                                          <span>discount</span>
                                       </td>
                                       <td width="120" style="padding-top: 0; padding-bottom: 0;">
                                          <div class="harga-produk d-flex justify-content-between">
                                             <span>$</span> <span>3.50</span>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td width="100" style="padding-top: 0; padding-bottom: 0;">
                                          <span>shipping</span>
                                       </td>
                                       <td width="120" style="padding-top: 0; padding-bottom: 0;">
                                          <div class="harga-produk d-flex justify-content-between">
                                             <span>$</span> <span>1.00</span>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <hr class="opacity-100">
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <table border="0" cellspacing="0" cellpadding="10" align="right">
                                 <tbody>
                                    <tr>
                                       <td width="100" style="padding-top: 0; padding-bottom: 0;">
                                          <strong class="fs-5">subtotal</strong>
                                       </td>
                                       <td width="120" style="padding-top: 0; padding-bottom: 0;">
                                          <div class="harga-produk d-flex justify-content-between">
                                             <strong class="fs-5">$</strong> <strong class="fs-5">15.00</strong>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>

                        <tr>
                           <td>
                              <hr class="opacity-100">
                           </td>
                        </tr>

                     </tbody>
                  </table>
               </div>

            </div>
         </div>
         <div class="modal-footer border-0"></div>
      </div>
   </div>
</div>


<!-- MODAL ADD RECIPIENTS -->
<div class="modal fade modal-middle" id="modalAddRecipients" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-4" id="exampleModalLabel">Add New Recipients</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <div class="row">

                  <div class="col-lg-6">

                     <div class="form-floating border-bottom mb-3">
                        <input type="text" class="form-control border-0 px-0 text-uppercase" id="userSubjectName" placeholder="Subject Name" value="Home">
                        <label for="userSubjectName" class="px-0">Subject Name*</label>
                     </div>

                     <div class="form-floating border-bottom mb-3">
                        <input type="text" class="form-control border-0 px-0 text-uppercase" id="userRecipientname" placeholder="Recipient Name">
                        <label for="userRecipientname" class="px-0">Recipient Name*</label>
                     </div>

                     <div class="form-floating border-bottom mb-3">
                        <input type="text" class="form-control border-0 px-0 text-uppercase" id="userPhone" placeholder="Phone Number">
                        <label for="userPhone" class="px-0">Phone Number*</label>
                     </div>

                     <div class="form-floating border-bottom mb-3">
                        <input type="email" class="form-control border-0 px-0 text-lowercase" id="userEmail" placeholder="Email">
                        <label for="userEmail" class="px-0">Email</label>
                     </div>

                  </div>

                  <div class="col-lg-6">

                     <div class="form-select2 mb-3 border-bottom">
                        <label class="px-0" for="userSelectCountry">Country*</label>
                        <select class="form-select px-0 border-0 rounded-0" id="userSelectCountry" aria-label="Floating label select">
                           <option selected>Indonesia</option>
                           <option value="2">Singapore</option>
                           <option value="3">Malaysia</option>
                        </select>
                     </div>

                     <div class="form-select2 mb-3 border-bottom">
                        <label class="px-0" for="userSelectProvince">Province*</label>
                        <select class="form-select px-0 border-0 rounded-0" id="userSelectProvince" aria-label="Floating label select">
                           <option value="1" selected>Jawa Timur</option>
                           <option value="2">Jawa Tengah</option>
                           <option value="3">Jawa Barat</option>
                        </select>
                     </div>

                     <div class="form-select2 mb-3 border-bottom">
                        <label class="px-0" for="userSelectCity">City*</label>
                        <select class="form-select px-0 border-0 rounded-0" id="userSelectCity" aria-label="Floating label select">
                           <option value="1" selected>Surabaya</option>
                           <option value="2">Sidoarjo</option>
                           <option value="3">Mojokerto</option>
                        </select>
                     </div>

                     <div class="form-floating mb-3 border-bottom">
                        <input type="text" class="form-control px-0 border-0 rounded-0" id="userTextZIP" placeholder="Post Code">
                        <label class="px-0" for="userTextZIP">Post Code*</label>
                     </div>

                     <div class="form-floating mb-3 border-bottom">
                        <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="userTextareaAddress1"></textarea>
                        <label class="px-0" for="userTextareaAddress1">Address 1*</label>
                     </div>

                     <div class="form-floating mb-3 border-bottom">
                        <textarea class="form-control px-0 border-0 rounded-0" placeholder="Leave a comment here" id="userTextareaAddress2"></textarea>
                        <label class="px-0" for="userTextareaAddress2">Address 2 (Optioanal)</label>
                     </div>

                  </div>

               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save Recipients</button>
         </div>
      </div>
   </div>
</div>


<!-- MODAL CHANGE PASSWORD -->
<div class="modal fade modal-middle" id="modalChangePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-4" id="exampleModalLabel">Change Password</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <p class="mb-5">Change your pasword to secure your account</p>
               <div class="form-floating border-bottom mb-3">
                  <input type="text" class="form-control border-0 rounded-0 px-0" id="resetUsername" placeholder="name@example.com" value="yoggi.supresso@gmail.com">
                  <label class="px-0 opacity-50" for="resetUsername">Username / Email Address</label>
               </div>

               <div class="input-group border-bottom mb-3 flex-nowrap">
                  <div class="form-floating w-100">
                     <input type="password" class="form-control border-0 rounded-0 px-0" id="resetUserPassOld" placeholder="Old Password">
                     <label class="px-0 opacity-50" for="resetUserPassOld">Old Password</label>
                  </div>
                  <button class="btn border-0 bi bi-eye d-none"></button>
                  <button class="btn border-0 bi bi-eye-slash"></button>
               </div>

               <div class="input-group border-bottom mb-3 flex-nowrap">
                  <div class="form-floating w-100">
                     <input type="password" class="form-control border-0 rounded-0 px-0" id="resetUserPassNew" placeholder="New Password">
                     <label class="px-0 opacity-50" for="resetUserPassNew">New Password</label>
                  </div>
                  <button class="btn border-0 bi bi-eye d-none"></button>
                  <button class="btn border-0 bi bi-eye-slash"></button>
               </div>

               <div class="input-group border-bottom mb-5 flex-nowrap">
                  <div class="form-floating w-100">
                     <input type="password" class="form-control border-0 rounded-0 px-0" id="resetUserPassConfirm" placeholder="Confirm Password">
                     <label class="px-0 opacity-50" for="resetUserPassConfirm">Confirm Password</label>
                  </div>
                  <button class="btn border-0 bi bi-eye d-none"></button>
                  <button class="btn border-0 bi bi-eye-slash"></button>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="#" class="btn btn-dark w-100">Change Password</a>
         </div>
      </div>
   </div>
</div>

@endsection