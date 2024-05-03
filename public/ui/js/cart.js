$(document).ready(function () {

   // input vouchers
   $('#triggerInputVouchers input').click(function () {
      $('#modalInputVouchers').modal('show');
   });

   $('.gift-item .card').click(function () {
      $(this).addClass('selected');
   });

   // $('#triggerCloseGift').click(function () {
   //    $('#giftThumbnail').collapse('hide');
   // });

});