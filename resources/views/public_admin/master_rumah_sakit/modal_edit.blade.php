<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Tambah Rumah Sakit
                    </a>
                </li> 
            </ul> 
            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form id="formTambahMasterRS" method="post" action="{{ route('simpan_edit_rumah_sakit', $data_rs['id']) }}" class="form-horizontal" enctype="multipart/form-data" >
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="nama" style="text-align: right;" class="col-lg-3 control-label">
                                    Nama <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="text" class="form-control" name="nama" value="{{ $data_rs['nama'] }}">  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="deskripsi" style="text-align: right;" class="col-lg-3 control-label">
                                    Telp <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">  
                                    <input required="" type="text" class="form-control" name="telpon" value="{{ $data_rs['telpon'] }}">  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-3 control-label">
                                    Alamat : 
                                </label>
                                <div class="col-lg-8"> 
                                    <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ $data_rs['alamat'] }}</textarea>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="prov_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Provinsi <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <select required="" data-placeholder="Pilih Provinsi" class="select22" style="width: 100%" name="prov_id" id="prov_id" onchange="kota_by_provinsi_id('{{csrf_token()}}', '#formTambahMasterRS', 0)">
                                        <option value="">-- Pilih Provinsi --</option> 
                                        @foreach ($data_provinsi as $dp)
                                        <?php
                                        $selected="";
                                        if($dp['id_prov'] == $data_rs['id_provinsi']){
                                            $selected = "selected";
                                        }
                                        ?>
                                        <option {{ $selected }} value="{{ $dp['id_prov'] }}">{{ $dp['nama'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="kota_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Kabupaten/Kota <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">
                                    <select required="" class="select22" style="width: 100%" name="kota_id" id="kota_id" required="" onchange="kecamatan_by_kota_id('{{csrf_token()}}', '#formTambahMasterRS', 0, 0)">
                                        <option value="">-- Pilih Kabupaten/Kota  --</option> 
                                        @foreach ($data_kab as $dp)
                                        <?php
                                        $selected="";
                                        if($dp['id'] == $data_rs['id_kabupaten_kota']){
                                            $selected = "selected";
                                        }
                                        ?>
                                        <option {{ $selected }} value="{{ $dp['id'] }}">{{ $dp['nama'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-3 control-label">
                                    Logo : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input type="file" class="form-control" value="" id="img_logo" name="img_logo">  
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