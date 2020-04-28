@extends('public_member.index')
@section('public_tempat_content')

<!-- HERO-2
============================================= -->	
<section id="hero-2" class="hero-section division">


	<!-- SLIDER -->
	<div class="slider blue-nav">
    	<ul class="slides"> 
			<?php 
			$no = 0;
			foreach ($data_banner as $r) 
			{
				$no++;
				if($r['posisi_isi'] == 1){
				?>
		     	<!-- SLIDE #{{$no}} -->
		      	<li id="slide-{{$no}}" class="slide_kiri"> 
			        <!-- Background Image -->
		        	<img src="{{env('URL_API_IP')}}{{$r['image_banner']}}" alt="slide-background">

					<!-- Image Caption -->
	   				<div class="caption d-flex align-items-center left-align">
	   					<div class="container">
	   						<div class="row">
	   							<div class="col-md-9 col-lg-7">
	   								<div class="caption-txt"> 
				       					<!-- Title -->
				       					<h2 class="steelblue-color">
				       						<?php echo $r['judul'] ?>
				       					</h2> 
				       					<!-- Option Box #1 --> 
										<div class="box-list mb-15">	
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-md">
												<?php echo $r['isi'] ?>
											</p>		
										</div>  
									</div>
								</div>
							</div>  <!-- End row -->
						</div>  <!-- End container -->
			        </div>	<!-- End Image Caption --> 
			    </li>	
			    <!-- END SLIDE #{{$no}} -->
			    <?php 
				}
				else {
				?>
		      	<!-- SLIDE #{{$no}} -->
		      	<li id="slide-{{$no}}" class="slide_kanan">

		        	<!-- Background Image -->
		        	<img src="{{env('URL_API_IP')}}{{$r['image_banner']}}" alt="slide-background">

					<!-- Image Caption -->
					<div class="caption d-flex align-items-center right-align">
						<div class="container">
	   						<div class="row">
	   							<div class="col-md-9 col-lg-7 offset-md-3 offset-lg-5">
	   								<div class="caption-txt">

			        					<!-- Title -->
						         	 	<h2 class="steelblue-color">
				       						<?php echo $r['judul'] ?>
						         	 	</h2>
							          	
							          	<!-- Text -->
										<p class="p-md">
											<div class="box-list-icon">&nbsp;</div> 
											<p class="p-md"><?php echo $r['isi'] ?></p> 
										</p>  
									</div>	
		         				</div>
							</div>  <!-- End row -->
						</div>  <!-- End container -->
			        </div>	<!-- End Image Caption --> 
		     	</li>	
		     	<!-- END SLIDE #{{$no}} -->
				<?php } ?> 
			<?php } ?> 

	    </ul>
  	</div>	<!-- END SLIDER -->


</section>	<!-- END HERO-2 -->
 

<section id="about-5" class="pt-100 about-section division">
	<div class="container">
		<div class="row d-flex align-items-center">


			<!-- IMAGE BLOCK -->
			<div class="col-lg-6">
				<div class="about-img text-center wow fadeInUp" data-wow-delay="0.6s">
					<img class="img-fluid" src="{{ asset('assets_member/images/image-03.png') }}" alt="about-image">
				</div>
			</div>


			<!-- TEXT BLOCK -->	
			<div class="col-lg-6">
				<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

					<!-- Section ID -->	
					<span class="section-id blue-color">Welcome to MedService</span>

					<!-- Title -->
					<h3 class="h3-md steelblue-color">Complete Medical Solutions in One Place</h3>

					<!-- Text -->
					<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat
						dolor lacinia cubilia curae integer congue leo metus, eu mollislorem primis in orci integer
						metus mollis faucibus. An enim nullam tempor sapien gravida donec pretium and ipsum porta
						justo integer at velna vitae auctor integer congue
					</p>

					<!-- Singnature -->
					<div class="singnature mt-35">

						<!-- Text -->
						<p class="p-small mb-15">Randon Pexon, Head of Clinic</p>

						<!-- Singnature Image -->
						<!-- Recommended sizes for Retina Ready displays is 400x68px; -->
						<img class="img-fluid" src="{{ asset('assets_member/images/signature.png') }}" width="200" height="34" alt="signature-image" />	

					</div>

				</div>
			</div>	<!-- END TEXT BLOCK -->	


		</div>    <!-- End row -->
	</div>	   <!-- End container -->
</section>	<!-- END ABOUT-5 -->

