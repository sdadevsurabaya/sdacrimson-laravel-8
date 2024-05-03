@extends('front/layout')

@section('konten')
    <section>
        <div class="container">

            <div class="lh-sm mb-2">
                <strong class="gotham-bold  fs-2 fs-lg-3">Forgot Password ?</strong>
            </div>

            <p class="mb-5">Type your email and we will send u letter to reset your password.</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-floating border-bottom mb-4 mb-lg-5">

                    <input type="email" class="form-control border-0 rounded-0 px-0 @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" id="email" placeholder="Enter email">
                    <label class="px-0 opacity-50" for="forgotUsername">Email Address*</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {{-- <a href="/signin" class="btn btn-dark w-100">Reset Password</a> --}}
                    <button class="btn btn-dark w-100" type="submit">Reset</button>

                    {{-- <a href="{{ route('reset.password.get', $token) }}">Reset Password</a> --}}
                </div>

                {{-- <div class="mt-3 text-end">
                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Reset</button>
                </div> --}}


                <div class="mt-4 text-center">
                    <p class="mb-0">Remember It ? <a href="{{ url('login') }}" class="fw-medium text-primary"> Signin
                        </a></p>
                </div>
            </form>

            {{-- <div class="form-group text-center d-flex w-100 justify-content-center align-items-center gap-3 my-4">
                <hr class="w-100">
                <span>or</span>
                <hr class="w-100">
            </div> --}}

            {{-- <div class="form-group text-center">

                <p>Social Media Sign in</p>
                <div class="my-4 d-flex justify-content-center gap-4">
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
                </div>
                <p>Don’t have an account? <a href="/signup" class="fw-bold text-dark">Sign up</a></p>

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



            </div> --}}

        </div>
    </section>
@endsection
