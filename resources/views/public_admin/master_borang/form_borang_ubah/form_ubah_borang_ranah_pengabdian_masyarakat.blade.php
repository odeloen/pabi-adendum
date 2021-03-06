<form class="form-horizontal" id="formUbahBorangRanahPengabdianMasyarakat" onsubmit="ubah_pengabdian_masyarakat('{{csrf_token()}}', '#formUbahBorangRanahPengabdianMasyarakat', '.btn_ubah_pengabdian_masyarakat'); return false;">
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
            <label for="tanggal_mulai" style="text-align: right;" class="col-md-4 control-label">
                Tanggal Mulai <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required="" value="{{$data_histori_kegiatan['tanggal_mulai']}}" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="tanggal_selesai" style="text-align: right;" class="col-md-4 control-label">
                Tanggal Selesai <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required="" value="{{$data_histori_kegiatan['tanggal_selesai']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jenis_kegiatan_detail">
            <label for="jenis_kegiatan_detail" style="text-align: right;" class="col-md-4 control-label">
                Detail Jenis Kegiatan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jenis_kegiatan_detail" name="jenis_kegiatan_detail" required="" value="{{$data_histori_kegiatan['jenis_kegiatan']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_nama_organisasi_event">
            <label for="nama_organisasi_event" style="text-align: right;" class="col-md-4 control-label">
                Nama Organisasi Event <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="nama_organisasi_event" name="nama_organisasi_event" required="" value="{{$data_histori_kegiatan['nama_organisasi_event']}}">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_jabatan">
            <label for="jabatan" style="text-align: right;" class="col-md-4 control-label">
                Jabatan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="jabatan" name="jabatan" required="" value="{{$data_histori_kegiatan['jabatan']}}">  
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
        <button type="submit" class="btn btn-primary btn_ubah_pengabdian_masyarakat">
            <i class="icon-check"></i> Ubah Borang
        </button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        borang_ranah_pengabdian_masyarakat('#formUbahBorangRanahPengabdianMasyarakat');
    });
</script>