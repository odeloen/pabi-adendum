<?php $id_member = $data_member['id']; 
// print_r($data_pekerjaan);
// echo $data_pekerjaan['nama_pekerjaan'];
// exit();
$keydiv="simpan_div_data_pekerjaan_keanggotaan";
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
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataPekerjaan" onsubmit="
    simpan_div_data_pekerjaan_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_pekerjaan');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="nama_pekerjaan" style="text-align: right;" class="col-md-4 control-label">
            Nama Pekerjaan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="nama_pekerjaan" id="nama_pekerjaan" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="tempat_pekerjaan" style="text-align: right;" class="col-md-4 control-label">
            Tempat Bekerja <span style="color:red"><b>*</b></span> : 
        </label> 
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="tempat_pekerjaan" id="tempat_pekerjaan" value="">
        </div>   
    </div>   
    <div class="form-group">
        <div class="col-md-11">   
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_pekerjaan" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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