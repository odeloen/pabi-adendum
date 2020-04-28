<header id="header" class="header">
	<!-- MOBILE HEADER -->
	<div class="wsmobileheader clearfix">
		<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
		<span class="smllogo"><img src="{{ asset('assets_member/images/logo.png') }}"  height="40" alt="mobile-logo"/></span>
		<a href="tel:123456789" class="callusbtn"><i class="fas fa-phone"></i></a>
	</div>
	<!-- HEADER STRIP -->
	<div class="headtoppart bg-blue clearfix">
		<div class="headerwp clearfix">
			<!-- Address -->
			<div class="headertopleft">			     			
				<div class="address clearfix">
					<span><i class="fas fa-map-marker-alt"></i>{{ $data_dashboard->alamat }}, {{ $data_dashboard->kota }} 
					</span> <a href="tel:123456789" class="callusbtn"><i class="fas fa-phone"></i>{{ $data_dashboard->no_telp }}</a>
				</div>
			</div>
			<!-- Social Links -->
			<div class="headertopright">
				<!-- <a class="googleicon" title="Google" href="#"><i class="fab fa-google"></i> <span class="mobiletext02">Google</span></a>
				<a class="linkedinicon" title="Linkedin" href="#"><i class="fab fa-linkedin-in"></i> <span class="mobiletext02">Linkedin</span></a> -->
				<a class="instagramicon" title="Instagram" href="{{ $data_dashboard->instagram }}" target="_blank"><i class="fab fa-instagram"></i> <span class="mobiletext02">Instagram</span></a>
				<a class="facebookicon" title="Facebook" href="{{ $data_dashboard->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i> <span class="mobiletext02">Facebook</span></a>
			</div>

		</div>
	</div>	
	<!-- END HEADER STRIP -->


	<!-- NAVIGATION MENU -->
	<div class="wsmainfull menu clearfix">
		<div class="wsmainwp clearfix">

			<!-- LOGO IMAGE -->
			<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 360 x 80 pixels) -->
			<div class="desktoplogo"><a href="{{ url('/') }}"><img src="{{ asset('assets_member/images/logo.png') }}"  width="180" height="40" alt="header-logo"></a></div>

			<!-- MAIN MENU -->
			<nav class="wsmenu clearfix">
				<ul class="wsmenu-list">

 
					<li aria-haspopup="true">
						<a href="{{ url('/') }}">
							Beranda
						</a> 
					</li> 
					<li class="nl-simple" aria-haspopup="true">
						<a href="{{ url('/berita-acara') }}">
							Berita & Acara
						</a>
					</li>
					<li class="nl-simple" aria-haspopup="true">
						<a href="{{ url('/list_dokter') }}">
							Dokter Bedah
						</a>
					</li>
					<li class="nl-simple" aria-haspopup="true">
						<a href="{{route('general.article.list')}}">
							Artikel Kesehatan
						</a>
					</li>
					<li class="nl-simple" aria-haspopup="true">
						<a href="{{ url('/tentang-pabi') }}">
							Tentang PABI
						</a>
					</li>

					<!-- NAVIGATION MENU BUTTON -->
					<li class="nl-simple header-btn" aria-haspopup="true"><a href="{{ url('/login') }}">Log In</a></li>


				</ul>
			</nav>	<!-- END MAIN MENU -->

		</div>
	</div>
</header>	<!-- END HEADER -->