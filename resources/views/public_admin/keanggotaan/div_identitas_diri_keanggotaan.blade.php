<?php $id_member = $data_member['id']; ?>
<form class="form-horizontal" enctype="multipart/form-data" id="formKeanggotaanIdentitasDiri" onsubmit="simpan_div_identitas_diri_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_identitas_diri');
    return false;    
    ">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="firstname" style="text-align: right;" class="col-md-4 control-label">
            Nama Depan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="firstname" id="keanggotaan_firstname" value="{{ $data_member['firstname'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" style="text-align: right;" class="col-md-4 control-label">
            Nama Belakang : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="lastname" id="keanggotaan_lastname" value="{{ $data_member['lastname'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="nickname" style="text-align: right;" class="col-md-4 control-label">
            Nama Sebutan : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="nickname" id="keanggotaan_nickname" value="{{ $data_member['nickname'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="gelar" style="text-align: right;" class="col-md-4 control-label">
            Gelar <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="gelar" id="keanggotaan_gelar" value="{{ $data_member['gelar'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="email" style="text-align: right;" class="col-md-4 control-label">
            Email <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="email" class="form-control" name="email" id="keanggotaan_email" value="{{ $data_member['email'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="tempat_lahir" style="text-align: right;" class="col-md-4 control-label">
            Tempat Lahir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select required="required" data-placeholder="Pilih Kota Lahir" class="select22" style="width: 100%" name="tempat_lahir" id="keanggotaan_tempat_lahir" >
                <option value="">-- Select Kota Lahir--</option> 
                @foreach ($data_kota as $dk)
                @if ($data_member['tempat_lahir'] == $dk['id'])
                <option value="{{ $dk['id'] }}" selected="">{{ $dk['nama'] }}</option>
                @endif
                @if($data_member['tempat_lahir'] != $dk['id'])
                <option value="{{ $dk['id'] }}">{{ $dk['nama'] }}</option>
                @endif 
                @endforeach
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label for="tgl_lahir" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Lahir <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="date" class="form-control" name="tgl_lahir" id="keanggotaan_tgl_lahir" value="{{ $data_member['tgl_lahir'] }}">
        </div>
    </div>
    <div class="form-group">
        <?php 
        $cp = ' checked="" ';
        $cw = ''; 
        if($data_member['gender'] == 'P'){
            $cp = '';
            $cw = ' checked="" ';
        }
        ?>
        <label for="gender" style="text-align: right;" class="col-md-4 control-label">
            Gender <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <label class="radio-inline">
                <input required="required" type="radio" class="styled" name="gender" id="keanggotaan_gender_p" value="L" {{ $cp }}>
                Laki-Laki
            </label>
            <label class="radio-inline">
                <input required="required" type="radio" class="styled" name="gender" id="keanggotaan_gender_w" value="P" {{ $cw }}>
                Perempuan
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="no_telp" style="text-align: right;" class="col-md-4 control-label">
            Telepon Rumah : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="no_telp" id="keanggotaan_no_telp" value="{{ $data_member['no_telp'] }}">
        </div>
    </div>  
    <div class="form-group">
        <label for="no_telp" style="text-align: right;" class="col-md-4 control-label">
            HP : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="no_hp" id="keanggotaan_no_hp" value="{{ $data_member['no_hp'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="alamat_rumah" style="text-align: right;" class="col-md-4 control-label">
            Alamat Rumah <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <textarea required="required" name="alamat_rumah" id="keanggotaan_alamat_rumah" placeholder="Alamat Lengkap Rumah" class="form-control" rows="4">{{ $data_member['alamat_rumah'] }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="id_prov" style="text-align: right;" class="col-md-4 control-label">
            Provinsi <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select required="required" data-placeholder="Pilih Provinsi" class="select22" style="width: 100%" name="id_prov" id="keanggotaan_id_prov" onchange="set_kota_by_prov('{{csrf_token()}}', '#keanggotaan_id_prov', '#keanggotaan_kota')">
                <option value="">-- Select Provinsi Tinggal--</option> 
                @foreach ($data_provinsi as $dp)
                @if ($id_prov_member == $dp['id_prov'])
                <option value="{{ $dp['id_prov'] }}" selected="">{{ $dp['nama'] }}</option>
                @endif
                @if($id_prov_member != $dp['id_prov'])
                <option value="{{ $dp['id_prov'] }}">{{ $dp['nama'] }}</option>
                @endif 
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="kota" style="text-align: right;" class="col-md-4 control-label">
            Kabupaten/Kota <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <select required="required" class="select22" style="width: 100%" name="kota" id="keanggotaan_kota" >
                @if ($data_member['kota'] !== null)
                <option value="">-- Select Kota Tinggal--</option> 
                @foreach ($kab_by_prov as $dk)
                @if ($data_member['kota'] == $dk['id'])
                <option value="{{ $dk['id'] }}" selected="">{{ $dk['nama'] }}</option>
                @endif
                @if($data_member['kota'] != $dk['id'])
                <option value="{{ $dk['id'] }}">{{ $dk['nama'] }}</option>
                @endif 
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="hobi" style="text-align: right;" class="col-md-4 control-label">
            Hobi : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="hobi" id="keanggotaan_hobi" value="{{ $data_member['hobi'] }}">
        </div>
    </div>
    <input type="file" name="image_thumb" style="display: none;">
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_identitas_diri" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan
            </button>
        </div>
    </div>     
</form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.select22').select2();
    });
</script>