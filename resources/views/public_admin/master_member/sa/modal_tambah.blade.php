<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Tambah Admin Cabang
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form method="post" action="{{ route('simpan_master_member') }}" onsubmit="if ($('#password').val() == $('#password_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }" class="form-horizontal"  enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="username" style="text-align: right;" class="col-lg-4 control-label">
                                    Username <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="text" class="form-control" name="username" id="username" required="">  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label for="email" style="text-align: right;" class="col-lg-4 control-label">
                                    E-Mail <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="email" class="form-control" name="email" id="email" required="">  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label for="password" style="text-align: right;" class="col-lg-4 control-label">
                                    Password <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="password" class="form-control" name="password" id="password" required="">  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label for="password_confirmation" style="text-align: right;" class="col-lg-4 control-label">
                                    Ulangi Password <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required="">  
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