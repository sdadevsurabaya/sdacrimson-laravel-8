<style>
    .loading{
        display: none;
    }
</style>
<h3 class="card-title">Form Berkas Pendukung</h3>
<form id="create_attachment" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
    {!! csrf_field() !!}
    @csrf
    <div class="col-md-12">
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


    <div class="input-group hdtuto control-group lst increment" >
        {{-- <input type="file" name="filenames[]" class="myfrm form-control"> --}}
        <div class="input-group-btn">
            <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Tambah Lampiran</button>
        </div>
    </div>
    <div class="clone hide">
        <div class="hdtuto control-group lst input-group"
            style="margin-top:10px">
            <input type="file" name="filenames[]"
                class="myfrm form-control filenames">
            <div class="input-group-btn me-3">
                <button class="btn btn-danger" type="button"><i
                        class="fldemo glyphicon glyphicon-remove"></i>
                    Hapus</button>
            </div>
            <div style="align-self: center">
                <input type="text" class="form-control namaFile" name="namaFile[]" id="namafile" placeholder="Nama File">
            </div>
        </div>
    </div>

    <div class="col-12 mt-3 text-center selanjutnya">
        {{-- <button type="reset" class="btn btn-success">Reset</button> --}}
        <button type="submit" class="btn btn-primary">Simpan Data</button>
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
        $(".btn-success").click(function() {
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);

        });

        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".hdtuto").remove();

        });

        $('#create_attachment').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var id_customer = $("#id_customer").val();
            // console.log(formData);

            Swal.fire({
                icon: 'warning',
                title: 'Cek Data',
                text: 'Sebelum data tersimpan pastikan data yang anda masukkan sudah benar !',
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
                            url: "{{ url('admin/attachment/store') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: (data) => {
                                if ($.isEmptyObject(data.error)) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Baru ditambahkan. ',
                                        text: 'Data Baru dengan ID Customer '+id_customer+' Berhasil ditambahkan.',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });

                                    window.location.href = "{{url('admin/generals')}}";
                                    // $.get(" {{url('admin/attachment/show_form')}}/" + id_customer, {}, function(data, status){
                                    //     $("#berkas_index").html(data);
                                    // });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal ditambahkan. ',
                                        text: 'Data Attachment Belum Lengkap.',
                                        showConfirmButton: true,
                                        // timer: 3000
                                    });
                                    document.getElementsByClassName('selanjutnya')[0].style.display = "block";
                                    document.getElementsByClassName("loading")[0].style.display = "none";
                                }
                            }
                        });
                    } else {
                        // multiple image
                        const nameAttachment = [];
                        const namaFile = document.querySelectorAll(".namaFile")
                        for(let name of namaFile){
                            const pushNameData = name.value
                            nameAttachment.push(pushNameData)
                        }

                        let filenamesAttachment = [];
                        const files = document.querySelectorAll(".filenames")

                        let n = 0;
                        ;(async function() {
                            let daftar_attachment;
                            for(let item of files){
                                let filedata = item.files[0]
                                const reader = new FileReader();
                                reader.readAsDataURL(filedata);
                                // process isi file di sini

                                await new Promise(resolve => reader.onload = () => resolve());
                                // let resultFiledata = reader.result
                                // let pecahBase64 = resultFiledata.split(",")
                                // let pushFiledata = pecahBase64[1]
                                let pushFiledata = reader.result

                                filenamesAttachment[n] = pushFiledata;
                                // filenamesAttachment[n] = pecahBase64[1];
                                n++;

                                const myAttachment = {
                                    id_customer : formData.get("id_customer"),
                                    created_date : formData.get("created_date"),
                                    ar : formData.get("ar"),
                                    filenames : filenamesAttachment,
                                    namaFile : nameAttachment,
                                }

                                // let daftar_attachment;
                                if (localStorage.getItem('daftar_attachment')===null)
                                {
                                    daftar_attachment = [];
                                }
                                else
                                {
                                    daftar_attachment = JSON.parse(localStorage.getItem('daftar_attachment'));
                                }

                                daftar_attachment.push(myAttachment);

                            }
                            // console.log(JSON.stringify(daftar_attachment));
                            localStorage.setItem('daftar_attachment',JSON.stringify(daftar_attachment));
                        })()

                        window.location.href = "{{url('admin/generals')}}";
                    }
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            });
        });
    });
</script>
