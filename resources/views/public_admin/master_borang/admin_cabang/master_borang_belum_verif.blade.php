@extends('public_admin.index')
@section('tempat_content')
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

	<div class="col-md-12">
		<div class="panel panel-warning">
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
				<form class="form-horizontal" enctype="multipart/form-data" id="formFilterDataBorangAdminCabangBelumVerif" onsubmit="div_tabel_borang_belum_verif_cabang('{{csrf_token()}}', '#div_tabel_borang_belum_verif_cabang'); return false;">
					<div class="row">
						<div class="col-md-2">&nbsp;</div>
						<div class="col-md-8">
							<?php
							$discoladm = '';
							if (session('pabi_role_id') != 1) {
								$discoladm = ' style="display:none;"';
							}
							?>
							<div class="form-group"<?php echo $discoladm; ?>>
								<label for="admin_cabang_id" style="text-align: right;" class="col-md-3 control-label">
									Admin Cabang :
								</label>
								<div class="col-md-8">
									<select data-placeholder="Pilih Admin Cabang" class="select22" name="admin_cabang_id" id="admin_cabang_id" style="width: 100%">
										<option value="">-- Semua --</option>
										<?php
										foreach ($data_admin_cabang as $dac) {
											$sel_adm_cab = '';
											if (session('pabi_role_id') == 3 && session('admin_cabang_id') == $dac['id']) {
												$sel_adm_cab = 'selected=""';
											}
											echo '<option value="' . $dac['id'] . '" ' . $sel_adm_cab . '>' . $dac['name'] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="borang" style="text-align: right;" class="col-md-3 control-label">
									Borang :
								</label>
								<div class="col-md-8">
									<select data-placeholder="Pilih Borang" class="select22" name="borang" id="borang" style="width: 100%" onchange="jenis_kegiatan_by_borang('{{csrf_token()}}', '#formFilterDataBorangAdminCabangBelumVerif')">
										<option value="">-- Semua --</option>
										<?php
										foreach ($data_ranah_borang as $drb) {
											echo '<option value="' . $drb['id'] . '">' . $drb['nama_ranah'] . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="jenis_kegiatan" style="text-align: right;" class="col-md-3 control-label">
									Jenis Kegiatan :
								</label>
								<div class="col-md-8">
									<select data-placeholder="Pilih Jenis Kegiatan" class="select22" name="jenis_kegiatan" id="jenis_kegiatan" style="width: 100%" onchange="nama_kegiatan_by_jenis_kegiatan('{{csrf_token()}}', '#formFilterDataBorangAdminCabangBelumVerif')">
										<option value="">-- Semua --</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_kegiatan" style="text-align: right;" class="col-md-3 control-label">
									Nama Kegiatan :
								</label>
								<div class="col-md-8">
									<select data-placeholder="Pilih Nama Kegiatan" class="select22" name="nama_kegiatan" id="nama_kegiatan" style="width: 100%">
										<option value="">-- Semua --</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_member" style="text-align: right;" class="col-md-3 control-label">
									Nama Member :
								</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="nama_member" id="nama_member"
									value="">
								</div>
							</div>
							<div class="form-group">
								<label align="right" style="text-align: right" class="control-label col-md-3">
									Tanggal Borang :
								</label>
								<?php
								$date_back = date('Y-m-d', strtotime('-1 months', strtotime(date("Y-m-d"))));
								$date_in = date("Y-m-d");

								$date_later = date('Y-m-d', strtotime('+12 months', strtotime(date("Y-m-d"))));
								?>
								<div class="col-md-4">
									<input type="date" class="form-control"
									value="{{ $date_back }}"
									name="tgl_borang_awal"
									id="tgl_borang_awal">
								</div>
								<div class="col-md-4">
									<input type="date" class="form-control"
									name="tgl_borang_akhir"
									id="tgl_borang_akhir"
									value="{{ $date_in }}">
								</div>
							</div>
							<div class="form-group">
								<label for="limit" style="text-align: right;" class="col-md-3 control-label">
									Banyak Data :
								</label>
								<div class="col-md-8">
									<input type="number" class="form-control" name="limit" id="limit" min="1"
									value="100">
								</div>
							</div>
						</div>
						<div class="col-md-2">&nbsp;</div>
					</div>
					<div class="row">
						<div class="col-md-3">&nbsp;</div>
						<div class="col-md-6">
							<button title="Tampilkan" type="submit" class="btn btn-primary btn-sm btn-block btn_tampilkan" >
								<i class="icon-filter3"></i>
								Tampilkan
							</button>
						</div>
						<div class="col-md-3">&nbsp;</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h6 class="panel-title">Master Data Borang yang <b>Belum</b> Diverifikasi</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>

					</ul>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group" id="div_tabel_borang_belum_verif_cabang">

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.btn_tampilkan').click();
</script>
@endsection