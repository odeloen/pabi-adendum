<form class="form-horizontal" id="formBorangRanahProfesional" onsubmit="simpan_profesional('{{csrf_token()}}', '#formBorangRanahProfesional', '.btn_simpan_profesional'); return false;">
    <div class="modal-body">
        <div class="form-group">
            {{ csrf_field() }}
        </div>  
        <div class="form-group status_lengkap" style="display: none;">
            <label for="member_id" style="text-align: right;" class="col-md-4 control-label">
                Member Id : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" value="{{$member_id}}" id="member_id" name="member_id" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="ranah_borang" style="text-align: right;" class="col-md-4 control-label">
                Ranah Borang : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="ranah_borang_id" value="{{$ranah_borang_id}}" id="ranah_borang_id">
                <input type="text" class="form-control" value="{{$ranah_borang}}" id="ranah_borang" name="ranah_borang" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="jenis_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kegiatan : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="jenis_kegiatan_id" value="{{$jenis_kegiatan_id}}" id="jenis_kegiatan_id">
                <input type="text" class="form-control" value="{{$jenis_kegiatan}}" id="jenis_kegiatan" name="jenis_kegiatan" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap" style="display: none;">
            <label for="nama_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Nama Kegiatan : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="nama_kegiatan_id" value="{{$nama_kegiatan_id}}" id="nama_kegiatan_id">
                <input type="text" class="form-control" value="{{$nama_kegiatan}}" id="nama_kegiatan" name="nama_kegiatan" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="tanggal" style="text-align: right;" class="col-md-4 control-label">
                Tanggal Pelaksanaan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="date" class="form-control" id="tanggal" name="tanggal" required="" value="{{$tanggal_tabel}}" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_kode_kegiatan">
            <label for="kode_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Kode Kegiatan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_kegiatan_diagnostik">
            <label for="jenis_kegiatan_diagnostik" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kegiatan Diagnostik <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_kegiatan_diagnostik" name="jenis_kegiatan_diagnostik" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_peran_serta_diagnostik">
            <label for="peran_serta_diagnostik" style="text-align: right;" class="col-md-4 control-label">
                Peran Serta Diagnostik <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="peran_serta_diagnostik" name="peran_serta_diagnostik" required="">
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_tindakan_operasi">
            <label for="jenis_tindakan_operasi" style="text-align: right;" class="col-md-4 control-label">
                Jenis Tindakan Operasi <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="" class="select22" name="jenis_tindakan_operasi" id="jenis_tindakan_operasi" style="width: 100%" onchange="tindakan_by_jenis_tindakan('{{csrf_token()}}', '#formBorangRanahProfesional', 'operasi')">
                    <option value="">-- Pilih Jenis Tindakan --</option>
                    @foreach ($data_kompetensi as $dk)
                    <?php $i = explode('. ', $dk['jenis_tindakan']); ?>
                    <option value="{{ $i[1] }}">{{ $i[1] }}</option>
                    @endforeach
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
                </select>  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_operasi">
            <label for="jenis_operasi" style="text-align: right;" class="col-md-4 control-label">
                Jenis Operasi <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_operasi" name="jenis_operasi" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_no_rekam_medik">
            <label for="no_rekam_medik" style="text-align: right;" class="col-md-4 control-label">
                No Rekam Medik <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="no_rekam_medik" name="no_rekam_medik" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_kasus_bedah">
            <label for="jenis_kasus_bedah" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kasus Bedah <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_kasus_bedah" name="jenis_kasus_bedah" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_tindakan_bedah">
            <label for="jenis_tindakan_bedah" style="text-align: right;" class="col-md-4 control-label">
                Jenis Tindakan Bedah <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="" class="select22" name="jenis_tindakan_bedah" id="jenis_tindakan_bedah" style="width: 100%" onchange="tindakan_by_jenis_tindakan('{{csrf_token()}}', '#formBorangRanahProfesional', 'bedah')">
                    <option value="">-- Pilih Jenis Tindakan --</option>
                    @foreach ($data_kompetensi as $dk)
                    <?php $i = explode('. ', $dk['jenis_tindakan']); ?>
                    <option value="{{ $i[1] }}">{{ $i[1] }}</option>
                    @endforeach
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
                </select>  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_kasus_rujukan">
            <label for="jenis_kasus_rujukan" style="text-align: right;" class="col-md-4 control-label">
                Jenis Kasus Rujukan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_kasus_rujukan" name="jenis_kasus_rujukan" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_tujuan_rujukan">
            <label for="tujuan_rujukan" style="text-align: right;" class="col-md-4 control-label">
                Tujuan Rujukan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="tujuan_rujukan" name="tujuan_rujukan" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_nilai_skp">
            <label for="nilai_skp" style="text-align: right;" class="col-md-4 control-label">
                Poin SKP <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <select required="required" data-placeholder="Pilih Nilai SKP" class="select22" name="nilai_skp" id="nilai_skp" style="width: 100%">
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
                <input type="text" class="form-control" id="tahun_periode" name="tahun_periode" required="" value="{{$tahun_periode}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_rs_id">
            <label for="rs_id" style="text-align: right;" class="col-md-4 control-label">
                Lokasi Rumah Sakit <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7">
                <select data-placeholder="Pilih Lokasi Rumah Sakit" class="select22" name="rs_id" id="rs_id" required=""> 
                    <option value="">-- Pilih--</option>
                    @foreach ($data_rs as $drs) 
                    <option value="{{ $drs['id'] }}">{{ $drs['nama'] }} ({{ $drs['alamat'] }})</option> 
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_lokasi_alamat">
            <label for="lokasi_alamat" style="text-align: right;" class="col-lg-4 control-label">
                Alamat Praktek <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-lg-7">  
                <textarea style="resize: none;" required="" name="lokasi_alamat" id="lokasi_alamat" placeholder="Alamat Praktek Operasi Diselenggarakan" class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_koordinat">
            <label for="koordinat" style="text-align: right;" class="col-lg-4 control-label">
                Koordinat <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-lg-7">  
                <input type="text" class="form-control" name="koordinat" id="koordinat_borang_operasi" required="" readonly="">
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
        <button type="button" class="btn btn-danger" onclick="$('#penampil_form_borang').removeAttr('style'); $('#tempat_form_borang_tambah').css('display','none');">
            <i class="icon-chevron-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-primary btn_simpan_profesional btn-ladda"  data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
            <i class="icon-check"></i> Tambah Borang
        </button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        $('#tempat_form_borang_tambah').removeAttr('style');
        borang_ranah_profesional('#formBorangRanahProfesional');
    });
</script>