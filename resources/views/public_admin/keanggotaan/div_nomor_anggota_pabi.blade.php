<?php 
$id_member = $data_member['id'];
//dd($data_member);
$card_no = explode('-', '----');
if (!empty($data_member['card_no'])) {
    $cek = explode('-', $data_member['card_no']);
    if (count($cek) == 5) {
        $card_no = explode('-', $data_member['card_no']);
    }
}
$bulan = date('m');
if (!empty($card_no[2])) {
    $bulan = $card_no[2];
}

$tahun = date('Y');
if (!empty($card_no[3])) {
    $tahun = substr($tahun, 0, 2).$card_no[3];
}
?>
<form class="form-horizontal" enctype="multipart/form-data" id="formDivNomorAnggotaPABI" onsubmit="simpan_div_nomor_anggota_pabi('{{csrf_token()}}', '{{ $id_member }}', '.btn_simpan_div_nomor_anggota_pabi'); return false;">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="kode_wilayah" style="text-align: right;" class="col-md-4 control-label">
            Kode Wilayah <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Wilayah" class="select22" name="kode_wilayah" id="kode_wilayah" required="" style="width: 100%" onchange="generate_kode_nomor_pabi('#formDivNomorAnggotaPABI')">
                <option value="">-- Pilih Kode Wilayah --</option>
                <option value="WI" <?php if ($card_no[0] == 'WI') { echo 'selected=""'; } ?>>West Indonesia</option>
                <option value="CI" <?php if ($card_no[0] == 'CI') { echo 'selected=""'; } ?>>Central Indonesia</option>
                <option value="EI" <?php if ($card_no[0] == 'EI') { echo 'selected=""'; } ?>>East Indonesia</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="kode_kota" style="text-align: right;" class="col-md-4 control-label">
            Kode Kota <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Kode Kota" class="select22" name="kode_kota" id="kode_kota" required="" style="width: 100%" onchange="generate_kode_nomor_pabi('#formDivNomorAnggotaPABI')">
                <option value="">-- Pilih Kode Kota --</option>
                <?php
                foreach ($data_admin_cabang as $dac) {
                    $sel_adm_cab = '';
                    if ($card_no[1] == $dac['kode_bandara'] || (session('pabi_role_id') == 3 && session('admin_cabang_id') == $dac['id'])) {
                        $sel_adm_cab = 'selected=""';
                    }
                    echo '<option value="' . $dac['kode_bandara'] . '" ' . $sel_adm_cab . '>' . $dac['name'] . '</option>';
                }
                ?>
                <!-- <option value="SUB" <?php if ($card_no[1] == 'SUB') { echo 'selected=""'; } ?>>Surabaya</option> -->
                <!-- <option value="JOG" <?php if ($card_no[1] == 'JOG') { echo 'selected=""'; } ?>>Yogyakarta</option> -->
                <!-- <option value="JKT" <?php if ($card_no[1] == 'JKT') { echo 'selected=""'; } ?>>Jakarta</option> -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="kode_bulan" style="text-align: right;" class="col-md-4 control-label">
            Bulan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Bulan" class="select22" name="kode_bulan" id="kode_bulan" required="" style="width: 100%" onchange="generate_kode_nomor_pabi('#formDivNomorAnggotaPABI')">
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
            <input type="number" class="form-control" name="kode_tahun" id="kode_tahun" value="{{$tahun}}" required="" readonly="" oninput="generate_kode_nomor_pabi('#formDivNomorAnggotaPABI')">
        </div>
    </div>
    <div class="form-group">
        <label for="no_urut" style="text-align: right;" class="col-md-4 control-label">
            Nomor Urut <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="no_urut" id="no_urut" maxlength="4" required="" value="{{$card_no[4]}}" class="form-control" oninput="generate_kode_nomor_pabi('#formDivNomorAnggotaPABI')">
        </div>
    </div>
    <div class="form-group">
        <label for="card_no" style="text-align: right;" class="col-md-4 control-label">
            Generate Nomor Anggota <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" name="card_no" id="card_no" required="" value="{{$data_member['card_no']}}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_simpan_div_nomor_anggota_pabi" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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