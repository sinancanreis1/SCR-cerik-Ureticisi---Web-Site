@extends('frontend.layouts.app')

@section('content')
<!-- ***** Breadcrumb Area Start ***** -->
<section id="home" class="breadcrumb-section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12">
				<div class="content w-100">
					<div class="d-flex align-items-center gap-3 mb-3">
						<a class="btn btn-outline content-btn swap-icon" href="{{ route('icerikler') }}">
							<i class="icon bi bi-arrow-left-short me-1"></i> Tüm Yazılar
						</a>
						<span class="badge" style="background-color: #661414; color: #ffffff; font-size: 1rem; padding: 6px 16px; border-radius: 20px;">
							{{ $blog->category ?? 'Yapay Zeka' }}
						</span>
					</div>
					<h1 class="title mb-3" style="font-size: 2.8rem; line-height: 1.2;">{{ $blog->title }}</h1>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

<!-- ***** Blog Detail Main Area Start ***** -->
<section class="blog-detail-section pt-0 pb-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<!-- Meta Info Bar -->
				<div class="post-meta d-flex flex-wrap align-items-center gap-4 py-3 mb-4 border-top border-bottom" style="border-color: #e5e7eb !important;">
					<span class="d-flex align-items-center gap-2" style="color: #565960; font-size: 1.05rem;">
						<i class="bi bi-person-circle" style="color: #661414; font-size: 1.2rem;"></i> Yazar: <strong style="color: #030712;">Sinan Can REİS</strong>
					</span>
					<span class="d-flex align-items-center gap-2" style="color: #565960; font-size: 1.05rem;">
						<i class="bi bi-calendar3" style="color: #661414; font-size: 1.1rem;"></i> Tarih: <strong style="color: #030712;">{{ $blog->created_at ? $blog->created_at->format('d.m.Y') : '19.07.2026' }}</strong>
					</span>

				</div>

				<!-- Main Featured Image -->
				@if($blog->image_path)
					<div class="main-image-wrapper mb-5 rounded-4 overflow-hidden shadow-sm" style="max-height: 480px;">
						<img src="{{ asset('storage/' . $blog->image_path) }}" alt="{{ $blog->title }}" class="w-100 h-100 object-fit-cover">
					</div>
				@endif

				<!-- Excerpt Callout -->
				@if($blog->excerpt)
					<div class="excerpt-box p-4 mb-4 rounded-3" style="background-color: #ffffff; border-left: 5px solid #661414; box-shadow: 0 4px 15px rgba(0,0,0,0.05); font-size: 1.25rem; line-height: 1.6; color: #353941; font-weight: 500;">
						{{ $blog->excerpt }}
					</div>
				@endif

				<!-- Content Body -->
				<div class="blog-body-content mb-5" style="font-size: 1.15rem; line-height: 1.85; color: #191919;">
					{!! $blog->content !!}
				</div>



				<!-- Related Posts Area -->
				@if(isset($relatedBlogs) && $relatedBlogs->count() > 0)
					<div class="related-posts mt-5 border-top pt-5" style="border-color: #e5e7eb !important;">
						<h3 class="title mb-4" style="color: #030712; font-size: 2rem;">İlgili Yazılar</h3>
						<div class="row items">
							@foreach($relatedBlogs as $relBlog)
								<div class="col-12 col-md-6 col-lg-4 item">
									<div class="card blog-item h-100">
										<div class="image-holder">
											<a class="card-thumb" href="{{ route('icerik.detay', $relBlog->slug) }}">
												@if($relBlog->image_path)
													<img src="{{ asset('storage/' . $relBlog->image_path) }}" alt="{{ $relBlog->title }}">
												@else
													<img src="{{ asset('frontend-assets/img/blog/blog-1.jpg') }}" alt="{{ $relBlog->title }}">
												@endif
											</a>
											<div class="card-overlay top fade-down">
												<div class="logo">
													<img src="{{ asset('frontend-assets/img/logo/logo.png') }}" alt="" style="width: 50px; height: 50px; object-fit: contain;">
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
													<span class="post-date"><i class="bi bi-clock me-1"></i>{{ $relBlog->created_at ? $relBlog->created_at->format('d M Y') : '19 Jul 2026' }}</span>
												</div>
												<h4 class="title my-2">
													<a href="{{ route('icerik.detay', $relBlog->slug) }}">{{ $relBlog->title }}</a>
												</h4>
												<div class="card-terms">
													<a class="terms badge" href="{{ route('icerik.detay', $relBlog->slug) }}">{{ $relBlog->category ?? 'Yapay Zeka' }}</a>
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
<!-- ***** Blog Detail Main Area End ***** -->

<!-- ***** CTA Area Start ***** -->
<section class="cta border-top border-light-subtle">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-12 col-md-10 col-lg-7">
				<h2 class="title mb-0 mb-md-2">Birlikte Harika Şeyler</h2>
				<div class="cta-text">
					<span class="line-item">Üretelim</span>
					<span class="line"></span>
					<a class="btn magnetic-button" href="{{ url('/iletisim') }}">İletişime Geçin! <i class="icon bi bi-arrow-right ms-1"></i><span></span></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** CTA Area End ***** -->
@endsection
