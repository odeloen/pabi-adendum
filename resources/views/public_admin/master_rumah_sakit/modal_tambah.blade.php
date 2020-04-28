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
                    <form id="formTambahMasterRS" method="post" action="{{ route('simpan_rumah_sakit') }}" class="form-horizontal" enctype="multipart/form-data" onsubmit="if ($('#password').val() == $('#password_confirmation').val()) { return true; } else { alert('Password tidak sama'); return false; }">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="nama" style="text-align: right;" class="col-lg-3 control-label">
                                    Nama <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="text" class="form-control" value="" name="nama" id="nama" >  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="deskripsi" style="text-align: right;" class="col-lg-3 control-label">
                                    Telp <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8">  
                                    <input required="" type="text" class="form-control" value="" id="telpon" name="telpon" >  
                                </div>
                            </div> 
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-3 control-label">
                                    Alamat : 
                                </label>
                                <div class="col-lg-8"> 
                                    <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
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
                                        <option value="{{ $dp['id_prov'] }}">{{ $dp['nama'] }}</option>
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
                            <hr>
                            <div class="form-group status_lengkap">
                                <label for="admin_cabang_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Cabang <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <select required="" data-placeholder="Pilih Cabang" class="select22" style="width: 100%" name="admin_cabang_id" id="admin_cabang_id" onchange="isa_data_akun_rumah_sakit('#formTambahMasterRS', 'admin_cabang_id')">
                                        <option value="">-- Pilih Cabang --</option> 
                                        @foreach ($data_cabang as $dc)
                                        <?php
                                        $seldiscab = '';
                                        if (session('pabi_role_id') == 3) {
                                            if (session('admin_cabang_id') == $dc['id']) {
                                                $seldiscab = ' selected=""';
                                            } else {
                                                $seldiscab = ' disabled=""';
                                            }
                                        }
                                        ?>
                                        <option value="{{ $dc['id'] }}" adpu="{{ $dc['admin_pusat_id'] }}"<?php echo $seldiscab; ?>>
                                            {{ $dc['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <?php
                                    $strvalpst = '';
                                    if (session('pabi_role_id') == 3) {
                                        $strvalpst = session('admn_pusat_id');
                                    }
                                    ?>
                                    <input type="hidden" name="admin_pusat_id" id="admin_pusat_id" value="{{$strvalpst}}">
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="username" style="text-align: right;" class="col-lg-3 control-label">
                                    Username <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="text" class="form-control" value="" name="username" id="username" >  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="email" style="text-align: right;" class="col-lg-3 control-label">
                                    E-Mail <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="email" class="form-control" value="" name="email" id="email" >  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="password" style="text-align: right;" class="col-lg-3 control-label">
                                    Password <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="password" class="form-control" value="" name="password" id="password" >  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label style="text-align: right;" class="col-lg-3 control-label">
                                    Re-Password <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="password" class="form-control" value="" id="password_confirmation" name="password_confirmation" > 
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