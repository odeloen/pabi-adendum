<div class="row">
    <div class="col-lg-12">  
        <div id="tab_verifikasi">
            <div class="row">
                <div class="col-lg-12" id="penampil_form_borang">
                    <form method="POST" class="form-horizontal" id="formPilihFormBorang"
                          onsubmit="tampilkan_form_borang_tambah('{{csrf_token()}}', '#tempat_form_borang_tambah', '{{$member_id}}', '#penampil_form_borang'); return false;">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <input type="hidden" name="tanggal_tabel" id="tanggal_tabel" value="{{$tgl}}">
                            </div>
                            <div class="form-group">
                                <label for="borang" style="text-align: right;" class="col-md-3 control-label">
                                    Ranah Borang :
                                </label>
                                <div class="col-md-7">
                                    <select required="required" data-placeholder="Pilih Borang" class="select22" name="borang"
                                            id="borang" style="width: 100%"
                                            onchange="
                                            $('.div_kegiatan').hide(500);
                                            $('.div_jenis').show(500);
                                            jenis_kegiatan_by_borang('{{csrf_token()}}', '#formPilihFormBorang');">
                                        <option value="">-- Semua --</option>
                                        <?php
                                        foreach ($data_ranah_borang as $drb) {
                                            echo '<option value="'.$drb['id'].'">'.$drb['nama_ranah'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group div_jenis" style="display: none">
                                <label for="jenis_kegiatan" style="text-align: right;"
                                       class="col-md-3 control-label">
                                    Jenis Kegiatan :
                                </label>
                                <div class="col-md-7">
                                    <select required="required"class="select22" name="jenis_kegiatan" id="jenis_kegiatan" style="width: 100%" 
                                            onchange="
                                            $('.div_kegiatan').show(500); 
                                            nama_kegiatan_by_jenis_kegiatan('{{csrf_token()}}', '#formPilihFormBorang');">
                                        <option value="">-- Pilih Jenis Kegiatan --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group div_kegiatan" style="display: none">
                                <label for="nama_kegiatan" style="text-align: right;"
                                       class="col-md-3 control-label">
                                    Nama Kegiatan :
                                </label>
                                <div class="col-md-7">
                                    <select required="required" class="select22" name="nama_kegiatan" id="nama_kegiatan" style="width: 100%">
                                        <option value="">-- Semua --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="icon-cross"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-file-openoffice"></i> Tampilkan Form
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12" id="tempat_form_borang_tambah">

                </div>
            </div>

        </div> 
    </div>
</div>
<script type="text/javascript">
    if ($('.select22').length) {
        $('.select22').select2();
    }
    $(document).ready(function () {

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