<?php $id_member = $data_member['id']; 

$keydiv="simpan_div_data_anak_keanggotaan";
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
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataAnak" onsubmit="
    simpan_div_data_anak_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_anak');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="nama_anak" style="text-align: right;" class="col-md-4 control-label">
            Nama Lengkap <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="nama_anak" id="nama_anak" value="" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="gender_anak" style="text-align: right;" class="col-md-4 control-label">
            Gender <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <label class="radio-inline">
                <input required="required" type="radio" class="styled" name="gender" id="gender_anak" checked="checked" value="L">
                Laki - Laki
            </label>
            <label class="radio-inline">
                <input required="required" type="radio" class="styled" name="gender" id="gender_anak" value="P">
                Perempuan
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="tempat_lahir_anak" style="text-align: right;" class="col-md-4 control-label">
            Tempat Lahir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kota Lahir" class="select22" name="tempat_lahir_anak" id="tempat_lahir_anak" required="required" style="width: 100%">
                <option value="">-- Select Kota Lahir--</option> 
                @foreach ($data_kota as $dk)
                <option value="{{ $dk['id'] }}">{{ $dk['nama'] }}</option>
                @endforeach
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label for="tgl_lahir_anak" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Lahir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_lahir_anak" id="tgl_lahir_anak" value="" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_anak" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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