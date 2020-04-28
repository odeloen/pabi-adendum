<?php $id_member = $data_member['id']; ?>
<form class="form-horizontal" enctype="multipart/form-data" id="formKeanggotaanBank" onsubmit="simpan_div_data_bank_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_data_bank');
    return false;    
    ">
    <div class="form-group">
        {{ csrf_field() }}
    </div>
    <div class="form-group">
        <label for="nama_bank" style="text-align: right;" class="col-md-4 control-label">
            Nama Bank <span style="color:red"><b>*</b></span> :
        </label>
        <div class="col-md-7">
            <input required="required" type="text" class="form-control" name="nama_bank" id="nama_bank"  value="{{ $data_member['bank_nama'] }}">
        </div>
    </div> 
    <div class="form-group">
        <label for="nama_pemilik_rekening" style="text-align: right;"
               class="col-md-4 control-label">
            Nama Pemilik Rekening <span style="color:red"><b>*</b></span> :
        </label>
        <div class="col-md-7">
            <input required="required" type="text" class="form-control" name="nama_pemilik_rekening" id="nama_pemilik_rekening"  value="{{ $data_member['bank_pemilik'] }}">
        </div>
    </div>
    <div class="form-group">
        <label for="nomor_rekening" style="text-align: right;" class="col-md-4 control-label">
            No Rekening <span style="color:red"><b>*</b></span> :
        </label>
        <div class="col-md-7">
            <input required="required" type="text" class="form-control" name="nomor_rekening" id="nomor_rekening"  value="{{ $data_member['bank_no_rekening'] }}">
        </div>
    </div>  
    <input type="file" name="image_thumb" style="display: none;">
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_data_bank" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan
            </button>
        </div>
    </div>     
</form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.select22').select2();
    });
</script>