<section id="services-2" class="bg-lightgrey wide-70 services-section division">
	<div class="container">


		<!-- SECTION TITLE -->	
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">		

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">Choose Department</h3>	

				<!-- Text -->
				<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
					blandit posuere ligula varius congue cursus porta feugiat
				</p>

			</div> 
		</div>


		<div class="row">


			<!-- SERVICE BOX #1 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="0.4s">
					<a href="department-single.html">	

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-083-stethoscope"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">Pediatrics</h5>

					</a>
				</div>							
			</div>


			<!-- SERVICE BOX #2 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="0.6s">
					<a href="department-single.html">	

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-047-head"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">Neurology</h5>

					</a>
				</div>							
			</div>


			<!-- SERVICE BOX #3 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="0.8s">
					<a href="department-single.html">	

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-015-blood-donation-1"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">Haematology</h5>

					</a>
				</div>							
			</div>


			<!-- SERVICE BOX #4 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="1s">
					<a href="department-single.html">	

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-048-lungs"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">X-Ray Diagnostic</h5>

					</a>
				</div>							
			</div>


			<!-- SERVICE BOX #5 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="0.4s">
					<a href="department-single.html">	

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-060-cardiogram-4"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">Cardiology</h5>

					</a>
				</div>							
			</div>


			<!-- SERVICE BOX #6 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="0.6s">
					<a href="department-single.html">	

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-031-scanner"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">MRI</h5>

					</a>
				</div>							
			</div>


			<!-- SERVICE BOX #7 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="0.8s">
					<a href="department-single.html">	

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-076-microscope"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">Laboratory Services</h5>

					</a>
				</div>							
			</div>


			<!-- SERVICE BOX #8 -->
			<div class="col-sm-6 col-lg-3">
				<div class="sbox-2 wow fadeInUp" data-wow-delay="1s">
					<a href="department-single.html">		

						<!-- Icon  -->
						<div class="sbox-2-icon icon-xl">
							<span class="flaticon-068-ambulance-3"></span>
						</div>

						<!-- Title -->
						<h5 class="h5-sm sbox-2-title steelblue-color">Emergency Help</h5>

					</a>
				</div>							
			</div>


		</div>	   <!-- End row -->		


	</div>	   <!-- End container -->		
</section>	<!-- END SERVICES-2 -->

