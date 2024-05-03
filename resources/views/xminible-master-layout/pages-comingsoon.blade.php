@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.Coming_Soon')
@endsection
@section('content')
    <div class="home-btn d-none d-sm-block">
        <a href="{{ url('index') }}" class="text-dark"><i class="mdi mdi-home-variant h2"></i></a>
    </div>
    <div class="my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="{{ url('index') }}" class="d-block auth-logo">
                            <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="22"
                                class="logo logo-dark">
                            <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="22"
                                class="logo logo-light">
                        </a>

                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-4 col-sm-5">
                                <div class="maintenance-img">
                                    <img src="{{ URL::asset('/assets/images/coming-soon-img.png') }}" alt=""
                                        class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-5">Let's get started with Minible</h4>
                        <p class="text-muted">It will be as simple as Occidental in fact it will be Occidental.</p>

                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-10">
                                <div data-countdown="2021/12/31" class="counter-number"></div>

                            </div> <!-- end col-->
                        </div> <!-- end row-->

                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-6">
                                <div class="input-section pt-4">
                                    <div class="row">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="email" class="form-control"
                                                    placeholder="Enter email address...">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit"
                                                class="btn btn-primary w-md waves-effect waves-light">Subscribe</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/jquery-countdown/jquery-countdown.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/coming-soon.init.js') }}"></script>
@endsection
