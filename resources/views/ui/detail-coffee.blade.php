@extends('ui/layout')

@section('konten')

<!-- detail product section -->
<section>
	<div class="container">
		<div class="row">

			<!-- header menu -->
			<div class="col-12">
				<div class="pt-4 d-flex justify-content-between d-lg-none">
					<a href="/coffee" class="btn btn-lg border-0 rounded-0">
						<i class="bi bi-chevron-left"></i>
					</a>
					<a href="/cart" class="btn btn-lg border-0 rounded-0 position-relative">
						<i class="bi bi-cart"></i>
						<span class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle-x" style="font-size: .55em;">+99</span>
					</a>
				</div>
				<div class="d-none d-lg-block mb-4">
					<a href="/fproducts" class="text-inherit">
						<i class="bi bi-chevron-left"></i> Continue Shopping
					</a>
				</div>
			</div>
			<!-- end of header menu -->

			<!-- foto produk -->
			<div class="col-lg-6 col-xl-5 col-xxl-auto mb-5 mb-lg-0">
				<div id="fotoDetailCoffee" class="carousel slide d-lg-flex align-items-start" data-bs-ride="false">
					<div class="carousel-inner mb-3 mb-lg-0 order-lg-2">


							@if(empty($product_models->images))
								<img class="img-fluid" src="{{ url('files/'.'imagenotavailable.jpg') }}">
								
								@else

									@foreach ($product_models->images as $imgs)
										@if($loop->index ==0)
										<div class="carousel-item active">
										<img src="{{ url('files/product-images/'.$imgs) }}" class="d-block w-100" alt="...">
										</div>
										@else
										<div class="carousel-item">
										<img src="{{ url('files/product-images/'.$imgs) }}" class="d-block w-100" alt="...">
										</div>
										@endif
									@endforeach
									{{-- @if(count($product_models->images) > 1)
									<img class="img-fluid" src="{{ url('files/product-images/'.$product_models->images[0]) }}">
									<img class="img-fluid" src="{{ url('files/product-images/'.$product_models->images[1]) }}">
									@else
									<img class="img-fluid" src="{{ url('files/product-images/'.$product_models->images[0]) }}">
									@endif --}}
								@endif

						<!-- detail foto produk slider -->
						{{-- <div class="carousel-item active">
							<img src="../ui/img/product/produk1.png" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="../ui/img/product/produk2.png" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="../ui/img/product/produk3.png" class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="../ui/img/product/produk4.jpg" class="d-block w-100" alt="...">
						</div> --}}
						<!-- end of detail foto produk slider -->

						<!-- slider control -->
						<div class="carousel-control">
							<button class="carousel-control-prev text-dark" type="button" data-bs-target="#fotoDetailCoffee" data-bs-slide="prev">
								<i class="bi bi-chevron-left"></i>
							</button>
							<button class="carousel-control-next text-dark" type="button" data-bs-target="#fotoDetailCoffee" data-bs-slide="next">
								<i class="bi bi-chevron-right"></i>
							</button>
						</div>
						<!-- end of slider control -->
					</div>
					<!-- slider indicators/ thumbnail image -->
					<div class="carousel-indicators me-lg-2">

							@if(empty($product_models->images))
								<img class="img-fluid" src="{{ url('files/'.'imagenotavailable.jpg') }}">
								
								@else

									@foreach ($product_models->images as $imgs)
										<button type="button" data-bs-target="#fotoDetailCoffee" data-bs-slide-to="{{$loop->index}}" class="rounded overflow-hidden active" aria-current="true" aria-label="Slide {{$loop->index}}">
										<img src="{{ url('files/product-images/'.$imgs) }}" class="img-fluid">
										</button>
									@endforeach
									{{-- @if(count($product_models->images) > 1)
									<img class="img-fluid" src="{{ url('files/product-images/'.$product_models->images[0]) }}">
									<img class="img-fluid" src="{{ url('files/product-images/'.$product_models->images[1]) }}">
									@else
									<img class="img-fluid" src="{{ url('files/product-images/'.$product_models->images[0]) }}">
									@endif --}}
								@endif


						{{-- <button type="button" data-bs-target="#fotoDetailCoffee" data-bs-slide-to="0" class="rounded overflow-hidden active" aria-current="true" aria-label="Slide 1">
							<img src="../ui/img/product/" produk1.pngclass="img-fluid">
						</button>
						<button type="button" data-bs-target="#fotoDetailCoffee" data-bs-slide-to="1" class="rounded overflow-hidden" aria-label="Slide 2">
							<img src="../ui/img/product/produk2.png" class="img-fluid">
						</button>
						<button type="button" data-bs-target="#fotoDetailCoffee" data-bs-slide-to="2" class="rounded overflow-hidden" aria-label="Slide 3">
							<img src="../ui/img/product/produk3.png" class="img-fluid">
						</button>
						<button type="button" data-bs-target="#fotoDetailCoffee" data-bs-slide-to="3" class="rounded overflow-hidden" aria-label="Slide 4">
							<img src="../ui/img/product/produk4.jpg" class="img-fluid">
						</button> --}}
					</div>
					<!-- end of slider indicators/ thumbnail image -->
				</div>
			</div>
			<!-- end of foto produk -->

			<!-- kolom spesifikasi -->
			<div class="col-lg-6 col-xl-7 spesifikasi-produk ms-xxl-auto">
				<p class="mb-2">{{$product_models->product_collection_name}}</p>
				<h3 class="gotham-bold">{{$product_models->product_name}}</h3>
				<h4 class="harga-produk mb-0">
					<!-- <span class="harga-normal">S$ 7.50</span> -->
					<span class="harga-promo">
						<span class="harga-setelah-diskon me-3">$ 6.55</span>
						<span class="harga-awal">${{$product_models->product_price}}</span>
					</span>
				</h4>
				<div class="text-end">
					<button class="btn border-0 py-0 px-2 rounded-0"><i class="bi bi-bookmark-fill fs-5"></i></button>
					<button class="btn border-0 py-0 px-2 rounded-0"><i class="bi bi-share fs-5"></i></button>
				</div>
				<p>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>
					<span class="ms-3">(3 x Reviews)</span>
				</p>
				<p>{{$product_models->product_shortdetail}}</p>
				<div class="row row-cols-1 row-cols-lg-2">
					<div class="col">
						<p>{{$product_models->acidity_desc}}
							@if($product_models->product_acidityscore==0)	
							<img src="../ui/img/rating/bulat0.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==0.5)
							<img src="../ui/img/rating/bulat0-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==1)
							<img src="../ui/img/rating/bulat1.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==1.5)
							<img src="../ui/img/rating/bulat1-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==2)
							<img src="../ui/img/rating/bulat2.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==2.5)
							<img src="../ui/img/rating/bulat2-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==3)
							<img src="../ui/img/rating/bulat3.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==3.5)
							<img src="../ui/img/rating/bulat3-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==4)
							<img src="../ui/img/rating/bulat4.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_acidityscore==4.5)
							<img src="../ui/img/rating/bulat4-5.svg" width="87.5" height="auto" class="ms-3">
							@else
							<img src="../ui/img/rating/bulat5.svg" width="87.5" height="auto" class="ms-3">
							@endif
						</p>
						<p>{{$product_models->body_desc}}
							@if($product_models->product_bodyscore==0)	
							<img src="../ui/img/rating/bulat0.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==0.5)
							<img src="../ui/img/rating/bulat0-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==1)
							<img src="../ui/img/rating/bulat1.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==1.5)
							<img src="../ui/img/rating/bulat1-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==2)
							<img src="../ui/img/rating/bulat2.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==2.5)
							<img src="../ui/img/rating/bulat2-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==3)
							<img src="../ui/img/rating/bulat3.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==3.5)
							<img src="../ui/img/rating/bulat3-5.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==4)
							<img src="../ui/img/rating/bulat4.svg" width="87.5" height="auto" class="ms-3">
							@elseif($product_models->product_bodyscore==4.5)
							<img src="../ui/img/rating/bulat4-5.svg" width="87.5" height="auto" class="ms-3">
							@else
							<img src="../ui/img/rating/bulat5.svg" width="87.5" height="auto" class="ms-3">
							@endif
							
						</p>
					</div>
					<div class="col">
						<p>{{$product_models->product_roastdesc}}</p>
						<p>{{$product_models->product_typedesc}}</p>
					</div>
				</div>
				<p class="text-justify" style="text-transform: initial;">
					{{$product_models->product_detail}}
				</p>
				<p>
					<a data-bs-toggle="collapse" href="#tablePackaging" class="text-inherit">
						<u>packaging configurations</u> <i class="bi bi-chevron-right"></i>
					</a>
				</p>
				<div class="collapse" id="tablePackaging">
					<div class="table-responsive mb-4">
						<table class="table table-sm table-borderless table-striped text-center" style="width: 735px;">
							<thead class="table-dark">
								<tr>
									<th scope="col" valign="middle" width="120">WEIGHT</th>
									<th scope="col" valign="middle" width="255">CARTON CONFIGURATION</th>
									<th scope="col" valign="middle" width="360" class="p-0">
										<table class="table table-sm table-borderless m-0 table-dark">
											<thead>
												<tr valign="middle">
													<td colspan="3">CONTAINER (FLOOR LOADING)</td>
												</tr>
												<tr>
													<td valign="middle">20'</td>
													<td valign="middle">40'</td>
													<td valign="middle">40'</td>
												</tr>
											</thead>
										</table>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="120">200g</td>
									<td width="255">12 cans x 200g</td>
									<td width="360" class="p-0">
										<table class="table table-sm table-borderless m-0">
											<tbody>
												<tr>
													<td>400</td>
													<td>400</td>
													<td>400</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td width="120">200g</td>
									<td width="255">12 cans x 200g</td>
									<td width="360" class="p-0">
										<table class="table table-sm table-borderless m-0">
											<tbody>
												<tr>
													<td>400</td>
													<td>400</td>
													<td>400</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td width="120">200g</td>
									<td width="255">12 cans x 200g</td>
									<td width="360" class="p-0">
										<table class="table table-sm table-borderless m-0">
											<tbody>
												<tr>
													<td>400</td>
													<td>400</td>
													<td>400</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<p class="m-0">
					<a data-bs-toggle="collapse" href="#detailMore" class="text-inherit">
						<u>more details</u> <i class="bi bi-chevron-right"></i>
					</a>
				</p>
			</div>
			<!-- end of kolom spesifikasi -->

			<div class="col-12">
				<div class="collapse" id="detailMore">
					<div class="row">
						<div class="col-12">
							<hr class="opacity-100 my-5">
						</div>
						<div class="col-lg-6 mb-4 mb-lg-0">
							<img src="../ui/img/detail/kopi.png" class="img-fluid float-lg-end w-lg-auto img-fluid-lg-unset" alt="">
						</div>

						<!-- How to serve -->
						<div class="col-lg-6 spesifikasi-produk">
							<h3 class="gotham-bold">How to serve</h3>
							<p class="text-justify mb-4">
								Grown in the highlands of Kintamani, this coffee has unique characteristics derived from wet processing method, making them slightly sweeter. The mild body of the coffee exudes a clean light and refreshing taste exhibiting a citrusy, fruity ﬁnish. It is a must-try for those who do not like the bitter taste.
							</p>
							<div class="row row-cols-auto g-4">
								<div class="col"><img src="../ui/img/detail/french-press.svg" width="100" class="img-fluid" alt=""></div>
								<div class="col"><img src="../ui/img/detail/siphon.svg" width="100" class="img-fluid" alt=""></div>
								<div class="col"><img src="../ui/img/detail/pour-over.svg" width="100" class="img-fluid" alt=""></div>
								<div class="col"><img src="../ui/img/detail/coffee-maker.svg" width="100" class="img-fluid" alt=""></div>
								<div class="col"><img src="../ui/img/detail/espresso-machine.svg" width="100" class="img-fluid" alt=""></div>
							</div>
							<hr class="my-4">
							<ul class="media list-unstyled mb-0">
								<li class="media-item">
									<div class="media-header">1.</div>
									<div class="media-body">
										<p>
											Grown in the highlands of Kintamani, this coffee has unique characteristics derived from wet processing method, making them slightly sweeter.
										</p>
									</div>
								</li>
								<li class="media-item">
									<div class="media-header">2.</div>
									<div class="media-body">
										<p>
											Grown in the highlands of Kintamani, this coffee has unique characteristics derived from wet processing method, making them slightly sweeter.
										</p>
									</div>
								</li>
								<li class="media-item">
									<div class="media-header">3.</div>
									<div class="media-body">
										<p>
											Grown in the highlands of Kintamani, this coffee has unique characteristics derived from wet processing method, making them slightly sweeter.
										</p>
									</div>
								</li>
							</ul>
						</div>

						<div class="col-12">
							<hr class="opacity-100 my-5">
						</div>

						<!-- ratings & review -->
						<div class="col-md-8 col-xl-7 spesifikasi-produk">
							<h3 class="gotham-bold mb-3">Ratings & Reviews</h3>
							<div class="row align-md-center">
								<div class="col-md-auto mb-3 mb-md-0 text-center">
									<h1 class="display-1 gotham-bold lh-1">3.0</h1>
									<p class="mb-0">
										<i class="bi bi-star-fill"></i>
										<i class="bi bi-star-fill"></i>
										<i class="bi bi-star-fill"></i>
										<i class="bi bi-star"></i>
										<i class="bi bi-star"></i>
										<br>
										(1 X Ratings)
									</p>
								</div>
								<div class="col-auto d-none d-md-block">
									<div class="h-100 border-start border-secondary"></div>
								</div>
								<div class="col-md">
									<ul class="media list-unstyled mb-0">
										<li class="media-item align-items-center">
											<div class="media-header fs-5 fw-bold text-center">5</div>
											<div class="media-body">
												<div class="progress rounded-pill">
													<div class="progress-bar bg-dark w-100" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</li>
										<li class="media-item align-items-center">
											<div class="media-header fs-5 fw-bold text-center">4</div>
											<div class="media-body">
												<div class="progress rounded-pill">
													<div class="progress-bar bg-dark w-75" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</li>
										<li class="media-item align-items-center">
											<div class="media-header fs-5 fw-bold text-center">3</div>
											<div class="media-body">
												<div class="progress rounded-pill">
													<div class="progress-bar bg-dark w-50" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</li>
										<li class="media-item align-items-center">
											<div class="media-header fs-5 fw-bold text-center">2</div>
											<div class="media-body">
												<div class="progress rounded-pill">
													<div class="progress-bar bg-dark w-25" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</li>
										<li class="media-item align-items-center">
											<div class="media-header fs-5 fw-bold text-center">1</div>
											<div class="media-body">
												<div class="progress rounded-pill">
													<div class="progress-bar bg-dark w-0" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<hr>
							<div class="table-responsive mb-4">
								<div class="btn-group text-nowrap mb-2">
									<button class="btn btn-outline-dark fs-inherit active">All Reviews</button>
									<button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i> 1</button>
									<button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i> 2</button>
									<button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i> 3</button>
									<button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i> 4</button>
									<button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i> 5</button>
								</div>
							</div>
							<ul class="media list-unstyled reviews-list mb-0">
								<li class="media-item">
									<img src="../ui/img/user/user.jpg" class="img-thumbnail rounded-circle p-0 me-3" alt="">
									<div class="media-body">
										<h5 class="gotham-bold text-capitalize lh-1 mb-2">shandy satrio wissar</h5>
										<p class="lh-1 mb-2">
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star"></i>
											<i class="bi bi-star"></i>
										</p>
										<p class="lh-1 mb-4">2022-02-22 18:02:26</p>
										<p class="small">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										</p>
									</div>
								</li>
								<li class="media-item">
									<img src="../ui/img/user/user.jpg" class="img-thumbnail rounded-circle p-0 me-3" alt="">
									<div class="media-body">
										<h5 class="gotham-bold text-capitalize lh-1 mb-2">shandy satrio wissar</h5>
										<p class="lh-1 mb-2">
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star"></i>
											<i class="bi bi-star"></i>
										</p>
										<p class="lh-1 mb-4">2022-02-22 18:02:26</p>
										<p class="small">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										</p>
									</div>
								</li>
								<li class="media-item">
									<img src="../ui/img/user/user.jpg" class="img-thumbnail rounded-circle p-0 me-3" alt="">
									<div class="media-body">
										<h5 class="gotham-bold text-capitalize lh-1 mb-2">shandy satrio wissar</h5>
										<p class="lh-1 mb-2">
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star-fill"></i>
											<i class="bi bi-star"></i>
											<i class="bi bi-star"></i>
										</p>
										<p class="lh-1 mb-4">2022-02-22 18:02:26</p>
										<p class="small">
											Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
										</p>
									</div>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- edn of detail product section -->

