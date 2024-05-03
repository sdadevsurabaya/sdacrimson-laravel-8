<style>
    .loading{
        display: none;
    }
</style>
<h3 class="card-title">Form Legal</h3>
<form id="create_legal" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    {{-- {!! csrf_field() !!} --}}
    @csrf
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="id_customer">ID Customers</label>
                <input type="text" class="form-control @error('id_customer') border border-danger @enderror" name="" id="" value="{{ $id}}" disabled>
                <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="{{ $id}}">
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="tahun_berdiri">Tahun Berdiri</label>
                <input type="number" class="form-control" name="tahun_berdiri" id="tahun_berdiri" placeholder="Contoh: 2013">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="no_siup">NO Siup</label>
                <input type="number" class="form-control" name="no_siup" id="no_siup" placeholder="Masukan No Siup">
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="no_tdp">NO TDP</label>
                <input type="number" class="form-control" name="no_tdp" id="no_tdp" placeholder="Masukan No TDP">
            </div>
        </div>
    </div>
    <div class="mb-3 row col-xl-12 col-md-12">
        <label class="col-package-label" for="remarks">Remarks</label>
        <div class="">
            <textarea class="form-control" style="height:150px" name="remarks" id="remarks" placeholder=""></textarea>
            <input type="hidden" class="form-control" name="ar" id="ar" value="{{Str::ucfirst(Auth::user()->id)}}
            ">
            {{-- <input type="text" class="form-control" name="" id="" value="{{Str::ucfirst(Auth::user()->name)}}" disabled> --}}
            @php
                date_default_timezone_set('Asia/Jakarta');
            @endphp
            <input type="hidden" name="created_date"  value="{{date("Y-m-d")}}">
            {{-- <input type="text" name="created_by"  value="{{date("H:i:s")}}"> --}}
        </div>
    </div>
    {{-- <div style="color:crimson;">* Wajib diisi</div> --}}
    <div class="col-xs-12 col-sm-12 col-md-12 text-center selanjutnya">
        {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
        <button type="submit" class="btn btn-primary">Selanjutnya</button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center loading">
        {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
        <button class="btn btn-primary" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>
    </div>
</form>

<script type="text/javascript">

    $('#create_legal').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var id_customer = $("#id_customer").val();
        // console.log(formData);
        Swal.fire({
            icon: 'warning',
            title: 'Cek Data',
            text: 'Pastikan kembali data yang anda masukan sudah sesuai !',
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Cek Kembali",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                // console.log(formData);
                document.getElementsByClassName('selanjutnya')[0].style.display = "none";
                document.getElementsByClassName("loading")[0].style.display = "block";

                var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
                if (tempat_penyimpanan == "Server") {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/legal/store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: (data) => {
                            if ($.isEmptyObject(data.error)) {
                                // Swal.fire({
                                //     icon: 'success',
                                //     title: 'Berhasil ditambahkan. ',
                                //     text: 'Data Legal ID '+id_customer+' Berhasil ditambahkan.',
                                //     showConfirmButton: false,
                                //     timer: 3000
                                // });

                                $.get(" {{url('admin/account/show_form')}}/" + id_customer, {}, function(data, status){
                                    $("#berkas_index").html(data);
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal ditambahkan. ',
                                    text: 'Data Legal Belum Lengkap.',
                                    showConfirmButton: true,
                                    // timer: 3000
                                });
                                document.getElementsByClassName('selanjutnya')[0].style.display = "block";
                                document.getElementsByClassName("loading")[0].style.display = "none";
                            }
                        }
                    });
                } else {
                        const myLegal = {
                        id_customer: formData.get("id_customer"),
                        created_date: formData.get("created_date"),
                        ar: formData.get("ar"),
                        tahun_berdiri: formData.get("tahun_berdiri"),
                        no_siup: formData.get("no_siup"),
                        no_tdp: formData.get("no_tdp"),
                        remarks: formData.get("remarks"),
                    }

                    let daftar_legal;
                    if (localStorage.getItem('daftar_legal') === null) {
                        daftar_legal = [];
                    } else {
                        daftar_legal = JSON.parse(localStorage.getItem('daftar_legal'));
                    }

                    daftar_legal.push(myLegal);
                    // console.log(JSON.stringify(myLegal));
                    localStorage.setItem('daftar_legal', JSON.stringify(daftar_legal));

                    $.get(" {{url('admin/account/show_form')}}/" + id_customer, {}, function(data, status){
                        $("#berkas_index").html(data);
                    });
                }
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });
    });

</script>
