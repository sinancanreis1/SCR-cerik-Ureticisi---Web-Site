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
					<h1 class="title mb-3" style="font-size: 2.8rem; line-height: 1.2; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">{{ $blog->title }}</h1>
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
					<div class="excerpt-box p-4 mb-4 rounded-3" style="background-color: #ffffff; border-left: 5px solid #661414; box-shadow: 0 4px 15px rgba(0,0,0,0.05); font-size: 1.25rem; line-height: 1.6; color: #353941; font-weight: 500; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">
						{{ $blog->excerpt }}
					</div>
				@endif

				<!-- Content Body -->
				<div class="blog-body-content mb-5" style="font-size: 1.15rem; line-height: 1.85; color: #191919; word-wrap: break-word; overflow-wrap: break-word; word-break: break-word;">
					{!! $blog->content !!}
				</div>



				<div class="interactions-area mt-5 pt-4 border-top">
					<div class="d-flex align-items-center mb-4">
						<form action="{{ route('blog.like', $blog->id) }}" method="POST">
							@csrf
							@auth
								@php
									$hasLiked = $blog->likes()->where('user_id', auth()->id())->exists();
								@endphp
								<button type="submit" class="btn {{ $hasLiked ? 'btn-danger' : 'btn-outline-danger' }} d-flex align-items-center gap-2" style="border-radius: 20px;">
									<i class="bi {{ $hasLiked ? 'bi-heart-fill' : 'bi-heart' }}"></i> {{ $blog->likes()->count() }} Beğeni
								</button>
							@else
								<button type="button" class="btn btn-outline-danger d-flex align-items-center gap-2" style="border-radius: 20px;" onclick="window.location='{{ route('login') }}'">
									<i class="bi bi-heart"></i> {{ $blog->likes()->count() }} Beğeni
								</button>
							@endauth
						</form>
					</div>

					<div class="comments-section mt-5">
						<h3 class="title mb-4" style="color: #030712; font-size: 1.8rem;">Yorumlar ({{ $blog->comments()->where('is_approved', true)->count() }})</h3>
						
						@auth
							<div class="comment-form-wrapper mb-5 p-4 rounded-4" style="background: #f8fafc; border: 1px solid #e2e8f0;">
								<h5 class="mb-3">Yorum Yap</h5>
								<form action="{{ route('blog.comment', $blog->id) }}" method="POST">
									@csrf
									<div class="form-group mb-3">
										<textarea name="content" class="form-control" rows="3" placeholder="Yorumunuzu buraya yazın..." required style="border-radius: 10px; padding: 15px; border-color: #cbd5e1;"></textarea>
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
							@foreach($blog->comments()->where('is_approved', true)->latest()->get() as $comment)
								<div class="comment-item p-4 mb-4 rounded-4" style="background: #ffffff; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
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
