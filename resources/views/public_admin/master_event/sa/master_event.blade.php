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
				<form onsubmit="div_tabel_event_pusat('{{csrf_token()}}', '#div_tabel_event_pusat'); return false;" class="form-horizontal" enctype="multipart/form-data" id="formFilterDataMasterEventPusat">
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
									<select data-placeholder="Pilih Admin Pusat" class="select22" name="admin_pst_id" id="admin_pst_id" style="width: 100%">
										<!-- <option value="0">-- Select Admin Pusat--</option>  -->
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
								<label align="right" style="text-align: right" class="control-label col-lg-3">
									Tanggal Event :
								</label>
								<?php
								$date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -12 months");
								$date = date("Y-m-d", $date);

								$date_later = date('Y-m-d', strtotime('+12 months', strtotime(date("Y-m-d"))));
								?>
								<div class="col-lg-4">
									<input type="date" class="form-control"
									value="{{ $date }}"
									name="tgl_event_awal"
									id="tgl_event_awal">
								</div>
								<div class="col-lg-1">
									s/d
								</div>
								<div class="col-lg-4">
									<input type="date" class="form-control"
									name="tgl_event_akhir"
									id="tgl_event_akhir"
									value="{{ $date_later }}">
								</div>
							</div>
							<div class="form-group">
								<label for="limit" style="text-align: right;" class="col-lg-3 control-label">
									Banyak Data : 
								</label>
								<div class="col-lg-9">
									<input type="number" class="form-control" name="limit" id="limit" min="1" value="100">
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
				<h6 class="panel-title">Master Event</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div>
					<a class="btn btn-info" onclick="tambah_modal_event('{{csrf_token()}}', '#ModalBiru')">Tambah Data <i class="icon-plus3 position-right"></i></a>
				</div>
				<br>
				<div class="form-group" id="div_tabel_event_pusat">

				</div>
			</div>
		</div>
		<!-- /Panel Event -->

	</div>
</div>
<!-- /main charts -->
<script type="text/javascript">
	$('.btn_tampilkan').click();
</script>
@endsection