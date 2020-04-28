<form class="form-horizontal" id="formBorangRanahKegiatanPembelajaranPribadi" onsubmit="simpan_kegiatan_pembelajaran_pribadi('{{csrf_token()}}', '#formBorangRanahKegiatanPembelajaranPribadi', '.btn_simpan_kegiatan_pembelajaran_pribadi'); return false;">
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
        <div class="form-group status_lengkap">
            <label for="nama_kegiatan" style="text-align: right;" class="col-md-4 control-label">
                Nama Kegiatan <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="hidden" name="nama_kegiatan_id" value="{{$nama_kegiatan_id}}" id="nama_kegiatan_id">
                <input type="text" class="form-control" value="{{$nama_kegiatan}}" id="nama_kegiatan" name="nama_kegiatan" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap">
            <label for="tanggal" style="text-align: right;" class="col-md-4 control-label">
                Tanggal <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="date" class="form-control" id="tanggal" name="tanggal" required="" value="{{$tanggal_tabel}}" readonly="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_nama_jurnal_situsweb">
            <label for="nama_jurnal_situsweb" style="text-align: right;" class="col-md-4 control-label">
                Situs Web Jurnal <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="nama_jurnal_situsweb" name="nama_jurnal_situsweb" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_judul_artikel_topik">
            <label for="judul_artikel_topik" style="text-align: right;" class="col-md-4 control-label">
                Topik/Judul Jurnal <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="judul_artikel_topik" name="judul_artikel_topik" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_tempat">
            <label for="tempat" style="text-align: right;" class="col-md-4 control-label">
                Tempat <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="tempat" name="tempat" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_peran_serta">
            <label for="peran_serta" style="text-align: right;" class="col-md-4 control-label">
                Sebagai <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="peran_serta" name="peran_serta" required="">  
            </div>
        </div>
        <div class="form-group status_lengkap" id="div_penyelenggara">
            <label for="penyelenggara" style="text-align: right;" class="col-md-4 control-label">
                Penyelenggara <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7"> 
                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required="">  
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
                Lokasi <span style="color:red"><b>*</b></span> : 
            </label>
            <div class="col-md-7">
                <select data-placeholder="Pilih Lokasi Rumah Sakit" class="select22" name="rs_id" id="rs_id" required=""> 
                    <option value="">-- Pilih--</option>
                    @foreach ($data_rs as $drs) 
                    <option value="{{ $drs['id'] }}">{{ $drs['nama'] }}<br>{{ $drs['alamat'] }}</option> 
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
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="$('#penampil_form_borang').removeAttr('style'); $('#tempat_form_borang_tambah').css('display','none');">
            <i class="icon-chevron-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-primary btn_simpan_kegiatan_pembelajaran_pribadi btn-ladda"  data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
            <i class="icon-check"></i> Tambah Borang
        </button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select22').select2();
        $('#tempat_form_borang_tambah').removeAttr('style');
        borang_ranah_kegiatan_pembelajaran_pribadi('#formBorangRanahKegiatanPembelajaranPribadi');
    });
</script>