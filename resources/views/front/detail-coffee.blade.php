@extends('front/layout')

@section('konten')

{{-- <style>
    footer.d-lg-block {
        display: none!important;
    }
</style> --}}

    <!-- detail product section -->
    <section>
        <div class="container">
            <div class="row">

                <!-- header menu -->
                <div class="col-12">
                    <div class="pt-4 d-flex justify-content-between d-lg-none">
                        <a href="/fproducts" class="btn btn-lg border-0 rounded-0">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <a href="/fcart" class="btn btn-lg border-0 rounded-0 position-relative">
                            <i class="bi bi-cart"></i>
                            <span
                                class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle-x"
                                style="font-size: .55em;">{{ Cart::getTotalQuantity() }}</span>
                        </a>
                    </div>
                    <div class="d-none d-lg-block mb-4">
                        <a href="/fproducts" class="text-inherit">
                            <i class="bi bi-chevron-left"></i> Continue Shopping
                        </a>
                    </div>
                </div>

                <script type="text/javascript">
                    $(window).on('load', function() {
                        $('#myModal').modal('show');
                    });
                </script>
                <!-- end of header menu -->
                <!-- foto produk -->
                <div class="col-lg-6 col-xl-5 col-xxl-auto mb-5 mb-lg-0">
                    <div id="fotoDetailCoffee" class="carousel slide d-lg-flex align-items-start" data-bs-ride="false">
                        <div class="carousel-inner mb-3 mb-lg-0 order-lg-2">

                            @if (strstr($product_models->product_name, 'Gift Set'))

                                <div class="position-relative" id="coffeeVariant">
                                    <img src="{{ url('files/product-images/' . $product_models->images[0]) }}" class="img-fluid" alt="">
                                    <div id="imageleft"></div>
                                    <div id="imageright"></div>
                                </div>
                            @else
                                @if (empty($product_models->images))
                                    <img class="img-fluid" src="{{ url('files/' . 'imagenotavailable.jpg') }}">
                                @else
                                    @foreach ($product_models->images as $imgs)
                                        @if ($loop->index == 0)
                                            <div class="carousel-item active">
                                                <img src="{{ url('files/product-images/' . $imgs) }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img src="{{ url('files/product-images/' . $imgs) }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                <div class="carousel-control">
                                    <button class="carousel-control-prev text-dark" type="button"
                                        data-bs-target="#fotoDetailCoffee" data-bs-slide="prev">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="carousel-control-next text-dark" type="button"
                                        data-bs-target="#fotoDetailCoffee" data-bs-slide="next">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                </div>
                            @endif


                            <!-- slider control -->
                            
                            <!-- end of slider control -->
                        </div>
                        @if (strstr($product_models->product_name, 'Gift Set'))
                        <!-- tidak muncul gambar samping jika gift set -->
                        @else
                         <!-- slider indicators/ thumbnail image -->
                         <div class="carousel-indicators me-lg-2">

                            @if (empty($product_models->images))
                                <img class="img-fluid" src="{{ url('files/' . 'imagenotavailable.jpg') }}">
                            @else
                                @foreach ($product_models->images as $imgs)
                                    <button type="button" data-bs-target="#fotoDetailCoffee"
                                        data-bs-slide-to="{{ $loop->index }}" class="rounded overflow-hidden active"
                                        aria-current="true" aria-label="Slide {{ $loop->index }}">
                                        <img src="{{ url('files/product-images/' . $imgs) }}" class="img-fluid">
                                    </button>
                                @endforeach
                            @endif

                        </div>
                        <!-- end of slider indicators/ thumbnail image -->
                        @endif
                       
                    </div>
                </div>
                <!-- end of foto produk -->

                <!-- kolom spesifikasi -->
                <div class="col-lg-6 col-xl-7 spesifikasi-produk ms-xxl-auto">
                    <p class="mb-2">{{ $product_models->product_collection_name }} /
                        {{ $product_models->product_weight }}g</p>
                    <input type="hidden" id="weight" name="weight" value="{{ $product_models->product_weight }}">
                    <h3 class="gotham-bold">{{ $product_models->product_name }}</h3>
                    <h4 class="harga-produk mb-0">
                        <!-- <span class="harga-normal">S$ 7.50</span> -->
                        <span class="harga-promo">
                            @if (!empty($product_models->disc_event))
                                $<span class="harga-setelah-diskon" id="Harga">
                                    {{ $product_models->product_price_after_disc }}</span>
                                <span class="harga-awal">S$ {{ $product_models->product_price }}</span>
                            @else
                                $<span class="harga-normal" id="Harga"> {{ $product_models->product_price }}</span>
                            @endif
                            {{-- <span class="harga-setelah-diskon me-3">$ 6.55</span>
						<span class="harga-awal">${{$product_models->product_price}}</span> --}}
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
                        <span class="ms-3">(3 Reviews)</span>
                    </p>
                    <p>{{ $product_models->product_shortdetail }}</p>
                    <div class="row row-cols-1 row-cols-lg-2">
                        <div class="col">
                            <p>{{ $product_models->acidity_desc }}
                                @if ($product_models->product_acidityscore == 0)
                                    <img src="../ui/img/rating/bulat0.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_acidityscore == 0.5)
                                    <img src="../ui/img/rating/bulat0-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_acidityscore == 1)
                                    <img src="../ui/img/rating/bulat1.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_acidityscore == 1.5)
                                    <img src="../ui/img/rating/bulat1-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_acidityscore == 2)
                                    <img src="../ui/img/rating/bulat2.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_acidityscore == 2.5)
                                    <img src="../ui/img/rating/bulat2-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_acidityscore == 3)
                                    <img src="../ui/img/rating/bulat3.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_acidityscore == 3.5)
                                    <img src="../ui/img/rating/bulat3-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_acidityscore == 4)
                                    <img src="../ui/img/rating/bulat4.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_acidityscore == 4.5)
                                    <img src="../ui/img/rating/bulat4-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @else
                                    <img src="../ui/img/rating/bulat5.svg" width="87.5" height="auto" class="ms-3">
                                @endif
                            </p>
                            <p>{{ $product_models->body_desc }}
                                @if ($product_models->product_bodyscore == 0)
                                    <img src="../ui/img/rating/bulat0.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_bodyscore == 0.5)
                                    <img src="../ui/img/rating/bulat0-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_bodyscore == 1)
                                    <img src="../ui/img/rating/bulat1.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_bodyscore == 1.5)
                                    <img src="../ui/img/rating/bulat1-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_bodyscore == 2)
                                    <img src="../ui/img/rating/bulat2.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_bodyscore == 2.5)
                                    <img src="../ui/img/rating/bulat2-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_bodyscore == 3)
                                    <img src="../ui/img/rating/bulat3.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_bodyscore == 3.5)
                                    <img src="../ui/img/rating/bulat3-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @elseif($product_models->product_bodyscore == 4)
                                    <img src="../ui/img/rating/bulat4.svg" width="87.5" height="auto" class="ms-3">
                                @elseif($product_models->product_bodyscore == 4.5)
                                    <img src="../ui/img/rating/bulat4-5.svg" width="87.5" height="auto"
                                        class="ms-3">
                                @else
                                    <img src="../ui/img/rating/bulat5.svg" width="87.5" height="auto" class="ms-3">
                                @endif

                            </p>
                        </div>
                        <div class="col">
                            <p>{{ $product_models->product_roastdesc }}</p>
                            <p>{{ $product_models->product_typedesc }}</p>
                        </div>
                    </div>
                    <p class="text-justify" style="text-transform: initial;">
                        {{ $product_models->product_detail }}
                    </p>



                    <p>
                        @if (strstr($product_models->product_name, 'Gift Set'))
                            add Product to Gift Set
                            <br>

                            <!-- code untuk memunculkan gambar di tengah -->
                            {{-- <div class="position-relative" id="coffeeVariant">
                                <img src="../assets/images/GIFTSETISIGELAS.png" class="img-fluid" alt="">
                                <div id="imageleft"></div>
                                <div id="imageright"></div>
                            </div> --}}

                            <p class="mb-4 d-flex justify-content-between align-items-center">
                                <a data-bs-toggle="collapse" href="#menuCoffeeset" class="text-inherit fw-bold">
                                    <u>Include 2 Cans Coffee Beans</u> <i class="bi bi-chevron-right"></i>
                                 </a>
                                <button onclick="reload()" class="btn p-0 fw-bold d-flex align-items-center border-0">
                                    <i class="bi bi-arrow-counterclockwise fs-4 me-2"></i>
                                    <span>Reset <span class="d-none d-md-inline">Items</span></span>
                                </button>
                            </p>

                           

                            <div class="collapse show" id="menuCoffeeset">
                                <div class="row row-cols-1 row-cols-md-2 mb-2 g-3 mb-4">
                                    <div class="col">
                                        <button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(1,  'Sumatra-Mandheling-Coffee-Beans','15,10', 1, 200, 'Sumatra-Mandheling-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/Sumatra-Mandheling-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            Sumatra
                                            Mandheling Coffee Beans <div id="btngiftset1"></div></button> 
                                        </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(8,  'Signature-Blend-Coffee-Beans','14,30', 1, 200, 'Signature-Blend-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Signature-Blend-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Signature
                                            Blend Coffee Beans <div id="btngiftset8"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(9,  'Exotic-Blend-Coffee-Beans', '9,90', 1, 200, 'Exotic-Blend-Coffee-Beans-200g-1.png' )">
                                            <img src="../files/product-images/Exotic-Blend-Coffee-Beans-200g-1.png" class="img-fluid" alt="">
                                            Exotic
                                            Blend Coffee Beans <div id="btngiftset9"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(10, 'Lumiere-Blend-Coffee-Beans','10,80', 1, 200, 'Supresso-Lumiere-Blend-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/Supresso-Lumiere-Blend-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            Lumiere
                                            Blend Coffee Beans <div id="btngiftset10"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(13, 'Espresso-Blend-Coffee-Beans','12,50', 1, 200, 'Espresso-Blend-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/Espresso-Blend-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            Espresso
                                            Blend Coffee Beans <div id="btngiftset13"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(16, 'Equilibre-Blend-Coffee-Beans','11,50', 1, 200, 'Equilibre-Blend-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/Equilibre-Blend-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            Equilibre
                                            Blend Coffee Beans <div id="btngiftset16"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(23, 'Bali-Kintamani-Coffee-Beans','14,30', 1, 200, 'Bali-Kintamani-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Bali-Kintamani-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Bali
                                            Kintamani Coffee Beans <div id="btngiftset23"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(25, 'Aceh-Gayo-Coffee-Beans','14,60', 1, 200, 'Aceh-Gayo-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Aceh-Gayo-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Aceh
                                            Gayo Coffee Beans <div id="btngiftset25"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(28, 'Toraja-Kalosi-Coffee-Beans','14,30', 1, 200, 'Toraja-Kalosi-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Toraja-Kalosi-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Toraja
                                            Kalosi Coffee Beans <div id="btngiftset28"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(33, 'Peaberry-Coffee-Beans','17,10', 1, 200, 'Peaberry-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Peaberry-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Peaberry
                                            Coffee Beans <div id="btngiftset33"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(37, 'Lampung-Coffee-Beans', '8,80', 1, 200, 'Lampung-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Lampung-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Lampung
                                            Coffee Beans <div id="btngiftset37"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(41, 'Flores-Bajawa-Coffee-Beans','14,30', 1, 200, 'Flores-Bajawa-Coffee-benas-200-1.png' )">
                                            <img src="../files/product-images/Flores-Bajawa-Coffee-benas-200-1.png" class="img-fluid" alt="">
                                            Flores
                                            Bajawa Coffee Beans <div id="btngiftset41"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(46, 'Sumatra-Mandheling-Rainforest-Coffee-Be','15,90', 1, 200, 'Sumatra-Mandheling-Rainforest-Coffee-benas-200-1.png' )">
                                            <img src="../files/product-images/Sumatra-Mandheling-Rainforest-Coffee-benas-200-1.png" class="img-fluid" alt="">
                                            Sumatra
                                            Mandheling Rainforest Coffee Beans <div id="btngiftset46"></div></button>
                                    </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(47, 'Java-Arabica-Organic-Coffee-Beans','14,30', 1, 200, 'Java-Arabica-Organic-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Java-Arabica-Organic-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Java
                                            Arabica Organic Coffee Beans <div id="btngiftset47"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(55, 'Papua-Coffee-Beans','15,90', 1, 200, 'Papua-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Papua-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Papua
                                            Coffee Beans <div id="btngiftset55"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(113, 'Manglayang-Coffee-Beans','14,30', 1, 200, 'Manglayang-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Manglayang-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Manglayang
                                            Coffee Beans <div id="btngiftset113"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(114, 'Java-Coffee-Beans','10,50', 1, 200, 'Java-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/Java-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            Java
                                            Coffee Beans <div id="btngiftset114"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(115, 'West-Java-Coffee-Beans','10,80', 1, 200, 'West-Java-Coffee-beans-200-1.png' )">
                                            <img src="../files/product-images/West-Java-Coffee-beans-200-1.png" class="img-fluid" alt="">
                                            West
                                            Java Coffee Beans <div id="btngiftset115"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(120, 'BaliCafe-Arabica-Gold-Coffee-Beans','19,00', 1, 200, 'BaliCafe-Arabica-Gold-Coffee-Beans-1.png' )">
                                            <img src="../files/product-images/BaliCafe-Arabica-Gold-Coffee-Beans-1.png" class="img-fluid" alt="">
                                            BaliCafe
                                            Arabica Gold Coffee Beans <div id="btngiftset120"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(127, 'BaliCafe-Robusta-Coffee-Beans','11,00', 1, 200, 'BaliCafe-Robusta-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/BaliCafe-Robusta-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            BaliCafe
                                            Robusta Coffee Beans <div id="btngiftset127"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(128, 'BaliCafe-Peaberry-Robusta-Coffee-Beans','14,50', 1, 200, 'BaliCafe-Peaberry-Robusta-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/BaliCafe-Peaberry-Robusta-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            BaliCafe
                                            Peaberry Robusta Coffee Beans <div id="btngiftset128"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(129, 'BaliCafe-Sunset-Blend-Coffee-Beans','15,00', 1, 200, 'BaliCafe-Sunset-Blend-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/BaliCafe-Sunset-Blend-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            BaliCafe
                                            Sunset Blend Coffee Beans <div id="btngiftset129"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(132, 'BaliCafe-Luwak-Arabica-Coffee-Beans','110,00', 1, 200, 'BaliCafe-Luwak-Arabica-Coffee-Beans-100-1.png' )">
                                            <img src="../files/product-images/BaliCafe-Luwak-Arabica-Coffee-Beans-100-1.png" class="img-fluid" alt="">
                                            BaliCafe
                                            Luwak Arabica Coffee Beans <div id="btngiftset132"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(153, 'Ombre-Blend-Coffee-Beans','10,30', 1, 200, 'Ombre-Blend-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/Ombre-Blend-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            Ombre
                                            Blend Coffee Beans <div id="btngiftset153"></div></button> </div>
                                    <div class="col"><button id="freeacehgayo"
                                            class="btn btn-sm btn-outline-dark w-100 position-relative"
                                            onclick="addtoproductgiftset(156, 'Decafeine-Blend-Coffee-Beans','16,00', 1, 200, 'Decafeine-Blend-Coffee-Beans-200-1.png' )">
                                            <img src="../files/product-images/Decafeine-Blend-Coffee-Beans-200-1.png" class="img-fluid" alt="">
                                            Decafeine
                                            Blend Coffee Beans <div id="btngiftset156"></div></button> </div>
                                </div>
                                <style>
                                    #menuCoffeeset .btn {
                                       position: relative;
                                       text-align: left;
                                       text-transform: capitalize;
                                       display: flex;
                                       align-items: center;
                                       flex-wrap: nowrap;
                                    }
                  
                                    #menuCoffeeset .btn img {
                                       max-width: 60px;
                                    }
                  
                                    #menuCoffeeset .btn .badge {
                                       position: absolute;
                                       top: 0;
                                       left: 100%;
                                       transform: translate(-50%, -50%);
                                       width: 21px;
                                       height: 21px;
                                       border-radius: 100%;
                                       color: white;
                                       background-color: #fd4f00;
                                       padding: 3px;
                                       display: flex;
                                       align-items: center;
                                       justify-content: center;
                                    }
                                 </style>
                            </div>
                        @else
                            Not Gift Set
                        @endif
                    </p>



                    {{-- <p>
                        <a data-bs-toggle="collapse" href="#tablePackaging" class="text-inherit">
                            <u>packaging configurations</u> <i class="bi bi-chevron-right"></i>
                        </a>
                    </p> --}}
                    <div class="collapse" id="tablePackaging">
                        <div class="table-responsive mb-4">
                            <table class="table table-sm table-borderless table-striped text-center"
                                style="width: 735px;">
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
                                <img src="../ui/img/detail/kopi.png"
                                    class="img-fluid float-lg-end w-lg-auto img-fluid-lg-unset" alt="">
                            </div>

                            <!-- How to serve -->
                            <div class="col-lg-6 spesifikasi-produk">
                                <h3 class="gotham-bold">How to serve</h3>
                                <p class="text-justify mb-4">
                                    Grown in the highlands of Kintamani, this coffee has unique characteristics derived from
                                    wet processing method, making them slightly sweeter. The mild body of the coffee exudes
                                    a clean light and refreshing taste exhibiting a citrusy, fruity ﬁnish. It is a must-try
                                    for those who do not like the bitter taste.
                                </p>
                                <div class="row row-cols-auto g-4">
                                    <div class="col"><img src="../ui/img/detail/french-press.svg" width="100"
                                            class="img-fluid" alt=""></div>
                                    <div class="col"><img src="../ui/img/detail/siphon.svg" width="100"
                                            class="img-fluid" alt=""></div>
                                    <div class="col"><img src="../ui/img/detail/pour-over.svg" width="100"
                                            class="img-fluid" alt=""></div>
                                    <div class="col"><img src="../ui/img/detail/coffee-maker.svg" width="100"
                                            class="img-fluid" alt=""></div>
                                    <div class="col"><img src="../ui/img/detail/espresso-machine.svg" width="100"
                                            class="img-fluid" alt=""></div>
                                </div>
                                <hr class="my-4">
                                <ul class="media list-unstyled mb-0">
                                    <li class="media-item">
                                        <div class="media-header">1.</div>
                                        <div class="media-body">
                                            <p>
                                                Grown in the highlands of Kintamani, this coffee has unique characteristics
                                                derived from wet processing method, making them slightly sweeter.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="media-item">
                                        <div class="media-header">2.</div>
                                        <div class="media-body">
                                            <p>
                                                Grown in the highlands of Kintamani, this coffee has unique characteristics
                                                derived from wet processing method, making them slightly sweeter.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="media-item">
                                        <div class="media-header">3.</div>
                                        <div class="media-body">
                                            <p>
                                                Grown in the highlands of Kintamani, this coffee has unique characteristics
                                                derived from wet processing method, making them slightly sweeter.
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
                                                        <div class="progress-bar bg-dark w-100" role="progressbar"
                                                            aria-label="Basic example" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media-item align-items-center">
                                                <div class="media-header fs-5 fw-bold text-center">4</div>
                                                <div class="media-body">
                                                    <div class="progress rounded-pill">
                                                        <div class="progress-bar bg-dark w-75" role="progressbar"
                                                            aria-label="Basic example" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media-item align-items-center">
                                                <div class="media-header fs-5 fw-bold text-center">3</div>
                                                <div class="media-body">
                                                    <div class="progress rounded-pill">
                                                        <div class="progress-bar bg-dark w-50" role="progressbar"
                                                            aria-label="Basic example" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media-item align-items-center">
                                                <div class="media-header fs-5 fw-bold text-center">2</div>
                                                <div class="media-body">
                                                    <div class="progress rounded-pill">
                                                        <div class="progress-bar bg-dark w-25" role="progressbar"
                                                            aria-label="Basic example" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media-item align-items-center">
                                                <div class="media-header fs-5 fw-bold text-center">1</div>
                                                <div class="media-body">
                                                    <div class="progress rounded-pill">
                                                        <div class="progress-bar bg-dark w-0" role="progressbar"
                                                            aria-label="Basic example" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i>
                                            1</button>
                                        <button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i>
                                            2</button>
                                        <button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i>
                                            3</button>
                                        <button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i>
                                            4</button>
                                        <button class="btn btn-outline-dark fs-inherit"><i class="bi bi-star-fill"></i>
                                            5</button>
                                    </div>
                                </div>
                                <ul class="media list-unstyled reviews-list mb-0">
                                    <li class="media-item">
                                        <img src="../ui/img/user/user.jpg" class="img-thumbnail rounded-circle p-0 me-3"
                                            alt="">
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
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="media-item">
                                        <img src="../ui/img/user/user.jpg" class="img-thumbnail rounded-circle p-0 me-3"
                                            alt="">
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
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="media-item">
                                        <img src="../ui/img/user/user.jpg" class="img-thumbnail rounded-circle p-0 me-3"
                                            alt="">
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
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat.
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
@endsection

@section('popup')
    <!-- navigasi menu detail product -->
    <div id="navDetailProduct" class="fixed-bottom">
        <nav class="nav py-3 border-top" style="background-color: #f1f2f2;">
            <div class="container">
                <div class="row justify-content-lg-between align-items-lg-center">
                    <div class="col-lg-auto col-xl-8 col-xxl-7 order-lg-2">
                        <div class="row justify-content-md-between">

                            {{-- <div class="col-md-auto mb-2 d-sm-flex align-items-center mb-md-4 mb-lg-0">
                                <div class="me-2" style="min-width: 60px;"><span class="d-none d-md-inline">Coffee</span> Form</div>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-dark fs-inherit active">Beans</button>
                                    <button class="btn btn-sm btn-outline-dark fs-inherit">Ground</button>
                                    <button class="btn btn-sm btn-outline-dark fs-inherit">Drip</button>
                                    <button class="btn btn-sm btn-outline-dark fs-inherit">Capsules</button>
                                </div>
                            </div> --}}

                            <div class="col-md-auto mb-2 d-sm-flex align-items-center mb-md-4 mb-lg-0">
                                <div class="me-2 d-inline" style="min-width: 60px;"><span
                                        class="d-none d-md-inline">Coffee</span> Form</div>
                                <div class="btn-group">

                                    @foreach ($product_form as $items)
                                        @if ($items->product_form == $product_models->product_form)
                                            <button class="btn btn-sm btn-outline-dark fs-inherit active"
                                                onclick="myFunction({{ $items->product_collection }},{{ $items->product_form }},{{ $items->product_variant }})">{{ $items->product_form_name }}</button>
                                        @else
                                            <button class="btn btn-sm btn-outline-dark fs-inherit"
                                                onclick="myFunction({{ $items->product_collection }},{{ $items->product_form }},{{ $items->product_variant }})">{{ $items->product_form_name }}</button>
                                        @endif
                                    @endforeach

                                    {{-- @foreach ($product_models->variant as $items)
								
								
								<button class="btn btn-outline-dark fs-inherit" onclick="myFunction({{$items->product_form}},{{$items->product_variant}})">form{{$items->product_form}}-variant{{$items->product_variant}}-{{$items->product_form_name}}</button>
							
								
								@endforeach --}}


                                    {{-- <button class="btn btn-outline-dark fs-inherit active">Beans</button>
								<button class="btn btn-outline-dark fs-inherit">Ground</button>
								<button class="btn btn-outline-dark fs-inherit">Drip</button>
								<button class="btn btn-outline-dark fs-inherit">Capsules</button> --}}
                                </div>
                            </div>
                            <div class="col-md-auto mb-4 d-sm-flex align-items-center mb-md-4 mb-lg-0">
                                <div class="me-2" style="min-width: 60px;">Weight</div>

                                <div id="response">
                                    <div class="btn-group">
                                    {{-- @foreach ($product_models->variant as $items)
								<button class="btn btn-outline-dark fs-inherit">{{$items->product_weight}}g</button>
								@endforeach --}}

                                        @foreach ($product_weight as $weight)
                                            @if ($weight->product_weight == $product_models->product_weight)
                                                {{-- onclick='myWeightFunction("+response.data[i].id+","+response.data[i].product_collection+","+response.data[i].product_form+","+response.data[i].product_variant+" --}}
                                                <button class="btn btn-sm btn-outline-dark fs-inherit active"
                                                    onclick="myWeightFunction({{ $weight->id }},{{ $weight->product_collection }},{{ $weight->product_form }},{{ $weight->product_variant }})">{{ $weight->product_weight }}g</button>
                                            @else
                                                <button class="btn btn-sm btn-outline-dark fs-inherit"
                                                    onclick="myWeightFunction({{ $weight->id }},{{ $weight->product_collection }},{{ $weight->product_form }},{{ $weight->product_variant }})">{{ $weight->product_weight }}g</button>
                                            @endif
                                        @endforeach
                                    </div>
                                    {{-- <button class="btn btn-outline-dark fs-inherit active">200g</button>
								<button class="btn btn-outline-dark fs-inherit">500g</button>
								<button class="btn btn-outline-dark fs-inherit">1000g</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (strstr($product_models->product_name, 'Gift Set'))
                        <div class="col-auto order-lg-1 mb-4 mb-lg-0">
                            <div class="input-group">
                                {{-- <button class="btn border-0 fs-5 p-0" onclick="qtyminFunction()"><i
                                    class="bi bi-dash-circle"></i></button> --}}
                                <input id="qtypopup" type="hidden"
                                    class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold"
                                    value="1" min="1" max="100" style="max-width: 55px;" disabled
                                    onkeypress="return onlyNumberKey(event)">
                                {{-- <button class="btn border-0 fs-5 p-0" onclick="qtyplusFunction()"><i
                                    class="bi bi-plus-circle"></i></button> --}}
                            </div>
                        </div>
                    @else
                        <div class="col-auto order-lg-1 mb-4 mb-lg-0">
                            <div class="input-group">
                                <button class="btn border-0 fs-5 p-0" onclick="qtyminFunction()"><i
                                        class="bi bi-dash-circle"></i></button>
                                <input id="qtypopup" type="text"
                                    class="form-control rounded-0 bg-transparent text-center w-auto fs-5 p-0 border-0 fw-bold"
                                    value="1" min="1" max="100" style="max-width: 55px;" disabled
                                    onkeypress="return onlyNumberKey(event)">
                                <button class="btn border-0 fs-5 p-0" onclick="qtyplusFunction()"><i
                                        class="bi bi-plus-circle"></i></button>
                            </div>
                        </div>
                    @endif


                    <div class="col-auto order-lg-3 mb-4 ms-auto mb-lg-0 ms-lg-0">
                        <strong class="fw-bold fs-5">Total : $ <span id="totalnya">0.00</span></strong>
                    </div>
                    <div class="col-12 order-lg-4 mt-lg-3">


                        @if (strstr($product_models->product_name, 'Gift Set'))
                            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data"
                                onsubmit="return isValidForm()">
                                @csrf
                                <input type="hidden" value="1" name="giftset">

                                <div id="test"></div>


                                <input type="hidden" value="{{ $product_models->id }}" name="id">
                                <input type="hidden" value="{{ $product_models->product_name }}" name="name">

                                @if (!empty($product_models->disc_event))
                                    <input type="hidden" value="{{ $product_models->product_price_after_disc }}"
                                        name="price">
                                @else
                                    <input type="hidden" value="{{ $product_models->product_price }}" name="price">
                                @endif
                                {{-- <input type="hidden" value="{{ $product_models->product_price }}" name="price"> --}}
                                <input type="hidden" value="{{ $product_models->product_weight }}" name="gramature">
                                @if (!empty($product_models->images))
                                    <input type="hidden" value="{{ $product_models->images[0] }}" name="images">
                                @else
                                    <input type="hidden" value="imagenotavailable.jpg" name="images">
                                @endif

                                <input type="hidden" id="hiddenqty" value="1" name="quantity">
                                <button class="btn btn-dark w-100" id="btnAddcart"
                                    onclick="$('#loading').collapse('show');">Add To Cart GS<i
                                        class="bi bi-cart-plus"></i></button>
                            </form>
                        @else
                            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="0" name="giftset">
                                <input type="hidden" value="{{ $product_models->id }}" name="id">
                                <input type="hidden" value="{{ $product_models->product_name }}" name="name">

                                @if (!empty($product_models->disc_event))
                                    <input type="hidden" value="{{ $product_models->product_price_after_disc }}"
                                        name="price">
                                @else
                                    <input type="hidden" value="{{ $product_models->product_price }}" name="price">
                                @endif
                                {{-- <input type="hidden" value="{{ $product_models->product_price }}" name="price"> --}}
                                <input type="hidden" value="{{ $product_models->product_weight }}" name="gramature">
                                @if (!empty($product_models->images))
                                    <input type="hidden" value="{{ $product_models->images[0] }}" name="images">
                                @else
                                    <input type="hidden" value="imagenotavailable.jpg" name="images">
                                @endif

                                <input type="hidden" id="hiddenqty" value="1" name="quantity">
                                <button class="btn btn-dark w-100" id="btnAddcart"
                                    onclick="$('#loading').collapse('show');">Add To Cart<i
                                        class="bi bi-cart-plus"></i></button>
                            </form>
                        @endif




                        {{-- <button class="btn btn-dark w-100" id="btnAddcart">Add To Cart <i class="bi bi-cart-plus"></i></button> --}}
                    </div>
                </div>
            </div>
        </nav>
    </div>

    {{-- <div class="alert alert-success">
           
        </div> --}}

    {{-- @if (Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif --}}
    <!-- toast/ notifikasi add product -->
    @if (session('message'))
        <div class="toast-container position-absolute top-100 end-0">
            <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">1 x item added to your Cart</strong>
                    <small class="text-muted">11 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Please Check on Cart Menu
                    {{-- Hello, world! This is a toast message. --}}
                </div>
            </div>
        </div>


        <script>
            window.onload = (event) => {
                let myAlert = document.querySelector('.toast');
                let bsAlert = new bootstrap.Toast(myAlert);
                bsAlert.show();
            }
        </script>
    @endif
@endsection


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<Script>
    var qtyPopup = 0;
    var totalPopup = 0;
    var harga = 0;

    var arraygiftset = [];

    window.onload = codeAddress;

    function codeAddress() {
        qtyPopup = +document.getElementById("qtypopup").value;
        harga = +document.getElementById("Harga").innerHTML;
        document.getElementById("qtypopup").value = qtyPopup;
        calculated = qtyPopup * harga;
        document.getElementById("totalnya").innerHTML = calculated.toFixed(2);
    }




    function myFunction(collection, form, variant) {

        console.log("beratnya : ");
        console.log(document.getElementById("weight").value);
        var activeWeight = document.getElementById("weight").value;

        console.log("collection : " + collection);
        console.log("form : " + form);
        console.log("variant : " + variant);
        var bodyFormData = new FormData();
        // bodyFormData.append('id', 1);
        bodyFormData.append('id_variant', variant);
        bodyFormData.append('id_form', form);
        bodyFormData.append('id_collection', collection);
        axios({
                method: 'post',
                //   url: `http://127.0.0.1:8000/api/getWeightByVariant`,
                // url: `https://project-supresso.suryoatmojo.id/api/getWeightByVariant`,
                url: 'api/getWeightByVariant',
            })
            .then(response => {
                console.log(response.data);
                console.log("panjang : " + response.data.length)
                var weight = "";
                for (let i = 0; i < response.data.length; i++) {
                    console.log("weight.id : " + response.data[i].id);
                    console.log("weight.collection : " + response.data[i].product_collection);
                    console.log("weight.form : " + response.data[i].product_form);
                    console.log("weight.variant : " + response.data[i].product_variant);

                    if (response.data[i].product_weight == activeWeight) {
                        weight = weight +
                            "<button class='btn btn-outline-dark fs-inherit active' onclick='myWeightFunction(" +
                            response.data[i].id + "," + response.data[i].product_collection + "," + response.data[i]
                            .product_form + "," + response.data[i].product_variant + ")'>" + response.data[i]
                            .product_weight + "g</button>"
                    } else {
                        weight = weight +
                            "<button class='btn btn-outline-dark fs-inherit' onclick='myWeightFunction(" + response
                            .data[i].id + "," + response.data[i].product_collection + "," + response.data[i]
                            .product_form + "," + response.data[i].product_variant + ")'>" + response.data[i]
                            .product_weight + "g</button>"
                    }

                }
                weight = "<div class='btn-group'>" + weight + "</div>"
                document.getElementById("response").innerHTML = weight;

                //document.getElementById("response").innerHTML = "<button class='btn btn-outline-dark fs-inherit' onclick='myWeightFunction()'>"+response.data[0].product_weight+"g</button>";
            })
            .catch(error => {
                console.log('Error:' + error.message);
            });

    }

    function myWeightFunction(id, collection, form, variant) {
        window.location.href = "/fproducts/" + id;
    }


    function qtyminFunction(id, collection, form, variant) {
        if (qtyPopup > 1) {
            qtyPopup = +document.getElementById("qtypopup").value;
            harga = +document.getElementById("Harga").innerHTML;
            qtyPopup = qtyPopup - 1;
            document.getElementById("qtypopup").value = qtyPopup;
            calculated = qtyPopup * harga;
            document.getElementById("totalnya").innerHTML = calculated.toFixed(2);
            document.getElementById("hiddenqty").value = qtyPopup;
        }

    }

    function qtyplusFunction(id, collection, form, variant) {
        qtyPopup = +document.getElementById("qtypopup").value;
        harga = +document.getElementById("Harga").innerHTML;
        qtyPopup = qtyPopup + 1;
        document.getElementById("qtypopup").value = qtyPopup;
        calculated = qtyPopup * harga;
        document.getElementById("totalnya").innerHTML = calculated.toFixed(2);
        document.getElementById("hiddenqty").value = qtyPopup;
    }



    function onlyNumberKey(evt) {

        if (document.getElementById("qtypopup").value < 1) {
            document.getElementById("qtypopup").value = 1;
        }

        var aCode = event.which ? event.which : event.keyCode;
        if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;
        return true;
    }
</Script>

<script>
    function addtoproductgiftset(pid, pname, pprice, pgramature, pqty, pimage) {
        var product = {
            id: pid,
            name: pname,
            price: pprice,
            gramature: pgramature,
            qty: pqty,
            image: pimage
        };

        if (arraygiftset.length < 2) {

            if (arraygiftset.length == 0) {
                document.getElementById('imageleft').innerHTML = '<img src="../assets/images/CANSGIFTSETKIRI/' + pid +
                    'kiri.png" class="img-fluid position-absolute top-0 start-0" alt="" style="z-index: 5;">';
            } else if (arraygiftset.length == 1) {
                document.getElementById('imageright').innerHTML = '<img src="../assets/images/CANSGIFTSETKANAN/' + pid +
                    'kanan.png" class="img-fluid position-absolute top-0 start-0" alt="" style="z-index: 5;">';
            }

            var findproduct = arraygiftset.filter(p => p.id == pid)
            var countproduct = findproduct.length

            if (countproduct == 0) {
                document.getElementById('btngiftset' + pid).innerHTML =
                    '<span class="badge">1</span>';
            } else {
                document.getElementById('btngiftset' + pid).innerHTML =
                    '<span class="badge">2</span>';
            }

            arraygiftset.push(product);
        } else {
            alert('already choose 2 items');
        }
        console.log(arraygiftset);
        var prod = ''
        arraygiftset.forEach(element => {
            console.log(element);
            prod += '<input type="hidden"  name="giftsetproduct[]" value=' + JSON.stringify(element) + '>';
        });
        console.log(prod);
        //document.getElementById('giftsetproduct').value = JSON.stringify(arraygiftset);
        document.getElementById('test').innerHTML = prod;
    }
</script>

<script>
    function reload() {
        location.reload();
    }

    function isValidForm() {
        if (arraygiftset.length < 2) {
            alert("please choosen two items first!!")
            location.reload();
            return false
        } else {
            return true
        }
    }
</script>
