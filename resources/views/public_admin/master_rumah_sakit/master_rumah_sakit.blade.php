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
				<h6 class="panel-title">Master Data Rumah Sakit </h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div>
					<a class="btn btn-info" onclick="tambah_modal_rumah_sakit('{{csrf_token()}}', '#ModalBiruSm')">Tambah Data <i class="icon-plus3 position-right"></i></a>
				</div>
				<br>
				<div class="">
					<table class="table table-bordered table-hover datatable-basic">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th>Foto</th>
								<th>Nama</th>
								<th>Telp</th>
								<th>Alamat</th>
								<th style="width: 50px !important">Act</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 0;
							?>
							@foreach ($data_rs as $r) 
							@php
							$no ++;
							$id = $r['id'];
							$user_id = $r['user_id'];
							@endphp
							<?php
							$status_active = '<span class="label label-flat border-danger text-danger-600">Tidak Aktif</span>';
							if($r['status_active']  == 1 ){
								$status_active = '<span class="label label-flat border-success text-success-600">Aktif</span>';
							}
							?>
							<tr>
								<td>{{$no}}</td>
								<td>
					                <?php 
					                if (does_url_exists(env('URL_API_IP') . $r['img_logo']) == 1 && !empty($r['img_logo'])) {
					                    ?>
					                    <a href="{{env('URL_API_IP')}}{{$r['img_logo']}}" target="_blank" class="display-inline-block content-group-sm"> 
					                        <img src="{{env('URL_API_IP')}}{{$r['img_logo']}}"
					                             style="width: 200px;" class="img-circle img-responsive" alt=""> 
					                    </a>
					                    <?php
					                } else {
					                	?>
					                    <a href="#" class="display-inline-block content-group-sm">
					                        <img src="{{ asset('assets/images/rs_default.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
					                    </a>
					                	<?php 
					                }
					                ?> 
                				</td>
                				<td>
                					<b>Rumah Sakit : </b>{{$r['nama']}}
                					<br><b>Username : </b>{{$r['username']}}
                					<br><b>E-Mail : </b>{{$r['email']}}
                					<br><b>Status : </b>{!! $status_active!!}
                				</td>
								<td>{{$r['telpon']}}</td>
								<td>{{$r['alamat']}}</td> 
								<td>  
									<button type="button" onclick="edit_modal_rumah_sakit('{{csrf_token()}}', '{{ $id }}', '#ModalTealSm')" id="modal_update_barang" class="btn bg-teal-400 btn-xs btn-block">
										<i class="glyphicon glyphicon-edit"></i>
									</button> 

									<button type="button" onclick="edit_modal_akun_rs('{{csrf_token()}}','{{ $user_id }}','#ModalBrownSm')" data-toggle="modal" class="btn bg-brown-400 btn-xs btn-block">
										<i class="glyphicon glyphicon-wrench"></i>
									</button>

									<button type="button" onclick="reset_password_rs('{{csrf_token()}}', '{{ $user_id }}', '#ModalIndigoSm')" class="btn bg-indigo-400 btn-xs btn-block">
										<i class="glyphicon glyphicon-lock"></i>
									</button>

									<button type="button" onclick="delete_master_rumah_sakit('{{csrf_token()}}','{{ $id }}')" data-toggle="modal" class="btn btn-danger btn-xs btn-block">
										<i class="glyphicon glyphicon-remove"></i>
									</button> 
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