<div id="navdown" class="fixed-bottom d-lg-none border-top">
   <nav class="navbar bg-white">
       <div class="container-fluid justify-content-around">

        @if (!empty($title))
           <a href="/" id="navdownHome"
               class="btn btn-lg btn-dot border-0 rounded-0 {{ $title === 'Home' ? 'active' : '' }}">
               <i class="bi bi-house"></i>
               <span class="dot">&bull;</span>
           </a>
           @endif

           {{-- <a href="/" id="navdownEmail" class="btn btn-lg btn-dot border-0 rounded-0">
           <i class="bi bi-envelope"></i>
           <span class="dot">&bull;</span>
        </a> --}}
           <a href="/fproducts" id="navdownEmail" class="btn btn-lg btn-dot border-0 rounded-0"
               onclick="$('#loading').collapse('show');">
               <i class="bi bi-box-seam"></i>
               <span class="dot">&bull;</span>
           </a>

           <button id="triggerNavcol" class="btn btn-lg btn-dot border-0 rounded-0" data-bs-toggle="collapse"
               data-bs-target="#navcol">
               <i class="bi bi-list"></i>
               <span class="dot">&bull;</span>
           </button>



           @if (!empty(Auth::user()))
               @if (Auth::user()->hasRole('member') == 1)
                   <a href="/member/board" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0"
                       onclick="$('#loading').collapse('show');">
                       <i class="bi bi-person-check"></i>
                       <span class="dot">&bull;</span>
                   </a>
               @else
                   <a href="/login" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0"
                       onclick="$('#loading').collapse('show');">
                       <i class="bi bi-person"></i>
                       <span class="dot">&bull;</span>
                   </a>
               @endif
           @else
               <a href="/login" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0"
                   onclick="$('#loading').collapse('show');">
                   <i class="bi bi-person"></i>
                   <span class="dot">&bull;</span>
               </a>
           @endif


           @if (!empty($title))
           <a href="/fcart" id="navdownCart"
               class="btn btn-lg btn-dot border-0 rounded-0 overflow-visible {{ $title === 'Shopping Cart' ? 'active' : '' }}">
               <i class="bi bi-cart"></i>
               <span class="dot">&bull;</span>
               <span class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle-x"
                   style="font-size: .55em;">{{ Cart::getTotalQuantity() }}</span>
           </a>
           @endif

       </div>
   </nav>
</div>
