$(document).ready(function () {

	// saat notifikasi subscribe di klik
	$('#notifikasiSubscribe a').click(function () {
		$('#notifikasiSubscribe').collapse('hide');
	});

	// saat tombol close popup di klik
	$('.popup .btn-close').click(function () {
		$('#notifikasiSubscribe').collapse('show');
	});


	// swipper product (slider produk menggunakan swiper js)
	var swiper = new Swiper(".mySwiper", {
		slidesPerView: 1,
		spaceBetween: 15,
		loop: true,
		freeMode: true,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		breakpoints: {
			375: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			},
			992: {
				slidesPerView: 4,
				spaceBetween: 30,
			},
			1400: {
				slidesPerView: 5,
			},
		},
	});

});