<section id="tabs-1" class="wide-100 tabs-section division">
	<div class="container">	
		<div class="row">
			<div class="col-md-12">


				<!-- TABS NAVIGATION -->
				<div id="tabs-nav" class="list-group text-center">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">

						<!-- TAB-1 LINK -->
						<li class="nav-item icon-xs">
							<a class="nav-link active" id="tab1-list" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">
								<span class="flaticon-083-stethoscope"></span> Pediatrics
							</a>
						</li>

						<!-- TAB-2 LINK -->
						<li class="nav-item icon-xs">
							<a class="nav-link" id="tab2-list" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">
								<span class="flaticon-005-blood-donation-3"></span> Hematology
							</a>
						</li>

						<!-- TAB-3 LINK -->
						<li class="nav-item icon-xs">
							<a class="nav-link" id="tab3-list" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">
								<span class="flaticon-031-scanner"></span> MRI
							</a>
						</li>

						<!-- TAB-4 LINK -->
						<li class="nav-item icon-xs">
							<a class="nav-link" id="tab4-list" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">
								<span class="flaticon-048-lungs"></span> X-Ray Diagnostics
							</a>
						</li>

					</ul>

				</div>	<!-- END TABS NAVIGATION -->


				<!-- TABS CONTENT -->
				<div class="tab-content" id="pills-tabContent">


					<!-- TAB-1 CONTENT -->
					<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1-list">
						<div class="row d-flex align-items-center">


							<!-- TAB-1 IMAGE -->
							<div class="col-lg-6">
								<div class="tab-img">
									<img class="img-fluid" src="{{ asset('assets_member/images/pediatrics_700x700.jpg') }}" alt="tab-image" />
								</div>
							</div>


							<!-- TAB-1 TEXT -->
							<div class="col-lg-6">
								<div class="txt-block pc-30">

									<!-- Title -->
									<h3 class="h3-md steelblue-color">Pediatrics</h3>

									<!-- Text -->
									<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
										porta justo integer odio velna vitae auctor integer congue magna at pretium 
										purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
										egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
										magna suscipit
									</p>

									<!-- Options List -->
									<div class="row">

										<div class="col-xl-6">

											<!-- Option #1 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
											</div>

											<!-- Option #2 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor</p>				
											</div>

											<!-- Option  #3 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
											</div>

										</div>

										<div class="col-xl-6">

											<!-- Option #4 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
											</div>

											<!-- Option #5 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
											</div>

											<!-- Option #6 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor</p>				
											</div>

										</div>

									</div>	<!-- End Options List -->

									<!-- Button -->
									<a href="service-1.html" class="btn btn-blue blue-hover mt-30">View More Details</a>

								</div>	
							</div>	<!-- END TAB-1 TEXT -->


						</div>
					</div>	<!-- END TAB-1 CONTENT -->


					<!-- TAB-2 CONTENT -->
					<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2-list">
						<div class="row d-flex align-items-center">


							<!-- TAB-2 IMAGE -->
							<div class="col-lg-6">
								<div class="tab-imgs">
									<img class="img-fluid" src="{{ asset('assets_member/images/hematology_700x700.jpg') }}" alt="tab-image" />
								</div>
							</div>


							<!-- TAB-2 TEXT -->
							<div class="col-lg-6">
								<div class="txt-block pc-30">

									<!-- Title -->
									<h3 class="h3-md steelblue-color">Hematology</h3>

									<!-- Text -->
									<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
										porta justo integer odio velna vitae auctor integer congue magna at pretium 
										purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
										egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
										magna suscipit
									</p>

									<!-- Options List -->
									<div class="row">

										<div class="col-xl-6">

											<!-- Option #1 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
											</div>

											<!-- Option #2 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor</p>				
											</div>

											<!-- Option #3 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
											</div>

										</div>

										<div class="col-xl-6">

											<!-- Option #4 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
											</div>

											<!-- Option #5 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
											</div>

											<!-- Option #6 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor</p>				
											</div>

										</div>

									</div>	<!-- End Options List -->

									<!-- Button -->
									<a href="service-2.html" class="btn btn-blue blue-hover mt-30">View More Details</a>

								</div>	
							</div>	<!-- END TAB-2 TEXT -->


						</div>
					</div>	<!-- END TAB-2 CONTENT -->


					<!-- TAB-3 CONTENT -->
					<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab3-list">
						<div class="row d-flex align-items-center">


							<!-- TAB-3 IMAGE -->
							<div class="col-lg-6">
								<div class="tab-img">
									<img class="img-fluid" src="{{ asset('assets_member/images/mri_700x700.jpg') }}" alt="tab-image" />
								</div>
							</div>


							<!-- TAB-3 TEXT -->
							<div class="col-lg-6">
								<div class="txt-block pc-30">

									<!-- Title -->
									<h3 class="h3-md steelblue-color">MRI Diagnostic</h3>

									<!-- Text -->
									<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
										porta justo integer odio velna vitae auctor integer congue magna at pretium 
										purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
										egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
										magna suscipit
									</p>

									<!-- Options List -->
									<div class="row">

										<div class="col-xl-6">

											<!-- Option #1 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
											</div>

											<!-- Option #2 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor</p>				
											</div>

											<!-- Option #3 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
											</div>

										</div>

										<div class="col-xl-6">

											<!-- Option #4 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
											</div>

											<!-- Option #5 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
											</div>

											<!-- Option #6 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor</p>				
											</div>

										</div>

									</div>	<!-- End Options List -->

									<!-- Button -->
									<a href="service-1.html" class="btn btn-blue blue-hover mt-30">View More Details</a>

								</div>	
							</div>	<!-- END TAB-3 TEXT -->


						</div>
					</div>	<!-- END TAB-3 CONTENT -->


					<!-- TAB-4 CONTENT -->
					<div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab4-list">
						<div class="row d-flex align-items-center">


							<!-- TAB-4 IMAGE -->
							<div class="col-lg-6">
								<div class="tab-img">
									<img class="img-fluid" src="{{ asset('assets_member/images/x-ray_700x700.jpg') }}" alt="tab-image" />
								</div>
							</div>


							<!-- TAB-4 TEXT -->
							<div class="col-lg-6">
								<div class="txt-block pc-30">

									<!-- Title -->
									<h3 class="h3-md steelblue-color">X-Ray Diagnostic</h3>

									<!-- Text -->
									<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
										porta justo integer odio velna vitae auctor integer congue magna at pretium 
										purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
										egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
										magna suscipit
									</p>

									<!-- Options List -->
									<div class="row">

										<div class="col-xl-6">

											<!-- Option #1 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
											</div>

											<!-- Option #2 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor</p>				
											</div>

											<!-- Option #3 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
											</div>

										</div>

										<div class="col-xl-6">

											<!-- Option #4 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
											</div>

											<!-- Option #5 -->
											<div class="box-list">							
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
											</div>

											<!-- Option #6 -->
											<div class="box-list">	
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">An enim nullam tempor</p>				
											</div>

										</div>

									</div>	<!-- End Options List -->

									<!-- Button -->
									<a href="service-2.html" class="btn btn-blue blue-hover mt-30">View More Details</a>

								</div>	
							</div>	<!-- END TAB-4 TEXT -->


						</div>
					</div>	<!-- END TAB-4 CONTENT -->


				</div>	<!-- END TABS CONTENT -->


			</div>	
		</div>     <!-- End row -->	
	</div>     <!-- End container -->	
</section>	<!-- END TABS-1 -->

