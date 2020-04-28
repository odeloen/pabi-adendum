<?php $id_member = $data_member['id']; 

$keydiv="simpan_div_data_file_keanggotaan";
?> 
<div class="row div_<?= $keydiv; ?>">
    <div class="col-md-12">  
        <button type="button" class="btn btn-primary" onclick="$('.div_<?= $keydiv; ?>').toggle(500);">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
    </div>
    <hr>
    <hr>
</div>
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataFile" onsubmit="
    simpan_div_data_file_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_file');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="jenis_file" style="text-align: right;" class="col-md-4 control-label">
            Jenis File <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <select required="" name="jenis_file" id="jenis_file"  class="select22" style="width: 100%">
                <option value="">Pilih</option>
                <option value="Umum">Umum</option>
                <option value="Berkas Perpindahan Cabang">Berkas Perpindahan Cabang</option>
            </select> 
        </div>
    </div>
    <div class="form-group"> 
        <label for="file_name" style="text-align: right;" class="col-md-4 control-label">
            Lampiran File <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="file" name="file_name" id="file_name" class="file-styled">
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
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_file" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan
            </button>
            <button style="float: right;" type="button" class="btn btn-danger " onclick="$('.div_<?= $keydiv; ?>').toggle(500);">
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