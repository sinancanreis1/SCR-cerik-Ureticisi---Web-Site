<header id="header">
	<nav class="navbar navbar-expand">
		<div class="container header">
			<div class="magnetic">
				<a class="navbar-brand" href="{{ url('/') }}" style="display: flex; align-items: center; padding: 0;">
					<img src="{{ asset('images/logo.png') }}" alt="SCR İçerik Üreticisi Logo" style="height: auto; width: 140px; max-width: 100%;">
				</a>
			</div>
			<div class="ms-auto"></div>

			<!-- Navbar Nav -->
			<ul class="navbar-nav items d-none d-md-block">
				@if(isset($headerLinks))
					@foreach($headerLinks as $link)
					<li class="nav-item">
						<a href="{{ url($link->url) }}" class="nav-link {{ request()->is(ltrim($link->url, '/')) ? 'active' : '' }}">
							@if($link->icon) <i class="{{ $link->icon }}"></i> @endif
							{{ $link->label }}
						</a>
					</li>
					@endforeach
				@endif
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
