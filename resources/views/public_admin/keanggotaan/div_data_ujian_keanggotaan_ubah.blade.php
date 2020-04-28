<?php 
$id_member = $data_ujian['member_id'];
$id_ujian = $data_ujian['id']; 
$display_member = '';
if (session('pabi_role_id') == 4) {
    $display_member = ' style="display: none;"';
}

$nama_ujian = explode('-', '----');
if (!empty($data_ujian['nama_ujian'])) {
    $cek = explode('-', $data_ujian['nama_ujian']);
    if (count($cek) == 5) {
        $nama_ujian = explode('-', $data_ujian['nama_ujian']);
    }
}
$bulan = date('m');
if (!empty($nama_ujian[2])) {
    $bulan = $nama_ujian[2];
}

$tahun = date('Y');
if (!empty($nama_ujian[3])) {
    $tahun = substr($tahun, 0, 2).$nama_ujian[3];
}
?>
<form class="form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataUjianUbah" onsubmit="
    simpan_div_data_ujian_keanggotaan_ubah('{{csrf_token()}}', '{{ $id_ujian }}', '.btn_data_ujian', '{{ $id_member }}');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="kode_ujian" style="text-align: right;" class="col-md-4 control-label">
            Kode Ujian <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Ujian" class="select22" name="kode_ujian" id="kode_ujian" required="" style="width: 100%" onchange="generate_kode_ujian_finacs('#formKeanggotaanDataUjianUbah')">
                <option value="">-- Pilih Kode Ujian --</option>
                <option value="FEL" <?php if ($nama_ujian[0] == 'FEL') { echo 'selected=""'; } ?>>Fellowship</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="kode_wilayah" style="text-align: right;" class="col-md-4 control-label">
            Kode Wilayah <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Wilayah" class="select22" name="kode_wilayah" id="kode_wilayah" required="" style="width: 100%" onchange="generate_kode_ujian_finacs('#formKeanggotaanDataUjianUbah')">
                <option value="">-- Pilih Kode Wilayah --</option>
                <option value="WI" <?php if ($nama_ujian[1] == 'WI') { echo 'selected=""'; } ?>>West Indonesia</option>
                <option value="CI" <?php if ($nama_ujian[1] == 'CI') { echo 'selected=""'; } ?>>Central Indonesia</option>
                <option value="EI" <?php if ($nama_ujian[1] == 'EI') { echo 'selected=""'; } ?>>East Indonesia</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="kode_bulan" style="text-align: right;" class="col-md-4 control-label">
            Bulan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Bulan" class="select22" name="kode_bulan" id="kode_bulan" required="" style="width: 100%" onchange="generate_kode_ujian_finacs('#formKeanggotaanDataUjianUbah')">
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
    <div class="form-group">
        <label for="kode_tahun" style="text-align: right;" class="col-md-4 control-label">
            Tahun <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="number" class="form-control" name="kode_tahun" id="kode_tahun" value="{{$tahun}}" required="" readonly="" oninput="generate_kode_ujian_finacs('#formKeanggotaanDataUjianUbah')">
        </div>
    </div>
    <div class="form-group">
        <label for="no_urut" style="text-align: right;" class="col-md-4 control-label">
            Nomor Urut <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="no_urut" id="no_urut" maxlength="4" required="" value="{{$nama_ujian[4]}}" class="form-control" oninput="generate_kode_ujian_finacs('#formKeanggotaanDataUjianUbah')">
        </div>
    </div>
    <div class="form-group">
        <label for="nama_ujian" style="text-align: right;" class="col-md-4 control-label">
            Nama Ujian <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="nama_ujian" id="nama_ujian" required="" value="{{$data_ujian['nama_ujian']}}">
        </div>
    </div>
    <div class="form-group">
        <label for="jenis" style="text-align: right;" class="col-md-4 control-label">
            Jenis Ujian <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <select data-placeholder="Pilih Jenis Ujian" class="select22" name="jenis" id="jenis" required="" style="width: 100%">
                <option value="">-- Pilih Jenis Ujian --</option>
                <option value="FINACS" <?php if ($data_ujian['jenis'] == 'FINACS') { echo 'selected=""'; } ?>>FINACS</option>
            </select>
        </div>
    </div>
    <div class="form-group"{{$display_member}}>
        <label for="tgl_lulus" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Lulus <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_lulus" id="tgl_lulus" value="{{$data_ujian['tgl_lulus']}}" required="">
        </div>
    </div>
    <div class="form-group"{{$display_member}}>
        <label for="valid_until" style="text-align: right;" class="col-md-4 control-label">
            Valid Sampai Dengan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="valid_until" id="valid_until" value="{{$data_ujian['valid_until']}}" required="">
        </div>
    </div> 
    <div class="form-group">
        <div class="col-md-4">  
            <button style="float: right;" class="btn btn-danger" onclick="div_data_ujian_keanggotaan('{{csrf_token()}}', '#div_data_ujian_keanggotaan', '{{ $id_member }}');">
                <i class="icon-cross"></i> Batal
            </button>
        </div>
        <div class="col-md-7">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_ujian" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan Perubahan
            </button>
        </div>
    </div>    
</form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.select22').select2();
    });
</script>