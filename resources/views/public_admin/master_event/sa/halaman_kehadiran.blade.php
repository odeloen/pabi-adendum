@extends('public_admin.index')
@section('tempat_content')
@include('public_admin.include.function')
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
		<!-- Panel Buku Tamu -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Buku Tamu</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>

					</ul>
				</div>
			</div>

			<div class="panel-body">
				<form class="form-horizontal" enctype="multipart/form-data" id="formUpdateKehadiranAdmin">
					<div class="modal-body">
						<?php

						$tgl_event = tgl_indo($data_event['tgl_event']);
						$str_penyelenggara = $data_event['admin_pusat_description'];
						if(empty($str_penyelenggara)){
							$str_penyelenggara = $data_event['admin_cabang_description'];
						}
						?> 
						<h3 class="text-semibold mb-5">
							<a href="#" class="text-default">
								{{ $data_event['nama_event'] }}
							</a>
						</h3>
						<div class="text-size-mini-hamdi">
							<i class="icon-calendar text-size-small"></i> &nbsp;{{ $tgl_event }}
							&nbsp;&nbsp;&nbsp;&nbsp;
							<i class="icon-alarm text-size-small"></i> &nbsp;{{ date('H:i', strtotime($data_event['jam_mulai'])) }} - {{ date('H:i', strtotime($data_event['jam_selesai'])) }} 
							&nbsp;&nbsp;&nbsp;&nbsp;
							<i class="icon-pin text-size-small"></i> &nbsp;{{ $data_event['lokasi_alamat'] }} 
						</div> 
						<div class="form-group">
							{{ csrf_field() }}
						</div>
						<div class="form-group">
							<table class="table table-hover datatable-basic">
								<thead>
								<tr>
									<th width="1%">No</th>
									<th>Nama Member</th>
									<th width="15%">Set Status Hadir</th>
								</tr>
								</thead>
								<tbody>
								<?php $no = 0; ?>
								@foreach ($data_buku_tamu as $r)
								<?php
								if ($r['status_acc'] == 1 && $r['status_bayar'] == 1) {
									$stat_checked = '';
									if ($r['status_hadir'] == 1) {
										$stat_checked = 'checked = "checked"';
									}
									
									$acc_member = '';
									if ($r['status_acc'] == 1) {
										$acc_member = 'checked = "checked"';
									}
									$no++;
									$id = $r['id'];
									?>
									<tr>
										<td>{{$no}}</td>
										<td>{{ $r['member_firstname'] }} {{ $r['member_lastname'] }} ({{
											$r['member_nickname'] }})
										</td>
										<td>
											<input type="hidden" name="id_buku_tamu_{{$no}}"
											       id="id_buku_tamu_{{$no}}" value="{{$id}}">
											<div class="form-group">
												<div class="col-lg-3">
													<div class="onoffswitch_hadir">
														<input {{ $stat_checked }} type="checkbox"
														       class="onoffswitch_hadir-checkbox"
														       name="status_hadir_{{$no}}" id="status_hadir_{{$no}}"
														       value="1">
														<label class="onoffswitch_hadir-label"
														       for="status_hadir_{{$no}}">
															<span class="onoffswitch_hadir-inner"></span>
															<span class="onoffswitch_hadir-switch"></span>
														</label>
													</div>
												</div>
											</div>
										</td>
									</tr>
								<?php } ?>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="jumlah_data" id="jumlah_data" value="{{$no}}">
						<a href="{{ URL::previous() }}" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i>
							Kembali
						</a>
						<a class="btn btn-primary btn-ladda btnFormUpdateKehadiranAdmin" data-style="expand-left"
						   data-spinner-color="#333" data-spinner-size="20"
						   onclick="simpan_form_update_kehadiran_admin('{{csrf_token()}}', '.btnFormUpdateKehadiranAdmin')">
							<i class="icon-check"></i> Simpan</a>
					</div>
				</form>
			</div>
		</div>
		<!-- /Panel Buku Tamu -->

	</div>
</div>
<!-- /main charts -->
<script type="text/javascript">
	$('.btn_tampilkan').click();
</script>
@endsection