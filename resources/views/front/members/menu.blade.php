<div class="d-none d-lg-block">
    <hr class="opacity-50 m-0">
    <button class="btn btn-user" data-bs-toggle="collapse" data-bs-target="#userDashboard">
       <span class="me-3">dashboard</span>
    </button>
    <hr class="opacity-50 m-0">
    <button class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userRedeem">
       <span class="me-3">redeem</span>
    </button>
    <hr class="opacity-50 m-0">
    <button class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userAccount">
       <span class="me-3">my account information</span>
    </button>
    <hr class="opacity-50 m-0">
    <button class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userOrders">
       <span class="me-3">my orders</span>
    </button>
    <hr class="opacity-50 m-0">
    <button class="btn btn-user collapsed" data-bs-toggle="collapse" data-bs-target="#userMachines">
       <span class="me-3">my machines</span>
    </button>
    <hr class="opacity-50 m-0">
    {{-- <button class="btn btn-user collapsed">
       <span class="me-3">logout</span>
    </button> --}}
      <a class="btn btn-user collapsed" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">  
       <span class="me-3">Logout</span></a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
    <hr class="opacity-50 m-0">
 </div>