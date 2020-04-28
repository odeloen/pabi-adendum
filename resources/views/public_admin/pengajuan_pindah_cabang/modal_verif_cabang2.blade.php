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
<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Verifikasi Admin Cabang Baru
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <?php  
                    $pindah_cabang_id = $data_pindah_cabang['id'];
                    $member_id = $data_pindah_cabang['member_id'];
                    $setuju = '';
                    if($data_pindah_cabang['cabang_baru_verif'] != 2){
                        $setuju = 'checked';
                    }
                    $cek_verif_cabang = '';
                    $alert_cabang = '';
                    if ($data_pindah_cabang['cabang_baru_verif'] == 2 || $data_pindah_cabang['cabang_baru_verif'] == 1) {
                        $cek_verif_cabang = 't';
                        $alert_cabang = 'Admin Cabang Baru Sudah Melakukan verifikasi';
                    } else {
                        $cek_verif_cabang = 'y';
                        $alert_cabang = '';
                    }
                    ?>
                    <input type="hidden" name="cek_verif_cabang" id="cek_verif_cabang" value="{{ $cek_verif_cabang }}">
                    <form id="formVerifPindahCabang2" method="post" action="{{ route('simpan_verifikasi_pengajuan_pindah_cabang_baru', $pindah_cabang_id) }}" class="form-horizontal" enctype="multipart/form-data" onsubmit="if ($('#cek_verif_cabang').val() == 'y') { return true; } else { alert('{{ $alert_cabang }}'); return false; }">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <input type="hidden" name="member_id" id="member_id" value="{{$member_id}}">
                                <input type="hidden" name="admin_cabang_id" id="admin_cabang_id" value="{{$data_pindah_cabang['ke_cabang']}}">
                            </div> 
                            <div class="form-group">
                                <label for="kode_wilayah" style="text-align: right;" class="col-md-4 control-label">
                                    Kode Wilayah <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-md-7">
                                    <select data-placeholder="Pilih Kode Wilayah" class="select22" name="kode_wilayah" id="kode_wilayah" required="" style="width: 100%" onchange="generate_kode_nomor_pabi('#formVerifPindahCabang2')">
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
                                    <select data-placeholder="Pilih Kode Kota" class="select22" name="kode_kota" id="kode_kota" required="" style="width: 100%" onchange="generate_kode_nomor_pabi('#formVerifPindahCabang2')">
                                        <option value="">-- Pilih Kode Kota --</option>
                                        <?php
                                        foreach ($data_admin_cabang as $dac) {
                                            $sel_adm_cab = '';
                                            $stl_sel = '';
                                            if ($card_no[1] == $dac['kode_bandara'] || (session('pabi_role_id') == 3 && session('admin_cabang_id') == $dac['id'])) {
                                                $sel_adm_cab = 'selected=""';
                                            }
                                            if ($data_pindah_cabang['ke_cabang'] == $dac['id']) {
                                                $stl_sel = ' style="background-color: green;"';
                                            }
                                            echo '<option value="' . $dac['kode_bandara'] . '" ' . $sel_adm_cab.$stl_sel . '>' . $dac['name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kode_bulan" style="text-align: right;" class="col-md-4 control-label">
                                    Bulan <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-md-7">
                                    <select data-placeholder="Pilih Bulan" class="select22" name="kode_bulan" id="kode_bulan" required="" style="width: 100%" onchange="generate_kode_nomor_pabi('#formVerifPindahCabang2')">
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
                                    <input type="number" class="form-control" name="kode_tahun" id="kode_tahun" value="{{$tahun}}" required="" readonly="" oninput="generate_kode_nomor_pabi('#formVerifPindahCabang2')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="no_urut" style="text-align: right;" class="col-md-4 control-label">
                                    Nomor Urut <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-md-7"> 
                                    <input type="text" name="no_urut" id="no_urut" maxlength="4" required="" value="{{$card_no[4]}}" class="form-control" oninput="generate_kode_nomor_pabi('#formVerifPindahCabang2')">
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
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Setuju / Tidak Setuju : 
                                </label>
                                <div class="col-lg-7"> 
                                    <div class="onoffswitch">
                                        <input {{ $setuju }} type="checkbox" class="onoffswitch-checkbox"
                                        name="cabang_baru_verif" id="setuju_3">
                                        <label class="onoffswitch-label" for="setuju_3">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Keterangan <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <textarea required="required" name="cabang_baru_ket" id="keterangan_3" placeholder="Keterangan Tambahan" class="form-control summernote" rows="4">{{ $data_pindah_cabang['cabang_baru_ket'] }}</textarea>
                                </div>
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="icon-check"></i> Simpan</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    if($('.select22').length){
        $('.select22').select2();
    } 
    $( document ).ready(function() { 

        //CKEditor
        // CKEDITOR.replace('ckeditors');
        // CKEDITOR.config.height = 300;  
        // $('.summernote').each(function(e){  
        //     CKEDITOR.replace(this.id,{  
        //         uiColor : '#b2cefe ' 
        //     }); 

        // }); 
    }); 
</script>