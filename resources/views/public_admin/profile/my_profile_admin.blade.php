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

	<div class="col-md-8">

		@if(session('pabi_role_id') != 1)
		<!-- Panel Ganti Data Rekening -->
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">Ganti Data Rekening </h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<form method="post" action="{{ route('simpan_ganti_rekening_admin', $data_admin['id']) }}" class="form-horizontal">
					<div class="form-group">
						{{ csrf_field() }}
					</div> 
					<div class="form-group">
						<label for="nama_bank" style="text-align: right;" class="col-md-4 control-label">
							Nama Bank : 
						</label>
						<div class="col-md-7"> 
							<input type="text" class="form-control" name="nama_bank" id="nama_bank" required="" value="{{$data_admin['nama_bank']}}">
						</div>
					</div>
					<div class="form-group">
						<label for="no_rek" style="text-align: right;" class="col-md-4 control-label">
							Nomor Rekening : 
						</label>
						<div class="col-md-7"> 
							<input type="text" class="form-control" name="no_rek" id="no_rek" required="" value="{{$data_admin['no_rek']}}">
						</div>
					</div> 
					<div class="form-group">
						<label for="pemilik_rek" style="text-align: right;" class="col-md-4 control-label">
							Nama Pemilik Rekening : 
						</label>
						<div class="col-md-7"> 
							<input type="text" class="form-control" name="pemilik_rek" id="pemilik_rek" required="" value="{{$data_admin['pemilik_rek']}}">
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-indigo">Ubah <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</form>
			</div>
		</div>
		<!-- Panel Ganti Data Rekening -->
		@endif

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
				<form method="post" action="{{ route('simpan_ganti_username_email_admin', $data_user['id']) }}" class="form-horizontal">
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
				<form method="post" action="{{ route('simpan_ganti_password_admin', $data_user['id']) }}" class="form-horizontal" onsubmit="if ($('#new_password').val() == $('#new_password_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }">
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
						{{ session('pabi_username') }}
					</h6>

					<span class="display-block">{{ session('pabi_role_name') }} of PABI</span>
				</div>

				<a href="#" class="display-inline-block content-group-sm">
					<img src="{{ asset('assets/images/profile_member/deafult_profile.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
				</a>

				<ul class="list-inline list-inline-condensed no-margin-bottom" style="display: none;">
					<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-google-drive"></i></a></li>
					<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-twitter"></i></a></li>
					<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-github"></i></a></li>
				</ul>
			</div>

			<div class="panel no-border-top no-border-radius-top">
				<div class="panel-body">
					@if(session('pabi_role_id') != 1)
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Admin</label>
								<input type="text" value="{{ $data_admin['name'] }}" class="form-control" readonly="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Deskripsi</label>
								<input type="text" value="{{ $data_admin['description'] }}" class="form-control" readonly="">
							</div>
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Cabang</label>
								<input type="text" value="Surabaya" class="form-control" readonly="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<label>Telepon</label>
								<input type="text" value="081234567890" class="form-control" readonly="">
							</div>
						</div>
					</div> -->
					@endif
				</div>
			</div>
		</div>
		<!-- /user details -->							

	</div>
</div>
<!-- /main charts -->

@endsection
