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
				<h6 class="panel-title">Master Data Admin Cabang</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div>
					<a class="btn btn-info" onclick="tambah_modal_admin_cabang('{{csrf_token()}}', '#ModalBiruSm')">Tambah Data <i class="icon-plus3 position-right"></i></a>
				</div>
				<br>
				<div class="">
					<table class="table table-bordered table-hover datatable-basic">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Nama</th>
								<th>Kode Bandara</th>
								<th>Deskripsi</th>
								<th style="width: 1%">Act</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 0;
							?>
							@foreach ($data_admin_cabang as $r) 
							@php
							$no ++;
							$id = $r['id'];
							@endphp
							<tr>
								<td>{{$no}}</td>
								<td>{{$r['name']}}</td>
								<td>{{$r['kode_bandara']}}</td>
								<td> {{$r['description']}} </td> 
								<td>
									<div class="btn-group btn-block btn-group-velocity">
										<button type="button" class="btn bg-blue btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i>  <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li>
												<button type="button" onclick="
												update_modal_admin_cabang('{{csrf_token()}}', '{{ $id }}', '#ModalTealSm')
												" id="modal_update_barang" class="btn bg-teal-400 btn-xs btn-block">
												<i class="glyphicon glyphicon-edit"></i>Edit</button> 
											</li> 
											<li>
												<button type="button" onclick="delete_master_admin_cabang('{{csrf_token()}}','{{ $id }}')"
												data-toggle="modal" class="btn btn-danger btn-xs btn-block">
												<i class="glyphicon glyphicon-remove"></i> Hapus</button>
											</li>
										</ul>
									</div> 
								</td>
							</tr> 
							@endforeach
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