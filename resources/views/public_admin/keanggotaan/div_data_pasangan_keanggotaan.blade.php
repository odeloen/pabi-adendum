<?php $id_member = $data_member['id']; 

$keydiv="simpan_div_data_pasangan_keanggotaan";
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
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataPasangan" 
    onsubmit="simpan_div_data_pasangan_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_identitas_pasangan');
    return false;
    ">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="nama_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Nama Lengkap <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="nama_pasangan" id="nama_pasangan" required="required" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="gender_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Gender <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <label class="radio-inline">
                <input required="required" type="radio" class="styled" name="gender" id="gender_pasangan" checked="checked" value="L">
                Laki - Laki
            </label>
            <label class="radio-inline">
                <input required="required" type="radio" class="styled" name="gender" id="gender_pasangan" value="P">
                Perempuan
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="tempat_lahir_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Tempat Lahir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select required="required" data-placeholder="Pilih Kota Lahir" class="select22" name="tempat_lahir_pasangan" id="tempat_lahir_pasangan" style="width: 100%">
                <option value="">-- Select Kota Lahir--</option> 
                @foreach ($data_kota as $dk)
                <option value="{{ $dk['id'] }}">{{ $dk['nama'] }}</option>
                @endforeach
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label for="tgl_lahir_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Lahir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="date" class="form-control" name="tgl_lahir_pasangan" id="tgl_lahir_pasangan" value="" >
        </div>
    </div>
    <div class="form-group">
        <label for="alamat_rumah_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Alamat Rumah : 
        </label>
        <div class="col-md-7"> 
            <textarea name="alamat_rumah_pasangan" id="alamat_rumah_pasangan" placeholder="Alamat Lengkap Rumah" class="form-control" rows="4"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="id_prov_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Provinsi <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select required="required" data-placeholder="Pilih Provinsi" class="select22" style="width: 100%" name="id_prov_pasangan" id="id_prov_pasangan" onchange="set_kota_by_prov('{{csrf_token()}}', '#id_prov_pasangan', '#kota_pasangan')">
                <option value="">-- Select Provinsi Tinggal--</option> 
                @foreach ($data_provinsi as $dp)
                <option value="{{ $dp['id_prov'] }}">{{ $dp['nama'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group" >
        <label for="kota_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Kota <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select required="required" data-placeholder="Pilih Kota" class="select22" style="width: 100%" name="kota_pasangan" id="kota_pasangan" >

            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="pekerjaan_pasangan" style="text-align: right;" class="col-md-4 control-label">
            Pekerjaan Pasangan : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="pekerjaan_pasangan" id="pekerjaan_pasangan" value="" >
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_identitas_pasangan" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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