<section>
	<div class="container">
		<div class="row g-1 g-md-2 g-lg-3">
			<div class="col-12 mt-0"><img src="../ui/img/detail/image1.png" class="img-fluid" alt=""></div>
			<div class="col-6"><img src="../ui/img/detail/image2.png" class="img-fluid" alt=""></div>
			<div class="col-6"><img src="../ui/img/detail/image3.png" class="img-fluid" alt=""></div>
		</div>
	</div>
</section>

<!-- alternate product -->
<section>
	<div class="container">
		<h5 class="gotham-bold mb-4">Others also considered</h5>
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
			<div class="carousel-control d-none d-md-block">
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
<!-- navigasi menu detail product -->
<div id="navDetailProduct" class="fixed-bottom">
	<nav class="nav py-3 border-top" style="background-color: #f1f2f2;">
		<div class="container">
			<div class="row justify-content-lg-between align-items-lg-center">
				<div class="col-lg-auto col-xl-8 col-xxl-7 order-lg-2">
					<div class="row justify-content-md-between">
						<div class="col-md-auto mb-2 d-flex align-items-center mb-md-4 mb-lg-0">
							<div class="me-2 d-inline" style="min-width: 60px;"><span class="d-none d-md-inline">Coffee</span> Form</div>
							<div class="btn-group">
								<button class="btn btn-outline-dark fs-inherit active">Beans</button>
								<button class="btn btn-outline-dark fs-inherit">Ground</button>
								<button class="btn btn-outline-dark fs-inherit">Drip</button>
								<button class="btn btn-outline-dark fs-inherit">Capsules</button>
							</div>
						</div>
						<div class="col-md-auto mb-4 d-flex align-items-center mb-md-4 mb-lg-0">
							<div class="me-2 d-inline" style="min-width: 60px;">Weight</div>
							<div class="btn-group">
								<button class="btn btn-outline-dark fs-inherit active">200g</button>
								<button class="btn btn-outline-dark fs-inherit">500g</button>
								<button class="btn btn-outline-dark fs-inherit">1000g</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-auto order-lg-1 mb-4 mb-lg-0">
					<form action="">
						<div class="input-group">
							<button class="btn border-0 fs-5 p-0"><i class="bi bi-dash-circle"></i></button>
							<input type="text" class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold" value="100" min="1" max="100" style="max-width: 55px;">
							<button class="btn border-0 fs-5 p-0"><i class="bi bi-plus-circle"></i></button>
						</div>
					</form>
				</div>
				<div class="col-auto order-lg-3 mb-4 ms-auto mb-lg-0 ms-lg-0">
					<strong class="fw-bold fs-5">Total : S$ 7.00</strong>
				</div>
				<div class="col-12 order-lg-4 mt-lg-3">
					<button class="btn btn-lg btn-dark w-100" id="btnAddcart">Add To Cart <i class="bi bi-cart-plus"></i></button>
				</div>
			</div>
		</div>
	</nav>
</div>

<!-- toast/ notifikasi add product -->
<div class="toast-container position-absolute top-100 end-0">
	<div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-header">
			<strong class="me-auto">1 x item added to your Cart</strong>
			<small class="text-muted">11 mins ago</small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			Hello, world! This is a toast message.
		</div>
	</div>
</div>
@endsection