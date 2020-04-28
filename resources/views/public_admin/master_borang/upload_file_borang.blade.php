<?php
$disCreateBorangFile = '';
if (session('pabi_role_id') != 4) {
	$disCreateBorangFile = ' style="display: none;"';
}
?>
<div class="col-md-12"<?php echo $disCreateBorangFile; ?>>
	<?php $keydiv="borang_file"; ?> 
	<div class="row div_<?= $keydiv; ?>">
		<div class="col-md-12">  
			<button type="button" class="btn btn-primary" onclick="$('.div_<?= $keydiv; ?>').toggle(500);">
				<i class="fas fa-plus"></i> Tambah Data
			</button>
		</div>
		<hr>
		<hr>
	</div>
	<form style="display: none;" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formBorangFile" onsubmit="simpan_borang_file('{{csrf_token()}}', '#formBorangFile', '.btn_borang_file'); return false;">
		<div class="form-group">
			{{ csrf_field() }}
		</div> 
		<div class="form-group">
            <label for="nama" style="text-align: right;" class="col-md-4 control-label">
                Nama File <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="nama" name="nama" required="" placeholder="Nama File">
                <input type="hidden" name="ranah_borang_id" id="ranah_borang_id" value="{{$ranah_borang_id}}">
                <input type="hidden" name="histori_kegiatan_id" id="histori_kegiatan_id" value="{{$histori_kegiatan_id}}">
            </div>
        </div>
		<div class="form-group"> 
			<label for="path_file" style="text-align: right;" class="col-md-4 control-label">
				Lampiran File <span style="color:red"><b>*</b></span> : 
			</label>
			<div class="col-md-7"> 
				<input required="required" type="file" name="path_file" id="path_file" class="file-styled">
			</div>
		</div>
		<div class="form-group">
			<label for="keterangan" style="text-align: right;" class="col-md-4 control-label">
				Keterangan File <span style="color:red"><b>*</b></span> : 
			</label>
			<div class="col-md-7"> 
				<textarea required="required" style="resize: none;" name="keterangan" id="keterangan" placeholder="Keterangan" class="form-control" rows="4"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-11">  
				<button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_borang_file" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
					<i class="icon-check"></i> Simpan
				</button>
				<button style="float: right;" type="button" class="btn btn-danger" onclick="$('.div_<?= $keydiv; ?>').toggle(500);">
					<i class="icon-cross"></i> Batal
				</button>  
			</div>
		</div>    
	</form>
	<script type="text/javascript">
		$( document ).ready(function() {
			$('.select22').select2();
		});
	</script>
</div>
<div class="col-md-12" id="div_data_borang_file">

</div>
<script type="text/javascript">
	$(document).ready(function () {
        $('.select22').select2();
        div_data_borang_file('{{csrf_token()}}', '#div_data_borang_file', '#formBorangFile');
    });
</script>
<div class="modal-footer">
	
</div>