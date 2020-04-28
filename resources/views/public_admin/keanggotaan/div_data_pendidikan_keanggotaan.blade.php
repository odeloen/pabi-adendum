<?php $id_member = $data_member['id']; 

$keydiv="simpan_div_data_pendidikan_keanggotaan";
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
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataPendidikan" onsubmit="
    simpan_div_data_pendidikan_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_pendidikan');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="jenjang_pendidikan" style="text-align: right;" class="col-md-4 control-label">
            Jenjang Pendidikan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Jenjang Pendidikan" class="select form-control" name="jenjang_pendidikan" id="jenjang_pendidikan" required="">
                <option value="">-- Select Jenjang Pendidkan --</option> 
                <option value="S1">S1</option> 
                <option value="S2">S2</option> 
                <option value="S3">S3</option> 
                <option value="Spesialis">Spesialis</option> 
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="jurusan" style="text-align: right;" class="col-md-4 control-label">
            Jurusan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" required="" class="form-control" name="jurusan" id="jurusan" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="tgl_lulus" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Lulus : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_lulus" id="tgl_lulus" >
        </div>
    </div> 
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_pendidikan" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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