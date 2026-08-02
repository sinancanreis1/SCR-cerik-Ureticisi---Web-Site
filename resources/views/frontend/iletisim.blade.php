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
							<a href="https://www.instagram.com/sinancanreis.dg/" target="_blank" class="me-3">Instagram</a>
							<a href="https://www.linkedin.com/in/sinan-can-reis-157658329" target="_blank" class="me-3">LinkedIn</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-12 col-md-6 mt-5 mt-md-0">
				<div class="contact-form">
					<h3 class="title">Mesaj Gönderin</h3>
					@if(request()->has('success'))
						<div class="alert alert-success mt-3" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: 15px; border-radius: 5px;">Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağım.</div>
					@endif
					<form action="https://api.web3forms.com/submit" method="POST" class="mt-4">
						<input type="hidden" name="access_key" value="35b84175-4815-492d-a429-601ea978844a">
						<input type="hidden" name="redirect" value="{{ url()->current() }}?success=true">
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
