@extends('layouts.master')
@section('title') Pin Customer @endsection

@section('css')
<style>
    .pin-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.75rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 500;
    }
    .pin-status-badge.pinned {
        background: #d4edda;
        color: #155724;
    }
    .pin-status-badge.unpinned {
        background: #f8d7da;
        color: #721c24;
    }
    .map-preview-container {
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #e9ecef;
        background: #f8f9fa;
        height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .map-preview-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
    .map-placeholder {
        color: #adb5bd;
        text-align: center;
    }
    .map-placeholder i {
        font-size: 3rem;
        display: block;
        margin-bottom: 8px;
    }
    .coord-input-group .input-group-text {
        font-size: 0.75rem;
        background: #f0f4ff;
        color: #556ee6;
        border-color: #c3cbe4;
        font-weight: 600;
        min-width: 85px;
        justify-content: center;
    }
    .coord-input-group .form-control {
        border-color: #c3cbe4;
    }
    .coord-input-group .form-control:focus {
        border-color: #556ee6;
        box-shadow: 0 0 0 0.15rem rgba(85, 110, 230, 0.2);
    }
    .customer-card {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        transition: box-shadow 0.2s;
    }
    .customer-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .table th {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6c757d;
        font-weight: 600;
    }
    .btn-pin {
        background: linear-gradient(135deg, #556ee6, #6c7dea);
        border: none;
        color: #fff;
        font-size: 0.8rem;
        padding: 5px 14px;
        border-radius: 6px;
        transition: 0.2s;
    }
    .btn-pin:hover {
        background: linear-gradient(135deg, #4a5fd6, #5b6cda);
        color: #fff;
    }
    .search-box .form-control {
        border-right: 0;
    }
    .search-box .input-group-text {
        background: #fff;
        border-left: 0;
        color: #adb5bd;
    }
    /* Modal map live preview */
    #liveMapContainer {
        width: 100%;
        height: 260px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #e9ecef;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #liveMapContainer iframe {
        width: 100%;
        height: 100%;
        border: none;
    }
</style>
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Customer @endslot
    @slot('title') Pin Customer @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card customer-card">
            <div class="card-body">

                {{-- Header & Search --}}
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                    <div>
                        <h5 class="mb-0 fw-semibold">
                            <i class="uil-map-pin text-primary me-1"></i> Pin Lokasi Customer
                        </h5>
                        <p class="text-muted mb-0" style="font-size:0.85rem;">
                            Kelola koordinat latitude &amp; longitude dari setiap customer
                        </p>
                    </div>
                    <form method="GET" action="{{ route('pin.customer.index') }}" class="d-flex">
                        <div class="input-group search-box" style="width:280px;">
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Cari nama / ID customer..."
                                value="{{ $search ?? '' }}">
                            <span class="input-group-text"><i class="uil-search"></i></span>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary ms-2">Cari</button>
                        @if($search)
                            <a href="{{ route('pin.customer.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
                        @endif
                    </form>
                </div>

                {{-- Alert Success --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil-check-circle me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="uil-exclamation-triangle me-1"></i>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Tabel --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="40">#</th>
                                <th>ID Customer</th>
                                <th>Nama Customer</th>
                                <th>Alamat</th>
                                <th>AR</th>
                                <th>Status Pin</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $index => $customer)
                            <tr>
                                <td class="text-muted">{{ $customers->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary font-size-12">
                                        {{ $customer->id_customer }}
                                    </span>
                                </td>
                                <td class="fw-semibold">{{ $customer->nama_usaha }}</td>
                                <td style="max-width:200px;">
                                    <span class="text-muted" style="font-size:0.85rem;">
                                        {{ Str::limit($customer->alamat_kantor, 60, '...') ?: '-' }}
                                    </span>
                                </td>
                                <td class="text-muted" style="font-size:0.85rem;">{{ $customer->ar_name }}</td>
                                <td>
                                    @if($customer->latitude && $customer->longitude)
                                        <span class="pin-status-badge pinned">
                                            <i class="uil-map-pin"></i> Sudah Pin
                                        </span>
                                    @else
                                        <span class="pin-status-badge unpinned">
                                            <i class="uil-map-pin"></i> Belum Pin
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                        class="btn btn-pin btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalPinCustomer"
                                        data-id="{{ $customer->id }}"
                                        data-nama="{{ $customer->nama_usaha }}"
                                        data-alamat="{{ $customer->alamat_kantor }}"
                                        data-latitude="{{ $customer->latitude }}"
                                        data-longitude="{{ $customer->longitude }}">
                                        <i class="uil-map-pin me-1"></i> Pin
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="uil-map-marker-slash" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                                    Tidak ada data customer ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                    <span class="text-muted" style="font-size:0.85rem;">
                        Menampilkan {{ $customers->firstItem() ?? 0 }}–{{ $customers->lastItem() ?? 0 }}
                        dari {{ $customers->total() }} customer
                    </span>
                    {{ $customers->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

{{-- ===================== MODAL PIN CUSTOMER ===================== --}}
<div class="modal fade" id="modalPinCustomer" tabindex="-1" aria-labelledby="modalPinCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalPinCustomerLabel">
                    <i class="uil-map-pin text-primary me-2"></i>
                    Pin Lokasi Customer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formPinCustomer" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">

                        {{-- Nama Customer (readonly) --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Nama Customer <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="modal_nama" name="nama_usaha"
                                class="form-control" readonly>
                        </div>

                        {{-- Alamat (readonly) --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Alamat <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="modal_alamat" name="alamat_kantor"
                                class="form-control" readonly>
                        </div>

                        {{-- Latitude --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Latitude <span class="text-danger">*</span>
                            </label>
                            <div class="input-group coord-input-group">
                                <span class="input-group-text">LAT</span>
                                <input type="number" id="modal_latitude" name="latitude"
                                    class="form-control"
                                    placeholder="Contoh: -7.257472"
                                    step="any" required
                                    min="-90" max="90">
                            </div>
                            <div class="form-text text-muted">Rentang: -90 sampai 90</div>
                        </div>

                        {{-- Longitude --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Longitude <span class="text-danger">*</span>
                            </label>
                            <div class="input-group coord-input-group">
                                <span class="input-group-text">LNG</span>
                                <input type="number" id="modal_longitude" name="longitude"
                                    class="form-control"
                                    placeholder="Contoh: 112.752088"
                                    step="any" required
                                    min="-180" max="180">
                            </div>
                            <div class="form-text text-muted">Rentang: -180 sampai 180</div>
                        </div>

                        {{-- Preview Peta --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                <i class="uil-map me-1"></i> Preview Peta
                            </label>
                            <div id="liveMapContainer">
                                <div class="map-placeholder" id="mapPlaceholder">
                                    <i class="uil-map-marker"></i>
                                    <span style="font-size:0.9rem;">Masukkan koordinat untuk melihat peta</span>
                                </div>
                            </div>
                            <div class="form-text text-muted mt-1">
                                Peta akan diperbarui otomatis saat Anda mengisi koordinat.
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="uil-save me-1"></i> Simpan Koordinat
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // =============================================
    // Populate modal saat tombol Pin diklik
    // =============================================
    const modalEl = document.getElementById('modalPinCustomer');

    modalEl.addEventListener('show.bs.modal', function (event) {
        const btn       = event.relatedTarget;
        const id        = btn.getAttribute('data-id');
        const nama      = btn.getAttribute('data-nama');
        const alamat    = btn.getAttribute('data-alamat');
        const latitude  = btn.getAttribute('data-latitude');
        const longitude = btn.getAttribute('data-longitude');

        // Set action URL
        document.getElementById('formPinCustomer').action =
            '{{ url("admin/pin-customer") }}/' + id + '/update';

        // Isi field
        document.getElementById('modal_nama').value      = nama;
        document.getElementById('modal_alamat').value    = alamat;
        document.getElementById('modal_latitude').value  = latitude  || '';
        document.getElementById('modal_longitude').value = longitude || '';

        // Render peta jika sudah ada koordinat
        if (latitude && longitude) {
            renderMap(latitude, longitude);
        } else {
            clearMap();
        }
    });

    // =============================================
    // Live preview peta saat koordinat diubah
    // =============================================
    let mapDebounce;

    ['modal_latitude', 'modal_longitude'].forEach(function(id) {
        document.getElementById(id).addEventListener('input', function() {
            clearTimeout(mapDebounce);
            mapDebounce = setTimeout(function() {
                const lat = parseFloat(document.getElementById('modal_latitude').value);
                const lng = parseFloat(document.getElementById('modal_longitude').value);

                if (!isNaN(lat) && !isNaN(lng) &&
                    lat >= -90 && lat <= 90 &&
                    lng >= -180 && lng <= 180) {
                    renderMap(lat, lng);
                } else {
                    clearMap();
                }
            }, 600); // debounce 600ms
        });
    });

    function renderMap(lat, lng) {
        const container   = document.getElementById('liveMapContainer');
        const placeholder = document.getElementById('mapPlaceholder');

        // Buat atau perbarui iframe
        let iframe = container.querySelector('iframe');
        if (!iframe) {
            iframe = document.createElement('iframe');
            iframe.setAttribute('allowfullscreen', '');
            iframe.setAttribute('loading', 'lazy');
            iframe.setAttribute('referrerpolicy', 'no-referrer-when-downgrade');
            container.appendChild(iframe);
        }

        if (placeholder) placeholder.style.display = 'none';

        // Google Maps embed URL menggunakan koordinat langsung
        iframe.src = 'https://maps.google.com/maps?q=' + lat + ',' + lng +
                     '&z=16&output=embed';
    }

    function clearMap() {
        const container   = document.getElementById('liveMapContainer');
        const placeholder = document.getElementById('mapPlaceholder');
        const iframe      = container.querySelector('iframe');

        if (iframe) iframe.remove();
        if (placeholder) placeholder.style.display = 'flex';
    }

    // Reset modal saat ditutup
    modalEl.addEventListener('hidden.bs.modal', function () {
        clearMap();
        document.getElementById('modal_latitude').value  = '';
        document.getElementById('modal_longitude').value = '';
    });
</script>
@endsection
