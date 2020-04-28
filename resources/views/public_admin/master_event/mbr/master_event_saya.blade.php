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
				<form onsubmit="div_tabel_event_saya_member('{{csrf_token()}}', '#div_tabel_event_saya_member'); return false;" class="form-horizontal" enctype="multipart/form-data" id="formFilterMemberEventSaya">
					<div class="row">
						<div class="col-lg-2">&nbsp;</div>
						<div class="col-lg-7">
							<div class="form-group">
								<label align="right" style="text-align: right" class="control-label col-lg-3">
									Tanggal Event :
								</label>
								<?php
								// $date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -90 days");
								$date = date("Y-m-d");
								
								$date_later = date('Y-m-d', strtotime('+12 months', strtotime(date("Y-m-d"))));
								$date_yesterday = date('Y-m-d', strtotime('-90 days', strtotime(date("Y-m-d"))));
								?>
								<div class="col-lg-4">
									<input type="date" class="form-control"
									       value="{{ $date_yesterday }}"
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
									<input type="number" class="form-control" name="limit" id="limit" min="1"
									       value="100">
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label for="member_id" style="text-align: right;" class="col-lg-3 control-label">
									Member :
								</label>
								<div class="col-lg-9">
									<input type="hidden" name="member_id" id="member_id"
									       value="{{session('pabi_member_id')}}">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">&nbsp;</div>
						<div class="col-lg-6">
							<button title="Tampilkan" type="submit" class="btn btn-primary btn-sm btn-block btn_tampilkan"  >
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
				<h6 class="panel-title">Event Saya <b>Menunggu</b> Bayar</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>

					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div class="form-group" id="div_tabel_event_saya_member">

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