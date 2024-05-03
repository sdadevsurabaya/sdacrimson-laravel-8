<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SUPRESSO &bull; {{ $title }}</title>

	<link rel="icon" href="ui/img/logo.ico">
	<link rel="stylesheet" href="ui/dist52/css/bootstrap.min.css">
	<link rel="stylesheet" href="ui/bootstrap-icons-1.9.1/bootstrap-icons.css">
	<link rel="stylesheet" href="ui/swiper/swiper-bundle.min.css" />
	<link rel="stylesheet" href="ui/select2/select2.min.css">
	<link rel="stylesheet" href="ui/fonts/font-awesome.min.css">
	<link rel="stylesheet" href="ui/fonts/line-awesome.min.css">
	<link rel="stylesheet" href="ui/icomoon/style.css">
	<link rel="stylesheet" href="ui/css/global.css">
	<link rel="stylesheet" href="ui/css/navtop.css">
	<link rel="stylesheet" href="ui/css/navdown.css">
	<link rel="stylesheet" href="ui/css/footer.css">
	<link rel="stylesheet" href="ui/css/{{ $pages }}.css">
</head>

<body>

	@if($pages=="landing")
	@yield('notifikasi')
	@endif

	@include('ui/navtop')
	@include('ui/navdown')

	<main class="wrapper">
		@yield('konten')
	</main>

	@include('ui/footer')
	@yield('popup')
	@include('ui/modalAddtocart')

	<!-- add spinner -->
	<p align="center">
		<button class="btn btn-primary collapsed" id="triggerSpinner" data-bs-toggle="collapse" data-bs-target=".backdrop-spinner" style="margin-bottom: 100px;">
			SHOW SPINNER
		</button>
	</p>

	<div class="collapse backdrop-spinner">
		<div class="position-fixed start-0 top-0 end-0 bottom-0 w-100 h-100 d-flex justify-content-center align-items-center" style="background-color: rgba(0,0,0,.5); z-index: 3000;">
			<div class="spinner-border text-light" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
			<button class="btn btn-danger" data-bs-toggle="collapse" data-bs-target=".backdrop-spinner">CLOSE SPINNER</button>
		</div>
	</div>
	<style>
		html.no-scroll {
			height: 100%;
			overflow-y: scroll;
		}

		html.no-scroll body {
			height: 100%;
			overflow: hidden;
		}
	</style>

	<script type="text/javascript" src="ui/js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="ui/dist52/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="ui/swiper/swiper-bundle.min.js"></script>
	<script type="text/javascript" src="ui/select2/select2.min.js"></script>
	<script type="text/javascript" src="ui/js/global.js"></script>
	<script type="text/javascript" src="ui/js/{{ $pages }}.js"></script>

	<!-- fungsi spinner -->
	<script>
		// $(document).ready(function() {
		// 	if ($('.backdrop-spinner').hasClass('show')) {
		// 		$('html').addClass('no-scroll');
		// 	} else {
		// 		$('html').removeClass('no-scroll');
		// 	}
		// });
		$('#triggerSpinner').click(function() {
			if ($('.backdrop-spinner').hasClass('show')) {
				$('html').addClass('no-scroll');
			} else {
				$('html').removeClass('no-scroll');
			}
		});
	</script>

	<script type="text/javascript">
		[].forEach.call(document.querySelectorAll("*"), function(a) {
			// a.style.outline = "1px solid green";
		});
	</script>

</body>

</html>