<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_pendaftaran_event" data-toggle="tab" aria-expanded="false">
                        Buka / Tutup Pendaftaran Event Cabang
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_pendaftaran_event"> 
                    <?php  
                    $setuju = '';
                    if($data_event['status_event'] == 1){
                        $setuju = 'checked';
                    }
                    $id_event = $data_event['id'];
                    ?>
                    <form class="form-horizontal" enctype="multipart/form-data" id="formModalOnOffPendaftaranCabang">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Buka / Tutup Pendaftaran : 
                                </label>
                                <div class="col-lg-7"> 
                                    <div class="onoffswitch_acc_member_event">
                                        <input {{ $setuju }} type="checkbox" class="onoffswitch_acc_member_event-checkbox"
                                        name="status_event" id="status_event">
                                        <label class="onoffswitch_acc_member_event-label" for="status_event">
                                            <span class="onoffswitch_acc_member_event-inner"></span>
                                            <span class="onoffswitch_acc_member_event-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="max_event" id="max_event" value="{{ $data_event['max_event'] }}">
                            </div> 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" name="closeFormModalOnOffPendaftaranCabang" id="closeFormModalOnOffPendaftaranCabang">
                                <i class="icon-cross"></i> Close
                            </button>
                            <a class="btn btn-primary btn-ladda btn_simpan_modal_onoff_pendaftaran_cabang" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" onclick="simpan_modal_onoff_pendaftaran_cabang('{{csrf_token()}}', '{{ $id_event }}', '.btn_simpan_modal_onoff_pendaftaran_cabang')">
                                <i class="icon-check"></i> Simpan
                            </a>
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