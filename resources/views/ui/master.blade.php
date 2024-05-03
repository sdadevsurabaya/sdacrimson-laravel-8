@extends('ui/layout')

@section('konten')
<!-- -------------- TOAST -------------- -->
<div class="container mb-5">
   <!-- button trigger toast -->
   <button type="button" class="btn btn-primary" id="liveToastBtn" data-bs-toggle="toast" data-bs-target="#liveToast">Show live toast</button>

   <div class="toast-container position-fixed top-50 start-50 translate-middle p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
         <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
         </div>
         <div class="toast-body">
            Hello, world! This is a toast message.
         </div>
      </div>
   </div>

   <script>
      const toastTrigger = document.getElementById('liveToastBtn')
      const toastLiveExample = document.getElementById('liveToast')
      if (toastTrigger) {
         toastTrigger.addEventListener('click', () => {
            const toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
         })
      }
   </script>
</div>



<!-- -------------- MODAL -------------- -->
<div class="container mb-5">
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Launch static backdrop modal
   </button>
</div>

<!-- tambahkan data-bs-backdrop="static" data-bs-keyboard="false" untuk static backdrop/ tidak bisa close kecuali dengan menekan tombol close -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <!-- tambahkan modal-dialog-centered untuk meletakkan di tengah -->
   <!-- tambahkan modal-dialog-scrollable untuk konten modal yang panjang dan butuh di scroll -->
   <!-- tambahkan modal-lg/ modal-fullscreen untuk ukuran modal lebih besar -->
   <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, natus quibusdam, sunt placeat accusamus inventore necessitatibus sit sint perspiciatis culpa fugit explicabo! A ullam, minima ducimus laboriosam temporibus inventore itaque.
            </p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
         </div>
      </div>
   </div>
</div>


<!-- -------------- ALERT -------------- -->
<div class="container mb-5">

   <div id="liveAlertPlaceholder" class="position-fixed" style="top: 50%; left: 50%; transform: translateY(-50%) translateX(-50%);"></div>

   <button type="button" class="btn btn-primary" id="liveAlertBtn">Show live alert</button>

   <script>
      const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

      const alert = (message, type) => {
         const wrapper = document.createElement('div')
         wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
         ].join('')

         alertPlaceholder.append(wrapper)
      }

      const alertTrigger = document.getElementById('liveAlertBtn')
      if (alertTrigger) {
         alertTrigger.addEventListener('click', () => {
            alert('Nice, you triggered this alert message!', 'info')
         })
      }
   </script>

</div>
@endsection