   <!-- header dashboard -->
   <header class="collapse fade" id="headerUser">
    <div class="rounded-start text-capitalize mb-4 mb-lg-5"
        style="background-image: linear-gradient(to left, transparent, rgba(0,0,0,.1));">
        <div class="container-fluid py-4 ps-lg-4">
            <div class="row align-items-center">
                <div class="col-lg-auto">
                    <div><strong
                            class="text-uppercase gotham-bold display-4 fs-lg-3">{{ $GetMember->firstname }}</strong>
                        <span>{{ $GetMember->lastname }}</span></div>
                </div>
                <div class="col-auto">
                    <div><strong class="text-uppercase gotham-bold fs-3">{{ $caption }}</strong>
                        <span>membership</span></div>
                </div>
                <div class="col-auto">
                    <input type="hidden" id="iduser" value="{{ $GetMember->id_users_login }}">
                    <input type="hidden" id="finalpoint" value="{{ $totalpoint }}">
                    <div><strong class="text-uppercase gotham-bold fs-3">{{ $totalpoint }}</strong>
                        <span>Beans</span></div>
                </div>
            </div>
        </div>
    </div>
</header>