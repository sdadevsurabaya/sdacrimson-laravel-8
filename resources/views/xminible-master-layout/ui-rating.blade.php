@extends('layouts.master')
@section('title')
    @lang('translation.Rating')
@endsection
@section('css')
    <!-- jquery-bar-rating css -->
    <link href="{{ URL::asset('/assets/libs/jquery-bar-rating/jquery-bar-rating.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') UI Elements @endslot
        @slot('title') Rating @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">jQuery Bar Rating</h4>

                    <div class="row">
                        <div class="col-xl-4 col-sm-6">
                            <div class="py-4">
                                <div>
                                    <h5 class="font-size-15 mb-3">Default rating</h5>
                                    <select id="example-rating">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="pt-5">
                                <h5 class="font-size-15">CSS Stars</h5>
                                <select id="rating-css" name="rating" autocomplete="off">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="py-5">
                                <h5 class="font-size-15 mb-3">Current rating: <span class="value"></span></h5>
                                <div class="stars-example-fontawesome-o">
                                    <select id="rating-current-fontawesome-o" name="rating" data-current-rating="5.6"
                                        autocomplete="off">

                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <span class="title current-rating">
                                        Current rating: <span class="value"></span>
                                    </span>
                                    <span class="title your-rating hidden">
                                        Your rating: <span class="value"></span>&nbsp;
                                        <a href="#" class="clear-rating"><i class="fa fa-times-circle"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="py-4">
                                <div>
                                    <h5 class="font-size-15 mb-3">1/10 Rating</h5>
                                    <select id="rating-1to10" name="rating" autocomplete="off">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7" selected>7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="py-4">
                                <div>
                                    <h5 class="font-size-15 mb-3">Movie Rating</h5>
                                    <select id="rating-movie" name="rating" autocomplete="off">
                                        <option value="Bad">Bad</option>
                                        <option value="Mediocre">Mediocre</option>
                                        <option value="Good" selected>Good</option>
                                        <option value="Awesome">Awesome</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="py-4">
                                <div>
                                    <h5 class="font-size-15 mb-3">Square Rating</h5>
                                    <select id="rating-square" name="rating" autocomplete="off">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected>3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="py-4">
                                <div>
                                    <h5 class="font-size-15 mb-3">Pill Rating</h5>
                                    <select id="rating-pill" name="rating" autocomplete="off">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="py-4">
                                <div>
                                    <h5 class="font-size-15 mb-3">Reversed Rating</h5>
                                    <select id="rating-reversed" name="rating" autocomplete="off">
                                        <option value="Strongly Agree">Strongly Agree</option>
                                        <option value="Agree">Agree</option>
                                        <option value="Neither Agree or Disagree" selected="selected">Neither Agree or
                                            Disagree</option>
                                        <option value="Disagree">Disagree</option>
                                        <option value="Strongly Disagree">Strongly Disagree</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="py-4">
                                <div>
                                    <h5 class="font-size-15 mb-3">Horizontal Rating</h5>
                                    <select id="rating-horizontal" name="rating" autocomplete="off">
                                        <option value="10">10</option>
                                        <option value="9">9</option>
                                        <option value="8">8</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1" selected="selected">1</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('/assets/libs/jquery-bar-rating/jquery-bar-rating.min.js') }}"></script>

    <!-- Range slider init js-->
    <script src="{{ URL::asset('/assets/js/pages/rating-init.js') }}"></script>
@endsection
