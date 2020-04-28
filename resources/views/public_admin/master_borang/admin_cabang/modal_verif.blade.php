<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Verifikasi Admin Cabang
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <?php  
                    $borang_id = $data_histori_kegiatan['id'];
                    $setuju = '';
                    if($data_histori_kegiatan['cabang_verif'] != 2){
                        $setuju = 'checked';
                    }
                    $cek_verif_cabang = '';
                    $alert_cabang = '';
                    if ($data_histori_kegiatan['cabang_verif'] == 2 || $data_histori_kegiatan['cabang_verif'] == 1) {
                        $cek_verif_cabang = 't';
                        $alert_cabang = 'Admin Cabang Sudah Melakukan verifikasi';
                    } else {
                        $cek_verif_cabang = 'y';
                        $alert_cabang = '';
                    }
                    ?>
                    <input type="hidden" name="cek_verif_cabang" id="cek_verif_cabang" value="{{$cek_verif_cabang}}">
                    <form method="post" action="{{route('simpan_verifikasi_borang_cabang')}}" class="form-horizontal" enctype="multipart/form-data" onsubmit="if ($('#cek_verif_cabang').val() == 'y') { return true; } else { alert('{{ $alert_cabang }}'); return false; }">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Setuju / Tidak Setuju : 
                                </label>
                                <div class="col-lg-7"> 
                                    <div class="onoffswitch">
                                        <input {{$setuju}} type="checkbox" class="onoffswitch-checkbox"
                                        name="cabang_verif" id="setuju_3">
                                        <label class="onoffswitch-label" for="setuju_3">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-4 control-label">
                                    Keterangan <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-7"> 
                                    <input type="hidden" name="ranah_borang_id" id="ranah_borang_id" value="{{$ranah_borang_id}}">
                                    <input type="hidden" name="histori_kegiatan_id" id="histori_kegiatan_id" value="{{$data_histori_kegiatan['id']}}">
                                    <textarea required="required" name="cabang_ket" id="keterangan_3" placeholder="Keterangan Tambahan" class="form-control summernote" rows="4">{{ $data_histori_kegiatan['cabang_ket'] }}</textarea>
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