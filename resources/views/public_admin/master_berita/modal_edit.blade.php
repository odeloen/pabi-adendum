<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Edit Berita
                    </a>
                </li> 
            </ul> 
            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form id="formTambahMasterRS" method="post" action="{{ route('simpan_edit_berita', $data_berita['id']) }}" class="form-horizontal" enctype="multipart/form-data" >
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="judul" style="text-align: right;" class="col-lg-3 control-label">
                                    Judul <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="text" class="form-control" name="judul" value="{{ $data_berita['judul'] }}">  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap" style="display: none">
                                <label for="deskripsi" style="text-align: right;" class="col-lg-3 control-label">
                                    Is Top <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">  
                                    <input required="" type="number" class="form-control" name="is_top" value="{{ $data_berita['is_top'] }}">  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label for="deskripsi" style="text-align: right;" class="col-lg-3 control-label">
                                    Isi <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">   
                                    <textarea id="isi_edit" name="isi" placeholder="Keterangan Tambahan" class="form-control txt_ckeditor_edit" rows="4"><?= $data_berita['isi']; ?></textarea>    
                                </div>
                            </div> 

                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-3 control-label">
                                    Foto Berita : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="file" class="form-control" value="" id="image_berita" name="image_berita">  
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

        $('.txt_ckeditor_edit').each(function(e){ 
            var toolbarGroups = [
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph', groups: [ 'align', 'list', 'indent', 'blocks', 'bidi', 'paragraph' ] },
                    { name: 'forms', groups: [ 'forms' ] },
                    { name: 'document', groups: [ 'document', 'mode', 'doctools' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                    { name: 'links', groups: [ 'links' ] },
                    { name: 'styles', groups: [ 'styles' ] },
                    { name: 'insert', groups: [ 'insert' ] },
                    { name: 'colors', groups: [ 'colors' ] }, 
            ];
            CKEDITOR.replace(this.id,{  
                uiColor : '#b2cefe ',
                toolbarGroups,
                removeButtons : 'Link,Unlink,Anchor,Image,Flash,HorizontalRule,Iframe,About' 
            }); 
        }); 
    }); 
</script>