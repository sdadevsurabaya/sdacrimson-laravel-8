{{-- @extends('layouts.frontend') --}}
@extends('front/layout')
@section('konten')
    <!-- section of cart -->
    <section id="cartProduct">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-xl mb-5 mb-lg-0" id="cartList">
                    <div class="lh-sm mb-2">
                        <strong class="gotham-bold  fs-2 fs-lg-3">Shopping Cart.</strong> <input id="idmembers" type="hidden"
                            value="{{ $idmembers }}">
                        <br>
                        <!-- ambil total quantity dari cart -->
                        (A total of {{ Cart::getTotalQuantity() }} pcs)
                    </div>

                    <div class="table-responsive">
                        <table class="table-cart table table-borderless text-capitalize mb-xl-0" style="width: 695px;">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col" style="width: 125px;"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col" style="width: 105px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- non aktifkan komen untuk cek isi $cartitems -->
                                @php
                                    //dump($cartItems);
                                @endphp
                                <!-- cart item -->
                                <!-- looping semua barang dari cart -->
                                @foreach ($cartItems as $item)
                                    <!-- pengecekan apakah id barang tersebut gift-set -->
                                    @if (strpos($item->id, 'GIFT-SET') !== false)
                                        <!-- tidak ada reaksi apa apa jika gift-set -->
                                        <!-- barang gift set akan dimunculkan detail melalui gambar dari induknya gift set -->
                                    @else
                                        <!-- jika kondisi bukan barang gift-set -->
                                        <tr>
                                            <th scope="row">
                                                @if ($item->id == 'GIFT-' . Session::get('gift'))
                                                @elseif (strpos($item->id, 'REDEEM') !== false)

                                                @elseif (strpos($item->id, 'GIFT-SET') !== false)
                                                @else
                                                    <button class="btn border-0 btn-delete-cart p-0 lh-1 rounded-circle"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteCart{{ $item->id }}">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                @endif
                                            </th>
                                            <td>
                                                <!-- jika images kosong -->
                                                @if ($item->attributes->images == '')
                                                    <img src="{{ url('files/imagenotavailable.jpg') }}" class="img-fluid"
                                                        alt="">
                                                @else
                                                    <!-- jika images tidak kosong -->
                                                    <!-- jika item adalah gift set induk -->
                                                    @if (strpos($item->name, 'Gift Set') !== false)
                                                        <div class="position-relative" id="coffeeVariant">
                                                            <!-- munculkan background image gift set utama -->
                                                            <img src="../assets/images/GIFTSETISIGELAS.png"
                                                                class="img-fluid bg-transparent" alt="">
                                                            @php
                                                                $array = $cartItems;
                                                                $id = $item->id;
                                                                $idgift = 'GIFTSET' . $item->id;
                                                            @endphp
                                                            @php
                                                                $itemsname1 = '';
                                                                $itemsname2 = '';
                                                            @endphp
                                                            @php
                                                                $itemnumber = 0;
                                                                //dump($array);
                                                                $det = [];
                                                                $aname = [];
                                                            @endphp
                                                            @foreach ($array as $element)
                                                                @if ($element->attributes->types == $idgift && $element->id !== $id)
                                                                    @if ($element->quantity > 1)
                                                                        @for ($i = 0; $i < $element->quantity; $i++)
                                                                            @php
                                                                                array_push($det, explode('|', str_replace('GIFT-SET-', '', $element->id))[0]);
                                                                                array_push($aname, $element->name);
                                                                            @endphp
                                                                            {{-- @if ($i % 2 == 0)
                                                                            a
                                                                            <img src="../assets/images/CANSGIFTSETKIRI/{{ (explode("|",str_replace("GIFT-SET-","",$element->id)))[0] }}kiri.png" class="img-fluid position-absolute top-0 start-0 bg-transparent" alt="" style="z-index: 5;">
                                                                            @else
                                                                            b
                                                                            <img src="../assets/images/CANSGIFTSETKANAN/{{ (explode("|",str_replace("GIFT-SET-","",$element->id)))[0] }}kanan.png" class="img-fluid position-absolute top-0 start-0 bg-transparent" alt="" style="z-index: 10;">
                                                                            @endif  --}}
                                                                        @endfor
                                                                        @php
                                                                            $itemsname1 = $element->name;
                                                                            
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            array_push($det, explode('|', str_replace('GIFT-SET-', '', $element->id))[0]);
                                                                            array_push($aname, $element->name);
                                                                        @endphp
                                                                        {{-- @if ($loop->index % 2 == 0)
                                                                            c {{ $loop->index }}
                                                                            <img src="../assets/images/CANSGIFTSETKIRI/{{ (explode("|",str_replace("GIFT-SET-","",$element->id)))[0] }}kiri.png" class="img-fluid position-absolute top-0 start-0 bg-transparent" alt="" style="z-index: 5;">
                                                                            --}}
                                                                            {{-- @php $itemsname1 =$element->name @endphp --}}
                                                                            {{-- @else
                                                                            d {{ $loop->index }}
                                                                            <img src="../assets/images/CANSGIFTSETKANAN/{{ (explode("|",str_replace("GIFT-SET-","",$element->id)))[0] }}kanan.png" class="img-fluid position-absolute top-0 start-0 bg-transparent" alt="" style="z-index: 10;"> --}}
                                                                            {{-- @php $itemsname2 =$element->name @endphp --}}
                                                                            {{-- @endif  --}}

                                                                        {{-- {{ str_replace("GIFT-SET-","",$element->id) }} --}}
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            @php
                                                                //dump($aname);
                                                                $itemsname1 = $aname[0];
                                                                $itemsname2 = $aname[1];
                                                                
                                                            @endphp
                                                            <img src="../assets/images/CANSGIFTSETKIRI/{{ $det[0] }}kiri.png"
                                                                class="img-fluid position-absolute top-0 start-0 bg-transparent"
                                                                alt="" style="z-index: 5;">
                                                            <img src="../assets/images/CANSGIFTSETKANAN/{{ $det[1] }}kanan.png"
                                                                class="img-fluid position-absolute top-0 start-0 bg-transparent"
                                                                alt="" style="z-index: 10;">
                                                        </div>
                                                    @else
                                                        <img src="{{ url('files/product-images/' . $item->attributes->images) }}"
                                                            class="img-fluid" alt="">
                                                    @endif
                                                @endif

                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    @if ($item->id == 'GIFT-' . Session::get('gift'))
                                                        <strong style="color:#fd4f00">(FREE) </strong>
                                                    @elseif (strpos($item->id, 'REDEEM') !== false)
                                                        <strong style="color:#fd4f00">(REDEEM) </strong>
                                                    @endif
                                                    {{-- <strong>{{ $item->id }}-{{ $item->name }}</strong> --}}
                                                    <strong>{{ $item->name }}</strong>
                                                    <br>
                                                    {{ $item->attributes->gramature }}g
                                                    <br>

                                                    @if (strpos($item->name, 'Gift Set') !== false)
                                                        <span
                                                            style="font-size: 60%"><sup>1</sup>{{ str_replace('-', ' ', $itemsname1) }}</span>
                                                        <br>
                                                        @if (!empty($itemsname2))
                                                            <span
                                                                style="font-size: 60%"><sup>2</sup>{{ str_replace('-', ' ', $itemsname2) }}</span>
                                                        @endif
                                                    @endif
                                                </p>

                                                <div class="d-flex flex-nowrap gap-3" style="max-width: 100px;">
                                                    @php
                                                        $array = $cartItems;
                                                        $id = $item->id;
                                                        $idgift = 'GIFTSET' . $item->id;
                                                    @endphp
                                                    @foreach ($array as $element)
                                                        @if ($element->attributes->types == $idgift && $element->id !== $id)
                                                            <!-- jika barang yang dipilih adalah lebih dari satu atau barang yang dipilih sama -->
                                                            @if ($element->quantity > 1)
                                                                @for ($i = 0; $i < $element->quantity; $i++)
                                                                    <div class="bg-light rounded overflow-hidden">
                                                                        {{-- <img src="{{ url('files/product-images/' . $element->attributes->images) }}"
                                                                            class="img-fluid" alt=""
                                                                            data-bs-title="{{ $element->name }} {{ $element->attributes->gramature }}g"> --}}
                                                                    </div>
                                                                @endfor
                                                            @else
                                                                <!-- jika barang yang dipilih adalah 2 jenis barang yang berbeda -->
                                                                <div class="bg-light rounded overflow-hidden">
                                                                    {{-- <img src="{{ url('files/product-images/' . $element->attributes->images) }}"
                                                                        class="img-fluid" alt=""
                                                                        data-bs-title="{{ $element->name }} {{ $element->attributes->gramature }}g"> --}}
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <form class="mb-0" action="{{ route('cart.update') }}" method="POST">
                                                    <div class="input-group mx-4">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        @if ($item->id == 'GIFT-' . Session::get('gift'))
                                                            <button name="minus" class="btn border-0 fs-5 p-0" disabled><i
                                                                    class="bi bi-dash-circle"></i></button>
                                                            <input type="text" name="quantity" disabled
                                                                class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold"
                                                                value="{{ $item->quantity }}" min="1" max="100"
                                                                style="max-width: 55px;">
                                                            <button name="plus" class="btn border-0 fs-5 p-0" disabled><i
                                                                    class="bi bi-plus-circle"></i></button>
                                                        @elseif (strpos($item->name, 'Gift Set') !== false)
                                                            <button name="minus" disabled class="btn border-0 fs-5 p-0"
                                                                onclick="$('#loading').collapse('show')"><i
                                                                    class="bi bi-dash-circle"></i></button>
                                                            <input type="text" name="quantity"
                                                                class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold"
                                                                value="{{ $item->quantity }}" min="1" max="100"
                                                                style="max-width: 55px;" readonly {{-- disabled --}}
                                                                onkeypress="return onlyNumberKey(event)">
                                                            <button name="plus" disabled class="btn border-0 fs-5 p-0"
                                                                onclick="$('#loading').collapse('show')"><i
                                                                    class="bi bi-plus-circle"></i></button>
                                                        @else
                                                            <button name="minus" class="btn border-0 fs-5 p-0"
                                                                onclick="$('#loading').collapse('show')"><i
                                                                    class="bi bi-dash-circle"></i></button>
                                                            <input type="text" name="quantity"
                                                                class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold"
                                                                value="{{ $item->quantity }}" min="1"
                                                                max="100" style="max-width: 55px;" readonly
                                                                {{-- disabled --}}
                                                                onkeypress="return onlyNumberKey(event)">
                                                            <button name="plus" class="btn border-0 fs-5 p-0"
                                                                onclick="$('#loading').collapse('show')"><i
                                                                    class="bi bi-plus-circle"></i></button>
                                                        @endif
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="harga-produk">
                                                    <div
                                                        class="harga-normal fs-5 fw-bold text-end d-flex justify-content-between">
                                                        <span>$</span> <span>{{ $item->price }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg sidepanel ms-lg-auto">
                    <div class="rounded h-100" style="background-color: #f1f2f2;">
                        <div class="container-fluid py-3 h-100">
                            <div class="row align-content-between h-100">
                                <div class="col-12">
                                    <!-- info free gift -->
                                    @if ($statusfreegift == 'false')
                                        <div class="collapse show" id="giftThumbnail">
                                            <div class="row align-items-center py-4">
                                                <div class="col-4">
                                                    {{-- <img src="ui/img/cart/giftbox.png" class="img-fluid" alt=""> --}}
                                                    <img src="{{ url('files/product-images/' . $gift_box_images) }}"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <div class="col-8">
                                                    {{-- <p class="fw-bold mb-2">Just add "<span data-bs-toggle="modal" data-bs-target="#modalGift">$30.50</span>" more to receive a FREE gift box this season of gifting!</p> --}}
                                                    <p class="fw-bold mb-2">Just add "
                                                        {{-- <span data-bs-toggle="modal" data-bs-target="#modalGift"> --}}
                                                        ${{ $product_free_gift_models[0]->gift_box_minimum_order - Cart::getSubTotal() }}
                                                        {{-- </span> --}}
                                                        "
                                                        more to receive a FREE
                                                        {{ $product_free_gift_models[0]->product_name }} this season of
                                                        gifting!</p>
                                                    <a href="/coffee" class="text-inherit"><u>Continue Shopping <i
                                                                class="bi bi-chevron-right"></i></u></a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endif

                                    {{-- @if ($statusfreegift == 'false')
                                        <div class="row align-items-center py-4">
                                        <div class="col-4">
                                            <img src="{{ url('files/product-images/'.$gift_box_images) }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-8">
                                            <p class="fw-bold mb-2">Just add "${{$product_free_gift_models[0]->gift_box_minimum_order-Cart::getSubTotal()}}" more to receive a FREE {{$product_free_gift_models[0]->product_name}} this season of gifting!</p>
                                            <a href="/fproducts" class="text-inherit"><u>Continue Shopping <i class="bi bi-chevron-right"></i></u></a>
                                        </div>
                                        </div>
                                    @endif --}}

                                    {{-- <hr> --}}

                                    <!-- subtotal -->
                                    <div class="row mb-3">
                                        <div class="col-7"><strong>Subtotal</strong></div>
                                        <div class="col-5 d-flex justify-content-between"><span>$</span>
                                            <span>{{ Cart::getSubTotal() }}</span>
                                        </div>
                                    </div>

                                    @if (empty(Auth::user()))
                                        <form action="{{ route('cart.updatediscount') }}" method="POST">
                                            @csrf
                                            <!-- vouchers -->
                                            <div class="input-group align-items-center mb-2 bg-white rounded"
                                                id="triggerInputVouchers">
                                                @if (!empty($coupon))
                                                    <input type="text" disabled type="text" name="coupon"
                                                        class="form-control border-0 text-center"
                                                        placeholder="vouchers Code" value="{{ $coupon }}">
                                                @else
                                                    <input type="text" disabled type="text" name="coupon"
                                                        class="form-control border-0 text-center"
                                                        placeholder="vouchers Code">
                                                @endif
                                                <input id="modal-membersvouchers-id" name="coupon-id" type="hidden"
                                                    class="form-control text-center" placeholder="Type Vouchers Code or"
                                                    value="{{ $couponid }}">
                                                <input id="modal-membersvouchers-status" name="coupon-status"
                                                    type="hidden" class="form-control text-center"
                                                    placeholder="Type Vouchers Code or" value="{{ $couponstatus }}">
                                                <button name="resetdiscount" class="btn" disabled><i
                                                        class="bi bi-x-circle"></i></button>
                                            </div>
                                            <div class="alert alert-danger alert-dismissible fade show text-capitalize"
                                                role="alert">
                                                <i class="bi bi-exclamation-triangle-fill"></i> required member
                                                registration to use this promo code. <a href="/login"
                                                    class="alert-link"><u>login to my account</u></a>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{ route('cart.updatediscount') }}" method="POST">
                                            @csrf
                                            <!-- vouchers -->
                                            <div class="input-group align-items-center mb-2 bg-white rounded"
                                                id="triggerInputVouchers">
                                                @if (!empty($coupon))
                                                    <input type="text" type="text" name="coupon"
                                                        class="form-control border-0 text-center"
                                                        placeholder="vouchers Code" value="{{ $coupon }}">
                                                @else
                                                    <input type="text" type="text" name="coupon"
                                                        class="form-control border-0 text-center"
                                                        placeholder="vouchers Code">
                                                @endif
                                                <input id="membersvouchers-id" name="coupon-id" type="hidden"
                                                    class="form-control text-center" value="{{ $couponid }}">
                                                <input id="membersvouchers-status" name="coupon-status" type="hidden"
                                                    class="form-control text-center" value="{{ $couponstatus }}">
                                                <button name="resetdiscount" class="btn"><i
                                                        class="bi bi-x-circle"></i></button>
                                            </div>
                                            <div class="alert alert-danger alert-dismissible fade text-capitalize"
                                                role="alert">
                                                <i class="bi bi-exclamation-triangle-fill"></i> required member
                                                registration to use this promo code. <a href="/login"
                                                    class="alert-link"><u>login to my account</u></a>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </form>

                                    @endif
                                    <!-- discount -->
                                    <div class="row">
                                        <div class="col-7">Discount</div>
                                        <div class="col-5 d-flex justify-content-between"><span>$</span>
                                            <span>{{ $discount }}</span>
                                        </div>
                                    </div>

                                    <hr class="opacity-50">
                                    <!-- total -->
                                    <div class="row fw-bold fs-5 mb-5">
                                        <div class="col-7">Total</div>
                                        <div class="col-5 d-flex justify-content-between"><span>$</span>
                                            <span>{{ Cart::getTotal() }}</span>
                                        </div>
                                    </div>
                                </div>


                                @if (empty(Auth::user()))
                                    <div class="col-12">
                                        <a href="/login" class="btn btn-lg btn-dark w-100">Checkout</a>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <a href="/fcheckouts" class="btn btn-lg btn-dark w-100">Checkout</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section of alternate product -->
    <section>
        <div class="container">
            <h4 class="gotham-bold text-center mb-5">
                Before you checkout, consider to
            </h4>
        </div>
    </section>
@endsection

@section('popup')
    <!-- konfirmasi delete product item in the cart list -->
    @foreach ($cartItems->sortBy('id') as $itemcart)
        <div class="modal fade modal-middle" id="deleteCart{{ $itemcart->id }}" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="deleteCartLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title opacity-25" id="deleteCartLabel">
                            <i class="bi bi-exclamation-circle"></i>
                            Delete Cart Item
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <h4 class="fw-bold mb-4">Are you sure wanna remove this product from your cart ?</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row align-items-center">
                                        <div class="col-4 col-md-5">
                                            <img src="{{ url('files/product-images/' . $itemcart->attributes->images) }}"
                                                class="img-fluid rounded" style="background-color: #f1f2f2;"
                                                alt="">
                                            {{-- <img src="ui/img/product/produk1.png" class="img-fluid rounded" style="background-color: #f1f2f2;" alt=""> --}}
                                        </div>
                                        <div class="col-8 col-md-7">
                                            <div class="text-capitalize">
                                                <strong>{{ $itemcart->name }}</strong>
                                                <br>{{ $itemcart->attributes->gramature }}g
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-nowrap">
                        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('cart.remove') }}" method="POST" class="w-100">
                            @csrf
                            <input type="hidden" value="{{ $itemcart->id }}" name="id">
                            <button class="btn btn-primary w-100">Delete Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- success moved to whistlist/ delete cart item -->
    <div class="modal fade modal-middle" id="modalMoveWhistlist" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalMoveWhistlistLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title opacity-25" id="modalMoveWhistlistLabel">
                        <i class="bi bi-exclamation-circle"></i>
                        Moved to Whistlist
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="bi bi-check-circle text-success fs-1"></i>
                                </div>
                                <div class="col">
                                    <h4 class="fw-bold mb-0"> Succees remove product from your cart ?</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none">
                            <div class="col-md-8">
                                <div class="row align-items-center">
                                    <div class="col-4 col-md-5">
                                        <img src="ui/img/product/produk1.png" class="img-fluid rounded"
                                            style="background-color: #f1f2f2;" alt="">
                                    </div>
                                    <div class="col-8 col-md-7">
                                        <div class="text-capitalize">
                                            <strong>sumatra mandheling coffee capsules</strong>
                                            <br>200g
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap">
                    <a href="#" class="btn btn-secondary w-100">Check Whistlist</a>
                    <a href="/coffee" class="btn btn-primary w-100">Continue Shop</a>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL NIPUT VOUCHERS -->
    <div class="modal fade modal-middle" id="modalInputVouchers" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="modalInputVouchers" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-block border-0">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="modal-title opacity-25">Claim Vouchers</h5>
                        <div>
                            <small>Cancel</small>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                    </div>
                    <form action="{{ route('cart.updatediscount') }}" method="POST">
                        <div class="input-group">

                            @csrf
                            <input id="modal-membersvouchers" name="coupon" type="text"
                                class="form-control text-center" placeholder="Type Vouchers Code or">
                            <input id="modal-membersvouchers-id" name="coupon-id" type="hidden"
                                class="form-control text-center" placeholder="Type Vouchers Code or">
                            <input id="modal-membersvouchers-status" name="coupon-status" type="hidden"
                                class="form-control text-center" placeholder="Type Vouchers Code or">
                            <button id="modal-adddiscount" type="submit" name="adddiscount" class="btn btn-dark">Apply
                                <span class="d-none d-sm-inline">Vouchers</span></button>
                            {{-- <input type="submit" id="adddiscount-test" value="Apply" /> --}}

                        </div>
                    </form>
                    <p></p>
                </div>
                <div id="membersvouchers" class="modal-body py-0"></div>
                <div class="modal-footer border-0"></div>
            </div>
        </div>
    </div>


    <!-- MODAL GIFT -->
    <div class="modal fade modal-middle" id="modalGift" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="modalGift" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" id="inner-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title opacity-25">Choose Your Gift</h5>
                    <div id="itemchosen"> </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid px-0">
                        <div class="row row-cols-2 row-cols-lg-3 text-center g-1 g-lg-2 g-xl-3">
                            <!-- gift item -->

                            @foreach ($product_free_gift_models as $items)
                                <div class="col gift-item"
                                    onclick="choosegift({{ $items->product_id }},'{{ $items->product_name }}','{{ $items->product_weight }}g')">
                                    <div class="card border-0 h-100">
                                        <div class="card-header border-0 bg-transparent">
                                            {{-- <img src="{{ $items->attributes->images }}ui/img/cart/giftbox.png" class="card-img" alt=""> --}}
                                            <img src="{{ url('files/product-images/' . $items->gift_box_images) }}"
                                                class="img-fluid" alt="">
                                        </div>
                                        <div class="card-body pt-0">
                                            <p class="card-text fw-semibold">{{ $items->product_name }}-
                                                {{ $items->product_weight }}g</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="buttonchoosegift"></div>
                    {{-- <button class="btn btn-primary" id="triggerCloseGift" data-bs-dismiss="modal"
                        onclick="submitchoosegift()">Submit <i class="bi bi-chevron-right"></i></button> --}}
                </div>
            </div>
        </div>
    </div>
    <style>
        .gift-item .card {
            cursor: pointer;
            background-color: white;
            max-width: 210px;
            margin: 0 auto;
        }

        .gift-item .card:hover {
            background-color: #f1f2f2;
        }
    </style>
    <script src="{{ URL::asset('/ui/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var idgift = null;

        window.onload = function() {
            showModalGift();
            getMembersVouchers();
        }

        function showModalGift() {
            const statusShow = {{ $statusshowfreegift }}
            const isFreeGift = {{ $statusfreegift }};
            console.log(statusShow);

            if (statusShow && isFreeGift) {
                $("#modalGift").modal("show");
            }
        }

        function submitchoosegift() {
            $('#loading').collapse('show');
            console.log(idgift);
            // alert("anda pilih gift : "+idgift);
            var bodyFormData = new FormData();
            bodyFormData.append('id', idgift);
            axios({
                    method: 'post',
                    // url: `http://127.0.0.1:8000/choosegift`,
                    //url: `https://project-supresso.suryoatmojo.id/choosegift`,
                    url: 'choosegift',
                    data: bodyFormData,

                })
                .then(response => {
                    console.log("test");
                    console.log(response.data);

                    //alert("pilih gift : "+idgift+" done");
                    window.location.reload(true);


                })
                .catch(error => {
                    console.log('Error:' + error.message);
                });
        }

        function choosegift(id, name, weight) {
            document.getElementById('itemchosen').innerHTML = "<h6>" + name + "-" + weight + "</h6>";
            document.getElementById('buttonchoosegift').innerHTML = "<button class='btn btn-primary' id='triggerCloseGift' data-bs-dismiss='modal' onclick='submitchoosegift()'>Submit <i class='bi bi-chevron-right'></i></button>";
            idgift = id;
            // alert("anda pilih gift : "+id);
            console.log(idgift);
        }

        function getMembersVouchers() {
            var bodyFormData = new FormData();
            var url = "<?php echo url('/'); ?>";
            console.log(url);
            var membersvouchers = '';
            bodyFormData.append('idmembers', document.getElementById('idmembers').value);
            axios({
                    method: 'post',
                    //url: `http://127.0.0.1:8000/api/getVouchersByIdMembers`,
                    //url: `https://project-supresso.suryoatmojo.id/api/getVouchersByIdMembers`,
                    url: 'api/getVouchersByIdMembers',
                    data: bodyFormData,

                })
                .then(response => {
                    console.log(response.data);
                    for (let m = 0; m < response.data.length; m++) {
                        var kodecoupon = "'" + response.data[m].kodecoupon + "','" + response.data[m].id + "','" +
                            response.data[m].jenis_voucher + "'";
                        //console.log(kodecoupon);
                        // var kodecoupon = 'ay001';
                        if (response.data[m].type == 'persen') {
                            var content =
                                '<div class="form-check ps-0 mb-2"><input class="form-check-input d-none" type="radio" name="flexRadioDefault" id="vouchers' +
                                m + '"  onclick="setUsedVouchers(' + kodecoupon +
                                ')"><label class="form-check-label w-100" for="vouchers' + m +
                                '"><div class="card"><div class="card-body"><p class="text-end mb-2"><small>23 Oct" 22 - 02 Nov" 22</small></p><h5 class="gotham-bold mb-0">Diskon ' +
                                response.data[m].nominal +
                                '% untuk member karyawan</h5><p class="mb-0">Min. transaksi -</p></div></div></label></div>';

                        }
                        membersvouchers = membersvouchers + content;
                        // console.log(content);
                    }

                    document.getElementById("membersvouchers").innerHTML = membersvouchers;



                })
                .catch(error => {
                    console.log('Error:' + error.message);
                });
        }

        function setUsedVouchers(kodecoupon, id, status) {
            console.log("masuk");
            document.getElementById("modal-membersvouchers").value = kodecoupon;
            document.getElementById("modal-membersvouchers-id").value = id;
            document.getElementById("modal-membersvouchers-status").value = status;

            document.getElementById("membersvouchers-id").value = id;
            document.getElementById("membersvouchers-status").value = status;
            console.log(kodecoupon);
            console.log(id);
            console.log(status);

            //alert(cpn);
            document.getElementById("modal-adddiscount").click();
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
