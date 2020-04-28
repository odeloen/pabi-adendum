<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Edit Admin Cabang
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form method="post" action="{{ route('simpan_ubah_admin_cabang', $data_admin_cabang['id']) }}" onsubmit="if ($('#password').val() == $('#password_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }" class="form-horizontal" enctype="multipart/form-data">
                        
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Nama Admin : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="nama_admin" value="{{ $data_admin_cabang['name'] }}" id="nama">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="kode_bandara" style="text-align: right;" class="col-lg-4 control-label">
                                    Kode Bandara : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="kode_bandara" value="{{ $data_admin_cabang['kode_bandara'] }}" id="kode_bandara">  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label for="nama_bank" style="text-align: right;" class="col-lg-4 control-label">
                                    Nama Bank : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="nama_bank" id="nama_bank" value="{{ $data_admin_cabang['nama_bank'] }}">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="no_rek" style="text-align: right;" class="col-lg-4 control-label">
                                    Nomor Rekening : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="no_rek" id="no_rek" value="{{ $data_admin_cabang['no_rek'] }}">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="pemilik_rek" style="text-align: right;" class="col-lg-4 control-label">
                                    Nama Pemilik Rekening : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="pemilik_rek" id="pemilik_rek" value="{{ $data_admin_cabang['pemilik_rek'] }}">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Deskripsi : 
                                </label>
                                <div class="col-lg-7">  
                                    <textarea name="description" id="description" placeholder="Deskripsi" class="form-control" rows="3">{{ $data_admin_cabang['description'] }}</textarea>
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