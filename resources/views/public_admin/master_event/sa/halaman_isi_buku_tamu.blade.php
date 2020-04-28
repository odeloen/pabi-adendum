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
				<form class="form-horizontal" enctype="multipart/form-data" id="formUpdateBukuTamuAdmin">
					<div class="modal-body">
						<div class="form-group">
							{{ csrf_field() }}
						</div> 
						<div class="form-group">
							<table class="table table-hover datatable-basic">
								<thead>
									<tr>
										<th width="1%">No</th> 
										<th>Nama Member</th> 
										<th width="15%">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 0; ?>
									@foreach ($data_buku_tamu as $r) 
									<?php
									$stat_checked ='';
									if($r['status_hadir']==1){
										$stat_checked = 'checked = "checked"';    
									}

									$acc_member ='';
									if($r['status_acc']==1){
										$acc_member = 'checked = "checked"';    
									}
									$no ++;
									$id = $r['id'];
									?>
									<tr>
										<td>{{$no}}</td> 
										<td>{{ $r['member_firstname'] }} {{ $r['member_lastname'] }} ({{ $r['member_nickname'] }})</td> 
										<td>
											<input type="hidden" name="id_buku_tamu_{{$no}}" id="id_buku_tamu_{{$no}}" value="{{$id}}">
											<select data-placeholder="Pilih Admin Cabang" class=" " name="member_acc_{{$no}}" id="member_acc_{{$no}}" style="width: 100%">
												<option value="0">Belum Di Konfirmasi</option>
												<option value="1" <?php if ($r['status_acc'] == 1) { echo 'selected=""'; } ?>>
													Sudah Di Konfirmasi
												</option>
												<option value="2" <?php if ($r['status_acc'] == 2) { echo 'selected=""'; } ?>>
													Ditolak
												</option>
											</select>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>                   
					</div>
					<div class="modal-footer">
						<input type="hidden" name="jumlah_data" id="jumlah_data" value="{{$no}}">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
						<a class="btn btn-primary btn-ladda btnFormUpdateBukuTamuAdmin" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" onclick="simpan_form_update_buku_tamu_admin('{{csrf_token()}}', '.btnFormUpdateBukuTamuAdmin')">
							<i class="icon-check"></i> Simpan
						</a>
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