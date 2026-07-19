<header id="header">
	<nav class="navbar navbar-expand">
		<div class="container header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: nowrap;">
			<div class="magnetic" style="flex-shrink: 0;">
				<a class="navbar-brand" href="{{ url('/') }}" style="display: flex; align-items: center; padding: 0;">
					<img src="{{ asset('images/logo.png') }}" alt="SCR İçerik Üreticisi Logo" style="height: auto; width: 380px; max-height: 150px; object-fit: contain;">
				</a>
			</div>
			<div class="ms-auto"></div>

			<!-- Navbar Nav -->
			<ul class="navbar-nav items d-none d-md-block">
				<li class="nav-item">
					<a href="{{ url('/') }}" class="nav-link active">Ana Sayfa</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('/icerikler') }}" class="nav-link">İçerikler</a>
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
