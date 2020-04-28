<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Verifikasi Admin Pusat
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <?php  
                    $member_id = $data_member['id'];
                    $setuju = '';
                    if($data_member['pusat_verif'] != 3){
                        $setuju = 'checked';
                    }
                    $cek_verif_pusat = '';
                    $alert_pusat = '';
                    if ($data_member['pusat_verif'] == 1) {
                        if ($data_member['cabang_verif'] == 2 || $data_member['cabang_verif'] == 3) {
                            $cek_verif_pusat = 'y';
                            $alert_pusat = '';
                        } else {
                            $cek_verif_pusat = 't';
                            $alert_pusat = 'Admin Cabang belum melakukan verifikasi, tunggu sampai admin cabang melakukan verifikasi';
                        }
                    } else if ($data_member['pusat_verif'] == 2 || $data_member['pusat_verif'] == 3) {
                        $cek_verif_pusat = 't';
                        $alert_pusat = 'Admin Cabang Sudah Melakukan verifikasi';
                    } else {
                        $cek_verif_pusat = 't';
                        $alert_pusat = 'Member ini belum melakukan Pengajuan';
                    }
                    ?>
                    <input type="hidden" name="cek_verif_pusat" id="cek_verif_pusat" value="{{ $cek_verif_pusat }}">
                    <form method="post" action="{{ route('simpan_verifikasi_member_pusat', $member_id) }}" class="form-horizontal" enctype="multipart/form-data" onsubmit="if ($('#cek_verif_pusat').val() == 'y') { return true; } else { alert('{{ $alert_pusat }}'); return false; }">
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
                                        <input {{ $setuju }} type="checkbox" class="onoffswitch-checkbox"
                                        name="pusat_verif" id="setuju_3">
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
                                    <textarea required="required" name="pusat_ket" id="keterangan_3" placeholder="Keterangan Tambahan" class="form-control summernote" rows="4">{{ $data_member['pusat_ket'] }}</textarea>
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