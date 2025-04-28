<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGOSS -->
    <div class="navbar-brand-box" style="align-self: center;">
        <a href="{{ url('admin/dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/ro-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-sda-global-24.svg') }}"  style="width: 90%;">
            </span>
        </a>

        <a href="{{ url('admin/dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/ro-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo-sda-global-24.svg') }}" style="width: 90%;">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                @if (Str::ucfirst(Auth::user()->hasRole('Admin')) == 1)
                    <li class="menu-title">@lang('translation.Menu')</li>
                    <li>
                        {{-- <a href="{{url('index')}}"> --}}
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('translation.Dashboard')</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-user-circle"></i>
                            <span>@lang('Users Management')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            @can('menu-permission')
                                <li><a href={{ route('permissions.index') }}>@lang('Permissions')</a></li>
                            @endcan
                            <li><a href={{ route('roles.index') }}>@lang('Roles')</a></li>
                            <li><a href={{ route('users.index') }}>@lang('Users')</a></li>
                            {{-- <li><a href={{ route('access.index') }}>@lang('Access')</a></li> --}}
                        </ul>
                    </li>

                    <li class="menu-title">@lang('Master')</li>
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-database"></i>
                            <span>@lang('Master')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('type_outlet.index') }}">@lang('Master Type Outlet')</a></li>
                            <li><a href="{{ route('bank.index') }}">@lang('Master Bank')</a></li>
                            <li><a href="{{ route('brand.index') }}">@lang('Master Brand')</a></li>
                            <li><a href="{{ route('distributor.index') }}">@lang('Master Distributor')</a></li>
                            <li><a href="{{ route('area.index') }}">@lang('Master Area')</a></li>

                            {{-- <li><a href="#">@lang('Master Harga')</a></li> --}}
                        </ul>
                    </li>

                    <li class="menu-title">@lang('General Information')</li>
                    <li>
                        <a href="{{ route('generals.index') }}">
                            <i class="uil-dashboard"></i>
                            <span>@lang('General')</span>
                        </a>
                    </li>

                    <li class="menu-title">@lang('Sales')</li>
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-presentation-check"></i>
                            <span>@lang('Jadwal Kunjungan')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            {{-- <li><a href="{{ route('jadwal.index') }}">@lang('Jadwal')</a></li> --}}
                            <li><a href="{{ route('jadwal.createJadwal') }}">@lang('Buat Jadwal')</a></li>
                            <li><a href="{{ route('jadwal.exportJadwal') }}">@lang('Export Jadwal')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('kunjungan.index') }}">
                            <i class="uil-car"></i>
                            <span>@lang('Kunjungan')</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-swatchbook"></i>
                            <span>@lang('Report')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('reportsales.index') }}">@lang('Report Visit')</a></li>
                            <li><a href="{{ route('laporan.index') }}">@lang('Report Periode Visit')</a></li>
                            <li><a href="{{ route('back.dashboardreport.index') }}">@lang('Report Weekly')</a></li>
                        </ul>
                    </li>


                    <li class="menu-title">@lang('Area Coverage')</li>
                    <li>
                        <a href="{{ route('maps.index') }}">
                            <i class="uil-map-marker-alt"></i>
                            <span>@lang('Maps')</span>
                        </a>
                    </li>
                @elseif (Str::ucfirst(Auth::user()->hasRole('Sales')) == 1)
                    <li class="menu-title">@lang('translation.Menu')</li>

                    <li>
                        {{-- <a href="{{url('index')}}"> --}}
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('translation.Dashboard')</span>
                        </a>
                    </li>

                    {{-- <li class="menu-title">@lang('General Information')</li>

                    <li>
                        <a href="{{ route('generals.index') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('General')</span>
                        </a>
                    </li> --}}


                    <li class="menu-title">@lang('Sales')</li>
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-database"></i>
                            <span>@lang('Jadwal Kunjungan')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            {{-- <li><a href="{{ route('jadwal.index') }}">@lang('Jadwal')</a></li> --}}
                            <li><a href="{{ route('jadwal.createJadwal') }}">@lang('Buat Jadwal')</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('kunjungan.index') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('Kunjungan')</span>
                        </a>
                    </li>
                @elseif (Str::ucfirst(Auth::user()->hasRole('HCS')) == 1)
                    <li class="menu-title">@lang('translation.Menu')</li>
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-swatchbook"></i>
                            <span>@lang('Report')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('reportsales.index') }}">@lang('Report Visit')</a></li>
                        </ul>
                    </li>
                @elseif (Str::ucfirst(Auth::user()->hasRole('Verifikator')) == 1)
                    <li class="menu-title">@lang('translation.Menu')</li>

                    <li>
                        {{-- <a href="{{url('index')}}"> --}}
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('translation.Dashboard')</span>
                        </a>
                    </li>

                    <li class="menu-title">@lang('General Information')</li>

                    <li>
                        <a href="{{ route('generals.index') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('General')</span>
                        </a>
                    </li>
                @elseif (Str::ucfirst(Auth::user()->hasRole('Toko')) == 1)
                    <li class="menu-title">@lang('translation.Menu')</li>
                    <li>
                        {{-- <a href="{{url('index')}}"> --}}
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('translation.Dashboard')</span>
                        </a>
                    </li>



                    <li class="menu-title">@lang('Master')</li>
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-database"></i>
                            <span>@lang('Master')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('type_outlet.index') }}">@lang('Master Type Outlet')</a></li>
                            <li><a href="{{ route('bank.index') }}">@lang('Master Bank')</a></li>
                            <li><a href="{{ route('brand.index') }}">@lang('Master Brand')</a></li>
                            <li><a href="{{ route('distributor.index') }}">@lang('Master Distributor')</a></li>
                            <li><a href="{{ route('area.index') }}">@lang('Master Area')</a></li>

                            {{-- <li><a href="#">@lang('Master Harga')</a></li> --}}
                        </ul>
                    </li>

                    <li class="menu-title">@lang('General Information')</li>
                    <li>
                        <a href="{{ route('generals.index') }}">
                            <i class="uil-dashboard"></i>
                            <span>@lang('General')</span>
                        </a>
                    </li>

                    <li class="menu-title">@lang('Sales')</li>
                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-presentation-check"></i>
                            <span>@lang('Jadwal Kunjungan')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            {{-- <li><a href="{{ route('jadwal.index') }}">@lang('Jadwal')</a></li> --}}
                            <li><a href="{{ route('jadwal.createJadwal') }}">@lang('Buat Jadwal')</a></li>
                            <li><a href="{{ route('jadwal.exportJadwal') }}">@lang('Export Jadwal')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('kunjungan.index') }}">
                            <i class="uil-car"></i>
                            <span>@lang('Kunjungan')</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="has-arrow waves-effect">
                            <i class="uil-swatchbook"></i>
                            <span>@lang('Report')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('reportsales.index') }}">@lang('Report Visit')</a></li>
                            <li><a href="{{ route('laporan.index') }}">@lang('Report Periode Visit')</a></li>
                        </ul>
                    </li>


                    <li class="menu-title">@lang('Area Coverage')</li>
                    <li>
                        <a href="{{ route('maps.index') }}">
                            <i class="uil-map-marker-alt"></i>
                            <span>@lang('Maps')</span>
                        </a>
                    </li>
                @elseif (Str::ucfirst(Auth::user()->hasRole('Manager Sales')) == 1)
                    <li class="menu-title">@lang('translation.Menu')</li>
                        <li>
                            {{-- <a href="{{url('index')}}"> --}}
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="uil-home-alt"></i>
                                <span>@lang('translation.Dashboard')</span>
                            </a>
                        </li>

                        <li class="menu-title">@lang('Sales')</li>
                        <li>
                            <a href="#" class="has-arrow waves-effect">
                                <i class="uil-presentation-check"></i>
                                <span>@lang('Jadwal Kunjungan')</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                {{-- <li><a href="{{ route('jadwal.index') }}">@lang('Jadwal')</a></li> --}}
                                <li><a href="{{ route('jadwal.createJadwal') }}">@lang('Buat Jadwal')</a></li>
                                <li><a href="{{ route('jadwal.exportJadwal') }}">@lang('Export Jadwal')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('kunjungan.index') }}">
                                <i class="uil-car"></i>
                                <span>@lang('Kunjungan')</span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="has-arrow waves-effect">
                                <i class="uil-swatchbook"></i>
                                <span>@lang('Report')</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('reportsales.index') }}">@lang('Report Visit')</a></li>
                                <li><a href="{{ route('laporan.index') }}">@lang('Report Periode Visit')</a></li>
                                <li><a href="{{ route('back.dashboardreport.index') }}">@lang('Report Weekly')</a></li>
                            </ul>
                        </li>


                        <li class="menu-title">@lang('Area Coverage')</li>
                        <li>
                            <a href="{{ route('maps.index') }}">
                                <i class="uil-map-marker-alt"></i>
                                <span>@lang('Maps')</span>
                            </a>
                        </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
