@foreach ($product_models_modal as $product)
<div class="modal fade popup modal-middle"  data-bs-backdrop="static" data-bs-keyboard="false" id="modalAddtocart{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="modalAddtocartLabel" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title opacity-25" id="modalAddtocartLabel">Add to cart</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4">
							@if(empty($product->images))
								<img class="img-fluid" src="{{ url('files/'.'imagenotavailable.jpg') }}">
								
								@else
									@if(count($product->images) > 1)
									<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[0]) }}">
									@else
									<img class="img-fluid" src="{{ url('files/product-images/'.$product->images[0]) }}">
									@endif
								@endif

							</div>
						<div class="col-lg-8 text-capitalize">
							<p class="mb-2">{{$product->product_collection_name}}</p>
							<h4 class="gotham-bold mb-3">{{$product->product_name}}</h4>
							<h5 class="harga-produk mb-3">
								<span class="harga-promo">
									@if(!empty($product->disc_event))
										<span class="harga-setelah-diskon">$ {{$product->product_price_after_disc}}</span>
										<span class="harga-awal">$ {{$product->product_price}}</span>
									@else
										<span class="harga-normal">$ {{$product->product_price}}</span>
									@endif
								</span>
							</h5>
							<p>
								<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
								<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
								<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
								<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>
								<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>
								<span class="ms-3">(3 x Reviews)</span>
							</p>
							<p class="text-justify small" style="text-transform: initial;">
								{{$product->product_detail}}
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="container-fluid px-0">
					<div class="row">
						<div class="col-12">
							<hr class="opacity-100 mt-0">
							<div class="d-flex align-items-center justify-content-between mb-3">
									<div class="input-group align-items-center w-auto">
										<span class="input-group-btn">
											<button type="button" class="btn border-0 fs-5 p-0 btn-number"  data-type="minus" data-field="quant[2]">
												<i class="bi bi-dash-circle"></i>
											</button>
          								</span>
          								<input type="text" name="quant[2]" class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold" value="1" min="1" max="100" style="max-width: 55px"
										  disabled
										  onkeypress="return onlyNumberKey(event)">
										<span class="input-group-btn">
											<button type="button" class="btn border-0 fs-5 p-0 btn-number" data-type="plus" data-field="quant[2]">
												<i class="bi bi-plus-circle"></i>
											</button>
										</span>
									</div>
										<span class="ms-3">item added to your Cart</span>
									</div>								
									@if(session('modal'))
										<div class="fw-bold fs-5">Subtotal : $ {{Cart::getContent()[session('modal')]->getPriceSum()}}</div>
									@endif
							</div>
							<hr class="opacity-100">
						</div>
						<div class="col-12 d-lg-flex flex-nowrap gap-lg-1">

						<form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" class="d-md-flex w-100 gap-3">
							@csrf
							<input type="hidden" value="{{ $product->id }}" name="id">
							<input type="hidden" value="{{ $product->product_name }}" name="name">
							<input type="hidden" name="quant[2]" value="1">
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

                       
						<button name="addCartContinueShopping" data-bs-dismiss="modal" class="btn btn-light w-100 mb-2 mb-md-0"  onclick="$('#loading').collapse('show');">Continue Shopping</button>
						<button name="addCartContinueCart" data-bs-dismiss="modal" class="btn btn-dark w-100 mb-2 mb-lg-0"  onclick="$('#loading').collapse('show');">Shopping Cart & Checkout</button>
						
                    	</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endforeach

<script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>

@if(session('modal'))
	<script>
	window.onload = (event)=> {
		var php_var = "<?php echo session('modal'); ?>";
		$('#modalAddtocart'+php_var).modal('show');
	}
	</script>
@else
	<script>
	window.onload = (event)=> {
		var qty = 1;
	}
</script>
@endif

<script>
var qty = 1;

$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                //$(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

function change(value){
	console.log(qty);
	console.log(value);
	
	qty = qty + 1
	console.log(qty);
    document.getElementById("quantitys").value = 5;
}

function onlyNumberKey(evt) {

if (document.getElementById("qtypopup").value < 1) {
	document.getElementById("qtypopup").value = 1;
}

var aCode = event.which ? event.which : event.keyCode;
if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;
return true;
}
</script>