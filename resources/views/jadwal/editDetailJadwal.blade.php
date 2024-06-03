@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Jadwal
        @endslot
        @slot('title')
            Edit Detail Jadwal Untuk Sales {{ $jadwal->user->name}} 
        @endslot
    @endcomponent

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully!</strong> {{ session('success') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('sweetalert::alert')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                {{-- <div class="card-body">
                    <div class="gap-3 d-flex justify-content-center">
                        <div class="col col-auto" id="checkin">
                            <a href="{{ route('check.checkin', ['id_general' => $general->id]) }}"
                                class="btn  @if ($checkin) btn-success disabled @else btn-outline-success @endif  w-100 fw-bold">Check
                                In <i class="uil uil-arrow-from-right"></i></a>
                        </div>
                        <div class="col col-auto" id="checkout">
                            <a href="{{ route('check.checkout', ['id_general' => $general->id]) }}"
                                class="btn w-100 fw-bold  @if ($checkout) btn-danger disabled @else btn-outline-danger @endif">
                                Check Out <i class="uil uil-left-arrow-from-left"></i></a>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Form Penjadwalan</h3>
                    <div class="row">
                        <div class="col-lg-12">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mt-4">
                             
                                {!! Form::open(['route' => 'update.detail.jadwal', 'method' => 'POST', 'files' => true]) !!}
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="general_id" class="col-form-label">Toko / Customer</label>
                                        <select class="form-select" name="general_id" id="general_id" aria-label="Floating label select example" disabled="true">
                                            <option value="">-- Pilih Customer --</option>
                                            @foreach($general as $id => $nama_usaha)
                                                <option value="{{ $id }}" {{ $id == $DetailJadwal->general_id ? 'selected' : '' }}>
                                                    {{ $nama_usaha }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <input type="hidden" name="jadwal_id" id="jadwal_id" value="{{ $DetailJadwal->id }}">
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="activity_type" class="col-form-label">Type Aktifitas</label>
                                        <select class="form-select" name="activity_type" id="activity_type" aria-label="Floating label select example " disabled="true">
                                            <option value="">-- Pilih --</option>
                                            <option value="Telepon" {{ $DetailJadwal->activity_type == 'Telepon' ? 'selected' : '' }}>Telepon</option>
                                            <option value="Meeting" {{ $DetailJadwal->activity_type == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                                            <option value="Email" {{ $DetailJadwal->activity_type == 'Email' ? 'selected' : '' }}>Email</option>
                                            <option value="Visit" {{ $DetailJadwal->activity_type == 'Visit' ? 'selected' : '' }}>Visit</option>
                                            <option value="Demo" {{ $DetailJadwal->activity_type == 'Demo' ? 'selected' : '' }}>Demo</option>
                                        </select>
                                    </div>
                                    
                                   

                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="status" class="col-form-label">Status</label>
                                        <select class="form-select" name="status_jadwal" id="status_jadwal" aria-label="Floating label select example " >
                                            <option value="">-- Pilih --</option>
                                            <option value="Pending" {{ $DetailJadwal->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Done" {{ $DetailJadwal->status == 'Done' ? 'selected' : '' }}>Done</option>
                                            <option value="Close" {{ $DetailJadwal->status == 'Close' ? 'selected' : '' }}>Close</option>
                                        </select>
                                    </div>

                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label" for="plant_date">Jam Kunjungan</label>
                                        <input type="time" class="form-control" name="plant_date" id="plant_date" value="{{ $DetailJadwal->plant_date }}" placeholder="Jam Kunjungan" readonly>
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label" for="plant_date">Jam Kunjungan Aktual</label>
                                        <input type="time" class="form-control" name="actual_date" id="actual_date"  placeholder="Jam Kunjungan" >
                                    </div>
                                    
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label" for="note">Note</label>
                                        <div class="form-floating">
                                            <textarea name="note" class="form-control" placeholder="Leave a comment here" id="note" style="height: 100px">{{ $DetailJadwal->note }}</textarea>
                                            <label for="note">Masukan note..</label>
                                        </div>
                                    </div>

                                 
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary submit-contact">Submit</button>
                                </div>
                            {!! Form::close() !!}
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                // console.log(lsthmtl);
                $(".increment").after(lsthmtl);

            });

            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();

            });

            $('select').prop('selectedIndex', 0);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $(".js-select2-multi").select2();

            $(".js-select2-multi").select2();

            handlePermission(this);

        });

        // dinamis tambah foto
        var i = 0;

        function preview_member(event, inp) {
            var reader = new FileReader();
            // console.log("tambah "+inp);
            reader.onload = function() {
                var output = document.getElementById("output_member" + inp);
                output.src = reader.result;
            };

            reader.readAsDataURL(event.target.files[0]);
        }

        function preview_member_edit_outlet(event, inp) {
            var reader = new FileReader();
            console.log("tambah edit " + inp);
            reader.onload = function() {
                var output = document.getElementById("output_member_edit_outlet" + inp);
                output.src = reader.result;
            };

            reader.readAsDataURL(event.target.files[0]);
        }

        // show div on error validation
        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
@endsection
