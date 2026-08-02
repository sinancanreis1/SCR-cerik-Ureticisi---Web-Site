@extends('frontend.layouts.app')

@section('content')
<!-- ***** Breadcrumb Area Start ***** -->
<section id="home" class="breadcrumb-section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12">
				<div class="content w-100">
					<div class="d-flex align-items-center gap-4 mb-4">
						<a class="btn btn-outline content-btn swap-icon" href="{{ route('projelerim') }}">
							<i class="icon bi bi-arrow-left-short me-1"></i> Tüm Projeler
						</a>
						<span class="badge" style="background-color: #661414; color: #ffffff; font-size: 1rem; padding: 6px 16px; border-radius: 20px;">
							{{ $product->category ?? 'Yazılım' }}
						</span>
					</div>
					<h1 class="title mb-2" style="font-size: 2.8rem; line-height: 1.2;">{{ $product->title }}</h1>
					@if($product->subtitle)
						<p class="description mb-0" style="font-size: 1.3rem; color: #565960;">{{ $product->subtitle }}</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

<!-- ***** Project Detail Main Area Start ***** -->
<section class="project-detail-section pt-0 pb-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<!-- Featured Project Image -->
				@if($product->image)
					<div class="main-image-wrapper mb-5 rounded-4 overflow-hidden shadow-sm" style="max-height: 480px;">
						<img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="w-100 h-100 object-fit-cover">
					</div>
				@endif

				<div class="row g-4 mb-5">
					<div class="col-12 col-md-8">
						<div class="p-4 rounded-4" style="background: #ffffff; border: 1px solid #e5e7eb; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
							<h3 class="mb-3" style="color: #030712; font-weight: 600;">Proje Hakkında</h3>
							<div class="project-long-desc" style="font-size: 1.15rem; line-height: 1.8; color: #353941; margin-bottom: 0;">
								@if($product->long_desc)
									{!! $product->long_desc !!}
								@else
									<p style="margin-bottom: 0;">{{ $product->desc ?? 'Bu proje hakkında henüz detaylı açıklama girilmemiş.' }}</p>
								@endif
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="p-4 rounded-4" style="background: #ffffff; border: 1px solid #e5e7eb; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
							<h4 class="mb-3" style="color: #030712; font-weight: 600;">Proje Detayları</h4>
							<ul class="list-unstyled mb-0" style="font-size: 1.05rem; line-height: 2; color: #565960;">
								<li><strong style="color: #030712;">Kategori:</strong> {{ $product->category ?? 'Yazılım' }}</li>
								<li><strong style="color: #030712;">Geliştirici:</strong> Sinan Can REİS</li>
								<li><strong style="color: #030712;">Tarih:</strong> {{ $product->project_date ?? ($product->created_at ? $product->created_at->format('Y') : '2026') }}</li>
							</ul>
							@if($product->project_link)
								<div class="mt-4 pt-3" style="border-top: 1px solid #e5e7eb;">
									<a href="{{ $product->project_link }}" target="_blank" class="btn d-block w-100" style="background-color: #ffffff; border: 2px solid #661414; color: #661414; border-radius: 12px; padding: 10px 16px; font-weight: 600;">
										<i class="bi bi-box-arrow-up-right me-2"></i> Web Sitesi
									</a>
								</div>
							@endif
						</div>
					</div>
				</div>



				<!-- Project Interactions (Likes and Comments) -->
				<div class="interactions-area mt-5 pt-4 border-top">
					<div class="d-flex align-items-center mb-4">
						<form action="{{ route('product.like', $product->id) }}" method="POST">
							@csrf
							@php
								if (auth()->check()) {
									$hasLiked = $product->likes()->where('user_id', auth()->id())->exists();
								} else {
									$hasLiked = $product->likes()->whereNull('user_id')->where('ip_address', request()->ip())->exists();
								}
							@endphp
							<button type="submit" class="btn {{ $hasLiked ? 'btn-danger' : 'btn-outline-danger' }} d-flex align-items-center gap-2" style="border-radius: 20px;">
								<i class="bi {{ $hasLiked ? 'bi-heart-fill' : 'bi-heart' }}"></i> {{ $product->likes()->count() }} Beğeni
							</button>
						</form>
					</div>

					<div class="comments-section mt-5">
						<h3 class="title mb-4" style="color: #030712; font-size: 1.8rem;">Yorumlar ({{ $product->comments()->where('is_approved', true)->count() }})</h3>
						
						@auth
							<div class="comment-form-wrapper mb-5 p-4 rounded-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
								<h5 class="mb-3">Yorum Yap</h5>
								<form action="{{ route('product.comment', $product->id) }}" method="POST">
									@csrf
									<div class="form-group mb-3">
										<textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Yorumunuzu buraya yazın..." required style="border-radius: 10px; padding: 15px; border-color: #cbd5e1;">{{ old('content') }}</textarea>
										@error('content')
											<div class="invalid-feedback mt-2 fw-semibold">{{ $message }}</div>
										@enderror
									</div>
									<button type="submit" class="btn btn-primary" style="background: #661414; border: none; padding: 10px 25px; border-radius: 20px;">Gönder</button>
								</form>
							</div>
						@else
							<div class="alert alert-info rounded-4 mb-5">
								Yorum yapabilmek için lütfen <a href="{{ route('login') }}" class="fw-bold text-decoration-underline">giriş yapın</a>.
							</div>
						@endauth

						<div class="comments-list">
							@foreach($product->comments()->where('is_approved', true)->latest()->get() as $comment)
								<div class="comment-item p-4 mb-4 rounded-4" style="background: #ffffff; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">
									<div class="d-flex align-items-center mb-3">
										<div class="avatar bg-light text-primary d-flex align-items-center justify-content-center rounded-circle me-3" style="width: 45px; height: 45px; font-weight: bold; background: #e2e8f0 !important; color: #64748b !important;">
											{{ strtoupper(substr($comment->user->name, 0, 1)) }}
										</div>
										<div>
											<h6 class="mb-0 fw-bold">{{ $comment->user->name }}</h6>
											<small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
										</div>
									</div>
									<p class="mb-0" style="color: #334155; line-height: 1.6;">{{ $comment->content }}</p>
								</div>
							@endforeach
						</div>
					</div>
				</div>

				<!-- Related Projects -->
				@if(isset($relatedProducts) && $relatedProducts->count() > 0)
					<div class="related-projects mt-5 border-top pt-5" style="border-color: #e5e7eb !important;">
						<h3 class="title mb-4" style="color: #030712; font-size: 2rem;">Diğer Projeler</h3>
						<div class="row items">
							@foreach($relatedProducts as $relProduct)
								<div class="col-12 col-md-6 col-lg-4 item">
									<div class="card portfolio-item layout-2 scale has-shadow h-100 d-flex flex-column">
										<div class="image-holder" style="background-color: #661414;">
											<a class="card-thumb" href="{{ route('proje.detay', $relProduct->slug) }}">
												@if($relProduct->image)
													<img src="{{ Storage::url($relProduct->image) }}" alt="{{ $relProduct->title }}" style="width: 100%; height: 250px; object-fit: contain;">
												@else
													<img src="{{ asset('frontend-assets/img/content/case-1.jpg') }}" alt="{{ $relProduct->title }}" style="width: 100%; height: 250px; object-fit: contain;">
												@endif
											</a>
										</div>
										<div class="card-content p-3 d-flex flex-column" style="flex: 1;">
											<div class="heading d-flex flex-column h-100">
												<h4 class="title mt-2 mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; min-height: 4.5rem;">
													<a href="{{ route('proje.detay', $relProduct->slug) }}">{{ $relProduct->title }}</a>
												</h4>
												<div class="show-project mt-auto">
													<div class="card-terms">
														<a class="terms badge" href="{{ route('proje.detay', $relProduct->slug) }}">{{ $relProduct->category ?? 'Yazılım' }}</a>
														@if($relProduct->project_date)
															<span class="badge" style="background-color: transparent; color: #661414; border: 1px solid #661414; margin-left: 5px;">{{ $relProduct->project_date }}</span>
														@endif
													</div>
													<div class="project-link">
														<a href="{{ route('proje.detay', $relProduct->slug) }}">Projeyi İncele</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</section>
<!-- ***** Project Detail Main Area End ***** -->

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
