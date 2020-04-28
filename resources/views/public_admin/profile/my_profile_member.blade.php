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
		<?php
		$cek_pengajuan = 'tidak';
		if ($data_member['cabang_verif'] !== null || $data_member['pusat_verif'] !== null ) {
			$cek_pengajuan = 'ya';
		}
		if ($data_member['cabang_verif'] == 2 && $data_member['pusat_verif'] == 2 ) {
			$cek_pengajuan = 'tidak';
		}
		?>

		<input type="hidden" name="pengajuan_status" value="{{ $cek_pengajuan }}" id="pengajuan_status">

		<!-- KARTU ANGGOTA -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Kartu Anggota</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div>
					@include('public_admin.profile.kartu_anggota')
					<!-- <img src="{{ asset('kartu_anggota/7.jpg')}}"> -->
				</div>
			</div>
		</div>
		<!-- KARTU ANGGOTA -->

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
				<form method="post" action="{{ route('simpan_ganti_username_email_member', $data_user['id']) }}" class="form-horizontal">
					<div class="form-group">
						{{ csrf_field() }}
					</div> 
					<div class="form-group">
						<label for="username" style="text-align: right;" class="col-md-4 control-label">
							Username : 
						</label>
						<div class="col-md-7"> 
							<input type="text" class="form-control" name="username" id="username" required="" value="{{$data_user['username']}}">
						</div>
					</div>
					<div class="form-group">
						<label for="email" style="text-align: right;" class="col-md-4 control-label">
							E-mail : 
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
				<form method="post" action="{{ route('simpan_ganti_password_member', $data_user['id']) }}" class="form-horizontal" onsubmit="if ($('#new_password').val() == $('#new_password_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }">
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
						{{ $data_member['firstname'] }} {{ $data_member['lastname']  }}
					</h6>

					<span class="display-block">Member of PABI</span>
				</div>

				<?php  
                if (does_url_exists(env('URL_API_IP') . request()->session()->get('pabi_image')) == 1 && !empty(request()->session()->get('pabi_image'))) {
                    ?>
                    <a href="{{env('URL_API_IP')}}{{ request()->session()->get('pabi_image')}}" target="_blank" class="display-inline-block content-group-sm"> 
						<img src="{{env('URL_API_IP')}}{{ request()->session()->get('pabi_image')}}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>
                    <?php
                } else {
                	if(request()->session()->get('pabi_gender') == 'P'){ 
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
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Nama Lengkap</label>
								<input type="text" value="{{ $data_member['firstname'] }} {{ $data_member['lastname']  }}" class="form-control" readonly="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Nomer Kartu</label>
								<input type="text" value="{{ $data_member['card_no'] }}" class="form-control" readonly="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Kantor</label>
								<input type="text" value="{{ $data_member['tempat_kerja'] }}" class="form-control" readonly="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Telepon</label>
								<input type="text" value="{{ $data_member['no_telp'] }}" class="form-control" readonly="">
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
							<?php
							/*
							<div class="col-md-6">
								<div class="text-right">
									<button type="button" class="btn bg-indigo btn-labeled btn-rounded" onclick="if ($('#pengajuan_status').val() == 'ya') { alert('Masih dalam tahap pengajuan'); } else { edit_modal_my_profile_member('{{csrf_token()}}', '#ModalTeal') }"><b><i class="icon-pencil"></i></b> Edit</button>
								</div>
							</div>
							*/
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /user details -->							

	</div>
</div>
<!-- /main charts -->

@endsection
