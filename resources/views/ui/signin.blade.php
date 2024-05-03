@extends('ui/layout')

@section('konten')
<section>
   <div class="container">

      <div class="lh-sm mb-2">
         <strong class="gotham-bold  fs-2 fs-lg-3">Welcome.</strong>
      </div>

      <p class="mb-5">Sign In to continue</p>

      <div class="form-floating border-bottom mb-3">
         <input type="text" class="form-control border-0 rounded-0 px-0" id="signinUsername" placeholder="name@example.com">
         <label class="px-0 opacity-50" for="signinUsername">Username / Email Address</label>
      </div>

      <div class="input-group border-bottom mb-4 mb-lg-5 flex-nowrap">
         <div class="form-floating w-100">
            <input type="password" class="form-control border-0 rounded-0 px-0" id="signinPass" placeholder="Password">
            <label class="px-0 opacity-50" for="signinPass">Password</label>
         </div>
         <button class="btn border-0 bi bi-eye d-none"></button>
         <button class="btn border-0 bi bi-eye-slash"></button>
      </div>

      <div class="form-group text-end mb-5">
         <a href="/forgotpass" class="text-dark font-2" style="opacity: .5;">Forgot Password?</a>
      </div>

      <div class="form-group">
         <a href="#" class="btn btn-dark w-100">Sign In</a>
      </div>

      <div class="form-group text-center d-flex w-100 justify-content-center align-items-center gap-3 my-4">
         <hr class="w-100">
         <span>or</span>
         <hr class="w-100">
      </div>

      <div class="form-group text-center">

         <!-- <p>Social Media Sign in</p> -->
         <div class="my-4 d-flex justify-content-center gap-4">
            <button class="btn btn-lg border-0 w-lg-100 btn-lg-light">
               <i class="bi bi-google"></i>
               <span class="d-none d-lg-inline ms-5">Sign In With Google</span>
            </button>
            <button class="btn btn-lg border-0 w-lg-100 btn-lg-light">
               <i class="bi bi-facebook"></i>
               <span class="d-none d-lg-inline ms-5">Sign In With Facebook</span>
            </button>
            <button class="btn btn-lg border-0 w-lg-100 btn-lg-light">
               <i class="bi bi-apple"></i>
               <span class="d-none d-lg-inline ms-5">Sign In With Apple</span>
            </button>
         </div>
         <p>Don’t have an account? <a href="/signup" class="fw-bold text-dark">Sign up</a></p>

         <div class="container-fluid px-0 mb-3 mb-md-4 d-none">
            <div class="row justify-content-center justify-content-lg-around" style="font-size: 150%;">

               <div class="col-2 col-lg-4">
                  <a href="#" target="_blank" class="text-dark d-lg-none"><i class="bi bi-google"></i></a>
                  <a href="#" target="_blank" class="media align-items-center p-3 d-none d-lg-flex" style="background-color: #f1f2f2; color: #565656; border-radius: 10px; text-decoration: none; line-height: 1;">
                     <i class="bi bi-google mx-3"></i>
                     <div class="media-body" style="font-size: 22px;">
                        Sign In with Google
                     </div>
                  </a>
               </div>

               <div class="col-2 col-lg-4">
                  <a href="#" target="_blank" class="text-dark d-lg-none"><i class="bi bi-facebook"></i></a>
                  <a href="#" target="_blank" class="media align-items-center p-3 d-none d-lg-flex" style="background-color: #f1f2f2; color: #565656; border-radius: 10px; text-decoration: none; line-height: 1;">
                     <i class="bi bi-facebook mx-3"></i>
                     <div class="media-body" style="font-size: 22px;">
                        Sign In with Faccebook
                     </div>
                  </a>
               </div>

               <div class="col-2 col-lg-4">
                  <a href="#" target="_blank" class="text-dark d-lg-none"><i class="bi bi-apple"></i></a>
                  <a href="#" target="_blank" class="media align-items-center p-3 d-none d-lg-flex" style="background-color: #f1f2f2; color: #565656; border-radius: 10px; text-decoration: none; line-height: 1;">
                     <i class="bi bi-apple mx-3"></i>
                     <div class="media-body" style="font-size: 22px;">
                        Sign In with Apple
                     </div>
                  </a>
               </div>

            </div>
         </div>



      </div>

   </div>
</section>
@endsection