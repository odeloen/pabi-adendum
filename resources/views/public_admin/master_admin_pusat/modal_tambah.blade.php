<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Tambah Admin Pusat
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form method="post" action="{{ route('simpan_admin_pusat') }}" onsubmit="if ($('#password').val() == $('#password_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }" class="form-horizontal"  >
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="nama" style="text-align: right;" class="col-lg-4 control-label">
                                    Nama Admin : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" value="" name="nama" id="nama" oninput="$('#username').val($('#nama').val().toLowerCase());">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="nama_bank" style="text-align: right;" class="col-lg-4 control-label">
                                    Nama Bank : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="nama_bank" id="nama_bank" value="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="no_rek" style="text-align: right;" class="col-lg-4 control-label">
                                    Nomor Rekening : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="no_rek" id="no_rek" value="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="pemilik_rek" style="text-align: right;" class="col-lg-4 control-label">
                                    Nama Pemilik Rekening : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="pemilik_rek" id="pemilik_rek" value="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="deskripsi" style="text-align: right;" class="col-lg-4 control-label">
                                    Deskripsi : 
                                </label>
                                <div class="col-lg-7">  
                                	<textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control" rows="3"></textarea>
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Username : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" value="" id="username" name="username" readonly="">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Password : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="password" class="form-control" value="" id="password" name ="password">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Re-Password : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="password" class="form-control" value="" id="password_confirmation" name="password_confirmation" > 
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Email : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="mail" class="form-control" value="" id="email" name="email">  
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