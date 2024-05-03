@extends('layouts.master')
@section('title')
    @lang('translation.Add_Product')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            User Managament
        @endslot
        @slot('title')
            Buat User
        @endslot
    @endcomponent

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="mb-3 row">
                    <label class="col-md-3"><strong>Name:</strong></label>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
                <div class="mb-3 row">
                    <label class="col-md-3"><strong>Email:</strong></label>
                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
                <div class="mb-3 row">
                    <label class="col-md-3"><strong>Password:</strong></label>
                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                </div>
                <div class="mb-3 row">
                    <label class="col-md-3"><strong>Confirm Password:</strong></label>
                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                </div>
                <div class="mb-3 row">
                    <label class="col-md-3"><strong>Role:</strong></label>
                    {{-- {!! Form::select('roles[]', $roles, [], ['class' => 'form-control col-9', 'multiple']) !!} --}}
                    <select class="form-select roles" name="roles" id="floatingSelectGrid" aria-label="Floating label select example">
                        <option value="">-- Pilih role --</option>
                        @foreach ($roles as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3  text-center">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}



@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
