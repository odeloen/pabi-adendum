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
				<h6 class="panel-title">
					Tentang PABI
				</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
                <form method="post" action="{{ route('simpan_edit_landing_page_pabi', 1) }}" class="form-horizontal" enctype="multipart/form-data" >
                    <div class="modal-body">
                        <div class="form-group">
                            {{ csrf_field() }}
                        </div>  
		                <div class="form-group">
		                    <label for="tent_deskripsi" style="text-align: right;" class="col-md-3 control-label">
		                        Deskirpsi Singkat PABI <span style="color:red"><b>*</b></span> : 
		                    </label>
		                    <div class="col-md-8"> 
		                    	<textarea required="required" class="form-control" value="" name="tent_deskripsi" id="tent_deskripsi">{{ $data_dashboard['deskripsi'] }}</textarea> 
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label for="tent_alamat" style="text-align: right;" class="col-md-3 control-label">
		                        Alamat <span style="color:red"><b>*</b></span> : 
		                    </label>
		                    <div class="col-md-8">  
		                        <input required="" type="text" class="form-control" value="{{ $data_dashboard['alamat'] }}" id="tent_alamat" name="tent_alamat" >  
		                    </div>
		                </div>  
					    <div class="form-group">
					        <label for="tent_provinsi" style="text-align: right;" class="col-md-3 control-label">
					            Provinsi <span style="color:red"><b>*</b></span> : 
					        </label>
					        <div class="col-md-8">
					            <select required="required" data-placeholder="Pilih Provinsi" class="select22" style="width: 100%" name="tent_provinsi" id="tent_provinsi" required="" onchange="set_kota_by_prov('{{csrf_token()}}', '#keanggotaan_id_prov', '#keanggotaan_kota')">
					                <option value="">-- Select Provinsi Tinggal--</option> 
					                @foreach ($data_provinsi as $dp)
					                <?php
					                $selected = "";
					                if($dp['id_prov'] == $data_dashboard['provinsi_id']){
					                	$selected="selected";
					                }
					                ?>
					                <option {{$selected}} value="{{ $dp['id_prov'] }}">{{ $dp['nama'] }}</option>
					                @endforeach
					            </select>
					        </div>
					    </div>
					    <div class="form-group">
					        <label for="tent_kota" style="text-align: right;" class="col-md-3 control-label">
					            Kabupaten/Kota <span style="color:red"><b>*</b></span> : 
					        </label>
					        <div class="col-md-8"> 
            					<select required="required" class="select22" style="width: 100%" name="tent_kota" id="tent_kota" required="">
					                @if ($data_dashboard['kota_id'] !== null)
					                <option value="">-- Select Kota Tinggal--</option> 
					                @foreach ($kab_by_prov as $dk)
					                <?php
					                $selected = "";
					                if($dk['id'] == $data_dashboard['kota_id']){
					                	$selected="selected";
					                }
					                ?>
					                <option {{$selected}} value="{{ $dk['id'] }}">{{ $dk['nama'] }}</option>
					                @endforeach
					                @endif
					            </select>
					        </div>
					    </div>  
		                <div class="form-group">
		                    <label for="tent_email" style="text-align: right;" class="col-md-3 control-label">
		                        Email <span style="color:red"><b>*</b></span> : 
		                    </label>
		                    <div class="col-md-8">  
		                        <input required="" type="text" class="form-control" value="{{ $data_dashboard['email'] }}" id="tent_email" name="tent_email" >  
		                    </div>
		                </div> 
		                <div class="form-group">
		                    <label for="tent_no_telp" style="text-align: right;" class="col-md-3 control-label">
		                        Telp <span style="color:red"><b>*</b></span> : 
		                    </label>
		                    <div class="col-md-8">  
		                        <input required="" type="text" class="form-control" value="{{ $data_dashboard['no_telp'] }}" id="tent_no_telp" name="tent_no_telp" >  
		                    </div>
		                </div>    
		                <div class="form-group">
		                    <label for="tent_link_facebook" style="text-align: right;" class="col-md-3 control-label">
		                        Link Facebook : 
		                    </label>
		                    <div class="col-md-8">  
		                        <input required="" type="text" class="form-control" value="{{ $data_dashboard['facebook'] }}" id="tent_link_facebook" name="tent_link_facebook" >  
		                    </div>
		                </div>  
		                <div class="form-group">
		                    <label for="tent_link_instagram" style="text-align: right;" class="col-md-3 control-label">
		                        Link Instagram : 
		                    </label>
		                    <div class="col-md-8">  
		                        <input required="" type="text" class="form-control" value="{{ $data_dashboard['instagram'] }}" id="tent_link_instagram" name="tent_link_instagram" >  
		                    </div>
		                </div>  
		            </div>
		            <div class="modal-footer"> 
		                <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Simpan</button>
		            </div>
		        </form>
		    </div>
		</div>
		<div class="panel panel-indigo">
			<div class="panel-heading">
				<h6 class="panel-title">
					Tentang PABI
				</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div>
					<a class="btn btn-info" onclick="tambah_modal_tentang_pabi('{{csrf_token()}}', '#ModalBiru')">Tambah Data <i class="icon-plus3 position-right"></i></a>
				</div>
				<br>
				<div class="">
					<table class="table table-bordered table-hover datatable-basic">
						<thead>
							<tr>
								<th width="1%">No</th> 
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
							@foreach ($data_tentang_pabi as $r) 
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
								<td>
									<b>Judul = </b> <?= $r['judul'] ?>
									<br>
									<b>Isi = </b> <br>
									<?= $r['isi'] ?>
								</td> 
								<td>{{$posisi_isi}}</td>
								<td> 
				                    <a href="{{env('URL_API_IP')}}{{$r['image']}}" target="_blank" class="display-inline-block content-group-sm"> 
				                        <img src="{{env('URL_API_IP')}}{{$r['image_compress']}}"
				                             style="width: 200px;" class="img-circle img-responsive" alt=""> 
				                    </a> 
                				</td>  
								<td>  
									<button type="button" onclick="
									edit_modal_tentang_pabi('{{csrf_token()}}', '{{ $id }}', '#ModalTeal')
									" id="modal_update_barang" class="btn bg-teal-400 btn-xs btn-block">
									<i class="glyphicon glyphicon-edit"></i></button> 
									<button type="button" onclick="delete_master_tentang_pabi('{{csrf_token()}}','{{ $id }}')"
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