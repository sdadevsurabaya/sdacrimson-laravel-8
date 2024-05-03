@extends('ui/layout')

@section('konten')
<!-- PRODUCT HADER -->
<section class="header-product text-light pb-2 mb-3" style="background-color: #404041; background-image: url(ui/img/product/floral.svg); background-repeat: no-repeat; background-position: right center; background-size: contain;">
	<div class="container pb-3 pb-lg-5">
		<div class="gotham-bold lh-sm fs-2 fs-lg-3">
			Supresso <br> Collection.
		</div>
	</div>
</section>
<!-- END OF PRODUCT HADER -->

<!-- PRODUCT FILTER -->
<section class="sticky-top mb-4 mb-lg-5 bg-white border-bottom">
	<div class="container">
		<div class="d-flex align-items-start">

			<!-- navigasi product filter -->
			<div class="table-responsive">
				<ul class="nav nav-pills flex-nowrap fw-bold mb-2" id="pills-tab" role="tablist" style="white-space: nowrap;">
					<!-- nav tab our collection -->
					<li class="nav-item active" role="presentation">
						<button class="nav-link btn-dot active" id="nav-all-tab" data-bs-toggle="pill" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">
							all collection
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab single origin -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-so-tab" data-bs-toggle="pill" data-bs-target="#nav-so" type="button" role="tab" aria-controls="nav-so" aria-selected="true">
							single origin
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab luwak prestige -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-luwak-tab" data-bs-toggle="pill" data-bs-target="#nav-luwak" type="button" role="tab" aria-controls="nav-luwak">
							luwak prestige
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab organic -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-organic-tab" data-bs-toggle="pill" data-bs-target="#nav-organic" type="button" role="tab" aria-controls="nav-organic">
							organic
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab rainforest -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-rainforest-tab" data-bs-toggle="pill" data-bs-target="#nav-rainforest" type="button" role="tab" aria-controls="nav-rainforest">
							rainforest
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab gourmet -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-gourmet-tab" data-bs-toggle="pill" data-bs-target="#nav-gourmet" type="button" role="tab" aria-controls="nav-gourmet">
							gourmet
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab wprld blend -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-wb-tab" data-bs-toggle="pill" data-bs-target="#nav-wb" type="button" role="tab" aria-controls="nav-wb">
							world blend
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab balicafe -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-bali-tab" data-bs-toggle="pill" data-bs-target="#nav-bali" type="button" role="tab" aria-controls="nav-bali">
							balicafé
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- nav tab bundles -->
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-bundles-tab" data-bs-toggle="pill" data-bs-target="#nav-bundles" type="button" role="tab" aria-controls="nav-bundles">
							bundles
							<span class="dot">&bull;</span>
						</button>
					</li>
					<!-- end of nav tab -->
				</ul>
			</div>
			<!-- end of navigasi product filter -->

			<!-- product sortby -->
			<div class="ps-3 ms-auto">
				<button class="btn border-0 rounded-0 fs-inherit text-nowrap" data-bs-toggle="offcanvas" data-bs-target="#sortProduct">
					<i class="bi bi-funnel fs-5"></i> <span class="d-none d-lg-inline">Filter | Sort by</span>
				</button>
			</div>
			<!-- end of product sortby -->

		</div>
	</div>
</section>
<!-- END OF PRODUCT FILTER -->

