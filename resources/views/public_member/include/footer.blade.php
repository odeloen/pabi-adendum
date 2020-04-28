<footer id="footer-1" class="bg-image wide-40 footer division">
	<div class="container">


		<!-- FOOTER CONTENT -->
		<div class="row">	


			<!-- FOOTER INFO -->
			<div class="col-md-6 col-lg-6">
				<div class="footer-info mb-40">

					<!-- Footer Logo -->
					<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 360 x 80  pixels) -->
					<img src="{{ asset('assets_member/images/logo.png') }}" width="180" height="40" alt="footer-logo">

					<!-- Text -->	
					<p class="p-sm mt-20">
						{{ $data_dashboard->deskripsi }}
					</p>  

					<!-- Social Icons -->
					<div class="footer-socials-links mt-20">
						<ul class="foo-socials text-center clearfix">

							<li><a href="#" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" class="ico-twitter"><i class="fab fa-twitter"></i></a></li>	
							<li><a href="#" class="ico-google-plus"><i class="fab fa-google-plus-g"></i></a></li> 

								<!--
								<li><a href="#" class="ico-behance"><i class="fab fa-behance"></i></a></li>	
								<li><a href="#" class="ico-dribbble"><i class="fab fa-dribbble"></i></a></li>											
								<li><a href="#" class="ico-instagram"><i class="fab fa-instagram"></i></a></li>	
								<li><a href="#" class="ico-linkedin"><i class="fab fa-linkedin-in"></i></a></li>
								<li><a href="#" class="ico-pinterest"><i class="fab fa-pinterest-p"></i></a></li>									
								<li><a href="#" class="ico-youtube"><i class="fab fa-youtube"></i></a></li>											
								<li><a href="#" class="ico-vk"><i class="fab fa-vk"></i></a></li>
								<li><a href="#" class="ico-yelp"><i class="fab fa-yelp"></i></a></li>
								<li><a href="#" class="ico-yahoo"><i class="fab fa-yahoo"></i></a></li>
							-->	

						</ul>									
					</div>	
					
				</div>		
			</div>


			<!-- FOOTER CONTACTS -->
			<div class="col-md-6 col-lg-6">
				<div class="footer-box mb-40">
					
					<!-- Title -->
					<h5 class="h5-xs">Lokasi Kami</h5>

					<!-- Address -->
					<p>{{ $data_dashboard->alamat }}, {{ $data_dashboard->kota }}</p>

					<!-- Email -->
					<p class="foo-email mt-20">E: <a href="mailto:{{ $data_dashboard->email }}">{{ $data_dashboard->email }}</a></p>

					<!-- Phone -->
					<p>P: {{ $data_dashboard->no_telp }}</p>

				</div>
			</div> 


		</div>	  
		<!-- END FOOTER CONTENT -->


		<!-- FOOTER COPYRIGHT -->
		<div class="bottom-footer">
			<div class="row">
				<div class="col-md-12">
					<p class="footer-copyright">
						&copy; 2019. <a href="#" class="navbar-link" style="color: white">PABI - Membership</a> by <a href="https://kodig.id/" class="navbar-link" target="_blank" style="color: white">Rumah Sinergi Karya</a>
					</p>
				</div>
			</div>
		</div>


	</div>	   <!-- End container -->										
</footer>	<!-- END FOOTER-1 -->