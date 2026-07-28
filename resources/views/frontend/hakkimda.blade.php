@extends('frontend.layouts.app')

@section('content')
<!-- ***** Breadcrumb Area Start ***** -->
<section id="home" class="breadcrumb-section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12">
				<div class="content w-60">
					<h1 class="title">{{ $siteSetting->about_hero_title ?? 'Benim' }}</h1>
					<div class="flex ms-auto">
						<span class="line animate-line"></span>
						<h1 class="title">{{ $siteSetting->about_hero_subtitle ?? 'hikayem' }}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

<!-- ***** About Area Start ***** -->
<section class="about pt-0">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-4">
				<div class="image-holder">
					<img src="{{ $siteSetting->about_intro_image ? asset('storage/' . $siteSetting->about_intro_image) : asset('frontend-assets/img/content/about.jpg') }}" alt="Hakkımda Resmi" style="max-width: 100%; border-radius: 16px;">
				</div>
			</div>
			<div class="col-12 col-md-8 mt-5 mt-md-0 pl-md-5">
				<h2 class="title">{{ $siteSetting->about_intro_title ?? 'Yazılım ve Dijital Gelişim Serüvenim' }}</h2>
				<p class="description mt-4">
					{!! nl2br(e($siteSetting->about_intro_text_1 ?? '')) !!}
				</p>
				<p class="description mt-3">
					{!! nl2br(e($siteSetting->about_intro_text_2 ?? '')) !!}
				</p>
				<div class="about-btn mt-5">
					<a class="btn magnetic-button" href="{{ url('/iletisim') }}">İletişime Geç <i class="icon bi bi-arrow-right ms-1"></i><span></span></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** About Area End ***** -->
@endsection

