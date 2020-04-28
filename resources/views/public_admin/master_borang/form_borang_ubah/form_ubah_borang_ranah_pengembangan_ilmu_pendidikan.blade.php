<form class="form-horizontal" id="formUbahBorangRanahPengembanganIlmuPendidikan" onsubmit="ubah_pengembangan_ilmu_pendidikan('{{csrf_token()}}', '#formUbahBorangRanahPengembanganIlmuPendidikan', '.btn_ubah_pengembangan_ilmu_pendidikan'); return false;">
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
        <div class="form-group status_lengkap">
            <label for="nama_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Nama Kegiatan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="nama_kegiatan_id" value="{{$data_histori_kegiatan['master_kegiatan_id']}}" id="nama_kegiatan_id">
                <input type="text" class="form-control" value="{{$data_histori_kegiatan['nama_kegiatan']}}" id="nama_kegiatan" name="nama_kegiatan" required="">  
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
        <div class="form-group status_lengkap" id="div_judul_penelitian">
            <label for="judul_penelitian" style="text-align: right;" class="col-md-4 control-label">
                Judul Penelitian <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="judul_penelitian" name="judul_penelitian" required="" value="{{$data_histori_kegiatan['judul_penelitian']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_dipublikasikan_diserahkan_pada">
            <label for="ddp" style="text-align: right;" class="col-md-4 control-label">
                Publikasi Diserahkan pada <span style="color:red"><b>*</b></span> : 
            </label>
            <?php $ddp = explode(' ', $data_histori_kegiatan['dipublikasikan_diserahkan_pada']); ?>
            <div class="col-md-7"> 
                <input type="date" class="form-control" id="ddp" name="ddp" value="{{$ddp[0]}}" required="" style="width: 60%; float: left;">
                <input type="time" value="{{$ddp[1]}}" class="form-control" id="ddp_time" name="ddp_time" required="" style="width: 40%; float: right;">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_judul_matkul">
            <label for="judul_matkul" style="text-align: right;" class="col-md-4 control-label">
                Judul Mata Kuliah <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="judul_matkul" name="judul_matkul" required="" value="{{$data_histori_kegiatan['judul_matkul']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_institusi">
            <label for="institusi" style="text-align: right;" class="col-md-4 control-label">
                Institusi <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="institusi" name="institusi" required="" value="{{$data_histori_kegiatan['institusi']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_peran_serta">
            <label for="peran_serta" style="text-align: right;" class="col-md-4 control-label">
                Peran Serta <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="peran_serta" name="peran_serta" required="" value="{{$data_histori_kegiatan['peran_serta']}}">  
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
                <input type="text" class="form-control" id="tahun_periode" name="tahun_periode" required="" value="{{$data_histori_kegiatan['tahun']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_rs_id">
            <label for="rs_id" style="text-align: right;" class="col-md-4 control-label">
                Lokasi <span style="color:red"><b>*</b></span> : 
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
                    <option value="{{ $drs['id'] }}"<?php echo $sel_rs ?>>{{ $drs['nama'] }}<br>{{ $drs['alamat'] }}</option> 
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
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="icon-cross"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary btn_ubah_pengembangan_ilmu_pendidikan">
            <i class="icon-check"></i> Ubah Borang
        </button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        borang_ranah_pengembangaan_ilmu_pendidikan('#formUbahBorangRanahPengembanganIlmuPendidikan');
    });
</script>