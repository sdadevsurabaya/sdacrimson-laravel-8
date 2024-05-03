@extends('front/layout')

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
						<button class="nav-link btn-dot active" id="nav-all-tab" data-bs-toggle="pill" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true" onclick="showProduct('all')">
							all collection
							<span class="dot">&bull;</span>
						</button>
					</li>


				@foreach ($product_collection as $product_collections)
					<li class="nav-item" role="presentation">
						<button class="nav-link btn-dot" id="nav-{{$product_collections->id}}-tab" data-bs-toggle="pill" data-bs-target="#nav-{{$product_collections->id}}" type="button" role="tab" aria-controls="nav-{{$product_collections->id}}" aria-selected="true" onclick="showProduct({{$product_collections->id}})">
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
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5" id="list-product-all">

				
				</div>
			</div>
		</div>


		@foreach ($product_collection as $product_collections)
			<div class="tab-pane fade" id="nav-{{$product_collections->id}}" role="tabpanel" aria-labelledby="nav-{{$product_collections->id}}-tab" tabindex="0">
			<div class="container">
				<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5" id="list-product-{{$product_collections->id}}">
 					
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

					@foreach($product_forms as $form)
						<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom" id="form-check-{{$form->id}}">
							<input class="form-check-input checkbox-form" type="checkbox" value="{{$form->id}}" id="filterBeans" onclick="filterForm()" checked>
							<label class="form-check-label w-100" for="filterBeans">
								{{$form->product_form_name}}
							</label>
						</div>
					@endforeach
					
				</div>
				<div class="form-group">
					<p class="small opacity-50 m-0 text-end">Sort by</p>
					{{-- <div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input filter-sort" type="radio" value="favorite" name="sort" id="sortFavourite" onclick="checkRadio(this.value)" checked>
						<label class="form-check-label w-100" for="sortFavourite">
							Favourite
						</label>
					</div> --}}
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input filter-sort" type="radio" value="latest" name="sort" id="sortLatest" onclick="checkRadio(this.value)">
						<label class="form-check-label w-100" for="sortLatest">
							Lates Products
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input filter-sort" type="radio" value="high_low" name="sort" id="sortHight" onclick="checkRadio(this.value)">
						<label class="form-check-label w-100" for="sortHight">
							Price High to Low
						</label>
					</div>
					<div class="form-check form-check-reverse text-start py-2 m-0 border-bottom">
						<input class="form-check-input filter-sort" type="radio" value="low_high" name="sort" id="sortLow" onclick="checkRadio(this.value)">
						<label class="form-check-label w-100" for="sortLow">
							Price Low to High
						</label>
					</div>
				</div>
			</form>
			<div class="mt-auto d-flex gap-1">
				<button class="btn btn-light fs-inherit w-100" onclick="resetFilter()">Reset</button>
				<button class="btn btn-dark fs-inherit w-100" onclick="applyFilter()">Apply</button>
			</div>
		</div>
	</div>
</div>
<!-- END OF SORT PRODUCT -->

<!-- MODAL -->

<div class="modal fade popup modal-middle"  data-bs-backdrop="static" data-bs-keyboard="false" id="modalAddtocart" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="modalAddtocartLabel" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title opacity-25" id="modalAddtocartLabel">Add to cart</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="modal-cart-body">
			</div>
			<div class="modal-footer" id="modal-cart-footer">
			</div>
		</div>
	</div>
</div>

