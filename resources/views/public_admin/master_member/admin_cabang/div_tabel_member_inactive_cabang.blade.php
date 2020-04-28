@include('public_admin.include.function')
<div class="row"> 
	<?php 
	$no = 0;
	?>
	@if (sizeof($data_member) > 0)
	@foreach ($data_member as $r)
	@php
	$no ++;
	$id = $r['id'];
	$status_active = $r['status_active'];
	$user_id = $r['user_id'];
	@endphp
	<div class="col-md-3">

		<!-- User details -->
		<div class="content-group">
			<div class="panel-body  bg-indigo border-radius-top text-center" style="padding: 0px !important ">
				<h6 class="panel-title">
					<span class="badge badge-flat border-grey text-grey-300" style="color: white !important">{{ $no }}</span> 
				</h6> 
			</div>
			<div class="panel-body bg-indigo border-radius-top text-center" style=" background-size: contain; padding: 0px !important;">
				<div class="content-group-sm">
					<h6 class="text-semibold no-margin-bottom" style="height: 30px; vertical-align: center !important; ">
						{{ $r['firstname'] }} {{ $r['lastname'] }}
					</h6>

					<span class="display-block">
						@if(!empty($r['nickname']))
						{{ $r['nickname'] }}
						@else
						&nbsp;
						@endif
					</span>
				</div>

				<?php  
                if (does_url_exists(env('URL_API_IP') . $r['image_thumb_compress']) == 1 && !empty($r['image_thumb_compress'])) {
                    ?>
                    <a href="{{env('URL_API_IP')}}{{ $r['image_thumb'] }}" target="_blank" class="display-inline-block content-group-sm"> 
						<img src="{{env('URL_API_IP')}}{{ $r['image_thumb_compress'] }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>
                    <?php
                } else {
                	if($r['gender'] == 'P'){ 
                	?>
					<a href="#" class="display-inline-block content-group-sm">
						<img src="{{ asset('assets/images/profile_member/member_pr.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
					</a>
                	<?php 
                	} else {
                	?>
					<a href="#" class="display-inline-block content-group-sm">
						<img src="{{ asset('assets/images/profile_member/deafult_profile.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
					</a>
                	<?php 
                	}
                }
                ?>  

                <div class="content-group-sm">
					<span class="display-block">
						@if(!empty($r['alasan_non_aktif']))
						{{ $r['alasan_non_aktif'] }}
						@else
						&nbsp;
						@endif
					</span>
				</div>

				<ul class="list-inline list-inline-condensed no-margin-bottom" style="display: none;">
					<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-google-drive"></i></a></li>
					<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-twitter"></i></a></li>
					<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-github"></i></a></li>
				</ul>
			</div>

			<div class="panel no-border-top no-border-radius-top">
				<div class="panel-body">
					<div class="form-group" style="height: 130px; overflow: auto;">
						<label for="limit" class="col-md-12 control-label">
							Nama Lengkap : 
							<br><b>{{ $r['firstname'] }} {{ $r['lastname'] }} {{$r['gelar'] }}</b><br>
							Jabatan : 
							<br><b>{{ $r['jabatan'] }}</b> <br>
							Nomor Anggota : 
							<br><b>{{$r['card_no']}}</b>
						</label> 
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<div class="text-left">
									<button style="display: none;" type="button" class="btn bg-indigo btn-labeled btn-rounded"><b><i class="icon-search4"></i></b> Detail</button>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="text-right">
									<div class="btn-group btn-block btn-group-velocity">
										<button type="button" class="btn bg-blue btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i>  <span class="caret"></span></button>
										<ul class="dropdown-menu"> 
											<li style="display: none;">
												<button style="display: none" type="button" onclick="
												update_modal_verif_cabang('{{csrf_token()}}', '{{ $id }}', '#ModalTealSm')
												" id="modal_update_barang" class="btn bg-teal-400 btn-xs btn-block">
												<i class="icon-check"></i>Verifikasi</button> 
											</li>  
											<li style="display: none;">
												<button type="button" onclick="detail_pengajuan('{{csrf_token()}}', '{{ $id }}')" data-toggle="modal" class="btn bg-info btn-xs btn-block">
													<i class="icon-book"></i> Detail Pengajuan
												</button>
											</li>
											<li style="display: none;">
												<button type="button" onclick="
												edit_modal_keanggotaan('{{csrf_token()}}', '#ModalKuning', '{{ $id }}')
												" id="modal_update_barang" class="btn btn-warning btn-xs btn-block">
												<i class="glyphicon glyphicon-edit"></i> Edit Data Pengajuan</button> 
											</li>
											@if(session('pabi_role_id') < 4)
											<li style="display: none;">
												<button type="button" onclick="
												update_reset_password_member_by_sa('{{csrf_token()}}', '{{ $id }}', '#ModalTealSm')
												" id="modal_update_barang" class="btn bg-indigo-400 btn-xs btn-block">
												<i class="glyphicon glyphicon-check"></i> Reset Password</button> 
											</li>
											<li>
												<button type="button" onclick="inactive_master_member('{{csrf_token()}}','{{ $id }}','#ModalBrownSm', 'admin/master_member_inactive_cabang')" data-toggle="modal" class="btn bg-brown-400 btn-xs btn-block">
													<i class="glyphicon glyphicon-pencil"></i> Ubah Status
												</button>
											</li>
											<li>
												<button type="button" onclick="if ({{$status_active}} == 1) { alert('Harap Non Aktifkan Status dari member ini!'); } else { delete_master_member('{{csrf_token()}}','{{ $id }}'); }"
												data-toggle="modal" class="btn btn-danger btn-xs btn-block">
												<i class="glyphicon glyphicon-remove"></i> Hapus</button>
											</li>
											@endif
										</ul>
									</div> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /user details -->							
 
	</div>
	@endforeach
	@else
	<div class="col-md-12">
		<h5>Tidak Ada Data</h5>
	</div> 
	@endif
</div>

@if(1==0)
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
						@if(session('pabi_role_id') == 1)
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
						@endif
					</ul>
				</div> 
			</td>
		</tr>  
		@endforeach
		@endif
	</tbody>
</table>
@endif