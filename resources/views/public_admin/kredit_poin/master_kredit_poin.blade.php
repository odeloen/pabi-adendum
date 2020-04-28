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
				<form class="form-horizontal" enctype="multipart/form-data" id="formFilterLaporanKreditPoin" onsubmit="div_tabel_kredit_poin('{{csrf_token()}}', '#div_tabel_kredit_poin', '#div_tabel_per_member'); return false;">
					<div class="row">
						<div class="col-md-2">&nbsp;</div>
						<div class="col-md-8">
							<?php
							$discol = '';
							if (session('pabi_role_id') == 4) {
								$discol = ' style="display:none;"';
							}
							?>
							<div class="form-group"<?php echo $discol; ?>>
								<label for="member_id" style="text-align: right;" class="col-md-3 control-label">
									Member :
								</label>
								<div class="col-md-8">
									<select data-placeholder="Pilih Member" class="select22" name="member_id" id="member_id" style="width: 100%">
										<option value="0">-- Semua --</option>
										<?php
										foreach ($data_member as $dm) {
											$sel_member = '';
											if (session('pabi_role_id') == 4 && session('pabi_member_id') == $dm['id']) {
												$sel_member = 'selected=""';
											}
											echo '<option value="'.$dm['id'].'" '.$sel_member.'>'.$dm['firstname'].' '.$dm['lastname'].'('.$dm['card_no'].')</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label align="right" style="text-align: right" class="control-label col-md-3">
									Tanggal Borang :
								</label>
								<?php
								$date_back = date('Y-m-d', strtotime('-30 days', strtotime(date("Y-m-d"))));
								$date_in = date("Y-m-d");

								$date_later = date('Y-m-d', strtotime('+12 months', strtotime(date("Y-m-d"))));
								?>
								<div class="col-md-4">
									<input type="date" class="form-control"
									value="{{ $date_back }}"
									name="tgl_awal"
									id="tgl_awal">
								</div>
								<div class="col-md-4">
									<input type="date" class="form-control"
									name="tgl_akhir"
									id="tgl_akhir"
									value="{{ $date_in }}">
								</div>
							</div>
							<div class="form-group">
								<label for="laporan" style="text-align: right;" class="col-md-3 control-label">
									Laporan :
								</label>
								<div class="col-md-8">
									<select data-placeholder="Pilih Laporan dalam Bentuk" class="select22" name="laporan" id="laporan" style="width: 100%">
										<option value="1" selected="">Per Tahun</option>
										<option value="2">Per Bulan</option>
									</select>
								</div>
							</div>
							<div class="form-group"<?php echo $discol; ?>>
								<label for="limit" style="text-align: right;" class="col-md-3 control-label">
									Banyak Data :
								</label>
								<div class="col-md-8">
									<input type="number" class="form-control" name="limit" id="limit" min="1"
									value="10">
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
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Laporan Per Member</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group" id="div_tabel_per_member">

				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Laporan Kredit Poin</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>
			<div class="panel-body">
				<div class="form-group" id="div_tabel_kredit_poin">

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	if($('.select22').length){
        $('.select22').select2();
    }

	$('.btn_tampilkan').click();
</script>
@endsection