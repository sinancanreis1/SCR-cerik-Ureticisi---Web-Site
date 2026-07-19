@extends('frontend.layouts.app')

@section('content')
<!-- ***** Breadcrumb Area Start ***** -->
<section id="home" class="breadcrumb-section">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12">
				<div class="content w-60">
					<h1 class="title">Benimle</h1>
					<div class="flex ms-auto">
						<span class="line animate-line"></span>
						<h1 class="title">iletişime geçin</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Breadcrumb Area End ***** -->

<!-- ***** Contact Area Start ***** -->
<section class="contact pt-0">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-12 col-md-5">
				<div class="contact-info">
					<h3 class="title">İletişim Bilgileri</h3>
					<p class="description mt-3">Sponsorluk, işbirliği veya sorularınız için aşağıdaki iletişim kanallarından bana ulaşabilirsiniz.</p>
					
					<div class="info-item mt-5">
						<span class="subtitle">Email</span>
						<h5 class="info-title mt-2"><a href="mailto:info@sinancanreis.com">info@sinancanreis.com</a></h5>
					</div>
					
					<div class="info-item mt-4">
						<span class="subtitle">Sosyal Medya</span>
						<div class="socials mt-2">
							<a href="{{ $siteSetting->instagram ?? '#' }}" class="me-3">Instagram</a>
							<a href="{{ $siteSetting->linkedin ?? '#' }}" class="me-3">LinkedIn</a>
							<a href="{{ $siteSetting->twitter ?? '#' }}">Twitter</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-12 col-md-6 mt-5 mt-md-0">
				<div class="contact-form">
					<h3 class="title">Mesaj Gönderin</h3>
					<form action="#" method="POST" class="mt-4">
						@csrf
						<div class="form-group mb-4">
							<input type="text" name="name" class="form-control" placeholder="Adınız Soyadınız" required>
						</div>
						<div class="form-group mb-4">
							<input type="email" name="email" class="form-control" placeholder="E-posta Adresiniz" required>
						</div>
						<div class="form-group mb-4">
							<select name="subject" class="form-control" required>
								<option value="">Konu Seçiniz</option>
								<option value="Sponsorluk/İşbirliği">Sponsorluk/İşbirliği</option>
								<option value="Proje Geliştirme">Proje Geliştirme</option>
								<option value="Genel Soru">Genel Soru</option>
							</select>
						</div>
						<div class="form-group mb-4">
							<textarea name="message" class="form-control" rows="5" placeholder="Mesajınız" required></textarea>
						</div>
						<button type="submit" class="btn magnetic-button">Gönder <i class="icon bi bi-arrow-right ms-1"></i><span></span></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- ***** Contact Area End ***** -->
@endsection
