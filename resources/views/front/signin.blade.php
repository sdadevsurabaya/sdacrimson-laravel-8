@extends('front/layout')

@section('konten')
    <!-- testing setetes ora bunting -->
    <style>
        @font-face {
            font-family: HelveticaNeue;
            src: url(https://indracostore.com/assets/fonts/HelveticaNeue.woff2);
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: HelveticaNeueMedium;
            src: url(https://indracostore.com/assets/fonts/HelveticaNeue.woff2);
            font-weight: 500;
            font-style: normal;
        }
         @font-face {
            font-family: "gothamBook";
            src: url("public/assets/fonts/gotham-book-webfont.woff") format("woff");
            font-weight: 400;
        }

        @font-face {
            font-family: "gothamMedium";
            src: url("public/assets/fonts/gotham-medium-webfont.woff") format("woff");
            font-weight: 500;
        }

        @font-face {
            font-family: "gothamBold";
            font-weight: 700;
            src: url("public/assets/fonts/Gotham-Bold.woff") format("woff");
        }

        /* Style untuk mengunci scroll secara paksa (Fixed Screen) */
        html, body {
            overflow: hidden !important;
            height: 100vh !important;
            width: 100vw !important;
            margin: 0 !important;
            padding: 0 !important;
            touch-action: none !important; /* Mencegah sentuhan bergeser/scroll di mobile */
        }

        .login-wrapper-fixed {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f8f9fa; /* Soft background */
            z-index: 9999; /* Menutupi semua layout nav/footer */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden !important;
        }

        </style>
    <section class="login-wrapper-fixed">
        <div class="container w-100 px-3">
            <div class="row justify-content-center m-0">
                <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4 bg-white p-4 p-md-5 rounded-3 shadow">

            <div class="lh-sm mb-2 text-center">
                {{-- <strong class="gotham-bold  fs-2 fs-lg-3">Welcome.!</strong> --}}
                <img src="{{ URL::asset('/assets/images/logo-sda-global-24.svg') }}" alt="" height="55"
                {{-- <img src="{{ URL::asset('/assets/images/iris.png') }}" alt="" --}}
                class="logo logo-dark mb-3">
                <p class="mb-5" style="font-size: 15px;"><b>Customer Relationship Management SDA Online</b><br>
            </div>



            <form method="POST" action="{{ route('login') }}">
            @csrf

                {{-- <div class="form-floating border-bottom mb-3">
                                       <input type="text" class="form-control border-0 rounded-0 p-0 @error('email') is-invalid @enderror" id="email" placeholder="name@example.com">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                       <label class="px-0 opacity-50" for="signinUsername">Username / Email Address</label>
                                    </div> --}}

                {{-- <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                            <label for="floatingInput">Email address</label>
                                        </div> --}}


                <div class="form-floating border-bottom mb-3">

                    <input type="text" class="form-control border-0 rounded-0 px-0 @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email', '') }}" id="email" placeholder="Enter Email address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label class="px-0 opacity-50" for="email">Email Address</label>
                </div>

                {{-- <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', 'admin@gmail.com') }}" id="email"
                                            placeholder="Enter Email address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                </div> --}}

                <div class="input-group border-bottom mb-4 mb-lg-5 flex-nowrap">
                    <div class="form-floating w-100">
                        {{-- <input type="password" class="form-control border-0 px-0" id="signinPass" placeholder="Password"> --}}

                        <input type="password" class="form-control border-0 px-0 @error('password') is-invalid @enderror"
                            value="" name="password" id="userpassword" placeholder="Enter password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <label for="userpassword" class="px-0 opacity-50">Password</label>
                    </div>
                    <button type="button" class="btn border-0 bi bi-eye d-none fs-5 text-muted" id="btn-show-pass"></button>
                    <button type="button" class="btn border-0 bi bi-eye-slash fs-5 text-muted" id="btn-hide-pass"></button>
                </div>

                {{-- <div class="mb-3">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-muted">Forgot
                                                    password?</a>
                                            @endif
                                        </div>
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            value="123456" name="password" id="userpassword" placeholder="Enter password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                {{-- <div class="form-group text-end mb-5">
                                       <a href="{{ route('password.request') }}" class="text-dark font-2" style="opacity: .5;">Forgot Password?</a>
                                    </div> --}}

                {{-- <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="auth-remember-check"
                                            name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div> --}}

                <div class="mt-3 text-end">
                    {{-- <div class="form-group">
                                          <a href="#" class="btn btn-dark w-100">Sign In</a>
                                       </div> --}}
                    <button class="btn btn-dark w-100" type="submit">Masuk</button>
                </div>

                {{-- <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 title">Sign in with</h5>
                                        </div>


                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> --}}

                {{-- <div class="mt-4 text-center">
                                        <p class="mb-0">Don't have an account ? <a href="{{ url('register') }}"
                                                class="fw-medium text-primary"> Signup now </a> </p>
                                    </div> --}}
            </form>




            {{-- <div class="form-group text-center d-flex w-100 justify-content-center align-items-center gap-3 my-4">
         <hr class="w-100">
         <span>or</span>
         <hr class="w-100">
      </div> --}}

            <div class="form-group text-center">

                {{-- <p>Social Media Sign in</p> --}}
                {{-- <div class="my-4 d-flex justify-content-center gap-4">
            <button class="btn btn-lg border-0 w-lg-100 btn-lg-light">
               <i class="bi bi-google"></i>
               <span class="d-none d-lg-inline ms-5">Sign In With Google</span>
            </button>
            <button class="btn btn-lg border-0 w-lg-100 btn-lg-light">
               <i class="bi bi-facebook"></i>
               <span class="d-none d-lg-inline ms-5">Sign In With Facebook</span>
            </button>
            <button class="btn btn-lg border-0 w-lg-100 btn-lg-light">
               <i class="bi bi-apple"></i>
               <span class="d-none d-lg-inline ms-5">Sign In With Apple</span>
            </button>
         </div> --}}
                {{-- <p>Don’t have an account? <a href="{{ route('register') }}" class="fw-bold text-dark">Sign up</a></p> --}}

                <div class="container-fluid px-0 mb-3 mb-md-4 d-none">
                    <div class="row justify-content-center justify-content-lg-around" style="font-size: 150%;">
                        <div class="col-2 col-lg-4">
                            <a href="#" target="_blank" class="text-dark d-lg-none"><i class="bi bi-google"></i></a>
                            <a href="#" target="_blank" class="media align-items-center p-3 d-none d-lg-flex"
                                style="background-color: #f1f2f2; color: #565656; border-radius: 10px; text-decoration: none; line-height: 1;">
                                <i class="bi bi-google mx-3"></i>
                                <div class="media-body" style="font-size: 22px;">
                                    Sign In with Google
                                </div>
                            </a>
                        </div>

                        <div class="col-2 col-lg-4">
                            <a href="#" target="_blank" class="text-dark d-lg-none"><i class="bi bi-facebook"></i></a>
                            <a href="#" target="_blank" class="media align-items-center p-3 d-none d-lg-flex"
                                style="background-color: #f1f2f2; color: #565656; border-radius: 10px; text-decoration: none; line-height: 1;">
                                <i class="bi bi-facebook mx-3"></i>
                                <div class="media-body" style="font-size: 22px;">
                                    Sign In with Faccebook
                                </div>
                            </a>
                        </div>

                        <div class="col-2 col-lg-4">
                            <a href="#" target="_blank" class="text-dark d-lg-none"><i class="bi bi-apple"></i></a>
                            <a href="#" target="_blank" class="media align-items-center p-3 d-none d-lg-flex"
                                style="background-color: #f1f2f2; color: #565656; border-radius: 10px; text-decoration: none; line-height: 1;">
                                <i class="bi bi-apple mx-3"></i>
                                <div class="media-body" style="font-size: 22px;">
                                    Sign In with Apple
                                </div>
                            </a>
                        </div>

                    </div>
                </div>



            </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passInput = document.getElementById('userpassword');
            const btnShow = document.getElementById('btn-show-pass');
            const btnHide = document.getElementById('btn-hide-pass');

            if (btnShow && btnHide && passInput) {
                // Tampilkan password
                btnHide.addEventListener('click', function(e) {
                    e.preventDefault();
                    passInput.type = 'text';
                    btnHide.classList.add('d-none');
                    btnShow.classList.remove('d-none');
                });

                // Sembunyikan password
                btnShow.addEventListener('click', function(e) {
                    e.preventDefault();
                    passInput.type = 'password';
                    btnShow.classList.add('d-none');
                    btnHide.classList.remove('d-none');
                });
            }
        });
    </script>
@endsection