<section id="about-6" class="about-section division">
	<div class="container">
		<div class="row d-flex align-items-center">


			<!-- TEXT BLOCK -->	
			<div class="col-lg-6">
				<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

					<!-- Section ID -->	
					<span class="section-id blue-color">Best Practices</span>

					<!-- Title -->
					<h3 class="h3-md steelblue-color">Clinic with Innovative Approach to Treatment</h3>

					<!-- CONTENT BOX #1 -->
					<div class="box-list">							
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p>Nemo ipsam egestas volute turpis dolores ut aliquam quaerat sodales sapien undo pretium
							purus feugiat dolor impedit
						</p>							
					</div>

					<!-- CONTENT BOX #2 -->
					<div class="box-list">	
						<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
						<p>Maecenas gravida porttitor nunc, quis vehicula magna luctus tempor. Quisque vel laoreet
							turpis urna augue, viverra a augue eget, dictum tempor diam pulvinar massa purus nulla
						</p>				
					</div>

					<!-- Button -->
					<a href="all-doctors.html" class="btn btn-blue blue-hover mt-25">Meet The Doctors</a>

				</div>
			</div>	<!-- END TEXT BLOCK -->	


			<!-- IMAGE BLOCK -->
			<div class="col-lg-6">
				<div class="about-img text-center wow fadeInUp" data-wow-delay="0.6s">
					<img class="img-fluid" src="{{ asset('assets_member/images/image-02.png') }}" alt="about-image">
				</div>
			</div>


		</div>    <!-- End row -->
	</div>	   <!-- End container -->
</section>	<!-- END ABOUT-6 -->

<div id="statistic-1" class="bg-scroll statistic-section division">
	<div class="container white-color">
		<div class="row">


			<!-- STATISTIC BLOCK #1 -->
			<div class="col-md-6 col-lg-3">						
				<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="0.4s">

					<!-- Icon  -->
					<span class="flaticon-062-cardiogram-3"></span>

					<!-- Text -->
					<h5 class="statistic-number">9,<span class="count-element">632</span></h5>
					<p class="txt-400">Happy Patients</p>																			

				</div>								
			</div>


			<!-- STATISTIC BLOCK #2 -->
			<div class="col-md-6 col-lg-3">								
				<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="0.6s">

					<!-- Icon  -->
					<span class="flaticon-137-doctor"></span>

					<!-- Text -->
					<h5 class="statistic-number"><span class="count-element">178</span></h5>	
					<p class="txt-400">Qualified Doctors</p>										

				</div>							
			</div>


			<!-- STATISTIC BLOCK #3 -->
			<div class="col-md-6 col-lg-3">					
				<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="0.8s">	

					<!-- Icon  -->
					<span class="flaticon-065-hospital-bed"></span>

					<!-- Text -->
					<h5 class="statistic-number"><span class="count-element">864</span></h5>
					<p class="txt-400">Clinic Rooms</p>									

				</div>						
			</div>


			<!-- STATISTIC BLOCK #4 -->
			<div class="col-md-6 col-lg-3">						
				<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="1s">	

					<!-- Icon  -->
					<span class="flaticon-040-placeholder"></span>

					<!-- Text -->	
					<h5 class="statistic-number"><span class="count-element">473</span></h5>
					<p class="txt-400">Local Partners</p>				

				</div>						
			</div>


		</div>  <!-- End row -->
	</div>	 <!-- End container -->		
</div>	 <!-- END STATISTIC-1 -->

