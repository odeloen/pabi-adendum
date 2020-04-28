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

		<!-- Panel Event -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Master Data Member</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				
				<div class="">
					<table class="table table-bordered table-hover datatable-basic">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Foto</th>
								<th>Nama</th>
								<th>Gelar</th>
								<th>Lahir</th>
								<th>Gender</th>
								<th>Alamat</th>
								<th>Hobi</th>
								<th>Act</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 0;
							?>
							@if ($data_member !== null)
							@foreach ($data_member as $r)  
							@php
							$no ++;
							$id = $r['id'];
							@endphp
							<tr>
								<td>{{ $no }}</td>
								<td><img src="{{env('URL_API_IP')}}{{$r['image_thumb']}}" width="50" height="50"></td>
								<td> {{ $r['firstname'] }} {{ $r['lastname'] }} ({{ $r['nickname'] }})</td>
								<td> {{ $r['gelar'] }} </td>
								<td> {{ $r['tempat_lahir'] }}, {{ $r['tgl_lahir'] }} </td>
								<td> {{ $r['gender'] }} </td>
								<td> {{ $r['alamat_rumah'] }} <br> {{ $r['kota'] }}</td>
								<td> {{ $r['hobi'] }} </td> 
								<td>
									<div class="btn-group btn-block btn-group-velocity">
										<button type="button" class="btn bg-blue btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i>  <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li>
												<button type="button" onclick="
												update_modal_master_member('{{csrf_token()}}', '{{ $id }}', '#ModalTeal')
												" id="modal_update_barang" class="btn bg-teal-400 btn-xs btn-block">
												<i class="glyphicon glyphicon-search"></i>Detail</button> 
											</li> 
											<li>
												<button type="button" onclick="histori_master_member('{{csrf_token()}}', '{{ $id }}', '#ModalBrown')" data-toggle="modal" class="btn bg-brown btn-xs btn-block">
													<i class="glyphicon glyphicon-book"></i> Histori Pengajuan
												</button>
											</li>
											<li>
												<button type="button" onclick="inactive_master_member('{{csrf_token()}}','{{ $id }}')" data-toggle="modal" class="btn btn-warning btn-xs btn-block">
													<i class="glyphicon glyphicon-edit"></i> Ubah Status
												</button>
											</li>
											<li>
												<button type="button" onclick="if (1 == 1) { alert('Harap Non Aktifkan Status dari member ini!'); } else { delete_master_member('{{csrf_token()}}','{{ $id }}'); }"
												data-toggle="modal" class="btn btn-danger btn-xs btn-block">
												<i class="glyphicon glyphicon-remove"></i> Hapus</button>
											</li>
										</ul>
									</div> 
								</td>
							</tr>  
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Panel Event -->

	</div>
</div>
<!-- /main charts -->		

@endsection