@endsection
<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
<script>

	const products 	 = @json($product_models);
	let productForms = @json($product_forms);
	let collections  = @json($product_collection);	
	let objfilter  	 = {};
	$(document).ready(function(){
		const queryString 	= window.location.search;
		const urlParams 	= new URLSearchParams(queryString);
		let form 			= urlParams.get('form');
		let collection 		= urlParams.get('collection');
		let sorting 		= urlParams.get('sorting');

		form 		= form == null ? "all" : form;
		collection 	= collection == null ? "all" : collection;
		sorting 	= sorting == null ? "all" : sorting;

		objfilter = {"collection":collection,"form":form,"sorting":sorting};
		actionFilteredProduct();
		setFilterPanelValue();
	});

	async function actionFilteredProduct(){		
		const res = await triggerTabCollection(objfilter.collection);
		if (res == "success"){
			const resAppend = await appendProduct(objfilter.collection, objfilter.form, objfilter.sorting);
		}
	}

	function showProduct(id) {
		appendProduct(id, objfilter.form, objfilter.sorting);
	}

	function triggerTabCollection(id){
		return new Promise((resolve) => {
			$("#nav-"+id+"-tab").click();
			resolve("success");
		});
	}

	function appendProduct(collection, form, sorting){
		return new Promise((resolve) => {
			
			displayFormsFilterWithCollection(collection);

			let filteredProductForAppend = products;

			if (form != "all"){
				filteredProductForAppend = filterFormProduct(form, filteredProductForAppend);
			}
			if (collection != "all"){
				filteredProductForAppend = filterCollectionProduct(collection, filteredProductForAppend);
			}
			if (sorting != "all"){
				filteredProductForAppend = sortingProduct(sorting, filteredProductForAppend);
			}
			
			let str = '';
			$.each(filteredProductForAppend, function(i, item){

				const urlToDetail 	= "{{ url('fproducts') }}/"+item.id;
				const imageNotFound = "{{ url('files') }}/imagenotavailable.jpg";
				const urlImage 		= "{{ url('files/product-images') }}/";
				item.disc_event     = item.disc_event == null ? "" : item.disc_event;

				str += '<div class="col col-product mb-4 mb-xxl-5">'+
							'<div class="card card-product border-0 rounded-0 text-center">'+
								'<div class="card-header position-relative p-0 rounded-0 border-0" style="background-color: white">'+
									'<a href="'+urlToDetail+'" class="text-text-decoration-none">';

									if (item.images == null){
										str += '<img loading="lazy" class="img-fluid" src="'+imageNotFound+'">'+
												'<img loading="lazy" class="img-fluid" src="'+imageNotFound+'">';
									} else {
										if (item.images.length > 1){
											str += '<img loading="lazy" class="img-fluid" src="'+urlImage+item.images[0]+'">'+
													'<img loading="lazy" class="img-fluid" src="'+urlImage+item.images[1]+'">';
										} else {
											str += '<img loading="lazy" class="img-fluid" src="'+urlImage+item.images[0]+'">';
										}
									}

								

								str += '</a>';
								if ( item.id == '164' || item.id == '165')
								{
									str +=	'';
								}
								else
								{

									str +=	'<button onclick="showModalAddtoCart(\''+item.id+'\')" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">'+
										'<i class="bi bi-cart-plus"></i>'+
										'</button>';
								}
							
								
									str +='</div>';
									str += '<div class="card-body text-capitalize px-0 pb-0">'+
									'<div class="cart-title fw-bold lh-sm">'+item.product_name+" "+item.disc_event+'</div>'+
									'<div class="cart-text my-1">'+item.product_weight+'g</div>'+
									'<div class="harga-produk mb-0">'+
										'<span class="harga-promo d-flex justify-content-center align-items-center gap-2">';
											
										if (item.disc_event != null && item.disc_event != ""){
											str += '<span class="harga-setelah-diskon">$ '+item.product_price_after_disc.toFixed(2)+'</span>'+
													'<span class="harga-awal">$ '+item.product_price+'</span>';
										} else {
											str += '<span class="harga-normal">$ '+item.product_price+'</span>';
										}

										str +='</span>'+
										'</div>'+
									'</div>'+
								'<button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">'+
									'<i class="bi bi-bookmark-fill"></i>'+
								'</button>';

								if (item.disc_event != null && item.disc_event != ""){
									str += '<div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE '+item.disc_event+'%</div>';
								}
								
							str +='</div>'+
							'</div>';
			});
			$("#list-product-"+collection).html(str);
			// end
			resolve("success");
		})
	}

	function filterFormProduct(form, listProduct){
		const arrForm = form.split("-");
		if (arrForm.length > 1){

			// filter IN
			let listProductFiltered = [];
			$.each(arrForm, function(i, itemForm){
				let filteredProductForm = listProduct.filter(function(item){
					return item.product_form === parseInt(itemForm);
				});
				
				$.each(filteredProductForm, function(n, itemFiltered){
					listProductFiltered.push(itemFiltered);
				})
			});
			return listProductFiltered;
		} else {

			// filter WHERE
			let filteredProductForm = listProduct.filter(function(item){
				return item.product_form === parseInt(form);
			});
			return filteredProductForm;
		}
	}

	function filterCollectionProduct(collection, listProduct){
		let filteredProduct = listProduct.filter(p=>p.product_collection == collection);
		return filteredProduct;
	}

	function sortingProduct(type, listProduct){
		if (type == "latest"){
			listProduct.sort(function(a,b){
				return b.id - a.id
			})
		} else if (type == "high_low"){
			listProduct.sort(function(a,b){
				return b.product_price - a.product_price
			})
		} else if (type == "low_high"){
			listProduct.sort(function(a,b){
				return  a.product_price - b.product_price
			})
		} else {
			// default sorting
			listProduct.sort(function(a,b){
				return a.id - b.id
			})
		}
		return listProduct;
	}

	function resetFilter(){
		const checboxForms = $(".checkbox-form");
		$.each(checboxForms, function(i, item){
			const isChecked = $(item).is(":checked");
			if (!isChecked){
				$(item).prop("checked", true);
			}
		});

		const elRadio = $(".filter-sort");
		$.each(elRadio, function(i, item){
			const isChecked = $(item).is(":checked");
			if (isChecked){
				$(item).prop("checked", false);
			}
		});

		objfilter.form 		= "all";
		objfilter.sorting 	= "all";
	}

	function checkRadio(radiovalue){
		objfilter.sorting = radiovalue;
	}

	function filterForm(){
		const checboxForms = $(".checkbox-form");
		let str = "";
		let n = 0;
		$.each(checboxForms, function(i, item){
			const isChecked = $(item).is(":checked");
			if (isChecked){
				if (n == 0)
					str = $(item).val();
				else
					str += "-"+$(item).val();
				n++;	
			}
		});
		
		str = str == "" ? "all" : str;
		objfilter.form = str;
		console.log(str);
	}

	function applyFilter(){
		actionFilteredProduct();
	}

	function setFilterPanelValue(){
		const sorting = objfilter.sorting;
		const strForm = objfilter.form;
		const arrForm = strForm.split('-');	

		const elForm  = $(".checkbox-form");
		$.each(elForm, function(i, item){

			if (arrForm != "" && arrForm != "all")
			{
				const valueFromParameter = $(item).val();
				const filteredParamForm = arrForm.filter(p=>p === valueFromParameter);
				const toBeChecked = filteredParamForm != null && filteredParamForm.length > 0;
	
				if (toBeChecked)
					$(item).prop('checked', true);
				else
					$(item).prop('checked', false);

			} else {
				$(item).prop('checked', true);
			}
		});

		const elSorting = $(".filter-sort");
		$.each(elSorting, function(i, item){
			
			const toBeChecked = sorting == $(item).val();
			if (toBeChecked)
				$(item).prop('checked', true);
		});
	}

	function displayFormsFilterWithCollection(id){
		if (id == "all"){
			$.each(productForms, function(i, item){
				$("#form-check-"+item.id).show();
			});
		} else {
			const collectionId = parseInt(id);
			var items = [];
			
			$.each(collections, function(c,collection){
				if (collection.id == collectionId) {
					items = collection.forms;
				}
			});

			$.each(productForms, function(i, item){
				const filteredCollectionForm = items.filter(p=>p.product_form === parseInt(item.id));
				const toBeShow = filteredCollectionForm != null && filteredCollectionForm.length > 0;
				if (toBeShow)
					$("#form-check-"+item.id).show();
				else
					$("#form-check-"+item.id).hide();
			});
		}
	}

	function showModalAddtoCart(id){
		console.log(id);
		const productSelected = products.filter(p=>p.id == id);
		if (productSelected.length == 0)
			return false;
		
		const item = productSelected[0];
		console.log(item);
		
		let urImg = "{{ url('files/'.'imagenotavailable.jpg') }}";
		if (item.images.length > 0)
			urImg = "{{ url('files/product-images/')}}/"+item.images[0];
		let elImg = '<img class="img-fluid" src="'+urImg+'"/>';

		
		let productPrice = item.product_price;
		let strDiscEvent = '<span class="harga-normal">$ <span id="detail-chart-price">'+item.product_price+'</span></span>';
		if (item.disc_event != null && item.disc_event != ""){
			strDiscEvent = '<span class="harga-setelah-diskon">$ <span id="detail-chart-price">'+item.product_price_after_disc+'</span></span>' +
										'<span class="harga-awal">$ '+item.product_price+'</span>';
			productPrice = item.product_price_after_disc;							
		}
			
		let strBody = '';
		strBody += '<div class="container-fluid">'+
						'<div class="row">'+
							'<div class="col-lg-4">' + elImg +
							'</div>' +
							'<div class="col-lg-8 text-capitalize">' +
								'<p class="mb-2">' +item.product_collection_name+ '</p>' +
								'<h4 class="gotham-bold mb-3">' +item.product_name+ '</h4>'+
								'<h5 class="harga-produk mb-3">' +
									'<span class="harga-promo">' +
										strDiscEvent +
									'</span>' +
								'</h5>' +
								'<p>' +
									'<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>' +
									'<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>' +
									'<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>' +
									'<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>' +
									'<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>' +
									'<span class="ms-3">(3 x Reviews)</span>' +
								'</p>' +
								'<p class="text-justify small" style="text-transform: initial;">' +
									item.product_detail +
								'</p>' +
							'</div>' +
						'</div>' +
					'</div>';

		let urlAction = "{{ route('cart.store') }}";
		
		let strFooter = '';
		strFooter += '<div class="container-fluid px-0">'+
					'<div class="row">'+
						'<div class="col-12">'+
							'<hr class="opacity-100 mt-0">'+
							'<div class="d-flex align-items-center justify-content-between mb-3">'+
									'<div class="input-group align-items-center w-auto">'+
										'<span class="input-group-btn">'+
											'<button type="button" class="btn border-0 fs-5 p-0 btn-number"  data-type="minus" data-field="quant[2]" onclick="btnMinus()">'+
												'<i class="bi bi-dash-circle"></i>'+
											'</button>'+
          								'</span>'+
          								'<input type="text" name="quant[2]" id="detail-running-number" class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold" value="1" min="1" max="100" style="max-width: 55px"'+
										  'disabled>'+
										'<span class="input-group-btn">'+
											'<button type="button" class="btn border-0 fs-5 p-0 btn-number" data-type="plus" data-field="quant[2]" onclick="btnPlus()">'+
												'<i class="bi bi-plus-circle"></i>'+
											'</button>'+
										'</span>'+
									'</div>'+
									'<span class="ms-3">item added to your Cart</span>'+
									'<div class="fw-bold fs-5">Subtotal : $ <span id="detail-chart-sum">'+productPrice+'</span></div>'+					
							'</div>'+
							'<hr class="opacity-100">'+
						'</div>'+
						'<div class="col-12 d-lg-flex flex-nowrap gap-lg-1">'+
						'<form action="'+urlAction+'" method="POST" enctype="multipart/form-data" class="d-md-flex w-100 gap-3">'+
							'@csrf'+
							'<input type="hidden" value="'+item.id+'" name="id">'+
							'<input type="hidden" value="'+item.product_name+'" name="name">'+
							'<input type="hidden" name="quant[2]" value="1" id="qty-product">'+
							'<input type="hidden" value="'+item.product_weight+'" name="gramature">'+
							'<input type="hidden" value="'+productPrice+'" name="price">';

							let imageName = "imagenotavailable.jpg";
							if (item.images.length > 0){
								imageName = item.images[0];
							}

							strFooter += '<input type="hidden" value="'+imageName+'" name="images">';

						strFooter += '<button name="addCartContinueShopping" data-bs-dismiss="modal" class="btn btn-light w-100 mb-2 mb-md-0"  onclick="$(\'#loading\').collapse(\'show\');">Continue Shopping</button>'+
							'<button name="addCartContinueCart" data-bs-dismiss="modal" class="btn btn-dark w-100 mb-2 mb-lg-0"  onclick="$(\'#loading\').collapse(\'show\');">Shopping Cart & Checkout</button>'+
                    	  '</form>'+
						'</div>'+
					'</div>'+
				'</div>';

		$("#modal-cart-body").html(strBody);	
		$("#modal-cart-footer").html(strFooter);	
		$("#modalAddtocart").modal("show");
	}

	function btnPlus(){
		const stPrice = $("#detail-chart-price").text();
		let price 	  = parseFloat(stPrice);
		let qty 	  = $("#qty-product").val();
		qty 	= parseInt(qty) + 1;
		let sum = price * qty;

		$("#detail-chart-sum").html(sum.toFixed(2));
		$("#qty-product").val(qty);
		$("#detail-running-number").val(qty);
	}

	function btnMinus(){
		const stPrice = $("#detail-chart-price").text();
		let price 	  = parseFloat(stPrice);
		let qty 	  = $("#qty-product").val();
		qty 	= parseInt(qty) - 1;
		let sum = price * qty;

		if (qty < 1)
			return false;

		$("#detail-chart-sum").html(sum.toFixed(2));
		$("#qty-product").val(qty);
		$("#detail-running-number").val(qty);
	}

</script>