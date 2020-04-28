<form class="form-horizontal" id="formUbahBorangRanahProfesional" onsubmit="ubah_profesional('{{csrf_token()}}', '#formUbahBorangRanahProfesional', '.btn_ubah_profesional'); return false;">
    <div class="modal-body">
        <div class="form-group">
            {{ csrf_field() }}
        </div>  
        <div class="form-group status_lengkap" style="display: none;">
            <label for="member_id" style="text-align: right;" class="col-md-4 control-label">
                Member Id : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" value="{{$data_histori_kegiatan['member_id']}}" id="member_id" name="member_id" readonly="">
                <input type="hidden" name="histori_id" id="histori_id" value="{{$data_histori_kegiatan['id']}}">
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="ranah_borang" style="text-align: right;" class="col-md-4 control-label">
                Ranah Borang : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="ranah_borang_id" value="{{$data_histori_kegiatan['master_ranah_borang_id']}}" id="ranah_borang_id">
                <input type="text" class="form-control" value="{{$data_histori_kegiatan['nama_ranah']}}" id="ranah_borang" name="ranah_borang" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="jenis_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kegiatan : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="jenis_kegiatan_id" value="{{$data_histori_kegiatan['master_jenis_kegiatan_id']}}" id="jenis_kegiatan_id">
                <input type="text" class="form-control" value="{{$data_histori_kegiatan['nama_jenis_kegiatan']}}" id="jenis_kegiatan" name="jenis_kegiatan" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap" style="display: none;">
            <label for="nama_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Nama Kegiatan : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="nama_kegiatan_id" value="{{$data_histori_kegiatan['master_kegiatan_id']}}" id="nama_kegiatan_id">
                <input type="text" class="form-control" value="{{$data_histori_kegiatan['nama_master_kegiatan']}}" id="nama_kegiatan" name="nama_kegiatan" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="tanggal" style="text-align: right;" class="col-md-4 control-label">
                Tanggal <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="date" class="form-control" id="tanggal" name="tanggal" required="" value="{{$data_histori_kegiatan['tanggal']}}" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_kode_kegiatan">
            <label for="kode_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Kode Kegiatan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan" required="" value="{{$data_histori_kegiatan['kode_kegiatan']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_kegiatan_diagnostik">
            <label for="jenis_kegiatan_diagnostik" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kegiatan Diagnostik <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_kegiatan_diagnostik" name="jenis_kegiatan_diagnostik" required="" value="{{$data_histori_kegiatan['jenis_kegiatan_diagnostik']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_peran_serta_diagnostik">
            <label for="peran_serta_diagnostik" style="text-align: right;" class="col-md-4 control-label">
                Peran Serta Diagnostik <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="peran_serta_diagnostik" name="peran_serta_diagnostik" required="" value="{{$data_histori_kegiatan['peran_serta_diagnostik']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_tindakan_operasi">
            <label for="jenis_tindakan_operasi" style="text-align: right;" class="col-md-4 control-label">
                Jenis Tindakan Operasi <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="" class="select22" name="jenis_tindakan_operasi" id="jenis_tindakan_operasi" style="width: 100%" onchange="tindakan_by_jenis_tindakan('{{csrf_token()}}', '#formBorangRanahProfesional', 'operasi')">
                    <option value="">-- Pilih Jenis Tindakan --</option>
                    @if (!empty($data_kompetensi_o))
                    @foreach ($data_kompetensi_o as $dk)
                    <?php 
                    $i = explode('. ', $dk['jenis_tindakan']);
                    $seljto = '';
                    if ($i[1] == $data_histori_kegiatan['jenis_tindakan_operasi']) {
                        $seljto = ' selected=""';
                    } 
                    ?>
                    <option value="{{ $i[1] }}"<?php echo $seljto; ?>>{{ $i[1] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_nama_tindakan_operasi">
            <label for="nama_tindakan_operasi" style="text-align: right;" class="col-md-4 control-label">
                Nama Tindakan Operasi <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="" class="select22" name="nama_tindakan_operasi" id="nama_tindakan_operasi" style="width: 100%">
                    <option value="">-- Pilih Tindakan Operasi --</option>
                    @if (!empty($data_tindakan_o))
                    @foreach ($data_tindakan_o as $dt)
                    <?php 
                    $selto = '';
                    if ($dt['tindakan'] == $data_histori_kegiatan['nama_tindakan_operasi']) {
                        $selto = ' selected=""';
                    } 
                    ?>
                    <option value="{{ $dt['tindakan'] }}"<?php echo $selto; ?>>{{ $dt['tindakan'] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_operasi">
            <label for="jenis_operasi" style="text-align: right;" class="col-md-4 control-label">
                Jenis Operasi <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_operasi" name="jenis_operasi" required="" value="{{$data_histori_kegiatan['jenis_operasi']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_no_rekam_medik">
            <label for="no_rekam_medik" style="text-align: right;" class="col-md-4 control-label">
                No Rekam Medik <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="no_rekam_medik" name="no_rekam_medik" required="" value="{{$data_histori_kegiatan['no_rekam_medik']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_kasus_bedah">
            <label for="jenis_kasus_bedah" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kasus Bedah <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_kasus_bedah" name="jenis_kasus_bedah" required="" value="{{$data_histori_kegiatan['jenis_kasus_bedah']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_tindakan_bedah">
            <label for="jenis_tindakan_bedah" style="text-align: right;" class="col-md-4 control-label">
                Jenis Tindakan Bedah <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="" class="select22" name="jenis_tindakan_bedah" id="jenis_tindakan_bedah" style="width: 100%" onchange="tindakan_by_jenis_tindakan('{{csrf_token()}}', '#formBorangRanahProfesional', 'bedah')">
                    <option value="">-- Pilih Jenis Tindakan --</option>
                    @if (!empty($data_kompetensi_b))
                    @foreach ($data_kompetensi_b as $dk)
                    <?php 
                    $i = explode('. ', $dk['jenis_tindakan']);
                    $seljtb = '';
                    if ($i[1] == $data_histori_kegiatan['jenis_tindakan_bedah']) {
                        $seljtb = ' selected=""';
                    } 
                    ?>
                    <option value="{{ $i[1] }}"<?php echo $seljtb; ?>>{{ $i[1] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_nama_tindakan_bedah">
            <label for="nama_tindakan_bedah" style="text-align: right;" class="col-md-4 control-label">
                Nama Tindakan Bedah <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="" class="select22" name="nama_tindakan_bedah" id="nama_tindakan_bedah" style="width: 100%">
                    <option value="">-- Pilih Tindakan Bedah --</option>
                    @if (!empty($data_tindakan_b))
                    @foreach ($data_tindakan_b as $dt)
                    <?php 
                    $seltb = '';
                    if ($dt['tindakan'] == $data_histori_kegiatan['nama_tindakan_bedah']) {
                        $seltb = ' selected=""';
                    } 
                    ?>
                    <option value="{{ $dt['tindakan'] }}"<?php echo $seltb; ?>>{{ $dt['tindakan'] }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_kasus_rujukan">
            <label for="jenis_kasus_rujukan" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kasus Rujukan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_kasus_rujukan" name="jenis_kasus_rujukan" required="" value="{{$data_histori_kegiatan['jenis_kasus_rujukan']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_tujuan_rujukan">
            <label for="tujuan_rujukan" style="text-align: right;" class="col-md-4 control-label">
                Tujuan Rujukan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="tujuan_rujukan" name="tujuan_rujukan" required="" value="{{$data_histori_kegiatan['tujuan_rujukan']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_nilai_skp">
            <label for="nilai_skp" style="text-align: right;" class="col-md-4 control-label">
                Poin SKP <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="" data-placeholder="Pilih Nilai SKP" class="select22" name="nilai_skp" id="nilai_skp" style="width: 100%">
                    <?php echo $select_nilai_skp; ?>
                </select>
                <!-- <input type="text" class="form-control" id="nilai_skp" name="nilai_skp" required="">   -->
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_tahun_periode">
            <label for="tahun_periode" style="text-align: right;" class="col-md-4 control-label">
                Tahun Periode <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="tahun_periode" name="tahun_periode" required="" value="{{$data_histori_kegiatan['tahun']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_rs_id">
            <label for="rs_id" style="text-align: right;" class="col-md-4 control-label">
                Lokasi Rumah Sakit<span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7">
                <select data-placeholder="Pilih Lokasi Rumah Sakit" class="select22" name="rs_id" id="rs_id" required=""> 
                    <option value="">-- Pilih--</option>
                    @foreach ($data_rs as $drs) 
                    <?php
                    $sel_rs = '';
                    if ($drs['id'] == $data_histori_kegiatan['rs_id']) {
                        $sel_rs = ' selected=""';
                    }
                    ?>
                    <option value="{{ $drs['id'] }}"<?php echo $sel_rs ?>>{{ $drs['nama'] }} ({{ $drs['alamat'] }})</option> 
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_lokasi_alamat">
            <label for="lokasi_alamat" style="text-align: right;" class="col-lg-4 control-label">
                Alamat Praktek <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-lg-7">  
                <textarea style="resize: none;" required="" name="lokasi_alamat" id="lokasi_alamat" placeholder="Alamat Praktek Operasi Diselenggarakan" class="form-control" rows="2">{{$data_histori_kegiatan['lokasi_alamat']}}</textarea>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_koordinat">
            <label for="koordinat" style="text-align: right;" class="col-lg-4 control-label">
                Koordinat <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-lg-7">  
                <input type="text" class="form-control" name="koordinat" id="koordinat_borang_operasi" required="" readonly="" value="{{$data_histori_kegiatan['lokasi_koordinat_x']}};{{$data_histori_kegiatan['lokasi_koordinat_y']}}">
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_induk_peta_borang_profesional"> 
            <div class="col-lg-4">&nbsp;</div>
            <div class="col-lg-7"> 
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h6 class="panel-title">
                            <i class="icon-folder-search"></i><strong> Pilih Koordinat Peta </strong>
                        </h6>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li>
                                    <a href="#panel_map" class="collapsed" data-toggle="collapse" onclick="
                                    tambah_point_borang('#div_peta_borang_profesional', '{{csrf_token()}}', $('#koordinat_borang_operasi').val(), '#koordinat_borang_operasi');" > 
                                    <i class="icon-arrow-down12 arrow" style="display: none" onclick="tgl('.arrow')"></i>
                                    <i class="icon-arrow-up12 arrow" onclick="tgl('.arrow')"></i></a>
                                </li> 
                            </ul>
                        </div>
                    </div> 
                    <div class="collapse" id="panel_map">
                        <div class="panel-body">
                            <div id="div_peta_borang_profesional" style="width: 100%">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="icon-cross"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary btn_ubah_profesional">
            <i class="icon-check"></i> Ubah Borang
        </button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        borang_ranah_profesional('#formUbahBorangRanahProfesional');
    });
</script>