@extends('layouts.master')
@section('title') Pin Customer @endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Leaflet CSS -->
    <link href="{{ URL::asset('/assets/libs/leaflet/leaflet.min.css') }}" rel="stylesheet" type="text/css" />
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
        /* Modal map live preview */
        #liveMapContainer {
            width: 100%;
            height: 350px;
            border-radius: 8px;
            overflow: hidden;
            border: 2px solid #e9ecef;
            background: #f8f9fa;
            position: relative;
        }
        .map-placeholder {
            color: #adb5bd;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            z-index: 0;
        }
        .map-placeholder i {
            font-size: 3rem;
            display: block;
            margin-bottom: 8px;
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
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h5 class="mb-0 fw-semibold">
                            <i class="uil-map-pin text-primary me-1"></i> Pin Lokasi Customer
                        </h5>
                        <p class="text-muted mb-0" style="font-size:0.85rem;">
                            Kelola koordinat latitude &amp; longitude dari setiap customer
                        </p>
                    </div>
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

                {{-- Tabel DataTable --}}
                <div class="table-responsive">
                    <table id="datatable-pin-customer"
                           class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse:collapse; border-spacing:0; width:100%;">
                        <thead>
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
                            @foreach($customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary font-size-12">
                                        {{ $customer->id_customer }}
                                    </span>
                                </td>
                                <td class="fw-semibold">{{ $customer->nama_usaha }}</td>
                                <td style="max-width:500px;">
                                    <span class="text-muted" style="font-size:0.85rem;">
                                        {{ $customer->alamat_kantor ?: '-' }}
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
                            @endforeach
                        </tbody>
                    </table>
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

                        {{-- Alamat --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Alamat <span class="text-danger">*</span>
                            </label>
                            <textarea id="modal_alamat" name="alamat_kantor"
                                class="form-control" rows="2" placeholder="Alamat akan terisi otomatis..."></textarea>
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
                                <i class="uil-map me-1"></i> Tentukan Titik Lokasi
                            </label>
                            <div id="liveMapContainer" style="z-index: 1;">
                                <div class="map-placeholder" id="mapPlaceholder">
                                    <i class="uil-map-marker"></i>
                                    <span style="font-size:0.9rem;">Peta akan muncul di sini.</span>
                                </div>
                            </div>
                            <div class="form-text text-muted mt-1">
                                Klik pada peta atau geser pin merah untuk mengubah koordinat secara otomatis.
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
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    
    <!-- Leaflet JS -->
    <script src="{{ URL::asset('/assets/libs/leaflet/leaflet.min.js') }}"></script>

    <script>
        // Init DataTable
        $(document).ready(function () {
            $('#datatable-pin-customer').DataTable({
                language: {
                    search:        "Cari:",
                    lengthMenu:    "Tampilkan _MENU_ data",
                    info:          "Menampilkan _START_ sampai _END_ dari _TOTAL_ customer",
                    infoEmpty:     "Menampilkan 0 sampai 0 dari 0 customer",
                    paginate: {
                        first:    "Pertama",
                        last:     "Terakhir",
                        next:     "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords:  "Tidak ada data yang cocok",
                    emptyTable:   "Tidak ada data customer"
                },
                order: [[0, 'asc']],
                columnDefs: [
                    { orderable: false, targets: [6] } // kolom Aksi tidak bisa di-sort
                ]
            });
        });

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

            // Render peta
            // Always initialize map, if latitude/longitude empty, init without marker
            initMap(latitude, longitude);
        });

        // =============================================
        // Live preview & Interactive Map
        // =============================================
        let map = null;
        let marker = null;
        let mapDebounce;

        const defaultLat = -7.257472;
        const defaultLng = 112.752088;

        function initMap(lat, lng) {
            const container = document.getElementById('liveMapContainer');
            const placeholder = document.getElementById('mapPlaceholder');
            
            if (placeholder) placeholder.style.display = 'none';

            let centerLat = lat ? parseFloat(lat) : defaultLat;
            let centerLng = lng ? parseFloat(lng) : defaultLng;

            if (!map) {
                map = L.map('liveMapContainer').setView([centerLat, centerLng], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                map.on('click', function(e) {
                    updateCoordinates(e.latlng.lat, e.latlng.lng, true);
                });
            } else {
                map.setView([centerLat, centerLng], 15);
            }

            if (lat && lng) {
                if (marker) {
                    marker.setLatLng([centerLat, centerLng]);
                } else {
                    marker = L.marker([centerLat, centerLng], { draggable: true }).addTo(map);
                    marker.on('dragend', function(e) {
                        const position = marker.getLatLng();
                        updateCoordinates(position.lat, position.lng, true);
                    });
                }
            } else if (marker) {
                map.removeLayer(marker);
                marker = null;
            }

            // Invalidate size to prevent partial rendering in modal
            setTimeout(function() {
                if (map) {
                    map.invalidateSize();
                }
            }, 300);
        }

        function reverseGeocode(lat, lng) {
            const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
            
            const alamatInput = document.getElementById('modal_alamat');
            const originalAlamat = alamatInput.value;
            alamatInput.value = 'Mengambil alamat...';
            
            fetch(url, {
                headers: {
                    'Accept-Language': 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    alamatInput.value = data.display_name;
                } else {
                    alamatInput.value = originalAlamat;
                }
            })
            .catch(err => {
                console.error('Geocoding error:', err);
                alamatInput.value = originalAlamat;
            });
        }

        function updateCoordinates(lat, lng, fetchAddress = false) {
            document.getElementById('modal_latitude').value = lat.toFixed(6);
            document.getElementById('modal_longitude').value = lng.toFixed(6);
            
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], { draggable: true }).addTo(map);
                marker.on('dragend', function(e) {
                    const position = marker.getLatLng();
                    updateCoordinates(position.lat, position.lng, true);
                });
            }
            
            if (fetchAddress) {
                reverseGeocode(lat, lng);
            }
        }

        ['modal_latitude', 'modal_longitude'].forEach(function(id) {
            document.getElementById(id).addEventListener('input', function() {
                clearTimeout(mapDebounce);
                mapDebounce = setTimeout(function() {
                    const lat = parseFloat(document.getElementById('modal_latitude').value);
                    const lng = parseFloat(document.getElementById('modal_longitude').value);

                    if (!isNaN(lat) && !isNaN(lng) &&
                        lat >= -90 && lat <= 90 &&
                        lng >= -180 && lng <= 180) {
                        initMap(lat, lng);
                    }
                }, 600);
            });
        });

        // Reset modal saat ditutup
        modalEl.addEventListener('hidden.bs.modal', function () {
            document.getElementById('modal_latitude').value  = '';
            document.getElementById('modal_longitude').value = '';
            const placeholder = document.getElementById('mapPlaceholder');
            if (placeholder) placeholder.style.display = 'block';
            
            if (map) {
                map.remove();
                map = null;
                marker = null;
            }
        });
    </script>
@endsection
