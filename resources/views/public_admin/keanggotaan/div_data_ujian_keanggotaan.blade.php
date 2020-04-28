<?php 
$id_member = $data_member['id']; 
$display_member = '';
$required_member = ' required=""';
if (session('pabi_role_id') == '4') {
    $display_member = ' style="display: none;"';
    $required_member = '';
}
$tgl_lulus = date('Y-m-d');
$valid_until = date('Y-m-d', strtotime('+4 year', strtotime($tgl_lulus)));
$bulan = date('m');
$tahun = date('Y');

$keydiv="simpan_div_data_ujian_keanggotaan";
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
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataUjian" onsubmit="simpan_div_data_ujian_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_ujian'); return false;">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group"<?php echo $display_member; ?>>
        <label for="kode_ujian" style="text-align: right;" class="col-md-4 control-label">
            Kode Ujian <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Ujian" class="select22" name="kode_ujian" id="kode_ujian" style="width: 100%" onchange="generate_kode_ujian_finacs('#formKeanggotaanDataUjian')"<?php echo $required_member; ?>>
                <option value="">-- Pilih Kode Ujian --</option>
                <option value="FEL">Fellowship</option>
            </select>
        </div>
    </div>
    <div class="form-group"<?php echo $display_member; ?>>
        <label for="kode_wilayah" style="text-align: right;" class="col-md-4 control-label">
            Kode Wilayah <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Wilayah" class="select22" name="kode_wilayah" id="kode_wilayah" style="width: 100%" onchange="generate_kode_ujian_finacs('#formKeanggotaanDataUjian')"<?php echo $required_member; ?>>
                <option value="">-- Pilih Kode Wilayah --</option>
                <option value="WI">West Indonesia</option>
                <option value="CI">Central Indonesia</option>
                <option value="EI">East Indonesia</option>
            </select>
        </div>
    </div>
    <div class="form-group"<?php echo $display_member; ?>>
        <label for="kode_bulan" style="text-align: right;" class="col-md-4 control-label">
            Bulan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Bulan" class="select22" name="kode_bulan" id="kode_bulan" required="" style="width: 100%" onchange="generate_kode_ujian_finacs('#formKeanggotaanDataUjian')">
                <option value="">-- Pilih Bulan --</option>
                <option value="01" <?php if ($bulan == '01') { echo 'selected=""'; } ?>>Januari</option>
                <option value="02" <?php if ($bulan == '02') { echo 'selected=""'; } ?>>Februari</option>
                <option value="03" <?php if ($bulan == '03') { echo 'selected=""'; } ?>>Maret</option>
                <option value="04" <?php if ($bulan == '04') { echo 'selected=""'; } ?>>April</option>
                <option value="05" <?php if ($bulan == '05') { echo 'selected=""'; } ?>>Mei</option>
                <option value="06" <?php if ($bulan == '06') { echo 'selected=""'; } ?>>Juni</option>
                <option value="07" <?php if ($bulan == '07') { echo 'selected=""'; } ?>>Juli</option>
                <option value="08" <?php if ($bulan == '08') { echo 'selected=""'; } ?>>Agustus</option>
                <option value="09" <?php if ($bulan == '09') { echo 'selected=""'; } ?>>September</option>
                <option value="10" <?php if ($bulan == '10') { echo 'selected=""'; } ?>>Oktober</option>
                <option value="11" <?php if ($bulan == '11') { echo 'selected=""'; } ?>>November</option>
                <option value="12" <?php if ($bulan == '12') { echo 'selected=""'; } ?>>Desember</option>
            </select>
        </div>
    </div>
    <div class="form-group"<?php echo $display_member; ?>>
        <label for="kode_tahun" style="text-align: right;" class="col-md-4 control-label">
            Tahun <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="number" class="form-control" name="kode_tahun" id="kode_tahun" value="{{$tahun}}" required="" readonly="" oninput="generate_kode_ujian_finacs('#formKeanggotaanDataUjian')">
        </div>
    </div>
    <div class="form-group"<?php echo $display_member; ?>>
        <label for="no_urut" style="text-align: right;" class="col-md-4 control-label">
            Nomor Urut <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="no_urut" id="no_urut" maxlength="4" value="" class="form-control" oninput="generate_kode_ujian_finacs('#formKeanggotaanDataUjian')"<?php echo $required_member; ?>>
        </div>
    </div>
    <div class="form-group">
        <label for="nama_ujian" style="text-align: right;" class="col-md-4 control-label">
            Generate Nama Ujian <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="nama_ujian" id="nama_ujian" required="">
        </div>
    </div>
    <div class="form-group">
        <label for="jenis" style="text-align: right;" class="col-md-4 control-label">
            Jenis Ujian <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <select data-placeholder="Pilih Jenis Ujian" class="select22" name="jenis" id="jenis" required="" style="width: 100%">
                <option value="">-- Pilih Jenis Ujian --</option>
                <option value="FINACS">FINACS</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="tgl_lulus" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Lulus <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_lulus" id="tgl_lulus" value="{{$tgl_lulus}}" required="">
        </div>
    </div>
    <div class="form-group">
        <label for="valid_until" style="text-align: right;" class="col-md-4 control-label">
            Valid Sampai Dengan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="valid_until" id="valid_until" value="{{$valid_until}}" required="">
        </div>
    </div> 
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_ujian" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Tambah Baru
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