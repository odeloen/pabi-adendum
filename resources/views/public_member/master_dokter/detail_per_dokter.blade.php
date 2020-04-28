@extends('public_member.index')
@section('public_tempat_content')
@include('public_admin.include.function')

<!-- DOCTOR-2 DETAILS -->
<section id="doctor-2-details" class="wide-70 doctor-details-section division">	
	<div class="container">
		<div class="row">


			<!-- DOCTOR PHOTO -->
			<div class="col-md-5 col-xl-5">
				<div class="doctor-photo mb-30 text-center">
	                <?php 
	                if (does_url_exists(env('URL_API_IP') . $data_dokter['image_thumb_compress']) == 1 && !empty($data_dokter['image_thumb_compress'])) {
	                    ?>
	                    <a href="{{env('URL_API_IP')}}{{$data_dokter['image_thumb']}}" target="_blank"> 
							<!-- Photo -->	
							<img class="img-fluid" src="{{env('URL_API_IP')}}{{$data_dokter['image_thumb']}}" alt="doctor-foto">
	                    </a>
	                    <?php
	                } else {
	                    if($data_dokter['gender'] == 'P'){ 
	                    ?> 
	                    <img src="{{ asset('assets/images/profile_member/member_pr.png') }}" class="img-fluid" alt="" > 
	                    <?php 
	                    } else {
	                    ?>
	                    <img src="{{ asset('assets/images/profile_member/deafult_profile.png') }}" class="img-fluid" alt="" > 
	                    <?php 
	                    }
	                }
	                ?> 

					<!-- Text -->	
					<p class="mt-30" style="display: none;">Etiam sapien sem magna at vitae pulvinar congue augue egestas pretium neque
						id viverra suscipit egestas magna porta ratione, mollis risus lectus porta rutrum arcu aenean
					</p>

					<!-- Doctor Contacts -->	
					<div class="doctor-contacts">
						<h4 class="h4-xs"><i class="fas fa-mobile-alt"></i>{{$data_dokter['no_telp']}}</h4>
						<h4 class="h4-xs blue-color"><i class="fas fa-envelope-open-text"></i> 
							<a href="mailto:{{$data_dokter['email']}}" class="blue-color">{{$data_dokter['email']}}</a>
						</h4>
					</div>

					<!-- Button -->
					<a style="display: none;" href="appointment.html" class="btn btn-md btn-blue blue-hover">Book an Appointment</a>

					<!-- Button -->
					<a style="display: none;" href="timetable.html" class="btn btn-md btn-tra-grey grey-hover">View Timetable</a>

				</div>
			</div>	<!-- END DOCTOR PHOTO -->


			<!-- DOCTOR'S BIO -->
			<div class="col-md-6 col-xl-6 offset-xl-1">
				<div class="doctor-bio">

					<!-- Name -->	
					<h3 class="h3-sm blue-color">{{$data_dokter['firstname']}} {{$data_dokter['lastname']}}</h3>
					<h5 class="h5-lg blue-color">Pusat: {{$data_dokter['nama_admin_pusat']}} / Cabang: {{$data_dokter['nama_admin_cabang']}}</h5>

					<h5 class="h5-md blue-color">Minat Bidang</h5>
					<!-- Text -->	
					@php
					$no = 0;
					@endphp
					@if(count($data_minat_bidang) != 0)
					@foreach ($data_minat_bidang as $dmb)
					<p>
						<?php
						$no++; 
						echo $no.'. '.$dmb['jenis_minat'].': '.$dmb['nama'].'.'; ?>
					</p>
					@endforeach	
					@else
					<p>Tidak Ada Data Minat Bidang</p>
					@endif

					<!-- Title -->	
					<h5 class="h5-md blue-color">Pekerjaan</h5>
					<!-- Text -->
					@php
					$no = 0;
					@endphp
					@if(count($data_pekerjaan) != 0)
					@foreach ($data_pekerjaan as $dp1)
					<p>
						<?php
						$no++; 
						echo $no.'. Bekerja Sebagai <b>'.$dp1['nama_pekerjaan'].'</b> di <b>'.$dp1['tempat_pekerjaan'].'</b>.'; ?>
					</p>
					@endforeach	
					@else
					<p>Tidak Ada Data Pekerjaan</p>
					@endif

					<!-- Title -->	
					<h5 class="h5-md blue-color">Pendidikan</h5>
					@php
					$no = 0;
					@endphp
					@if(count($data_pendidikan) != 0)
					@foreach ($data_pendidikan as $dp2)
					<p>
						<?php
						$no++; 
						echo $no.'. Jenjang Pendidikan: '.$dp2['jenjang_pendidikan'].' '.$dp2['jurusan'].'.'; ?>
					</p>
					@endforeach	
					@else
					<p>Tidak Ada Data Pendidikan</p>
					@endif

					<!-- Title -->	
					<h5 class="h5-md blue-color">Praktek</h5>
					@php
					$no = 0;
					@endphp
					@if(count($data_praktek) != 0)
					@foreach ($data_praktek as $dp3)
					<p>
						<?php
						$no++; 
						echo $no.'. Tempat Praktek: '.$dp3['nama_tempat'] ?>
					</p>
					@endforeach	
					@else
					<p>Tidak Ada Data Praktek</p>
					@endif

					<!-- CERTIFICATES -->	
					<div class="certificates" style="display: none">

						<!-- Title -->	
						<h5 class="h5-md blue-color">Diplomas and Certificates</h5>

						<!-- Certificate Preview -->
						<div class="row">

							<!-- Certificate Image -->
							<div class="col-sm-6 col-lg-4">
								<div class="certificate-image">
									<a class="image-link" href="images/certificate-1.png" title="">
										<img class="img-fluid" src="{{asset('assets_member/images/certificate-1.png')}}" alt="certificate-image" />
									</a>
								</div>
							</div>

							<!-- Certificate Image -->
							<div class="col-sm-6 col-lg-4">
								<div class="certificate-image">
									<a class="image-link" href="images/certificate-2.png" title="">
										<img class="img-fluid" src="{{asset('assets_member/images/certificate-2.png')}}" alt="certificate-image" />
									</a>
								</div>
							</div>

							<!-- Certificate Image -->
							<div class="col-sm-6 col-lg-4">
								<div class="certificate-image">
									<a class="image-link" href="images/certificate-3.png" title="">
										<img class="img-fluid" src="{{asset('assets_member/images/certificate-3.png')}}" alt="certificate-image" />
									</a>
								</div>
							</div>

							<!-- Certificate Image -->
							<div class="col-sm-6 col-lg-4">
								<div class="certificate-image">
									<a class="image-link" href="images/certificate-4.png" title="">
										<img class="img-fluid" src="{{asset('assets_member/images/certificate-4.png')}}" alt="certificate-image" />
									</a>
								</div>
							</div>

							<!-- Certificate Image -->
							<div class="col-sm-6 col-lg-4">
								<div class="certificate-image">
									<a class="image-link" href="images/certificate-5.png" title="">
										<img class="img-fluid" src="{{asset('assets_member/images/certificate-5.png')}}" alt="certificate-image" />
									</a>
								</div>
							</div>

						</div>
					</div>	<!-- END CERTIFICATES -->	

				</div>
			</div>	<!-- END DOCTOR BIO -->


		</div>   <!-- End row -->	
	</div>	  <!-- End container -->
</section> <!-- END  DOCTOR-2 DETAILS -->

<section id="reviews-2" class="bg-lightgrey wide-100 reviews-section division" style="display: none;">
	<div class="container">


		<!-- SECTION TITLE -->	
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">		

				<!-- Title 	-->	
				<h3 class="h3-md steelblue-color">What Patients Say About Robert</h3>	

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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-1.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-2.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-3.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-4.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-5.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-6.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-7.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>	

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-8.jpg')}}" alt="testimonial-avatar">
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
							<div class="quote"><img src="{{asset('assets_member/images/quote.png')}}" alt="quote-img" /></div>

							<!-- Author Avatar -->
							<div class="testimonial-avatar">
								<img src="{{asset('assets_member/images/review-author-9.jpg')}}" alt="testimonial-avatar">
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
@endsection