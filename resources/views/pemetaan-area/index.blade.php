@extends('layouts.master')
@section('title')
    @lang('Pemetaan Wilayah')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Filter Pemetaan Area</h4>
                    <p class="card-title-desc">Filter customer berdasarkan Kota dan Area untuk merencanakan delivery.</p>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    <form action="{{ route('pemetaan.area.index') }}" method="GET">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="filter_kota">Kota</label>
                                    <select class="form-control select2" id="filter_kota" name="kota">
                                        <option value="">-- Semua Kota --</option>
                                        @foreach($kotas as $kota)
                                            <option value="{{ $kota->kota }}" {{ request('kota') == $kota->kota ? 'selected' : '' }}>{{ $kota->kota }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="filter_area">Area</label>
                                    <select class="form-control select2" id="filter_area" name="area">
                                        <option value="">-- Semua Area --</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->area }}" {{ request('area') == $area->area ? 'selected' : '' }}>{{ $area->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-md">Filter</button>
                                    <a href="{{ route('pemetaan.area.index') }}" class="btn btn-secondary w-md">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Customer</th>
                                    <th>Nama Usaha</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Area</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $key => $customer)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $customer->id_customer }}</td>
                                    <td>{{ $customer->nama_usaha }}</td>
                                    <td>{{ $customer->alamat_kantor }}</td>
                                    <td>{{ $customer->kota ?: '-' }}</td>
                                    <td>{{ $customer->area ?: '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" onclick="setArea({{ $customer->id }}, '{{ addslashes($customer->kota) }}', '{{ addslashes($customer->area) }}')">Set Area</button>
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

    {{-- Modal Set Area --}}
    <div class="modal fade" id="ModalSetArea" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setting Area Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_set_area" method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <select class="form-control select2" name="kota" id="set_kota" required>
                                <option value="">-- Pilih Kota --</option>
                                @foreach($kotas as $kota)
                                    <option value="{{ $kota->kota }}">{{ $kota->kota }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Area</label>
                            <select class="form-control select2" name="area" id="set_area" required>
                                <option value="">-- Pilih Area --</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->area }}" data-kota="{{ $area->kota }}">{{ $area->area }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true
            });
            
            // Cascading filter for Modal Set Area
            $('#set_kota').on('change', function() {
                var selectedKota = $(this).val();
                
                $('#set_area option').each(function() {
                    if ($(this).val() == '') return; // Skip default option
                    
                    if (selectedKota == '' || $(this).data('kota') == selectedKota) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                
                // Reset area if current selection is hidden
                if ($('#set_area option:selected').css('display') == 'none') {
                    $('#set_area').val('');
                }
            });
        });

        function setArea(id, kota, area) {
            $('#set_kota').val(kota).trigger('change');
            
            // Slight delay to allow options to be shown/hidden
            setTimeout(function() {
                $('#set_area').val(area);
            }, 50);
            
            $('#form_set_area').attr('action', "{{ url('delivery-planner/pemetaan-area') }}/" + id);
            $('#ModalSetArea').modal('show');
        }
    </script>
@endsection
