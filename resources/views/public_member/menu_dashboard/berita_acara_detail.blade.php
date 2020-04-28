@extends('public_member.index')
@section('public_tempat_content')


<!-- PAGE CONTENT
============================================= -->
<div> 


	<!-- BREADCRUMB
	============================================= -->
	<div id="breadcrumb" class="division">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class=" breadcrumb-holder">

						<!-- Breadcrumb Nav -->
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
								<li class="breadcrumb-item active" aria-current="page">
								Detail Berita & Acara</li>
							</ol>
						</nav>

						<!-- Title -->
						<h4 class="h4-sm steelblue-color">Detail Berita & Acara</h4>

					</div>
				</div>
			</div>  <!-- End row -->
		</div>    <!-- End container -->
	</div>    <!-- END BREADCRUMB -->


	<!-- INFO-4
	============================================= -->
	<section id="info-4" class="wide-100 info-section division">
		<div class="container">  
			<!-- TOP ROW -->
			<div class="top-row mb-80">
				<div class="row d-flex align-items-center">


					<!-- INFO IMAGE -->
					<div class="col-lg-12">
						<div class="info-4-img text-center wow fadeInUp" data-wow-delay="0.6s">
							<!-- Title -->
							<h3 class="h3-md steelblue-color">
								{{ $data_berita['judul'] }}
							</h3>
							<br>
							<img class="img-fluid" src="{{env('URL_API_IP')}}{{$data_berita['image_berita']}}" alt="info-image">
						</div>
					</div>


					<!-- INFO TEXT -->
					<div class="col-lg-12">
						<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

							<!-- Section ID -->
							<span class="section-id blue-color">&nbsp;</span>


							<!-- Text -->
							<p>
								<?php  
								echo $data_berita['isi'] ;  
								?> 
							</p>  

						</div>
					</div>    <!-- END TEXT BLOCK -->


				</div>    <!-- End row -->
			</div>    <!-- END TOP ROW -->  

		</div>       <!-- End container -->
	</section>    <!-- END INFO-4 -->


	<!-- STATISTIC-1
	============================================= -->
	<div id="statistic-1" class="bg-scroll statistic-section division">
		<div class="container white-color">
			<div class="row"> 


				<!-- STATISTIC BLOCK #2 -->
				<div class="col-md-6 col-lg-6">
					<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="0.6s">

						<!-- Icon  -->
						<span class="flaticon-137-doctor"></span>

						<!-- Text -->
						<h5 class="statistic-number"> 
							<span class="">
								<?= $data_dashboard->jml_dokter; ?>
							</span>
						</h5>
						<p class="txt-400">Dokter Bedah</p>

					</div>
				</div> 


				<!-- STATISTIC BLOCK #4 -->
				<div class="col-md-6 col-lg-6">
					<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="1s">

						<!-- Icon  -->
						<span class="flaticon-040-placeholder"></span>

						<!-- Text -->
						<h5 class="statistic-number">
							<span class=" ">
								<?= $data_dashboard->jml_kota; ?> 
							</span>
						</h5>
						<p class="txt-400">Cabang</p>

					</div>
				</div>


			</div>  <!-- End row -->
		</div>     <!-- End container -->
	</div>     <!-- END STATISTIC-1 --> 


	<!-- SERVICES-7
	============================================= -->
	<section style="display: none" id="services-7" class="bg-lightgrey wide-70 servicess-section division">
		<div class="container">
			<div class="row">


				<!-- SERVICE BOXES -->
				<div class="col-lg-12">
					<div class="row">


						<!-- SERVICE BOX #1 -->
						<div class="col-md-4">
							<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s">
								<a href="service-1.html">

									<!-- Icon -->
									<span class="flaticon-137-doctor blue-color"></span>

									<!-- Text -->
									<div class="sbox-7-txt">

										<!-- Title -->
										<h5 class="h5-sm steelblue-color">Top Level Doctors</h5>

										<!-- Text -->
										<p class="p-sm">Porta semper lacus at cursus primis ultrice in ligula risus an
											auctor tempus feugiat dolor
										</p>

									</div>

								</a>
							</div>
						</div>  <!-- END SERVICE BOX #1 -->


						<!-- SERVICE BOX #2 -->
						<div class="col-md-4">
							<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.6s">
								<a href="service-2.html">

									<!-- Icon -->
									<span class="flaticon-076-microscope blue-color"></span>

									<!-- Text -->
									<div class="sbox-7-txt">

										<!-- Title -->
										<h5 class="h5-sm steelblue-color">Modern Equipment</h5>

										<!-- Text -->
										<p class="p-sm">Porta semper lacus at cursus primis ultrice in ligula risus an
											auctor tempus feugiat dolor
										</p>

									</div>

								</a>
							</div>
						</div>  <!-- END SERVICE BOX #2 -->


						<!-- SERVICE BOX #3 -->
						<div class="col-md-4">
							<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.8s">
								<a href="service-1.html">

									<!-- Icon -->
									<span class="flaticon-065-hospital-bed blue-color"></span>

									<!-- Text -->
									<div class="sbox-7-txt">

										<!-- Title -->
										<h5 class="h5-sm steelblue-color">Qualified Facilities</h5>

										<!-- Text -->
										<p class="p-sm">Porta semper lacus at cursus primis ultrice in ligula risus an
											auctor tempus feugiat dolor
										</p>

									</div>

								</a>
							</div>
						</div>  <!-- END SERVICE BOX #3-->


						<!-- SERVICE BOX #4 -->
						<div class="col-md-4">
							<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="1s">
								<a href="service-2.html">

									<!-- Icon -->
									<span class="flaticon-058-blood-transfusion-2 blue-color"></span>

									<!-- Text -->
									<div class="sbox-7-txt">

										<!-- Title -->
										<h5 class="h5-sm steelblue-color">Professional Services</h5>

										<!-- Text -->
										<p class="p-sm">Porta semper lacus at cursus primis ultrice in ligula risus an
											auctor tempus feugiat dolor
										</p>

									</div>

								</a>
							</div>
						</div>  <!-- END SERVICE BOX #4 -->


						<!-- SERVICE BOX #5 -->
						<div class="col-md-4">
							<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="1.2s">
								<a href="service-1.html">

									<!-- Icon -->
									<span class="flaticon-141-clinic-history blue-color"></span>

									<!-- Text -->
									<div class="sbox-7-txt">

										<!-- Title -->
										<h5 class="h5-sm steelblue-color">Medical Counseling</h5>

										<!-- Text -->
										<p class="p-sm">Porta semper lacus at cursus primis ultrice in ligula risus an
											auctor tempus feugiat dolor
										</p>

									</div>

								</a>
							</div>
						</div>  <!-- END SERVICE BOX #5 -->


						<!-- SERVICE BOX #6 -->
						<div class="col-md-4">
							<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="1.4s">
								<a href="service-2.html">

									<!-- Icon -->
									<span class="flaticon-008-ambulance-6 blue-color"></span>

									<!-- Text -->
									<div class="sbox-7-txt">

										<!-- Title -->
										<h5 class="h5-sm steelblue-color">Emergency Help</h5>

										<!-- Text -->
										<p class="p-sm">Porta semper lacus at cursus primis ultrice in ligula risus an
											auctor tempus feugiat dolor
										</p>

									</div>

								</a>
							</div>
						</div>  <!-- END SERVICE BOX #6 -->


					</div>
				</div>    <!-- END SERVICE BOXES --> 


			</div>    <!-- End row -->
		</div>       <!-- End container -->
	</section>    <!-- END SERVICES-7 --> 

</div>    <!-- END PAGE CONTENT -->
@endsection