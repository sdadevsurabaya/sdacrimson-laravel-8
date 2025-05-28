@extends('layouts.master')
@section('title')
    @lang('translation.Datatables')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Pengguna
        @endslot
        @slot('title')
            Pengguna
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    {{-- @can('users-create') --}}
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Buat User Baru</a>
                    {{-- @endcan --}}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Cabang</th>
                                    <th width="280px">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    {{-- <label class="badge badge-primary"> --}}
                                                    {{ $v }}
                                                    {{-- </label> --}}
                                                @endforeach
                                            @endif
                                        </td>

                                        <td> {{ !empty($user->cabang) ? $user->cabang->cabang : '' }} </td>

                                        <td>
                                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}

                                            <button class="btn btn-success force-login-button"
                                                data-user-id="{{ $user->id }}">Login Ass</button>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script>
        $(document).on('click', '.force-login-button', function() {
            var userId = $(this).data('user-id');

            console.log(userId); // Untuk melihat ID user di console

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to log in as this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me in!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengirim AJAX request untuk forced login
                    $.ajax({
                        url: `/force-login/${userId}`,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire(
                                'Logged in!',
                                'You have been logged in successfully.',
                                'success'
                            ).then(() => {
                                window.location.href =
                                '/admin/dashboard'; // Redirect ke halaman yang diinginkan
                            });
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was an issue logging in.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
