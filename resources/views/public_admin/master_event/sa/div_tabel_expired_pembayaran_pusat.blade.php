@include('public_admin.include.function')
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
		<form class="form-horizontal" enctype="multipart/form-data" id="formUpdateKehadiranAdmin">
			<div class="modal-body">
				<div class="form-group">
					{{ csrf_field() }}
				</div>
				<div class="form-group">
					<table class="table table-hover table-bordered datatable-basic">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Event</th>
								<th>Member</th>
								<th>Total Harus Dibayar</th>
								<th width="1%">Status Pembayaran</th>
								<th width="1%">Act</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0; ?>
							@foreach ($data_buku_tamu as $r)
							<?php
							if ($r['status_pengajuan_bayar'] == 1 || $r['status_bayar'] == 3) {
								$stat_checked = '';
								if ($r['status_acc'] == 1) {
									$stat_checked = 'checked = "checked"';
								}
								$no++;
								$id = $r['id'];
								?>
								<tr>
									<td>{{$no}}</td>
									<td>
										<b> 
											{{ $r['nama_event'] }} <br>
											<?= tgl_indo($r['tgl_event']); ?>
										</b>
									</td>
									<td> 
										<b>
											{{ $r['member_firstname'] }}
											{{ $r['member_lastname'] }} 
										</b>

									</td>
									<td>
										<b>Rp{{number_format($r['nominal_bayar']+$r['kode_unik'],0,",",".")}}</b>
									</td>
									<td>
										<input type="hidden" name="id_buku_tamu_{{$no}}"
										id="id_buku_tamu_{{$no}}" value="{{$id}}">
										<div class="form-group">
											<div class="col-lg-3">
												<div class="onoffswitch_expired">
													<input {{ $stat_checked }} type="checkbox"
													onclick="set_status_bayar_menunggu_bayar('{{csrf_token()}}','{{$id}}','#status_bayar{{$no}}') "
													class="onoffswitch_expired-checkbox"
													name="status_bayar{{$no}}" id="status_bayar{{$no}}"
													value="1">
													<label class="onoffswitch_expired-label" for="status_bayar{{$no}}">
														<span class="onoffswitch_expired-inner"></span>
														<span class="onoffswitch_expired-switch"></span>
													</label>
												</div>
											</div>
										</div>
									</td>
									<td>
										<div class="btn-group heading pull-right btn-group-velocity">
											<button type="button" class="btn bg-blue btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i>  <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li>
													<?php  
													$key=$r['event_id'].'$$|$$'.$r['tgl_event'];
													$keyenc = hamdi_encrypt($key, 'progstyle2020');
													$url = URL::to("/admin/master_event/".$keyenc."/halaman_detail_event"); ?>
													<button type="button" onclick="halaman_detail_event('{{$url}}')" class="btn btn-info btn-xs btn-block">
														<i class="glyphicon glyphicon-search"></i> Detail Event
													</button>
												</li>  
												<li> 
													<button type="button" onclick="detail_pengajuan('{{csrf_token()}}', '<?= $r['member_id']; ?>');" class="btn bg-brown-400 btn-xs btn-block">
														<i class="glyphicon glyphicon-user"></i> Detail Member
													</button>  
												</li> 
											</ul>
										</div>
									</td>
								</tr>
							<?php } ?>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /main charts -->
<script type="text/javascript">
	if ($('.select22').length) {
		$('.select22').select2();
	}
	// START SCRIPT TABEL
	$.extend($.fn.dataTable.defaults, {
		autoWidth: false,
		columnDefs: [{
			orderable: false,
			width: '100px'
		}],
		dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
		language: {
			search: '<span>Filter:</span> _INPUT_',
			// searchPlaceholder: 'Type to filter...',
			lengthMenu: '<span>Menampilkan :</span> _MENU_',
			paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
		},
		drawCallback: function () {
			$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
		},
		preDrawCallback: function () {
			$(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
		}
	});
	$('.datatable-basic').DataTable();
	// END SCRIPT TABEL 
</script>