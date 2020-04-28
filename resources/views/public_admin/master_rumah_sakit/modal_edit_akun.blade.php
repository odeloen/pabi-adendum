<div class="row">
    <div class="col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#tab_verifikasi" data-toggle="tab" aria-expanded="false">
                        Ubah Data Akun Rumah Sakit
                    </a>
                </li> 
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_verifikasi"> 
                    <form id="formUbahAkunMasterRS" method="post" action="{{ route('simpan_edit_modal_akun_rs', $data_user_rs['id']) }}" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                {{ csrf_field() }}
                            </div>  
                            <div class="form-group status_lengkap">
                                <label for="admin_cabang_id" style="text-align: right;" class="col-lg-3 control-label">
                                    Cabang <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <select required="" data-placeholder="Pilih Cabang" class="select22" style="width: 100%" name="admin_cabang_id" id="admin_cabang_id" onchange="isa_data_akun_rumah_sakit('#formUbahAkunMasterRS', 'admin_cabang_id')">
                                        <option value="">-- Pilih Cabang --</option> 
                                        @foreach ($data_cabang as $dc)
                                        <?php
                                        $sel_cabang = '';
                                        $seldiscab = '';
                                        if (session('pabi_role_id') == 3) {
                                            if (session('admin_cabang_id') == $dc['id']) {
                                                $seldiscab = ' selected=""';
                                            } else {
                                                $seldiscab = ' disabled=""';
                                            }
                                        } else {
                                            if ($dc['id'] == $data_user_rs['admin_cabang_id']) {
                                                $sel_cabang = ' selected=""';
                                            }
                                        }
                                        ?>
                                        <option value="{{ $dc['id'] }}" adpu="{{ $dc['admin_pusat_id'] }}"<?php echo $sel_cabang ?><?php echo $seldiscab; ?>>
                                            {{ $dc['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <?php
                                    $strvalpst = '';
                                    if (session('pabi_role_id') == 3) {
                                        $strvalpst = session('admn_pusat_id');
                                    } else {
                                        $strvalpst = $data_user_rs['admin_pusat_id'];
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
                                    <input required="required" type="text" class="form-control" value="{{ $data_user_rs['username'] }}" name="username" id="username" >  
                                </div>
                            </div>
                            <div class="form-group status_lengkap">
                                <label for="email" style="text-align: right;" class="col-lg-3 control-label">
                                    E-Mail <span style="color:red"><b>*</b></span> : 
                                </label>
                                <div class="col-lg-8"> 
                                    <input required="required" type="email" class="form-control" value="{{ $data_user_rs['email'] }}" name="email" id="email" >  
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