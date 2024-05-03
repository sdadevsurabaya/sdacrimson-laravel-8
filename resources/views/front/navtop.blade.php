<nav id="navtop" class="navbar navbar-expand-lg small">
    <div class="container py-3 py-lg-5">

        {{-- <div class="navbar-brand d-lg-none py-0">
            <img src="../ui/img/navbar/logo.svg" width="55" height="55">
        </div>

        <a class="navbar-brand d-none d-lg-block py-0" href="/">
            <img src="../ui/img/navbar/logo.svg" width="80" height="80">
        </a>

        <div class="collapse navbar-collapse" id="navcol">
            <ul class="navbar-nav ms-auto me-4 text-uppercase fw-bold">
                <li class="nav-item">
                    @if (!empty($title))
                        <a id="navproducts" class="nav-link {{ $title === 'Coffee Collection' ? 'active' : '' }}"
                            href="/fproducts" onclick="$('#loading').collapse('show');">
                            coffee
                        </a>
                    @endif

                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navmachines" href="/fmachines" onclick="$('#loading').collapse('show');">
                        machines
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navexplore" href="/fexplore" onclick="$('#loading').collapse('show');">
                        explore
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navpartnership" href="/fpartnership"
                        onclick="$('#loading').collapse('show');">
                        partnership
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navcafe" href="/fcafe" onclick="$('#loading').collapse('show');">
                        cafe
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navmembership" href="/fmembership"
                        onclick="$('#loading').collapse('show');">
                        membership
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="navgallery" href="/fgallery" onclick="$('#loading').collapse('show');">
                        gallery
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav text-uppercase fw-bold d-none d-lg-flex">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        search
                    </a>
                </li>
                <li class="nav-item">
                    @if (!empty(Auth::user()))
                        @if (Auth::user()->hasRole('member') == 1)
                            <a class="nav-link" href="/member/board">
                                {{ Str::ucfirst(Auth::user()->name) }}
                            </a>
                        @else
                            <a class="nav-link" href="/login">
                                {{ Str::ucfirst(Auth::user()->name) }}
                            </a>
                        @endif
                    @else
                        <a class="nav-link" href="/login" onclick="$('#loading').collapse('show');">
                            Account
                        </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (!empty($title))
                        <a class="nav-link position-relative {{ $title === 'Shopping Cart' ? 'active' : '' }}"
                            href="/fcart" onclick="$('#loading').collapse('show');">
                            cart <span
                                class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle">{{ Cart::getTotalQuantity() }}</span>
                        </a>
                    @endif

                </li>
            </ul>

        </div> --}}

    </div>
</nav>
