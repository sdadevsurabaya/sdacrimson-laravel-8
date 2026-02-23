@extends('layouts.master')
@section('title')
    Report Journey Plan
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Report
        @endslot
        @slot('title')
            Report Journey Plan
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('laporan.journeyPlan.print') }}" method="GET" target="_blank">
                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label for="user" class="col-form-label">Sales / PIC</label>
                                <div>
                                    <select class="form-select" name="user" id="user" required>
                                        <option value="">-- Pilih Sales --</option>
                                        @foreach ($users as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="start" class="col-form-label">Start Date</label>
                                <div>
                                    <input type="date" class="form-control" id="start" name="start" required>
                                </div>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="end" class="col-form-label">End Date</label>
                                <div>
                                    <input type="date" class="form-control" id="end" name="end" required>
                                </div>
                            </div>

                            <div class="text-center col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Preview Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
