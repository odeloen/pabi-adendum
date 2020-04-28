@extends('public_admin.index')
@section('tempat_content')
@include('public_admin.include.function')
<!-- Main charts --> 
<div class="row"> 
	<div class="col-lg-12">
		<!-- Post -->
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-7" id="konten_kiri"> 
						<div class="content-group-lg">
							<div class="content-group text-center">
								<?php
								if (does_url_exists(env('URL_API_IP') . $data_event['foto_event_compress']) == 1 && !empty($data_event['foto_event_compress'])) {
									?>
									<a href="{{env('URL_API_IP')}}{{$data_event['foto_event']}}"
									   target="_blank">
										<img src="{{env('URL_API_IP')}}{{$data_event['foto_event_compress']}}"
										     style=" max-height: 200px;margin: 10px;">
									</a>
									<?php
								}
								?>
							</div>
							<?php

							$tgl_event = tgl_indo($data_event['tgl_event']);
							$str_penyelenggara = $data_event['admin_pusat_description'];
							if(empty($str_penyelenggara)){
								$str_penyelenggara = $data_event['admin_cabang_description'];
							}
							?>

							<h3 class="text-semibold mb-5">
								<a href="#" class="text-default">
									{{ $data_event['nama_event'] }}
								</a>
							</h3>
							<div class="text-size-mini-hamdi">
								<i class="icon-calendar text-size-small"></i> &nbsp;{{ $tgl_event }}

								&nbsp;&nbsp;&nbsp;&nbsp;

								<i class="icon-alarm text-size-small"></i> &nbsp;{{ date('H:i', strtotime($data_event['jam_mulai'])) }} - {{ date('H:i', strtotime($data_event['jam_selesai'])) }}

								&nbsp;&nbsp;&nbsp;&nbsp;

								<i class="icon-pin text-size-small"></i> &nbsp;{{ $data_event['lokasi_alamat'] }} 
							</div> 
							<div class="text-size-mini-hamdi" style="text-align: justify;"> 
								<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($param_id_enc)) !!} "> 
								<br>
							</div>
							<div class="text-size-mini-hamdi" style="text-align: justify;">
								<b>Kuota :</b> {{ $data_event['max_event'] }} kursi<br>
								<b>Penyelenggara :</b> {{ $str_penyelenggara }}<br>  
								<b>Deskripsi Event : </b><br>
								{{ $data_event['deskripsi'] }}
							</div> 
						</div>  
					</div>
					<div class="col-lg-5" id="konten_kanan"> 
						<?php 
						if(!empty($data_event['lokasi_koordinat_x']) && !empty($data_event['lokasi_koordinat_y'])){
						?>
						<blockquote style="height: 100%" class="no-margin panel panel-body border-left-lg border-left-warning">
							Map Lokasi
							<?php
							if(!empty($data_event['lokasi_koordinat_x']) && !empty($data_event['lokasi_koordinat_y'])){
								?>
								<a href="https://www.google.com/maps?saddr=My+Location&daddr=<?php echo $data_event['lokasi_koordinat_y']; ?>,<?php echo $data_event['lokasi_koordinat_x']; ?>" target="_blank" >
									, klik disini untuk <i>direction</i>
								</a>
								<?php 
							}
							?>
							<div id="div_maps" style="width: 100%; height: 100%">
								
							</div>
						</blockquote> 
						<script type="text/javascript"> 
							$(document).ready(function () { 
								maps('#div_maps', '<?= $data_event['lokasi_koordinat_x'] ?>', '<?= $data_event['lokasi_koordinat_y'] ?>');
						        function maps(target, lokasi_koordinat_x, lokasi_koordinat_y){ 
						            $(target).html('loading...');
						            var act = '/event/maps/'+lokasi_koordinat_x+'&&'+lokasi_koordinat_y;
						             
								    $.ajax({
								        url: act,
								        success: function(data) { 
						                	$(target).html(data);
								        }
								    });
						        }
							});
						</script>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<!-- /post -->

	</div>
</div> 
<!-- /main charts -->
<script type="text/javascript">
	$('.btn_tampilkan').click();
	$(document).ready(function () { 
		var height = $('#konten_kiri').height();
		$('#konten_kanan').attr('style', 'min-height:' + height + 'px;'); 
		$('#map').attr('style', 'min-height:' + height + 'px;'); 
	});
</script>
@endsection