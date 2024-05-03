$(document).ready(function () {

	// initial main wrapper padding bottom
	$('main.wrapper').addClass('pb-0');
	$('body').css({ 'padding-bottom': ($('#navDetailProduct').height()) }); //add padding bottom pada body sesuai tinggi navbar detail product


	// hidden navtop on mobile
	$('#navtop').addClass('d-none d-lg-block');

	// hidden navdown
	$('#navdown').removeClass('d-lg-none');
	$('#navdown').addClass('d-none');

	// nafigasi menu detail produk when pages is scroll
	// var prevScrollpos = window.pageYOffset;
	// window.onscroll = function () {
	// 	var currentScrollPos = window.pageYOffset;
	// 	// if (currentScrollPos > 100) {
	// 	if (prevScrollpos > currentScrollPos) {
	// 		$('#navDetailProduct').fadeIn('fast');
	// 	} else {
	// 		$('#navDetailProduct').fadeOut('fast');
	// 	}
	// 	prevScrollpos = currentScrollPos;
	// }

	// btn add to cart > toast on cart
	const toastTrigger = document.getElementById('btnAddcart')
	const toastLiveExample = document.getElementById('cartToast')
	if (toastTrigger) {
		toastTrigger.addEventListener('click', () => {
			const toast = new bootstrap.Toast(toastLiveExample)
			toast.show()
		})
	}

})