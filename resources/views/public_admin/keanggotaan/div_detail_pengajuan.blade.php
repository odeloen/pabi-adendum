@include('public_admin.include.function')
<?php 
$id_member = $data_member['id'];  

?>   
<div class="row">
    <div class="col-md-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_data_dokter_modal_detail" data-toggle="tab" aria-expanded="false">
                        Data Dokter
                    </a>
                </li>
                <li >
                	<input type="hidden" id="val_tab_histori_pengajuan_modal_detail">
                    <a href="#tab_histori_pengajuan_modal_detail" data-toggle="tab" aria-expanded="false" onclick="
                                if ($('#val_tab_histori_pengajuan_modal_detail').val() == '') {
                                    histori_master_member_target('{{csrf_token()}}', '{{ $id_member }}', '#tab_histori_pengajuan_modal_detail');
                                    $('#val_tab_histori_pengajuan_modal_detail').val('1');
                                }" 
                               >
                        Histori Pengajuan
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_data_dokter_modal_detail"> 
					<div > 
						<!-- START Foto Profile  --> 
						<div class="row">
						    <div class="col-sm-4">&nbsp;</div>
						    <div class="col-sm-4" style="text-align: center;">
						        <div style="font-weight: bold" class="alert alert-danger no-border" align="center">
						            <div class="target_foto"> 
						                <?php 
						                if (does_url_exists(env('URL_API_IP') . $data_member['image_thumb_compress']) == 1 && !empty($data_member['image_thumb_compress'])) {
						                    ?>
						                    <a href="{{env('URL_API_IP')}}{{$data_member['image_thumb']}}" target="_blank">
						                        <img src="{{env('URL_API_IP')}}{{$data_member['image_thumb_compress']}}"
						                             style="width: 200px;"> 
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
						            </div> 
						        </div>
						    </div>
						    <div class="col-sm-4">&nbsp;</div>  
						</div> 
						<!-- END Foto Profile  -->
				 		<div class="row">
                        	<!-- START Data IDI -->
				 			<div class="col-lg-12">
				 				<a href=".div_bag_1_det" class="collapsed" data-toggle="collapse" onclick="tgl('.arrow_bag_1_det');">
					 				<span class="label border-left-primary label-striped"> 
					                    <i class="icon-arrow-down12 arrow_bag_1_det" style="display: none" ></i>
					                    <i class="icon-arrow-up12 arrow_bag_1_det" ></i>
										<i class="fa fa-user-md position-left"></i> <strong>DATA IDI</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_1_det">
									<div class="alert alert-primary no-border">
										<div class="form-horizontal" >
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Nama Kantor : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['tempat_kerja'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Alamat Kantor : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['alamat_kantor'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Telepon Kantor : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['no_telp_kantor'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Jabatan : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['jabatan'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Nomor Anggota : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['card_no'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Tanggal Validasi Nomor Anggota : 
										        </label>
										        <label class="col-md-7 control-label"> 
										        	{!! tgl_indo($data_member['valid_until_card_no']) !!} 
										        </label> 
										    </div> 
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            No PABI Sejahtera : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['no_pabi_sejahtera'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Tanggal Validasi No PABI Sejahtera : 
										        </label>
										        <label class="col-md-7 control-label"> 
										        	{!! tgl_indo($data_member['tgl_pabi_sejahtera']) !!} 
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            No STR : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['no_str'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Tahun No STR : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['sjk_tahun_no_str'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Surat Kompetensi Kolegium I. Bedah : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['no_skk_bedah'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Tanggal Surat Kompetensi Kolegium I. Bedah : 
										        </label>
										        <label class="col-md-7 control-label"> 
										        	{!! tgl_indo($data_member['tgl_skk_bedah']) !!} 
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            No SIP : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['no_sip_terakhir'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Tanggal Mulai SIP : 
										        </label>
										        <label class="col-md-7 control-label">
										        	{!! tgl_indo($data_member['tgl_sip_mulai']) !!} 
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Keterangan : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['keterangan'] }}
										        </label> 
										    </div>
										</div>
									</div>
								</div>
				 			</div>
	                        <!-- END Data IDI -->

	                        <!-- START IDENTITAS DIRI -->
				 			<div class="col-lg-12">
				                <a href=".div_bag_2_det" class="collapsed" data-toggle="collapse" onclick=" 
				                    tgl('.arrow_bag_2_det');
				                    ">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_2_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_2_det" ></i>
										<i class="fa fa-address-book position-left"></i> <strong>IDENTITAS DIRI</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_2_det">
									<div class="alert alert-primary no-border">
										<div class="form-horizontal" >
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Nama Depan : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['firstname'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Nama Belakang : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['lastname'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Nama Sebutan : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['nickname'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Gelar : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['gelar'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Tempat Lahir : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['nama_kota_tempat_lahir'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Tanggal Lahir : 
										        </label>
										        <label class="col-md-7 control-label"> 
										        	{!! tgl_indo($data_member['tgl_lahir']) !!} 
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Gender : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['gender'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Telepon Rumah : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['no_telp'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            HP : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['no_hp'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Alamat Rumah : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['alamat_rumah'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Kota : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['nama_kota_kota'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Hobi : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['hobi'] }}
										        </label> 
										    </div>
										</div>
									</div>
								</div>
							</div>
	                        <!-- END IDENTITAS DIRI -->
                        	<!-- START Data Bank -->
				 			<div class="col-lg-12">
				                <a href=".div_bag_12_det" class="collapsed" data-toggle="collapse" onclick=" 
				                    tgl('.arrow_bag_12_det');
				                    ">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_12_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_12_det" ></i>
										<i class="fa fa-money-bill-wave position-left"></i> <strong>DATA BANK</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_12_det">
									<div class="alert alert-primary no-border">
										<div class="form-horizontal" >
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Nama Bank : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['bank_nama'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            Nama Pemilik Rekening : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['bank_pemilik'] }}
										        </label> 
										    </div>
										    <div class="form-group">
										        <label style="text-align: right;" class="col-md-4 control-label">
										            No Rekening : 
										        </label>
										        <label class="col-md-7 control-label">
										            {{ $data_member['bank_no_rekening'] }}
										        </label> 
										    </div>
										</div>
									</div>
								</div>
							</div> 
                        	<!-- END Data Bank -->

	                        <!-- START PEKERJAAN --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_3_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_pekerjaan_keanggotaan_det').val() == '') {
                                    	div_tabel_data_pekerjaan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pekerjaan_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_pekerjaan_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_3_det');
				                    ">
				                    <input type="hidden" id="tab_div_pekerjaan_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_3_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_3_det" ></i>
										<i class="fa fa-briefcase position-left"></i> <strong>PEKERJAAN</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_3_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_pekerjaan_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END PEKERJAAN -->  

	                        <!-- START PRAKTEK --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_4_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_praktek_keanggotaan_det').val() == '') {
                                    	div_tabel_data_praktek_keanggotaan('{{csrf_token()}}', '#div_tabel_data_praktek_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_praktek_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_4_det');
				                    ">
				                    <input type="hidden" id="tab_div_praktek_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_4_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_4_det" ></i>
										<i class="fa fa-syringe position-left"></i> <strong>PRAKTEK</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_4_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_praktek_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END PRAKTEK --> 

	                        <!-- START Data Istri / Suami --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_5_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_pasangan_keanggotaan_det').val() == '') {
                                    	div_tabel_data_pasangan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pasangan_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_pasangan_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_5_det');
				                    ">
				                    <input type="hidden" id="tab_div_pasangan_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_5_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_5_det" ></i>
										<i class="icon-heart5 position-left"></i> <strong>DATA ISTRI / SUAMI</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_5_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_pasangan_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END Data Istri / Suami --> 

	                        <!-- START ANAK --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_6_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_anak_keanggotaan_det').val() == '') {
                                    	div_tabel_data_anak_keanggotaan('{{csrf_token()}}', '#div_tabel_data_anak_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_anak_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_6_det');
				                    ">
				                    <input type="hidden" id="tab_div_anak_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_6_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_6_det" ></i>
										<i class="fa fa-baby position-left"></i> <strong>DATA ANAK</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_6_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_anak_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END ANAK --> 

	                        <!-- START PENDIDIKAN --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_7_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_pendidikan_keanggotaan_det').val() == '') {
                                    	div_tabel_data_pendidikan_keanggotaan('{{csrf_token()}}', '#div_tabel_data_pendidikan_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_pendidikan_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_7_det');
				                    ">
				                    <input type="hidden" id="tab_div_pendidikan_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_7_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_7_det" ></i>
										<i class="fas fa-graduation-cap position-left"></i> <strong>DATA PENDIDIKAN </strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_7_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_pendidikan_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END PENDIDIKAN --> 
	                        
	                        <!-- START MINAT BIDANG --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_8_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_minat_bidang_keanggotaan_det').val() == '') {
                                    	div_tabel_minat_bidang_keanggotaan('{{csrf_token()}}', '#div_tabel_minat_bidang_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_minat_bidang_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_8_det');
				                    ">
				                    <input type="hidden" id="tab_div_minat_bidang_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_8_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_8_det" ></i>
										<i class="fas fa-graduation-cap position-left"></i> <strong>DATA MINAT BIDANG ILMU</strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_8_det">
									<div class="alert alert-primary no-border" id="div_tabel_minat_bidang_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END MINAT BIDANG -->  

	                        <!-- START UJIAN --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_9_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_ujian_keanggotaan_det').val() == '') {
                                    	div_tabel_data_ujian_keanggotaan('{{csrf_token()}}', '#div_tabel_data_ujian_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_ujian_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_9_det');
				                    ">
				                    <input type="hidden" id="tab_div_ujian_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_9_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_9_det" ></i>
										<i class="fas fa-graduation-cap position-left"></i> <strong>DATA UJIAN </strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_9_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_ujian_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END UJIAN --> 

	                        <!-- START JURNAL --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_10_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_jurnal_keanggotaan_det').val() == '') {
                                    	div_tabel_data_jurnal_keanggotaan('{{csrf_token()}}', '#div_tabel_data_jurnal_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_jurnal_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_10_det');
				                    ">
				                    <input type="hidden" id="tab_div_jurnal_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_10_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_10_det" ></i>
										<i class="fas fa-graduation-cap position-left"></i> <strong>DATA JURNAL </strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_10_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_jurnal_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END JURNAL --> 

	                        <!-- START FILE --> 
				 			<div class="col-lg-12">
				                <a href=".div_bag_11_det" class="collapsed" data-toggle="collapse" onclick=" 
                                    if ($('#tab_div_file_keanggotaan_det').val() == '') {
                                    	div_tabel_data_file_keanggotaan('{{csrf_token()}}', '#div_tabel_data_file_keanggotaan_det', '{{ $id_member }}', 'view');
                                        $('#tab_div_file_keanggotaan_det').val('1');

                                    } 
				                    tgl('.arrow_bag_11_det');
				                    ">
				                    <input type="hidden" id="tab_div_file_keanggotaan_det">
					 				<span class="label border-left-primary label-striped">
				                        <i class="icon-arrow-down12 arrow_bag_11_det" style="display: none" ></i>
				                        <i class="icon-arrow-up12 arrow_bag_11_det" ></i>
										<i class="fas fa-graduation-cap position-left"></i> <strong>DATA FILE </strong>
									</span>
								</a>
								<hr>
								<div class="collapse div_bag_11_det">
									<div class="alert alert-primary no-border" id="div_tabel_data_file_keanggotaan_det">
									</div>
								</div>
							</div> 
	                        <!-- END FILE --> 
				 		</div>
					</div>
				</div>
                <div class="tab-pane active" id="tab_histori_pengajuan_modal_detail"> 
                </div>
			</div>
		</div>
	</div>
</div> 
	