<section id="doctors-1" class="wide-40 doctors-section division">
	<div class="container">


		<!-- SECTION TITLE -->	
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">		

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">Our Medical Specialists</h3>	

				<!-- Text -->
				<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
					blandit posuere ligula varius congue cursus porta feugiat
				</p>

			</div> 
		</div>	 <!-- END SECTION TITLE -->	


		<div class="row">


			<!-- DOCTOR #1 -->
			<div class="col-md-6 col-lg-3">
				<div class="doctor-1">								

					<!-- Doctor Photo -->
					<div class="hover-overlay text-center"> 

						<!-- Photo -->
						<img class="img-fluid" src="{{ asset('assets_member/images/doctor-1.jpg') }}" alt="doctor-foto">	
						<div class="item-overlay"></div>

						<!-- Profile Link -->		
						<div class="profile-link">
							<a class="btn btn-sm btn-tra-white black-hover" href="doctor-1.html" title="">View More Info</a>
						</div> 

					</div>	

					<!-- Doctor Meta -->		
					<div class="doctor-meta">

						<h5 class="h5-sm steelblue-color">Jonathan Barnes D.M.</h5>
						<span class="blue-color">Chief Medical Officer</span>

						<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
							augue luctus magna dolor luctus ipsum neque
						</p>

					</div>	

				</div>								
			</div>	<!-- END DOCTOR #1 -->


			<!-- DOCTOR #2 -->
			<div class="col-md-6 col-lg-3">
				<div class="doctor-1">	

					<!-- Doctor Photo -->
					<div class="hover-overlay text-center"> 

						<!-- Photo -->
						<img class="img-fluid" src="{{ asset('assets_member/images/doctor-2.jpg') }}" alt="doctor-foto">	
						<div class="item-overlay"></div>

						<!-- Profile Link -->		
						<div class="profile-link">
							<a class="btn btn-sm btn-tra-white black-hover" href="doctor-2.html" title="">View More Info</a>
						</div>

					</div>	

					<!-- Doctor Meta -->		
					<div class="doctor-meta">

						<h5 class="h5-sm steelblue-color">Hannah Harper D.M.</h5>
						<span class="blue-color">Anesthesiologist</span>

						<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
							augue luctus magna dolor luctus ipsum neque
						</p>

					</div>	

				</div>					
			</div>	<!-- END DOCTOR #2 -->


			<!-- DOCTOR #3 -->
			<div class="col-md-6 col-lg-3">
				<div class="doctor-1">	

					<!-- Doctor Photo -->
					<div class="hover-overlay text-center"> 

						<!-- Photo -->
						<img class="img-fluid" src="{{ asset('assets_member/images/doctor-3.jpg') }}" alt="doctor-foto">	
						<div class="item-overlay"></div>

						<!-- Profile Link -->		
						<div class="profile-link">
							<a class="btn btn-sm btn-tra-white black-hover" href="doctor-1.html" title="">View More Info</a>
						</div>

					</div>		

					<!-- Doctor Meta -->		
					<div class="doctor-meta">

						<h5 class="h5-sm steelblue-color">Matthew Anderson D.M.</h5>
						<span class="blue-color">Cardiology</span>

						<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
							augue luctus magna dolor luctus ipsum neque
						</p>

					</div>	

				</div>			
			</div>	<!-- END DOCTOR #3 -->


			<!-- DOCTOR #4 -->
			<div class="col-md-6 col-lg-3">
				<div class="doctor-1">	

					<!-- Doctor Photo -->
					<div class="hover-overlay text-center"> 

						<!-- Photo -->
						<img class="img-fluid" src="{{ asset('assets_member/images/doctor-4.jpg') }}" alt="doctor-foto">	
						<div class="item-overlay"></div>

						<!-- Profile Link -->		
						<div class="profile-link">
							<a class="btn btn-sm btn-tra-white black-hover" href="doctor-2.html" title="">View More Info</a>
						</div>

					</div>		

					<!-- Doctor Meta -->		
					<div class="doctor-meta">

						<h5 class="h5-sm steelblue-color">Megan Coleman D.M.</h5>
						<span class="blue-color">Neurosurgeon</span>

						<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
							augue luctus magna dolor luctus ipsum neque
						</p>

					</div>	

				</div>			
			</div>	<!-- END DOCTOR #4 -->


		</div>	    <!-- End row -->


		<!-- ALL DOCTORS BUTTON -->		
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="all-doctors mb-40">
					<a href="all-doctors.html" class="btn btn-blue blue-hover">Meet All Doctors</a>
				</div>
			</div>
		</div>


	</div>	   <!-- End container -->
</section>	<!-- END DOCTORS-1 -->

