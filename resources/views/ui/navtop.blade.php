<nav id="navtop" class="navbar navbar-expand-lg small">
   <div class="container py-3 py-lg-5">

      <div class="navbar-brand d-lg-none py-0">
         <img src="../ui/img/navbar/logo.svg" width="55" height="55">
      </div>

      <a class="navbar-brand d-none d-lg-block py-0" href="/">
         <img src="../ui/img/navbar/logo.svg" width="80" height="80">
      </a>

      <div class="collapse navbar-collapse" id="navcol">
         <ul class="navbar-nav ms-auto me-4 text-uppercase fw-bold">
            <li class="nav-item">
               <a class="nav-link {{ ($title === 'Coffee Collection') ? 'active' : '' }}" href="/fproducts">
                  coffee
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ ($title === 'Kraton') ? 'active' : '' }}" href="/machines">
                  machines
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ ($title === 'Explore') ? 'active' : '' }}" href="/explore">
                  explore
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ ($title === 'Partnership') ? 'active' : '' }}" href="/partnership">
                  partnership
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ ($title === 'Cafe') ? 'active' : '' }}" href="/cafe">
                  cafe
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ ($title === 'Membership') ? 'active' : '' }}" href="/membership">
                  membership
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link {{ ($title === 'Gallery') ? 'active' : '' }}" href="/gallery">
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
               <a class="nav-link {{ ($title === 'Sign In') ? 'active' : '' }}" href="/signin">
                  account
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link position-relative {{ ($title === 'Shopping Cart') ? 'active' : '' }}" href="/cart">
                  cart <span class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle">+99</span>
               </a>
            </li>
         </ul>

      </div>

   </div>
</nav>