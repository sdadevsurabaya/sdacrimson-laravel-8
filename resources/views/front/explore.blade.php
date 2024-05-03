@extends('front/layout')

@section('konten')
    <script>
        document.getElementById("navexplore").classList.add("active");
    </script>
    <section class="mb-5">
        <div class="container-fluid container-lg">
            <div class="row align-items-lg-center">
                <div class="col-lg-auto mb-5 order-lg-2 mb-lg-0">
                    <div class="px-xl-5">
                        <h5 class="gotham-bold">
                            Explore your variant
                        </h5>
                        <select name="explore" id="explore" class="custom-select w-auto rounded-0" onchange="myFunction()">
                            <option value="1" selected>Aceh</option>
                            <option value="2">Sumatra Mandheling</option>
                            <option value="3">Sumatra Mandheling Rainforest</option>
                            <option value="4">Lampung</option>
                            <option value="5">Peaberry</option>
                            <option value="6">Manglayang</option>
                            <option value="7">West Java</option>
                            <option value="8">Java</option>
                            <option value="9">Bali Kintamani</option>
                            <option value="10">Flores Bajawa</option>
                            <option value="11">Toraja Kalosi</option>
                            <option value="12">Papua</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg order-lg-1 pe-0 pe-lg-3">
                    <div id="maps"> <img src="ui/img/maps/aceh.svg" class="img-fluid w-100" alt=""></div>

                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="container product-specification">
            <div class="row justify-content-lg-between">
                <div class="col-lg-5">
                    <h3 class="gotham-bold fs-1 fs-lg-3">

                        <div id="caption">Aceh Gayo</div>
                    </h3>
                    <p class="variant-text">
                    <div id="deskripsi">
                        Aceh Gayo coffee is often used in most coffee shops commonly for cafe latte. It has light earthy
                        notes with a mild body and bittersweet spicy chocolate taste. Soft in acidity, this coffee reveals
                        some elegant caramel-fruity flavours, marrying a perfect combination of spicy and sweet. Its unique
                        taste will make you crave for more.
                    </div>

                    </p>
                </div>
                <div class="col-lg-5">
                    <ul class="list-group list-group-flush text-capitalize font-weight-bold">
                        <li class="list-group-item px-0 text-uppercase">
                            <div id="shortdes">Spicy - Caramel & Chocolaty - Fruity - Slightly Earthy Notes</div>
                        </li>

                        <li class="list-group-item px-0 text-md-left">
                            <div class="row">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <div id="acidity">
                                        <p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p>
                                        <img src="ui/img/bulat/bulat3-5.svg" alt="">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div id="body">
                                        <p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p>
                                        <img src="ui/img/bulat/bulat3.svg" alt="">
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 text-md-left">
                            <div class="row">
                                <div class="col-md-6 mb-2 mb-md-0">full city roast</div>
                                <div class="col-md-6">100% arabica coffee</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <style>
        .variant-text {
            text-align: justify;
            text-align-last: center;
        }

        @media (min-width: 992px) {
            .variant-text {
                text-align-last: left;
            }

            .product-specification .col-lg-5 {
                max-width: 460px;
                flex-basis: 460px;
            }
        }

        @media (min-width: 1200px) {
            .product-specification .col-lg-5 {
                max-width: 520px;
                flex-basis: 520px;
            }
        }
    </style>

    <section>
        <div class="container">
            <div id="product-list" class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">

                {{-- <div ></div> --}}

                <!-- product item -->
                <!-- untuk produk out of stock add class 'out-stock' on 'card-product', add class 'd-none' on 'wobler' when prodcut didn't have discount, harga produk ada dua pilihan 'harga-normal' dan 'harga-promo' -->
                {{-- <div class="col col-product mb-4 mb-xxl-5">
                    <div class="card card-product border-0 rounded-0 text-center">
                        <div class="card-header position-relative p-0 rounded-0 border-0">
                            <a href="/detail-coffee" class="text-text-decoration-none">
                                <img src="ui/img/product/produk1.png" class="img-fluid">
                                <img src="ui/img/product/produk2.png" class="img-fluid">
                            </a>
                            <button data-bs-toggle="modal" data-bs-target="#modalAddtocart"
                                class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">
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
                </div> --}}

            </div>
        </div>
    </section>
