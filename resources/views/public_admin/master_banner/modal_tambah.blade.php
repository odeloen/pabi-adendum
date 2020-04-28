<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Tambah Banner
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form id="formTambahMasterRS" method="post" action="{{ route('simpan_banner') }}" class="form-horizontal" enctype="multipart/form-data" >
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="judul" style="text-align: right;" class="col-lg-3 control-label">
                                    Judul <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="text" class="form-control" value="" name="judul" id="judul" >  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="isi" style="text-align: right;" class="col-lg-3 control-label">
                                    Isi <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">   
                                    <textarea id="isi" name="isi" placeholder="Keterangan Tambahan" class="form-control txt_ckeditor" rows="4"></textarea>  
                                </div>
                            </div>   
                            <div class="form-group status_lengkap">
                                <label for="judul" style="text-align: right;" class="col-lg-3 control-label">
                                    Posisi Isi <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <select required="required" class="form-control" name="posisi_isi" id="posisi_isi">
                                        <option value="1">Kiri</option>
                                        <option value="2">Kanan</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-3 control-label">
                                    Foto Banner <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="file" class="form-control" value="" id="image_banner" name="image_banner">  
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

        $('.txt_ckeditor').each(function(e){ 
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