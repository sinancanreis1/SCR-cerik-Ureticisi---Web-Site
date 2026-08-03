<header id="header">
	<nav class="navbar navbar-expand">
		<div class="container header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: nowrap;">
			<div class="magnetic" style="flex-shrink: 0;">
				<a class="navbar-brand" href="{{ url('/') }}" style="display: flex; align-items: center; padding: 0;">
					<img src="{{ asset('images/logo.png') }}" alt="SCR İçerik Üreticisi Logo" style="height: auto; width: 190px; max-height: 75px; object-fit: contain;">
				</a>
			</div>
			<div class="ms-auto"></div>

			<!-- Navbar Nav -->
			<ul class="navbar-nav items d-none d-md-flex align-items-center">
				<li class="nav-item">
					<a href="{{ url('/') }}" class="nav-link active">Ana Sayfa</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('/icerikler') }}" class="nav-link">Yazılar</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('/projelerim') }}" class="nav-link">Projelerim</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('/hakkimda') }}" class="nav-link">Hakkımda</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('/iletisim') }}" class="nav-link">İletişim</a>
				</li>
				@auth
					<li class="nav-item dropdown ms-3 d-flex align-items-center">
						<a class="btn btn-outline content-btn dropdown-toggle" href="{{ route('profile.index') }}" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 10px 20px;">
							Profilim
						</a>
						<ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2" aria-labelledby="profileDropdown" style="min-width: 220px; padding: 15px 10px; background: #ffffff; border: 1px solid #e5e7eb !important;">
							<li>
								<a class="dropdown-item py-2 px-3 fw-semibold rounded-3 d-flex align-items-center gap-2" href="{{ route('profile.index') }}?tab=yazilar" style="color: #374151; font-size: 0.95rem; transition: all 0.2s;">
									<i class="bi bi-file-earmark-text" style="color: #661414; font-size: 1.1rem;"></i> Yazılarım
								</a>
							</li>
							<li>
								<a class="dropdown-item py-2 px-3 fw-semibold rounded-3 d-flex align-items-center gap-2" href="{{ route('profile.index') }}?tab=yorumlar" style="color: #374151; font-size: 0.95rem; transition: all 0.2s;">
									<i class="bi bi-chat-left-text" style="color: #661414; font-size: 1.1rem;"></i> Yorumlarım
								</a>
							</li>
							<li>
								<a class="dropdown-item py-2 px-3 fw-semibold rounded-3 d-flex align-items-center gap-2" href="{{ route('profile.index') }}?tab=profil" style="color: #374151; font-size: 0.95rem; transition: all 0.2s;">
									<i class="bi bi-person-gear" style="color: #661414; font-size: 1.1rem;"></i> Profilim
								</a>
							</li>
							<li><hr class="dropdown-divider my-2" style="border-color: #e5e7eb;"></li>
							<li class="px-2 pt-1">
								<form action="{{ route('logout') }}" method="POST" class="w-100">
									@csrf
									<button type="submit" class="btn w-100 py-2 text-white d-flex align-items-center justify-content-center gap-2" style="background: #661414; border-radius: 50px; font-size: 0.9rem; font-weight: 600; border: none;">
										<i class="bi bi-box-arrow-right"></i> Çıkış Yap
									</button>
								</form>
							</li>
						</ul>
					</li>
				@else
					<li class="nav-item d-flex align-items-center">
						<a href="{{ route('login') }}" class="btn btn-outline content-btn ms-3" style="padding: 10px 20px;">Giriş / Kayıt</a>
					</li>
				@endauth

				<style>
					@media (min-width: 768px) {
						.dropdown {
							position: relative;
						}
						.dropdown:hover .dropdown-menu {
							display: block;
							margin-top: 0 !important;
						}
						/* Mouse geçiş köprüsü: dropdown menüye geçerken kapanmasını önler */
						.dropdown::after {
							content: '';
							position: absolute;
							bottom: -20px;
							left: 0;
							width: 100%;
							height: 20px;
							display: block;
							z-index: 1;
						}
					}
					.dropdown-item:hover {
						background-color: #fef2f2 !important;
						color: #661414 !important;
					}
				</style>
			</ul>

			<!-- Navbar Toggler -->
			<div class="navbar-toggler scrolled" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
				<div class="navbar-header">
					<div class="content">
						<div class="toggler-icon"></div>
						<span class="title">Menü</span>
					</div>
				</div>
			</div>

		</div>
	</nav>
	<div id="navbar-main" class="main"></div>
</header>
