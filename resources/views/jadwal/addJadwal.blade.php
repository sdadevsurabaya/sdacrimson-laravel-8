@extends('layouts.master')
@section('title')
    @lang('translation.General')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Jadwal
        @endslot
        @slot('title')
            Buat Jadwal Untuk Sales {{ $jadwal->user->name }}
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
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Form Penjadwalan</h3>

                        <button id="generateLeadBtn" class="btn btn-primary">Generate Lead</button>
                        
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Customer Baru</button>
                    </div>
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

                                {!! Form::open(['route' => 'save.detail.jadwal', 'method' => 'POST', 'files' => true]) !!}

                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="floatingSelectGrid" class="col-form-label">Toko / Customer</label>
                                        {{-- <select class="form-select" name="general_id" id="floatingSelectGrid" aria-label="Floating label select example">

                                        </select> --}}
                                        <select class="js-select2" name="general_id" style="width: 100%">
                                            <option value="">-- Pilih Customer --</option>
                                            @foreach ($general as $id => $nama_usaha)
                                                <option value="{{ $id }}">{{ $nama_usaha }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="jadwal_id" id="jadwal_id" value="{{ $jadwal_id }}">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="floatingSelectGrid" class="col-form-label">Type Aktifitas</label>
                                        <select class="form-select " name="activity_type" id="floatingSelectGrid"
                                            aria-label="Floating label select example">
                                            <option value="">-- Pilih --</option>
                                            <option value="Telepon In">Telepon In</option>
                                            <option value="Telepon Out">Telepon Out</option>
                                            <option value="Meeting">Meeting</option>
                                            <option value="Email">Email</option>
                                            <option value="Visit">Visit</option>
                                            <option value="Demo">Demo</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label" for="alamat_kantor">Jam Kunjungan</label>
                                        <input type="time" class="form-control" name="plant_date"
                                            placeholder="Jam Kunjungan">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label" for="alamat_kantor">
                                            </span>Note</label>
                                        <div class="form-floating">
                                            <textarea name="note" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Masukan note..</label>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Leads</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="formrow-nama-input" class="col-form-label">Nama Customer</label>
                        <div class="">
                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" id="nama_customer" placeholder="ABCD PT">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="formrow-nama-input" class="col-form-label">Alamat</label>
                        <div class="">
                            <input type="text" class="form-control form-control-solid mb-3 mb-lg-0" id="alamat" placeholder="Jl. Balongsari Indah No. 22">
                        </div>
                    </div>
                    <div class="mb-3 row d-none">
                        <label for="formrow-nama-input" class="col-form-label">Email</label>
                        <div class="">
                            <input type="email" class="form-control form-control-solid mb-3 mb-lg-0" id="nama_customer" placeholder="abcda@gmail.com">
                        </div>
                    </div>
                    <div class="mb-3 row d-none">
                        <label for="formrow-nama-input" class="col-form-label">No HP</label>
                        <div class="">
                            <input type="number" class="form-control form-control-solid mb-3 mb-lg-0" id="nama_customer" placeholder="ABCD PT">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnSimpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".js-select2-multi").select2();
            $(".js-select2").select2();





            $('#btnSimpan').click(function() {
                console.log('eko');
            var nama_customer = $('#nama_customer').val();
            var alamat = $('#alamat').val();

                        $.ajax({
                type: 'POST',
                url: '{{ route("leads.store") }}', // Ganti route ini dengan route yang sesuai di Laravel Anda
                data: {
                    _token: '{{ csrf_token() }}',
                    nama_customer: nama_customer,
                    alamat: alamat
                },
                success: function(response) {
                    // Tampilkan SweetAlert berhasil
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan.',
                        showConfirmButton: false,
                        timer: 1500 // Menutup SweetAlert setelah 1.5 detik
                    });

                    console.log(response);
                    $('#exampleModal').modal('hide'); // Tutup modal setelah berhasil menyimpan

                    // Set timeout untuk memastikan SweetAlert tertutup sebelum halaman dimuat ulang
                    setTimeout(function() {
                        window.location.reload(); // Reload halaman setelah berhasil menyimpan
                    }, 2000); // Set waktu timeout sesuai kebutuhan
                },
                error: function(xhr) {
                    // Tampilkan SweetAlert error (jika diperlukan)
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan.',
                    });

                    console.log(xhr.responseText);
                }
            });

        });
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


        document.getElementById('generateLeadBtn').addEventListener('click', function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to generate leads?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, generate it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jalankan request ke route generate.lead
            fetch('{{ route("generate.lead") }}', {
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    Swal.fire(
                        'Generated!',
                        'Your leads have been generated.',
                        'success'
                    ).then(() => {
                        // Reload halaman setelah SweetAlert ditutup
                        location.reload();
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'There was an error generating leads.',
                        'error'
                    );
                }
            });
        }
    });
});
    </script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
@endsection
