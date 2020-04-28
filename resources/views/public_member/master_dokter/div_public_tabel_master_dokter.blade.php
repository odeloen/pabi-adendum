<?php
function does_url_exists_my_profile($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($code == 200) {
		$status = true;
	} else {
		$status = false;
	}
	curl_close($ch);
	return $status;
}

// echo sizeof($data_dokter); exit();
?>
@if(sizeof($data_dokter) > 0)
@foreach ($data_dokter as $dd)
<!-- DOCTOR #1 -->
<div class="col-md-6 col-lg-4">
	<div class="doctor-2">	

		<!-- Doctor Photo -->
		<div class="hover-overlay"> 
			<?php  
			if (does_url_exists_my_profile(env('URL_API_IP') . $dd['image_thumb_compress']) == 1 && !empty($dd['image_thumb_compress'])) {
				?>
				<a href="{{env('URL_API_IP')}}{{ $dd['image_thumb'] }}" target="_blank"> 
					<img src="{{env('URL_API_IP')}}{{ $dd['image_thumb_compress'] }}" class="img-fluid" alt="doctor-foto">
				</a>
				<?php
			} else {
				if($dd['gender'] == 'P'){ 
					?>
					<a href="#">
						<img src="{{ asset('assets_member/images/profile_member/member_pr.png') }}" class="img-fluid" alt="doctor-foto" style="width: 110px; height: 110px;">
					</a>
					<?php 
				} else {
					?>
					<a href="#">
						<img src="{{ asset('assets_member/images/profile_member/deafult_profile.png') }}" class="img-fluid" alt="doctor-foto" style="width: 110px; height: 110px;">
					</a>
					<?php 
				}
			}
			?>
		</div>								

		<!-- Doctor Meta -->		
		<div class="doctor-meta">
			<?php $nama_dokter = $dd['firstname']." ".$dd['lastname'] ?>
			<h5 class="h5-xs blue-color">{{$nama_dokter}}</h5>
			<span>({{$dd['gelar']}})</span>
			<!-- <span>{{$dd['jabatan']}}</span> -->

			<!-- Button -->
			<form method="post" action="{{ route('public_identitas_dokter', $nama_dokter) }}" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="member_id" value="{{$dd['id']}}">
				<button class="btn btn-sm btn-blue blue-hover mt-15" type="submit" title="Detail Dokter">
					Profil Lengkap Dokter
				</button>
			</form>

		</div>	

	</div>								
</div>	<!-- END DOCTOR #1 -->
@endforeach
@else 
<h3>Tidak Ada Data</h3>
@endif