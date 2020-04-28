<?php 
$id_member = $data_member['id'];
//dd($data_member);
$no_pabi_sejahtera = explode('-', '----');
if (!empty($data_member['no_pabi_sejahtera'])) {
    $cek = explode('-', $data_member['no_pabi_sejahtera']);
    if (count($cek) == 5) {
        $no_pabi_sejahtera = explode('-', $data_member['no_pabi_sejahtera']);
    }
}
$bulan = date('m');
if (!empty($no_pabi_sejahtera[2])) {
    $bulan = $no_pabi_sejahtera[2];
}

$tahun = date('Y');
if (!empty($no_pabi_sejahtera[3])) {
    $tahun = substr($tahun, 0, 2).$no_pabi_sejahtera[3];
}
?>
<form class="form-horizontal" enctype="multipart/form-data" id="formDivNomorPABISejahtera" onsubmit="simpan_div_nomor_pabi_sejahtera('{{csrf_token()}}', '{{ $id_member }}', '.btn_simpan_div_nomor_pabi_sejahtera'); return false;">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <?php /* ?>
    <div class="form-group">
        <label for="kode_wilayah" style="text-align: right;" class="col-md-4 control-label">
            Kode Wilayah <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Wilayah" class="select22" name="kode_wilayah" id="kode_wilayah" required="" style="width: 100%" onchange="generate_kode_nomor_pabi_sejahtera('#formDivNomorPABISejahtera')">
                <option value="">-- Pilih Kode Wilayah --</option>
                <option value="WI" <?php if ($no_pabi_sejahtera[0] == 'WI') { echo 'selected=""'; } ?>>West Indonesia</option>
                <option value="CI" <?php if ($no_pabi_sejahtera[0] == 'CI') { echo 'selected=""'; } ?>>Central Indonesia</option>
                <option value="EI" <?php if ($no_pabi_sejahtera[0] == 'EI') { echo 'selected=""'; } ?>>East Indonesia</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="kode_kota" style="text-align: right;" class="col-md-4 control-label">
            Kode Kota <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Kota" class="select22" name="kode_kota" id="kode_kota" required="" style="width: 100%" onchange="generate_kode_nomor_pabi_sejahtera('#formDivNomorPABISejahtera')">
                <option value="">-- Pilih Kode Kota --</option>
                <?php
                foreach ($data_admin_cabang as $dac) {
                    $sel_adm_cab = '';
                    if ($no_pabi_sejahtera[1] == $dac['kode_bandara'] || (session('pabi_role_id') == 3 && session('admin_cabang_id') == $dac['id'])) {
                        $sel_adm_cab = 'selected=""';
                    }
                    echo '<option value="' . $dac['kode_bandara'] . '" ' . $sel_adm_cab . '>' . $dac['name'] . '</option>';
                }
                ?>
                <!-- <option value="SUB" <?php if ($no_pabi_sejahtera[1] == 'SUB') { echo 'selected=""'; } ?>>Surabaya</option> -->
                <!-- <option value="JOG" <?php if ($no_pabi_sejahtera[1] == 'JOG') { echo 'selected=""'; } ?>>Yogyakarta</option> -->
                <!-- <option value="JKT" <?php if ($no_pabi_sejahtera[1] == 'JKT') { echo 'selected=""'; } ?>>Jakarta</option> -->
            </select>
        </div>
    </div>
    <?php */ ?>
    <div style="display: none" class="form-group">
        <label for="kode_bulan" style="text-align: right;" class="col-md-4 control-label">
            Bulan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Bulan" class="select22" name="kode_bulan" id="kode_bulan" style="width: 100%" onchange="generate_kode_nomor_pabi_sejahtera('#formDivNomorPABISejahtera')">
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
    <div style="display: none" class="form-group">
        <label for="kode_tahun" style="text-align: right;" class="col-md-4 control-label">
            Tahun <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="number" class="form-control" name="kode_tahun" id="kode_tahun" value="{{$tahun}}" readonly="" oninput="generate_kode_nomor_pabi_sejahtera('#formDivNomorPABISejahtera')">
        </div>
    </div>
    <?php /* ?>
    <div class="form-group">
        <label for="no_urut" style="text-align: right;" class="col-md-4 control-label">
            Nomor Urut <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="no_urut" id="no_urut" maxlength="4" required="" value="{{$no_pabi_sejahtera[4]}}" class="form-control" oninput="generate_kode_nomor_pabi_sejahtera('#formDivNomorPABISejahtera')">
        </div>
    </div>
    <?php */ ?>
    <div class="form-group">
        <label for="no_pabi_sejahtera" style="text-align: right;" class="col-md-4 control-label">
            Generate Nomor PABI Sejahtera <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="no_pabi_sejahtera" id="no_pabi_sejahtera" required="" value="{{$data_member['no_pabi_sejahtera']}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_simpan_div_nomor_pabi_sejahtera" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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