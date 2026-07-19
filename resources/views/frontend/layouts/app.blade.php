<!doctype html>
<html class="no-js" lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="{{ $siteSetting->description ?? 'Sinan Can REİS - Dijital Gelişim' }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>{{ $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim' }}</title>

	<!-- Favicon  -->
	<link rel="icon" href="{{ asset('images/favicon.png') }}">
	<link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">

	<!-- Style css -->
	<link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css') }}">
	<style>
		/* Mobile Layout Fixes */
		@media (max-width: 767px) {
			/* Fix logo stretching and sizing */
			header .navbar-brand img {
				object-fit: contain !important;
				object-position: left center !important;
				max-height: 55px !important;
				width: 160px !important;
				max-width: 160px !important;
			}
			/* Prevent page titles from overlapping the header */
			.breadcrumb-section {
				padding-top: 150px !important;
			}
			.hero-section {
				padding-top: 130px !important;
			}
			/* Ensure Menü toggler never gets hidden */
			.navbar-toggler {
				flex-shrink: 0 !important;
				display: flex !important;
				align-items: center !important;
			}
			/* Fix offcanvas overlapping logo */
			.offcanvas {
				z-index: 1050 !important;
			}
			header {
				z-index: 1030 !important;
			}
			/* Push offcanvas content down so it clears any remaining fixed items */
			.offcanvas-navigation {
				padding-top: 20px !important;
			}
		}

		/* Preloader background color override */
		.preloader svg {
			fill: #661414 !important;
		}
		.preloader {
			background-color: #661414 !important;
		}
	</style>
	@stack('styles')
</head>

<body>
	<!-- ***** Magic Cursor Area Start ***** -->
	<div id="magic-cursor">
		<div id="cursor"></div>
	</div>

	<!-- ***** Preloader Area Start ***** -->
	<div class="preloader">
		<svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
			<path id="loader" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
		</svg>
		<div class="loader-container">
			<div class="loaded">
				<span>Y</span><span>Ü</span><span>K</span><span>L</span><span>E</span><span>N</span><span>İ</span><span>Y</span><span>O</span><span>R</span>
			</div>
		</div>
	</div>

	<!-- ***** Main Area Start ***** -->
	<div class="main">
		<!-- ***** Header Start ***** -->
		@include('frontend.partials.header')

		<!-- ***** Main Wrapper Start ***** -->
		<div id="main-wrapper" class="main-wrapper">

			@yield('content')

			<!-- ***** Footer Area Start ***** -->
			@include('frontend.partials.footer')

			<!--====== Offcanvas Area Start ======-->
			@include('frontend.partials.offcanvas')

		</div>
		<!-- ***** Main Wrapper End ***** -->
	</div>

	<!-- jQuery -->
	<script src="{{ asset('frontend-assets/js/vendor/jquery.min.js') }}"></script>
	<!-- Bootstrap js -->
	<script src="{{ asset('frontend-assets/js/vendor/popper.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/bootstrap.min.js') }}"></script>
	<!-- Plugins js -->
	<script src="{{ asset('frontend-assets/js/vendor/all.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/gsap.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/ScrollTrigger.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/lenis.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/SplitType.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/shuffle.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/gallery.min.js') }}"></script>
	<script src="{{ asset('frontend-assets/js/vendor/slider.min.js') }}"></script>
	<!-- Main js -->
	<script src="{{ asset('frontend-assets/js/main.js') }}"></script>
	
	@stack('scripts')
</body>
</html>
