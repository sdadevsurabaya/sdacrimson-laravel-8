<div id="navdown" class="fixed-bottom d-lg-none border-top">
   <nav class="navbar bg-white">
      <div class="container-fluid justify-content-around">

         <a href="/" id="navdownHome" class="btn btn-lg btn-dot border-0 rounded-0 {{ ($title === 'Home') ? 'active' : '' }}">
            <i class="bi bi-house"></i>
            <span class="dot">&bull;</span>
         </a>

         <button id="triggerNavcol" class="btn btn-lg btn-dot border-0 rounded-0" data-bs-toggle="collapse" data-bs-target="#navcol">
            <i class="bi bi-list"></i>
            <span class="dot">&bull;</span>
         </button>

         <a href="/signin" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0 {{ ($title === 'Sign In') ? 'active' : '' }}">
            <i class="bi bi-person"></i>
            <span class="dot">&bull;</span>
         </a>

         <a href="/cart" id="navdownCart" class="btn btn-lg btn-dot border-0 rounded-0 overflow-visible {{ ($title === 'Shopping Cart') ? 'active' : '' }}">
            <i class="bi bi-cart"></i>
            <span class="dot">&bull;</span>
            <span class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle-x" style="font-size: .55em;">+99</span>
         </a>

      </div>
   </nav>
</div>