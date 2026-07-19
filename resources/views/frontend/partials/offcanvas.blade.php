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
						@if(isset($headerLinks))
							@foreach($headerLinks as $index => $link)
							<li class="nav-item">
								<a href="{{ url($link->url) }}" class="nav-link {{ request()->is(ltrim($link->url, '/')) ? 'active' : '' }}">
									@if($link->icon) <i class="{{ $link->icon }}"></i> @endif
									{{ $link->label }} <span class="item-count">(0{{ $index + 1 }})</span>
								</a>
							</li>
							@endforeach
						@endif
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
