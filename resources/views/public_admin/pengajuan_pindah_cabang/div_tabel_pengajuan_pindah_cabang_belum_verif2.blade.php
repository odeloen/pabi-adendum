@include('public_admin.include.function')
<div class="row"> 
	<?php 
	$no = 0;
	?>
	@if (sizeof($data_pindah_cabang) > 0)
	@foreach ($data_pindah_cabang as $r)  
	@php
	$no ++;
	$id = $r['pindah_cabang_id'];
	$member_id = $r['id'];
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
					<h6 class="text-semibold no-margin-bottom">
						{{ $r['firstname'] }} {{ $r['lastname'] }}
					</h6>

					<span class="display-block">
						{{ $r['nickname'] }}
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
										<button type="button" class="btn bg-blue btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i><span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li>
												<button type="button" onclick="
												modal_detail_verif_pindah_cabang('{{csrf_token()}}', '{{$member_id}}', '#ModalGreenSm')
												" id="modal_update_barang" class="btn bg-green-400 btn-xs btn-block">
												<i class="icon-search4"></i> Detail Data</button>
											</li> 
											<li>
												<button type="button" onclick="
												modal_verif_pindah_cabang2('{{csrf_token()}}', '{{$id}}', '{{$member_id}}', '#ModalTealSm')
												" id="modal_update_barang" class="btn bg-teal-400 btn-xs btn-block">
												<i class="icon-check"></i> Verifikasi</button> 
											</li>
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