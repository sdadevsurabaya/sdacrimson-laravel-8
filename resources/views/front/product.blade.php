@extends('front/layout')

@section('konten')
<script>
	document.getElementById("navproducts").classList.add("active");
 </script>
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


				@foreach ($product_collection as $product_collections)
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-{{$product_collections->id}}-tab" data-bs-toggle="pill" data-bs-target="#nav-{{$product_collections->id}}" type="button" role="tab" aria-controls="nav-{{$product_collections->id}}" aria-selected="true">
							{{$product_collections->product_collection_name}}
							<span class="dot">&bull;</span>
						</button>
					</li>
				@endforeach	

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

		<!-- tab konten all collection -->
		<div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

				@foreach ($product_models as $product)
					
					<div class="col col-product mb-4 mb-xxl-5">
						<div class="card card-product border-0 rounded-0 text-center">
							<div class="card-header position-relative p-0 rounded-0 border-0" style="background-color: white">
								<a href="{{ route('fproducts.show',$product->id) }}" class="text-text-decoration-none">
								@if(empty($product->images))
								<img class="img-fluid" src="{{ url('files/'.'imagenotavailable.jpg') }}">
								<img class="img-fluid" src="{{ url('files/'.'imagenotavailable.jpg') }}">
								@else
									@if(count($product->images) > 1)
									<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[0]) }}">
									<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[1]) }}">
									@else
									<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[0]) }}">
									@endif
								@endif
								</a>
								<button data-bs-toggle="modal" data-bs-target="#modalAddtocart{{$product->id}}" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
									<i class="bi bi-cart-plus"></i>
								</button>


								{{-- <form action="{{ route('cartmodal.store') }}" method="POST" enctype="multipart/form-data">
									@csrf
									<input type="hidden" value="{{ $product->id }}" name="id">
									<input type="hidden" value="{{ $product->product_name }}" name="name">
									
										@if(!empty($product->disc_event))
													<input type="hidden" value="{{ $product->product_price_after_disc }}" name="price">
													@else
													<input type="hidden" value="{{ $product->product_price }}" name="price">
													@endif
								
									<input type="hidden" value="{{ $product->product_weight }}" name="gramature">
									@if(!empty($product->images))
									<input type="hidden" value="{{ $product->images[0] }}" name="images">
									@else
									<input type="hidden" value="imagenotavailable.jpg" name="images">
									@endif

									<input type="hidden" value="1" name="quantity">
									
									<button data-bs-toggle="modal" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
									<i class="bi bi-cart-plus"></i>
									</button>
                   					</form> --}}




							</div>
							<div class="card-body text-capitalize px-0 pb-0">
								<div class="cart-title fw-bold lh-sm">{{$product->product_name}} {{$product->disc_event}}</div>
								<div class="cart-text my-1">{{$product->product_weight}}g</div>
								<div class="harga-produk mb-0">
									<!-- <span class="harga-normal">S$ 7.50</span> -->
									<span class="harga-promo d-flex justify-content-center align-items-center gap-2">

										@if(!empty($product->disc_event))
										<span class="harga-setelah-diskon">$ {{$product->product_price_after_disc}}</span>
										<span class="harga-awal">$ {{$product->product_price}}</span>
										@else
										<span class="harga-normal">$ {{$product->product_price}}</span>
										@endif
									</span>
								</div>
							</div>
							<button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
								<i class="bi bi-bookmark-fill"></i>
							</button>
								@if(!empty($product->disc_event))
							<div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE {{$product->disc_event}}%</div>
							@endif
							
						</div>
					</div>

 				@endforeach	

				</div>
			</div>
		</div>


		@foreach ($product_collection as $product_collections)
			<div class="tab-pane fade" id="nav-{{$product_collections->id}}" role="tabpanel" aria-labelledby="nav-{{$product_collections->id}}-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
 				@foreach ($product_collections->product as $product)
					<div class="col col-product mb-4 mb-xxl-5">
						<div class="card card-product border-0 rounded-0 text-center">
							<div class="card-header position-relative p-0 rounded-0 border-0" style="background-color: white;">
								<a href="{{ route('fproducts.show',$product->id) }}" class="text-text-decoration-none">
									@if(empty($product->images))
										<img class="img-fluid" src="{{ url('files/'.'imagenotavailable.jpg') }}">
										<img class="img-fluid" src="{{ url('files/'.'imagenotavailable.jpg') }}">
									@else
										@if(count($product->images) > 1)
											<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[0]) }}">
											<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[1]) }}">
										@else
											<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[0]) }}">
										@endif
									@endif
								</a>
								<button data-bs-toggle="modal" data-bs-target="#modalAddtocart{{$product->id}}" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
									<i class="bi bi-cart-plus"></i>
								</button>
							</div>
							<div class="card-body text-capitalize px-0 pb-0">
								<div class="cart-title fw-bold lh-sm">{{$product->product_name}}</div>
								<div class="cart-text my-1">{{$product->product_weight}}g</div>
								<div class="harga-produk mb-0">
									<!-- <span class="harga-normal">S$ 7.50</span> -->
									<span class="harga-promo d-flex justify-content-center align-items-center gap-2">
										@if(!empty($product->disc_event))
										<span class="harga-setelah-diskon">$ {{$product->product_price_after_disc}}</span>
										<span class="harga-awal">$ {{$product->product_price}}</span>
										@else
										<span class="harga-normal">$ {{$product->product_price}}</span>
										@endif
									</span>
								</div>
							</div>
							<button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">
								<i class="bi bi-bookmark-fill"></i>
							</button>
								@if(!empty($product->disc_event))
							<div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE {{$product->disc_event}}%</div>
							@endif
							
						</div>
					</div>


 				@endforeach				

				</div>
			</div>
		</div>
		@endforeach	


	</div>
</section>
<!-- END OF PRODUCT LIST -->
@endsection
{{-- Modal --}}
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
<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
<script>

	$(document).ready(function(){
		loadProduct();
	});

	let collection 	= "all";
	let form 		= "all";
	let sorting 	= "all";

	function loadProduct(){
		$.ajax({
			url:"product-data-load/"+collection+"/"+form+"/"+sorting,
			method:"get",
			success:function(res){
				console.log(res);
			}, error:function(err){
				console.log(err);
			}
		})
	}

</script>