@extends('frontend.layouts.app')

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
						<h1 class="title">notlar ve içerikler</h1>
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
					<div class="card portfolio-item layout-2 scale has-shadow">
						<div class="image-holder">
							<!-- Card Thumb -->
							<a class="card-thumb" href="#">
								@if($blog->image_path)
									<img src="{{ Storage::url($blog->image_path) }}" alt="{{ $blog->title }}">
								@else
									<img src="{{ asset('frontend-assets/img/blog/blog-1.jpg') }}" alt="{{ $blog->title }}">
								@endif
							</a>
						</div>
						<!-- Card content -->
						<div class="card-content p-2">
							<div class="heading">
								<h4 class="title mt-2 mt-md-3 mb-3">{{ $blog->title }}</h4>
								<div class="show-project">
									<div class="card-terms">
										<a class="terms badge" href="#">{{ $blog->category ?? 'Yapay Zeka' }}</a>
									</div>
									<div class="project-link">
										<a href="#">İçeriği Oku</a>
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
					<div class="card portfolio-item layout-2 scale has-shadow">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ asset('frontend-assets/img/blog/blog-1.jpg') }}" alt="">
							</a>
						</div>
						<div class="card-content p-2">
							<div class="heading">
								<h4 class="title mt-2 mt-md-3 mb-3">Yapay Zeka Araçları ile Kodlama</h4>
								<div class="show-project">
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
					<div class="card portfolio-item layout-2 scale has-shadow">
						<div class="image-holder">
							<a class="card-thumb" href="#">
								<img src="{{ asset('frontend-assets/img/blog/blog-2.jpg') }}" alt="">
							</a>
						</div>
						<div class="card-content p-2">
							<div class="heading">
								<h4 class="title mt-2 mt-md-3 mb-3">Laravel 11 ile Gelen Yenilikler</h4>
								<div class="show-project">
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
