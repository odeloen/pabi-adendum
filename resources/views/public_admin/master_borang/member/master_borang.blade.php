@extends('public_admin.index')
@section('tempat_content')
<!-- Main charts -->
<div class="row">

	<div class="col-md-12">
		@if (session()->has('status')) 
		<script type="text/javascript">
			alertKu('success', "{{ session()->get('status') }}");
		</script>
		<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
			<button type="button" class="close" data-dismiss="alert">
				<span>×</span>
				<span class="sr-only">Close</span>
			</button>
			<span class="text-semibold">Berhasil! </span> {{ session()->get('status') }}
			{{session()->forget('status')}}
		</div> 
		@endif
		@if (session()->has('statusT'))
		<div class="alert alert-warning alert-styled-left">
			<button type="button" class="close" data-dismiss="alert">
				<span>×</span>
				<span class="sr-only">Close</span>
			</button>
			<span class="text-semibold">Gagal!<br></span> {{ session()->get('statusT') }}
			{{session()->forget('statusT')}}
		</div>
		@endif
	</div> 
	<div class="col-lg-12"> 
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Kalender Borang</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>
			<div class="panel-body">
                <div class="alert alert-warning alert-styled-left">
                    <button type="button" class="close" data-dismiss="alert"> 
                    </button>
                    <span class="text-semibold">Perhatian!<br></span> Klik pada tombol tanggal untuk mengisi Borang pada tanggal tersebut.
                </div>   
                <div style="width: 100%; height: 100%" id="div_calender">
                    
                </div> 
                <input style="display: none" type="hidden" id="tgl_calendar" value="<?= date('Y-m-d'); ?>">
                <button style="display: none" id="btn_tgl_calendar" type="button" onclick="div_master_borang('{{csrf_token()}}', $('#tgl_calendar').val(), '#div_master_borang');">
                	tampilkan
                </button>
			</div>
		</div>
	</div>
	<div class="col-lg-12">


		<!-- Panel Event -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Master Borang</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body" id="div_master_borang">
				 
			</div>
		</div>
		<!-- /Panel Event -->

	</div>
</div>
<!-- /main charts -->		

<script> 
$(document).ready(function () {  
    $('#btn_tgl_calendar').click();
    // location.reload();
});
     

</script>
@endsection