<?php $id_member = $data_member['id']; 

$keydiv="simpan_div_minat_bidang_keanggotaan";
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
<form style="display: none" class="div_<?= $keydiv; ?> form-horizontal" enctype="multipart/form-data" id="formKeanggotaanMinatBidang" onsubmit="
    simpan_div_minat_bidang_keanggotaan('{{csrf_token()}}', '{{ $id_member }}', '.btn_data_minat_bidang');
    return false;
">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="jenis_minat" style="text-align: right;" class="col-md-4 control-label">
            Jenis Minat Bidang <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7">
            <select data-placeholder="Pilih Jenis Minat Bidang" class="select22" name="jenis_minat" id="jenis_minat" required=""> 
                <option value="">-- Pilih--</option>
                @foreach ($data_minat_bidang as $dm) 
                <option value="{{ $dm['kode'] }}">{{ $dm['nama'] }}</option> 
                @endforeach
                <!-- <option value="">-- Pilih--</option>
                <option value="Konsultan Kepala Leher">Konsultan Kepala Leher</option>
                <option value="Konsultan Onkologi">Konsultan Onkologi</option>
                <option value="Konsultan Digestive">Konsultan Digestive</option>
                <option value="Konsultan Vaskular">Konsultan Vaskular</option>
                <option value="Konsultan Trauma">Konsultan Trauma</option>
                <option value="Fellowship Trauma">Fellowship Trauma</option>
                <option value="Fellowship Kemoterapi">Fellowship Kemoterapi</option>
                <option value="Peminatan Laparoskopi">Peminatan Laparoskopi</option>
                <option value="Peminatan Hernia">Peminatan Hernia</option>
                <option value="Peminatan Payudara">Peminatan Payudara</option> -->
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="ket_minat_bidang" style="text-align: right;" class="col-md-4 control-label">
            Deskripsi Minat Bidang : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="ket_minat_bidang" id="ket_minat_bidang" >
        </div>
    </div> 
    <div class="form-group">
        <div class="col-md-11">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_data_minat_bidang" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
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