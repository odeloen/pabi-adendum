<?php $id_member = $data_member['id']; ?>
<form class="form-horizontal" enctype="multipart/form-data" onsubmit="simpan_div_data_idi_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_idi');
    return false;">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="admin_cab_id" style="text-align: right;" class="col-md-4 control-label">
            Admin Cabang <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select required="required" data-placeholder="Pilih Admin Cabang" class="select22" name="admin_cab_id" id="keanggotaan_admin_cab_id" style="width: 100%" onchange="$('#keanggotaan_admin_pst_id').val($('#keanggotaan_admin_cab_id').find('option:selected').attr('admpstid'));">
                <option value="" admpstid="">-- Select Admin Cabang--</option> 
                <?php
                foreach ($data_admin_cabang as $dac) {
                    $sel_adm_cab = '';
                    if (session('pabi_role_id') == 4 && ($data_member['cabang_verif'] == 2 || $data_member['cabang_verif'] == 3 || $data_member['pusat_verif'] == 2)) {
                        if ($data_member['admin_cabang_id'] == $dac['id']) {
                            $sel_adm_cab = 'selected=""';
                        } else {
                            $sel_adm_cab = 'disabled=""';
                        }
                    } else {
                        if ($data_member['admin_cabang_id'] == $dac['id']) {
                            $sel_adm_cab = 'selected=""';
                        }
                    }
                    echo '<option value="'.$dac['id'].'" admpstid="'.$dac['admin_pusat_id'].'" '.$sel_adm_cab.'>'.$dac['name'].'</option>';
                }
                ?>
            </select>
            <input type="hidden" name="admin_pst_id" id="keanggotaan_admin_pst_id" value="{{ $data_member['admin_pusat_id'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="tempat_kerja" style="text-align: right;" class="col-md-4 control-label">
            Nama Kantor <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="tempat_kerja" id="keanggotaan_tempat_kerja" value="{{ $data_member['tempat_kerja'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="alamat_kantor" style="text-align: right;" class="col-md-4 control-label">
            Alamat Kantor <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <textarea required="required" style="resize: none;" name="alamat_kantor" id="keanggotaan_alamat_kantor" placeholder="Alamat Lengkap Kantor" class="form-control" rows="4">{{ $data_member['alamat_kantor'] }}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="alamat_kantor" style="text-align: right;" class="col-md-4 control-label">
            Telepon Kantor <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="no_telp_kantor" id="keanggotaan_no_telp_kantor" value="{{ $data_member['no_telp_kantor'] }}">
        </div>
    </div>

    <div class="form-group">
        <label for="jabatan" style="text-align: right;" class="col-md-4 control-label">
            Jabatan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="jabatan" id="keanggotaan_jabatan" value="{{ $data_member['jabatan'] }}">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label for="card_no" style="text-align: right;" class="col-md-4 control-label">
            Nomor Anggota : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="card_no" id="keanggotaan_card_no" value="{{ $data_member['card_no'] }}">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label for="valid_until_card_no" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Validasi Nomor Anggota : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="valid_until_card_no" id="keanggotaan_valid_until_card_no" value="{{ $data_member['valid_until_card_no'] }}">
        </div>
    </div> 

    <div class="form-group" style="display: none">
        <label for="valid_until_card_no" style="text-align: right;" class="col-md-4 control-label">
            Anggota PABI Sejak Tanggal : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" value="{{ $data_member['valid_until_card_no'] }}">
        </div>
    </div>

    <div class="form-group">
        <label for="no_pabi_sejahtera" style="text-align: right;" class="col-md-4 control-label">
            No PABI Sejahtera : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="no_pabi_sejahtera" id="keanggotaan_no_pabi_sejahtera" value="{{ $data_member['no_pabi_sejahtera'] }}" readonly="">
        </div>
    </div>
    <div class="form-group">
        <label for="tgl_pabi_sejahtera" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Validasi No PABI Sejahtera : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_pabi_sejahtera" id="keanggotaan_tgl_pabi_sejahtera" value="{{ $data_member['tgl_pabi_sejahtera'] }}" readonly="">
        </div>
    </div>
    <div class="form-group">
        <label for="no_str" style="text-align: right;" class="col-md-4 control-label">
            No STR : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="no_str" id="keanggotaan_no_str" value="{{ $data_member['no_str'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="sjk_tahun_no_str" style="text-align: right;" class="col-md-4 control-label">
            Tahun No STR : 
        </label>
        <div class="col-md-7"> 
            <input type="number" class="form-control" name="sjk_tahun_no_str" id="keanggotaan_sjk_tahun_no_str" value="{{ $data_member['sjk_tahun_no_str'] }}">
        </div>
    </div> 

    <div class="form-group">
        <label for="no_surat_KIB" style="text-align: right;" class="col-md-4 control-label">
            Surat Kompetensi Kolegium I. Bedah : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="no_skk_bedah" id="keanggotaan_no_skk_bedah" value="{{ $data_member['no_skk_bedah'] }}">
        </div>
    </div>

    <div class="form-group">
        <label for="valid_until_card_no" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Surat Kompetensi Kolegium I. Bedah : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_skk_bedah" id="keanggotaan_tgl_skk_bedah" value="{{ $data_member['tgl_skk_bedah'] }}">
        </div>
    </div> 

    <div class="form-group">
        <label for="no_sip" style="text-align: right;" class="col-md-4 control-label">
            No SIP : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="no_sip_terakhir" id="keanggotaan_no_sip_terakhir" value="{{ $data_member['no_sip_terakhir'] }}">
        </div>
    </div> 
    <div class="form-group">
        <label for="tanggalmulai_sip" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Mulai SIP : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_sip_mulai" id="keanggotaan_tgl_sip_mulai" value="{{ $data_member['tgl_sip_mulai'] }}">
        </div>
    </div> 
    <div class="form-group">
        <label for="valid_until_card_no" style="text-align: right;" class="col-md-4 control-label">
            Tanggal Selesai SIP : 
        </label>
        <div class="col-md-7"> 
            <input type="date" class="form-control" name="tgl_sip_selesai" id="keanggotaan_tgl_sip_selesai" value="{{ $data_member['tgl_sip_selesai'] }}">
        </div>
    </div> 
    <div class="form-group">
        <label for="keterangan" style="text-align: right;" class="col-md-4 control-label">
            Keterangan : 
        </label>
        <div class="col-md-7"> 
            <textarea style="resize: none;" name="keterangan" id="keanggotaan_keterangan" placeholder="Keterangan" class="form-control" rows="4">{{ $data_member['keterangan'] }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_idi" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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