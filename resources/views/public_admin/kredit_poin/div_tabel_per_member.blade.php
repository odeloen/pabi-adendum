<?php
function gennerate_null($val_data){
	$val_generate = '0';
	if (!empty($val_data)) {
		$val_generate = $val_data;
	}
	return $val_generate;
}
$periode = $data_kredit_poin[0]['tahun_periode_awal'].'/'.$data_kredit_poin[0]['tahun_periode_akhir'];
$min_poin = gennerate_null($data_kredit_poin[0]['min_poin']);
$poin_setuju_verif = gennerate_null($data_kredit_poin[0]['poin_setuju_verif']);
$poin_belum_verif = gennerate_null($data_kredit_poin[0]['poin_belum_verif']);
$poin_tolak_verif = gennerate_null($data_kredit_poin[0]['poin_tolak_verif']);
$poin_total = gennerate_null($data_kredit_poin[0]['poin_total']);

?>
<div class="form-horizontal" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="control-label col-sm-6" style="text-align: right;">
			Periode Saat Ini : 
		</label>
		<label class="control-label col-sm-5" style="font-weight: bold">
			{{$periode}}
		</label> 
	</div> 
	<div class="form-group">
		<label class="control-label col-sm-6" style="text-align: right;">
			Minimal Point untuk Periode Saat Ini : 
		</label>
		<label class="control-label col-sm-5" style="font-weight: bold">
			{{$min_poin}}
		</label> 
	</div>   
	<div class="form-group">
		<label class="control-label col-sm-6" style="text-align: right;">
			Point yang Telah Terkumpul untuk Periode Saat Ini : 
		</label>
		<label class="control-label col-sm-5" style="font-weight: bold">
			{{$poin_setuju_verif}}
		</label> 
	</div>   
	<div class="form-group">
		<label class="control-label col-sm-6" style="text-align: right;">
			Point yang Belum Terverif untuk Periode Saat Ini : 
		</label>
		<label class="control-label col-sm-5" style="font-weight: bold">
			{{$poin_belum_verif}}
		</label> 
	</div>   
	<div class="form-group">
		<label class="control-label col-sm-6" style="text-align: right;">
			Point yang Ditolak untuk Periode Saat Ini : 
		</label>
		<label class="control-label col-sm-5" style="font-weight: bold">
			{{$poin_tolak_verif}}
		</label> 
	</div>   
	<div class="form-group">
		<label class="control-label col-sm-6" style="text-align: right;">
			Point Keseluruhan yang telah Diajukan untuk Periode Saat Ini : 
		</label>
		<label class="control-label col-sm-5" style="font-weight: bold">
			{{$poin_total}}
		</label> 
	</div>   
</div>