<!-- PRODUCT LIST -->
<section id="productList">
	<div class="tab-content" id="pills-tabContent">

		<!-- tab konten our collection -->
		<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab" tabindex="0">
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


		{{-- @foreach ($product_collection as $product_collections)
			<div class="tab-pane fade" id="nav-{{$product_collections->id}}" role="tabpanel" aria-labelledby="nav-{{$product_collections->id}}-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					1
				</div>
			</div>
		</div> --}}

		<!-- tab konten luwak prestige -->
		<div class="tab-pane fade" id="nav-luwak" role="tabpanel" aria-labelledby="nav-luwak-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					2
				</div>
			</div>
		</div>

		<!-- tab konten organic -->
		<div class="tab-pane fade" id="nav-organic" role="tabpanel" aria-labelledby="nav-organic-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					<div class="col col-product mb-3">
						3
					</div>
				</div>
			</div>
		</div>

		<!-- tab konten rainforest -->
		<div class="tab-pane fade" id="nav-rainforest" role="tabpanel" aria-labelledby="nav-rainforest-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					<div class="col col-product mb-3">
						4
					</div>
				</div>
			</div>
		</div>

		<!-- tab konten gourmet -->
		<div class="tab-pane fade" id="nav-gourmet" role="tabpanel" aria-labelledby="nav-gourmet-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					<div class="col col-product mb-3">
						5
					</div>
				</div>
			</div>
		</div>

		<!-- tab konten world blend -->
		<div class="tab-pane fade" id="nav-wb" role="tabpanel" aria-labelledby="nav-wb-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					<div class="col col-product mb-3">
						6
					</div>
				</div>
			</div>
		</div>

		<!-- tab konten balicafe -->
		<div class="tab-pane fade" id="nav-bali" role="tabpanel" aria-labelledby="nav-bali-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					<div class="col col-product mb-3">
						7
					</div>
				</div>
			</div>
		</div>

		<!-- tab konten bundles -->
		<div class="tab-pane fade" id="nav-bundles" role="tabpanel" aria-labelledby="nav-bundles-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
					<div class="col col-product mb-3">
						8
					</div>
				</div>
			</div>
		</div>
		<!-- end of tab konten -->

	</div>
</section>
<!-- END OF PRODUCT LIST -->
@endsection

@section('popup')
<!-- SORT PRODUCT -->
<div class="offcanvas offcanvas-end h-auto" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="sortProduct" aria-labelledby="sortProductLabel" style="width: 90%; max-width: 375px;">
	<div class="offcanvas-header pb-0">
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body pt-0">
		<div class="container-fluid d-flex flex-column h-100">
			<h1 class="gotham-bold mb-4 text-end fs-2 fs-lg-3">Filter</h1>
			<form class="mb-5">
				<div class="form-group mb-4">
					<p class="small opacity-50 m-0 text-end">Quick filter</p>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="checkbox" value="" id="filterBeans" checked>
						<label class="form-check-label w-100" for="filterBeans">
							Coffee Beans
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="checkbox" value="" id="filterGround" checked>
						<label class="form-check-label w-100" for="filterGround">
							Ground Coffee
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="checkbox" value="" id="filterDrip">
						<label class="form-check-label w-100" for="filterDrip">
							Drip Coffee
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="checkbox" value="" id="filterCapsules">
						<label class="form-check-label w-100" for="filterCapsules">
							Coffee Capsules
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0">
						<input class="form-check-input" type="checkbox" value="" id="filterBundles">
						<label class="form-check-label w-100" for="filterBundles">
							Bundles
						</label>
					</div>
				</div>
				<div class="form-group">
					<p class="small opacity-50 m-0 text-end">Sort by</p>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="radio" value="" name="sort" id="sortFavourite" checked>
						<label class="form-check-label w-100" for="sortFavourite">
							Favourite
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="radio" value="" name="sort" id="sortLatest">
						<label class="form-check-label w-100" for="sortLatest">
							Lates Products
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="radio" value="" name="sort" id="sortHight">
						<label class="form-check-label w-100" for="sortHight">
							Price Hight to Low
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input" type="radio" value="" name="sort" id="sortLow">
						<label class="form-check-label w-100" for="sortLow">
							Price Low to Hight
						</label>
					</div>
				</div>
			</form>
			<div class="mt-auto d-flex gap-1">
				<button class="btn btn-light fs-inherit w-100">Reset</button>
				<button class="btn btn-dark fs-inherit w-100">Apply</button>
			</div>
		</div>
	</div>
</div>
<!-- END OF SORT PRODUCT -->
@endsection