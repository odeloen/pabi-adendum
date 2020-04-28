@extends('public_member.index')
@section('public_tempat_content')
<section id="contacts-1" class="wide-10 contacts-section division">				
	<div class="container">
		<!-- CONTACT FORM -->	
		<div class="col-md-12">
			<div class="form-holder mb-10">
				<form class="row hero-form" enctype="multipart/form-data" id="formFilterMasterDokterHalamanAwal">
					<!-- Select Input -->
					<div class="col-md-3">&nbsp;</div>
					<div class="col-md-6 bg-blue" style="padding: 1%;">
						<center><h3></h3></center>
						<div class="col-md-12">
							<div class="form-group">
								<select id="admin_cabang_id" name="admin_cabang_id" class="custom-select" required="">
									<option value="">Pilih Wilayah</option>
									<?php
									foreach ($data_admin_cabang as $dac) {
										echo '<option value="'.$dac['id'].'">'.$dac['name'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<!-- Name -->
						<div class="col-md-12">
							<div class="form-group">
								<input id="nama_dokter" type="text" name="nama_dokter" class="form-control" placeholder="Masukkan Nama Dokter" required="">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<select id="minat_bidang_id" name="minat_bidang_id" class="custom-select" required="">
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
						<!-- Name -->
						<div class="col-md-12">
							<div class="form-group">
								<input id="limit" type="number" name="limit" class="form-control" placeholder="Masukkan Limit Data" required="" min="1" value="10">
							</div>
						</div>
						<!-- Button -->
						<button title="Tampilkan" type="button" class="btn btn-md btn-orange btn-block blue-hover btn_tampilkan"
						        onclick="div_public_tabel_master_dokter('{{csrf_token()}}', '#div_public_tabel_master_dokter')">
							<i class="icon-filter3"></i>
							Tampilkan
						</button>
						<!-- <div class="col-md-12 mt-15 form-btn">	
							<button type="submit" class="btn btn-md btn-orange btn-block blue-hover submit">Filter Data Dokter</button>	
						</div> -->
					</div>
					<div class="col-md-3">&nbsp;</div>
				</form>	
			</div>	
		</div> 	<!-- END CONTACT FORM -->	
	</div>
</section>

<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
	<div class="container">
		<div class="row" id="div_public_tabel_master_dokter">
			
		</div>	    <!-- End row -->
	</div>	   <!-- End container -->
</section>	<!-- END DOCTORS-3 -->
<script type="text/javascript">
	$('.btn_tampilkan').click();
</script>
@endsection