<style>
    .loading-submit-detail-distributor{
        display: none;
    }
    .loading-update-detail-distributor{
        display: none;
    }
    .loading{
        display: none;
    }
</style>

<h3 class="card-title">Detail Distributor</h3>
<form id="create_detail_distributor" method="POST" action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    {{-- {!! csrf_field() !!} --}}
    @csrf
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="id_customer">ID Customer</label>
                <input type="text" class="form-control" name="id_customer" id="id_customer" value="{{ $id }}" readonly>
                @php
                    date_default_timezone_set('Asia/Jakarta');
                @endphp
                <input type="hidden" class="form-control" name="created_date" id="created_date" value="{{ date('Y-m-d') }}">
                <input type="hidden" class="form-control" name="ar" id="ar" value="{{ Str::ucfirst(Auth::user()->id) }}">
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="id_outlet">ID Outlet</label>
                {{-- <input type="text" class="form-control" name="id_outlet" id="id_outlet" value="{{ $getOutlet->id_outlet }}" readonly> --}}
                <input type="text" class="form-control" name="id_outlet" id="id_outlet" value="" readonly>
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="id_distributor"><span style="color: crimson;">*</span>ID Distributor</label>
                <select class="form-select id_distributor" name="id_distributor" id="floatingSelectGrid" aria-label="Floating label select example">
                    <option value="0">-- Pilih ID Distributor --</option>
                    @foreach ($distributor as $data)
                        <option value="{{ $data->id_cust }}">
                            {{ $data->id_cust }} | {{ $data->nama_cust }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label"
                    for="formrow-email-input"> <span style="color: crimson;">*</span>Pilih Brand</label>
                <select class="js-select2-multi brand_outlet"
                    name="brand[]" id="brand_outlet"
                    multiple="multiple">
                    @foreach ($brand as $data)
                        <option value="{{ $data->brand }}">{{ $data->brand }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="mb-3">
                <label class="form-label" for="formrow-email-input"> <span style="color: crimson;">*</span> Status</label>
                    <input type="text" class="form-control" name="status_detail_distributor" value="Aktif" readonly>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row col-12">
            <div style="color:crimson;">* Wajib diisi</div>
            <div class="col-md-4 d-flex">
                <button type="reset" class="btn btn-success me-2">Reset</button>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center submit-detail-distributor">
                    <button type="submit" class="btn btn-primary">Save Detail Distributor</button>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center loading-submit-detail-distributor">
                    {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<br> <hr>
<div class="table-responsive">
    <table id="datatable-detail-distributor" class="table table-striped table-bordered dt-responsive nowrap"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>NO</th>
                <th>ID Outlet</th>
                <th>ID Distributor</th>
                <th>Brand</th>
                <th width="280px">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

{{-- <div style="color:crimson;">* Wajib diisi</div> --}}
<div class="col-xs-12 col-sm-12 col-md-12 text-center selanjutnya">
    {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
    <button type="submit" class="btn btn-primary" onclick="next()">Selanjutnya</button>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center loading">
    {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
    <button class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
    </button>
</div>

<!-- Modal Detail Distributor-->
<div class="modal fade" id="ModalDetailDistributor" data-bs-backdrop="static"
data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Detail Distributor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg error-detail-distributor-edit"
                    style="display:none">
                    <ul></ul>
                </div>

                <form id="update_detail_distributor" method="POST" action="javascript:void(0)"
                    accept-charset="utf-8" enctype="multipart/form-data">
                    {{-- {!! csrf_field() !!} --}}
                    @csrf
                    <div class="col-xl-12 col-md-12">
                        <div class="mb-3">
                            {{-- <label class="form-label" for="">ID
                                Customer</label>
                            <input type="text" class="form-control"
                                name="id_customer_edit_detail_distributor" id="id_customer_edit_detail_distributor"
                                value="" readonly> --}}
                            <input type="hidden" class="form-control"
                                name="id_edit_detail_distributor" id="id_edit_detail_distributor" value="">
                            <input type="hidden" class="form-control"
                                name="created_date_edit_detail_distributor"
                                id="created_date_edit_detail_distributor" value="">
                            <input type="hidden" class="form-control"
                                name="created_by_edit_detail_distributor" id="created_by_edit_detail_distributor"
                                value="">
                            <input type="hidden" class="form-control"
                                name="update_date_edit_detail_distributor"
                                id="update_date_edit_detail_distributor" value="{{ date('Y-m-d') }}">
                            <input type="hidden" class="form-control"
                                name="update_time_edit_detail_distributor"
                                id="update_time_edit_detail_distributor" value="{{ date('H:i:s') }}">
                            <input type="hidden" class="form-control"
                                name="update_by_edit_detail_distributor" id="update_by_edit_detail_distributor"
                                value="{{ Str::ucfirst(Auth::user()->id) }}">
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="">ID
                                Outlet</label>
                            <input type="text" class="form-control"
                                name="id_outlet_edit_detail_distributor" id="id_outlet_edit_detail_distributor"
                                value="" readonly>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="formrow-email-input">ID Distributor</label>
                            <select class="form-select id_distributor_edit_detail_distributor"
                                name="id_distributor_edit_detail_distributor" id="floatingSelectGrid"
                                aria-label="Floating label select example">
                                <option value="">-- Pilih ID Distributor --</option>
                                @foreach ($distributor as $data)
                                    <option value="{{ $data->id_cust }}">
                                        {{ $data->id_cust }} | {{ $data->nama_cust }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="formrow-email-input">Pilih
                                Brand</label>
                            <select class="js-select2-multi brand_detail_distributor_edit_detail_distributor"
                                name="brand_detail_distributor_edit_detail_distributor[]" id="brand_detail_distributor_edit_detail_distributor"
                                multiple="multiple">
                                @foreach ($brand as $data)
                                    <option value="{{ $data->brand }}">{{ $data->brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div>
                            <label id="brand_outlet_edit_outlet1"></label>
                        </div> --}}
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <label class="col-package-label">Status</label>
                        <select class="form-select status" name="status_edit_detail_distributor"
                            id="status_edit_detail_distributor"
                            aria-label="Floating label select example">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <div class="row col-12">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="col-md-4 update-detail-distributor">
                                {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="col-md-4 loading-update-detail-distributor">
                                {{-- <a href="{{ route('generals.index') }}" class="btn btn-md btn-success">Kembali</a> --}}
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $(".js-select2-multi").select2();
        $('#datatable-detail-distributor').DataTable();
        let id_customer = $('#id_customer').val();
        var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
        // console.log(tempat_penyimpanan)
        if (tempat_penyimpanan == "Server") {
            $.ajax({
                url: "{{ url('admin/detail_distributor/show_id_outlet') }}/" + id_customer,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    console.log(response.data.id_outlet)
                    $('#id_outlet').val(response.data.id_outlet);
                    // $('#created_date_update').val(response.data.created_date);
                    // $('#created_by_update').val(response.data.created_by);
                    // $('#bank_update').val(response.data.bank);
                    // //open modal
                    // $('#ModalUpdateBank').modal('show');
                }
            });
        } else {
            $.ajax({
                url: "{{ url('admin/detail_distributor/show_draf_id_outlet') }}/" + id_customer,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    console.log(response.data.id_outlet)
                    $('#id_outlet').val(response.data.id_outlet);
                    // $('#created_date_update').val(response.data.created_date);
                    // $('#created_by_update').val(response.data.created_by);
                    // $('#bank_update').val(response.data.bank);
                    // //open modal
                    // $('#ModalUpdateBank').modal('show');
                }
            });
        }

    });

    // proses submit detail distributor
    $('#create_detail_distributor').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        // console.log(formData);
        document.getElementsByClassName('submit-detail-distributor')[0].style.display = "none";
        document.getElementsByClassName("loading-submit-detail-distributor")[0].style.display = "block";

        // var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
        // if (tempat_penyimpanan == "Server") {
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/detail_distributor/store') }}",
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
                        //     text: 'Data Detail Distributor Berhasil ditambahkan.',
                        //     showConfirmButton: false,
                        //     timer: 3000
                        // });
                        // $(".print-error-msg").css('display', 'none');

                        // $(".id_outlet").prop('selectedIndex', 0);
                        $(".id_distributor").prop('selectedIndex', 0);
                        $("#brand_outlet").val('').trigger('change');
                        $(".status_detail_distributor").prop('selectedIndex', 0);
                        // location.reload();
                        getDetailDistributorByIdOutlet();
                        document.getElementsByClassName('submit-detail-distributor')[0].style.display = "block";
                        document.getElementsByClassName("loading-submit-detail-distributor")[0].style.display = "none";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal ditambahkan. ',
                            text: 'Data Detail Distributor Belum Lengkap.',
                            showConfirmButton: true,
                            // timer: 3000
                        });
                        document.getElementsByClassName('submit-detail-distributor')[0].style.display = "block";
                        document.getElementsByClassName("loading-submit-detail-distributor")[0].style.display = "none";
                    }
                }
            });
        // } else {

        // }
    });
    // Get data detail distributor by id outlet
    function getDetailDistributorByIdOutlet() {
        $('tbody').html('');
        var id = $('#id_outlet').val();
        $.ajax({
            url: "{{ url('admin/detail_distributor/tampilDetailDistributor') }}/" + id,
            type: "get",
            cache: false,
            dataType: 'json',
            success: function(response) {
                // console.log(response)
                $.each(response, function(key, values){
                    id_detail_distributor = response[key].id;
                    id_outlet = response[key].id_outlet;
                    id_distributor = response[key].id_cust;
                    brand = response[key].brand;
                    $('tbody').append('<tr>\
                            <td>'+parseInt(key+1)+'</td>\
                            <td>'+id_outlet+'</td>\
                            <td>'+id_distributor+'</td>\
                            <td>'+brand+'</td>\
                            <td><button class="btn btn-medium btn-success" onclick="update('+id_detail_distributor+')">Edit</button>\
                                <button class="btn btn-medium btn-danger" onclick="destroyDetailDistributor('+id_detail_distributor+')">Hapus</button>\
                            </td>\
                        </tr>');

                });
                //fill data to form

            }
        });
    }

    // show modal edit type outlet
    function update(id) {
        //fetch detail post with ajax
        $.ajax({
            url: "{{ url('admin/detail_distributor/show') }}/" + id,
            type: "get",
            // dataType : "JSON",
            cache: false,
            success: function(response) {
                //fill data to form
                // console.log(response.data.id_cust)
                $('#id_edit_detail_distributor').val(response.data.id);
                // $('#id_customer_edit_detail_distributor').val(response.data.id_cust);
                $('#created_date_edit_detail_distributor').val(response.data.created_date);
                $('#created_by_edit_detail_distributor').val(response.data.created_by);
                $('#id_outlet_edit_detail_distributor').val(response.data.id_outlet);
                $('[name="id_distributor_edit_detail_distributor"]').val(response.data.id_cust);
                var strArrayBrand = response.data.brand.split(",");
                $("#brand_detail_distributor_edit_detail_distributor").select2().val(strArrayBrand).change();
                $('[name="status_edit_detail_distributor"]').val(response.data.status);
                //open modal
                $('#ModalDetailDistributor').modal('show');
            }
        });
    }

    // proses update detail distributor
    $('#update_detail_distributor').submit(function(e) {
        e.preventDefault();
        let id = $('#id_edit_detail_distributor').val();
        var formData = new FormData(this);
        // console.log(formData);
        document.getElementsByClassName('update-detail-distributor')[0].style.display = "block";
        document.getElementsByClassName("loading-update-detail-distributor")[0].style.display = "none";
        $.ajax({
            type: "POST",
            url: "{{ url('admin/detail_distributor/update') }}/" + id,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (data) => {
                if ($.isEmptyObject(data.error)) {
                    // alert(data.success);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil diupdate ',
                        text: 'Data Detail Distributor berhasil diupdate !',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    getDetailDistributorByIdOutlet()
                    $('#ModalDetailDistributor').modal('hide');
                } else {
                    $.each(data.error, function(key, value) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Update ',
                            text: 'Data detail distributor harus lengkap !!',
                            showConfirmButton: true,
                            // timer: 1500
                        });
                    });
                    document.getElementsByClassName("update-detail-distributor")[0].style.display = "block";
                    document.getElementsByClassName('loading-update-detail-distributor')[0].style.display = "none";
                }
            }
        });
    });

    function destroyDetailDistributor(id) {
        Swal.fire({
            icon: 'warning',
            title: 'Hapus Data',
            text: 'Apakah anda yakin ingin mengapus data ini ?',
            showCancelButton: !0,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/detail_distributor/destroy') }}/" + id,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Hapus Data. ',
                            text: 'Data Detail Distributor Berhasil dihapus.',
                            showConfirmButton: false,
                            timer: 5000
                        });
                        getDetailDistributorByIdOutlet();
                    }
                });
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });
    }

    function next(){
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

                $.get("{{url('admin/legal/show_form')}}/" + id_customer, {}, function(data, status){
                    $("#berkas_index").html(data);
                });
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });
    }
</script>
