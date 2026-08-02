<div class="offcanvas-wrapper">
	<!-- Navbar Toggler -->
	<div class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
		<div class="navbar-header">
			<div class="content">
				<div class="toggler-icon"></div>
				<span class="title">Menü</span>
			</div>
		</div>
	</div>

	<!-- Offcanvas -->
	<div class="offcanvas offcanvas-end" id="offcanvasRight">
		<div class="fixed-nav-rounded-div">
			<div class="rounded-div-wrap">
				<div class="rounded-div"></div>
			</div>
		</div>

		<!-- Offcanvas Content -->
		<div class="offcanvas-content">
			<div class="offcanvas-navigation">
				<div class="offcanvas-header">
					<h5 class="offcanvas-title mt-0">Navigasyon</h5>
				</div>
				<hr>
				<!-- Navigation Menu -->
				<div class="offcanvas-body">
					<ul class="navbar-nav menu pt-md-4">
						<li class="nav-item">
							<a href="{{ url('/') }}" class="nav-link active">Ana Sayfa <span class="item-count">(01)</span></a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/icerikler') }}" class="nav-link">Yazılar <span class="item-count">(02)</span></a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/projelerim') }}" class="nav-link">Projelerim <span class="item-count">(03)</span></a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/hakkimda') }}" class="nav-link">Hakkımda <span class="item-count">(04)</span></a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/iletisim') }}" class="nav-link">İletişim <span class="item-count">(05)</span></a>
						</li>
						@auth
							<li class="nav-item">
								<a href="{{ route('profile.index') }}?tab=yazilar" class="nav-link" style="color: #10b981;">Yazılarım</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('profile.index') }}?tab=yorumlar" class="nav-link" style="color: #10b981;">Yorumlarım</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('profile.index') }}?tab=profil" class="nav-link" style="color: #10b981;">Profilim</a>
							</li>
							<li class="nav-item mt-3">
								<form action="{{ route('logout') }}" method="POST">
									@csrf
									<button type="submit" class="btn w-100 py-2 text-white d-flex align-items-center justify-content-center gap-2" style="background: #661414; border-radius: 50px; font-size: 0.9rem; font-weight: 600; border: none;">
										<i class="bi bi-box-arrow-right"></i> Çıkış Yap
									</button>
								</form>
							</li>
						@else
							<li class="nav-item">
								<a href="{{ route('login') }}" class="nav-link" style="color: #f59e0b;">Giriş / Kayıt</a>
							</li>
						@endauth
					</ul>
				</div>
			</div>

			<!-- Offcanvas Social -->
			<div class="offcanvas-social">
				<div class="offcanvas-header">
					<h5 class="offcanvas-title mt-0">Sosyal Medya</h5>
				</div>
				<hr>
				<div class="socials offcanvas-body">
					<nav class="nav">
						<a class="nav-link swap-icon" href="https://www.instagram.com/sinancanreis.dg/" target="_blank">Instagram <i class="icon rotate bi bi-arrow-right-short"></i></a>
						<a class="nav-link swap-icon" href="https://www.linkedin.com/in/sinan-can-reis-157658329" target="_blank">Linkedin <i class="icon rotate bi bi-arrow-right-short"></i></a>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
