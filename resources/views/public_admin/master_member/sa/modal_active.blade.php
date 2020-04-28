<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Modal Active
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <?php  
                    $user_id = $data_active['id'];
                    $setuju = '';
                    if($data_active['status_active'] == 1){
                        $setuju = 'checked';
                    } 
                    ?> 
                    <form method="post" action="{{route('simpan_member_active', $user_id)}}" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <input type="hidden" name="member_id" id="member_id" value="{{ $data_active_m['id'] }}">
                                <input type="hidden" name="url_back" id="url_back" value="{{ $url_back }}">
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Active / Non Active : 
                                </label> 
                                <div class="col-lg-7"> 
                                    <div class="onoffswitch_active">
                                        <input {{ $setuju }} type="checkbox" class="onoffswitch_active-checkbox"
                                        name="status_active" id="status_active">
                                        <label class="onoffswitch_active-label" for="status_active">
                                            <span class="onoffswitch_active-inner"></span>
                                            <span class="onoffswitch_active-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Keterangan : 
                                </label>
                                <div class="col-lg-7"> 
                                    <textarea name="ket_active" id="keterangan_3" placeholder="Keterangan Tambahan" class="form-control summernote" rows="4">{{ $data_active['ket_active'] }}</textarea>
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