<section id="reviews-2" class="bg-lightgrey wide-100 reviews-section division">
	<div class="container">


		<!-- SECTION TITLE -->	
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">		

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">What Our Patients Say</h3>	

				<!-- Text -->
				<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
					blandit posuere ligula varius congue cursus porta feugiat
				</p>

			</div> 
		</div>	 <!-- END SECTION TITLE -->


		<!-- TESTIMONIALS CONTENT -->
		<div class="row">
			<div class="col-md-12">					
				<div class="owl-carousel owl-theme reviews-holder">


					<!-- TESTIMONIAL #1 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-1.jpg') }}" alt="testimonial-avatar">
							</div>

							<!-- Testimonial Text -->
							<p>Etiam sapien sem at sagittis congue an augue massa varius egestas a suscipit
								magna undo tempus aliquet porta vitae
							</p>	

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Scott Boxer</h5>	
								<span>Programmer</span>	
							</div>							

						</div>						
					</div>	<!--END  TESTIMONIAL #1 -->


					<!-- TESTIMONIAL #2 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-2.jpg') }}" alt="testimonial-avatar">
							</div>

							<!-- Testimonial Text -->
							<p>Mauris donec ociis magnisa a sapien etiam sapien congue augue egestas et ultrice
								vitae purus diam integer congue magna ligula egestas
							</p>										

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Penelopa Peterson</h5>	
								<span>Project Manager</span>	
							</div>

						</div>						
					</div>	<!-- END TESTIMONIAL #2 -->


					<!-- TESTIMONIAL #3 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-3.jpg') }}" alt="testimonial-avatar">
							</div>

							<!-- Testimonial Text -->
							<p>At sagittis congue augue an egestas magna ipsum vitae purus ipsum primis undo cubilia
								laoreet augue	   
							</p>

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">M.Scanlon</h5>	
								<span>Photographer</span>	
							</div>

						</div>						
					</div>	<!-- END TESTIMONIAL #3 -->


					<!-- TESTIMONIAL #4 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-4.jpg') }}" alt="testimonial-avatar">
							</div>	

							<!-- Testimonial Text -->
							<p>Mauris donec ociis magnis sapien etiam sapien congue augue pretium ligula 
								a lectus aenean magna mauris
							</p>

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Jeremy Kruse</h5>	
								<span>Graphic Designer</span>	
							</div>

						</div>						
					</div>	<!-- END TESTIMONIAL #4 -->


					<!-- TESTIMONIAL #5 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-5.jpg') }}" alt="testimonial-avatar">
							</div>

							<!-- Testimonial Text -->
							<p>An augue in cubilia laoreet magna suscipit egestas magna ipsum at purus ipsum
								primis in augue ulta ligula egestas
							</p>

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Evelyn Martinez</h5>	
								<span>Senior UX/UI Designer</span>	
							</div>						

						</div>						
					</div>	<!-- END TESTIMONIAL #5 -->


					<!-- TESTIMONIAL #6 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-6.jpg') }}" alt="testimonial-avatar">
							</div>	

							<!-- Testimonial Text -->
							<p>An augue cubilia laoreet undo magna at risus suscipit egestas magna an ipsum ligula
								vitae and purus ipsum primis
							</p>

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Dan Hodges</h5>	
								<span>Internet Surfer</span>	
							</div>

						</div>						
					</div>	<!-- END TESTIMONIAL #6 -->


					<!-- TESTIMONIAL #7 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-7.jpg') }}" alt="testimonial-avatar">
							</div>

							<!-- Testimonial Text -->
							<p>Augue egestas volutpat egestas augue in cubilia laoreet magna suscipit luctus
								and dolor blandit vitae
							</p>

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Isabel M.</h5>	
								<span>SEO Manager</span>	
							</div>

						</div>						
					</div>	<!-- END TESTIMONIAL #7 -->


					<!-- TESTIMONIAL #8 -->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-8.jpg') }}" alt="testimonial-avatar">
							</div>

							<!-- Testimonial Text -->
							<p>Augue egestas volutpat egestas augue in cubilia laoreet magna suscipit luctus
								and dolor blandit vitae
							</p>

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Alex Ross</h5>	
								<span>Patient</span>	
							</div>							

						</div>						
					</div>	<!-- END TESTIMONIAL #8 -->


					<!-- TESTIMONIAL #9-->
					<div class="review-2">
						<div class="review-txt text-center">

							<!-- Quote -->
							<div class="quote"><img src="{{ asset('assets_member/images/quote.png') }}" alt="quote-img" /></div>

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{ asset('assets_member/images/review-author-9.jpg') }}" alt="testimonial-avatar">
							</div>	

							<!-- Testimonial Text -->
							<p>Augue egestas volutpat egestas augue in cubilia laoreet magna suscipit luctus
								magna dolor neque vitae 								   
							</p>

							<!-- Testimonial Author -->
							<div class="review-author">
								<h5 class="h5-sm">Alisa Milano</h5>	
								<span>Housewife</span>	
							</div>

						</div>						
					</div>	<!-- END TESTIMONIAL #9 -->


				</div>
			</div>									
		</div>	<!-- END TESTIMONIALS CONTENT --> 


	</div>	   <!-- End container -->
</section>	 <!-- END TESTIMONIALS-2 -->

<section id="pricing-3" class="wide-60 pricing-section division">
	<div class="container">	
		<div class="row d-flex align-items-center">


			<!-- PRICING TABLE -->
			<div class="col-lg-6">
				<div class="txt-block pc-30 mb-40 wow fadeInUp" data-wow-delay="0.4s">

					<!-- Section ID -->	
					<span class="section-id blue-color">Our Pricing</span>

					<!-- Title -->
					<h3 class="h3-md steelblue-color">Our Packages Are Budget Friendly for Everyone</h3>

					<!-- Text -->
					<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat
						dolor lacinia cubilia curae integer congue leo metus, primis in orci integer metus mollis faucibus enim 
					</p>

					<div class="pricing-table mb-40">								
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Service</th>
									<th scope="col">Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>X-Ray</td>
									<td>From <span>$325.00</span></td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Magnetic Resonance Imaging</td>
									<td>From <span>$435.00</span></td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td>Computer Tomography</td>
									<td>From <span>$315.00</span></td>
								</tr>
								<tr class="last-tr">
									<th scope="row">4</th>
									<td>Laboratory Tests</td>
									<td>From <span>$90.00</span></td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>	<!-- END PRICING TABLE -->


			<!-- PRICING IMAGE -->
			<div class="col-lg-6">
				<div class="pricing-img wow fadeInUp" data-wow-delay="0.6s">
					<img class="img-fluid" src="{{ asset('assets_member/images/image-04.png') }}" alt="pricing-image">
				</div>							
			</div>

		</div>	<!-- End row -->
	</div>    <!-- End container -->		
