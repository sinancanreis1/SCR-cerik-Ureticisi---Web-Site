<!doctype html>
<html class="no-js" lang="tr">
<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-EFCP0DJQRT"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-EFCP0DJQRT');
	</script>
	<meta charset="UTF-8">
	<!-- Primary Meta Tags -->
	<title>@yield('title', $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim')</title>
	<meta name="title" content="@yield('title', $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim')">
	<meta name="description" content="@yield('meta_description', $siteSetting->seo_description ?? $siteSetting->description ?? 'Sinan Can REİS - Bilişim, Yazılım, Teknoloji ve Bilim Alanında İçerik Üreticisi')">
	<meta name="keywords" content="@yield('meta_keywords', $siteSetting->seo_keywords ?? 'sinan can reis, bilişim, yazılım, teknoloji, bilim, içerik üreticisi, dijital gelişim')">
	<meta name="author" content="{{ $siteSetting->seo_author ?? 'Sinan Can REİS | Dijital Gelişim' }}">
	<meta name="robots" content="index, follow">
	<meta name="language" content="Turkish">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="@yield('og_type', 'website')">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="@yield('title', $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim')">
	<meta property="og:description" content="@yield('meta_description', $siteSetting->seo_description ?? $siteSetting->description ?? 'Sinan Can REİS - Bilişim, Yazılım, Teknoloji ve Bilim Alanında İçerik Üreticisi')">
	<meta property="og:image" content="@yield('og_image', asset('public/images/logo.png'))">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="@yield('title', $siteSetting->seo_title ?? $siteSetting->title ?? 'Sinan Can REİS | Dijital Gelişim')">
	<meta property="twitter:description" content="@yield('meta_description', $siteSetting->seo_description ?? $siteSetting->description ?? 'Sinan Can REİS - Bilişim, Yazılım, Teknoloji ve Bilim Alanında İçerik Üreticisi')">
	<meta property="twitter:image" content="@yield('og_image', asset('public/images/logo.png'))">

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
				max-height: 40px !important;
				width: auto !important;
				max-width: 125px !important;
			}
			/* Raise wrapper z-index to overlay header and cover the logo */
			.offcanvas-wrapper {
				z-index: 9999 !important;
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
			/* Mobil Modda Resim Üstüne Gelen Başlıklar Beyaz */
			.image-holder .title a,
			.card-overlay .title a {
				color: #ffffff !important;
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

		/* Sticky Header Transition Styles */
		.navbar {
			transition: padding 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease !important;
		}
		.navbar.navbar-scrolled {
			background-color: rgba(255, 255, 255, 0.95) !important;
			backdrop-filter: blur(10px);
			box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1) !important;
			padding-top: 12px !important;
			padding-bottom: 12px !important;
		}

		/* Hide header menu button when offcanvas is open to avoid duplicates */
		body.offcanvas-menu-open #header .navbar-toggler {
			display: none !important;
		}

		/* Ensure the offcanvas close button is always visible when offcanvas is active (even at scroll = 0) */
		body.offcanvas-menu-open .offcanvas-wrapper .navbar-toggler {
			transform: translateY(0%) scale(1) rotate(0.001deg) !important;
			opacity: 1 !important;
		}

		/* Hide the floating menu button on desktop (only show on mobile scroll) */
		@media (min-width: 768px) {
			.offcanvas-wrapper .navbar-toggler {
				display: none !important;
			}
		}

		/* When scrolled down on mobile, hide the header's toggler completely so only the floating black one is active */
		@media (max-width: 767px) {
			.navbar-scrolled #header .navbar-toggler {
				display: none !important;
			}
		}

		/* Hide Menü text and icon ONLY when scrolled black button is displayed on mobile (navbar is scrolled) */
		.navbar-scrolled .navbar-toggler.scrolled:not(.active) .title,
		.navbar-scrolled .navbar-toggler.scrolled:not(.active) .toggler-icon {
			display: none !important;
			opacity: 0 !important;
		}

		/* Mobile Offcanvas Scroll and Layout Fixes (Samsung S8, etc.) */
		@media (max-width: 767px) {
			.offcanvas-wrapper .offcanvas {
				overflow-y: auto !important;
			}
			.offcanvas-wrapper .offcanvas .offcanvas-content {
				padding: 40px 25px 20px 25px !important;
				height: auto !important;
				min-height: 100% !important;
				display: flex !important;
				flex-direction: column !important;
				justify-content: flex-start !important;
				gap: 20px !important;
			}
			.offcanvas-wrapper .offcanvas .offcanvas-content .offcanvas-body {
				overflow: visible !important;
			}
			.offcanvas-wrapper .offcanvas .offcanvas-content hr {
				margin: 10px 0 !important;
			}
			.offcanvas-wrapper .offcanvas .offcanvas-content .offcanvas-navigation {
				padding-top: 0 !important;
			}
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
