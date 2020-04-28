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
				<form class="form-horizontal" enctype="multipart/form-data"
						      id="formFilterDataMemberAdminCabangBelumVerif" onsubmit="div_tabel_member_belum_verif_cabang('{{csrf_token()}}', '#div_tabel_member_belum_verif_cabang'); return false;">
					<div class="row">
						<div class="col-md-3">&nbsp;</div>
						<div class="col-md-5">
								<?php
								$discoladm = '';
								if (session('pabi_role_id') != 1) {
									$discoladm = ' style="display:none;"';
								}
								?>
								<div class="form-group"<?php echo $discoladm; ?>>
									<label for="admin_cab_id" style="text-align: right;" class="col-md-5 control-label">
										Admin Cabang :
									</label>
									<div class="col-md-7">
										<select data-placeholder="Pilih Admin Cabang" class="select22" name="admin_cab_id"
										        id="admin_cab_id" style="width: 100%">
											<option value="0">-- Semua --</option>
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
									<label for="name_member" style="text-align: right;" class="col-md-5 control-label">
										Nama Member :
									</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="name_member" id="name_member"
										       value="">
									</div>
								</div>
								<div class="form-group">
									<label for="limit" style="text-align: right;" class="col-md-5 control-label">
										Banyak Data :
									</label>
									<div class="col-md-7">
										<input type="number" class="form-control" name="limit" id="limit" min="1"
										       value="100">
									</div>
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">&nbsp;</div>
						<div class="col-md-4">
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

	<div class="col-md-12">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h6 class="panel-title">Master Data Member yang <b>Belum</b> Diverifikasi</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group" id="div_tabel_member_belum_verif_cabang">

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.btn_tampilkan').click();
</script>
@endsection