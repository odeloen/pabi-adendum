 
<form class="form-horizontal" enctype="multipart/form-data" id="formTambahEventAdminPusat" onsubmit=" return false; "> 
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="alert alert-warning alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"> 
        </button>
        <span class="text-semibold">Percobaan!<br></span> Menu ini masih dalam tahap pembuatan.
    </div>   
    <div class="form-group status_lengkap">
        <label for="tgl_event" style="text-align: right;" class="col-md-3 control-label">
            Tanggal <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <input value="{{ $tgl }}" type="date" class="form-control" name="tgl_event" id="tgl_event" required="" readonly="readonly">  
        </div>
    </div>  
    <div class="form-group status_lengkap">
        <label for="nama_event" style="text-align: right;" class="col-md-3 control-label">
            Pilih Ranah <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <select onchange="$('.bidang').show(500);" class="select22" name="nama_event" id="nama_event" required="">
                <option>-- Pilih --</option>
                <option>Ranah Pembelajaran Pribadi</option>
                <option>Ranah Profesional</option>
                <option>Ranah Pengabdian Masyarakat</option>
                <option>Ranah Publikasi Ilmiah</option>
                <option>Ranah Pengembangan Ilmu dan Pendidikan</option>
            </select>  
        </div>
    </div> 
    <div style="display: none" class="form-group bidang">
        <label for="bidang" style="text-align: right;" class="col-md-3 control-label">
            Pilih Bidang <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <select onchange="$('.kegiatan').show(500);" class="select22" name="bidang" id="bidang" required="">
                <option>Belajar Mandiri</option>
                <option>Pelatihan/Workshop/Lokakarya</option>
                <option>Keikutsertaan Pertemuan Ilmiah</option>
                <option>Fellowship Dalam/Luar Negeri</option>
                <option>Evaluasi/Uji Diri, FINACS, ICS</option>
            </select>  
        </div>
    </div>
    <div style="display: none" class="form-group kegiatan">
        <label for="kegiatan" style="text-align: right;" class="col-md-3 control-label">
            Pilih Kegiatan <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <select onchange="$('#nilai_skp').val(this.value)" class="select22" name="kegiatan" id="kegiatan" required="">
                <option value="0.5">Journal & buku teks DN</option>
                <option value="1">Journal & buku teks LN</option>
                <option value="6">Seminar/simposium</option>
                <option value="10">P2B2/P2KB</option>
                <option value="10">Kongres Nasional/ Internasional</option>
                <option value="8">Pelatihan/workshop</option>
                <option value="4">Tes FINACS, Ujian Kasus</option>
            </select>  
        </div>
    </div>  
    <div class="form-group status_lengkap">
        <label for="nilai_skp" style="text-align: right;" class="col-md-3 control-label">
            Nilai SKP <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <input readonly="" type="text" class="form-control" name="nilai_skp" id="nilai_skp" required="">  
        </div>
    </div>  
    <div class="form-group status_lengkap">
        <label for="deskripsi" style="text-align: right;" class="col-md-3 control-label">
            Keterangan : 
        </label>
        <div class="col-md-8">  
            <textarea style="resize: none;" name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control" rows="3"></textarea>
        </div>
    </div>  
    <div class="form-group status_lengkap">
        <label for="tgl_event" style="text-align: right;" class="col-md-3 control-label">
            Judul Artikel / Topik <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <input type="text" class="form-control" name="tgl_event" id="tgl_event" required="">  
        </div>
    </div>       
    <div class="form-group status_lengkap">
        <label for="tgl_event" style="text-align: right;" class="col-md-3 control-label">
            Peran Serta <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <input type="text" class="form-control" name="tgl_event" id="tgl_event" required="">  
        </div>
    </div>   
    <div class="form-group status_lengkap">
        <label for="tgl_event" style="text-align: right;" class="col-md-3 control-label">
            Penyelenggara <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <input type="text" class="form-control" name="tgl_event" id="tgl_event" required="">  
        </div>
    </div>  
    <div class="form-group status_lengkap">
        <label for="tgl_event" style="text-align: right;" class="col-md-3 control-label">
            File Pendukung <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-8"> 
            <input type="file" class="form-control" name="tgl_event" id="tgl_event" required=""> 
        </div>
    </div>            
    <div style="width: 100%; text-align: right;">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
        <button class="btn btn-primary btn-ladda btn_simpan_form_tambah_event_admin_pusat" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" type="submit">
            <i class="icon-check"></i> Simpan
        </button> 
    </div> 
</form>  

<script type="text/javascript" src="{{asset('assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
<script type="text/javascript"> 
    if($('.select22').length){
        $('.select22').select2();
    } 
    $( document ).ready(function() { 

        $("#dropzone_file_limits").dropzone({
            paramName: "file", // The name that will be used to transfer the file
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
            maxFilesize: 4, // MB
            maxFiles: 4,
            maxThumbnailFilesize: 1,
            addRemoveLinks: true
        });
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