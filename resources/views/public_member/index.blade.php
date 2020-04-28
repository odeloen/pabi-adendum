<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="author" content="PABI"/>	
	<meta name="description" content="PABI Membership"/>
	<meta name="keywords" content="PABI, PABI-Membership, IDI, Dokter, Dokter Bedah, Medical, Health, Healthcare, Doctor, Clinic, Care, Hospital">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
	@include('public_member.include.style')
</head>
<body>
	<div id="loader-wrapper">
		<div id="loader"><div class="loader-inner"></div></div>
	</div>
	<div id="page" class="page">
		@include('public_member.include.header')

		<!-- yield content -->
		@yield('public_tempat_content')
		<!-- yield content -->

		@include('public_member.include.footer')

	</div>	
	<!-- END PAGE CONTENT -->
</body>
</html>	