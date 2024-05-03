{{-- @section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/libs/select2/select2.css') }}" rel="stylesheet" type="text/css">
@endsection --}}
<style>
    .img-thumbnail{
        width: 150px;
    }
    .loading{
        display: none;
    }
</style>



<h3 class="card-title">Form Outlet</h3>
<form id="create_outlet" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    {{-- {!! csrf_field() !!} --}}
    @csrf
    <div class="border-top">
        <div class="col-xl-12 col-md-12">
            <div class="col-xl-12 col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="id_customer"><span style="color: crimson;">*</span> ID Customer</label>
                    <input type="text" class="form-control" name="id_customer" id="id_customer" placeholder="Masukan nama lengkap" value="{{ $id }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label"
                            for="formrow-email-input"> <span style="color: crimson;">*</span> Nama Outlet</label>
                        {{-- <input type="text" class="form-control @error('nama_outlet') border border-danger @enderror" name="nama_outlet" id="nama_outlet" value="{{ $getGeneral->nama_usaha }}" placeholder="Masukan nama_outlet"> --}}
                        <input type="text" class="form-control @error('nama_outlet') border border-danger @enderror" name="nama_outlet" id="nama_outlet" value="" placeholder="Masukan nama_outlet">
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="formrow-email-input"><span style="color: crimson;">*</span> Type Outlet</label>
                        <select class="form-select @error('outlet_type') border border-danger @enderror" name="outlet_type" id="floatingSelectGrid" aria-label="Floating label select example">
                            <option value="">-- Pilih Type Outlet --</option>
                            @foreach ($type_outlet as $data)
                                <option value="{{ $data->type_outlet }}">{{ $data->type_outlet }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="address_type"><span style="color: crimson;">*</span> Type Alamat</label>
                        <select class="js-select2-multi-brand address_type @error('brand') border border-danger @enderror" name="address_type[]" multiple="multiple" id="address_type">
                            <option value="Penagihan">Penagihan</option>
                            <option value="Pengiriman">Pengiriman</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="alamat"><span style="color: crimson;">*</span> Alamat</label>
                        {{-- <input type="text" class="form-control" name="alamat" id="alamat" value="{{$getGeneral->alamat_kantor}}" placeholder="Masukan alamat"> --}}
                        <input type="text" class="form-control" name="alamat" id="alamat" value="" placeholder="Masukan alamat">
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="nama_lengkap"><span style="color: crimson;">*</span> Nama Lengkap</label>
                    {{-- <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{$getGeneral->nama_lengkap}}" placeholder="Masukan nama lengkap"> --}}
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="" placeholder="Masukan nama lengkap">
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="no_telpon"><span style="color: crimson;">*</span> Mobile</label>
                    {{-- <input type="number" class="form-control" name="no_telpon" id="no_telpon" value="{{$getGeneral->mobile_phone}}" placeholder="Masukan nomor hp"> --}}
                    <input type="number" class="form-control" name="no_telpon" id="no_telpon" value="" placeholder="Masukan nomor hp">
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    {{-- <input type="email" class="form-control" name="email" id="email" value="{{$getGeneral->email}}" placeholder="Masukan email"> --}}
                    <input type="email" class="form-control" name="email" id="email" value="" placeholder="Masukan email">
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="mb-3">
                    <label class="form-label" for="jabatan"><span style="color: crimson;">*</span> Jabatan</label>
                    {{-- <input type="text" class="form-control @error('jabatan') border border-danger @enderror" name="jabatan" id="jabatan" placeholder="Masukan jabatan"> --}}

                    <select class="form-select" name="jabatan" id="floatingSelectGrid" aria-label="Floating label select example">
                        <option value="Pemilik" selected="selected">Pemilik</option>
                        <option value="Karyawan">Karyawan</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="provinsi"><span style="color: crimson;">*</span> Provinsi</label>
                        <select class="form-select @error('provinsi') border border-danger @enderror" name="provinsi" id="provinsi" aria-label="Floating label select example">
                            <option value="0" selected="" disabled="">-- Pilih Provinsi --</option>
                            @foreach ($outlets as $outlet)
                                <option value="{{ $outlet->province_name }}">{{ $outlet->province_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="kota"><span style="color: crimson;">*</span> Kota</label>
                        <input type="hidden" class="form-control" name="area" id="area">
                        <select class="form-select @error('kota') border border-danger @enderror" name="kota" id="kota" aria-label="Floating label select example">
                            <option value="">-- Pilih Kota --</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="kecamatan"><span style="color: crimson;">*</span> Kecamatan</label>
                        <select class="form-select @error('kecamatan') border border-danger @enderror" name="kecamatan" id="kecamatan" aria-label="Floating label select example">
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="kelurahan"><span style="color: crimson;">*</span> Kelurahan</label>
                        <select class="form-select @error('kelurahan') border border-danger @enderror" name="kelurahan" id="kelurahan" aria-label="Floating label select example">
                            <option value="">-- Pilih Kelurahan --</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="kode_pos"><span style="color: crimson;">*</span> Kode Pos</label>
                        <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="Masukan Kode Pos" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="gps"><span style="color: crimson;">*</span> Titik GPS</label>
                        <input type="hidden" class="form-control" name="latitude" id="latitude" placeholder="Masukan gps">
                        <input type="hidden" class="form-control" name="longitude" id="longitude" placeholder="Masukan gps">
                        <input type="hidden" class="form-control" name="lat" id="lat" placeholder="Masukan gps">
                        <input type="hidden" class="form-control" name="long" id="long" placeholder="Masukan gps">
                        <iframe id="location" src="about:blank" width="100%" height="500" frameborder="0" style="border:0"></iframe>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="formrow-email-input"><span style="color: crimson;">*</span> Foto</label>
                        <div class="foto col-12 d-flex">
                            <div class="col-2 col-md-2 p-1" style="align-self: center;">
                                <label for="takefoto" class="btn btn-md btn-secondary" ><i class="uil-camera-plus"></i></label>
                                {{-- <input id="takefoto" type="file" capture="user" accept="image/jpeg" name="member_image[]" onchange="preview_member(event, 0)"
                                style="visibility:hidden; width:12%;"> --}}
                                <input id="takefoto" type="file" class="member_image" name="member_image[]" onchange="preview_member(event, 0)"
                                style="visibility:hidden; width:12%;">
                            </div>
                            <div class="col-4 col-md-4 p-1">
                                <img src="{{ URL::asset('/assets/images/no-image.jpg') }}" class="img-thumbnail mb-4" id="output_member0">
                            </div>
                            <div class="col-5 col-md-5 p-1"style="align-self: center"><input type="text" class="form-control namafoto" name="namafoto[]" id="namafoto" placeholder="Nama foto"></div>
                            <div class="col-1 col-md-1 p-1">
                                <button type="button" class="btn btn-danger btn-block" id="remove-member-fields" style="align-self:center; opacity:0;"><i class="uil-trash"></i></button>
                            </div>
                        </div>
                            <div id="team-member-fields"></div>
                            <button type="button" class="btn btn-dark btn-block mb-3" id="add-member-fields"><i class="uil-plus-circle"></i></button>

                    </div>
                </div>
                {{-- <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="brand"><span style="color: crimson;">*</span> Pilih Brand</label>
                        <select class="js-select2-multi-brand @error('brand') border border-danger @enderror" name="brand[]" multiple="multiple">
                            <option value="">-- Pilih Brand --</option>
                            @foreach ($brand as $data)
                                <option value="{{ $data->brand }}">{{ $data->brand }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label"
                            for="aplikasi">Aplikasi</label>
                        <input type="text"
                            class="form-control @error('aplikasi') border border-danger @enderror"
                            name="aplikasi" id="aplikasi"
                            placeholder="Contoh: POS">
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label"
                            for="jumlah_pengambilan">Jumlah Pengambilan</label>
                        <input type="text"
                            class="form-control @error('jumlah_pengambilan') border border-danger @enderror"
                            name="jumlah_pengambilan" id="jumlah_pengambilan"
                            placeholder="Contoh: 100 Karton">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="status"><span style="color: crimson;">*</span> Status</label>
                        <input type="text" class="form-control" name="status" value="Aktif" readonly>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="remarks">Remarks</label>
                        <div class="">
                            <textarea class="form-control" style="height:150px" name="remarks" placeholder="Masukan catatan atau informasi produk kompetitor"></textarea>
                            <input type="hidden" class="form-control" name="ar" id="ar" value="{{Str::ucfirst(Auth::user()->id)}}
                            ">
                            {{-- <input typ e="text" class="form-control" name="" id="" value="{{Str::ucfirst(Auth::user()->name)}}" disabled> --}}
                            @php
                                date_default_timezone_set('Asia/Jakarta');
                            @endphp
                            <input type="hidden" name="created_date"  value="{{date("Y-m-d")}}">
                            {{-- <input type="text" name="created_by"  value="{{date("H:i:s")}}"> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="color:crimson;">* Wajib diisi</div>
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
    $(document).ready(function() {
        handlePermission(this);
        $(".js-select2-multi-brand").select2();
        // let id_customer = $('#id_customer').val();
        var tempat_penyimpanan = localStorage.getItem('tempat_penyimpanan')
        // console.log(tempat_penyimpanan)
        if (tempat_penyimpanan == "Server") {
            $.ajax({
                url: "{{ url('admin/outlet/show_data_general') }}",
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    // console.log(response.data.id_customer);
                    $('#nama_outlet').val(response.data.nama_usaha);
                    $('#alamat').val(response.data.alamat_kantor);
                    $('#nama_lengkap').val(response.data.nama_lengkap);
                    $('#no_telpon').val(response.data.mobile_phone);
                    $('#email').val(response.data.email);
                    // //open modal
                    // $('#ModalUpdateBank').modal('show');
                }
            });
        } else {
            $.ajax({
                url: "{{ url('admin/outlet/show_draf_id') }}",
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    // console.log(response.data.id_customer);
                    $('#nama_outlet').val(response.data.nama_usaha);
                    $('#alamat').val(response.data.alamat_kantor);
                    $('#nama_lengkap').val(response.data.nama_lengkap);
                    $('#no_telpon').val(response.data.mobile_phone);
                    $('#email').val(response.data.email);
                    // //open modal
                    // $('#ModalUpdateBank').modal('show');
                }
            });
        }

    });

    $("#provinsi").on("change", function(){
        var provinsi = $('#provinsi').val();
        // console.log(provinsi);
        $.get("{{url('admin/outlet/get_kota')}}/" + provinsi, function(data){
        //  console.log(data);
            $('#kota').html(data);
            // $('#kecamatan').prop('selectedIndex', 0);
        });
    });

    $("#kota").on("change", function(){
        var p = $('#provinsi').val();
        var d = $('#kota').val();
        // console.log(provinsi);
        // console.log(kota);
        $.ajax({
            url: "{{url('admin/outlet/get_kecamatan')}}",
            type: "GET",
            // dataType : "JSON",
            data : {provinsi:p,kota:d},
            success: function (ajaxData){
                // var json = JSON.parse(ajaxData);
                //  console.log(json);
                $("#kecamatan").html(ajaxData);
            }
        });

        $.ajax({
            url: "{{ url('get_area_id') }}",
            type: "GET",
            // dataType : "JSON",
            data: {
                kota: d
            },
            success: function(response) {
                // var json = JSON.parse(ajaxData);
                // console.log(response);
                $("#area").val(response);
            }
        });
    });

    $("#kecamatan").on("change", function(){
        var p = $('#provinsi').val();
        var d = $('#kota').val();
        var s = $('#kecamatan').val();
        // console.log(kecamatan);
        $.ajax({
            url: "{{url('admin/outlet/get_kelurahan')}}",
            type: "GET",
            // dataType : "JSON",
            data : {provinsi:p,kota:d,kecamatan:s},
            success: function (ajaxData){
                // var json = JSON.parse(ajaxData);
                //  console.log(json);
                $("#kelurahan").html(ajaxData);
            }
        });
        // $.get("{{url('admin/outlet/get_kelurahan')}}/" + kecamatan, function(data){
        // //  console.log(data);
        //     $('#kelurahan').html(data);
        //     // $('#kecamatan').prop('selectedIndex', 0);
        // });
    });

    $("#kelurahan").on("change", function(){
        var p = $('#provinsi').val();
        var d = $('#kota').val();
        var s = $('#kecamatan').val();
        var u = $('#kelurahan').val();
        $.ajax({
            url: "{{url('admin/outlet/get_kode_pos')}}",
            type: "POST",
            // dataType : "JSON",
            data : {provinsi:p,kota:d,kecamatan:s,kelurahan:u},
            success: function (ajaxData){
                // var json = JSON.parse(ajaxData);
                //  console.log(json);
                $("#kode_pos").val(ajaxData);
            }
        });
    });

    function handlePermission(geoBtn) {
        navigator.permissions.query({name:'geolocation'}).then(function(result) {
            if( result.state == 'prompt' || result.state == 'granted' )
            {
                navigator.geolocation.getCurrentPosition(revealPosition,showErrorLocation);
            }else{
                console.log( result.state );
            }

            result.onchange = function() {
                console.log(result.state);
            }
        });
    }

    function revealPosition(position) {
        var data = position.coords;
        var lat  = data.latitude;
        var long = data.longitude;

        // alert("Lat : " + lat + ", Long: " + long );
        // console.log(lat);
        // console.log(long);
        $("#lat").val(lat);
        $("#long").val(long);
        $("#latitude").val(lat);
        $("#longitude").val(long);

        $('#location').attr('src', "https://maps.google.com/maps?q="+lat+","+long+"&z=15&output=embed");

    }

    function showErrorLocation(error) {
        switch(error.code) {
        case error.PERMISSION_DENIED:
            var err = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            var err = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            var err = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            var err = "An unknown error occurred."
            break;
        }

        console.log(err);
    }

    $('#create_outlet').submit(function(e) {
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
                // console.log(tempat_penyimpanan)
                if (tempat_penyimpanan == "Server") {
                    // console.log("server")
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/outlet/store') }}",
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
                                //     text: 'Data Outlet ID '+id_customer+' Berhasil ditambahkan.',
                                //     showConfirmButton: false,
                                //     timer: 3000
                                // });

                                // $.get("{{url('admin/legal/show_form')}}/" + id_customer, {}, function(data, status){
                                //     $("#berkas_index").html(data);
                                // });
                                $.get("{{url('admin/detail_distributor/show_form')}}/" + id_customer, {}, function(data, status){
                                    $("#berkas_index").html(data);
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal ditambahkan. ',
                                    text: 'Data Outlet Belum Lengkap.',
                                    showConfirmButton: true,
                                    // timer: 3000
                                });
                                document.getElementsByClassName('selanjutnya')[0].style.display = "block";
                                document.getElementsByClassName("loading")[0].style.display = "none";
                            }
                        }
                    });
                } else {
                    // console.log("lokal")
                    let id_customer = $('#id_customer').val();
                    let nama_outlet = $('#nama_outlet').val();
                    let kota = $('#kota').val();
                    let token = $("meta[name='csrf-token']").attr("content");
                    // console.log(id_customer);
                    // console.log(nama_outlet);
                    // console.log(kota);
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/outlet/generate_id_outlet') }}",
                        data:{
                            "id_customer" : id_customer,
                            "nama_outlet" : nama_outlet,
                            "kota": kota,
                            "_token": token
                        },
                        cache: false,
                        // contentType: false,
                        // processData: false,
                        success: (data) => {
                            // console.log(data.success);
                            const addressType = [];
                            $('#address_type :selected').each(function(i, sel){
                                addressType.push($(sel).val())
                            });

                            const nameImageOutlet = [];
                            const namaFile = document.querySelectorAll(".namafoto")
                            for(let name of namaFile){
                                const pushNameData = name.value
                                nameImageOutlet.push(pushNameData)
                            }

                            let filenamesImageOutlet  = [];
                            const files = document.querySelectorAll(".member_image")

                            // let n = 0;
                            // ;(async function() {
                            //     let daftar_outlet;
                            //     for(let item of files){
                            //         let filedata = item.files[0]
                            //         const reader = new FileReader();
                            //         reader.readAsDataURL(filedata);
                            //         // process isi file di sini

                            //         await new Promise(resolve => reader.onload = () => resolve());
                            //         // let resultFiledata = reader.result
                            //         // let pecahBase64 = resultFiledata.split(",")
                            //         // let pushFiledata = pecahBase64[1]
                            //         let pushFiledata = reader.result

                            //         filenamesImageOutlet[n] = pushFiledata;
                            //         // filenamesImageOutlet[n] = pecahBase64[1];
                            //         n++;

                            //         const myOutlet = {
                            //             id_customer : formData.get("id_customer"),
                            //             id_outlet : data.success,
                            //             created_date : formData.get("created_date"),
                            //             ar : formData.get("ar"),
                            //             nama_outlet : formData.get("nama_outlet"),
                            //             outlet_type : formData.get("outlet_type"),
                            //             address_type : addressType,
                            //             area : formData.get("area"),
                            //             nama_lengkap : formData.get("nama_lengkap"),
                            //             no_telpon : formData.get("no_telpon"),
                            //             email : formData.get("email"),
                            //             jabatan : formData.get("jabatan"),
                            //             provinsi : formData.get("provinsi"),
                            //             alamat : formData.get("alamat"),
                            //             kota : formData.get("kota"),
                            //             kecamatan : formData.get("kecamatan"),
                            //             kelurahan : formData.get("kelurahan"),
                            //             kode_pos : formData.get("kode_pos"),
                            //             latitude : formData.get("latitude"),
                            //             longitude : formData.get("longitude"),
                            //             foto : filenamesImageOutlet,
                            //             nama_foto : nameImageOutlet,
                            //             aplikasi : formData.get("aplikasi"),
                            //             jumlah_pengambilan : formData.get("jumlah_pengambilan"),
                            //             status : formData.get("status"),
                            //             remarks : formData.get("remarks"),
                            //         }

                            //         // let daftar_outlet;
                            //         if (localStorage.getItem('daftar_outlet')===null)
                            //         {
                            //             daftar_outlet = [];
                            //         }
                            //         else
                            //         {
                            //             daftar_outlet = JSON.parse(localStorage.getItem('daftar_outlet'));
                            //         }

                            //         daftar_outlet.push(myOutlet);

                            //     }
                            //     // console.log(JSON.stringify(daftar_outlet));
                            //     localStorage.setItem('daftar_outlet',JSON.stringify(daftar_outlet));
                            // })()

                            // data outlet save localstorage
                            const myOutlet = {
                                id_customer : formData.get("id_customer"),
                                id_outlet : data.success,
                                created_date : formData.get("created_date"),
                                ar : formData.get("ar"),
                                nama_outlet : formData.get("nama_outlet"),
                                outlet_type : formData.get("outlet_type"),
                                address_type : addressType,
                                area : formData.get("area"),
                                nama_lengkap : formData.get("nama_lengkap"),
                                no_telpon : formData.get("no_telpon"),
                                email : formData.get("email"),
                                jabatan : formData.get("jabatan"),
                                provinsi : formData.get("provinsi"),
                                alamat : formData.get("alamat"),
                                kota : formData.get("kota"),
                                kecamatan : formData.get("kecamatan"),
                                kelurahan : formData.get("kelurahan"),
                                kode_pos : formData.get("kode_pos"),
                                latitude : formData.get("latitude"),
                                longitude : formData.get("longitude"),
                                foto : filenamesImageOutlet,
                                nama_foto : nameImageOutlet,
                                aplikasi : formData.get("aplikasi"),
                                jumlah_pengambilan : formData.get("jumlah_pengambilan"),
                                status : formData.get("status"),
                                remarks : formData.get("remarks"),
                            }

                            // let daftar_outlet;
                            if (localStorage.getItem('daftar_outlet')===null)
                            {
                                daftar_outlet = [];
                            }
                            else
                            {
                                daftar_outlet = JSON.parse(localStorage.getItem('daftar_outlet'));
                            }

                            daftar_outlet.push(myOutlet);

                            // console.log(JSON.stringify(daftar_outlet));
                            localStorage.setItem('daftar_outlet',JSON.stringify(daftar_outlet));

                            $.get("{{url('admin/detail_distributor/show_form')}}/" + id_customer, {}, function(data, status){
                                $("#berkas_index").html(data);
                            });
                        }
                    });



                }
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });

    });

    // function printErrorMsg (msg) {
    //     $(".print-error-msg").find("ul").html('');
    //     $(".print-error-msg").css('display','block');
    //     $.each( msg, function( key, value ) {
    //         $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    //     });
    // }

    var i = 1;

    function preview_member(event, inp) {
        var reader = new FileReader();
        // console.log(inp);
        reader.onload = function() {

            var output = document.getElementById("output_member" + inp);
            output.src = reader.result;
        };

        reader.readAsDataURL(event.target.files[0]);
    }

    jQuery(document).ready(function($) {
        //fadeout selected item and remove
        $(document).on("click", "#remove-member-fields", function(event) {
            event.preventDefault();
            $(this)
                .parent()
                .fadeOut(300, function() {
                    $(this).empty();
                    return false;
                });
        });

        //add input
        $("#add-member-fields").click(function() {
            i++;
                var rows = `<div class="foto d-flex col-12 mb-3">
                            <div class="col-2 col-md-2 p-1" style="align-self:center;">
                                <label for="takefoto${i}" class="btn btn-md btn-secondary"style="align-self:center;"><i class="uil-camera-plus"></i></label>
                                <input id="takefoto${i}" type="file" class="member_image" name="member_image[]" onchange="preview_member(event, ${i})"
                                style="visibility:hidden; width:12%;">
                            </div>
                            <div class="col-4 col-md-4 p-1">
                                <img src="{{ URL::asset('/assets/images/no-image.jpg') }}" class="img-thumbnail" id="output_member${i}">
                            </div>
                            <div class="col-5 col-md-5 p-1" style="align-self: center">
                                <input type="text" class="form-control namafoto" name="namafoto[]" id="namafoto" placeholder="Nama foto">
                            </div>
                             <button type="button" class="btn btn-danger" id="remove-member-fields" style="align-self:center;"><i class="uil-trash"></i></button>
                         </div>`;
            $(rows)
                .fadeIn("fast")
                .appendTo("#team-member-fields");
            return false;
        });
    });
</script>

