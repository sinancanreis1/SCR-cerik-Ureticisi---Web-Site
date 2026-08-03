@extends('frontend.layouts.app')

@section('title', 'Yazılar & Notlar | Sinan Can REİS')
@section('meta_description', 'Bilişim dünyasından en güncel notlar, yazılım ve yapay zeka makaleleri, teknoloji ve bilim dünyasındaki gelişmeler.')

@section('content')
<!-- ***** Breadcrumb Area Start ***** -->
<section id="home" class="breadcrumb-section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12">
				<div class="content w-60">
					<h1 class="title">Bilişim dünyasından</h1>
					<div class="flex ms-auto">
						<span class="line animate-line"></span>
						<h1 class="title">notlar ve yazılar</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

<!-- ***** Project Area Start (Adapted for Insights) ***** -->
<section class="works explore-area portfolio-filter pt-0">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-12">
				<div class="btn-group filter-menu" role="group" aria-label="Kategori Filtresi">
					<div class="input-item d-flex">
						<div class="content">
							<input type="radio" class="btn-check filter-btn" name="shuffle-filter" id="all" value="all" checked>
							<label class="btn" for="all">Tümü</label>
						</div>
					</div>

					<div class="input-item d-flex">
						<div class="content">
							<input type="radio" class="btn-check filter-btn" name="shuffle-filter" id="sektorden-notlar" value="sektorden-notlar">
							<label class="btn" for="sektorden-notlar">Sektörden Notlar</label>
						</div>
					</div>

					<div class="input-item d-flex">
						<div class="content">
							<input type="radio" class="btn-check filter-btn" name="shuffle-filter" id="bilimden-notlar" value="bilimden-notlar">
							<label class="btn" for="bilimden-notlar">Bilimden Notlar</label>
						</div>
					</div>

					<div class="input-item d-flex">
						<div class="content">
							<input type="radio" class="btn-check filter-btn" name="shuffle-filter" id="yapay-zeka" value="yapay-zeka">
							<label class="btn" for="yapay-zeka">Yapay Zeka</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row filter-items items inner">
			@if(isset($blogs) && $blogs->count() > 0)
				@foreach($blogs as $blog)
				@php
					// Veritabanındaki kategori adına göre filtre sınıfını belirliyoruz (yoksa varsayılan)
					$catSlug = Str::slug($blog->category ?? 'Yapay Zeka');
				@endphp
				<div class="col-12 col-lg-4 item filter-item" data-groups='["{{ $catSlug }}"]'>
					<!-- Portfolio Style Item for Blog -->
					<div class="card portfolio-item layout-2 scale has-shadow h-100 d-flex flex-column">
						<div class="image-holder">
							<!-- Card Thumb -->
							<a class="card-thumb" href="{{ route('icerik.detay', $blog->slug) }}">
								@if($blog->image_path)
									<img src="{{ asset('storage/' . $blog->image_path) }}" alt="{{ $blog->title }}">
								@else
									<img src="{{ asset('frontend-assets/img/blog/blog-1.jpg') }}" alt="{{ $blog->title }}">
								@endif
							</a>
						</div>
						<!-- Card content -->
						<div class="card-content p-2 d-flex flex-column" style="flex: 1;">
							<div class="heading d-flex flex-column h-100">
								<h4 class="title mt-2 mt-md-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">
									<a href="{{ route('icerik.detay', $blog->slug) }}" class="text-dark text-decoration-none">{{ $blog->title }}</a>
								</h4>
								<div class="show-project mt-auto">
									<div class="card-terms">
										<a class="terms badge" href="{{ route('icerik.detay', $blog->slug) }}">{{ $blog->category ?? 'Yapay Zeka' }}</a>
									</div>
									<div class="project-link">
										<a href="{{ route('icerik.detay', $blog->slug) }}">İçeriği Oku</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			@else
				<!-- Dummy Data if Database is empty -->
				<div class="col-12 col-lg-4 item filter-item" data-groups='["yapay-zeka"]'>
					<div class="card portfolio-item layout-2 scale has-shadow h-100 d-flex flex-column">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ asset('frontend-assets/img/blog/blog-1.jpg') }}" alt="">
							</a>
						</div>
						<div class="card-content p-2 d-flex flex-column" style="flex: 1;">
							<div class="heading d-flex flex-column h-100">
								<h4 class="title mt-2 mt-md-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">Yapay Zeka Araçları ile Kodlama</h4>
								<div class="show-project mt-auto">
									<div class="card-terms">
										<a class="terms badge" href="#">Yapay Zeka</a>
									</div>
									<div class="project-link">
										<a href="#">İçeriği Oku</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-8 item filter-item" data-groups='["bilimden-notlar"]'>
					<div class="card portfolio-item layout-2 scale has-shadow h-100 d-flex flex-column">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ asset('frontend-assets/img/blog/blog-2.jpg') }}" alt="">
							</a>
						</div>
						<div class="card-content p-2 d-flex flex-column" style="flex: 1;">
							<div class="heading d-flex flex-column h-100">
								<h4 class="title mt-2 mt-md-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">Laravel 11 ile Gelen Yenilikler</h4>
								<div class="show-project mt-auto">
									<div class="card-terms">
										<a class="terms badge" href="#">Bilgilendirici Metinler</a>
									</div>
									<div class="project-link">
										<a href="#">İçeriği Oku</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</section>
<!-- ***** Project Area End ***** -->
@endsection
