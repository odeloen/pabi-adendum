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
				<h6 class="panel-title">Filter Data</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>
			<div class="panel-body">
				<form onsubmit="div_tabel_expired_pembayaran_pusat('{{csrf_token()}}', '#div_tabel_expired_pembayaran_pusat'); return false;" class="form-horizontal" enctype="multipart/form-data" id="formFilterDataExpiredPembayaranEventPusat">
					<div class="row">
						<div class="col-lg-2">&nbsp;</div>
						<div class="col-lg-7">
							<?php
							$discoladm = '';
							if (session('pabi_role_id') != 1) {
								$discoladm=' style="display:none;"';
							}
							?>
							<div class="form-group"<?php echo $discoladm; ?>>
								<label for="admin_pst_id" style="text-align: right;" class="col-lg-3 control-label">
									Admin Pusat : 
								</label>
								<div class="col-lg-9">
									<select data-placeholder="Pilih Admin Pusat" class="select22" name="admin_pst_id" id="admin_pst_id" style="width: 100%" onchange="event_by_admin_pusat('{{csrf_token()}}', this.value)">
										<option value="">-- Select Admin Pusat--</option> 
										<?php
										foreach ($data_admin_pusat as $dap) {
											$sel_adm_pst = '';
											if (session('pabi_role_id') == 2 && session('admin_pusat_id') == $dap['id']) {
												$sel_adm_pst = 'selected=""';
											}
											echo '<option value="'.$dap['id'].'" '.$sel_adm_pst.'>'.$dap['name'].'</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="event_id" style="text-align: right;" class="col-lg-3 control-label">
									Nama Event :
								</label>
								<div class="col-lg-9">
									<select data-placeholder="Pilih Event" class="select22" name="event_id" id="event_id_pembayaran" style="width: 100%">
										<option value="all">-- Pilih Event --</option> 
										<?php
										foreach ($data_event as $dev) {
											$sel_adm_cab = '';
											if (session('pabi_role_id') == 3 && session('admin_cabang_id') == $dev['id']) {
												$sel_adm_cab = 'selected=""';
											}
											echo '<option value="'.$dev['id'].'" '.$sel_adm_cab.'>'.$dev['nama_event'].'</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="limit" style="text-align: right;" class="col-lg-3 control-label">
									Banyak Data : 
								</label>
								<div class="col-lg-9">
									<input type="number" class="form-control" name="limit" id="limit_pembayaran" min="1" value="100">
								</div>
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">&nbsp;</div>
						<div class="col-lg-6">
							<button title="Tampilkan" type="submit" class="btn btn-primary btn-sm btn-block btn_tampilkan" >
								<i class="icon-filter3"></i>
								Tampilkan
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-lg-12">

		<!-- Panel Event -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Pembayaran Pusat (Khusus Expired)</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>
			<div class="panel-body"id="div_tabel_expired_pembayaran_pusat"> 
			</div>
		</div>
		<!-- /Panel Event -->

	</div>
</div>

<script type="text/javascript">
	$('.btn_tampilkan').click();
</script>
@endsection