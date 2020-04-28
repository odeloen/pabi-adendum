<?php $id_member = $data_member['id']; 
// print_r($data_praktek);
// echo $data_praktek['nama_praktek'];
// exit();
$keydiv="simpan_div_data_praktek_keanggotaan";
?> 
<div class="row div_<?= $keydiv; ?>">
    <div class="col-md-12">  
        <button type="button" class="btn btn-primary" onclick="$('.div_<?= $keydiv; ?>').toggle(500);">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
    </div>
    <hr>
    <hr>
</div>
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanDataPraktek" onsubmit="
    simpan_div_data_praktek_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_praktek');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="tempat_praktek" style="text-align: right;" class="col-md-4 control-label">
            Tempat Praktek <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <select class="select22" required="required" style="width: 100%" onchange="
                $('#tempat_praktek').val(this.value);
                $('#tempat_praktek').hide();
                if(this.value == 'lainnya'){
                   $('#tempat_praktek').val(''); 
                   $('#tempat_praktek').show(500); 
                }
            ">
                <option value="">-- Pilih Rumah Sakit --</option> 
                <option value="lainnya">-- Lainnya --</option> 
                @foreach ($data_rs as $dk)
                <option value="{{ $dk['nama'] }}">{{ $dk['nama'] }}</option>
                @endforeach
            </select> 
            <input style="display: none" required="required" type="text" class="form-control" name="tempat_praktek" id="tempat_praktek" placeholder="Isi Nama Rumah Sakit">
        </div>
    </div>
    <div class="form-group">
        <label for="no_sip_praktek" style="text-align: right;" class="col-md-4 control-label">
            No SIP <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="text" class="form-control" name="no_sip_praktek" id="no_sip_praktek" value=""> 
        </div>
    </div>  

    <div class="form-group">
        <label for="tanggal_sip" style="text-align: right;" class="col-md-4 control-label">
            Tanggal SIP <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input required="required" type="date" class="form-control" name="tanggal_sip" id="tanggal_sip" value=""> 
        </div>
    </div> 

    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_praktek" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan
            </button>
            <button style="float: right;" type="button" class="btn btn-danger " onclick="$('.div_<?= $keydiv; ?>').toggle(500);">
                <i class="icon-cross"></i> Batal
            </button>  
        </div>
    </div>  
</form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('.select22').select2();
    });
</script>