@extends('public_member.index')
@section('public_tempat_content')
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
							<li class="breadcrumb-item active" aria-current="page">Data Dokter Bedah</li>
						</ol>
					</nav>

					<!-- Title -->
					<h4 class="h4-sm steelblue-color">Data Dokter Bedah</h4>

				</div>
			</div>
		</div>  <!-- End row -->
	</div>    <!-- End container -->
</div>    <!-- END BREADCRUMB -->
<section id="contacts-1" class="wide-10 contacts-section division">				
	<div class="container">
		<!-- CONTACT FORM -->	
		<form onsubmit="div_public_tabel_master_dokter('{{csrf_token()}}', '#div_public_tabel_master_dokter'); return false;" class="row hero-form" enctype="multipart/form-data" id="formFilterMasterDokterHalamanAwal" >
			<div class="col-md-6 bg-blue" style="padding: 20px">  
				<div class="form-group">
					<select id="admin_cabang_id" name="admin_cabang_id" class="custom-select" >
						<option value="">Pilih Wilayah</option>
						<?php
						foreach ($data_admin_cabang as $dac) {
							echo '<option value="'.$dac['id'].'">'.$dac['name'].'</option>';
						}
						?>
					</select>
				</div> 
				<div class="form-group">
					<input id="limit" type="number" name="limit" class="form-control" placeholder="Masukkan Limit Data" min="1" value="12">
				</div>
			</div>
			<div class="col-md-6 bg-blue" style="padding: 20px"> 
				<div class="form-group">
					<input id="nama_dokter" type="text" name="nama_dokter" class="form-control" placeholder="Masukkan Nama Dokter" >
				</div>
				<div class="form-group">
					<select id="minat_bidang_id" name="minat_bidang_id" class="custom-select" >
						<option value="">Pilih Minat Bidang</option>
						<?php
						foreach ($data_minat_bidang as $dmb) {
							echo '<option value="'.$dmb['nama'].'">'.$dmb['nama'].'</option>';
						}
						?>
						<!-- <option value="Konsultan Digestive">Konsultan Digestive</option> -->
					</select>
				</div>
			</div> 
			<div class="col-md-12 bg-blue" style="padding: 20px"> 
				<button title="Tampilkan" type="submit" class="btn btn-md btn-orange btn-block blue-hover btn_tampilkan" >
					<i class="icon-filter3"></i>
					Tampilkan
				</button>
			</div>
		</form> 
	</div>
</section>

<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
	<div class="container">
		<div class="row" id="div_public_tabel_master_dokter">
			
		</div>	    <!-- End row -->
	</div>	   <!-- End container -->
</section>	<!-- END DOCTORS-3 -->
<script type="text/javascript"> 
$( document ).ready(function() {
	$('.btn_tampilkan').click();
});
</script>
@endsection