@extends('layouts.master')
@section('title')
@lang('Cek Duplikat Customer')
@endsection

@section('css')
<style>
    .customer-box {
        border: 1px solid #ccc;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
        height: 100%;
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle')
Master Customer
@endslot
@slot('title')
Cek Duplikat Customer
@endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Check Customer</h4>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchKeyword" placeholder="Cari nama customer (contoh: PT KAI)...">
                            <button class="btn btn-primary" type="button" id="btnSearch">Search</button>
                        </div>
                    </div>
                </div>

                <div id="searchResult" style="display: none; margin-bottom: 20px;">
                    <div class="alert alert-info d-flex align-items-center justify-content-between mb-0">
                        <div>
                            Ada temuan <span id="resultCount" class="fw-bold">0</span> customer dengan kata kunci "<span id="keywordText" class="fw-bold"></span>"
                        </div>
                        <button class="btn btn-sm btn-warning fw-bold text-dark" id="btnBandingkan">Bandingkan</button>
                    </div>
                </div>

                <div id="compareSection" style="display: none;">
                    <hr>
                    <div class="row mb-4" id="compareGrid">
                        <!-- Disini customer boxes di render oleh jquery -->
                    </div>

                    <div class="bg-light p-4 rounded">
                        <h5 class="mb-3">Move (Gabungkan History)</h5>
                        <div class="row align-items-end">
                            <div class="col-md-5">
                                <label class="fw-bold">Customer Asal (Akan dihapus history-nya dipindah)</label>
                                <select id="sourceCustomer" class="form-select">
                                    <option value="">Pilih Customer 1</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="fw-bold">Customer Tujuan (Tetap dipertahankan)</label>
                                <select id="destinationCustomer" class="form-select">
                                    <option value="">Pilih Customer 2</option>
                                </select>
                            </div>
                            <div class="col-md-2 text-end">
                                <button class="btn btn-primary w-100" id="btnPindahkan">Pindahkan</button>
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
<script>
    $(document).ready(function() {
        let currentIds = [];
        let currentCustomers = [];

        $('#btnSearch').click(function() {
            let keyword = $('#searchKeyword').val();
            if(!keyword) {
                alert('Silahkan masukkan kata kunci');
                return;
            }

            $('#btnSearch').prop('disabled', true).text('Searching...');

            $.ajax({
                url: '{{ route("duplicate.customer.search") }}',
                type: 'GET',
                data: { keyword: keyword },
                success: function(response) {
                    currentCustomers = response;
                    currentIds = response.map(c => c.id);
                    
                    $('#keywordText').text(keyword);
                    $('#resultCount').text(response.length);
                    $('#searchResult').show();
                    $('#compareSection').hide();
                },
                error: function(err) {
                    alert('Terjadi kesalahan saat mencari data');
                },
                complete: function() {
                    $('#btnSearch').prop('disabled', false).text('Search');
                }
            });
        });

        // Trigger search on enter
        $('#searchKeyword').keypress(function(e) {
            if(e.which == 13) {
                $('#btnSearch').click();
            }
        });

        $('#btnBandingkan').click(function() {
            if(currentIds.length == 0) {
                alert('Tidak ada data untuk dibandingkan');
                return;
            }

            let btn = $(this);
            btn.prop('disabled', true).text('Loading...');

            $.ajax({
                url: '{{ route("duplicate.customer.compare") }}',
                type: 'GET',
                data: { ids: currentIds },
                success: function(response) {
                    $('#compareGrid').empty();
                    $('#sourceCustomer').empty().append('<option value="">Pilih Customer Asal</option>');
                    $('#destinationCustomer').empty().append('<option value="">Pilih Customer Tujuan</option>');

                    response.forEach(function(c, index) {
                        let namaUsaha = c.nama_usaha || c.nama_lengkap || '-';
                        let box = `
                            <div class="col-md-4 mb-3">
                                <div class="customer-box shadow-sm">
                                    <h5 class="text-primary mb-1">Customer ${index + 1}</h5>
                                    <h6 class="mb-1">${namaUsaha}</h6>
                                    <p class="text-muted small mb-3">ID: ${c.id_customer || '-'}</p>
                                    <hr>
                                    <h6 class="font-size-13">History Customer ${index + 1}</h6>
                                    <ul class="list-group list-group-flush small">
                                        <li class="list-group-item bg-transparent px-0 d-flex justify-content-between align-items-center">
                                            Jadwal Kunjungan <span class="badge bg-danger rounded-pill" style="font-size: 14px; padding: 6px 12px;">${c.jadwals_count}</span>
                                        </li>
                                        <li class="list-group-item bg-transparent px-0 d-flex justify-content-between align-items-center">
                                            Kehadiran (Check-In) <span class="badge bg-danger rounded-pill" style="font-size: 14px; padding: 6px 12px;">${c.attendances_count}</span>
                                        </li>
                                        <li class="list-group-item bg-transparent px-0 d-flex justify-content-between align-items-center">
                                            Laporan Sales <span class="badge bg-danger rounded-pill" style="font-size: 14px; padding: 6px 12px;">${c.laporan_count}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        `;
                        $('#compareGrid').append(box);

                        let option = `<option value="${c.id}">Customer ${index + 1}: ${namaUsaha} (ID: ${c.id_customer})</option>`;
                        $('#sourceCustomer').append(option);
                        $('#destinationCustomer').append(option);
                    });

                    $('#compareSection').slideDown();
                },
                error: function(err) {
                    alert('Terjadi kesalahan saat membandingkan data');
                },
                complete: function() {
                    btn.prop('disabled', false).text('Bandingkan');
                }
            });
        });

        $('#btnPindahkan').click(function() {
            let source_id = $('#sourceCustomer').val();
            let destination_id = $('#destinationCustomer').val();

            if(!source_id || !destination_id) {
                alert('Silahkan pilih customer asal dan tujuan');
                return;
            }

            if(source_id === destination_id) {
                alert('Customer asal dan tujuan tidak boleh sama');
                return;
            }

            if(confirm('Apakah Anda yakin ingin memindahkan histori? Customer asal akan dihapus. Aksi ini tidak dapat dibatalkan.')) {
                let btn = $(this);
                let originalText = btn.text();
                btn.prop('disabled', true).text('Memproses...');

                $.ajax({
                    url: '{{ route("duplicate.customer.merge") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        source_id: source_id,
                        destination_id: destination_id
                    },
                    success: function(response) {
                        if(response.success) {
                            alert(response.message);
                            $('#compareSection').hide();
                            $('#btnSearch').click(); // Reload search results
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(err) {
                        alert('Terjadi kesalahan sistem saat memproses pemindahan data.');
                    },
                    complete: function() {
                        btn.prop('disabled', false).text(originalText);
                    }
                });
            }
        });
    });
</script>
@endsection
