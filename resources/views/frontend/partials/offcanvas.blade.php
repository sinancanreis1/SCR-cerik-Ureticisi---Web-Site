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
							<a href="{{ url('/icerikler') }}" class="nav-link">İçerikler <span class="item-count">(02)</span></a>
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
						<a class="nav-link swap-icon" href="{{ $siteSetting->instagram ?? '#' }}">Instagram <i class="icon rotate bi bi-arrow-right-short"></i></a>
						<a class="nav-link swap-icon" href="{{ $siteSetting->linkedin ?? '#' }}">Linkedin <i class="icon rotate bi bi-arrow-right-short"></i></a>
						<a class="nav-link swap-icon" href="{{ $siteSetting->twitter ?? '#' }}">Twitter <i class="icon rotate bi bi-arrow-right-short"></i></a>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
