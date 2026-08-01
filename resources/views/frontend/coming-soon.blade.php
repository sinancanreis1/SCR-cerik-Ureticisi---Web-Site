@extends('frontend.layouts.app')

@section('content')
<!-- ***** Hero Area Start ***** -->
<section id="home" class="hero-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Hero Content -->
				<div class="hero-content" style="padding-top: 60px;">
					<span class="intro-text" style="color: #661414; font-weight: 700; font-size: 1.2rem;">
						<i class="bi bi-rocket-takeoff me-2"></i>Çok Yakında Yayında | Sinan Can REİS
					</span>
					<h1 class="title section-title mt-3 mt-md-4 mb-md-4" style="font-size: 3.5rem; line-height: 1.2;">
						Yazılım, Yapay Zeka ve Dijital Dünyanın Şifreleri
					</h1>

					<!-- Content -->
					<div class="content d-flex flex-column flex-md-row justify-content-md-between align-items-start gap-4">
						<div class="hero-button order-last order-md-first mt-3 mt-md-0 d-flex flex-wrap gap-3">
						</div>
						<p class="sub-title order-first order-md-last" style="max-width: 600px; font-size: 1.2rem; line-height: 1.7; color: #565960;">
							Sektörden güncel notlar, yapay zeka entegrasyon rehberleri ve yazılım dünyasından özel içeriklerle dolu yeni dijital platformumuz çok yakında sizlerle buluşuyor.
						</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Countdown Timer Panel -->
		<div class="row mt-5">
			<div class="col-12">
				<div class="p-4 p-md-5 rounded-4 shadow-sm" style="background: #ffffff; border: 1px solid #e5e7eb;">
					<div class="row align-items-center text-center text-md-start">
						<div class="col-12 col-md-5 mb-4 mb-md-0">
							<span class="badge mb-2" style="background-color: #661414; color: #fff; padding: 6px 16px; border-radius: 20px; font-size: 0.9rem;">
								Yayın İçin Geri Sayım
							</span>
							<h3 class="title mb-2" style="color: #030712; font-size: 2rem;">Platform Açılışına Kalan Süre</h3>
							<p class="mb-0 text-muted">Açılış gününe özel içerikler ve rehberler hazırlanıyor.</p>
						</div>
						<div class="col-12 col-md-7">
							<div class="d-flex justify-content-center justify-content-md-end align-items-center gap-1 gap-md-4 flex-wrap flex-sm-nowrap">
								<div class="text-center p-2 p-md-3 rounded-3 flex-fill" style="background: #f8f8f9; border: 1px solid #e5e7eb;">
									<div id="cd-days" class="fw-bold fs-2 fs-md-1" style="color: #661414;">07</div>
									<div class="text-uppercase small fw-bold text-muted mt-1" style="font-size: 0.7rem;">GÜN</div>
								</div>
								<div class="fw-bold fs-4 fs-md-3 text-muted d-none d-sm-block">:</div>
								<div class="text-center p-2 p-md-3 rounded-3 flex-fill" style="background: #f8f8f9; border: 1px solid #e5e7eb;">
									<div id="cd-hours" class="fw-bold fs-2 fs-md-1" style="color: #661414;">14</div>
									<div class="text-uppercase small fw-bold text-muted mt-1" style="font-size: 0.7rem;">SAAT</div>
								</div>
								<div class="fw-bold fs-4 fs-md-3 text-muted d-none d-sm-block">:</div>
								<div class="text-center p-2 p-md-3 rounded-3 flex-fill" style="background: #f8f8f9; border: 1px solid #e5e7eb;">
									<div id="cd-minutes" class="fw-bold fs-2 fs-md-1" style="color: #661414;">30</div>
									<div class="text-uppercase small fw-bold text-muted mt-1" style="font-size: 0.7rem;">DAKİKA</div>
								</div>
								<div class="fw-bold fs-4 fs-md-3 text-muted d-none d-sm-block">:</div>
								<div class="text-center p-2 p-md-3 rounded-3 flex-fill" style="background: #f8f8f9; border: 1px solid #e5e7eb;">
									<div id="cd-seconds" class="fw-bold fs-2 fs-md-1" style="color: #661414;">45</div>
									<div class="text-uppercase small fw-bold text-muted mt-1" style="font-size: 0.7rem;">SANİYE</div>
								</div>
							</div>
						</div>
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

<!-- ***** About Section Start (Sinan Can REİS Hakkında) ***** -->
<section class="about py-5">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-12 col-md-5">
				<div class="image-holder shadow-sm rounded-4 overflow-hidden" style="background-color: #f8f8f9;">
					<img src="{{ asset('frontend-assets/img/content/sinan2.jpg') }}" alt="Sinan Can REİS" class="img-fluid w-100 object-fit-contain" style="border-radius: 16px; max-height: 500px;">
				</div>
			</div>
			<div class="col-12 col-md-7 mt-4 mt-md-0 ps-md-5">
				<span class="badge mb-2" style="background-color: #661414; color: #fff; padding: 6px 16px; border-radius: 20px;">
					Sinan Can REİS Kimdir?
				</span>
				<h2 class="title mt-2 mb-3" style="color: #030712; font-size: 2.5rem;">Yazılım ve Yapay Zeka Tutkusu</h2>
				<p class="description fs-5 lh-lg text-secondary">
					2019 yılından beri içimde filizlenen yazılım merakı, uzun süre doğru zamanı ve fırsatı bekleyen bir tutkuydu. Eğitimimle eş zamanlı ilerlettiğim bu süreçte; front-end'den back-end'e, tasarımdan yapay zeka entegrasyonlarına kadar yazılımın her dokusuna temas etme fırsatı buldum.
				</p>
				<p class="description fs-5 lh-lg text-secondary">
					Nihai amacım; yazılım, teknoloji, bilişim ve bilim alanlarında gördüğüm eksiklikleri dolduracak bir köprü olmak; durmaksızın öğrenmek, büyümek, edindiğim tecrübeyi öğretmek ve bu ekosisteme kendi imzamı taşıyan yenilikçi değerler üretmektir.
				</p>

			</div>
		</div>
	</div>
