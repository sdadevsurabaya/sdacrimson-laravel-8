@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/libs/select2/select2.css') }}" rel="stylesheet" type="text/css">
@endsection

<style>
    /* .spinner-border {
        display: block;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        z-index: 999;
    } */
</style>

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Form
        @endslot
        @slot('title')
            Pendafataran Customer Baru
        @endslot
    @endcomponent

    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- <div class="text-center">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <input type="hidden" name="id_customer" id="id_customer" value="{{ $id }}">
                <div class="card-body" id="berkas_index">

                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
@endsection

@section('script')

    <script>

        $(document).ready(function() {
            showFormOutlet();
            // $(".js-select2-multi-brand").select2();

            // $(".large").select2({
            //     dropdownCssClass: "big-drop",
            // });

            // let id_customer = $("#id_customer").val();
            // console.log(id_customer);


        });

        // show form outlet with ajax
        function showFormOutlet(){
            var id_customer = $("#id_customer").val();
                // console.log(id_customer);
            $.get(" {{url('admin/outlet/show_form')}}/" + id_customer, {}, function(data, status){

                $("#berkas_index").html(data, id_customer);
            });
        }

        // $('#create_legal').submit(function(e) {
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     var id_customer = $("#id_customer").val();
        //     console.log(id_customer);
        //     // let TotalFiles = $('#files')[0].files.length; //Total files
        //     // let files = $('#files')[0];
        //     // for (let i = 0; i < TotalFiles; i++) {
        //     // formData.append('files' + i, files.files[i]);
        //     // }
        //     // formData.append('TotalFiles', TotalFiles);
        //     // console.log(formData);
        //     // $.ajax({
        //     //     type:'POST',
        //     //     url: "{{ url('admin/outlet/store') }}",
        //     //     data: formData,
        //     //     cache:false,
        //     //     contentType: false,
        //     //     processData: false,
        //     //     dataType: 'json',
        //     //     success: (data) => {
        //     //         if($.isEmptyObject(data.error)){
        //     //             alert(data.success);
        //     //             $.get(" {{url('admin/legal/show_from')}}/" + id_customer, {}, function(data, status){

        //     //             $("#berkas_index").html(data, id_customer);
        //     //             });
        //     //         }else{
        //     //             printErrorMsg(data.error);
        //     //         }
        //     //     }
        //     //     // error: function(data){
        //     //     //     // alert("yah error " +data.callback);
        //     //     //     console.log("error maneh");
        //     //     //     printErrorMsg(data.error);
        //     //     //     // alert(data.responseJSON.errors.files[0]);
        //     //     //     // console.log(data.responseJSON.errors);
        //     //     // }
        //     // });
        // });

    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
