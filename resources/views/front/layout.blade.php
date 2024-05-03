<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@if (!empty($title))
	<title>RO &bull; {{ $title }}</title>
	@else
	<title>RO</title>
	@endif


	{{-- <link rel="icon" href="../ui/img/logos.ico"> --}}
	<link rel="stylesheet" href="../ui/dist52/css/bootstrap.min.css">
	<link rel="stylesheet" href="../ui/bootstrap-icons-1.9.1/bootstrap-icons.css">
	<link rel="stylesheet" href="../ui/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="../assets/libs/select2/select2.min.css">
	<link rel="stylesheet" href="../ui/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="../ui/fonts/line-awesome.min.css">
	<link rel="stylesheet" href="../ui/icomoon/style.css">
	<link rel="stylesheet" href="../ui/css/global.css">
	<link rel="stylesheet" href="../ui/css/navtop.css">
	<link rel="stylesheet" href="../ui/css/navdown.css">
	<link rel="stylesheet" href="../ui/css/footer.css">
	@if (!empty($pages))
	<link rel="stylesheet" href="../ui/css/{{ $pages }}.css">
	@endif

	{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}

	{{-- <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" /> --}}

</head>
<body>

	@yield('notifikasi')
	@include('front/navtop')
	{{-- @include('front/navdown') --}}
	<main class="wrapper">
		@yield('konten')
	</main>

	{{-- this loading spinner --}}
	<div class="collapse backdrop-spinner" id="loading">
		<div class="position-fixed start-0 top-0 end-0 bottom-0 w-100 h-100 d-flex justify-content-center align-items-center flex-column text-light fs-4" style="background-color: rgba(0,0,0,.5); z-index: 3000;">
			<div class="spinner-border" role="status"></div>
			<span class="p-3">Loading...</span>
			{{-- <button class="btn btn-danger" data-bs-toggle="collapse" data-bs-target=".backdrop-spinner">CLOSE SPINNER</button> --}}
		</div>
	</div>


	@include('front/footer')
	@yield('popup')


	{{-- @if($pages=='product') --}}
	{{-- @include('front/modalAddtocart') --}}
	{{-- @endif --}}

	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-HQB3WHD8HW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-HQB3WHD8HW');
</script>

	<script type="text/javascript" src="../ui/js/jquery-3.6.0.min.js"></script>
	{{-- <script type="text/javascript" src="../ui/js/popper.min.js"></script> --}}
	<script type="text/javascript" src="../ui/dist52/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="../ui/swiper/swiper-bundle.min.js"></script>
	<script type="text/javascript" src="../ui/select2/select2.min.js"></script>
	<script type="text/javascript" src="../ui/js/global.js"></script>
	<script>
		// fungsi spinner

		// $(document).ready(function() {
		// 	if ($('.backdrop-spinner').hasClass('show')) {
		// 		$('html').addClass('no-scroll');
		// 	} else {
		// 		$('html').removeClass('no-scroll');
		// 	}
		// });

		// fungsi tooltip
		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

		$('#triggerSpinner').click(function() {
			if ($('.backdrop-spinner').hasClass('show')) {
				$('html').addClass('no-scroll');
			} else {
				$('html').removeClass('no-scroll');
			}
		});

		// garis bantu
		[].forEach.call(document.querySelectorAll("*"), function(a) {
			// a.style.outline = "1px solid green";
		});
	</script>
	@if(!empty($pages))
	<script type="text/javascript" src="../ui/js/{{ $pages }}.js"></script>
	@endif



	<script type="text/javascript">
		[].forEach.call(document.querySelectorAll("*"), function(a) {
			// a.style.outline = "1px solid green";
		});
	</script>

	{{-- <button class="btn btn-danger" data-bs-toggle="collapse" data-bs-target=".backdrop-spinner" id="close-loading-screen">CLOSE SPINNER</button> --}}
	<div class="collapse backdrop-spinner" id="loading-screen">
		<div class="position-fixed start-0 top-0 end-0 bottom-0 w-100 h-100 d-flex justify-content-center align-items-center" style="background-color: rgba(0,0,0,.5); z-index: 3000;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>
</body>
</html>
