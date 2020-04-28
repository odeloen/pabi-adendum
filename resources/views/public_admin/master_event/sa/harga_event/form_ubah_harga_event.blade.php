<form class="form-horizontal" enctype="multipart/form-data" id="formModalUbahHargaEvent" onsubmit="simpan_form_modal_ubah_harga_event('{{csrf_token()}}', '{{ $id_event }}', '.btn_harga_event', '{{ $id_event_harga }}'); return false;">
    <div class="form-group">
        {{ csrf_field() }}
    </div> 
    <div class="form-group">
        <label for="kategori" style="text-align: right;" class="col-md-3 control-label">
            Kategori <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="text" class="form-control" name="kategori" id="kategori" value="{{ $data_harga['kategori'] }}" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="harga" style="text-align: right;" class="col-md-3 control-label">
            Harga(Rp) <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="number" class="form-control" name="harga" id="harga" value="{{ $data_harga['harga'] }}" required="required" oninput="js_number_format(this.value, '#str_harga_event')">
            <span class="help-block">
                Rp<span id="str_harga_event"></span>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label for="kuota_peserta" style="text-align: right;" class="col-md-3 control-label">
            Kuota <span style="color:red"><b>*</b></span> : 
        </label>
        <div class="col-md-7"> 
            <input type="number" class="form-control" name="kuota_peserta" id="kuota_peserta" value="{{ $data_harga['kuota_peserta'] }}" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-10">  
            <button style="float: right;" type="submit" class="btn btn-primary btn-ladda btn_harga_event" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20" >
                <i class="icon-check"></i> Simpan Perubahan Harga
            </button>
        </div>
    </div>  
</form>
<script type="text/javascript">
    $(document).ready(function () {
        js_number_format('{{ $data_harga["harga"] }}', '#str_harga_event');
    });
</script>
