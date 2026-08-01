@extends('frontend.layouts.app')

@section('content')
<!-- ***** Breadcrumb Area Start ***** -->
<section id="home" class="breadcrumb-section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12">
				<!-- Content -->
				<div class="content w-60">
					<h1 class="title">Yenilikçi projeler</h1>
					<div class="flex ms-auto">
						<span class="line animate-line"></span>
						<h1 class="title">ve dijital uzmanlık</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

<!-- ***** Project Area Start ***** -->
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
							<input type="radio" class="btn-check filter-btn" name="shuffle-filter" id="yazilim" value="yazilim">
							<label class="btn" for="yazilim">Yazılım</label>
						</div>
					</div>

					<div class="input-item d-flex">
						<div class="content">
							<input type="radio" class="btn-check filter-btn" name="shuffle-filter" id="tasarim" value="tasarim">
							<label class="btn" for="tasarim">Tasarım</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row filter-items items inner">
			@if(isset($products) && $products->count() > 0)
				@foreach($products as $product)
				@php
					// Veritabanındaki kategori adına göre filtre sınıfını belirliyoruz (örnek basit eşleştirme)
					$catSlug = Str::slug($product->category ?? 'Yazılım');
				@endphp
				<div class="col-12 col-lg-4 item filter-item" data-groups='["{{ $catSlug }}"]'>
					<!-- Portfolio Item -->
					<div class="card portfolio-item layout-2 scale has-shadow h-100 d-flex flex-column">
						<div class="image-holder">
							<!-- Card Thumb -->
							<a class="card-thumb" href="{{ route('proje.detay', $product->slug) }}">
								@if($product->image)
									<img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}">
								@else
									<img src="{{ asset('frontend-assets/img/content/case-1.jpg') }}" alt="{{ $product->title }}">
								@endif
							</a>
						</div>
						<!-- Card content -->
						<div class="card-content p-2 d-flex flex-column" style="flex: 1;">
							<div class="heading d-flex flex-column h-100">
								<h4 class="title mt-2 mt-md-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">
									<a href="{{ route('proje.detay', $product->slug) }}" class="text-dark text-decoration-none">{{ $product->title }}</a>
								</h4>
								<div class="show-project mt-auto">
									<div class="card-terms">
										<a class="terms badge" href="{{ route('proje.detay', $product->slug) }}">{{ $product->category ?? 'Yazılım' }}</a>
									</div>
									<div class="project-link">
										<a href="{{ route('proje.detay', $product->slug) }}">Projeyi İncele</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			@else
				<!-- Dummy Data if Database is empty -->
				<div class="col-12 col-lg-4 item filter-item" data-groups='["yazilim"]'>
					<div class="card portfolio-item layout-2 scale has-shadow h-100 d-flex flex-column">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ asset('frontend-assets/img/content/case-1.jpg') }}" alt="">
							</a>
						</div>
						<div class="card-content p-2 d-flex flex-column" style="flex: 1;">
							<div class="heading d-flex flex-column h-100">
								<h4 class="title mt-2 mt-md-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">Mobil Uygulama</h4>
								<div class="show-project mt-auto">
									<div class="card-terms">
										<a class="terms badge" href="#">Yazılım</a>
									</div>
									<div class="project-link">
										<a href="#">Projeyi İncele</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 col-lg-8 item filter-item" data-groups='["tasarim"]'>
					<div class="card portfolio-item layout-2 scale has-shadow h-100 d-flex flex-column">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ asset('frontend-assets/img/content/case-2.jpg') }}" alt="">
							</a>
						</div>
						<div class="card-content p-2 d-flex flex-column" style="flex: 1;">
							<div class="heading d-flex flex-column h-100">
								<h4 class="title mt-2 mt-md-3 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">Arayüz Tasarımı</h4>
								<div class="show-project mt-auto">
									<div class="card-terms">
										<a class="terms badge" href="#">Tasarım</a>
									</div>
									<div class="project-link">
										<a href="#">Projeyi İncele</a>
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

<!-- ***** CTA Area Start ***** -->
<section class="cta layout-2 primary-bg">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-12 col-md-8 col-lg-7">
				<div class="cta-text">
					<span class="sub-title">Birlikte çalışmak ister misiniz?</span>
					<h2 class="title mt-3 mb-0">Harika Şeyler <span>Üretelim</span></h2>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-5 text-md-end mt-3 mt-md-0">
				<a class="btn magnetic-button" href="{{ url('/iletisim') }}">İletişime Geçin! <i class="icon bi bi-arrow-right ms-1"></i><span></span></a>
			</div>
		</div>
	</div>
</section>
<!-- ***** CTA Area End ***** -->
@endsection
