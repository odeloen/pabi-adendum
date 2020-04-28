@include('public_admin.include.function')
<?php  

$no = 0;
$member_id = session('pabi_member_id');
?>
@if (!empty($data_event))
@foreach ($data_event as $r) 
@if ($r['admin_pusat_id'] !== null && $r['admin_pusat_id'] == session('admin_pusat_id'))
<?php
$no ++;
$id = $r['id'];
$s_event = '<span class="label label-flat border-danger text-danger-600">Tutup</span>';
if($r['status_event']  == 1 ){
	$s_event = '<span class="label label-flat border-success text-success-600">Buka</span>';
}

$tgl_event = tgl_indo($r['tgl_event']);

$key=$id.'$$|$$'.$r['tgl_event'];
$keyenc = hamdi_encrypt($key, 'progstyle2020');

$urlfull = explode("/", url()->current());
$url = $urlfull[0].'//'.$urlfull[2].'/event/detail/'.$keyenc; 

$str_penyelenggara = "";
if(isset($r['admin_pusat_description'])){
	$str_penyelenggara = $r['admin_pusat_description'];
}
if(isset($r['admin_cabang_description'])){
	if(empty($str_penyelenggara)){
		$str_penyelenggara = $r['admin_cabang_description'];
	}
}

$string_event_induk = '';
$string_jenis_event = $r['nama_jenis_event'];
if (empty($r['nama_jenis_event'])) {
	$string_jenis_event = 'Independent';
}
if (!empty($r['event_induk']) && $r['nama_jenis_event'] == 'Simposium') {
	$string_event_induk = ' dari <b>'.$r['event_induk'].'</b>';
}
?> 
<div class="row"> 
	<div class="col-sm-12"> 
		<div class="panel panel-flat border-left-danger row"> 
			<div class="panel-body col-sm-2" style=" border-right:1px solid #DCDCDC ;padding: 20px;"> 
				<?php 
                if (does_url_exists(env('URL_API_IP') . $r['foto_event_compress']) == 1 && !empty($r['foto_event_compress'])) {
                    ?>
                    <a href="{{env('URL_API_IP')}}{{$r['foto_event']}}" target="_blank" > 
						<img src="{{env('URL_API_IP')}}{{$r['foto_event_compress']}}" style="width: 100%; max-height: 200px;margin: 10px;">
                    </a>
                    <?php
                } 
                ?>
			</div>
			<div class="panel-body col-sm-8" style="border-left:1px solid #DCDCDC ; font-size: 13pt !important"> 
				<b>
					{{ $r['nama_event'] }}
				</b>
				<br>
				<div class="text-size-mini-hamdi">
					{{ $r['jenis_event'] }} - {{ $string_jenis_event }}<?php echo $string_event_induk; ?>
				</div>
				<?php echo $s_event; ?><br>
				<div class="text-size-mini-hamdi">
					<i class="icon-calendar text-size-small"></i> &nbsp;{{ $tgl_event }}
				</div> 
				<div class="text-size-mini-hamdi">
					<i class="icon-alarm text-size-small"></i> &nbsp;{{ date('H:i', strtotime($r['jam_mulai'])) }} - {{ date('H:i', strtotime($r['jam_selesai'])) }}  
				</div> 
				<div class="text-size-mini-hamdi">
					<i class="icon-pin text-size-small"></i> &nbsp;{{ $r['lokasi_alamat'] }}
					<?php
					if(!empty($r['lokasi_koordinat_x']) && !empty($r['lokasi_koordinat_y'])){
						?>
						<a href="https://www.google.com/maps?saddr=My+Location&daddr=<?php echo $r['lokasi_koordinat_y']; ?>,<?php echo $r['lokasi_koordinat_x']; ?>" target="_blank" >
							<br> klik disini untuk <i>direction</i>
						</a>
						<?php 
					}
					?>
				</div>  
				<div class="text-size-mini-hamdi" style="text-align: justify;">
					<b>Kuota :</b> {{ $r['max_event'] }} kursi<br>
					<b>Penyelenggara :</b> {{ $str_penyelenggara }}<br>  
					<b>Deskripsi Event : </b><br>
					{{ $r['deskripsi'] }}
				</div> 
			</div>
			<div class="panel-body col-sm-2" style=" border-right:1px solid #DCDCDC ;padding: 20px;">   
				<img style="width: 100% !important" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($url)) !!} ">
			</div>
			<div class="panel-footer col-sm-12">
				<a class="heading-elements-toggle" onclick="$('.div_footer_event_{{ $id }}').toggle(500);">
					<i class="icon-arrow-down12 div_footer_event_{{ $id }}" style="display: none" ></i>
                    <i class="icon-arrow-up12 div_footer_event_{{ $id }}" ></i></a>
				<div class="heading-elements div_footer_event_{{ $r['id'] }}" > `
					<div class="btn-group heading pull-right btn-group-velocity">
						<button type="button" class="btn bg-blue btn-sm btn-block dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-list"></i>  <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li>
								<?php $url = URL::to("/member/master_event/".$keyenc."/halaman_detail_event"); ?>
								<button type="button" onclick="halaman_detail_event('{{$url}}')" class="btn btn-info btn-xs btn-block">
									<i class="glyphicon glyphicon-search"></i> Detail Event
								</button>
							</li>
							<li style="display: none;">
								<button type="button" onclick="isi_buku_tamu_member('{{csrf_token()}}','{{$id}}', '#ModalOrange')" id="modal_update_barang" class="btn bg-orange-300 btn-xs btn-block">
									<i class="glyphicon glyphicon-book"></i> Buku Tamu
								</button> 
							</li> 
							<li>
								<input type="hidden" name="se" id="se{{$no}}" value="{{ $r['status_event'] }}">
								<input type="hidden" name="me" id="me{{$no}}" value="{{ $r['max_event'] }}">					
								<button type="button" onclick="
								if ($('#se{{$no}}').val() != 1) {
									alertKu('warning', 'Pendaftaran masih belum dibuka atau sudah tutup');
								} else if ($('#me{{$no}}').val() < 1) {
									alertKu('warning', 'Kuota Penuh');
								} else {
									modal_daftar_event('{{csrf_token()}}','{{$id}}', '#ModalGreenSm');
								}
								" id="modal_update_barang" class="btn bg-green btn-xs btn-block">
									<i class="glyphicon glyphicon-edit"></i> Daftar
								</button> 
							</li> 
							<li style="display: none;">
								<button type="button" onclick="" data-toggle="modal" class="btn btn-danger btn-xs btn-block">
									<i class="glyphicon glyphicon-remove"></i> Batal
								</button>
							</li>
						</ul>
					</div> 
                </div>
			</div>
		</div>
	</div>
</div>
@endif
@endforeach
@else
<div class="row"> 
	<div class="col-sm-12">
		<div class="panel panel-flat border-left-danger row">  
			<div class="panel-body col-sm-10"> 
				<b>
					Tidak Ada Event
				</b> 
			</div>
			<div class="panel-body col-sm-2" style="background-color: #ffcccc; height: 100%"> 
				<b>-</b> 
			</div>
		</div>
	</div>
</div>
@endif 
<!-- 
<div class="col-sm-2">
	<div class="panel panel-flat  "> 
		<div class="panel-body" style="background-color: #ffcccc">  
				10 FEB 
		</div>
	</div>
</div> -->