@endsection

<script>
    window.onload = function(e) {
        var product = @json($product_Aceh_Gayo);
        strpl = setproductlist(product);
        document.getElementById("product-list").innerHTML = strpl;

    }


    function myFunction() {
        let x = document.getElementById("explore").value;
        var strpl = '';
        switch (x) {
            case "1":
                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/aceh.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Aceh Gayo';
                document.getElementById("deskripsi").innerHTML =
                    'Aceh Gayo coffee is often used in most coffee shops commonly for cafe latte. It has light earthy notes with a mild body and bittersweet spicy chocolate taste. Soft in acidity, this coffee reveals some elegant caramel-fruity flavours, marrying a perfect combination of spicy and sweet. Its unique taste will make you crave for more. ';

                document.getElementById("shortdes").innerHTML =
                    'Spicy - Caramel & Chocolaty - Fruity - Slightly Earthy Note';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat3.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat2-5.svg" alt="">';

                var product = @json($product_Aceh_Gayo);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;

                break;
            case "2":
                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/sumatra.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Sumatra Mandheling';
                document.getElementById("deskripsi").innerHTML =
                    'These Arabica coffee beans are not only rare and rich in history but also one of the highly recognised by gourmet coffee producers in the world. The syrupy, full body of Sumatra Mandheling, combined with its muted acidity, makes an elegant, smooth cup of coffee. A blend of sweet and spicy, exuding an exotic flavour. ';
                document.getElementById("shortdes").innerHTML =
                    'Floral & Fruity - Sweet & Spicy - Slightly Earthy Undertones';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat4.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat3.svg" alt="">';

                var product = @json($product_Sumatra_Mandheling);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "3":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/sumatra.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Sumatra Mandheling Rainforest';
                document.getElementById("deskripsi").innerHTML =
                    'Considered by many to be the best coffee beans that Sumatra produces, our Rainforest Alliance Certified Sumatra Mandheling Rainforest coffee is packed with sweet floral and fruity flavours, and a spicy aroma that finishes off with a slightly earthy undertone. You can try pairing our Sumatran coffee with sweet and creamy desserts. ';
                document.getElementById("shortdes").innerHTML =
                    'Floral & Fruity - Sweet - Spicy - Slightly Earthy Undertones';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat4.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat3.svg" alt="">';
                var product = @json($product_Sumatra_Mandheling_Rainforest);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "4":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/lampung.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Lampung';
                document.getElementById("deskripsi").innerHTML =
                    'Well-sought after by the worlds coffee industry, this Robusta coffee gives off an immense strong-bodied bitter taste with the essence of chocolate, slightly earthy aroma and tobacco undertones. The absence of acidity is Lampungs trademark.';
                document.getElementById("shortdes").innerHTML =
                    'Chocolaty - Slightly Earthy - Tobacco Notes';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat0.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat5.svg" alt="">';
                var product = @json($product_Lampung);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "5":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/peaberry.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Peaberry';
                document.getElementById("deskripsi").innerHTML =
                    'Peaberry is known to be significantly sweeter than other beans because of its exclusive access to the fruit. With delicate fruity fragrance, as well as subtle nutty and herbal character, the medium acidity enveloped in sweetness carries through into the long finish. ';
                document.getElementById("shortdes").innerHTML =
                    'Fresh Herbal - Fruity Cereal - Sweet & Long Aftertastes';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat3.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat3.svg" alt="">';
                var product = @json($product_Peaberry);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "6":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/manglayang.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Manglayang';
                document.getElementById("deskripsi").innerHTML =
                    'Famous for its traditional coffee cultivation that retains its original character and distinctive flavours, our Manglayang Arabica coffee provides a smooth, medium body. The gentle plum acidity flavour it exudes, complements its sweet maple syrup notes, leaving a fruity lingering mouthfeel. ';
                document.getElementById("shortdes").innerHTML =
                    'Sweet Maple Syrup - Fruity - Acidic Plum';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat2-5.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat3.svg" alt="">';
                var product = @json($product_Manglayang);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "7":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/west.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'West Java';
                document.getElementById("deskripsi").innerHTML =
                    'West Java coffees sour flavour is not too dominant yet not too earthy. They have a berry-like, wine taste with a sweet honey aroma that taste great on their own or paired well with dark chocolate desserts that accentuates its flavour. To bring out its earthiness, enjoy it with a hearty brunch made with cheese, mushrooms or bacon. ';
                document.getElementById("shortdes").innerHTML =
                    'Wine Taste - Berry Like - Sweet Hone';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat0.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat4.svg" alt="">';
                var product = @json($product_West_Java);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "8":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/java.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Java';
                document.getElementById("deskripsi").innerHTML =
                    'Supresso Java Robusta coffee beans are thoroughly wet-processed, kicking off the acidity, drops the body and reduces the earthiness of the cup to a unique sweetness. Its strong malty taste with hints of tobacco notes will give a perfect combination when added with cocoa - great for brewing your delicious mocha. ';
                document.getElementById("shortdes").innerHTML =
                    'Sweetness - Strong Malty - Tobacco Notes';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat0.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat3.svg" alt="">';
                var product = @json($product_Java);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "9":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/bali.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Bali Kintamani';
                document.getElementById("deskripsi").innerHTML =
                    'Grown in the highlands of Kintamani, this coffee has unique characteristics derived from wet processing method, making them slightly sweeter. The mild body of the coffee exudes a clean light and refreshing taste exhibiting a citrusy, fruity finish. It is a must-try for those who do not like the bitter taste. ';
                document.getElementById("shortdes").innerHTML =
                    'Good Balance - Herbal & Nutty - Lively Acidity - Sweet Citrus Notes';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat3.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat2-5.svg" alt="">';
                var product = @json($product_Bali_Kintamani);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "10":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/flores.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Flores Bajawa';
                document.getElementById("deskripsi").innerHTML =
                    'Aceh Gayo coffee is often used in most coffee shops commonly for cafe latte. It has light earthy notes with a mild body and bittersweet spicy chocolate taste. Soft in acidity, this coffee reveals some elegant caramel-fruity flavours, marrying a perfect combination of spicy and sweet. Its unique taste will make you crave for more. ';
                document.getElementById("shortdes").innerHTML =
                    'Chocolate Fudges - Floral Nectareous Sweetness - Vanilla Hints - Caramel Undertones';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat2.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat4.svg" alt="">';
                var product = @json($product_Flores_Bajawa);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "11":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/toraja.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Toraja Kalosi';
                document.getElementById("deskripsi").innerHTML =
                    'Our Supresso Toraja Kalosi is highly valued among Japans coffee drinkers because of its quality traditional processing, offering multiple layers of flavours that reveal something upon each sip. The heavy-bodied coffee is low in acidity, and its delicate aroma denotes warm spices with a sweet and smooth aftertaste. ';
                document.getElementById("shortdes").innerHTML =
                    'Warm Spices - Sweet & Smooth Aftertastes';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat2.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat3-5.svg" alt="">';
                var product = @json($product_Toraja_Kalosi);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;
            case "12":

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/papua.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Papua';
                document.getElementById("deskripsi").innerHTML =
                    'A perfect summer brew when chilled, our 100% Arabica Papua coffee has the characteristics of the coffee coincide with those found in chocolate. This heavy-bodied coffee has a delicate sweetness of fruity tones and hints of tobacco notes that tastes chocolaty as it cools off.';
                document.getElementById("shortdes").innerHTML =
                    'Delicate Sweetness - Chocolaty - Fruity - Tobacco Notes';
                document.getElementById("acidity").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">medium acidity</p><img src="ui/img/bulat/bulat2.svg" alt="">';

                document.getElementById("body").innerHTML =
                    '<p class="mb-0 d-md-inline mr-3 d-lg-block mr-lg-0">mild body</p> <img src="ui/img/bulat/bulat4.svg" alt="">';
                var product = @json($product_Papua);
                strpl = setproductlist(product);
                document.getElementById("product-list").innerHTML = strpl;
                break;

            default:

                document.getElementById("maps").innerHTML =
                    '<img src="ui/img/maps/aceh.svg" class="img-fluid w-100" alt="">';
                document.getElementById("caption").innerHTML = 'Aceh Gayo';
                document.getElementById("deskripsi").innerHTML =
                    'Aceh Gayo coffee is often used in most coffee shops commonly for cafe latte. It has light earthy notes with a mild body and bittersweet spicy chocolate taste. Soft in acidity, this coffee reveals some elegant caramel-fruity flavours, marrying a perfect combination of spicy and sweet. Its unique taste will make you crave for more. ';
                document.getElementById("product-list").innerHTML = "sadasd";
                // code block
        }
        //document.getElementById("demo").innerHTML = "You selected: " + x;
    }

    function setproductlist(product) {
        var strpl = '';
        product.forEach(function(item) {
            const urlToDetail = "{{ url('fproducts') }}/" + item.id;
            const imageNotFound = "{{ url('files') }}/imagenotavailable.jpg";
            const urlImage = "{{ url('files/product-images') }}/";
            item.disc_event = item.disc_event == null ? "" : item.disc_event;
            strpl += '<div class="col col-product mb-4 mb-xxl-5">';
            strpl += '<div class="card card-product border-0 rounded-0 text-center">';
            strpl += '<div class="card-header position-relative p-0 rounded-0 border-0">';
            strpl += '<a href="' + urlToDetail + '" class="text-text-decoration-none">';
            if (item.images == null) {
                strpl += '<img loading="lazy" class="img-fluid" src="' + imageNotFound + '">' +
                    '<img loading="lazy" class="img-fluid" src="' + imageNotFound + '">';
            } else {
                if (item.images.length > 1) {
                    strpl += '<img loading="lazy" class="img-fluid" src="' + urlImage + item.images[0] +
                        '">' +
                        '<img loading="lazy" class="img-fluid" src="' + urlImage + item.images[1] +
                        '">';
                } else {
                    strpl += '<img loading="lazy" class="img-fluid" src="' + urlImage + item.images[0] +
                        '">';
                }
            }

            //   strpl +='<img src="ui/img/product/produk1.png" class="img-fluid">';
            //   strpl +='<img src="ui/img/product/produk2.png" class="img-fluid">';
            strpl += '</a>';
            strpl +=
                '<button data-bs-toggle="modal" data-bs-target="#modalAddtocart" class="btn btn-addtocart btn-secondary position-absolute top-0 end-0 m-3 p-2 lh-1 rounded-1 fs-5">';
            strpl += '<i class="bi bi-cart-plus"></i>';
            strpl += '</button>';
            strpl += '</div>';
            strpl += '<div class="card-body text-capitalize px-0 pb-0">';
            strpl += '<div class="cart-title fw-bold lh-sm">' + item.product_name + '</div>';
            strpl += '<div class="cart-text my-1">200g</div>';
            strpl += '<div class="harga-produk mb-0">';

            strpl +=
                '<span class="harga-promo d-flex justify-content-center align-items-center gap-2">';
            strpl += '<span class="harga-setelah-diskon">S$ 6.55</span>';
            strpl += '<span class="harga-awal">S$ 7.50</span>';
            strpl += '</span>';
            strpl += '</div>';
            strpl += '</div>';
            strpl +=
                '<button class="btn border-0 btn-bookmark position-absolute top-0 start-0 fs-3 p-0 ms-3 lh-1 d-none">';
            strpl += '<i class="bi bi-bookmark-fill"></i>';
            strpl += '</button>';
            strpl +=
                '<div class="wobler text-bg-primary position-absolute top-0 start-0 py-1 px-2 small">SAVE 15%</div>';
            strpl += '</div>';
            strpl += '</div>';
        });

        return strpl;
    }
</script>
