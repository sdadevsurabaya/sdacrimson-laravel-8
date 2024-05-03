@extends('ui/layout')

@section('konten')
<section>
   <div class="container">

      <div class="lh-sm mb-2">
         <strong class="gotham-bold  fs-2 fs-lg-3">Change Password.</strong>
      </div>

      <p class="mb-5">Change your pasword to secure your account</p>

      <div class="form-floating border-bottom mb-3">
         <input type="text" class="form-control border-0 rounded-0 px-0" id="resetUsername" placeholder="name@example.com" value="yoggi.supresso@gmail.com">
         <label class="px-0 opacity-50" for="resetUsername">Username / Email Address</label>
      </div>

      <div class="input-group border-bottom mb-3 flex-nowrap">
         <div class="form-floating w-100">
            <input type="password" class="form-control border-0 rounded-0 px-0" id="resetUserPassOld" placeholder="Old Password">
            <label class="px-0 opacity-50" for="resetUserPassOld">Old Password</label>
         </div>
         <button class="btn border-0 bi bi-eye d-none"></button>
         <button class="btn border-0 bi bi-eye-slash"></button>
      </div>

      <div class="input-group border-bottom mb-3 flex-nowrap">
         <div class="form-floating w-100">
            <input type="password" class="form-control border-0 rounded-0 px-0" id="resetUserPassNew" placeholder="New Password">
            <label class="px-0 opacity-50" for="resetUserPassNew">New Password</label>
         </div>
         <button class="btn border-0 bi bi-eye d-none"></button>
         <button class="btn border-0 bi bi-eye-slash"></button>
      </div>

      <div class="input-group border-bottom mb-5 flex-nowrap">
         <div class="form-floating w-100">
            <input type="password" class="form-control border-0 rounded-0 px-0" id="resetUserPassConfirm" placeholder="Confirm Password">
            <label class="px-0 opacity-50" for="resetUserPassConfirm">Confirm Password</label>
         </div>
         <button class="btn border-0 bi bi-eye d-none"></button>
         <button class="btn border-0 bi bi-eye-slash"></button>
      </div>

      <div class="form-group">
         <a href="#" class="btn btn-dark w-100">Change Password</a>
      </div>

   </div>
</section>
@endsection