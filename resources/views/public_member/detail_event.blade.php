<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="PABI"/>
	<meta name="description" content="PABI Membership"/>
	<meta name="keywords"
	      content="PABI, PABI-Membership, IDI, Dokter, Dokter Bedah, Medical, Health, Healthcare, Doctor, Clinic, Care, Hospital">
	<title>PABI - Membership</title>
	<link rel="icon" href="{{ asset('assets_login/images/favicon.ico') }}" type="image/x-icon">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
	      type="text/css">
	<link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<!-- <link href="{{ asset('assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css"> -->
	<link href="{{ asset('assets/fonts/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>

	<!-- <script type="text/javascript" src="{{ asset('assets/js/pages/form_checkboxes_radios.js') }}"></script> -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/drilldown.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}">
	</script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript"
	        src="{{ asset('assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/nicescroll.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js') }}"></script> -->


	<script type="text/javascript" src="{{ asset('assets/js/plugins/ui/ripple.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/pages/form_layouts.js') }}"></script>
	<script type="text/javascript" src="{{asset('assets/js/plugins/notifications/sweet_alert.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_basic.js') }}"></script>  -->

	<link href="{{asset('assets/switchonoff.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/switchonoff_hadir.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/switchonoff_active.css')}}" rel="stylesheet" type="text/css">

	<script src="{{asset('assets/highcharts/highcharts.js')}}"></script>
	<script src="{{asset('assets/highcharts/data.js')}}"></script>
	<script src="{{asset('assets/highcharts/drilldown.js')}}"></script>


	<script src="{{asset('assets/js/plugins/buttons/spin.min.js')}}"></script>
	<script src="{{asset('assets/js/plugins/buttons/ladda.min.js')}}"></script> 

	@include('public_admin.include.function')
</head>

<body class="navbar-top "> <!-- sidebar-xs -->

<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top bg-indigo">
	<div class="navbar-header">
		@if(request()->session()->get('pabi_role_id') == 4)
		<a class="navbar-brand" href="{{ url('/member') }}" style="width: 100%; padding-top: 5px !important;">
			<img src="{{ asset('assets/images/logo_light.png') }}" alt="" style="height: 100%;">
		</a>
		@else
		<a class="navbar-brand" href="{{ url('/admin') }}" style="width: 100%; padding-top: 5px !important;">
			<img src="{{ asset('assets/images/logo_light.png') }}" alt="" style="height: 100%;">
		</a>
		@endif

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">  
		</ul> 
	</div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">
		<!-- Main content -->
		<div class="content-wrapper"> 


			<!-- Content area -->
			<!-- <div class="content"> -->
			<div class="content-utama" style="height: 657px;">
				<!-- yield content -->

				<div class="row"> 
					<div class="col-lg-12">
						<!-- Post -->
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-7"> 
										<div class="content-group-lg" id="konten_kiri">
											<div class="content-group text-center">
												<?php
												if (does_url_exists(env('URL_API_IP') . $data_event['foto_event_compress']) == 1 && !empty($data_event['foto_event_compress'])) {
													?>
													<a href="{{env('URL_API_IP')}}{{$data_event['foto_event']}}"
													   target="_blank">
														<img src="{{env('URL_API_IP')}}{{$data_event['foto_event_compress']}}"
														     style=" max-height: 200px;margin: 10px;">
													</a>
													<?php
												}
												?>
											</div>
											<?php

											$tgl_event = tgl_indo($data_event['tgl_event']);
											$str_penyelenggara = $data_event['admin_pusat_description'];
											if(empty($str_penyelenggara)){
												$str_penyelenggara = $data_event['admin_cabang_description'];
											}
											?>

											<h3 class="text-semibold mb-5">
												<a href="#" class="text-default">
													{{ $data_event['nama_event'] }}
												</a>
											</h3>
											<div class="text-size-mini-hamdi">
												<i class="icon-calendar text-size-small"></i> &nbsp;{{ $tgl_event }}

												&nbsp;&nbsp;&nbsp;&nbsp;

												<i class="icon-alarm text-size-small"></i> &nbsp;{{ date('H:i', strtotime($data_event['jam_mulai'])) }} - {{ date('H:i', strtotime($data_event['jam_selesai'])) }}

												&nbsp;&nbsp;&nbsp;&nbsp;

												<i class="icon-pin text-size-small"></i> &nbsp;{{ $data_event['lokasi_alamat'] }} 
											</div>  
											<div class="text-size-mini-hamdi" style="text-align: justify;"> 
												<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($param_id_enc)) !!} "> 
											</div>
											<div class="text-size-mini-hamdi" style="text-align: justify;">
												<b>Kuota :</b> {{ $data_event['max_event'] }} kursi<br>
												<b>Penyelenggara :</b> {{ $str_penyelenggara }}<br>  
												<b>Deskripsi Event : </b><br>
												{{ $data_event['deskripsi'] }}
											</div> 
										</div>  
									</div>
									<div class="col-md-5"> 
										<?php 
										if(!empty($data_event['lokasi_koordinat_x']) && !empty($data_event['lokasi_koordinat_y'])){
										?>
										<blockquote  id="konten_kanan" class="no-margin panel panel-body border-left-lg border-left-warning">
											Map Lokasi
											<?php
											if(!empty($data_event['lokasi_koordinat_x']) && !empty($data_event['lokasi_koordinat_y'])){
												?>
												<a href="https://www.google.com/maps?saddr=My+Location&daddr=<?php echo $data_event['lokasi_koordinat_y']; ?>,<?php echo $data_event['lokasi_koordinat_x']; ?>" target="_blank" >
													, klik disini untuk <i>direction</i>
												</a>
												<?php 
											}
											?>
											<div id="div_maps" style="width: 100%; height: 100%">
												
											</div>
										</blockquote> 
										<script type="text/javascript"> 
											$(document).ready(function () { 
												maps('#div_maps', '<?= $data_event['lokasi_koordinat_x'] ?>', '<?= $data_event['lokasi_koordinat_y'] ?>');
										        function maps(target, lokasi_koordinat_x, lokasi_koordinat_y){ 
										            $(target).html('loading...');
										            var act = '/event/maps/'+lokasi_koordinat_x+'&&'+lokasi_koordinat_y;
										             
												    $.ajax({
												        url: act,
												        success: function(data) { 
										                	$(target).html(data);
												        }
												    });
										        }
											});
										</script>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<!-- /post -->

					</div>
				</div>
				<!-- yield content -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content --> 
</div>
<!-- /page container -->

<!-- Footer --> 
<!-- /footer -->
<script type="text/javascript">

	$(document).ready(function () {
		var height = $(window).height();
		$('.content-utama').attr('style', 'min-height:' + height + 'px;'); 

		var height = $('#konten_kiri').height();
		$('#konten_kanan').attr('style', 'min-height:' + height + 'px;'); 
	});
</script>
</body>
</html>
