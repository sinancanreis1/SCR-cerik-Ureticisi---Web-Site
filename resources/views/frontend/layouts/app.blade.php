<!doctype html>
<html class="no-js" lang="tr">
<head>
	<meta charset="UTF-8">
	<!-- Primary Meta Tags -->
	<title>{{ $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim' }}</title>
	<meta name="title" content="{{ $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim' }}">
	<meta name="description" content="{{ $siteSetting->seo_description ?? $siteSetting->description ?? 'Sinan Can REİS - Bilişim, Yazılım, Teknoloji ve Bilim Alanında İçerik Üreticisi' }}">
	<meta name="keywords" content="{{ $siteSetting->seo_keywords ?? 'sinan can reis, bilişim, yazılım, teknoloji, bilim, içerik üreticisi, dijital gelişim' }}">
	<meta name="author" content="{{ $siteSetting->seo_author ?? 'Sinan Can REİS | Dijital Gelişim' }}">
	<meta name="robots" content="index, follow">
	<meta name="language" content="Turkish">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="{{ $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim' }}">
	<meta property="og:description" content="{{ $siteSetting->seo_description ?? $siteSetting->description ?? 'Sinan Can REİS - Bilişim, Yazılım, Teknoloji ve Bilim Alanında İçerik Üreticisi' }}">
	<meta property="og:image" content="{{ asset('frontend-assets/img/logo/logo.png') }}">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="{{ $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim' }}">
	<meta property="twitter:description" content="{{ $siteSetting->seo_description ?? $siteSetting->description ?? 'Sinan Can REİS - Bilişim, Yazılım, Teknoloji ve Bilim Alanında İçerik Üreticisi' }}">
	<meta property="twitter:image" content="{{ asset('frontend-assets/img/logo/logo.png') }}">

	<!-- Schema.org Markup (JSON-LD) -->
	<script type="application/ld+json">
	{
	  "@@context": "https://schema.org",
	  "@@type": "Person",
	  "name": "Sinan Can REİS",
	  "url": "{{ url('/') }}",
	  "image": "{{ asset('frontend-assets/img/logo/logo.png') }}",
	  "jobTitle": "İçerik Üreticisi & Dijital Gelişim Uzmanı",
	  "description": "{{ $siteSetting->seo_description ?? 'Sinan Can REİS - Bilişim, Yazılım, Teknoloji ve Bilim Alanında İçerik Üreticisi' }}",
	  "sameAs": [
	    "{{ $siteSetting->instagram_url ?? '' }}",
	    "{{ $siteSetting->linkedin_url ?? '' }}"
	  ]
	}
	</script>

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
				max-height: 50px !important;
				width: auto !important;
				max-width: 200px !important;
			}
			/* Prevent page titles from overlapping the header */
			.breadcrumb-section {
				padding-top: 100px !important;
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
				padding-top: 80px !important;
			}
			/* Mobile Modda Başlıklar Kırmızı */
			.portfolio-item .title a, 
			.blog-item .title a,
			.heading .title a,
			.explore-area .title a,
			.portfolio-item .project-link a {
				color: #661414 !important;
			}
			/* Mobile Modda Yazıları İki Yana Yaslama */
			p, 
			.project-long-desc, 
			.project-long-desc p, 
			.blog-detail-section p, 
			.comment-item p,
			.description {
				text-align: justify !important;
			}
		}

		/* Custom Red Button Theme (#661414) */
		.btn.magnetic-button,
		button.magnetic-button,
		a.magnetic-button {
			background-color: #661414 !important;
			border-color: #661414 !important;
			color: #ffffff !important;
		}
		.btn.magnetic-button:hover,
		button.magnetic-button:hover,
		a.magnetic-button:hover {
			color: #661414 !important;
		}
		.btn.magnetic-button span {
			background-color: #ffffff !important;
		}

		/* Preloader background color override */
		.preloader svg {
			fill: #661414 !important;
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
