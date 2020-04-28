<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Reset Password Member
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form class="form-horizontal" enctype="multipart/form-data" onsubmit="if ($('#f1_password').val() == $('#f1_password_confirmation').val()) { simpan_form_update_reset_password_admin('{{csrf_token()}}', '{{$user_id}}', '.btnFormResetPasswordMemberAdmin'); return false; } else { alert('Password tidak sama'); return false; }" id="formResetPasswordMemberAdmin">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div> 
                            <div class="form-group">
                                <label for="f1_password" style="text-align: right;" class="col-md-4 control-label">
                                    Password Baru <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-md-7"> 
                                    <input type="password" required="" class="form-control" name="f1_password" id="f1_password" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="f1_password_confirmation" style="text-align: right;" class="col-md-4 control-label">
                                    Ulangi Password Baru <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-md-7"> 
                                    <input type="password" required="" class="form-control" name="f1_password_confirmation" id="f1_password_confirmation" >
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Batal</button>
                            <button type="submit" class="btn btn-primary btn-ladda btnFormResetPasswordMemberAdmin" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
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