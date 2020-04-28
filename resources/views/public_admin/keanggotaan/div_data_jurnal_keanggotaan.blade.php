<?php $id_member = $data_member['id']; 

$keydiv="simpan_div_data_jurnal_keanggotaan";
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
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataJurnal" onsubmit="
    simpan_div_data_jurnal_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_jurnal');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="judul" style="text-align: right;" class="col-md-4 control-label">
            Judul Jurnal <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="judul" id="judul" required="">
        </div>
    </div>
    <div class="form-group">
        <label for="tgl_terbit" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Terbit <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_terbit" id="tgl_terbit" required="">
        </div>
    </div>
    <div class="form-group"> 
        <label for="file_name" style="text-align: right;" class="col-md-4 control-label">
            Lampiran Jurnal <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="file" name="file_name" id="file_name" class="file-styled">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_jurnal" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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