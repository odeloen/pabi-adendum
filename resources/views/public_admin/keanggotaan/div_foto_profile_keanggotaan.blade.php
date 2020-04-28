@include('public_admin.include.function') 
<div class="row">
    <div class="col-sm-4">&nbsp;</div>
    <div class="col-sm-4" style="text-align: center;">
        <div style="font-weight: bold" class="alert alert-danger no-border" align="center">
            <div class="target_foto"> 
                <?php 
                if (does_url_exists(env('URL_API_IP') . $data_member['image_thumb_compress']) == 1 && !empty($data_member['image_thumb_compress'])) {
                    ?>
                    <a href="{{env('URL_API_IP')}}{{$data_member['image_thumb']}}" target="_blank">
                        <img src="{{env('URL_API_IP')}}{{$data_member['image_thumb_compress']}}"
                             style="width: 200px;"> 
                    </a>
                    <?php
                } else {
                    if(request()->session()->get('pabi_gender') == 'P'){ 
                    ?>
                    <a href="#" class="display-inline-block content-group-sm">
                        <img src="{{ asset('assets/images/profile_member/member_pr.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>
                    <?php 
                    } else {
                    ?>
                    <a href="#" class="display-inline-block content-group-sm">
                        <img src="{{ asset('assets/images/profile_member/deafult_profile.png') }}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>
                    <?php 
                    }
                }
                ?> 
            </div>
            <br>
            <br>
            <form method="post" onsubmit="ladda_start('.btn_upload_foto');" 
                  action="{{ route('simpan_ubah_my_profile_foto_profile', $data_member['id']) }}"
                  class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group div_edit_upload" style="display: none"> 
                    <div class="col-md-12"> 
                        <input required="required" type="file" name="image_thumb" id="image_thumb" class="file-styled" accept="image/x-png,image/gif,image/jpeg">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                </div>
                <div class="form-group div_edit_upload  ">
                    <label style="text-align: right;" class="col-md-3 control-label "></label>
                    <div class="col-md-6">
                        <button type="button"
                                class="btn btn-primary btn-sm btn-block btn-ladda  "
                                data-style="expand-left" data-spinner-color="#333"
                                data-spinner-size="20" onclick="
                                    $('.div_edit_upload').toggle(500);
                                ">
                            <i class="icon-upload"></i> UBAH
                        </button>
                    </div>
                </div>
                <div class="form-group div_edit_upload" style="display: none">
                    <label style="text-align: right;" class="col-md-3 control-label "></label>
                    <div class="col-lg-4">
                        <button type="button" class="btn btn-danger btn-sm btn-block btn-ladda"
                                onclick="
                                    $('.div_edit_upload').toggle(500);
                                ">
                            <i class="icon-cross"></i> Batal
                        </button>
                    </div>
                    <div class="col-lg-4">
                        <button type="submit"
                                class="btn btn-primary btn-sm btn-block btn-ladda btn_upload_foto"
                                data-style="expand-left" data-spinner-color="#333"
                                data-spinner-size="20" >
                            <i class="icon-upload"></i> Unggah Foto
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-4">&nbsp;</div>  
</div> 
<!--
<div class="col-lg-12">
    <div><img src="{{env('URL_API_IP')}}{{$data_member['image_thumb']}}" width="200" height="200"></div>    
</div>
<div class="col-lg-12">
    <form method="post" action="{{ route('simpan_ubah_my_profile_foto_profile', $data_member['id']) }}" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="image_thumb" style="text-align: right;" class="col-lg-4 control-label">
                Foto Profile : 
            </label>
            <div class="col-lg-7">
                <input type="file" name="image_thumb" id="image_thumb" class="file-styled">
                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-4 control-label"> 
                <a href="#" style="float: right;" class="btn btn-danger"><i class="icon-trash"></i> Hapus</a>
            </div>
            <div class="col-lg-7"> 
                <button style="float: right;" type="submit" class="btn btn-primary"><i class="icon-check"></i> Ubah</button>
            </div>
        </div>
    </form>
</div>
-->