</section>	<!-- END PRICING-3 -->

<div id="gallery-1" class="gallery-section division">	


	<!-- SECTION TITLE -->	
	<div class="container">
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">		

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">Total Health Care Solutions</h3>	

				<!-- Text -->
				<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
					blandit posuere ligula varius congue cursus porta feugiat
				</p>

			</div> 
		</div>
	</div>


	<!-- GALLERY IMAGES -->
	<div class="row gallery-items-list">							


		<!-- IMAGE #1 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-1.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-1.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


		<!-- IMAGE #2 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-2.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-2.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


		<!-- IMAGE #3 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-3.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-3.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


		<!-- IMAGE #4 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-4.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-4.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


		<!-- IMAGE #5 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-5.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-5.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


		<!-- IMAGE #6 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-6.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-6.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


		<!-- IMAGE #7 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-7.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-7.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


		<!-- IMAGE #8 -->
		<div class="col-md-6 col-lg-3 gallery-item">
			<div class="hover-overlay"> 

				<!-- Gallery Image -->
				<img class="img-fluid" src="{{ asset('assets_member/images/gallery/image-8.jpg') }}" alt="gallery-image" />			
				<div class="item-overlay"></div>				

				<!-- Image Zoom -->		
				<div class="image-zoom">
					<a class="image-link" href="images/gallery/image-8.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
				</div> 

			</div>
		</div>


	</div>  <!-- END GALLERY IMAGES -->		
</div>	 <!-- END GALLERY-1 -->	

<section id="blog-1" class="wide-60 blog-section division">				
	<div class="container">


		<!-- SECTION TITLE -->	
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">	

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">Our Stories, Tips & Latest News</h3>	

				<!-- Text -->
				<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
					blandit posuere ligula varius congue cursus porta feugiat
				</p>

			</div>
		</div>


		<!-- BLOG POSTS HOLDER -->
		<div class="row">


			<!-- BLOG POST #1 -->
			<div class="col-lg-4">
				<div class="blog-post wow fadeInUp" data-wow-delay="0.4s">

					<!-- BLOG POST IMAGE -->
					<div class="blog-post-img">
						<img class="img-fluid" src="{{ asset('assets_member/images/blog/post-1-img.jpg') }}" alt="blog-post-image" />	
					</div>

					<!-- BLOG POST TITLE -->
					<div class="blog-post-txt">

						<!-- Post Title -->
						<h5 class="h5-sm steelblue-color"><a href="single-post.html">5 Benefits Of Integrative Medicine</a></h5>

						<!-- Post Data -->
						<span>May 03, 2019 by <span>Dr.Jeremy Smith</span></span>

						<!-- Post Text -->
						<p>Quaerat neque purus ipsum neque dolor primis libero tempus impedit tempor blandit sapien at
							gravida donec ipsum, at porta justo...
						</p>

					</div>

				</div>
			</div>	<!-- END  BLOG POST #1 -->


			<!-- BLOG POST #2 -->
			<div class="col-lg-4">
				<div class="blog-post wow fadeInUp" data-wow-delay="0.6s">

					<!-- BLOG POST IMAGE -->
					<div class="blog-post-img">
						<img class="img-fluid" src="{{ asset('assets_member/images/blog/post-2-img.jpg') }}" alt="blog-post-image" />	
					</div>

					<!-- BLOG POST TEXT -->
					<div class="blog-post-txt">

						<!-- Post Title -->
						<h5 class="h5-sm steelblue-color"><a href="single-post.html">Your Health Is In Your Hands</a></h5>

						<!-- Post Data -->
						<span>Apr 28, 2019 by <span>Dr.Jonathan Barnes</span></span>

						<!-- Post Text -->
						<p>Quaerat neque purus ipsum neque dolor primis libero tempus impedit tempor blandit sapien at
							gravida donec ipsum, at porta justo...
						</p>

					</div>

				</div>
			</div>	<!-- END  BLOG POST #2 -->


			<!-- BLOG POST #3 -->
			<div class="col-lg-4">
				<div class="blog-post wow fadeInUp" data-wow-delay="0.8s">

					<!-- BLOG POST IMAGE -->
					<div class="blog-post-img">
						<img class="img-fluid" src="{{ asset('assets_member/images/blog/post-3-img.jpg') }}" alt="blog-post-image" />	
					</div>

					<!-- BLOG POST TEXT -->
					<div class="blog-post-txt">

						<!-- Post Title -->
						<h5 class="h5-sm steelblue-color"><a href="single-post.html">How Weather Impacts Your Health</a></h5>

						<!-- Post Data -->
						<span>Apr 17, 2019 by <span>Dr.Megan Coleman</span></span>

						<!-- Post Text -->
						<p>Quaerat neque purus ipsum neque dolor primis libero tempus impedit tempor blandit sapien at
							gravida donec ipsum, at porta justo...
						</p>

					</div>

				</div>
			</div>	<!-- END  BLOG POST #3 -->


		</div>	<!-- END BLOG POSTS HOLDER -->


	</div>	   <!-- End container -->		
