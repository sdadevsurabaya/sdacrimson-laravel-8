<style>
    .loading{
        display: none;
    }
</style>
<h3 class="card-title">Form Account</h3>
<form id="create_account" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    {{-- {!! csrf_field() !!} --}}
    @csrf
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="id_customer">ID Customers</label>
                <input type="text" class="form-control" name="id_customer" id="id_customer" value="{{ $id }}" readonly>

                @php
                    date_default_timezone_set('Asia/Jakarta');
                @endphp
                <input type="hidden" class="form-control" name="created_date" id="created_date" value="{{ date("Y-m-d")}}">
                <input type="hidden" class="form-control" name="ar" id="ar" value="{{Str::ucfirst(Auth::user()->id)}}">
            </div>
        </div>
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="payment_trems">Payment Terms</label>
                <input type="number" class="form-control" name="payment_trems" id="payment_trems" placeholder="Ex: 30 Hari">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="id_price">ID Price</label>
                <input type="text" class="form-control" name="id_price" id="id_price" placeholder="ID Price">
            </div>
        </div>
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="credit_limit">Credit Limit</label>
                <input type="number" class="form-control" name="credit_limit" id="credit_limit" placeholder="Ex: 1.000.000">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="max_nota">Max Nota</label>
                <input type="text" class="form-control" name="max_nota" id="max_nota" placeholder="Ex: 200.000">
            </div>
        </div>
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="bank">Bank</label>
                <select class="form-select bank" name="bank" id="floatingSelectGrid" aria-label="Floating label select example">
                    <option value="">-- Pilih Bank --</option>
                    @foreach ($bank as $data)
                        <option value="{{ $data->bank }}">{{ $data->bank }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="atas_nama">Atas Nama</label>
                <input type="text" class="form-control" name="atas_nama" id="atas_nama" placeholder="Ex: David Silva">
            </div>
        </div>
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="no_rek">Account</label>
                <input type="number" class="form-control" name="no_rek" id="no_rek" placeholder="Ex: 1.000.000">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="cabang">Cabang</label>
                <input type="text" class="form-control" name="cabang" id="cabang" placeholder="Ex: Jl Said Anwar">
            </div>
        </div>
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="floatingSelectGrid" name="status_account" aria-label="Floating label select example">
                    <option value="Aktif" selected>Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="mb-3">
                <label class="form-label" for="remarks">Remarks</label>
                <div class="">
                    <textarea class="form-control" style="height:150px" name="remarks_account" id="remarks_account" placeholder=""></textarea>
                </div>
            </div>
        </div>
    </div>
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

    $('#create_account').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var id_customer = $("#id_customer").val();

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
                        url: "{{ url('admin/account/store') }}",
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
                                //     text: 'Data Account ID '+id_customer+' Berhasil ditambahkan.',
                                //     showConfirmButton: false,
                                //     timer: 3000
                                // });

                                $.get(" {{url('admin/attachment/show_form')}}/" + id_customer, {}, function(data, status){
                                    $("#berkas_index").html(data);
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal ditambahkan. ',
                                    text: 'Data Account Belum Lengkap.',
                                    showConfirmButton: true,
                                    // timer: 3000
                                });
                                document.getElementsByClassName('selanjutnya')[0].style.display = "block";
                                document.getElementsByClassName("loading")[0].style.display = "none";
                            }
                        }
                    });
                } else {
                    const myAccount = {
                        id_customer: formData.get("id_customer"),
                        created_date: formData.get("created_date"),
                        ar: formData.get("ar"),
                        payment_trems: formData.get("payment_trems"),
                        id_price: formData.get("id_price"),
                        credit_limit: formData.get("credit_limit"),
                        max_nota: formData.get("max_nota"),
                        bank: formData.get("bank"),
                        atas_nama: formData.get("atas_nama"),
                        no_rek: formData.get("no_rek"),
                        cabang: formData.get("cabang"),
                        status_account: formData.get("status_account"),
                        remarks_account: formData.get("remarks_account"),
                    }

                    let daftar_account;
                    if (localStorage.getItem('daftar_account') === null) {
                        daftar_account = [];
                    } else {
                        daftar_account = JSON.parse(localStorage.getItem('daftar_account'));
                    }

                    daftar_account.push(myAccount);
                    // console.log(JSON.stringify(daftar_account));
                    localStorage.setItem('daftar_account', JSON.stringify(daftar_account));

                    $.get(" {{url('admin/attachment/show_form')}}/" + id_customer, {}, function(data, status){
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
