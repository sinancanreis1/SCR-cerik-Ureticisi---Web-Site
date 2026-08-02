@extends('frontend.layouts.app')

@section('content')
<!-- ***** Hero Area Start ***** -->
<section id="home" class="hero-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Hero Content -->
				<div class="hero-content" style="padding-top: 60px;">
					<span class="intro-text">{{ $siteSetting->home_hero_subtitle ?? 'Merhaba! Ben Sinan Can REİS.' }}</span>
					<h1 class="title section-title mt-3 mt-md-4 mb-md-5">
						{{ $siteSetting->home_hero_title ?? 'Yazılım, Yapay Zeka ve Dijital Dünyanın Şifreleri' }}
					</h1>

					<!-- Content -->
					<div class="content d-flex flex-column flex-md-row justify-content-md-between">
						<div class="hero-button order-last order-md-first mt-4 mt-md-0">
							<a class="btn magnetic-button" href="{{ url('/iletisim') }}">İletişime Geçin! <i class="icon bi bi-arrow-right ms-1"></i><span></span></a>
						</div>
						<p class="sub-title order-first order-md-last">
							{{ $siteSetting->hero_description ?? 'Sektörden güncel notlar, yazılım dünyasından ipuçları ve teknolojiye yön veren yenilikleri sizinle paylaşıyorum.' }}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hero-bg">
		<img class="circle-1" src="{{ asset('frontend-assets/img/content/hero-bg-1.svg') }}" alt="">
		<img class="circle-2" src="{{ asset('frontend-assets/img/content/hero-bg-2.svg') }}" alt="">
	</div>
</section>
<!-- ***** Hero Area End ***** -->

<!-- ***** Works Area Start ***** -->
<section class="works position-relative p-0">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="intro d-flex justify-content-between align-items-center">
					<h3 class="title">Öne Çıkan İçerikler</h3>
					<a class="btn btn-outline content-btn swap-icon" href="{{ url('/icerikler') }}">Tümünü Gör <i class="icon bi bi-arrow-right-short"></i></a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="stack-wrapper">
				@if(isset($blogs) && $blogs->count() > 0)
					@foreach($blogs as $blog)
					@php
						$imgSrc = asset('frontend-assets/img/blog/blog-1.jpg');
						if (!empty($blog->image_path)) {
							if (Str::startsWith($blog->image_path, ['http://', 'https://'])) {
								$imgSrc = $blog->image_path;
							} elseif (Str::startsWith($blog->image_path, 'frontend-assets')) {
								$imgSrc = asset($blog->image_path);
							} else {
								$imgSrc = asset('storage/' . $blog->image_path);
							}
						}
					@endphp
					<div class="stack-item">
						<div class="card portfolio-item layout-2 scale has-shadow">
							<div class="image-holder">
								<a class="card-thumb" href="{{ route('icerik.detay', $blog->slug) }}">
									<img src="{{ $imgSrc }}" alt="{{ $blog->title }}">
								</a>
								<div class="card-overlay">
									<div class="heading">
										<h4 class="title mt-2 mt-md-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">
											<a href="{{ route('icerik.detay', $blog->slug) }}" class="text-white text-decoration-none">{{ $blog->title }}</a>
										</h4>
										<div class="show-project">
											<div class="card-terms">
												<a class="terms badge outlined" href="{{ route('icerik.detay', $blog->slug) }}">{{ $blog->category ?? 'Yapay Zeka' }}</a>
											</div>
											<div class="project-link">
												<a href="{{ route('icerik.detay', $blog->slug) }}">İçeriği Oku</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</section>
<!-- ***** Works Area End ***** -->

<!-- ***** Projects Area Start ***** -->
<section class="blog">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="intro d-flex justify-content-between align-items-center">
					<h3 class="title">Son Projeler</h3>
					<a class="btn btn-outline content-btn swap-icon" href="{{ url('/projelerim') }}">Tümünü Gör <i class="icon bi bi-arrow-right-short"></i></a>
				</div>
			</div>
		</div>

		<div class="row items">
			@if(isset($products) && $products->count() > 0)
				@foreach($products as $product)
				@php
					$prodImg = asset('frontend-assets/img/content/case-1.jpg');
					if (!empty($product->image)) {
						if (Str::startsWith($product->image, ['http://', 'https://'])) {
							$prodImg = $product->image;
						} elseif (Str::startsWith($product->image, 'frontend-assets')) {
							$prodImg = asset($product->image);
						} else {
							$prodImg = asset('storage/' . $product->image);
						}
					}
				@endphp
				<div class="col-12 col-md-6 col-lg-4 item">
					<div class="card blog-item h-100">
						<div class="image-holder" style="background-color: #661414;">
							<a class="card-thumb" href="{{ route('proje.detay', $product->slug) }}">
								<img src="{{ $prodImg }}" alt="{{ $product->title }}" style="width: 100%; height: 250px; object-fit: contain;">
							</a>
							<div class="card-overlay top fade-down">
								<div class="logo">
									<img src="{{ asset('frontend-assets/img/logo/logo.png') }}" alt="">
								</div>
								<div class="post-meta d-flex flex-column ms-3">
									<span>Geliştirici</span>
									<span class="post-author"><strong>Sinan Can REİS</strong></span>
								</div>
							</div>
						</div>
						<div class="card-content mt-3">
							<div class="heading">
								<div class="post-meta d-flex">
									@if($product->project_date)
										<span class="post-date me-3" style="color: #661414; font-weight: 600;"><i class="bi bi-calendar3 me-1"></i>{{ $product->project_date }}</span>
									@endif
									<span class="post-date"><i class="bi bi-folder2-open me-1"></i>{{ $product->subtitle ?? 'Proje' }}</span>
								</div>
								<h4 class="title my-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 3rem;">
									<a href="{{ route('proje.detay', $product->slug) }}">{{ $product->title }}</a>
								</h4>
								<div class="card-terms">
									<a class="terms badge" href="{{ route('proje.detay', $product->slug) }}">{{ $product->category ?? 'Yazılım' }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			@endif
		</div>
	</div>
</section>
<!-- ***** Projects Area End ***** -->

<!-- ***** CTA Area Start ***** -->
<section class="cta border-top border-light-subtle">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-12 col-md-10 col-lg-7">
				<h2 class="title mb-0 mb-md-2">Birlikte Harika Şeyler</h2>
				<div class="cta-text">
					<span class="line-item">Üretelim</span>
					<span class="line"></span>
					<a class="btn magnetic-button" href="{{ url('/contact') }}">İletişime Geçin! <i class="icon bi bi-arrow-right ms-1"></i><span></span></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** CTA Area End ***** -->
@endsection