</section>	<!-- END BLOG-1 -->

<section id="contacts-1" class="bg-lightgrey wide-60 contacts-section division">				
	<div class="container">


		<!-- SECTION TITLE -->	
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">	

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">Have a Question? Get In Touch</h3>	

				<!-- Text -->
				<p>Have a question? Want to book an appointment for yourself or your children? Give us a call
					or send an email to contact the MedService.
				</p>

			</div>
		</div>


		<div class="row">	


			<!-- CONTACTS INFO -->
			<div class="col-md-5 col-lg-4">

				<!-- General Information -->
				<div class="contact-box mb-40">
					<h5 class="h5-sm steelblue-color">General Information</h5>
					<p>121 King Street, Melbourne,</p> 
					<p>Victoria 3000 Australia</p>
					<p>Phone: +12 9 8765 4321</p>
					<p>Email: <a href="mailto:yourdomain@mail.com" class="blue-color">hello@yourdomain.com</a></p>
				</div>

				<!-- Patient Experience -->
				<div class="contact-box mb-40">
					<h5 class="h5-sm steelblue-color">Patient Experience</h5>
					<p>Hannah Harper - Patient Experience Coordinator</p>
					<p>Phone: +12 9 8765 4321</p>
					<p>Email: <a href="mailto:yourdomain@mail.com" class="blue-color">hello@yourdomain.com</a></p>
				</div>

				<!-- Working Hours -->
				<div class="contact-box mb-40">
					<h5 class="h5-sm steelblue-color">Working Hours</h5>
					<p>Monday – Friday : 8:00 AM - 8:00 PM</p> 
					<p>Saturday : 10:00 AM - 6:00 PM</p>
					<p>Sunday : 10:00 AM - 4:00 PM</p>
				</div>

			</div>	<!-- END CONTACTS INFO -->


			<!-- CONTACT FORM -->	
			<div class="col-md-7 col-lg-8">
				<div class="form-holder mb-40">
					<form name="contactForm" id="contact-form" class="row contact-form" method="post" action="php/contactForm.php">

						<!-- Name -->
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<input id="form_name" type="text" name="name" class="form-control name" placeholder="Your Name*" required="required" data-error="Enter no more than (2) characters."> 
								<div class="help-block with-errors"></div> 
							</div>
						</div>

						<!-- Email -->			
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<input id="form_email" class="form-control email" type="email" name="email" placeholder="Your Email" required="required" data-error="Email is required"> 
								<div class="help-block with-errors"></div>  
							</div>
						</div>

						<!-- Phone -->	
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<input id="form_phone" class="form-control phone" type="tel" name="phone" placeholder="Your Phone Number" required="required" data-error="Please enter only digits."> 
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<!-- Select Input -->
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<select id="inlineFormCustomSelect1" name="patient" class="custom-select patient">
									<option>Have You Visited Us Before?*</option>
									<option>New Patient</option>
									<option>Returning Patient</option>
									<option>Other</option>
								</select>
							</div>
						</div>

						<!-- Subject -->	
						<div class="col-md-12">
							<div class="form-group">
								<input id="form_subject" class="form-control subject" type="text" name="subject" placeholder="Subject*" required="required" data-error="Subject is required"> 
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<!-- Message -->			
						<div class="col-md-12 input-message">
							<div class="form-group">
								<textarea id="form-message" class="form-control message" name="message" rows="6" placeholder="Your Message ..." required="required" data-error="Enter no more than (10) characters."></textarea>
								<div class="help-block with-errors"></div>
							</div>
						</div> 

						<!-- Contact Form Message -->
						<div class="messages"></div>

						<!-- Button -->
						<div class="col-md-12 mt-15 form-btn">	
							<button type="submit" class="btn btn-md btn-blue blue-hover submit">Send Your Message</button>	
						</div>

					</form>	
				</div>	
			</div> 	<!-- END CONTACT FORM -->	


		</div>	<!-- End row -->			  


	</div>	   <!-- End container -->		
</section>	<!-- END CONTACTS-1 -->

<section id="banner-5" class="pt-100 banner-section division">
	<div class="container">


		<!-- SECTION TITLE -->	
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">		

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">Certified and Experienced Doctors</h3>	

				<!-- Text -->
				<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
					blandit posuere ligula varius congue cursus porta feugiat
				</p>

			</div> 
		</div>


		<!-- BANNER IMAGE -->
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="banner-5-img wow fadeInUp" data-wow-delay="0.4s">
					<img class="img-fluid" src="{{ asset('assets_member/images/image-07.png') }}" alt="banner-image" />
				</div>
			</div>
		</div>


	</div>	   <!-- End container -->	
</section>	<!-- END BANNER-5 -->
@endsection