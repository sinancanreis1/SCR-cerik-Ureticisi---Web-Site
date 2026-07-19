@extends('frontend.layouts.app')

@section('content')
<!-- ***** Hero Area Start ***** -->
<section id="home" class="hero-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Hero Content -->
				<div class="hero-content">
					<span class="intro-text">{{ $siteSetting->hero_subtitle ?? 'Merhaba! Ben Sinan Can REİS.' }}</span>
					<h1 class="title section-title mt-3 mt-md-4 mb-md-5">
						{{ $siteSetting->hero_title ?? 'Yazılım, Yapay Zeka ve Dijital Dünyanın Şifreleri' }}
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
					<h3 class="title">Seçili Çalışmalar</h3>
					<a class="btn btn-outline content-btn swap-icon" href="{{ url('/projelerim') }}">Tümünü Gör <i class="icon bi bi-arrow-right-short"></i></a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="stack-wrapper">
				@if(isset($products) && $products->count() > 0)
					@foreach($products as $product)
					<div class="stack-item">
						<div class="card portfolio-item layout-2 scale has-shadow">
							<div class="image-holder">
								<a class="card-thumb" href="#">
									<img src="{{ Storage::url($product->image ?? 'frontend-assets/img/content/case-1.jpg') }}" alt="{{ $product->name }}">
								</a>
								<div class="card-overlay">
									<div class="heading">
										<h4 class="title mt-2 mt-md-3 mb-3">{{ $product->name }}</h4>
										<div class="show-project">
											<div class="card-terms">
												<a class="terms badge outlined" href="#">{{ $product->category->name ?? 'Tasarım' }}</a>
											</div>
											<div class="project-link">
												<a href="#">Projeyi İncele</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<!-- Dummy Portfolio Items if DB is empty -->
					<div class="stack-item">
						<div class="card portfolio-item layout-2 scale has-shadow">
							<div class="image-holder">
								<a class="card-thumb" href="#">
									<img src="{{ asset('frontend-assets/img/content/case-1.jpg') }}" alt="">
								</a>
								<div class="card-overlay">
									<div class="heading">
										<h4 class="title mt-2 mt-md-3 mb-3">Açık Kaynak Projeler</h4>
										<div class="show-project">
											<div class="card-terms">
												<a class="terms badge outlined" href="#">Laravel</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</section>
<!-- ***** Works Area End ***** -->

<!-- ***** Insights Area Start ***** -->
<section class="blog">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="intro d-flex justify-content-between align-items-center">
					<h3 class="title">Son İçerikler</h3>
					<a class="btn btn-outline content-btn swap-icon" href="{{ url('/icerikler') }}">Tümünü Gör <i class="icon bi bi-arrow-right-short"></i></a>
				</div>
			</div>
		</div>

		<div class="row items">
			@if(isset($blogs) && $blogs->count() > 0)
				@foreach($blogs as $blog)
				<div class="col-12 col-md-6 col-lg-4 item">
					<div class="card blog-item">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ Storage::url($blog->image ?? 'frontend-assets/img/blog/blog-1.jpg') }}" alt="{{ $blog->title }}">
							</a>
							<div class="card-overlay top fade-down">
								<div class="logo">
									<img src="{{ asset('frontend-assets/img/logo/logo.png') }}" alt="">
								</div>
								<div class="post-meta d-flex flex-column ms-3">
									<span>Yazar</span>
									<span class="post-author"><strong>Sinan Can REİS</strong></span>
								</div>
							</div>
						</div>
						<div class="card-content mt-3">
							<div class="heading">
								<div class="post-meta d-flex">
									<span class="post-date"><i class="bi bi-clock me-1"></i>{{ $blog->created_at->format('d M Y') }}</span>
								</div>
								<h4 class="title my-2">
									<a href="#">{{ $blog->title }}</a>
								</h4>
								<div class="card-terms">
									<a class="terms badge" href="#">{{ $blog->category->name ?? 'Yazılım' }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			@else
				<!-- Dummy Posts -->
				<div class="col-12 col-md-6 col-lg-4 item">
					<div class="card blog-item">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ asset('frontend-assets/img/blog/blog-1.jpg') }}" alt="">
							</a>
						</div>
						<div class="card-content mt-3">
							<div class="heading">
								<h4 class="title my-2">
									<a href="#">Dijital Dünyada Yapay Zekanın Yeri</a>
								</h4>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</section>
<!-- ***** Insights Area End ***** -->

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
