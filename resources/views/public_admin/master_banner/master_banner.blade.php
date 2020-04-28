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

		<!-- Panel Event -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Master Data Banner </h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div>
					<a class="btn btn-info" onclick="tambah_modal_banner('{{csrf_token()}}', '#ModalBiru')">Tambah Data <i class="icon-plus3 position-right"></i></a>
				</div>
				<br>
				<div class="">
					<table class="table table-bordered table-hover datatable-basic">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Judul</th>
								<th>Isi</th>
								<th>Lokasi Isi</th>
								<th>Foto</th>
								<th style="width: 50px !important">Act</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 0;
							?>
							@foreach ($data_banner as $r) 
							@php
							$no ++;
							$id = $r['id'];

							$posisi_isi = 'Kiri';
							if($r['posisi_isi'] == 2){
								$posisi_isi = "Kanan";
							}
							@endphp
							<tr>
								<td>{{$no}}</td> 
								<td><?= $r['judul'] ?></td> 
								<td><?= $r['isi'] ?></td> 
								<td>{{$posisi_isi}}</td>
								<td> 
				                    <a href="{{env('URL_API_IP')}}{{$r['image_banner']}}" target="_blank" class="display-inline-block content-group-sm"> 
				                        <img src="{{env('URL_API_IP')}}{{$r['image_banner_compress']}}"
				                             style="width: 200px;" class="img-circle img-responsive" alt=""> 
				                    </a> 
                				</td>  
								<td>  
									<button type="button" onclick="
									edit_modal_banner('{{csrf_token()}}', '{{ $id }}', '#ModalTeal')
									" id="modal_update_barang" class="btn bg-teal-400 btn-xs btn-block">
									<i class="glyphicon glyphicon-edit"></i></button> 
									<button type="button" onclick="delete_master_banner('{{csrf_token()}}','{{ $id }}')"
									data-toggle="modal" class="btn btn-danger btn-xs btn-block">
									<i class="glyphicon glyphicon-remove"></i></button> 
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