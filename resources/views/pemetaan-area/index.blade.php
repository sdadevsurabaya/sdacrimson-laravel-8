@extends('layouts.master')
@section('title')
    @lang('Pemetaan Wilayah')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        /* === Master Area Panel === */
        .master-area-panel {
            background:linear-gradient(135deg, #dd939d 0%, #c94d60 60%, #871726 100%);
            border-radius: 12px;
            padding: 24px 28px;
            color: #fff;
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .master-area-panel::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 180px; height: 180px;
            background: rgba(255,255,255,.06);
            border-radius: 50%;
        }
        .master-area-panel .panel-label {
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            opacity: .7;
            margin-bottom: 4px;
        }
        .master-area-panel h5 {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .master-area-panel .form-label { color: rgba(255,255,255,.85); font-size: 13px; }
        .master-area-panel .form-control,
        .master-area-panel .form-select {
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            color: #fff;
            border-radius: 8px;
        }
        .master-area-panel .form-control::placeholder { color: rgba(255,255,255,.5); }
        .master-area-panel .form-control option,
        .master-area-panel .form-select option { color: #222; background: #fff; }
        .master-area-panel .select2-container--default .select2-selection--single {
            background: rgba(255,255,255,.15) !important;
            border: 1px solid rgba(255,255,255,.25) !important;
            border-radius: 8px !important;
            height: 38px !important;
        }
        .master-area-panel .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff !important;
            line-height: 38px !important;
            padding-left: 12px !important;
        }
        .master-area-panel .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 6px !important;
        }
        /* Active area badge */
        #active-area-badge {
            display: none;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 20px;
            padding: 6px 18px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .3px;
        }
        /* Assign button */
        #btn-bulk-assign {
            display: none;
            background: #fff;
            color: #2d3494;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 9px 24px;
            font-size: 14px;
            transition: all .2s;
            box-shadow: 0 4px 14px rgba(0,0,0,.15);
        }
        #btn-bulk-assign:hover { background: #f0f2ff; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,0,0,.2); }
        #btn-bulk-assign i { margin-right: 6px; }
        /* Counter badge */
        #selected-count-badge {
            display: none;
            background: #ff5c5c;
            color: #fff;
            border-radius: 50%;
            width: 22px; height: 22px;
            font-size: 12px;
            font-weight: 700;
            line-height: 22px;
            text-align: center;
            display: inline-block;
            vertical-align: middle;
            margin-left: 6px;
        }
        /* Table checkbox col */
        .table th.col-check, .table td.col-check { width: 40px; text-align: center; vertical-align: middle; }
        .form-check-input[type="checkbox"] { width: 17px; height: 17px; cursor: pointer; }
        /* Row highlight when checked */
        tr.row-selected { background-color: #e8edff !important; }
        /* Status pill */
        .badge-area-set { background: #d4edda; color: #155724; border-radius: 20px; padding: 3px 10px; font-size: 12px; font-weight: 600; }
        .badge-area-empty { background: #f8d7da; color: #721c24; border-radius: 20px; padding: 3px 10px; font-size: 12px; font-weight: 600; }
        /* Filter card */
        .filter-card { border-radius: 10px; border: 1px solid #e9ecef; }
        /* Sticky action bar */
        #bulk-action-bar {
            display: none;
            position: sticky;
            bottom: 20px;
            z-index: 100;
            background: #2d3494;
            border-radius: 12px;
            padding: 14px 24px;
            color: #fff;
            box-shadow: 0 8px 30px rgba(45,52,148,.4);
            animation: slideUp .25s ease;
        }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .action-bar-area-name { font-weight: 700; font-size: 15px; }
        .action-bar-count { font-size: 13px; opacity: .8; }
        #btn-confirm-assign {
            background: #fff; color: #2d3494; font-weight: 700;
            border: none; border-radius: 8px; padding: 8px 22px;
            transition: all .2s;
        }
        #btn-confirm-assign:hover { background: #f0f2ff; }
        #btn-cancel-assign { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.3); border-radius: 8px; padding: 8px 18px; font-size: 13px; }
        #btn-cancel-assign:hover { background: rgba(255,255,255,.25); }
    </style>
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Delivery Planner
        @endslot
        @slot('title')
            Pemetaan Area Customer
        @endslot
    @endcomponent

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ===================== STEP 1: PILIH MASTER AREA ===================== --}}
    <div class="master-area-panel">
        <p class="panel-label">Langkah 1</p>
        <h5><i class="mdi mdi-map-marker-radius me-2"></i>Pilih Master Area</h5>
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Kota</label>
                <select id="master_kota" class="form-control">
                    <option value="">-- Pilih Kota --</option>
                    @foreach($kotas as $kota)
                        <option value="{{ $kota->kota }}">{{ $kota->kota }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Area</label>
                <select id="master_area" class="form-control" disabled>
                    <option value="">-- Pilih Area --</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->area }}" data-kota="{{ $area->kota }}">{{ $area->area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <div id="active-area-badge" class="mb-2">
                    <i class="mdi mdi-check-circle me-1"></i>
                    <span id="badge-kota-text"></span> &rsaquo; <span id="badge-area-text"></span>
                </div>
                <div class="text-white-50 small" id="hint-select-area">Pilih kota dan area terlebih dahulu</div>
            </div>
        </div>
    </div>

    {{-- ===================== STEP 2: FILTER + TABLE ===================== --}}
    <div class="row">
        <div class="col-12">
            <div class="card filter-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="card-title mb-1"><i class="mdi mdi-account-group me-2 text-primary"></i>Daftar Customer</h5>
                            <p class="text-muted small mb-0">Langkah 2: Centang customer yang masuk area yang dipilih, lalu klik <strong>Assign</strong>.</p>
                        </div>
                        {{-- Filter Form --}}
                        <form action="{{ route('pemetaan.area.index') }}" method="GET" class="d-flex gap-2 align-items-end">
                            <div>
                                <label class="form-label small mb-1">Filter Kota</label>
                                <select class="form-select form-select-sm" name="kota" style="min-width:140px;">
                                    <option value="">Semua Kota</option>
                                    @foreach($kotas as $kota)
                                        <option value="{{ $kota->kota }}" {{ request('kota') == $kota->kota ? 'selected' : '' }}>{{ $kota->kota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label small mb-1">Filter Area</label>
                                <select class="form-select form-select-sm" name="area" style="min-width:140px;">
                                    <option value="">Semua Area</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->area }}" {{ request('area') == $area->area ? 'selected' : '' }}>{{ $area->area }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex gap-1">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-filter me-1"></i>Filter</button>
                                <a href="{{ route('pemetaan.area.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-bordered dt-responsive nowrap" style="width:100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="col-check">
                                        <input type="checkbox" id="check-all" class="form-check-input" title="Pilih Semua">
                                    </th>
                                    <th>No</th>
                                    <th>ID Customer</th>
                                    <th>Nama Usaha</th>
                                    <th>Alamat</th>
                                    <th>Kota Saat Ini</th>
                                    <th>Area Saat Ini</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key => $customer)
                                <tr id="row-{{ $customer->id }}" data-id="{{ $customer->id }}">
                                    <td class="col-check">
                                        <input type="checkbox" class="form-check-input row-check"
                                               value="{{ $customer->id }}"
                                               data-name="{{ $customer->nama_usaha }}">
                                    </td>
                                    <td>{{ $key + 1 }}</td>
                                    <td><span class="font-monospace small">{{ $customer->id_customer }}</span></td>
                                    <td><strong>{{ $customer->nama_usaha }}</strong></td>
                                    <td class="text-muted small">{{ Str::limit($customer->alamat_kantor, 50) }}</td>
                                    <td>
                                        @if($customer->kota)
                                            <span class="badge-area-set">{{ $customer->kota }}</span>
                                        @else
                                            <span class="badge-area-empty">Belum diset</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($customer->area)
                                            <span class="badge-area-set">{{ $customer->area }}</span>
                                        @else
                                            <span class="badge-area-empty">Belum diset</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"
                                                onclick="openSetArea({{ $customer->id }}, '{{ addslashes($customer->nama_usaha) }}', '{{ addslashes($customer->kota) }}', '{{ addslashes($customer->area) }}')">
                                            <i class="mdi mdi-pencil"></i> Edit
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

    {{-- ===================== STICKY BULK ACTION BAR ===================== --}}
    <div id="bulk-action-bar">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="action-bar-area-name" id="bar-area-name">—</div>
                <div class="action-bar-count"><span id="bar-count">0</span> customer dipilih</div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" id="btn-cancel-assign" onclick="clearSelection()">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" id="btn-confirm-assign" onclick="submitBulkAssign()">
                    <i class="mdi mdi-content-save-check me-1"></i>Assign ke Area Ini
                </button>
            </div>
        </div>
    </div>

    {{-- Hidden bulk form --}}
    <form id="form-bulk-assign" action="{{ route('pemetaan.area.bulk') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="kota" id="bulk_kota">
        <input type="hidden" name="area" id="bulk_area">
        <div id="bulk_customer_ids"></div>
    </form>

    {{-- ===================== MODAL EDIT INDIVIDUAL ===================== --}}
    <div class="modal fade" id="ModalSetArea" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="mdi mdi-pencil-box me-2"></i>Edit Area Customer</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-3" id="modal-customer-name"></p>
                    <form id="form_set_area" method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kota</label>
                            <select class="form-control select2" name="kota" id="set_kota" required>
                                <option value="">-- Pilih Kota --</option>
                                @foreach($kotas as $kota)
                                    <option value="{{ $kota->kota }}">{{ $kota->kota }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Area</label>
                            <select class="form-control select2" name="area" id="set_area" required>
                                <option value="">-- Pilih Area --</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->area }}" data-kota="{{ $area->kota }}">{{ $area->area }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex gap-2 justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-content-save me-1"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>

    <script>
    $(document).ready(function () {

        // ── DataTable ──────────────────────────────────────────────
        $('#datatable').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ customer",
                paginate: { previous: "‹", next: "›" }
            },
            columnDefs: [{ orderable: false, targets: [0, 7] }]
        });

        // ── Cascading Master Area Panel ───────────────────────────
        $('#master_kota').on('change', function () {
            var kota = $(this).val();
            $('#master_area').val('').prop('disabled', true);
            $('#active-area-badge').hide();
            $('#hint-select-area').show().text('Pilih area untuk kota ini');

            $('#master_area option').each(function () {
                if (!$(this).val()) return;
                $(this).toggle(kota === '' || $(this).data('kota') === kota);
            });
            if (kota) $('#master_area').prop('disabled', false);

            updateActionBar();
        });

        $('#master_area').on('change', function () {
            var area = $(this).val();
            var kota = $('#master_kota').val();
            if (area && kota) {
                $('#badge-kota-text').text(kota);
                $('#badge-area-text').text(area);
                $('#active-area-badge').fadeIn(200);
                $('#hint-select-area').hide();
            } else {
                $('#active-area-badge').hide();
                $('#hint-select-area').show().text('Pilih kota dan area terlebih dahulu');
            }
            updateActionBar();
        });

        // ── Check All ─────────────────────────────────────────────
        $('#check-all').on('change', function () {
            var checked = $(this).is(':checked');
            // Only check visible rows (DataTable pagination)
            $('#datatable tbody tr:visible .row-check').prop('checked', checked);
            $('#datatable tbody tr:visible').toggleClass('row-selected', checked);
            updateActionBar();
        });

        // ── Row Checkboxes ────────────────────────────────────────
        $(document).on('change', '.row-check', function () {
            var $row = $(this).closest('tr');
            $row.toggleClass('row-selected', $(this).is(':checked'));
            // Sync check-all state
            var total = $('.row-check').length;
            var checked = $('.row-check:checked').length;
            $('#check-all').prop('indeterminate', checked > 0 && checked < total);
            $('#check-all').prop('checked', checked === total && total > 0);
            updateActionBar();
        });

        // ── Modal cascading (individual edit) ─────────────────────
        $('#set_kota').on('change', function () {
            var kota = $(this).val();
            $('#set_area option').each(function () {
                if (!$(this).val()) return;
                $(this).toggle(kota === '' || $(this).data('kota') === kota);
            });
            if ($('#set_area option:selected').is(':hidden')) $('#set_area').val('');
        });
    });

    // ── Update action bar ─────────────────────────────────────────
    function updateActionBar () {
        var count = $('.row-check:checked').length;
        var kota  = $('#master_kota').val();
        var area  = $('#master_area').val();

        $('#bar-count').text(count);
        $('#bar-area-name').text(kota && area ? area + ' (' + kota + ')' : '—');

        var show = count > 0 && kota && area;
        if (show) {
            $('#bulk-action-bar').fadeIn(200);
        } else {
            $('#bulk-action-bar').fadeOut(150);
        }
    }

    // ── Clear selection ───────────────────────────────────────────
    function clearSelection () {
        $('.row-check').prop('checked', false);
        $('#check-all').prop('checked', false).prop('indeterminate', false);
        $('tr').removeClass('row-selected');
        updateActionBar();
    }

    // ── Submit bulk assign ────────────────────────────────────────
    function submitBulkAssign () {
        var kota  = $('#master_kota').val();
        var area  = $('#master_area').val();
        var ids   = [];
        $('.row-check:checked').each(function () { ids.push($(this).val()); });

        if (!kota || !area) { alert('Pilih Kota dan Area terlebih dahulu.'); return; }
        if (!ids.length)    { alert('Pilih minimal 1 customer.'); return; }

        if (!confirm('Assign ' + ids.length + ' customer ke area "' + area + ' (' + kota + ')"?')) return;

        $('#bulk_kota').val(kota);
        $('#bulk_area').val(area);

        var html = '';
        ids.forEach(function (id) {
            html += '<input type="hidden" name="customer_ids[]" value="' + id + '">';
        });
        $('#bulk_customer_ids').html(html);

        $('#form-bulk-assign').submit();
    }

    // ── Individual edit modal ─────────────────────────────────────
    function openSetArea (id, nama, kota, area) {
        $('#modal-customer-name').text(nama);
        $('#set_kota').val(kota).trigger('change');
        setTimeout(function () { $('#set_area').val(area); }, 60);
        $('#form_set_area').attr('action', "{{ url('delivery-planner/pemetaan-area') }}/" + id);
        $('#ModalSetArea').modal('show');
    }
    </script>
@endsection
