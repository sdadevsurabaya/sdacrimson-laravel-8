@extends('front/layout')

@section('konten')
    <!-- detail product section -->
    <section>
        <div class="container">
            <div class="row">

                <!-- header menu -->
                <div class="col-12">
                    <div class="pt-4 d-flex justify-content-between d-lg-none">
                        <a href="/fnews" class="btn btn-lg border-0 rounded-0">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <a href="/cart" class="btn btn-lg border-0 rounded-0 position-relative">
                            {{-- <i class="bi bi-cart"></i>
                            <span
                                class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle-x"
                                style="font-size: .55em;">+99</span> --}}
                        </a>
                    </div>
                    <div class="d-none d-lg-block mb-4">
                        <a href="/fnews" class="text-inherit">
                            <i class="bi bi-chevron-left"></i> Back To List News
                        </a>
                    </div>
                </div>
                <!-- end of header menu -->

                <!-- foto produk -->
                <div class="col-lg-6 col-xl-5 col-xxl-auto mb-5 mb-lg-0">
                    <div id="fotoDetailCoffee" class="carousel slide d-lg-flex align-items-start" data-bs-ride="false">
                        <div class="carousel-inner mb-3 mb-lg-0 order-lg-2">

                            {{-- @if (strstr($product_models->product_name, 'Gift Set')) --}}

                            <div class="position-relative" id="coffeeVariant">
                                <img src="{{ url('files/news-images/' . $news_detail->image) }}" class="img-fluid"
                                    alt="">
                                {{-- <div id="imageleft"></div>
                                    <div id="imageright"></div> --}}
                            </div>
                            {{-- @else
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
                            @endif --}}


                            <!-- slider control -->

                            <!-- end of slider control -->
                        </div>
                        {{-- @if (strstr($product_models->product_name, 'Gift Set'))
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
                        @endif --}}

                    </div>
                </div>
                <!-- end of foto produk -->

                <!-- kolom spesifikasi -->
                <div class="col-lg-6 col-xl-7 spesifikasi-produk ms-xxl-auto">
                    <p class="mb-2">News {{ $news_detail->updated_at }}</p>
                    <h3 class="gotham-bold fs-2 fs-lg-3">{{ $news_detail->title }}</h3>
                    {{-- <h4 class="harga-produk mb-0">
					<!-- <span class="harga-normal">S$ 7.50</span> -->
					<span class="harga-promo">
						<span class="harga-setelah-diskon me-3">S$ 6.55</span>
						<span class="harga-awal">S$7.50</span>
					</span>
				</h4> --}}
                    {{-- <div class="text-end">
					<button class="btn border-0 py-0 px-2 rounded-0"><i class="bi bi-bookmark-fill fs-5"></i></button>
					<button class="btn border-0 py-0 px-2 rounded-0"><i class="bi bi-share fs-5"></i></button>
				</div> --}}
                    {{-- <p>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star-fill"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>
					<a href="#" class="text-decoration-none text-inherit"><i class="bi bi-star"></i></a>
					<span class="ms-3">(3 x Reviews)</span>
				</p> --}}
                    <p>Author : {{ $news_detail->author }}</p>

                    <p class="text-justify">{!! $news_detail->text !!}</p>


                </div>
                <!-- end of kolom spesifikasi -->



            </div>
        </div>
    </section>
    <!-- edn of detail product section -->

    {{-- <section>
        <div class="container">
            <div class="row g-1 g-md-2 g-lg-3">
                <div class="col-12 mt-0"><img src="ui/img/detail/image1.png" class="img-fluid" alt=""></div>
                <div class="col-6"><img src="ui/img/detail/image2.png" class="img-fluid" alt=""></div>
                <div class="col-6"><img src="ui/img/detail/image3.png" class="img-fluid" alt=""></div>
            </div>
        </div>
    </section> --}}

    <!-- alternate product -->
    <section>
        <div class="container">
            <h5 class="gotham-bold mb-4">Others News</h5>
            <div id="sliderAlternateProduct" class="carousel carousel-dark slide carousel-product" data-bs-ride="carousel"
                data-bs-pause="false">
                <div class="carousel-inner">

                    <!-- product item -->
                    <!-- untuk produk out of stock add class 'out-stock' on 'card-product', add class 'd-none' on 'wobler' when prodcut didn't have discount, harga produk ada dua pilihan 'harga-normal' dan 'harga-promo' -->
                    @foreach ($res_news as $item)
                        @if ($loop->index == 0)
                            <div class="carousel-item row flex-nowrap gx-xxl-5 bg-white active" >
                            @else
                                <div class="carousel-item row flex-nowrap gx-xxl-5 bg-white">
                        @endif

                        <div class="col-auto col-product">
                            <div class="card card-product border-0 rounded-0 text-center">
                                <div class="card-header position-relative p-0 rounded-0 border-0">
                                    <a href="/fnews/{{ $item->id }}" class="text-text-decoration-none">
                                        <img src="{{ url('files/news-images/' . $item->image) }}" class="img-fluid">
                                        <img src="{{ url('files/news-images/' . $item->image) }}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="card-body text-capitalize px-0 pb-0">
                                    <div class="cart-title fw-bold lh-sm">{{ $item->title }}</div>

                                    <div class="harga-produk mb-0">

                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                @endforeach
               

            </div>

            <!-- carousel control/ navigator slider -->
            <div class="carousel-control d-none d-md-block">
                <button
                    class="carousel-control-prev justify-content-end align-items-start bg-white translate-middle-y py-4"
                    type="button" data-bs-target="#sliderAlternateProduct" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" style="width: 40px; height: 40px;"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Preview</span>
                </button>
                <button
                    class="carousel-control-next justify-content-end align-items-start bg-white translate-middle-y py-4"
                    type="button" data-bs-target="#sliderAlternateProduct" data-bs-slide="next">
                    <span class="carousel-control-next-icon" style="width: 40px; height: 40px;"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
        </div>
    </section>
@endsection

@section('popup')
    <!-- navigasi menu detail product -->


    <!-- toast/ notifikasi add product -->
@endsection
