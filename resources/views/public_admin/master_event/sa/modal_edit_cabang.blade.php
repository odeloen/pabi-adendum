<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Edit Event
                    </a>
                </li> 
            </ul>
            <?php $id = $data_event['id']; ?>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form class="form-horizontal" enctype="multipart/form-data" id="formUbahEventAdminCabang" 
                    onsubmit="
                    if ($('#kordinat_event').val() == '' || $('#kordinat_event').val() == ';') {
                        pemberitahuan('Koordinat Belum Diisi');
                        return false;
                    } else {
                        simpan_form_ubah_event_admin_cabang('{{csrf_token()}}', '{{$id}}', '.btn_simpan_form_ubah_event_admin_cabang'); 
                        return false; 
                    }
                    ">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <?php
                            $discoladm = '';
                            if (session('pabi_role_id') != 1) {
                                $discoladm=' style="display:none;"';
                            }
                            ?>
                            <div class="form-group"<?php echo $discoladm; ?>>
                                <label for="" style="text-align: right;" class="col-lg-3 control-label">
                                    Penyelenggara <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">
                                    <select data-placeholder="Pilih Admin Cabang" class="select22" name="admin_cab_id" id="admin_cab_id" style="width: 100%" required="" onchange="isa_data_bank_admin('#formUbahEventAdminCabang', 'admin_cab_id')">
                                        <option value="">-- Select Admin Cabang--</option> 
                                        <?php
                                        foreach ($data_admin_cabang as $dac) {
                                            $sel_adm_cab = '';
                                            if (session('pabi_role_id') == 2 && session('admin_cabang_id') == $dac['id']) {
                                                $sel_adm_cab = 'selected=""';
                                            } else {
                                                if ($data_event['admin_cabang_id'] == $dac['id']) {
                                                    $sel_adm_cab = 'selected=""';
                                                }
                                            }

                                            echo '<option bank="'.$dac['nama_bank'].'" rekening="'.$dac['no_rek'].'" pemilik="'.$dac['pemilik_rek'].'" value="'.$dac['id'].'" '.$sel_adm_cab.'>'.$dac['name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="admin_pst_id" id="admin_pst_id" value="{{ $data_event['admin_pusat_id'] }}">
                                    <?php
                                    $jenis_event = 'Event Cabang';
                                    if (!empty($data_event['jenis_event'])) {
                                        $jenis_event = $data_event['jenis_event'];
                                    }
                                    ?>
                                    <input type="hidden" value="{{$jenis_event}}" name="jenis_event" id="jenis_event">
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="nama_event" style="text-align: right;" class="col-lg-3 control-label">
                                    Nama Event <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="text" class="form-control" value="{{ $data_event['nama_event'] }}" name="nama_event" id="nama_event" required="">  
                                </div>
                            </div>
                            <?php
                            $backup_sel_simposium = '';
                            foreach ($data_event_simposium as $des) {
                                if ($data_event['id'] != $des['id']) {
                                    $backup_sel_simposium .= '<option value="'.$des['id'].'">'.$des['nama_event'].' ('.$des['jenis_event'].'-Simposium)</option>';   
                                }
                            }
                            ?>
                            <div class="form-group">
                                <label for="jenis_event_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Jenis Event <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">
                                    <select data-placeholder="Pilih Jenis Event" class="select22" name="jenis_event_id" id="jenis_event_id" style="width: 100%" required="" onchange="
                                    if (this.value == 1) {
                                        $('.penumpangan_event').show(500);
                                        ganti_isi();
                                    } else {
                                        $('.penumpangan_event').hide(500);
                                        $('#numpang_simposium_event_id').html('');
                                    }
                                    ">
                                        <?php
                                        $cek_sel_jei = '';
                                        foreach ($data_jenis_event as $dje) {
                                            $sel_jei = '';
                                            if ($data_event['jenis_event_id'] == $dje['id']) {
                                                $sel_jei = 'selected=""';
                                                $cek_sel_jei = 'ok';
                                            }
                                            if ($dje['id'] == 2 && $cek_sel_jei == '') {
                                                $sel_jei = 'selected=""';
                                            }
                                            echo '<option value="'.$dje['id'].'" '.$sel_jei.'>'.$dje['nama_jenis_event'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group penumpangan_event" <?php if($data_event['jenis_event_id'] != 1) { echo 'style="display: none;"'; } ?>>
                                <label for="numpang_simposium_event_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Numpang Simposium <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">
                                    <select data-placeholder="Pilih Penumpangan Event" class="select22" name="numpang_simposium_event_id" id="numpang_simposium_event_id" style="width: 100%">
                                        <?php
                                        if ($data_event['jenis_event_id'] == 1) {
                                            foreach ($data_event_simposium as $des) {
                                                $sel_nsei = '';
                                                if ($data_event['numpang_simposium_event_id'] == $des['id']) {
                                                    $sel_nsei = 'selected=""';
                                                }
                                                if ($data_event['id'] != $des['id']) {
                                                    echo '<option value="'.$des['id'].'" '.$sel_nsei.'>'.$des['nama_event'].' ('.$des['jenis_event'].'-Simposium)</option>';   
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="tgl_event" style="text-align: right;" class="col-lg-3 control-label">
                                    Tanggal Event <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="date" class="form-control" value="{{ $data_event['tgl_event'] }}" name="tgl_event" id="tgl_event" required="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="jam_mulai" style="text-align: right;" class="col-lg-3 control-label">
                                    Jam Mulai Dan Selesai <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-3"> 
                                    <input type="time" class="form-control" value="{{ $data_event['jam_mulai'] }}" name="jam_mulai" id="jam_mulai" required="">  
                                </div> 

                                <label for="s-d" style="text-align: center;" class="col-lg-2 control-label">
                                    S/D: 
                                </label>

                                <div class="col-lg-3"> 
                                    <input type="time" class="form-control" value="{{ $data_event['jam_selesai'] }}" name="jam_selesai" id="jam_selesai" required="">  
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto_event" style="text-align: right;" class="col-lg-3 control-label">
                                    Logo Event : 
                                </label>
                                <div class="col-lg-8">
                                    <input type="file" name="foto_event" id="foto_event" class="file-styled">
                                    <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="max_event" style="text-align: right;" class="col-lg-3 control-label">
                                    Max Peserta <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="number" class="form-control" value="{{ $data_event['max_event'] }}" name="max_event" id="max_event" min="1" required="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="nama_bank" style="text-align: right;" class="col-lg-3 control-label">
                                    Nama Bank <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="text" class="form-control" name="nama_bank" id="nama_bank" value="{{ $data_event['nama_bank'] }}" required="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="no_rek" style="text-align: right;" class="col-lg-3 control-label">
                                    Nomor Rekening <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="text" class="form-control" name="no_rek" id="no_rek" value="{{ $data_event['no_rek'] }}" required="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="pemilik_rek" style="text-align: right;" class="col-lg-3 control-label">
                                    Nama Pemilik Rekening <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="text" class="form-control" name="pemilik_rek" id="pemilik_rek" value="{{ $data_event['pemilik_rek'] }}" required="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="deskripsi" style="text-align: right;" class="col-lg-3 control-label">
                                    Deskripsi : 
                                </label>
                                <div class="col-lg-8">  
                                    <textarea name="deskripsi" id="deskripsi" placeholder="Alamat Diselenggarakannya Event" class="form-control" rows="3">{{ $data_event['deskripsi'] }}</textarea>
                                </div>
                            </div>        
                            <div class="form-group status_lengkap">
                                <label for="prov_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Provinsi <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">
                                    <select required="" data-placeholder="Pilih Provinsi" class="select22" style="width: 100%" name="prov_id" id="prov_id" onchange="kota_by_provinsi_id('{{csrf_token()}}', '#formUbahEventAdminCabang', 0)">
                                        <option value="">-- Pilih Provinsi Diselenggarakannya Event --</option> 
                                        @foreach ($data_provinsi as $dp)
                                        <?php
                                        $sel = '';
                                        if ($data_event['prov_id'] == $dp['id_prov']) {
                                            $sel = 'selected=""';
                                        }
                                        ?>
                                        <option value="{{ $dp['id_prov'] }}" {{$sel}}>{{ $dp['nama'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="kota_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Kabupaten/Kota <span style="color:red"><b>*</b></span> : 
                                </label>
                                <?php $kota_id = $data_event['kota_id']; ?>
                                <div class="col-lg-8">
                                    <select required="" class="select22" style="width: 100%" name="kota_id" id="kota_id" onchange="kecamatan_by_kota_id('{{csrf_token()}}', '#formUbahEventAdminCabang', 0, 0)">
                                        <option value="">-- Pilih Kabupaten/Kota  --</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="kec_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Kecamatan <span style="color:red"><b>*</b></span> : 
                                </label>
                                <?php $kec_id = $data_event['kec_id']; ?>
                                <div class="col-lg-8">
                                    <select required="" class="select22" style="width: 100%" name="kec_id" id="kec_id">
                                        <option value="">-- Pilih Kecamatan Diselenggarakannya Event --</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="lokasi_alamat" style="text-align: right;" class="col-lg-3 control-label">
                                    Alamat Event <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">  
                                    <textarea style="resize: none;" required="" name="lokasi_alamat" id="lokasi_alamat" placeholder="Alamat Diselenggarakannya Event" class="form-control" rows="3">{{$data_event['lokasi_alamat']}}</textarea>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="kordinat" style="text-align: right;" class="col-lg-3 control-label">
                                    Kordinat <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">  
                                    <input type="text" class="form-control" name="kordinat" id="kordinat_event" required="required" readonly="" value="{{$data_event['lokasi_koordinat_x']}};{{$data_event['lokasi_koordinat_y']}}">
                                </div>
                            </div>
                            <div class="form-group status_lengkap"> 
                                <div class="col-lg-3">&nbsp;</div>
                                <div class="col-lg-8"> 
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <a href="#panel_map" class="collapsed" data-toggle="collapse" onclick="tambah_point('#div_tambah_point_peta', '{{csrf_token()}}', $('#kordinat_event').val(), '#kordinat_event');" style="color: white; cursor: pointer;">
                                                <h6 class="panel-title">
                                                    <i class="icon-folder-search"></i><strong> Pilih Koordinat Peta </strong>
                                                </h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li>
                                                        <!-- <a href="#panel_map" class="collapsed" data-toggle="collapse" onclick="
                                                            tambah_point('#div_tambah_point_peta', '{{csrf_token()}}', $('#kordinat_event').val(), '#kordinat_event');" >  -->
                                                            <i class="icon-arrow-down12 arrow" style="display: none" onclick="tgl('.arrow')"></i>
                                                            <i class="icon-arrow-up12 arrow" onclick="tgl('.arrow')"></i>
                                                            <!-- </a> -->
                                                        </li> 
                                                    </ul>
                                                </div>
                                            </a>
                                        </div> 
                                        <div class="collapse" id="panel_map">
                                            <div class="panel-body">
                                                <div id="div_tambah_point_peta" style="width: 100%">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                            <button type="submit" class="btn btn-primary btn-ladda btn_simpan_form_ubah_event_admin_cabang" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
                                <i class="icon-check"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function () {
        $('.select22').select2();
        kota_by_provinsi_id('{{csrf_token()}}', '#formUbahEventAdminCabang', '{{$kota_id}}');
        kecamatan_by_kota_id('{{csrf_token()}}', '#formUbahEventAdminCabang', '{{$kec_id}}', '{{$kota_id}}');
    });
    function ganti_isi(){
        $('#numpang_simposium_event_id').html('<?php echo $backup_sel_simposium; ?>');
    }
</script>