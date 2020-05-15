<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="PABI"/>   
	<meta name="description" content="PABI Membership"/>
	<meta name="keywords" content="PABI, PABI-Membership, IDI, Dokter, Dokter Bedah, Medical, Health, Healthcare, Doctor, Clinic, Care, Hospital"> 
	@include('public_admin.include.style')
	@include('public_admin.include.function')
	@yield('addCSS')
</head>

<body class="navbar-top "> <!-- sidebar-xs -->

	<!-- Main navbar -->
	@include('public_admin.include.navbar')
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			@include('public_admin.include.sidebar')
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				@include('public_admin.include.header')
				<!-- /page header -->


				<!-- Content area -->
				<!-- <div class="content"> -->
				<div class="content-utama" style="height: 657px;">
					<!-- yield content -->
					@yield('tempat_content')
					<!-- yield content -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

		@include('public_admin.include.tempat_modal')
	</div>
	<!-- /page container -->

	<!-- Footer -->
	@include('public_admin.include.footer')
	@yield('addJS')
	<!-- /footer -->
	<script type="text/javascript">
		
		$( document ).ready(function() {
		    var height = $( window ).height(); 
		    $('.content-utama').attr('style','min-height:'+height+'px;');
		});
	</script>
</body>
</html>