</section>
<!-- ***** About Section End ***** -->

<!-- ***** Features / Platform Info Start (Bu Sitede Neler Olacak?) ***** -->
<section class="works py-5 position-relative" style="background-color: #f8f8f9;">
	<div class="container">
		<div class="row justify-content-center text-center mb-5">
			<div class="col-12 col-md-8">
				<span class="badge mb-2" style="background-color: #661414; color: #fff; padding: 6px 16px; border-radius: 20px;">
					Platform İçeriği
				</span>
				<h2 class="title" style="color: #030712; font-size: 2.5rem;">Bu Platformda Neler Yer Alacak?</h2>
				<p class="text-secondary fs-5">Yayınlandığında sitede bulabileceğiniz temel içerik ve hizmet alanları:</p>
			</div>
		</div>

		<div class="row g-4">
			<!-- Pillar 1 -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="p-4 rounded-4 h-100 shadow-sm border" style="background: #ffffff; border-color: #e5e7eb !important;">
					<div class="d-flex align-items-center justify-content-center text-white rounded-3 mb-3" style="width: 55px; height: 55px; background: #661414; font-size: 1.6rem;">
						<i class="bi bi-robot"></i>
					</div>
					<h4 class="mb-2" style="color: #030712; font-weight: 600;">Yapay Zeka & AI</h4>
					<p class="text-secondary mb-0" style="font-size: 1rem; line-height: 1.6;">
						ChatGPT, Copilot, RAG mimarileri ve kod yazma sürecinizi 3 kat hızlandıracak pratik yapay zeka rehberleri.
					</p>
				</div>
			</div>

			<!-- Pillar 2 -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="p-4 rounded-4 h-100 shadow-sm border" style="background: #ffffff; border-color: #e5e7eb !important;">
					<div class="d-flex align-items-center justify-content-center text-white rounded-3 mb-3" style="width: 55px; height: 55px; background: #661414; font-size: 1.6rem;">
						<i class="bi bi-code-slash"></i>
					</div>
					<h4 class="mb-2" style="color: #030712; font-weight: 600;">Yazılım & Mimari</h4>
					<p class="text-secondary mb-0" style="font-size: 1rem; line-height: 1.6;">
						Laravel 11, Python FastAPI, React ve modern backend/frontend mimarileri üzerine teknik ipuçları.
					</p>
				</div>
			</div>

			<!-- Pillar 3 -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="p-4 rounded-4 h-100 shadow-sm border" style="background: #ffffff; border-color: #e5e7eb !important;">
					<div class="d-flex align-items-center justify-content-center text-white rounded-3 mb-3" style="width: 55px; height: 55px; background: #661414; font-size: 1.6rem;">
						<i class="bi bi-journal-bookmark"></i>
					</div>
					<h4 class="mb-2" style="color: #030712; font-weight: 600;">Sektörden Notlar</h4>
					<p class="text-secondary mb-0" style="font-size: 1rem; line-height: 1.6;">
						Teknoloji ekosisteminden güncel haberler, vaka analizleri ve dijital gelişim yol haritaları.
					</p>
				</div>
			</div>

			<!-- Pillar 4 -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="p-4 rounded-4 h-100 shadow-sm border" style="background: #ffffff; border-color: #e5e7eb !important;">
					<div class="d-flex align-items-center justify-content-center text-white rounded-3 mb-3" style="width: 55px; height: 55px; background: #661414; font-size: 1.6rem;">
						<i class="bi bi-book"></i>
					</div>
					<h4 class="mb-2" style="color: #030712; font-weight: 600;">Bilimden Notlar</h4>
					<p class="text-secondary mb-0" style="font-size: 1rem; line-height: 1.6;">
						Bilim dünyasındaki önemli gelişmeler, ufuk açıcı araştırmalar ve teknolojiyle harmanlanmış akademik notlar.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Features / Platform Info End ***** -->



@push('scripts')
<script>
    // Live Launch Countdown Timer
    const launchTarget = new Date();
    launchTarget.setDate(launchTarget.getDate() + 7);

    const daysEl = document.getElementById('cd-days');
    const hoursEl = document.getElementById('cd-hours');
    const minutesEl = document.getElementById('cd-minutes');
    const secondsEl = document.getElementById('cd-seconds');

    function updateTimer() {
        const now = new Date().getTime();
        const diff = launchTarget.getTime() - now;

        if (diff <= 0) return;

        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((diff % (1000 * 60)) / 1000);

        if (daysEl) daysEl.innerText = d < 10 ? '0' + d : d;
        if (hoursEl) hoursEl.innerText = h < 10 ? '0' + h : h;
        if (minutesEl) minutesEl.innerText = m < 10 ? '0' + m : m;
        if (secondsEl) secondsEl.innerText = s < 10 ? '0' + s : s;
    }

    setInterval(updateTimer, 1000);
    updateTimer();
</script>
@endpush
@endsection
