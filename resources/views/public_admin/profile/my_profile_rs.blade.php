@extends('public_admin.index')
@section('tempat_content')  
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

	<div class="col-md-8"> 
		<!-- Panel Ganti Username & Email -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Ganti Username & E-Mail </h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<form id="formUbahAkunMasterRS" method="post" action="{{ route('simpan_edit_modal_akun_rs', $data_user['id']) }}" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						{{ csrf_field() }}
						<input type="hidden" name="halaman" id="halaman" value="profile">
						<input type="hidden" name="admin_pusat_id" id="admin_pusat_id" value="{{$data_user['admin_pusat_id']}}">
						<input type="hidden" name="admin_cabang_id" id="admin_cabang_id" value="{{$data_user['admin_cabang_id']}}">
					</div> 
					<div class="form-group">
						<label for="username" style="text-align: right;" class="col-md-4 control-label">
							Username <span style="color:red"><b>*</b></span> : 
						</label>
						<div class="col-md-7"> 
							<input type="text" class="form-control" name="username" id="username" required="" value="{{$data_user['username']}}">
						</div>
					</div>
					<div class="form-group">
						<label for="email" style="text-align: right;" class="col-md-4 control-label">
							E-mail <span style="color:red"><b>*</b></span> : 
						</label>
						<div class="col-md-7"> 
							<input type="email" class="form-control" name="email" id="email" required="" value="{{$data_user['email']}}">
						</div>
					</div> 

					<div class="text-right">
						<button type="submit" class="btn btn-indigo">Ubah <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
			</div>
		</div>
		<!-- Panel Ganti Username & Email -->

		<!-- Panel Ganti Password -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Ganti Password </h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<form method="post" action="{{ route('simpan_ganti_password_rs', $data_user['id']) }}" class="form-horizontal" onsubmit="if ($('#new_password').val() == $('#new_password_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }">
					<div class="form-group">
						{{ csrf_field() }}
					</div> 
					<div class="form-group">
						<label for="old_password" style="text-align: right;" class="col-md-4 control-label">
							Old Password : 
						</label>
						<div class="col-md-7"> 
							<input type="password" class="form-control" name="old_password" id="old_password" required="" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="new_password" style="text-align: right;" class="col-md-4 control-label">
							New Password : 
						</label>
						<div class="col-md-7"> 
							<input type="password" class="form-control" name="new_password" id="new_password" required="" value="">
						</div>
					</div> 
					<div class="form-group">
						<label for="new_password_confirmation" style="text-align: right;" class="col-md-4 control-label">
							Repeat New Password : 
						</label>
						<div class="col-md-7"> 
							<input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" required="" value="">
						</div>
					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-indigo">Ubah <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
			</div>
		</div>
		<!-- Panel Ganti Password -->

	</div>

	<div class="col-md-4">

		<!-- User details -->
		<div class="content-group">
			<div class="panel-body bg-indigo border-radius-top text-center" style=" background-size: contain;">
				<div class="content-group-sm">
					<h6 class="text-semibold no-margin-bottom">
						{{ $data_rs['nama'] }}
					</h6>

					<span class="display-block">Hospital of PABI</span>
				</div>

				<?php  
                if (does_url_exists(env('URL_API_IP') . request()->session()->get('pabi_image')) == 1 && !empty(request()->session()->get('pabi_image'))) {
                    ?>
                    <a href="{{env('URL_API_IP')}}{{ request()->session()->get('pabi_image')}}" target="_blank" class="display-inline-block content-group-sm"> 
						<img src="{{env('URL_API_IP')}}{{ request()->session()->get('pabi_image')}}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>
                    <?php
                } else {
                	?>
					<a href="#" class="display-inline-block content-group-sm">
						<img src="{{ asset('assets/images/profile_member/deafult_profile.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
					</a>
                	<?php 
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
					<form id="formTambahMasterRS" method="post" action="{{ route('simpan_edit_rumah_sakit', $data_rs['id']) }}" class="form-horizontal" enctype="multipart/form-data" >
						<div class="form-group">
							{{ csrf_field() }}
							<input type="hidden" name="halaman" id="halaman" value="profile">
						</div>  
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label for="nama">
										Nama <span style="color:red"><b>*</b></span> : 
									</label> 
									<input required="required" type="text" class="form-control" name="nama" value="{{ $data_rs['nama'] }}">  
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label for="deskripsi">
										Telp <span style="color:red"><b>*</b></span> : 
									</label>  
									<input required="" type="text" class="form-control" name="telpon" value="{{ $data_rs['telpon'] }}">  
								</div>
							</div>
						</div> 
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>
										Alamat : 
									</label> 
									<textarea name="alamat" id="alamat" class="form-control" rows="3">{{ $data_rs['alamat'] }}</textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label for="prov_id">
										Provinsi <span style="color:red"><b>*</b></span> : 
									</label> 
									<select required="" data-placeholder="Pilih Provinsi" class="select22" style="width: 100%" name="prov_id" id="prov_id" onchange="kota_by_provinsi_id('{{csrf_token()}}', '#formTambahMasterRS', 0)">
										<option value="">-- Pilih Provinsi --</option> 
										@foreach ($data_provinsi as $dp)
										<?php
										$selected="";
										if($dp['id_prov'] == $data_rs['id_provinsi']){
											$selected = "selected";
										}
										?>
										<option {{ $selected }} value="{{ $dp['id_prov'] }}">{{ $dp['nama'] }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label for="kota_id">
										Kabupaten/Kota <span style="color:red"><b>*</b></span> : 
									</label>
									<select required="" class="select22" style="width: 100%" name="kota_id" id="kota_id" required="" onchange="kecamatan_by_kota_id('{{csrf_token()}}', '#formTambahMasterRS', 0, 0)">
										<option value="">-- Pilih Kabupaten/Kota  --</option> 
										@foreach ($data_kab as $dp)
										<?php
										$selected="";
										if($dp['id'] == $data_rs['id_kabupaten_kota']){
											$selected = "selected";
										}
										?>
										<option {{ $selected }} value="{{ $dp['id'] }}">{{ $dp['nama'] }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div> 
						<div class="form-group">
							<div class="row">
								<div class="col-md-12">
									<label>
										Logo : 
									</label> 
									<input type="file" class="form-control" value="" id="img_logo" name="img_logo">  
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<div class="text-left">
										<button style="display: none;" type="button" class="btn bg-indigo btn-labeled btn-rounded"><b><i class="icon-search4"></i></b> Detail</button>
									</div>
								</div>
								<div class="col-md-6">
									<div class="text-right">
										<button type="submit" class="btn bg-indigo btn-labeled btn-rounded"><b><i class="icon-check"></i></b> Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /user details -->							

	</div>
</div>
<!-- /main charts -->

@endsection
