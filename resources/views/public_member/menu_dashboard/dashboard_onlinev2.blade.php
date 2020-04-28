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
				<h3 class="h3-md steelblue-color">Dokter Bedah</h3>	

				<!-- Text -->
				<p>
					PABI
				</p>

			</div> 
		</div>	 <!-- END SECTION TITLE -->	


		<div class="row" id="div_public_tabel_master_dokter">


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
					<a href="{{ url('/list_dokter') }}" class="btn btn-blue blue-hover">Meet All Doctors</a>
				</div>
			</div>
		</div>


	</div>	   <!-- End container -->
</section>	<!-- END DOCTORS-1 -->   
 

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

<form class="row hero-form" enctype="multipart/form-data" id="formFilterMasterDokterHalamanAwal" >
	<input type="hidden" name="admin_cabang_id" value="">
	<input type="hidden" name="limit" value="3">
	<input type="hidden" name="nama_dokter" value="">
	<input type="hidden" name="minat_bidang_id" value=""> 
</form>
<script type="text/javascript">
	$( document ).ready(function() {
		div_public_tabel_master_dokter('{{csrf_token()}}', '#div_public_tabel_master_dokter');
	});
</script>
@endsection